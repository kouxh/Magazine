<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 我的收藏模型层
 * Class CollectionModel
 * @package App\Model
 */
class LiveModel extends Model
{
    const TABLE_NAME = 'mz_live';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
