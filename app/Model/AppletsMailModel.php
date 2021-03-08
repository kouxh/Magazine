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
 * @小程序站内信
 * Class DimensionModel
 * @package App\Model
 */
class AppletsMailModel extends Model
{
    const TABLE_NAME = 'mz_applets_mail';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @添加小程序站内信数据
     * @param $tell
     * @param $code
     * @return mixed
     */
    static public function addAppletsMail($tell)
    {
        return self::insert(['am_tell' => $tell, 'am_crea_at' => time()]);
    }

}
