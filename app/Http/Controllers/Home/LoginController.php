<?php
/**
 * Created By PhpStorm
 * Date 2019-7-31
 * Time 10:55
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Service\BaseController;
use App\Model\LoginModel;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{
    /**
     * 加载登陆页
     * @return mixed
     */
    public function login()
    {
        return  view('/Home/Login/login');
    }

    /*执行登陆*/
    public function loginDo( Request $request)
    {
        $username = $request -> username;

        $password = $request -> password;

        $data = LoginModel::where(['username' => $username]) -> first();

        if(empty($data)){

            throw new ApiException('没有该账号，请联系管理员');

        }else{

            if($data -> password != md5($password)){

                throw new ApiException('账号与密码不符');

            }
        }

        Session::put('username' , $data);

        return $this -> resultHandler('登陆成功' , true  , $data =[] , 10000);

    }

    public function privilege()
    {
        return view('/Home/403');
    }
}
