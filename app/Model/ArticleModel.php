<?php
/**
 * Created By PhpStorm
 * Date 2019-8-1
 * Time 13：16
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticleModel extends Model
{
    const TABLE_NAME = 'mz_article';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * 获取栏目下的所有文章
     * @return mixed
     */
    static public function article($column='' , $page=3 , $status=1 , $keyword=''){

        return self::where('mz_article.status' ,$status)
            -> where('mz_article.column_id' , $column)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id', 'mz_article.price', 'mz_article.title' ,
                'mz_article.message' , 'mz_article.img' , 'mz_article.author' ,
                'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english', 'mz_article.author_post')
            -> orderBy('mz_article.is_recommend' , 'desc')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> Paginate($page);

    }

    /**
     * 获取栏目下的所有文章 -- 接口返回
     * @return mixed
     */
    static public function articleJson($column='' , $page=3 , $status=1 , $keyword=''){

        return self::where('mz_article.status' ,$status)
            -> where('mz_article.column_id' , $column)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.message' , 'mz_article.author_post', 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.is_recommend' , 'desc')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> get();

    }

    /**
     * 获取有子栏目下的所有文章
     * @param $ids
     * @param int $page
     * @param int $status
     * @param string $keyword
     * @return mixed
     */
    static public function whereInArticle($ids=[] , $page=3 , $status=1){

        return self::where('mz_article.status' ,$status)
            -> whereIn('mz_article.column_id' , $ids)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id', 'mz_article.price', 'mz_article.title' , 'mz_article.author_post', 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> Paginate($page);

    }

    /**
     * 获取有子栏目下的所有文章----接口返回
     * @param array $ids
     * @param int $page
     * @param int $status
     * @return mixed
     */
    static public function whereInArticleJson($ids=[] , $page=3 , $status=1){

        return self::where('mz_article.status' ,$status)
            -> whereIn('mz_article.column_id' , $ids)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.author_post', 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> get();

    }

    /**
     * 获取搜索的文章 ---- 按关键词搜索
     * @param int $page
     * @param int $status
     * @param string $keyword
     */
    static function getArticleKeyboard($page=8 , $status=1 , $keyword=''){
        return self::where('mz_article.status' ,$status)
            -> where('mz_article.keyboard' , 'like' , "%$keyword%")
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.author_post', 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * 获取搜索的文章 ---- 按标题搜索
     * @param int $page
     * @param int $status
     * @param string $keyword
     * @return mixed
     */
    static function getArticleTitle($page=8 , $status=1 , $keyword=''){
        return self::where('mz_article.status' ,$status)
            -> where('mz_article.title' , 'like' , "%$keyword%")
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.author_post', 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * 获取TOP 5
     * @param int $limit
     * @param int $status
     * @return mixed
     */
    static public function topNum($limit=5,$status=1)
    {
        return self::where('mz_article.status' ,$status)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.message' , 'mz_article.view' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column','mz_column.english')
            -> orderBy('mz_article.view' , 'desc')
            -> limit($limit)
            -> get();
    }

    /**
     * 猜你喜欢
     * @param int $id
     * @param string $keyword
     * @param int $limit
     * @param int $status
     * @return mixed
     */
    static public function like($kid, $limit=3)
    {
        return self::whereRaw('FIND_IN_SET('.$kid.',keyword)', true)
            -> join('mz_column', 'mz_column.id', '=', 'mz_article.column_id', 'left')
            -> select('mz_article.id', 'mz_article.title', 'mz_column.english')
            -> limit($limit)
            -> get();
    }

    /**
     * 相关文章
     * @param int $column_id
     * @param int $id
     * @param int $limit
     * @param int $status
     * @return mixed
     */
    static public function relevant($column_id=0 , $id=0 , $limit=3 , $status=1)
    {
        return self::where('mz_article.column_id' , $column_id)
            -> where('mz_article.id' , '!=' , $id)
            -> where('mz_article.status' , $status)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> limit($limit)
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.img' , 'mz_article.message' , 'mz_article.author' , 'mz_column.column' , 'mz_column.english' )
            -> get();
    }

    /**
     * 文章内容
     * @param $id
     * @return mixed
     */
    static public function content($id)
    {
        return self::where('id' , $id)
            -> select('id' , 'author' , 'crea_at' , 'title' , 'keyword' , 'keyboard' , 'message' , 'free_content' , 'charge_content' , 'integral' , 'price', 'column_id')
            -> first();
    }

    /**
     * 获取行业或者专业下的所有文章
     * @param int $column_id
     * @param string $calss
     * @param int $status
     * @return mixed
     */
    static public function getMajorArticle($column_id=0,$calss='',$status=1)
    {
        return self::where('mz_article.status' ,$status)
            -> where('mz_article.column_id' , $column_id)
            -> where('mz_article.'.$calss.'' , 1)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> get();
    }

    /**
     * 获取子维度下所有的文章
     * @param int $column_id
     * @param int $son_dimension
     * @return mixed
     */
    static public function getSonDimensionArticle($column_id=0 , $son_dimension=0)
    {
        return self::where("column_id",$column_id)
            -> whereRaw('FIND_IN_SET('.$son_dimension.',keyword)',true)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> get();
    }

    /**
     * 获取子栏目下所有的文章
     * @param int $column_id
     * @return mixed
     */
    static public function getSonColumnArticle($column_id=0)
    {
        return self::where("column_id",$column_id)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_article.message' , 'mz_article.img' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_column.english')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> get();
    }

    /**
     * @获取个人中心我没个关注下面的文章
     * @param $id
     * @return mixed
     */
    static public function GetUserShowPgeFollow($id)
    {
       return  self::whereRaw('FIND_IN_SET('.$id.',keyword)', true)
            -> join('mz_column', 'mz_column.id', '=', 'mz_article.column_id', 'left')
            -> select('mz_article.id', 'mz_article.title', 'mz_column.english')
            -> limit(3)
            -> get();
    }
}
