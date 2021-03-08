<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Service\BaseController;
use App\Model\LoginModel;
use App\Model\RoleColumnModel;
use App\Model\RoleModel;
use Illuminate\Http\Request;

/**
 * 管理员管理
 * Class User
 * @package App\Http\Controllers\Home
 */
class Admin extends BaseController
{
    /**
     * 加载管理员列表
     * @return string
     */
    public function adminList()
    {
        return view('/Home/Admin/list');
    }

    /**
     * 管理员列表分页
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function adminPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = LoginModel::where('status' , 1)
            -> offset($page)
            -> limit($limit)
            -> orderBy('crea_at' , 'desc')
            -> select('id' , 'username' , 'nikename' , 'crea_at')
            -> get();

        $count =LoginModel::where('status' , 1)
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
    public function adminAdd()
    {
        $role = RoleColumnModel::getColumn();

        return view('/Home/Admin/add') -> with('role' , $role);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function adminDoAdd(Request $request)
    {
        $data = $request -> data;

        $uid = LoginModel::insertGetId(['username' => $data['username'] , 'password' => md5($data['password']), 'nikename' => $data['nickname'], 'crea_at' => time()]);

        if($uid){

            $res = RoleModel::insert(['user_id' => $uid , 'role_id' => $data['role_id'] , 'crea_at' => time()]);
        }

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
    public function adminEdit(Request $request)
    {
        $uid = $request -> id;

        $role = RoleColumnModel::getColumn();

        $user = LoginModel::where('id' , $uid) -> select('id' , 'username' , 'nikename' , 'crea_at') -> first();

        $user_role = RoleModel::where('user_id' , $uid) -> select('role_id') -> first();

       return view('Home/Admin/edit') -> with(['role' => $role , 'user' => $user , 'user_role' => $user_role]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function adminDoEdit(Request $request){

        $data = $request -> data;

        LoginModel::where('id' , $data['uid']) -> update(['username' => $data['username'] , 'nikename' => $data['nickname'] , 'up_at' => time()]);

        RoleModel::where('user_id' , $data['uid']) -> update(['role_id' => $data['role_id'] , 'up_at' => time()]);

        return $this -> resultHandler('编辑成功' , true , $data = [] , 10000);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function adminDel(Request $request)
    {
        $uid = $request -> id ;

        $res = LoginModel::where('id' , $uid) -> delete();

        $res2 = RoleModel::where('user_id' , $uid) -> delete();

        if($res && $res2){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
        }
    }
}
