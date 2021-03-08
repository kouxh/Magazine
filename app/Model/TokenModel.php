<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ Token模型层
 * Class BookOrderModel
 * @package App\Model
 */
class TokenModel extends Model
{
    const TABLE_NAME = 'mz_access_token';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @从数据库获取token
     * @return mixed
     */
    static function  getToken()
    {
        return TokenModel::where('id', 1) -> first();
    }

    /**
     * @首次增加token
     * @param $token
     * @return mixed
     */
    static function insertToken($token)
    {
        return TokenModel::insert(['we_access_token' => $token, 'we_end_at' => strtotime("+2 hours"), 'we_crea_at' => time()]);
    }

    /**
     * @修改token
     * @param $token
     * @return mixed
     */
    static function upToken($token)
    {
        return self::where('id', 1) -> update(['we_access_token' => $token, 'we_end_at' => strtotime("+2 hours"), 'we_up_at' => time()]);
    }
}
