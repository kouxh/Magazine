<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\Base;
use App\Http\Controllers\Applets\Forum\Pay\Pay;
use App\Exceptions\ApiException;
use App\Model\VipOrderDescModel;
use App\Model\OrderModel;
use App\Model\UserModel;
use App\Model\AppletsMailModel;
use App\Model\CheckTellModel;
use App\Model\GroupModel;

/**
 * @支付回调配置
 * Class PayConfigure
 * @package App\Http\Controllers\Applets\Forum\Prepay
 */
class NotifyConfigure extends Base
{
    const TOBEDELIVERED = '2';   //待发货
    const INGROUP = '7';   //拼团中


    /**
     * @ 修改总订单的状态
     * @param $arr
     * @return mixed
     */
    protected function upTotalOrderStatus($arr, $status)
    {
        return OrderModel::where('order_num', $arr['out_trade_no'])
            -> update(['status' => $status, 'transaction_id' => $arr['transaction_id'], 'pay_at' => $arr['time_end']]);
    }

    /**
     * @ 计算VIP的过期时间
     * @param $vipInfo
     * @return false|int
     */
    protected function getOrderEndAt($time)
    {
        return strtotime('+' . $time . 'month');
    }

    /**
     * @ 查询订单详细信息
     * @param $arr
     * @return mixed
     */
    protected function getOrderDsecInfo($arr)
    {
        return VipOrderDescModel::where('order_num', $arr['out_trade_no'])
            -> join('mz_vip', 'mz_order_vip_describe.vid', '=', 'mz_vip.id', 'left')
            -> select('mz_vip.id', 'mz_vip.time', 'mz_order_vip_describe.uid', 'mz_order_vip_describe.order_num')
            -> first();
    }

    /**
     * @ 获取VIP的详细信息
     * @param $arr
     * @return mixed
     */
    protected function getVipDescInfo($arr)
    {
        return VipOrderDescModel::where('order_num', $arr['out_trade_no'])
            -> join('mz_vip', 'mz_order_vip_describe.vid', '=', 'mz_vip.id', 'left')
            -> select('mz_vip.id', 'mz_vip.time', 'mz_order_vip_describe.uid', 'mz_order_vip_describe.order_num')
            -> first();
    }

    /**
     * @ 修改用户信息改为VIP
     * @param $uid
     * @param $vid
     * @param $endAt
     * @return mixed
     */
    protected function upUserInfo($uid, $vid, $endAt)
    {
        return UserModel::where('id', $uid)
            -> update(['is_vip' => $vid, 'start_time' => time(), 'end_time' => $endAt, 'up_time' => time()]);
    }

    /**
     * @ 修改一起付手机号的状态
     * @param $arr
     * @return mixed
     */
    protected function upUsersTell($arr)
    {
        return CheckTellModel::where('t_orderNum', $arr['out_trade_no'])
            -> update(['t_status' => 1]);
    }

    /**
     * @ 获取支付成功之后的全部手机号
     * @param $arr
     * @return mixed
     */
    protected function getPaySuccessTell($arr)
    {
        return CheckTellModel::where('t_orderNum', $arr['out_trade_no'])
            -> where('t_status', 1)
            -> select('t_tell')
            -> get();
    }

    /**
     * @ 一起付用户修改VIP权限，通知站内信
     * @param $tellArr
     * @param $vid
     * @param $endAt
     * @return bool
     */
    protected function operationTellArr($tellArr, $vid, $endAt)
    {
        foreach ($tellArr as $val){
            $user = UserModel::where('tell', $val -> t_tell) -> select('id') -> first();
            if(!empty($user)){
                //开通会员，添加站内信
                $this -> upUserInfo($user -> id, $vid, $endAt);
                $this -> addAppletsMail($val -> t_tell);
                return true;
            }
        }
    }

    /**
     * @ 获取用户tell
     * @param $tell
     * @return mixed
     */
    protected function getUserTellCode($uid)
    {
        return UserModel::where('id', $uid) -> select('tell') -> first();
    }

    /**
     * @ 购买会员成功通知站内信
     * @param $tell
     * @return mixed
     */
    protected function addAppletsMail($tell)
    {
        return AppletsMailModel::addAppletsMail($tell);
    }

    /**
     * @ 查询用户团其他团员
     * @param $uid
     * @return mixed
     */
    protected function getLeagueMembePayStatus($uid)
    {
        $G_groupCode = GroupModel::where('G_uid', $uid) -> select('G_groupCode') -> first();
        $payLeagueMembe = GroupModel::where('G_groupCode', $G_groupCode -> G_groupCode) -> where('G_status', 1) -> select('G_uid')-> get();
        return $payLeagueMembe;
    }

    /**
     * @ 检测团成员是否全部支付
     * @param $payLeagueMembe
     * @return bool
     */
    protected function checkGroupNum($payLeagueMembe)
    {
        if(count($payLeagueMembe) == 3){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @ 修改用户在团中的支付状态
     * @param $uid
     */
    protected function upGroupStatus($uid, $orderNum)
    {
        return GroupModel::where('G_uid', $uid) -> update(['G_status' => 1, 'G_upAt' => time(), 'G_orderNum' => $orderNum]);
    }
}