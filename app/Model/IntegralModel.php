<?php
/**
 * Created By PhpStorm
 * Date 2019-12-12
 * Time 17:45
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 积分详细模型
 * Class DimensionModel
 * @package App\Model
 */
class IntegralModel extends Model
{
    const TABLE_NAME = 'mz_integral_log';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @ 积分详情
     * @param $uid  用户id
     * @param $msg  提示语
     * @param $integral 积分
     * @param $_class   类别 1积分2金钱3余额
     * @param $status   变化 1收入2支出3期限
     * @return mixed
     */
    static public function AddIntegralLog($uid, $msg, $status, $integral, $_class)
    {
        return IntegralModel::insert(['uid' => $uid, 'content' => $msg, 'num' => $integral, 'status' => $status, 'class' => $_class, 'crea_at' => time()]);
    }
}
