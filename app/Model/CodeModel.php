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
 * @验证码模型
 * Class DimensionModel
 * @package App\Model
 */
class CodeModel extends Model
{
    const TABLE_NAME = 'mz_code';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @查询手机号与验证码
     * @param $tell
     * @param $code
     * @return mixed
     */
    static public function selectCode($tell,$code)
    {
        return self::where(['tell' => $tell, 'code' => $code]) -> select('end_time') -> first();
    }

}
