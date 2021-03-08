<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 报名模型层
 * Class BookOrderModel
 * @package App\Model
 */
class SignUpModel extends Model
{
    const TABLE_NAME = 'mz_live_user';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}