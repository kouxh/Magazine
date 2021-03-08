<?php

namespace App\Http\Controllers\Pc;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Service\PublicColumn;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use App\Model\UserModel;
use App\Model\ArticleOrderDescModel;
use App\Model\CartModel;
use App\Model\MessageModel;
use App\Model\AddressModel;
use App\Model\IntegralModel;
use App\Model\OrderDescModel;
use App\Model\OrderModel;
use App\Model\ArticleModel;
use App\Model\ManuscriptModel;
use App\Model\CollectionModel;
use App\Model\StationEmailModel;
use App\Model\InvoiceModel;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Service\Logistics;

/**
 * @ 个人中心API
 * Class User_ApiController
 * @package App\Http\Controllers\Pc
 */
class User_ApiController extends CommonController
{

    /**
     * @ 我的订单
     * @param Request $request
     */
    public function orderApi(Request $request)
    {
        $status = empty($request->status) ? 0 : $request->status;

        $keyword = $request -> keyword;

        $arr = [1, 2, 3, 4, 5];

        if ($status && !in_array($status, $arr)) {

            throw new ApiException('参数错误1');

        }

        if($status && $keyword){

            throw new ApiException('参数错误2');
        }

        $arr1 = [100, 101];
        if ($keyword && !in_array($keyword, $arr1)) {

            throw new ApiException('参数错误3');

        }

        if($keyword == '100' && !$status){                        #显示全部
            $end = 0;
            $start = 0;
        }else if($keyword == '101' && !$status){                  #显示三个月内订单
            $end = time();
            $start = strtotime("-0 year -3 month -0 day");
        }else{                                                    #显示状态下订单
            $end = 0;
            $start = 0;
        }

        $data = $this -> OrderDesc($status, $start, $end);
        //dd($data);
        return $this->resultHandler('成功', true, $data, 10000);

    }

    /**
     * @ 取消订单
     * @param Request $request
     * @return mixed
     */
    public function cancelOrder(Request $request)
    {
        $orderNum = $request -> orderNum;

        if(!is_numeric($orderNum)){

            throw new ApiException('参数错误。。。');
        }

        $res = orderModel::where('order_num', $orderNum) -> delete();

        $res1 = OrderDescModel::where('order_num', $orderNum) -> delete();

        if($res && $res1){
            return $this -> resultHandler('取消成功', true, $res, 10000);
        } else {
            return $this -> resultHandler('取消失败!可能没有该订单', false, $res, 10001);
        }
    }

    /**
     * @ 修改用户信息
     * @param Request $request
     */
    public function upUserInfoApi(Request $request)
    {
        $data = $this -> jsonToArr($request -> info);

        $res = UserModel::where('id', self::$uid) ->  update($data);

        if ($res) {
            return $this->resultHandler('提交成功', true, $res, 10000);
        } else {
            return $this->resultHandler('提交失败', false, $res, 10001);
        }
    }

    /**
     * @ 修改密码
     * @param Request $request
     */
    public function upPasswordApi(Request $request)
    {
        $usepwd = $request -> usedpwd;
        $newpwd = $request -> newpwd;

        if(empty($usepwd) || empty($newpwd)){

            throw new ApiException('参数错误。。。');

        }

        $info = UserModel::where('id', self::$uid) -> where('pwd', md5($usepwd)) -> first();

        if($info == null){
            throw new ApiException('旧密码错误');
        }

        if( 4 > strlen($newpwd) || strlen($newpwd) > 8 ){
            throw new ApiException('新密码格式错误');
        }

        $res = UserModel::where('id', self::$uid) -> update(['pwd' => md5($newpwd), 'up_time' => time()]);

        if($res){
            return $this -> resultHandler('修改成功！请牢记新密码', true, $res, 10000);
        }else{
            return $this -> resultHandler('修改失败', true, $res, 10001);
        }
    }

