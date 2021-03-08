<?php
/**
 * Created By PhpStorm
 * Date 2019-6-24
 * Time 16:33
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityModel
 * @package App\Model
 */
class ActivityModel extends Model
{
    const TABLE_NAME = 'mz_activity';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * 活动
     * @param int $limit
     * @param int $status
     * @return mixed
     */
    static public function activity($limit=3,$status=1){
        return self::where('status' , $status)
            -> select('id' , 'title' , 'img' , 'start_at' )
            -> orderBy('start_at' , 'desc')
            -> limit($limit)
            -> get();
    }
}
