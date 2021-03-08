<?php

namespace App\Model;
/**
 * Created By PhpStorm
 * Date 2019-8-1
 * Time 13：16
 * Name 马哥
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ColumnModel extends Model
{
    const TABLE_NAME = 'mz_column';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * 栏目
     * @param $column
     * @param int $status
     * @return mixed
     */
    static public function column($column , $status=1)
    {
        return self::where('english' , $column) -> where('status' , $status) -> first();
    }

    /**
     * 随机获取栏目
     * @param int $column
     * @param int $lenght
     * @return mixed
     */
    static public function randColumn($column=0,$lenght=3)
    {
        return self::where('id' , '!=' , $column)
            -> where('rand' , 1)
            -> orderBy(DB::raw('RAND()'))
            -> take($lenght)
            -> select('id' , 'column' , 'title' , 'english')
            -> get();
    }

    /**
     * 获取后台文章列表栏目
     * @return mixed
     */
    static public function getHomeList()
    {
        return self::where('home_list' , 1) -> where('english' , '!=' , ['sy' , 'zz' , 'wk' , 'hd']) -> select('id' , 'column') -> get();
    }

    /**
     * 获取栏目下的子栏目
     * @param int $column_id
     * @return mixed
     */
    static public function getSonColumn($column_id=0)
    {
        return self::where('p_id' , $column_id) -> select('id') -> get();
    }
}
