<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\OrderModel;
use App\Model\InvoiceModel;
use App\Model\AddressModel;
use App\Model\MealModel;
use App\Model\OrderDescModel;
use App\Http\Controllers\Service\StationEmail;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

/**
 * 套餐订单
 * Class Ordel
 * @package App\Http\Controllers\Home
 */
class Meal extends BaseController
{
    /**
     * @加载套餐订单列表
     * @return string
     */
    public function mealList()
    {
        return view('/Home/Meal/list');
    }

    /**
     * @ 套餐订单分页列表
     * @param Request $request
     * @return mixed
     */
    public function mealPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = OrderModel::HomeMealOrderList($page, $limit);
        $count = OrderModel::HomeMealOrderCount();

        foreach($data as $k => $v)
        {

            $data[$k] -> crea_at = date("Y-m-d H:i:s", $v -> crea_at);

            if($v -> status == 1){
                $data[$k] -> status = '待支付';
            }elseif ($v -> status == 2){
                $data[$k] -> status = '待发货';
            }elseif ($v -> status == 3){
                $data[$k] -> status = '待收货';
            }elseif ($v -> status == 4){
                $data[$k] -> status = '待评价';
            }elseif ($v -> status == 6){
                $data[$k] -> status = '已过期';
            }

        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @套餐发货接口
     * @param Request $request
     * @return mixed
     */
    public function mealDeliverGoods(Request $request)
    {
        $id = $request -> id;
        $logistics_code = $request -> logistics_code;
        $express = $request -> express;
        $order = OrderModel::where('id', $id) -> select('uid', 'order_num') -> first();
        $orderDesc = OrderDescModel::where('order_num', $order -> order_num) -> select('should_delivered') -> first();
        if(empty($order)){
            return $this -> resultHandler('订单号错误' , false ,0 , 10001);
        }

        $meal = MealModel::meaLogisticsFirst($order -> order_num);

        if(!$meal){
            $num = 1;
        }else{
            $num = $meal -> num + 1;
        }

        if($num > $orderDesc -> should_delivered ){
            return $this -> resultHandler('发货次数超过规定次数' , false ,0 , 10001);
        }

        $res = OrderModel::where('id', $id)
            -> update(['status' => 3, 'logistics_code' => $logistics_code, 'express' => $express]);

        $res1 = MealModel::insert(['order_num' => $order -> order_num, 'num' => $num, 'logistics_code' => $logistics_code, 'express' => $express]);


        $res2 = OrderDescModel::where('order_num', $order -> order_num) -> update(['Alr_delivery' => $num]);

        if($res & $res1 & $res2) {
            $res = StationEmail::AddStationEmail($order->uid, '您的订单已发货！单号：'.$logistics_code.'感谢购买我们产品', 0);
            if ($res) {
                return $this->resultHandler('发货成功', true, $res, 10000);
            }
        }
        return $this -> resultHandler('发货失败' , false ,0 , 10001);


    }
}