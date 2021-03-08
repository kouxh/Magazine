<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\LiveModel;
use App\Model\LiveUserModel;
use App\Model\UserModel;

class Live extends CheckParameter
{
    /**
     * @获取直播内容
     * @param Request $request
     * @return mixed
     */
    public function getLiveDesc(Request $request)
    {

        $uid = $request -> uid;
        $id = $request -> id;

        $data = LiveModel::where('l_id', $id) -> first();

        $userInfo = UserModel::where(['id' => $uid]) -> select('company') -> first();

        $userLive = LiveUserModel::where(['l_id' => $id, 'u_id' => $uid]) -> first();

        if($userInfo -> company){
            $data -> userInfo = '1';
        }else{
            $data -> userInfo = '0';
        }

        if($userLive){
            $data -> status = '已报名';
        }else{
            $data -> status = '未报名';
        }

        return $this -> Result('Success', true, $data, 10000);
    }

    /**
     * @获取直播列表
     * @param Request $request
     * @return mixed
     */
    public function getLiveList(Request $request)
    {
        $uid = $request -> uid;

        $data = LiveModel::select('l_id', 'l_img', 'l_title', 'start_at', 'end_at') -> get();

        foreach($data as $key => $val){
            $userLive = LiveUserModel::where(['l_id' => $val -> l_id, 'u_id' => $uid]) -> first();
            if(!empty($userLive) && strtotime($val -> end_at) < time()){
                $data[$key] -> status = '已学习';
            }elseif (empty($userLive) && strtotime($val -> end_at) < time()){
                $data[$key] -> status = '未学习';
            }elseif (!empty($userLive) && strtotime($val -> end_at) > time()){
                $data[$key] -> status = '已报名';
            }
            $data[$key] -> start_at = substr($val -> start_at, strpos(    $val -> start_at, '-')+1,-3);
            $data[$key] -> end_at=  substr($val -> end_at, strpos(    $val -> end_at, '-')+1,-3);
        }
        return $this -> Result('Success', true, $data, 10000);
    }

}
