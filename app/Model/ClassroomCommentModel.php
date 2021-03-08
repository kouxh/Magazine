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
 * @课堂评论模型
 * Class DimensionModel
 * @package App\Model
 */
class ClassroomCommentModel extends Model
{
    const TABLE_NAME = 'mz_classroom_comment';
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
    static function getListComment($id)
    {
        return self::where('mz_classroom_comment.com_cid', $id)
            -> where('mz_classroom_comment.com_status', 2)
            -> join('mz_users', 'mz_classroom_comment.com_uid', '=', 'mz_users.id')
            -> select('mz_users.account', 'mz_users.photo', 'mz_classroom_comment.com_comment', 'com_crea_at')
            -> get();
    }

    /**
     * @后台评论列表
     * @param $page
     * @param $limit
     * @return mixed
     */
    static protected function HomeClassroomCommentList($page, $limit)
    {
        return self::join('mz_users', 'mz_classroom_comment.com_uid', '=', 'mz_users.id')
            -> join('mz_classroom', 'mz_classroom_comment.com_cid', '=', 'mz_classroom.cl_id')
            -> select('mz_classroom_comment.com_id', 'mz_classroom.cl_title as title', 'mz_users.account', 'mz_classroom_comment.com_id',
                'mz_classroom_comment.com_comment', 'mz_classroom_comment.com_status', 'mz_classroom_comment.com_crea_at')
            -> offset($page)
            -> limit($limit)
            -> orderBy('mz_classroom_comment.com_crea_at' , 'desc')
            -> get();
    }

    /**
     * 后台课堂列表条数
     * @return mixed
     */
    static protected function HomeClassroomCommentCount()
    {
        return self::count();
    }

    /**
     * @查询用户文章下的评论
     * @param $data
     * @return mixed
     */
    static protected function getMyComment($uid)
    {
        return self::where('com_uid', $uid)
            -> join('mz_classroom', 'mz_classroom_comment.com_cid', '=', 'mz_classroom.cl_id')
            -> select('mz_classroom_comment.com_id', 'mz_classroom_comment.com_comment', 'mz_classroom_comment.com_status', 'mz_classroom_comment.com_crea_at',
                'mz_classroom.cl_title', 'mz_classroom.cl_id as cid')
            -> orderBy('mz_classroom_comment.com_crea_at', 'desc')
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

    /**
     * @查询小程序课堂下所有评论
     * @param $cid
     * @param $parent_id
     * @return mixed
     */
    static protected function getClassroomComment($cid, $parent_id)
    {
        return self::where('mz_classroom_comment.com_pid',  $parent_id)
            -> where('mz_classroom_comment.com_cid', $cid)
            -> join('mz_users', 'mz_classroom_comment.com_uid', '=', 'mz_users.id', 'left')
            -> select('mz_classroom_comment.com_id', 'mz_classroom_comment.com_comment',
                'mz_classroom_comment.com_crea_at', 'mz_users.photo', 'mz_users.account')
            -> orderBy("mz_classroom_comment.com_crea_at", 'desc')
            -> get();
    }

    /**
     * @获取用户下的作者回复用户评论
     * @param $uid
     * @param $parent_id
     * @return mixed
     */
    static protected function getUserClassroomComment($uid, $parent_id)
    {
        return self::where('mz_classroom_comment.com_uid', $uid)
            -> where('mz_classroom_comment.com_pid', $parent_id)
            -> join('mz_classroom', 'mz_classroom_comment.com_cid', '=', 'mz_classroom.cl_id')
            -> select('mz_classroom_comment.com_id', 'mz_classroom_comment.com_comment', 'mz_classroom_comment.com_uid',
                'mz_classroom_comment.com_crea_at', 'mz_classroom.cl_title', 'mz_classroom_comment.com_status')
            -> get();
    }

}