    /**
     * @ 修改头像
     * @param Request $request
     * @return mixed
     */
    public function upUserPhotoApi(Request $request)
    {
        $photo = $request -> photo;

        if(empty($photo)){
            throw new ApiException('缺少参数');
        }

        if(!strpos($photo, 'upload')){
            throw new ApiException('参数错误');
        }

        $res = UserModel::where('id', self::$uid) -> update(['photo' => $photo, 'up_time' => time()]);

        if($res){
            return $this -> resultHandler('修改成功!', true, $res, 10000);
        }else{
            return $this -> resultHandler('修改失败!', false, 0, 10001);
        }

    }
//    /**
//     * @ 我的留言
//     * @param Request $request
//     */
//   public function myMessageApi(Request $request)
//   {
//        $data = MessageModel::join('mz_article', 'mz_message.ac_id', '=', 'mz_article.id')
//                -> join('mz_users', 'mz_message.u_id', '=', 'mz_users.id')
//                -> where('mz_users.id', self::$uid)
//                -> select('mz_message.id as id', 'mz_message.content', 'mz_message.status', 'mz_message.crea_at', 'mz_article.id as aid', 'mz_article.title', 'mz_users.id as uid')
//                -> get();
//
//        foreach($data as $k => $v){
//            if($v -> status == 1){
//                $data[$k] -> status = '已审核';
//            }else{
//                $data[$k] -> status = '未审核';
//            }
//
//            $data[$k] -> crea_at = date('Y-m-d H:i:s' , $v -> crea_at);
//        }
//
//       return $this -> resultHandler('查询成功', true, $data, 10000);
//
//
//   }

    /**
     * @ 删除留言
     * @param Request $request
     */
    public function delMessageApi(Request $request)
    {
        $id = $request -> id;

        if(empty($id)){
            throw new ApiException('参数错误。。。');
        }

        $res = MessageModel::where('id', $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功。。。' , true , $res , 10000);
        }else{
            return $this -> resultHandler('删除失败，请重新删除。。。' , false , $res , 10001);
        }
    }

    /**
     * @ 我的购物车
     * @param Request $request
     */
    public function myCartApi(Request $request)
    {
        $data = CartModel::getCartInfo(self::$uid);
        return $this -> resultHandler('查询成功', true, $data, 10000);

    }

    /**
     * @ 删除购物车
     * @param Request $request
     * @return mixed
     */
    public function delCartApi(Request $request)
    {
        $id = $request -> id;

        if(empty($id)){

            throw new ApiException('参数错误。。。');

        }

        $ArrId = explode(',' , $id);

        $res = DB::table('mz_cart') -> whereIn('id' , $ArrId) -> delete();

        if($res){
            return $this -> resultHandler('删除成功。。。' , true , $res , 10000);
        }else{
            return $this -> resultHandler('删除失败，请重新删除。。。' , false , $res , 10001);
        }
    }

    /**
     * @ 新建收货地址
     * @param Request $request
     * @return mixed
     */
    public function creaAddressApi(Request $request)
    {
        $uid = self::$uid;      //获取用户id

        $data['consignee'] = $request->consignee;
        $data['city'] = $request->city;
        $data['area'] = $request->area;
        $data['county'] = $request->county;
        $data['desc_address'] = $request->desc_address;
        $data['fixed_number'] = $request->fixed_number;
        $data['zip_code'] = $request->zip_code;
        $data['tell'] = $request->tell;
        $data['u_id'] = $uid;
        $data['crea_time'] = time();

        if (!empty($data['fixed_number'])) {

            if (!is_numeric($data['zip_code'])) {

                throw new ApiException('邮编格式不对。。。');

            }
        }
        if (!empty($data['tell'])) {

            if (!is_numeric($data['tell']) || strlen($data['tell']) != 11) {

                throw new ApiException('手机号格式不对。。。');

            }
        }


        if (empty($data['consignee'] && $data['city'] && $data['area'] && $data['county'] && $data['desc_address'] && $data['tell'])) {

            throw new ApiException('参数错误。。。a');

        } else {

            //验证是否是第一次创建地址,如果有值说明不是第一次创建则状态为0不默认，如果没值说明第一次创建状态值为1默认

            $addressInfo = AddressModel::where('u_id', self::$uid) -> select('id') -> get();

            //赋值状态
            if(count($addressInfo)){
                $data['status'] = 0;
            }else{
                $data['status'] = 1;
            }

            $res = AddressModel::insertGetId($data);

            if ($res) {
                return $this->resultHandler('新建成功', true, $data = ['addid' => $res], 10000);
            } else {
                return $this->resultHandler('新建失败', false, $res, 10001);

            }
        }
    }

    /**
     * @ 收货地址列表
     * @return mixed
     */
    public function listAddressApi(Request $request)
    {
        $data = AddressModel::where('u_id', self::$uid) -> select('id', 'consignee', 'city', 'area', 'status', 'county', 'desc_address', 'tell') -> get();

        return $this -> resultHandler('查询成功', true, $data, 10000);

    }

