<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

use Illuminate\Http\Request;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\UserModel;

/**
 * @ 创建(分享)回调
 * Class Notify
 * @package App\Http\Controllers\Applets\Forum\Pay\Operation
 */
class ShareNotify extends NotifyConfigure implements Comput
{
    public function establishNotify($arr, $data)
    {
        //修改总订单状态
        $this -> upTotalOrderStatus($arr, self::INGROUP);
        //修改用户在团中的支付状态
        $res = $this -> upGroupStatus($data -> uid, $arr['out_trade_no']);
        //获取VIP的详细信息
        $vipInfo = $this -> getVipDescInfo($arr);
        //计算VIP的过期时间
        $endTime = $this -> getOrderEndAt($vipInfo['time']);
//        dd($endTime);
//        //获取用户手机号
//        $userTell = $this -> getUserTell($data -> uid);
        //查询用户团其他团员
        $payLeagueMembe = $this -> getLeagueMembePayStatus($data -> uid);

        //判断团员是否支付全部支付成功，如果支付成功修改全部团员状态，否则全部不修改
        $res = $this -> checkGroupNum($payLeagueMembe);
        //判断支付人数
        if($res){
            //修改用户VIP权限，通知站内信
            //
            foreach ($payLeagueMembe as $val){
                $this -> upUserInfo($val -> G_uid, $data -> level, $endTime);
                $tell = $this -> getUserTell($val -> G_uid);
                $this -> addAppletsMail($tell);
            }
        }
        return true;
    }
}
