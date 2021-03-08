<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/5/30
 * Time: 10:30
 */
namespace App\Http\Controllers\Service;
 //header('Access-Control-Allow-Origin:*');    //解决跨域问题
 use App\Model\HeaderModel;
 use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FollowModel;
 use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
 use Illuminate\Support\Facades\Session;


class BaseController extends Controller
{

    static protected $header = '';
    static $ak = '5kvW2OYTTV22LMl4BocNHrWh86VPfezP';

    /**
     * @构造方法查询header头部信息
     * BaseController constructor.
     */
    public function __construct()
    {
        $this -> middleware(function ($request, $next) {

            self::$header = HeaderModel::getHeaderInfo();

            return $next($request);
        });
    }


    /**
     * 统一的返回前台的方法
     * @param string $msg
     * @param bool $bool
     * @param array $data
     * @param int $code
     * @return mixed
     */
    protected static function resultHandler( $msg = '操作成功', $bool = true, $data = [], $code = 200)
    {
        $data = [
            'bol'=> $bool,
            'msg'=> $msg,
            'data'=> $data,
            'err_code'=> $code
        ];

        return response()->json($data);
    }

    /**
     * 统一生成TOKEN
     * @return string
     */
    protected static function createToken()
    {
        $str = self:: getRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        return md5($str . $timestamp);

    }

    /**
     * 随机字符串
     * @param $length
     * @return string|null
     */
    protected static function getRandChar($length)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0;
             $i < $length;
             $i++) {
            $str .= $strPol[rand(0, $max)];
        }

        return $str;
    }

    /**
     * 设置 Redis Key 时间
     * @param $key
     * @param $value
     * @param $time
     * @return bool
     */
    protected function setKey($key , $value , $time)
    {
        Redis::set($key , $value);

        $bol = Redis::EXPIRE ($key , $time);

        return $bol;
    }

    /**
     * 获取签名
     * @param $arr
     * @return string
     */
    protected function getSign($arr){
        //去除数组的空值
        array_filter($arr);
        if(isset($arr['sign'])){
            unset($arr['sign']);
        }
        //排序
        ksort($arr);
        //组装字符
        $str = $this->arrToUrl($arr) . '&key=' . config('pay.KEY');
        //使用md5 加密 转换成大写
        return strtoupper(md5($str));
    }

    /**
     * 获取带签名的数组
     * @param $arr
     * @return mixed
     */
    protected function setSign($arr){
        $arr['sign'] = $this->getSign($arr);
        return $arr;
    }

    /**
     * 校验签名
     * @param $arr
     * @return bool
     */
    public function checkSign($arr){
        //生成新签名
        $sign = $this->getSign($arr);
        //和数组中原始签名比较
        if($sign == $arr['sign']){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 数组转URL字符串 不带key
     * @param $arr
     * @return string
     */
    public function arrToUrl($arr){
        return urldecode(http_build_query($arr));
    }

    /**
     * Xml 文件转数组
     * @param $xml
     * @return mixed|string
     */
    public function XmlToArr($xml)
    {
        if($xml == '') return '';

        libxml_disable_entity_loader(true);

        $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        return $arr;
    }

    /**
     * 数组转XML
     * @param $arr
     * @return string
     */
    public function ArrToXml($arr)
    {
        if(!is_array($arr) || count($arr) == 0) return '';

        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    /**
     * 记录到文件
     * @param $file
     * @param $data
     */
    public  function logs($file,$data){
        $data = is_array($data) ? print_r($data,true) : $data;
        file_put_contents('./logs/' .$file, $data);
    }

    /**
    使用curl方式实现get或post请求
    @param $url 请求的url地址
    @param $data 发送的post数据 如果为空则为get方式请求
    return 请求后获取到的数据
     */
    protected function curlRequest($url,$postfields)
    {
        //dd($postfields);
        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = false; //是否返回响应头信息
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
        $params[CURLOPT_POST] = true;
        $params[CURLOPT_SSL_VERIFYPEER] = false;//禁用证书校验
        $params[CURLOPT_SSL_VERIFYHOST] = false;
        $params[CURLOPT_POSTFIELDS] = $postfields;
        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }

    /**
     * 统一下单
     * @param $params
     * @return bool|mixed|string
     */
    public function unifiedorder($params){
        //获取到带签名的数组
        $params = $this -> setSign($params);
//        dd($params);
        //数组转xml
        $xml = $this -> ArrToXml($params);

        //发送数据到统一下单API地址b
        $data = $this -> curlRequest(config('pay.UOURL') , $xml);

        $arr = $this -> XmlToArr($data);
//        dd($arr);
        if(!isset($arr['result_code'])){

            return false;

        }

        if($arr['result_code'] == 'SUCCESS' && $arr['return_code'] == 'SUCCESS'){

            return $arr;
        }else{

            file_put_contents('logs/error.txt' , print_r($arr , true) , FILE_APPEND);
            return false;
        }
    }

    /**
     * 获取关键字
     * @param $data
     * @return mixed
     */
    public function getKeyword($data)
    {

        if(isset($data)) {
            //dd($data);
            foreach ($data as $k => $v) {
                //echo $v -> class_id;die;
                $key = explode(',' , $v -> class_id);
                //dd($key);
                $data[$k] -> keyword = DB::table('mz_class') -> whereIn('id', $key)
                    -> select('id', 'name')
                    -> get();

                $data[$k] -> crea_at = date('Y-m-d', $v -> crea_at);       //转换时间
            }
        }
        return $data;
    }

    /**
     * 时间戳转化为日期
     * @param $time
     * @return false|string
     */
    public function getDate($time){

        return date('Y-m-d' , $time);

    }

    /**
     * 验证登陆没有登陆
     * @param $token
     * @return string
     */
    protected function checkLogin($token)
    {
        $data = '';

        if($token == "") {
            return $data;
        }else{
            $data = Redis::get($token);

            if(!$data){
                return $data;
            }else{
                return $data;
            }
        }
    }

    //获取ip地址
     protected function get_ip(){
         if (isset($_SERVER)) {
             if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                 $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
             } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                 $realip = $_SERVER['HTTP_CLIENT_IP'];
             } else {
                 $realip = $_SERVER['REMOTE_ADDR'];
             }
         } else {
             if (getenv("HTTP_X_FORWARDED_FOR")) {
                 $realip = getenv( "HTTP_X_FORWARDED_FOR");
             } elseif (getenv("HTTP_CLIENT_IP")) {
                 $realip = getenv("HTTP_CLIENT_IP");
             } else {
                 $realip = getenv("REMOTE_ADDR");
             }
         }
         return $realip;
     }

     //百度ip接口
     protected function get_city()
     {
         $ip = $this -> get_ip();
         $ak = self::$ak;
         $url = file_get_contents("https://api.map.baidu.com/location/ip?ak=$ak&ip=$ip&coor=bd09ll");
         $res1 = json_decode($url,true);
         $data =$res1;
         if ($data) {
             return $data;
         } else {
             return $data;
         }
     }

     /**
      * @验证参数
      * @param $data
      */
     protected function isEmpty($data, $msg)
     {
         if(empty($data)){
             throw new ApiException($msg);
         }
     }

    /**
     * @ json转数组
     * @param $json
     * @return mixed
     */
     protected function jsonToArr($json)
     {
         return json_decode($json, true);
     }

    /**
     * @通过Session取出用户id
     * @return mixed
     */
     protected function getSessionUserId()
     {
         //取出用户ID
         return Session::get('users')['id'];
     }


}
