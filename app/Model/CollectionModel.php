<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 我的收藏模型层
 * Class CollectionModel
 * @package App\Model
 */
class CollectionModel extends Model
{
    const TABLE_NAME = 'mz_collection';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @ 获取用户收藏文章
     * @param $uid
     * @return mixed
     */
    static  public function GetArticleCollection($uid)
    {
       return self::where('coll_uid', $uid)
            -> where('coll_type', 1)
            -> join('mz_article', 'mz_article.id', '=', 'mz_collection.coll_coll_id', 'left')
            -> join('mz_keyword', 'mz_keyword.id', 'mz_article.column_id', 'left')
            -> join('mz_column', 'mz_column.id', '=', 'mz_article.column_id', 'left')
            -> select('mz_keyword.title as class', 'mz_keyword.id as key_id', 'mz_article.id as wz_id',
                'mz_article.title', 'mz_article.message', 'mz_article.author',
                'mz_article.crea_at', 'mz_article.view', 'mz_article.praise', 'mz_collection.id', 'mz_column.english')
            -> orderBy('mz_collection.coll_crea_at', 'desc')
            -> get();
    }

    /**
     * @ 获取用户收藏杂志
     * @param $uid
     * @return mixed
     */
    static public function GetMagazineCollection($uid)
    {
        return self::where('coll_uid', $uid)
            -> where('coll_type', 2)
            -> join('mz_magazine', 'mz_magazine.m_id', '=', 'mz_collection.coll_coll_id', 'left')
            -> select('mz_collection.id', 'mz_magazine.m_id', 'mz_magazine.year', 'mz_magazine.name',
                'mz_magazine.title', 'mz_magazine.subtitle', 'mz_magazine.cover_img', 'mz_magazine.flat')
            -> orderBy('mz_collection.coll_crea_at', 'desc')
            -> get();
    }

    /**
     * @ 获取用户收藏课堂
     * @param $uid
     * @return mixed
     */
    static public function GetClassroomCollection($uid)
    {
        return self::where('coll_uid', 107)
            -> where('coll_type', 3)
            -> join('mz_classroom', 'mz_collection.coll_coll_id', '=', 'mz_classroom.cl_id', 'left')
            -> select('mz_collection.id', 'mz_classroom.cl_title', 'mz_classroom.cl_img', 'mz_classroom.cl_show', 'mz_classroom.cl_type')
            -> orderBy('mz_collection.coll_crea_at', 'desc')
            -> get();
    }

    /**
     * 查询该用户有没有收藏该课堂
     * @param $uid
     * @param $id
     * @return mixed
     */
    static function GetUserCollectionClassroom($uid, $id)
    {
        return self::where(['coll_uid' => $uid, 'coll_coll_id' => $id, 'coll_type' => 3]) -> first();
    }

}
