<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\UserModel;
use App\Model\ClassroomCommentModel;
use App\Model\SignUpModel;
use App\Model\CheckTellModel;
use App\Model\AddressModel;
use App\Model\InvoiceModel;
use App\Model\AppletsMailModel;

class User extends CheckParameter
{
    /**
     * @检测用户是否是VIP
     * @param Request $request
     * @return mixed
     */
    public function checkUserVip(Request $request)
    {
        $uid = $request -> uid;

        $userinfo = UserModel::where('id', $uid) -> select('is_vip') -> first();

        return $this -> Result('Success', true, $userinfo, '10000');
    }

    /**
     * @查询用户余额与积分
     * @param Request $request
     * @return mixed
     */
    public function getUserInfo(Request $request)
    {
        $uid = $request -> uid;

        $userinfo = UserModel::where('id', $uid) -> select('integral', 'balance') -> first();

        return $this -> Result('Success', true, $userinfo, '10000');
    }

    /**
     * @查询用户下的评论
     * @param Request $request
     * @return mixed
     */
    public function getUserComment(Request $request)
    {
        $uid = $request -> uid;

        $comment = ClassroomCommentModel::where('com_uid', $uid) -> select('com_id') -> get();

        //修改作者给用户回复的评论  修改为已读
        foreach ($comment as $key => $val){
            ClassroomCommentModel::where('com_pid', $val -> com_id) -> update(['com_show' => 0, 'com_up_at' => time()]);
        }

        $data = $this -> getUserCommlist($uid);

        return $this -> Result('Success', true, $data, '10000');
    }

    /**
     * @用户报名直播
     * @param Request $request
     * @return mixed
     */
    public function getUserSignUp(Request $request)
    {
        $uid = $request -> uid;
        $lid = $request -> lid;

        $data = SignUpModel::where(['l_id' => $lid, 'u_id' => $uid]) -> first();

        if($data){
            return $this -> Result('Success', true, ['msg' => '您已经报过名，敬请观看'], '10000');
        }

        $res = SignUpModel::insert(['l_id' => $lid, 'u_id' => $uid, 'crea_at' => time()]);

        if($res) {
            return $this -> Result('Success', true, ['msg' => '报名成功，敬请观看'], '10000');
        }else{
            return $this -> Result('Error', fasle, ['msg' => '报名失败，请稍后再试'], '10001');
        }
    }

    /**
     * @检测用户是否是vip
     * @param Request $request
     * @return mixed
     */
    public function checkTellIsVip(Request $request)
    {
        $tell = $request -> tell;

        $userData = UserModel::where('tell', $tell) -> select('is_vip', 'end_time') -> first();

        $tell = CheckTellModel::where(['t_tell' => $tell, 't_status' => 1]) -> select('t_crea_at') -> first();

        if(!empty($tell)){
            return $this -> Result('Error', false, ['msg' => '该手机号已被充值！无需充值'], '10001');
        }
        if(!empty($userData) && $userData -> is_vip != 0 && $userData -> end_time > time()){
            return $this -> Result('Error', false, ['msg' => '该手机号已是会员！无需充值'], '10001');
        }
        return $this -> Result('Success', true, ['msg' => '不是会员可以继续操作'], '10000');
    }

    /**
     * @购买VIP赠送杂志添加的地址
     * @param Request $request
     * @return mixed
     */
    public function insertAddressVip(Request $request)
    {
        $consignee = $request -> consignee;
        $tell = $request -> tell;
        $desc_address = $request -> desc_address;
        $uid = $request -> uid;
        $city = $request -> city;
        $area = $request -> area;
        $county = $request -> county;

        $res = AddressModel::insertGetId(['consignee' => $consignee, 'tell' => $tell,
                'desc_address' => $desc_address, 'u_id' => $uid, 'status' => 3,
                'county' => $county, 'city' => $city, 'area' => $area]);

        if($res){
            return $this -> Result('Success', true, ['msg' => '添加地址成功', 'id' => $res], '10000');
        }
        return $this -> Result('Error', false, ['msg' => '添加地址失败!您可以选择我的-收货地址-修改'], '10001');
    }

    /**
     * @购买VIP填写发票
     * @param Request $request
     * @return mixed
     */
    public function insertInvoiceVip(Request $request)
    {
        $in_company_name = $request -> in_company_name;
        $in_taxpayer_code = $request -> in_taxpayer_code;
        $in_email = $request -> in_email;
        $in_tell = $request -> in_tell;
        $in_name = $request -> in_name;
        $in_uid = $request -> in_uid;

        $res = InvoiceModel::insertGetId(['in_company_name' => $in_company_name, 'in_taxpayer_code' => $in_taxpayer_code,
            'in_email' => $in_email, 'in_tell' => $in_tell, 'in_name' => $in_name, 'in_uid' => $in_uid,
            'in_crea_at' => time()]);

        if($res){
            return $this -> Result('Success', true, ['msg' => '添加发票成功'], '10000');
        }

        return $this -> Result('Error', false, ['msg' => '添加发票失败!或 我的-发票-修改'], '10001');
    }

