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
 * @购买全年套餐模型
 * Class DimensionModel
 * @package App\Model
 */
class AnnaulModel extends Model
{
    const TABLE_NAME = 'mz_annual_set_meal';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @查询用户购买过全年套餐杂志吗
     * @param $tell
     * @return mixed
     */
    static function selectAnnualNum($tell)
    {
        return self::where(['s_user_tell' => $tell]) -> select('s_num') -> first();
    }
}