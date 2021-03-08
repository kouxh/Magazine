<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Service\BaseController;
use App\Model\RoleColumnModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Role extends BaseController
{
    /**
     * 加载权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roleList()
    {
        return view('/Home/Role/list');
    }

    /**
     * 权限列表分页
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function rolePage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = RoleColumnModel::where('status' , 1)
            -> select('id' , 'role_name' , 'role_list' , 'role_url' , 'role_icon')
            -> orderBy('crea_at' , 'desc')
            -> offset($page)
            -> limit($limit)
            -> get();

        $count =RoleColumnModel::where('status' , 1)
            -> count();

        foreach ($data as $key => $val){
            $data[$key] -> crea_at = date('Y-m-d' , $val -> crea_at);
        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * 加载添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roleAdd()
    {
        return view('/Home/Role/add');
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function roleDoAdd(Request $request)
    {
        $data = $request -> data;

        $data['crea_at'] = time();

        $res = RoleColumnModel::insert($data);

        if($res){
            return $this -> resultHandler('添加成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('添加失败' , false , $data = [] , 10001);
        }
    }

    /**
     * 加载编辑
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roleEdit(Request $request)
    {
        $id = $request -> id;

        $data = RoleColumnModel:: where('id' , $id)-> select('id' , 'role_name' , 'role_list' , 'role_url' , 'role_icon') -> first();

        return view('Home/Role/edit') -> with('data' , $data);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function roleDoEdit(Request $request){

        $data = $request -> data;

        $data['up_at'] = time();

        $res = RoleColumnModel::where('id' , $data['id']) -> update($data);

       if($res){
           return $this -> resultHandler('编辑成功' , true , $data = [] , 10000);
       }else{
           return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
       }
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function roleDel(Request $request)
    {
        $id = $request -> id ;

        $res = RoleColumnModel::where('id' , $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
        }
    }
}
