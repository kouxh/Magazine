<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\UserModel;

/**
 * @用户管理
 * Class MagazineComment
 * @package App\Http\Controllers\Home
 */
class User extends BaseController
{
    /**
     * @加载用户列表
     * @return string
     */
    public function userList()
    {
        return view('/Home/User/list');
    }


    /**
     * @ 文章评论分页列表
     * @param Request $request
     * @return mixed
     */
    public function userPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;         //搜索词

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = UserModel::HomeUserList($page, $limit, $searContent);

        $count = userModel::HomeUserCount($searContent);

        foreach($data as $k => $v)
        {
            if($v -> is_vip > 1){
                $data[$k] -> is_vip = '是';
            }else{
                $data[$k] -> is_vip = '否';
            }
            $data[$k] -> crea_time = date("Y-m-d", $v -> crea_time);
        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @ 修改用户积分
     * @param Request $request
     * @return mixed
     */
    public function editIntegral(Request $request)
    {
        $integral = $request -> integral;
        $id = $request -> id;

        $res = UserModel::where('id', $id) -> update(['integral' => $integral, 'up_time' => time()]);

        if($res){
            return $this -> resultHandler('修改成功' , true , $res, 10000);
        }else{
            return $this -> resultHandler('修改失败' , false ,0 , 10001);
        }
    }

    /**
     * @ 修改用户余额
     * @param Request $request
     * @return mixed
     */
    public function editBalance(Request $request)
    {
        $balance = $request -> balance;

        $id = $request -> id;

        $res = UserModel::where('id', $id) -> update(['balance' => $balance, 'up_time' => time()]);

        if($res){
            return $this -> resultHandler('修改成功' , true , $res, 10000);
        }else{
            return $this -> resultHandler('修改失败' , false ,0 , 10001);
        }
    }

    /**
     * @ 删除用户
     * @param Request $request
     * @return mixed
     */
    public function DoDel(Request $request)
    {
        $id = $request -> id;

        $res = UserModel::where('id', $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @ 重置密码
     * @param Request $request
     * @return mixed
     */
    public function resetPwd(Request $request)
    {
        $id = $request -> id;

        $res = UserModel::where('id', $id) -> update(['pwd' => md5('123456'), 'up_time' => time()]);

        if($res){
            return $this -> resultHandler('重置成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('重置失败' , false , $data = [] , 10001);
        }
    }
}
