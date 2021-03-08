<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @文章详情模型层
 * Class BookOrderModel
 * @package App\Model
 */
class ArticleOrderDescModel extends Model
{
    const TABLE_NAME = 'mz_order_article_descripe';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @param $arr
     * @return mixed
     */
    static function SelectOrderDesc($uid)
    {
        return self::where('uid', $uid)
            -> join('mz_article', 'mz_order_article_descripe.aid', '=', 'mz_article.id')
            -> join('mz_column', 'mz_article.column_id', '=', 'mz_column.id')
            -> select('mz_order_article_descripe.order_num', 'mz_column.english', 'mz_article.id as aid', 'mz_article.title', 'mz_article.price')
            -> get()
            -> toArray();
    }

    /**
     * @查询我购买的文章
     * @param $uid
     * @return mixed
     */
    static function SelectMyArticle($uid)
    {
        return self::where('uid', $uid)
            -> where('mz_order_article_descripe.status', 1)
            -> join('mz_article', 'mz_order_article_descripe.aid', '=', 'mz_article.id')
            -> join('mz_column', 'mz_article.column_id', '=', 'mz_column.id')
            -> select('mz_order_article_descripe.crea_at', 'mz_article.title', 'mz_article.id as aid', 'mz_article.price', 'mz_column.english')
            -> get()
            -> toArray();
    }
}