    /**
     * @ 收货地址编辑
     * @param Request $request
     * @return mixed
     */
    public function editAddressApi(Request $request)
    {
        $uid = self::$uid;      //获取用户id
        $id = $request -> id;
        $data['consignee'] = $request->consignee;
        $data['city'] = $request -> city;
        $data['area'] = $request -> area;
        $data['county'] = $request -> county;
        $data['desc_address'] = $request -> desc_address;
        $data['fixed_number'] = $request -> fixed_number;
        $data['zip_code'] = $request -> zip_code;
        $data['tell'] = $request -> tell;
        $data['u_id'] = $uid;
        $data['up_time'] = time();

        $res = AddressModel::where('id', $id) -> update($data);

        if($res) {
            return $this -> resultHandler('编辑成功', true, $res, 10000);
        }else{
            return $this -> resultHandler('编辑失败', true, $res, 10001);
        }


    }

    /**
     * @ 设置默认地址
     * @param Request $request
     * @return mixed
     */
    public function setAddressApi(Request $request)
    {
        $id = $request -> id;

        if(empty($id)){
            throw new ApiException('参数错误。。。');
        }

        $count = AddressModel::where('u_id', self::$uid) -> where('status', '!=', '0') -> first();

        if($count && $id == $count -> id){
            throw new ApiException('已经是默认，不需要修改');
        }else{
            AddressModel::where('id', $count -> id) -> update(['status' => 0, 'up_time' => time()]);
        }

        $res1 = AddressModel::where('id', $id) -> update(['status' => 1, 'up_time' => time()]);

        if($res1) {
            return $this -> resultHandler('修改成功', true, $res1, 10000);
        }else{
            return $this -> resultHandler('修改失败', true, $res1, 10001);
        }
    }

    /**
     * @ 删除收货地址
     * @param Request $request
     * @return mixed
     */
    public function delAddressApi(Request $request)
    {
        $id = $request -> id;

        if(empty($id)){
            throw new ApiException('参数错误。。。');
        }

        $res = AddressModel::where('id', $id) -> delete();

        if ($res) {
            return $this -> resultHandler('删除成功', true, $res, 10000);
        }else{
            return $this -> resultHandler('删除失败', true, $res, 10001);
        }
    }

    /**
     * @ 积分明细
     * @return mixed
     */
    public function integralDescApi(Request $request)
    {
        $mode = $request -> mode;

        if(empty($mode)){
            throw new ApiException('参数错误。。。');
        }
        $data['log'] = '';

        switch ($mode) {
            case 'desc':

                $data['all'] = UserModel::where('id', self::$uid) -> select('integral') -> first();

                $data['log'] = IntegralModel::where('class', 1) -> where('uid', self::$uid) ->select('id', 'content', 'num', 'crea_at', 'status')->get();
                break;
            case 'income':
                $data['log'] = IntegralModel::where('class', 1) -> where('uid', self::$uid) -> where('status', 1)->select('id', 'content', 'num', 'crea_at', 'status')->get();
                break;
            case 'expenditure':
                $data['log'] = IntegralModel::where('class', 1) -> where('uid', self::$uid) -> where('status', 2)->select('id', 'content', 'num', 'crea_at', 'status')->get();
                break;
            case 'end':
                return $this -> resultHandler('敬请期待', true, $data, 10000);
                break;
        }

        foreach ($data['log'] as $k => $v) {
            if ($v->status == 1) {
                $data['log'][$k]->num = '+ ' . $v->num;
            }
            if ($v->status == 2) {
                $data['log'][$k]->num = '- ' . $v->num;
            }
            $data['log'][$k]->care_time = date('Y/m-d', $v->crea_at);
            unset($data['log'][$k]->status);
            unset($data['log'][$k]->crea_at);
        }

        return $this -> resultHandler('成功', true, $data, 10000);
    }

    /**
     * @ 提交稿件
     * @param Request $request
     * @return mixed
     */
    public function subManuscriptApi(Request $request)
    {
        $json = $request -> data;
        $data = json_decode($json, true);

        if(empty($json)){
            throw new ApiException('参数错误');
        }

        if(!count($data)){
            throw new ApiException('参数错误');
        }
        $data['man_crea_at'] = time();
        $data['uid'] = self::$uid;
        $data['man_number'] = 'GT'.time();
        $res = ManuscriptModel::insertManuscript($data);
        if($res){
            return $this -> resultHandler('提交成功', true, $data='', 10000);
        }else{
            return $this -> resultHandler('提交失败，请重新提交', false, $res, 10001);
        }
    }

