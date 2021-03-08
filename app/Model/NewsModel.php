<?php
/**
 * Created By PhpStorm
 * Date 2019-7-2
 * Time 17:41
 * Name 马哥
 * */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    const TABLE_NAME = 'mz_news';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * 新闻
     * @param int $column
     * @param int $limit
     * @param int $status
     * @return mixed
     */
    static public function news($page=3,$status=1){
        return self::where('status' , $status)
            -> select('id' , 'title' , 'message' ,  'img' , 'class_id' , 'author' , 'crea_at')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * 内容
     * @param $id
     * @return mixed
     */
    static public function content($id)
    {
        return self::where('id' , $id)
            -> select('id' , 'author' , 'crea_at' , 'title' , 'keyboard' , 'class_id' , 'message'  , 'content')
            -> first();
    }

    /**
     * 获取搜索的新闻 ---- 按关键词搜索
     * @param string $keyword
     * @param int $status
     * @param int $page
     * @return mixed
     */
    static public function getNewsKeyword($keyword='' , $status=1 ,$page=6)
    {
        return self::where('status' , $status)
            -> where('keyboard' , 'like' , "%$keyword%")
            -> select('id' , 'title' , 'message' ,  'img' , 'class_id' , 'author' , 'crea_at')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * 获取搜索的新闻 ---- 按标题搜索
     * @param string $keyword
     * @param int $status
     * @param int $page
     * @return mixed
     */
    static public function getNewsTitle($keyword='' , $status=1 ,$page=6)
    {
        return self::where('status' , $status)
            -> where('title' , 'like' , "%$keyword%")
            -> select('id' , 'title' , 'message' ,  'img' , 'class_id' , 'author' , 'crea_at')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }
}
