<?php
/**
 * Created By PhpStorm
 * Date 2019-12-17
 * Time 16：34
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * @维度模型层
 * Class CharacterModel
 * @package App\Model
 */
class KeywordModel extends Model
{
    const TABLE_NAME = 'mz_keyword';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @获取后台专业维度的信息
     * @return mixed
     */
    static public function HomeGetKeywordZy()
    {
        return self::where('class', 2)
            -> select('id', 'title')
            -> get();
    }

    /**
     * @ 获取领域后台列表
     * @param int $page
     * @param $limit
     * @return mixed
     */
    static public function HomeKeywordList($page=6, $limit)
    {
        return self::where('status' , 1)
            -> offset($page)
            -> limit($limit)
            -> orderBy('crea_at' , 'desc')
            -> select('id', 'title', 'class', 'crea_at')
            -> get();
    }

    /**
     * @书籍后台总条数
     * @return mixed
     */
    static public function HomeKeywordCount()
    {
        return self::count();
    }

   
}
