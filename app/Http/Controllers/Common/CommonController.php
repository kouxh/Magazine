<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/6/5
 * Time: 15:46
 */
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Service\BaseController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Service\Wechat;
use Illuminate\Support\Facades\DB;
use App\Model\FollowModel;
use App\Model\AddressModel;
use Illuminate\Support\Facades\Redis;
use App\Exceptions\ApiException;
use App\Model\HeaderModel;
use App\Model\OrderModel;
use App\Model\BookOrderModel;

class CommonController extends BaseController
{
    static protected $uid = '';
    static protected $header = [];
    static protected $isMobile = 0;
    static protected $orderNum = 0;

    /**
     * 构造方法检测是否登陆
     * CommonController constructor.
     */
    public function __construct()
    {

        $this->middleware(function ($request, $next) {

           self::$header = HeaderModel::getHeaderInfo();

            if (!Session::get('users')) {
                return redirect('/loadLogin');

            } else {
                self::$uid = Session::get('users')['id'];
                self::$orderNum = $this -> getCreaOreder(self::$uid);
            }

            #判断是否是移动设备
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile')) {
                self::$isMobile = 1;
            }

            return $next($request);
        });

    }

    /**
     * 生成订单号
     * @param $id
     * @return order_unm
     */
    public  function getCreaOreder($id)
    {
        $date = date('YmdHis' , time());
        $num = rand(000000000 , 999999999);
        $str = $date . $id . $num;
        return substr($str, 0,24);

    }

    /**
     * 解析json串
     * @param type $json_str
     * @return type
     */
    public function analyJson($json_str)
    {
        $json_str = str_replace('\\', '', $json_str);
        $out_arr = array();
        preg_match('/{.*}/', $json_str, $out_arr);
        if (!empty($out_arr)) {
            $result = json_decode(json_encode($out_arr[0]), true);
        }else{
            return false;
        }
        return $result;
    }



    /**
     * 订单列表
     * @param $status
     * @param $start
     * @param $end
     * @return mixed
     */
    protected function OrderDesc($status , $start , $end)
    {

        if($status == false && $start != false){

            $data = OrderModel::where('uid' , self::$uid)
                -> whereBetween('crea_at' , [$start , $end])
                -> select('id', 'order_num' , 'addID' , 'status' , '_class', 'all_price' , 'crea_at', 'remarksMsg', 'invoice')
                -> orderBy('crea_at' , 'desc')
                -> get();

        }elseif ($status != false){

            $data = OrderModel::where('uid' , self::$uid)
                -> where('status' , $status)
                -> select('id', 'order_num' , 'addID' , 'status' , '_class', 'all_price' , 'crea_at', 'remarksMsg', 'invoice')
                -> orderBy('crea_at' , 'desc')
                -> get();

        }elseif ($status == false && $start == false && $end == false){

            $data = OrderModel::where('uid' , self::$uid)
                -> select('id', 'order_num' , 'addID' , 'status' , '_class',  'all_price' , 'crea_at', 'remarksMsg', 'invoice')
                -> orderBy('crea_at' , 'desc')
                -> get();

        }

        foreach ($data as $k => $v){

            switch ($v -> status){
                case '1':
                    $data[$k] -> status = '待支付';
                    break;
                case '2':
                    $data[$k] -> status = '待发货';
                    break;
                case '3':
                    $data[$k] -> status = '待收货';
                    break;
                case '4':
                    $data[$k] -> status = '待评价';
                    break;
                case '5':
                    $data[$k] -> status = '已完成';
                    break;
                case '6':
                    $data[$k] -> status = '已过期';
                    break;
            };

            $address = AddressModel::where('id' , $v -> address) -> select('id', 'consignee') -> first();        //收货地址

            //验证订单有没有地址
            if($address){
                $data[$k] -> address = $address -> consignee;
                $data[$k] -> add_id = $address -> id;
            }else{
                $data[$k] -> address = '';
                $data[$k] -> add_id = '';
            }

            //书籍订单
            if($v -> _class == 4){
                $data[$k] -> order_desc = BookOrderModel::where('order_num', $v -> order_num)
                    -> join('mz_pre' , 'mz_order_book_describe.bid', '=', 'mz_pre.id')
                    -> select('mz_pre.title', 'mz_pre.img', 'mz_pre.price', 'mz_order_book_describe.num',
                        'mz_order_book_describe.price')
                    -> get();

            }

            //杂志订单
            if($v -> _class == 1){
                $data[$k] -> order_desc = DB::table('mz_order_magazine_describe')
                    -> join('mz_magazine' , 'mz_order_magazine_describe.m_id' , '=' , 'mz_magazine.m_id' , 'left')
                    -> join('mz_periods' , 'mz_order_magazine_describe.p_id' , '=' , 'mz_periods.id' , 'left')
                    -> where('order_num' , $v -> order_num)
                    -> select('mz_periods.title as p_title', 'mz_periods.money as p_money', 'mz_periods.status as p_status',
                        'mz_magazine.m_id', 'mz_magazine.title', 'mz_magazine.cover_img as img', 'mz_order_magazine_describe.num',
                        'mz_order_magazine_describe.price', 'mz_order_magazine_describe.type', 'mz_magazine.flat')
                    -> get();

                foreach($data[$k] -> order_desc as $key => $val){           //处理套餐与杂志的title与money

                    if($val -> title == null){

                        $data[$k] -> order_desc[$key] -> title = $val -> p_title;
                        $data[$k] -> order_desc[$key] -> price = $val -> p_money;

                        unset($data[$k] -> order_desc[$key] -> p_title);
                        unset($data[$k] -> order_desc[$key] -> p_money);
                        unset($data[$k] -> order_desc[$key] -> p_status);

                    }else{

                        unset($data[$k] -> order_desc[$key] -> p_title);
                        unset($data[$k] -> order_desc[$key] -> p_money);
                        unset($data[$k] -> order_desc[$key] -> p_status);

                    }
                    $data[$k] -> order_desc[$key] -> subtotal = $val -> num * $val -> price;        //小订单的 小计；

                }
            }

            $data[$k] -> crea_at = date('Y-m-d' , $v -> crea_at);       //转换时间
        }

        return $data;
    }
}
