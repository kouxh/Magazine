<?php

namespace App\Http\Controllers\BusinessLogic\Order;

use Couchbase\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BusinessLogic\Order\Order;
use App\Http\Controllers\BusinessLogic\Order\Comput;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ApiException;
use App\Model\CartModel;
use App\Model\PeriodsModel;
use App\Model\OrderDescModel;
use App\Model\MagazineModel;
use App\Model\AddressModel;

/**
 * @杂志订单
 * Class MagazineOrder
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class MagazineOrder extends Order implements Comput
{
    //创建订单
    public function creaOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        $orderNum = self::$orderNum;    //获取订单号
        $this -> isEmpty($data['json'], '传入不是杂志订单参数，“json”');
        $this -> isEmpty($data['addID'], '传入不是杂志订单参数，“addID”');
        //dd($data['addID']);
        $arr = $this -> JsonToArr($data['json']);

         $all_price = 0;                                         //定义总价钱
         $all_num = 0;                                           //定义总数量
         $res1 = 1;
         $res2 = 1;
        DB::beginTransaction();
        try{
            foreach ($arr as $k => $v){

                if(!empty($v['id'])){
                    //删除购物车的数据
                    $res4 = CartModel::where(['id' => $v['id']]) -> update(['status' => 2]);
                }

                /*判断用户购买的是平装 还是电子装*/
                if($v['type'] == 1){
                    $column = 'electronics';
                }else{
                    $column = 'flat';
                }

                if(!empty($v['pid'])){

                    $arr = PeriodsModel::where('id' , $v['pid'])
                        -> select('id' , 'money', 'delivery_frequency')
                        -> first();
                    //dd($arr);
                    $all_price +=  $arr -> money * $v['num'];                          //计算总价钱
                    $all_num += $v['num'];                                              //计算总数量
                    $meal = 1;

                    $res1 = OrderDescModel::insert(['order_num' => $orderNum , 'p_id' => $arr -> id , 'uid' => $uid, 'price' => $arr -> money , 'should_delivered' => $arr -> delivery_frequency, 'type' => $v['type'] , 'num' => $v['num']]);

                }else if(!empty($v['mid'])){

                    /*查询用户购买哪些杂志*/
                    $arr = MagazineModel::where('m_id' , $v['mid'])
                        -> select('m_id' , $column )
                        -> first();

                    $all_price += $arr -> $column * $v['num'];                          //计算总价钱
                    $all_num += $v['num'];                                            //计算总数量
                    $meal = 2;

                    /*添加到订单详情*/
                    $res1 = OrderDescModel::insert(['order_num' => $orderNum , 'm_id' => $arr -> m_id , 'uid' => $uid, 'price' => $arr -> $column , 'type' => $v['type'] , 'num' => $v['num']]);

                    /*减少库存*/
                    $res2 = magazineModel::where(['m_id' => $v['mid']]) -> where('num' , '>=' , $v['num']) -> decrement('num' , $v['num']);
                }
            }

            /*设置订单过期时间*/
            $end_at = strtotime('+0.5 hours' );

            /*添加到总订单*/
            $res3 = $this -> InsertBigOrder(['order_num' => $orderNum , 'uid' => $uid , 'all_price' => $all_price , 'all_num' => $all_num , '_class' => 1 , 'crea_at' => time(),
                'invoice' => $data['invoice'], 'addID' => $data['addID'], 'remarksMsg'=> $data['remarksMsg'], 'end_at' => $end_at, 'meal' => $meal]);

            if($res1 != 0 && $res2 != 0 && $res3 != 0){

                DB::commit();
                return $this -> resultHandler('创建订单成功' , true , $orderNum , 10000);

            }else{

                throw new ApiException('加入失败。。。');
            }

        }catch (Exception $e){

            DB::rollback();

            throw new ApiException( $this -> $e);

        };

    }

    //订单列表
    public function listOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        try {
            //查询用户购买的所有杂志订单
            $data = $this -> formOrderNum($uid, $data['type'], $data['status']);
            //查询详情
            $desc = OrderDescModel::SelectOrderDesc($uid);
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
