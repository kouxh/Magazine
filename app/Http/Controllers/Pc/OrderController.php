<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/6/10
 * Time: 16:58
 */
namespace App\Http\Controllers\Pc;

use App\Exceptions\ApiException;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Model\AddressModel;
use App\Model\OrderModel;
use App\Model\BookOrderModel;
use App\Model\OrderDescModel;
use App\Model\ArticleOrderDescModel;
use App\Model\VipOrderDescModel;
use App\Model\PeriodsoOrderDescModel;
use App\Model\PreModel;
use App\Model\MagazineModel;
use App\Http\Controllers\BusinessLogic\Order;
use App\Http\Controllers\BusinessLogic\Order\OperationFactory;

/**
 * Class OrderController
 * @package App\Http\Controllers\Pc
 */

class OrderController extends CommonController
{
    /**
     * @ 立即支付 重新生成订单号
     * @param Request $request
     * @return mixed
     */
    public function ImmediatePaymentApi(Request $request)
    {
        $orderNum = $request -> orderNum;

        $order_num = $this -> getCreaOreder(self::$uid);              //获取订单号

        $order = OrderModel::where('order_num', $orderNum) -> first();  //总订单

        if(empty($order)){
            throw new ApiException('订单号错误');
        }else{

            //判断总订单是什么订单
            if($order -> _class == 1){          //杂志订单
                $res = OrderModel::where('id', $order -> id) -> update(['order_num' => $order_num]);
                $res1 = OrderDescModel::where('order_num', $orderNum) -> update(['order_num' => $order_num]);
            }elseif ($order -> _class == 2){    //文章订单
                $res = OrderModel::where('id', $order -> id) -> update(['order_num' => $order_num]);
                $res1 = ArticleOrderDescModel::where('order_num', $orderNum) -> update(['order_num' => $order_num]);
            }elseif ($order -> _class == 3){    //VIP订单
                $res = OrderModel::where('id', $order -> id) -> update(['order_num' => $order_num]);
                $res1 = VipOrderDescModel::where('order_num', $orderNum) -> update(['order_num' => $order_num]);
            }elseif ($order -> _class == 4){    //预售订单
                $res = OrderModel::where('id', $order -> id) -> update(['order_num' => $order_num]);
                $res1 = PeriodsoOrderDescModel::where('order_num', $orderNum) -> update(['order_num' => $order_num]);
            }

            if($res1){
                return $this -> resultHandler('OK' , true , $data=['orderNum' => $order_num] , 10000);
            }else{
                return $this -> resultHandler('ERROR' , false , 0 , 10001);
            }
        }


    }

    /**
     * @新版生成订单
     * @param Request $request
     * @return mixed
     */
    public function CreaOrderApi(Request $request)
    {
        $data['type'] = $request -> type;
        $data['json'] = $request -> json;
        $data['remarksMsg'] = $request -> remarksMsg;
        $data['addID'] = $request -> addID;
        $data['invoice'] = $request -> invoice;
        $data['aid'] = $request -> aid;
        $data['mode'] = $request -> mode;
        $data['vid'] = $request -> vid;
        $data['bid'] = $request -> bid;

        $payMode = $request -> paymode;

//        //如果支付方式为1 余额支付  2 微信支付
//        if($payMode == 1){
//
//        }
        //dd($data);


        $obj = OperationFactory::CreateOperation($data['type']);
        $res = $obj -> creaOrder($data);
        return $res;
    }

    /**
     * @新版订单列表
     * @param Request $request
     * @return mixed
     */
    public function ListOrderApi(Request $request)
    {
        $data['type'] = empty($request -> type)? 1 : $request -> type;
        $data['mode'] = empty($request -> mode)? 1 : $request -> mode;
        $data['status'] = empty($request -> status)? 0 : $request -> status;

        $obj = OperationFactory::CreateOperation($data['type']);
        $res = $obj -> listOrder($data);
        return $res;

    }

}
