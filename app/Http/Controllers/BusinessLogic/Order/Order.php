<?php

namespace App\Http\Controllers\BusinessLogic\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Service\BaseController;
use App\Model\OrderModel;
use App\Model\AddressModel;


/**
 * @总订单
 * Class Order
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class Order extends CommonController
{

    /**
     * @添加到大订单
     * @param $data
     * @return mixed
     */
    protected function InsertBigOrder($data)
    {
        return OrderModel::insert($data);
    }

    /**
     * @转Json到数组
     * @param $json
     * @return mixed
     */
    protected function JsonToArr($json)
    {
        return json_decode($json , true);
    }

    /**
     * @判断数组是几维
     * @param $vDim
     * @return int
     */
    function getmaxdim($vDim)
    {
        if(!is_array($vDim)) return 0;
        else
        {
            $max1 = 0;
            foreach($vDim as $item1)
            {
                $t1 = $this->getmaxdim($item1);
                if( $t1 > $max1) $max1 = $t1;
            }
            return $max1 + 1;
        }
    }

    /**
     * @检测同一订单结束时间是否有效
     * @param $orderNum
     * @return bool
     */
    protected function CheckOrderAt($uid, $aid)
    {
        $order = OrderModel::where(['uid' => $uid, 'status' => 1]) -> select('end_at') -> first();
        if($order -> end_at < time()){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @查询订单
     * @param $uid
     * @param $_class
     * @return mixed
     */
    protected function formOrderNum($uid, $_class, $status)
    {
        return OrderModel::SelectOrder($uid, $_class, $status);
    }

    /**
     * @双循环拼接数据
     * @param $arr
     * @return array
     */
    protected function formOrderData($data, $desc)
    {
        foreach ($data as $key => $val){
            foreach ($desc as $k => $v){
                if($val['order_num'] == $v['order_num']){
                    $data[$key]['desc'][] = $v;
                }
                $data[$key]['crea_at'] = date('Y-m-d', $val['crea_at']);
                if($val['status'] == 1){
                    $data[$key]['status'] = '待支付';
                }elseif ($val['status'] == 2){
                    $data[$key]['status'] = '待发货';
                }elseif ($val['status'] == 3){
                    $data[$key]['status'] = '待收货';
                }elseif ($val['status'] == 4){
                    $data[$key]['status'] = '待评价';
                }elseif ($val['status'] == 5){
                    $data[$key]['status'] = '已完成';
                }elseif ($val['status'] == 6){
                    $data[$key]['status'] = '已过期';
                }
            }
        }
        return $data;
    }

    /**
     * @设置收货地址
     * @param $data
     * @return mixed
     */
    protected function setConsignee($data)
    {
        foreach ($data as $key => $val)
        {
            $data[$key]['addID'] = array(AddressModel::where('id', $val['addID']) -> select('consignee') -> first());
        }
        return $data;
    }
}