    /**
     * @ 审核稿件
     * @return mixed
     */
    public function exaManuscriptApi(Request $request)
    {
        $class = $request -> _class ? $request -> _class :1;

        $data = ManuscriptModel::getManuscript(self::$uid, $class);

        foreach ($data as $k => $v){
            if($v -> man_status == 1){
                $data[$k] -> man_status = '未审核';
            }elseif ($v -> man_status == 2){
                $data[$k] -> man_status = '审核中';
            }elseif ($v -> man_status == 3){
                $data[$k] -> man_status = '已审核';
            }

            if($v -> man_adopt == 1){
                $data[$k] -> man_adopt = '未采纳';
            }elseif ($v -> man_adopt == 2){
                $data[$k] -> man_adopt = '采纳中';
            }elseif ($v -> man_adopt == 3){
                $data[$k] -> man_adopt = '已采纳';
            }

            $data[$k] -> man_crea_at = date('Y-m-d H:i:s', $v -> man_crea_at);
        }

        return $this -> resultHandler('成功', true, $data, 10000);

    }

    /**
     * @ 退出登陆
     * @param Request $request
     * @return mixed
     */
    public function OutLoginApi(Request $request)
    {
        Session::pull('users');

        return $this->resultHandler('退出成功', true, $data = 1, 10000);
    }

    /**
     * @ 我的收藏
     * @return mixed
     */
    public function myCollectionApi()
    {
        $data['article'] = CollectionModel::GetArticleCollection(self::$uid);
        $data['magazine'] = CollectionModel::GetMagazineCollection(self::$uid);
        foreach ($data['article'] as $key => $val)
        {
            $data['article'][$key] -> crea_at = date('Y-m-d', $val -> crea_at);
            $data['article'][$key] -> wz_url = '/'.$val -> english.'/list/'. $val -> wz_id;
        }

        return $this -> resultHandler('查询成功', true, $data, 10000);

    }

    /**
     * @删除我的收藏
     * @param Request $request
     * @return mixed
     */
    public function delCollectionApi(Request $request)
    {
        $id = $request -> id;

        if(empty($id) || !is_numeric($id)){
            throw new ApiException('参数错误');
        }

        $res = CollectionModel::where('id', $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功', true, $data = 1, 10000);
        }else{
            return $this -> resultHandler('删除失败，请重试', false, $data = 0, 10001);
        }
    }

    /**
     * @加入收藏
     * @param Request $request
     * @return mixed
     */
    public function joinCollectionApi(Request $request)
    {
        $data['coll_coll_id'] = $request -> id;
        $data['coll_type'] = $request -> type;
        $data['coll_uid'] = self::$uid;
        $data['coll_crea_at'] = time();
        if(empty($data['coll_coll_id']) || empty($data['coll_type'])){
            throw new ApiException('参数错误');
        }
        $arr = [1, 2];
        if(!in_array($data['coll_type'], $arr) || !is_numeric($data['coll_coll_id'])){
            throw new ApiException('参数错误');
        }

        $res = CollectionModel::where(['coll_uid'=> $data['coll_uid'], 'coll_coll_id' => $data['coll_coll_id']]) -> first();

        if(empty($res)){
            $res1 = CollectionModel::insert($data);
            if($res1){
                return $this -> resultHandler('加入成功', true, $data = 1, 10000);
            }
            return $this -> resultHandler('加入失败', false, $data = '', 10001);
        }else{
            throw new ApiException('您已经收藏过了');
        }
    }

    /**
     * @ 个人中心没个关注下面的文章
     * @param Request $request
     * @return mixed
     */
    public function MyFollowApi(Request $request)
    {
        $id = $request -> id;

        if(empty($id)){
            throw new ApiException('参数错误');
        }

        $data = ArticleModel::GetUserShowPgeFollow($id);

        return $this -> resultHandler('SUCCESS', true, $data, 10000);

    }

    /**
     * @站内信通知
     * @return mixed
     */
    public function StationEmailApi()
    {
        StationEmailModel::where('em_uid', self::$uid) -> update(['em_status' => 1, 'em_up_at' => time()]);

        $data = StationEmailModel::where('em_uid', self::$uid) -> select('em_id', 'em_message', 'em_status', 'em_type', 'em_crea_at')
            -> orderBy('em_crea_at', 'desc')
            -> get();

        foreach ($data as $key => $val){
            if($val -> em_status == 1){
                $data[$key] -> em_status = '已读';
            }else{
                $data[$key] -> em_status = '未读';
            }

            if($val -> em_type == 1){
                $data[$key] -> em_type = '个人';
            }else{
                $data[$key] -> em_type = '系统';
            }
            $data[$key] -> em_crea_at =  date('Y/m/d H:i:s', $val -> em_crea_at);
        }

       return $this -> resultHandler('Success', true, $data, 10000);

    }

