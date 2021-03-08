<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2020/07/24
 * Time: 10:20
 */
namespace App\Http\Controllers\Applets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FollowModel;
use App\Model\UserModel;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;


class Base extends Controller
{
    /**
     * @统一的返回的方法
     * @param string $msg
     * @param bool $bool
     * @param array $data
     * @param int $code
     * @return mixed
     */
    protected function Result( $msg = '操作成功', $bool = true, $data = [], $code = 200)
    {
        $data = [
            'err_msg'=> $msg,
            'err_code'=> $code,
            'bol'=> $bool,
            'data'=> $data,
        ];

        return response() -> json($data);
    }

    /**
     * @json对象转数组
     * @param $json
     * @return mixed
     */
    protected function jsonToArr($json)
    {
        return json_decode($json, true);
    }

    /**
     * @随机字符串
     * @param $length
     * @return string|null
     */
    protected function getRandChar($length)
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
     * @统一生成TOKEN
     * @return string
     */
    protected function createToken()
    {
        $str = self:: getRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        return md5($str . $timestamp . time());

    }

    /**
     * @生成自定义签名
     * @param $arr
     * @return string
     */
    public function getCustomSign($arr)
    {
        //去除数组的空值
        array_filter($arr);
        //取出sign
        if(isset($arr['sign'])){
            unset($arr['sign']);
        }
        //排序
        ksort($arr);

        //将字符串进行URL_INCODE
        $str = $this -> arrToUrl($arr);

        return strtoupper(md5($str));
    }

    /**
     * @获取订单号
     * @param $id
     * @return order_unm
     */
    public  function getOrederNum($id)
    {
        $date = date('YmdHis' , time());
        $num = rand(000000000 , 999999999);
        $str = $date . $id . $num;
        return substr($str, 0,16);

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
        $str = $this->arrToUrl($arr) . '&key=' . config('appletsCmasPay.KEY');
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

        //数组转xml
        $xml = $this -> ArrToXml($params);

        //发送数据到统一下单API地址b
        $data = $this -> curlRequest(config('appletsCmasPay.UOURL') , $xml);

        $arr = $this -> XmlToArr($data);

        if(!isset($arr['result_code'])){

            return false;

        }

        if($arr['result_code'] == 'SUCCESS' && $arr['return_code'] == 'SUCCESS'){

            return $arr;
        }else{
            return $arr['err_code_des'];
        }
    }

    /**
     * @获取用户手机号
     * @param $uid
     * @return int
     */
    public function getUserTell($uid)
    {
        $res = UserModel::where('id', $uid) -> select('tell') -> first();
        if($res){
            return $res -> tell;
        }
        return 0;
    }

    /**
     * @ 随机生成成团号
     * @return string
     */
    public function establishGroupCode()
    {
        $randStr = self::getRandChar(6);
        return $randStr.time();
    }

    /**
     * @ 退款接口请求
     * @param $url
     * @param $postfields
     * @return bool|string
     */
    protected function refundRequest($url,$postfields){

        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = false; //是否返回响应头信息
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
        $params[CURLOPT_POST] = true;
        $params[CURLOPT_POSTFIELDS] = $postfields;
        $params[CURLOPT_SSL_VERIFYPEER] = false;
        $params[CURLOPT_SSL_VERIFYHOST] = false;
        //以下是证书相关代码
        $params[CURLOPT_SSLCERTTYPE] = 'PEM';
        $params[CURLOPT_SSLCERT] = '/opt/Wechat/wechat_cert.pem';
        $params[CURLOPT_SSLKEYTYPE] = 'PEM';
        $params[CURLOPT_SSLKEY] = '/opt/Wechat/wechat_key.pem';

        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }
    
}


