<?php
/**
 * Created By PhpStorm
 * Date 2019-9-25
 * Time 13:51
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HeaderModel extends Model
{
    const TABLE_NAME = 'mz_column';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * 获取头部信息
     * @return \Illuminate\Support\Collection
     */
    static public function getHeaderInfo()
    {
        return  self::where('leven' , 1)
            -> where('p_id' , null)
            -> orwhere('is_navigation' , 1)
            -> orderBy('sort' , 'asc')
            -> get();
    }
}
