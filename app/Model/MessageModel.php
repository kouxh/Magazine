<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @评论模型层
 * Class UserModel
 * @package App\Model
 */
class MessageModel extends Model
{
    const TABLE_NAME = 'mz_message';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}