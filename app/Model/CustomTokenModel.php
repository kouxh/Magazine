<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 自定义Token模型层
 * Class BookOrderModel
 * @package App\Model
 */
class CustomTokenModel extends Model
{
    const TABLE_NAME = 'mz_custom_token';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @添加自定义token到数据库中
     * @return mixed
     */
    static function insertCustomToken($cu_token, $uid)
    {
        return self::insert(['cu_token' => $cu_token, 'cu_crea_at' => time(), 'cu_end_at' => strtotime('+168 hours'), 'cu_uid' => $uid]);
    }

    /**
     * @修改自定义token
     * @param $cu_token
     * @param $uid
     * @return mixed
     */
    static function upCustomToken($cu_token, $uid)
    {
        return self::where('cu_uid' , $uid) -> update(['cu_token' => $cu_token, 'cu_crea_at' => time(), 'cu_end_at' => strtotime('+168 hours')]);
    }

    /**
     * @查询用户的自定义token
     * @param $uid
     * @return mixed
     */
    static function selectCustomToken($uid)
    {
        return self::where('cu_uid', $uid) -> first();
    }
}