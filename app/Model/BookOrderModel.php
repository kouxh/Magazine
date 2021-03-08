<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 书籍订单模型层
 * Class BookOrderModel
 * @package App\Model
 */
class BookOrderModel extends Model
{
    const TABLE_NAME = 'mz_order_book_describe';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
