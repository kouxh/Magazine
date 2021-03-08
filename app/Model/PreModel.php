<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 书籍模型层
 * Class BookOrderModel
 * @package App\Model
 */
class PreModel extends Model
{
    const TABLE_NAME = 'mz_pre';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}