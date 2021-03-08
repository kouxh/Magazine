<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\GroupModel;
use App\Model\OrderModel;
use App\Http\Controllers\Applets\Forum\Pay\Refund;
class Group extends CheckParameter
{
    /**
     * @检测用户是否在拼团列表中
     * @param Request $request
     * @return mixed
     */
    public function checkUserInGroup(Request $request)
    {
        $uid = $request -> uid;
        //获取用户在团中信息
        $data = GroupModel::where('G_uid', $uid) -> select('G_status', 'G_groupEndAt', 'G_groupCode') -> first();

        if(isset($data)){
            return $this -> Result('Success', true, ['msg' => '拼团详情', 'groupCode' => $data -> G_groupCode], 10047);
        }
        return $this -> Result('Success', true, ['msg' => '可以发起拼团'], 10048);
    }

    /**
     * @ 分享页面详情显示数据
     * @param Request $request
     * @return mixed
     */
    public function sharePageShow(Request $request)
    {
        //显示成团列表用户
        //显示按钮是支付还是分享
        $uid = $request -> uid;
        $groupCode = $request -> groupCode;

        //团成员
        $member = GroupModel::getGroupCodeUser($groupCode);
        //团信息
        $groupInfo = GroupModel::where('G_groupCode', $groupCode) -> select('G_groupEndAt', 'G_groupCode') -> first();
        //查询用户在团中信息
        $userInfo = GroupModel::where('G_uid', $uid) -> select('G_status', 'G_groupEndAt', 'G_groupCode') -> first();

        $groupUser = GroupModel::where('G_groupCode', $groupCode) -> select('G_status','G_orderNum') -> get();
        
        //团过期
        if(isset($groupInfo) && $groupInfo -> G_groupEndAt < time()){
            //调用退款接口
            foreach ($groupUser as $val){
                $orderNum = OrderModel::where(['order_num' => $val -> G_orderNum, 'level' => 4]) -> select('order_num', 'all_price') -> first();
                $this -> refundApi($groupInfo -> G_groupCode, $orderNum -> order_num, $orderNum -> all_price);
            }
            return $this -> Result('Error', true, ['msg' => '拼团失败', 'member' => $member, 'groupEndAT' => $groupInfo -> G_groupEndAt], 10001);
        }

        if(isset($userInfo)){

            if($userInfo -> G_status == 2){
                GroupModel::where('G_uid', $uid) -> where('G_status', 2) -> delete();
            }

            //拼团成功
            if(count($member) == 3){
                return $this -> Result('Success', true, ['msg' => '拼团成功', 'member' => $member, 'groupEndAT' => $groupInfo -> G_groupEndAt], 10000);
            }

            if($userInfo -> G_status == 1){
                return $this -> Result('Success', true, ['msg' => '分享', 'member' => $member, 'groupEndAT' => $groupInfo -> G_groupEndAt], 10002);
            }else{
                return $this -> Result('Error', true, ['msg' => '支付', 'member' => $member, 'groupEndAT' => $groupInfo -> G_groupEndAt], 10003);
            }
        }else if(!isset($userInfo)){
            GroupModel::insert(['G_uid' => $uid, 'G_groupCode' => $groupCode, 'G_groupEndAt' => $groupInfo -> G_groupEndAt, 'G_creaAt' => time()]);
            return $this -> Result('Success', true, ['msg' => '绑定成功', 'member' => $member, 'groupEndAT' => $groupInfo -> G_groupEndAt], 10004);
        }
    }


    /**
     * @ 点击支付 --- 查询团是否满员
     * @param Request $request
     * @return mixed
     */
    public function getPayStatus(Request $request)
    {
        $uid = $request -> uid;
        $groupCode = $request -> groupCode;

        //获取用户在团中信息
        $groupUser = GroupModel::where('G_uid', $uid) -> select('G_status', 'G_groupEndAt', 'G_groupCode') -> first();
        //查询团号下其他支付的用户
        $uidArr = GroupModel::where('G_groupCode', $groupCode) -> where('G_status', 1) -> select('G_uid') -> count();

        if(isset($groupUser)){
            if($groupUser -> G_status == 2 && $uidArr < 3){
                return $this -> Result('Success', true, ['msg' => '可以发起支付'], 10000);
            }
        }
        GroupModel::where('G_uid', $uid) -> where('G_status', 2) -> delete();
        return $this -> Result('Error', false, ['msg' => '参数错误！或团已经满员'], 10001);
    }

    /**
     * @ 退款接口
     * @param $groupCode
     * @param $ordernum
     * @param $money
     */
    public function refundApi($groupCode, $ordernum, $money)
    {
        $arr = (new Refund) -> refundApi($ordernum, $money);
        if($arr['return_code'] == 'SUCCESS'){
            //删除团成员
            GroupModel::where('G_groupCode', $groupCode) -> delete();
            //修改订单状态
            OrderModel::where('order_num', $ordernum) -> update(['status' => 9]);
        }
    }

    public function tuikuan(Request $request)
    {
        $groupCode =  $request -> groupCode;
        $ordernum =  $request -> ordernum;
        $money =  $request -> money;

        $arr = (new Refund) -> refundApi($ordernum, $money);
        dd($arr);
        if($arr['return_code'] == 'SUCCESS'){
            //删除团成员
            GroupModel::where('G_groupCode', $groupCode) -> delete();
            //修改订单状态
            OrderModel::where('order_num', $ordernum) -> update(['status' => 9]);
        }
    }
}
