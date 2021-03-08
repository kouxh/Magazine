<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\CollectionModel;
use App\Model\ClassroomModel;

class Collection extends CheckParameter
{
    /**
     * @小程序收藏列表
     * @param Request $request
     * @return mixed
     */
    public function collectionList(Request $request)
    {
        $uid = $request -> uid;

        $data = CollectionModel::GetClassroomCollection($uid);

        return $this -> Result('Success', true, $data, 10000);

    }

    /**
     * @小程序加入收藏
     * @param Request $request
     * @return mixed
     */
    public function insertCollection(Request $request)
    {
        $json = $request -> json;

        $jsonArr = $this -> jsonToArr($json);

        $res = CollectionModel::where(['coll_uid' => $jsonArr['uid'], 'coll_coll_id' => $jsonArr['c_id']]) -> first();

        if($res){
            return $this -> Result('Error', false, ['msg' => '您已经收藏过了'], 10001);
        }

        $res1 = CollectionModel::insert(['coll_uid' => $jsonArr['uid'], 'coll_coll_id' => $jsonArr['c_id'], 'coll_type' => $jsonArr['type'], 'coll_crea_at' => time()]);

        $res2 = ClassroomModel::where('cl_id', $jsonArr['c_id']) -> increment('cl_collection_num', 1);

        if($res1&&$res2){
            return $this -> Result('Success', true, $res1, 10000);
        }else{
            return $this -> Result('Error', false, ['msg' => '添加失败！稍后尝试'], 10001);
        }
    }
}
