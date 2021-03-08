<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\OrderModel;
use App\Model\InvoiceModel;
use App\Model\AddressModel;
use App\Model\OrderDescModel;
use App\Http\Controllers\Service\StationEmail;
use App\Http\Controllers\Service\Logistics;

date_default_timezone_set("Asia/Shanghai");

/**
 * 订单
 * Class Ordel
 * @package App\Http\Controllers\Home
 */
class Order extends BaseController
{


    /**
     * @加载订单列表
     * @return string
     */
    public function orderList()
    {
        return view('/Home/Order/list');
    }

    /**
     * @修改订单金额
     * @param Request $request
     * @return mixed
     */
    public function ModifyPrice(Request $request)
    {
        $id = $request -> id;
        $all_price = $request -> all_price;
        $res = OrderModel::where('id', $id) -> update(['all_price' => $all_price]);
        if($res){
            return $this -> resultHandler('修改成功' , true , $res, 10000);
        }else{
            return $this -> resultHandler('修改失败' , false ,0 , 10001);
        }
    }

    /**
     * @发货接口
     * @param Request $request
     * @return mixed
     */
    public function DeliverGoods(Request $request)
    {
        $id = $request -> id;
        $logistics_code = $request -> logistics_code;
        $express = $request -> express;
        $order = OrderModel::where('id', $id) -> select('uid') -> first();

        if(empty($order)){
            return $this -> resultHandler('订单号错误' , false ,0 , 10001);
        }
        $res = OrderModel::where('id', $id)
            -> update(['status' => 3, 'logistics_code' => $logistics_code, 'express' => $express]);

        if($res) {
            $res = StationEmail::AddStationEmail($order->uid, '您的订单已发货！感谢购买我们产品', 0);
            if ($res) {
                return $this->resultHandler('发货成功', true, $res, 10000);
            }
        }
            return $this -> resultHandler('发货失败' , false ,0 , 10001);


    }

    /**
     * @ 订单分页列表
     * @param Request $request
     * @return mixed
     */
    public function orderPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = OrderModel::HomeOrderList($page, $limit);

        $count = OrderModel::HomeOrderCount();

