<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\ClassroomModel;
use App\Model\ClassroomCommentModel;
use App\Model\CollectionModel;
use App\Model\LiveModel;
use App\Model\ClassrommGiveModel;

class ClassRoom extends CheckParameter
{
    /**
     * @小程序课堂列表
     * @param Request $request
     * @return mixed
     */
    public function classRoomList(Request $request)
    {
        $where = $request -> where?$request -> where:'CMAS访谈录';

        $data['list'] = ClassroomModel::appletsForumClassRoom($where);

        $data['live'] = LiveModel::select('l_id', 'l_img', 'end_at')-> orderBy('I_crea_at', 'desc') -> first();

        if($data['live'] > date('Y-m-d H:i:s')){
            $data['live'] -> is_end = 0;
        }else{
            $data['live'] -> is_end = 1;
        }
        return $this -> Result('Success', true, $data, 10000);

    }

    /**
     * @小程序课堂详情
     * @param Request $request
     * @return mixed
     */
    public function classRoomDesc(Request $request)
    {
        $cid = $request -> cid;
        $uid = $request -> uid;

        ClassroomModel::where('cl_id', $cid) -> increment('cl_show', 1);

        $data['desc'] = ClassroomModel::appletsForumClassRoomDesc($cid);

        $data['relevant'] = ClassroomModel::appletsForumClassRoom($data['desc'] -> cl_type, $cid);

        $data['comment'] = $this -> getCommlist($cid);

        $data['num'] = ClassroomCommentModel::where('com_cid', $cid) -> count();

        //判断用户是否点赞该课堂
        $give_status = ClassrommGiveModel::getUserGiveClassroom($uid, $cid);

        if(empty($give_status)){
            $data['desc'] -> give_status = 0;
        }else{
            $data['desc'] -> give_status = 1;
        }

        //判断用户是否收藏该课堂
        $collection = CollectionModel::GetUserCollectionClassroom($uid, $cid);

        if(empty($collection)){
            $data['desc'] -> coll_status = 0;
        }else{
            $data['desc'] -> coll_status = 1;
        }

        $data['desc']['comment_num'] = count($data['comment']);

        return $this -> Result('Success', true, $data, 10000);
    }

    /**
     * @小程序增加课堂分享数
     * @param Request $request
     * @return mixed
     */
    public function classRoomShare(Request $request)
    {
        $cid = $request -> cid;

        $res = ClassroomModel::where('cl_id', $cid) -> increment('cl_share_num', 1);

        if($res){
            return $this -> Result('Success', true, $res, 10000);
        }else{
            return $this -> Result('Error', false, 0, 10001);
        }
    }

    /**
     * @小程序增加课堂点赞数
     * @param Request $request
     * @return mixed
     */
    public function classRoomGive(Request $request)
    {
        $cid = $request -> cid;
        $uid = $request -> uid;

        $res = ClassroomModel::where('cl_id', $cid) -> increment('cl_give_num', 1);

        $res1 = ClassrommGiveModel::insertGiveClassroom($uid, $cid);

        if($res && $res1){
            return $this -> Result('Success', true, $res, 10000);
        }else{
            return $this -> Result('Error', false, 0, 10001);
        }
    }
}
