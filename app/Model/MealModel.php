<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @套餐订单模型
 * Class OrderModel
 * @package App\Model
 */
class MealModel extends Model
{
    const TABLE_NAME = 'mz_order_logistics';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @ 查询套餐发货最新条数
     * @param $order_num
     * @return mixed
     */
    static  function meaLogisticsFirst($order_num)
    {
       return self::where('order_num', $order_num) -> orderBy('num', 'desc') -> first();
    }

}
