<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @检测手机号模型层
 * Class CartModel
 * @package App\Model
 */
class CheckTellModel extends Model
{
    const TABLE_NAME = 'mz_check_tell';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}