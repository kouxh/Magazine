<?php
/**
 * Created By PhpStorm
 * Date 2019-9-25
 * Time 14:35
 * Name 马哥
 * */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MagazineModel extends Model
{
    const TABLE_NAME = 'mz_magazine';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * 获取杂志列表
     * @param int $page
     * @param int $status
     * @return mixed
     */
    static public function magazine($page=1,$status=1){
        return self::where('status' , $status)
            -> select('m_id' , 'year' , 'title' , 'cover_img')
            -> orderBy('crea_time' , 'desc')
            -> Paginate($page);
    }

    /**
     * 获取单条杂志
     * @param int $status
     * @return mixed
     */
    static public function getFirstMagazine($status=1)
    {
        return self::where('status' , $status)
            -> select('m_id', 'year', 'title', 'cover_img')
            -> orderBy('crea_time', 'desc')
            -> first();
    }
}
