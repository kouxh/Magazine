<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

use Illuminate\Http\Request;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\UserModel;

/**
 * @创建(一起付)回调
 * Class Notify
 * @package App\Http\Controllers\Applets\Forum\Pay\Operation
 */
class TogetherNotify extends NotifyConfigure implements Comput
{
    public function establishNotify($arr, $data)
    {
        //修改总订单状态
        $res = $this -> upTotalOrderStatus($arr, self::TOBEDELIVERED);
        //获取VIP的详细信息
        $vipInfo = $this -> getVipDescInfo($arr);
        //计算VIP的过期时间
        $endTime = $this -> getOrderEndAt($vipInfo['time']);
        //修改一起付手机号的状态
        $res1 = $this -> upUsersTell($arr);
        //获取支付成功之后的全部手机号
        $tellArr = $this -> getPaySuccessTell($arr);
        //一起付用户修改VIP权限，通知站内信
        $bool = $this -> operationTellArr($tellArr, $vipInfo -> id, $endTime);
        if($bool){
            return true;
        }
    }
}
