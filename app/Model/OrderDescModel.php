<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @订单详情模型
 * Class OrderModel
 * @package App\Model
 */
class OrderDescModel extends Model
{
    const TABLE_NAME = 'mz_order_magazine_describe';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @param $arr
     * @return mixed
     */
//    static function SelectOrderDesc($orderNum)
//    {
//        return self::where('order_num', $orderNum)
//            -> join('mz_magazine' , 'mz_order_magazine_describe.m_id' , '=' , 'mz_magazine.m_id' , 'left')
//            -> join('mz_periods' , 'mz_order_magazine_describe.p_id' , '=' , 'mz_periods.id' , 'left')
//            -> select('mz_periods.title as p_title', 'mz_periods.img as p_img', 'mz_periods.money as p_money', 'mz_periods.status as p_status',
//                'mz_magazine.m_id', 'mz_magazine.title as m_title', 'mz_magazine.cover_img as m_img', 'mz_order_magazine_describe.num',
//                'mz_order_magazine_describe.price', 'mz_order_magazine_describe.type')
//            -> get();
//    }

    static function SelectOrderDesc($uid)
    {
        return self::where('uid', $uid)
            -> join('mz_magazine' , 'mz_order_magazine_describe.m_id' , '=' , 'mz_magazine.m_id' , 'left')
            -> join('mz_periods' , 'mz_order_magazine_describe.p_id' , '=' , 'mz_periods.id' , 'left')
            -> select('mz_periods.title as p_title', 'mz_periods.id as p_id', 'mz_periods.img as p_img', 'mz_periods.money as p_money', 'mz_periods.status as p_status',
                'mz_magazine.m_id', 'mz_magazine.title as m_title', 'mz_magazine.cover_img as m_img', 'mz_order_magazine_describe.num',
                'mz_order_magazine_describe.price', 'mz_order_magazine_describe.type', 'mz_order_magazine_describe.order_num')
            -> get()
            -> toArray();
    }
}
