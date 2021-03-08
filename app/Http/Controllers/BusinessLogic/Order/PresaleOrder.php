<?php

namespace App\Http\Controllers\BusinessLogic\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BusinessLogic\Order\Order;
use App\Model\PreModel;
use App\Model\OrderModel;
use App\Model\BookOrderModel;
use App\Model\PeriodsoOrderDescModel;
use App\Model\AddressModel;
use App\Exceptions\ApiException;
use \Exception;
/**
 * @预售订单
 * Class PresaleOrder
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class PresaleOrder extends Order implements Comput
{
    //创建订单
    public function creaOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        $orderNum = self::$orderNum;    //获取订单号

        $this -> isEmpty($data['bid'], '传入不是预售参数');
        $this -> isEmpty($data['addID'], '缺少收货地址');

        //查询书籍价钱
        $pre = PreModel::where('id', $data['bid']) -> select('price') -> first();

        try {
            $error = 'Please fill in the correct parameters "bid"';
            if(!empty($pre)){
                DB::beginTransaction();

                //添加到总订单
                $res = $this -> InsertBigOrder(['order_num' => $orderNum, 'uid' => $uid, 'all_price' => $pre -> price, 'all_num' => 1, '_class' => 3, 'crea_at' => time(),
                    'invoice' => $data['invoice'], 'addID' => $data['addID'], 'remarksMsg'=> $data['remarksMsg'], 'end_at' => time()]);

                //添加到书籍详情订单
                $res1 = BookOrderModel::insert(['order_num' => $orderNum, 'uid' => $uid, 'bid' => $data['bid'], 'num' => 1, 'price' => $pre -> price, 'crea_at' => time()]);

                if($res && $res1){
                    DB::commit();
                    return $this -> resultHandler('创建订单成功' , true , $orderNum , 10000);

                }else{
                    DB::rollback();
                    return $this -> resultHandler('创建订单失败' , false , $data = ['msg' => '生成订单错误，详情请咨询管理员'] , 10001);
                }
            }else{
                throw new Exception($error);
            }

        }catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        };
    }

    //订单列表
    public function listOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        try {
            //查询用户购买的所有预售订单
            $data = $this -> formOrderNum($uid, $data['type'], $data['status']);
            //查询订单详情
            $desc = PeriodsoOrderDescModel::SelectOrderDesc($uid);
            //拼接数据
            $data = $this -> formOrderData($data, $desc);
            //设置收货人地址
            $data = $this -> setConsignee($data);

            return $this -> resultHandler('查询订单成功' , true , $data , 10000);

        }catch (Exception $e){
            throw new ApiException( $this -> $e);
        }
    }
}
