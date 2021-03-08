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
 * @文章评论模型
 * Class DimensionModel
 * @package App\Model
 */
class ArticleCommentModel extends Model
{
    const TABLE_NAME = 'mz_article_comment';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @添加评论
     * @param $data
     * @return mixed
     */
    static function insertComment($data)
    {
        return self::insert($data);
    }

    /**
     * @获取评论列表
     * @param $data
     * @return mixed
     */
    static function getListComment($data)
    {
        return self::where('mz_article_comment.com_aid', $data['id'])
            -> where('mz_article_comment.com_status', 2)
            -> join('mz_users', 'mz_article_comment.com_uid', '=', 'mz_users.id')
            -> select('mz_article_comment.com_id', 'mz_users.account', 'mz_users.photo', 'mz_users.photo', 'mz_article_comment.com_comment', 'com_crea_at')
            -> get();
    }


    /**
     * @后台评论列表
     * @param $page
     * @param $limit
     * @return mixed
     */
    static protected function HomeArticleCommentList($page, $limit)
    {
        return self::join('mz_users', 'mz_article_comment.com_uid', '=', 'mz_users.id')
            -> join('mz_article', 'mz_article_comment.com_aid', '=', 'mz_article.id')
            -> select('mz_article.title as title', 'mz_users.account', 'mz_article_comment.com_id',
                'mz_article_comment.com_comment', 'mz_article_comment.com_status', 'mz_article_comment.com_crea_at')
            -> offset($page)
            -> limit($limit)
            -> orderBy('mz_article_comment.com_crea_at' , 'desc')
            -> get();
    }

    /**
     * 后台课堂列表条数
     * @return mixed
     */
    static protected function HomeArticleCommentCount()
    {
        return self::count();
    }

    /**
     * @查询用户文章下的评论
     * @param $data
     * @return mixed
     */
    static protected function getMyComment($data)
    {
        return self::where('com_uid', $data['com_uid'])
            -> join('mz_article', 'mz_article_comment.com_aid', '=', 'mz_article.id')
            -> join('mz_column', 'mz_article.column_id', '=', 'mz_column.id')
            -> select('mz_article_comment.com_id', 'mz_article_comment.com_comment', 'mz_article_comment.com_status', 'mz_article_comment.com_crea_at',
                'mz_article.title', 'mz_article.id as aid', 'mz_column.english')
            -> orderBy('mz_article_comment.com_crea_at', 'desc')
            -> get();
    }

    /**
     * @删除我的评论
     * @param $data
     * @return mixed
     */
    static protected function delComment($data)
    {
        return self::where(['com_uid' => $data['com_uid'], 'com_id' => $data['com_id']]) -> delete();
    }

}