        //dd($data);
        foreach($data as $k => $v)
        {

            if($v -> _class == 1){
                $data[$k] -> _class = '杂志订单';
            }elseif ($v -> _class == 2){
                $data[$k] -> _class = '文章订单';
            }elseif ($v -> _class == 3){
                $data[$k] -> _class = '书籍订单';
            }elseif ($v -> _class == 4){
                $data[$k] -> _class = 'VIP订单';
            }

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
     * @订单删除
     * @param Request $request
     * @return mixed
     */
    public function orderDel(Request $request)
    {
        $id = $request -> id;

        $res = OrderModel::where('id' , $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @订单详情
     * @param Request $request
     * @return mixed
     */
    public function orderShow(Request $request)
    {
        $id = $request -> id;

        $order = OrderModel::where('id', $id) -> select('id', 'order_num', 'all_price', 'all_num', 'status', '_class', 'transaction_id', 'pay_at', 'logistics_code') -> first();

        $data = OrderDescModel::where('order_num', $order -> order_num)
                -> join('mz_magazine', 'mz_order_magazine_describe.m_id', '=', 'mz_magazine.m_id')
                -> join('mz_users', 'mz_order_magazine_describe.uid', '=', 'mz_users.id', 'left')
                -> select('mz_magazine.year', 'mz_magazine.title', 'mz_users.account')
            -> get();

        $order -> describe = $data;

        if($order -> _class == 1){
            $order -> _class = '杂志订单';
        }elseif ($order -> _class == 2){
            $order -> _class = '文章订单';
        }elseif ($order -> _class == 3){
            $order -> _class = '书籍订单';
        }elseif ($order -> _class == 4){
            $order -> _class = 'VIP订单';
        }

        if($order -> pay_at　!= 0){
            $order -> pay_at = date('Y-m-d H:i:s', $order -> pay_at);
        }
        //dd($order);
        return view('/Home/Order/show') -> with('order', $order);
    }

    /**
     * @ 备注信息
     * @param Request $request
     * @return mixed
     */
    public function remarksMsg(Request $request)
    {
        $id = $request -> id;

        $remarksMsg = OrderModel::where('id', $id) -> select('remarksMsg') -> first();

        if(empty($remarksMsg -> remarksMsg)){
            $remarksMsg = '无';
        }else{
            $remarksMsg = $remarksMsg -> remarksMsg;
        }

        return $this -> resultHandler('Success', true, $remarksMsg, 10000);

    }

    /**
     * @发票信息
     * @param Request $request
     * @return mixed
     */
    public function invoice(Request $request)
    {
        $id = $request -> id;

        $invoice = OrderModel::where('id', $id) -> select('id', 'invoice') -> first();

        if(!empty($invoice -> invoice))
        {
            $invoice = InvoiceModel::where('id', $invoice -> invoice) -> first();

            if($invoice -> in_type == 1){
                $invoice -> in_type = '个人';
            }elseif ($invoice -> in_type == 2){
                $invoice -> in_type = '普通';
            }elseif ($invoice -> in_type == 3){
                $invoice -> in_type = '专用';
            }

            if($invoice -> in_paper == 1){
                $invoice -> in_paper = '纸质';
            }elseif ($invoice -> in_paper == 2){
                $invoice -> in_paper = '电子';
            }
        }else{
            $invoice['in_paper'] = '无';
            $invoice['in_type'] = '无';
            $invoice['in_tell'] = '无';
            $invoice['in_email'] = '无';
            $invoice['in_company_name'] = '无';
            $invoice['in_taxpayer_code'] = '无';
            $invoice['in_register_address'] = '无';
            $invoice['in_register_tell'] = '无';
            $invoice['in_deposit_bank'] = '无';
            $invoice['in_bank_account'] = '无';
        }
        return $this -> resultHandler('Success', true, $invoice, 10000);
    }

    /**
     * @收货信息
     * @param Request $request
     * @return mixed
     */
    public function address(Request $request)
    {
        $id = $request -> id;

        $address = OrderModel::where('id', $id) -> select('id', 'addId') -> first();

        if(!empty($address -> addId))
        {
            $address = AddressModel::where('id', $address -> addId)
                -> select('id', 'consignee', 'city', 'area', 'county', 'desc_address', 'tell', 'fixed_number', 'zip_code')
                -> first();
        }else{
            $address = '无';
        }

        return $this -> resultHandler('Success', true, $address, 10000);
    }


    /**
     * 收货信息
     * @param Request $request
     * @return mixed
     */
    public function logistics(Request $request)
    {
        $id = $request -> id;

        $order = OrderModel::where('mz_order.id', $id)
            -> join('mz_rv_address', 'mz_order.addID', '=', 'mz_rv_address.id')
            -> select('mz_order.order_num', 'mz_order.logistics_code', 'mz_order.express',
                'mz_rv_address.consignee', 'mz_rv_address.city', 'mz_rv_address.area',
                'mz_rv_address.county', 'mz_rv_address.desc_address', 'mz_rv_address.tell')
            -> first()
            -> toArray();

        $order['describe'] = OrderDescModel::where('order_num', $order['order_num'])
                    -> join('mz_magazine', 'mz_order_magazine_describe.m_id', '=', 'mz_magazine.m_id')
                    -> select('mz_magazine.year', 'mz_magazine.title')
                    -> get();

        $tell = OrderModel::GetOrderTell($order['order_num']);

        $data = Logistics::GetLogisticsInfo($tell['tell'], $order['logistics_code'], $order['express']);
        $data = json_decode($data, true);

        //错误单号或者没有物流信息
        if($data['status'] != 0 && $data['msg'] != 'ok'){
            $order['msg'] = '该订单没有物流信息或未发货！';
        }else{
            $order['number'] = $data['result']['number'];
            $order['typename'] = $data['result']['typename'];
            $order['resultList'] = $data['result']['list'];
        }

        return view('Home/Order/logistics') -> with('data', $order);
    }



}
