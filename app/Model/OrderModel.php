<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @订单模型
 * Class OrderModel
 * @package App\Model
 */
class OrderModel extends Model
{
    const TABLE_NAME = 'mz_order';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @订单后台列表
     * @param $page
     * @param $limit
     * @return mixed
     */
    static public function HomeOrderList($page, $limit)
    {
        return self::where('meal', '!=', 1)
            -> join('mz_rv_address', 'mz_rv_address.id', '=', 'mz_order.addID', 'left')
            -> offset($page)
            -> limit($limit)
            -> orderBy('mz_order.crea_at' , 'desc')
            -> select('mz_order.id', 'mz_order.order_num', 'mz_order.all_num', 'mz_order.all_price', 'mz_order.status',
                'mz_order.crea_at', 'mz_order.end_at', 'mz_rv_address.consignee', 'mz_rv_address.city', 'mz_rv_address.area',
                'mz_rv_address.county', 'mz_rv_address.desc_address', 'mz_rv_address.tell', 'mz_rv_address.zip_code',
                'mz_order._class', 'mz_order.logistics_code', 'mz_order.express')
            -> get();
    }

    /**
     * @订单后台总条数
     * @return mixed
     */
    static public function HomeOrderCount()
    {
        return self::where('meal', '!=', 1) -> count();
    }

    /**
     * @订单加载编辑
     * @param $id
     * @return mixed
     */
    static public function HomeOrderUp($id)
    {
        return self::where('id', $id)
            -> select('id', 'order_num', 'logistics_code', 'express', 'all_price')
            -> first();
    }

    /**
     * 获取订单手机号
     * @param $order_num
     * @return mixed
     */
    static public function GetOrderTell($order_num)
    {
        return self::where('mz_order.order_num', $order_num)
            -> join('mz_rv_address', 'mz_rv_address.id', '=', 'mz_order.addID', 'left')
            -> select('mz_order.id', 'mz_order.order_num', 'mz_order.logistics_code', 'mz_order.express', 'mz_rv_address.tell')
            -> first();
    }

    /**
     * @查询用户下的相关订单
     * @param $uid
     * @param $_class
     * @return mixed
     */
    static public function SelectOrder($uid, $_class, $status)
    {
        if($status == 0){
            return self::where(['uid' => $uid, '_class' => $_class])
                -> select('id', 'order_num', 'all_num', 'all_price', 'addID', 'crea_at', 'status')
                -> orderBy('crea_at', 'desc')
                -> get()
                -> toArray();
        }else{
            return self::where(['uid' => $uid, '_class' => $_class, 'status' => $status])
                -> select('id', 'order_num', 'all_num', 'all_price', 'addID', 'crea_at', 'status')
                -> orderBy('crea_at', 'desc')
                -> get()
                -> toArray();
        }
    }

    /**
     * @套餐订单后台列表
     * @param $page
     * @param $limit
     * @return mixed
     */
    static public function HomeMealOrderList($page, $limit)
    {
        return self::where('meal', 1)
            -> join('mz_rv_address', 'mz_rv_address.id', '=', 'mz_order.addID', 'left')
            -> join('mz_order_magazine_describe', 'mz_order.order_num', '=', 'mz_order_magazine_describe.order_num', 'left')
            -> orderBy('mz_order.crea_at' , 'desc')
            -> select('mz_order.id', 'mz_order.order_num', 'mz_order.all_num', 'mz_order.all_price', 'mz_order.status',
                'mz_order.crea_at', 'mz_order.end_at', 'mz_rv_address.consignee', 'mz_rv_address.city', 'mz_rv_address.area',
                'mz_rv_address.county', 'mz_rv_address.desc_address', 'mz_rv_address.tell', 'mz_rv_address.zip_code',
                'mz_order._class', 'mz_order_magazine_describe.Alr_delivery', 'mz_order_magazine_describe.should_delivered')
            -> offset($page)
            -> limit($limit)
            -> get();
    }

    /**
     * @套餐订单后台总条数
     * @return mixed
     */
    static public function HomeMealOrderCount()
    {
        return self::where('meal', 1) -> count();
    }

    /**
     * @小程序获取用户订单的列表
     * @param int $uid
     */
    static public function appletsGetUserOrderList($uid=107)
    {
        return self::where('uid', $uid)
            -> where('_class', 4)
            -> select('order_num', 'uid', 'status', '_class', 'addID', 'invoice', 'crea_at')
            -> get();
    }


}
