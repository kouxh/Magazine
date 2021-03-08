<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\OrderModel;
use App\Model\UserModel;
use App\Model\VipOrderDescModel;

class Order extends CheckParameter
{
    /**
     * @我的 - 订单列表
     * @param Request $request
     * @return mixed
     */
    public function getOrderList(Request $request)
    {
        $uid = $request -> uid;

        $users = UserModel::where(['id' => $uid]) -> select('start_time', 'end_time') -> first();

        $order = OrderModel::appletsGetUserOrderList($uid);

        $order_num = [];
        foreach ($order as $key => $val){
            if($val -> status == 1){
                $order[$key] -> status = '已过期';
            }else if($val -> status == 2){
                $order[$key] -> status = '已完成';
            }

            $order_num[] = $val -> order_num;
        }

        $orderDesc = VipOrderDescModel::AppletsGetUserOrderList($order_num);

        foreach ($orderDesc as $key => $val){
            foreach ($order as $k => $v){
                if($val -> order_num == $v -> order_num){
                    if(strtotime('+1 year', $v -> crea_at) < time()){
                        $orderDesc[$key] -> addID = 1;
                        $orderDesc[$key] -> invoice = 1;
                    }else{
                        $orderDesc[$key] -> status = $v -> status;
                        $orderDesc[$key] -> addID = $v -> addID;
                        $orderDesc[$key] -> invoice = $v -> invoice;
                    }

                }
            }
            $orderDesc[$key] -> start_time = date('Y-m/d', $users -> start_time);
            $orderDesc[$key] -> end_time = date('Y-m/d', $users -> end_time);
        }
        return $this -> Result('Success', true, $orderDesc, 10000);
    }

    /**
     * @分享成团订单添加收货地址
     * @param Request $request
     * @return mixed
     */
    public function orderAddressApi(Request $request)
    {
        $orderNum = $request -> orderNum;
        $aid = $request -> aid;
        $uid = $request -> uid;

        $addID = OrderModel::where('order_num', $orderNum) -> select('addID', 'crea_at') -> first();

        if(!empty($addID)){
            if(strtotime('+1 year', $addID -> crea_at) < time()){
                return $this -> Result('ERROR', false, ['msg' => '订单超时！已过领取时间'], 10001);
            }
            if($addID -> addID == 0){
                $res = OrderModel::where(['order_num' => $orderNum, 'uid' => $uid]) -> update(['addID' => $aid]);
                if($res){
                    return $this -> Result('Success', true, ['msg' => '订单绑定收货地址成功'], 10000);
                }
            }
            return $this -> Result('ERROR', false, ['msg' => '订单绑定收货地址失败或已添加'], 10001);
        }
    }

    /**
     * @分享成团订单添加发票信息
     * @param Request $request
     * @return mixed
     */
    public function orderInvoiceApi(Request $request)
    {
        $orderNum = $request -> orderNum;
        $iid = $request -> iid;
        $uid = $request -> uid;

        $addID = OrderModel::where('order_num', $orderNum) -> select('invoice', 'crea_at') -> first();
        if(!empty($addID)){
            if(strtotime('+1 year', $addID -> crea_at) < time()){
                return $this -> Result('ERROR', false, ['msg' => '订单超时！已过开票时间'], 10001);
            }
            if($addID -> addID == 0){
                $res = OrderModel::where(['order_num' => $orderNum, 'uid' => $uid]) -> update(['invoice' => $iid]);
                if($res){
                    return $this -> Result('Success', true, ['msg' => '订单绑定发票成功'], 10000);
                }
            }
            return $this -> Result('ERROR', false, ['msg' => '订单绑定发票失败或已添加'], 10001);
        }
    }
}
