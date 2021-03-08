<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ Vip详情模型层
 * Class BookOrderModel
 * @package App\Model
 */
class VipOrderDescModel extends Model
{
    const TABLE_NAME = 'mz_order_vip_describe';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    static public function AppletsGetUserOrderList($order_num)
    {
        return self::whereIn('order_num', $order_num)
            -> join('mz_vip', 'mz_order_vip_describe.vid', '=', 'mz_vip.id')
            -> join('mz_users', 'mz_order_vip_describe.uid', '=', 'mz_users.id', 'left')
            -> select('mz_order_vip_describe.num', 'mz_order_vip_describe.order_num', 'mz_vip.id as vid','mz_vip.name', 'mz_vip.money','mz_users.start_time', 'mz_users.end_time')
            -> get();
    }
}