    /**
     * @ 添加发票信息
     * @param Request $request
     * @return mixed
     */
    public function AddInvoiceApi(Request $request)
    {
        $json = $request -> json;
        $data = json_decode($json, true);

        if(empty($json)){
            throw new ApiException('参数错误');
        }

        if(!count($data)){
            throw new ApiException('参数错误');
        }

        $data['in_crea_at'] = time();
        $data['in_uid'] = self::$uid;

        $res = InvoiceModel::insertGetId($data);

        if($res){
            return $this -> resultHandler('提交成功', true, $dat = ['id' => $res] , 10000);
        }else{
            return $this -> resultHandler('提交失败，请重新提交', false, 0, 10001);
        }
    }

    /**
     * @用户修改关注关键字
     * @param Request $request
     * @return mixed
     */
    public function UpKeywordApi(Request $request)
    {
        $keyword = $request -> keyword;

        if(empty($keyword)){
            throw new ApiException('参数错误');
        }

        $res = UserModel::where('id', self::$uid) -> update(['kid' => $keyword]);

        if($res){
            return $this -> resultHandler('OK', true, $res, 10000);
        }else{
            return $this -> resultHandler('ERROR', false, 0, 10001);
        }

    }

    /**
     * @订单详情接口
     * @param Request $request
     */
    public function orderDescApi(Request $request){

        $order_num = $request -> orderNum;


        $this->isEmpty($order_num, '缺少订单号');

        $data = OrderModel::where('mz_order.order_num', $order_num)
            -> join('mz_rv_address', 'mz_order.addID', '=', 'mz_rv_address.id', 'left')
            -> select('mz_order.order_num', 'mz_order.logistics_code', 'mz_order.express',
                'mz_rv_address.consignee', 'mz_rv_address.city', 'mz_rv_address.area',
                'mz_rv_address.county', 'mz_rv_address.desc_address', 'mz_rv_address.tell',
                'mz_order.transaction_id','mz_order.pay_at','mz_order.all_price'
            )
            -> first();

        $data['describe'] = OrderDescModel::where('order_num', $order_num)
            -> join('mz_magazine', 'mz_order_magazine_describe.m_id', '=', 'mz_magazine.m_id', 'left')
            -> join('mz_periods', 'mz_order_magazine_describe.p_id', '=', 'mz_periods.id', 'left')
            -> select('mz_magazine.year as m_year', 'mz_magazine.title as m_title', 'mz_periods.title as p_title')
            -> get();
       
        $info['msg'] = '';

        if($data -> _class == 2 || $data -> _class == 4)
        {
            $info['msg'] = '该订单没有物流信息或未发货！';
        }

        #调用物流信息
        $Logistics = Logistics::GetLogisticsInfo($data['tell'], $data['logistics_code'], $data['express']);
        $LogisticsArr = json_decode($Logistics, true);

        $data['customer_tell'] = '400-819-1255';
        //错误单号或者没有物流信息
        if($LogisticsArr['status'] != 0 && $LogisticsArr['msg'] != 'ok'){
            $data['msg'] = '该订单没有物流信息或未发货！';
        }else{
            $data['number'] = $LogisticsArr['result']['number'];
            $data['typename'] = $LogisticsArr['result']['typename'];
            $data['list'] = $LogisticsArr['result']['list'];
        }

        $data['pay_at'] = date('Y-m-d H:i:s', $data['pay_at']);

        return $this -> resultHandler('成功', true, $data, 10000);

    }

    /**
     * @我购买的文章
     * @param Request $request
     * @return mixed
     */
    public function myArticleApi(Request $request)
    {

        $data = ArticleOrderDescModel::SelectMyArticle(self::$uid);

        foreach ($data as $key => $val)
        {
            $data[$key]['crea_at'] = date('Y-m/d' , $val['crea_at']);

            $data[$key]['url'] = '/'.$val['english'].'/list/'.$val['aid'];
        }

        return $this -> resultHandler('SUCCESS', true, $data, 10000);
    }

    /**
     * @确认收货
     * @param Request $request
     * @return mixed
     */
    public function confirmGoods(Request $request)
    {
        $order_num = $request -> order_num;

        $res = OrderModel::where('order_num', $order_num) -> update(['status' => 5]);

        if($res){
            return $this -> resultHandler('确认收货成功', true, 1, 10000);
        }else{
            return $this -> resultHandler('确认收货失败（请确保订单号正确）', false, 0, 10001);
        }

    }
}
