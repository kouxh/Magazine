<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @站内信通知
 * Class OrderModel
 * @package App\Model
 */
class StationEmailModel extends Model
{
    const TABLE_NAME = 'mz_station_email';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @param $uid      用户ID
     * @param $message  通知信息
     * @param $type     类型个人信息 还是 站内信息
     * @return mixed
     */
    static public function addEmail($uid, $message, $type)
    {
       return self::insert(['em_uid' => $uid, 'em_message' => $message, 'em_type' => $type, 'em_crea_at' => time()]);
    }
}
