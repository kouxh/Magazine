<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @课堂模型
 * Class OrderModel
 * @package App\Model
 */
class ClassroomModel extends Model
{
    const TABLE_NAME = 'mz_classroom';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @后台课堂列表
     * @param $page
     * @param $limit
     * @return mixed
     */
    static protected function HomeClassroomList($page, $limit)
    {
        return self::offset($page)
            -> limit($limit)
            -> orderBy('cl_crea_at' , 'desc')
            -> get();
    }

    /**
     * 后台课堂列表条数
     * @return mixed
     */
    static protected function HomeClassroomCount()
    {
        return self::count();
    }

    /**
     * @前端课堂相关视频
     * @param $id
     * @param $kid
     * @param int $limit
     * @return mixed
     */
    static protected function RelatedVideo($id, $kid, $limit=4)
    {
        return self::where('cl_id', '!=', $id)
            -> whereRaw('FIND_IN_SET('.$kid.',cl_research)', true)
            -> orderBy('cl_crea_at', 'desc')
            -> limit($limit)
            -> select('cl_id', 'cl_title', 'cl_img')
            -> get();
    }

    /**
     * @小程序按分类查找课堂
     * @param $where
     * @return mixed
     */
    static protected function appletsForumClassRoom($where)
    {
        return self::where('cl_type', $where)
            -> select('cl_id', 'cl_title', 'cl_marvellous', 'cl_show', 'cl_type', 'cl_img')
            -> orderBy('cl_crea_at', 'desc')
            -> get();
    }

    /**
     * @小程序按id查询课堂
     * @param $id
     * @return mixed
     */
    static protected function appletsForumClassRoomDesc($id)
    {
        return self::where('cl_id', $id) -> select('cl_id', 'cl_title', 'cl_img', 'cl_show', 'cl_give_num', 'cl_share_num', 'cl_collection_num', 'cl_video_path', 'cl_msg', 'cl_type') -> first();
    }
}
