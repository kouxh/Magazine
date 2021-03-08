<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 微信模型层
 * Class BookOrderModel
 * @package App\Model
 */
class WechatLoginModel extends Model
{
    const TABLE_NAME = 'mz_wechatlogin';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @查询openid  是否是第一次登陆
     * @param $openid
     * @return mixed
     */
    static function selectOpenid($openid)
    {
        return self::where('we_openid', $openid) -> first();
    }

    /**
     * @第一次登陆需要添加到为微信扫码登陆里面
     * @param $data
     * @return mixed
     */
    static function insertInfo($data)
    {
        return self::insert($data);
    }
}