    /**
     * @我的展示发票信息
     * @param Request $request
     * @return mixed
     */
    public function getInvoiceApi(Request $request)
    {
        $uid = $request -> uid;

        $invoice = InvoiceModel::where('in_uid', $uid) -> select('id', 'in_company_name', 'in_taxpayer_code', 'in_email', 'in_tell', 'in_name')
            -> orderBy('in_crea_at', 'desc')
            -> first();
        return $this -> Result('Success', true, $invoice, '10000');
    }

    /**
     * @ 展示收货地址列表
     * @param Request $request
     * @return mixed
     */
    public function getAddressListApi(Request $request)
    {
        $uid = $request -> uid;

        $address = AddressModel::where('u_id', $uid)
            -> select('id', 'consignee', 'desc_address', 'tell', 'city', 'area', 'county')
            -> orderBy('crea_time', 'desc')
            -> get();

        return $this -> Result('Success', true, $address, '10000');

    }

    /**
     * @查询单条地址
     * @param Request $request
     * @return mixed
     */
    public function getOneAddressApi(Request $request)
    {
        $uid = $request -> uid;
        $aid = $request -> aid;
        $data = AddressModel::where(['u_id' => $uid, 'id' => $aid])
            -> select('consignee', 'desc_address', 'tell', 'city', 'area', 'county')
            -> first();
        return $this -> Result('Success', true, $data, '10000');
    }

    /**
     * @修改收货地址
     * @param Request $request
     * @return mixed
     */
    public function upAddressVip(Request $request)
    {
        $consignee = $request -> consignee;
        $tell = $request -> tell;
        $desc_address = $request -> desc_address;
        $aid = $request -> aid;
        $city = $request -> city;
        $area = $request -> area;
        $county = $request -> county;

        $res = AddressModel::where('id', $aid) -> update(['consignee' => $consignee, 'tell' => $tell, 'desc_address' => $desc_address
            ,'city' => $city, 'area' => $area, 'county' => $county, 'up_time' => time()]);

        if($res){
            return $this -> Result('Success', true, ['msg' => '修改成功', 'aid' => $aid], '10000');
        }else{
            return $this -> Result('Success', false, ['msg' => '修改失败，请稍后再试'], '10000');
        }
    }

    /**
     * @修改VIP填写发票
     * @param Request $request
     * @return mixed
     */
    public function upInvoiceVip(Request $request)
    {
        $in_company_name = $request -> in_company_name;
        $in_taxpayer_code = $request -> in_taxpayer_code;
        $in_email = $request -> in_email;
        $in_tell = $request -> in_tell;
        $in_name = $request -> in_name;
        $in_id = $request -> in_id;

        $res = InvoiceModel::where('id', $in_id) -> update(['in_company_name' => $in_company_name, 'in_taxpayer_code' => $in_taxpayer_code,
            'in_email' => $in_email, 'in_tell' => $in_tell, 'in_name' => $in_name, 'in_up_at' => time()]);
        if($res){
            return $this -> Result('Success', true, ['msg' => '修改发票成功'], '10000');
        }
        return $this -> Result('Error', false, ['msg' => '修改发票失败!稍后再试'], '10001');
    }


    /**
     * @用户评论作者回复给用户的数量
     * @param Request $request
     * @return mixed
     */
    public function getReplyNumApi(Request $request)
    {
        $uid = $request -> uid;
        $comment = ClassroomCommentModel::where('com_uid', $uid) -> select('com_id') -> get();
        $i = 0;
        foreach ($comment as $key => $val){
            $data = ClassroomCommentModel::where(['com_pid' => $val -> com_id,'com_show' => 1, 'com_status' => 2]) -> select('com_id') -> first();
            if(isset($data -> com_id)){
                $i++;
            }
        }
        return $this -> Result('Success', true, ['num' => $i], '10000');
    }

    /**
     * @查询用户站内信是否有未读
     * @param Request $request
     * @return mixed
     */
    public function getPayMail(Request $request)
    {
        $uid = $request -> uid;
        $tell = $this -> getUserTell($uid);
        $num = AppletsMailModel::where(['am_tell' => $tell, 'am_status' => 1]) -> count();
        return $this -> Result('Success', true, ['num' => $num], '10000');
    }

    /**
     * @修改小程序站内信状态修改为已读
     * @param Request $request
     * @return mixed
     */
    public function upUserMailStatus(Request $request)
    {
        $uid = $request -> uid;
        $tell = $this -> getUserTell($uid);
        AppletsMailModel::where(['am_tell' => $tell]) -> update(['am_status' => 0]);
        return $this -> Result('Success', true, ['status' => '已读'], '10000');
    }

}
