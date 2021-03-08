<?php
/**
 * Created By PhpStorm
 * Date 2019-7-31
 * Time 10:55
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use App\Model\AuthorityModel;
use App\Model\RoleColumnModel;
use App\Model\RoleModel;
use App\Model\AccountNumModel;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Service\BaseController;
use App\Model\LoginModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends BaseController
{
    /*欢迎页*/
    public function welcome(){

        $username = Session::get('username');       //获取用户昵称

        $date = date('Y-m-d H:i:s' , time());       //获取当前时间

        $num = AccountNumModel::count();

        return view('/Home/Welcome/welcome') -> with('name' , $username -> nikename) -> with('date' , $date) -> with('num', $num);
    }

    /*首页*/
    public function index()
    {
        $username = Session::get('username');       //获取用户昵称

        $role = RoleModel::getRole($username -> id);

        $role_id = explode( ',' , $role -> role_id );

        $role = DB::table('mz_role') -> whereIn('id' , $role_id) -> get();
        //dd($role);
        return view('/Home/Index/index') -> with('name' , $username -> nikename) -> with('role' , $role);

    }
}
