<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @课堂点赞模型
 * Class OrderModel
 * @package App\Model
 */
class ClassrommGiveModel extends Model
{
    const TABLE_NAME = 'mz_classroom_give';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @查询该用户有没有点赞该课堂
     * @param $uid
     * @param $cid
     * @return mixed
     */
    static function getUserGiveClassroom($uid, $cid)
    {
        return self::where(['g_uid' => $uid, 'g_cid' => $cid]) -> first();
    }

    /**
     * @增加该用户点在该课堂
     * @param $uid
     * @param $cid
     * @return mixed
     */
    static function insertGiveClassroom($uid, $cid)
    {
        return self::insert(['g_uid' => $uid, 'g_cid' => $cid, 'g_crea_at' => time()]);
    }

}
