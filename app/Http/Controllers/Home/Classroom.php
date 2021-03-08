<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\ClassroomModel;
use App\Model\DimensionModel;

class Classroom extends BaseController
{
    /**
     * @加载课堂列表
     * @return string
     */
    public function classroomList()
    {
        return view('/Home/Classroom/list');
    }

    /**
     * @ 课堂分页列表
     * @param Request $request
     * @return mixed
     */
    public function classroomPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = ClassroomModel::HomeClassroomList($page, $limit);

        $count = ClassroomModel::HomeClassroomCount();


        foreach($data as $k => $v)
        {

            $data[$k] -> cl_crea_at = date("Y-m-d H:i:s", $v -> cl_crea_at);
        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @ 加载课堂添加
     * @param Request $request
     * @return mixed
     */
    public function classroomAdd()
    {
        $zy = DimensionModel::where('class' , 2) -> get();
        return view('/Home/Classroom/add') -> with('zy', $zy);
    }

    /**
     * @执行课堂添加
     * @param Request $request
     * @return mixed
     */
    public function classroomDoAdd(Request $request)
    {
        $data = $request -> data;
        unset($data['file']);
        $data['cl_crea_at'] = time();
        //dd($data);
        $res = ClassroomModel::insert($data);
        if($res){
            return $this -> resultHandler('增加成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('增加失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @记载课堂编辑
     * @param Request $request
     * @return mixed
     */
    public function classroomedit(Request $request)
    {
        $id = $request -> id;
        $data = ClassroomModel::where('cl_id', $id) -> first();
        $zy = DimensionModel::where('class' , 2) -> get();
        return view('/Home/Classroom/edit') -> with('data', $data) -> with('zy', $zy);
    }

    /**
     * @执行课堂编辑
     * @param Request $request
     * @return mixed
     */
    public function ClassroomDoedit(Request $request)
    {
        $data = $request -> data;
        unset($data['file']);
        $data['cl_up_at'] = time();
        $res = ClassroomModel::where('cl_id', $data['cl_id']) -> update($data);
        if($res){
            return $this -> resultHandler('修改成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('修改失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @课堂删除
     * @param Request $request
     * @return mixed
     */
    public function ClassroomDel(Request $request)
    {
        $id = $request -> id;
        $res = ClassroomModel::where('cl_id', $id) -> delete();
        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }
    }

}
