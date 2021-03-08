<?php
/**
 * Created By PhpStorm
 * Date 2019-9-25
 * Time 14:35
 * Name 马哥
 * */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    const TABLE_NAME = 'mz_c_banner';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * Banner 图
     * @param int $type
     * @param int $c_id
     * @param int $status
     * @return mixed
     */
    static public function banner($type=0,$c_id=0,$status=1)
    {
       return self::where('status' , 1)
           -> where('type' , $type)
           -> where('c_id' , $c_id)
           -> select('id' , 'c_id' , 'banner' , 'type' , 'alert')
           -> first();
    }
}
