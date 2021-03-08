<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 模型层
 * Class CollectionModel
 * @package App\Model
 */
class LiveUserModel extends Model
{
    const TABLE_NAME = 'mz_live_user';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
