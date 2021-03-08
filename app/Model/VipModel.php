<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ Vip模型层
 * Class BookOrderModel
 * @package App\Model
 */
class VipModel extends Model
{
    const TABLE_NAME = 'mz_vip';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
