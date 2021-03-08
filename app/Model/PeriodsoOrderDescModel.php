<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @预售订单详情模型
 * Class OrderModel
 * @package App\Model
 */
class PeriodsoOrderDescModel extends Model
{
    const TABLE_NAME = 'mz_order_book_describe';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @param $arr
     * @return mixed
     */
    static function SelectOrderDesc($uid)
    {
        return self::where('uid', $uid)
            -> join('mz_pre', 'mz_order_book_describe.bid', '=', 'mz_pre.id')
            -> select('mz_order_book_describe.num', 'mz_order_book_describe.order_num', 'mz_order_book_describe.price', 'mz_pre.title', 'mz_pre.img')
            -> get();
    }
}
