<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

use Illuminate\Http\Request;
use App\Http\Controllers\Applets\CheckParameter;

/**
 * @ 创建(单独购买)回调
 * Class Notify
 * @package App\Http\Controllers\Applets\Forum\Pay\Operation
 */
class AloneNotify extends NotifyConfigure implements Comput
{
    public function establishNotify($arr, $data)
    {
        //修改总订单状态
        $res = $this -> upTotalOrderStatus($arr, self::TOBEDELIVERED);
        //获取VIP的详细信息
        $vipInfo = $this -> getVipDescInfo($arr);
        //计算VIP的过期时间
        $endTime = $this -> getOrderEndAt($vipInfo['time']);
        //修改用户信息改为VIP会员
        $this -> upUserInfo($data -> uid, $vipInfo -> id, $endTime);
        //获取用户手机号
        $userTell = $this -> getUserTellCode($data -> uid);
        //购买成功之后通知站内信
        $res = $this -> addAppletsMail($userTell -> tell);
        if($res){
            return true;
        }
    }
}
