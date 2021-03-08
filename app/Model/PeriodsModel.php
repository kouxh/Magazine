<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @杂志套餐模型层
 * Class BookOrderModel
 * @package App\Model
 */
class PeriodsModel extends Model
{
    const TABLE_NAME = 'mz_periods';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;


}
