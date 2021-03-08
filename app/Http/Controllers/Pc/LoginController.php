<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/5/30
 * Time: 10:30
 */
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ApiException;

class LoginController extends BaseController
{

    /*调试  加载登陆*/
    public function loadLogin()
    {
        return view('Pc/Login/login');
    }

    /**
     * 登陆
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $tell = $request -> account;

        $pwd = $request -> pwd;


        $user_info = DB::Table('mz_users') -> where(['tell' => $tell]) -> first();

        $user_info = json_decode(json_encode($user_info), true);


        if(empty($user_info)){                          //判断有没有账号

            return $this -> resultHandler('没有该账号' , false , $data = [] , '10001');

        } else if($user_info['pwd'] != md5($pwd)){    //判断密码是否正确

            return $this -> resultHandler('账号密码不符' , false , $data = [] , '10001');

        }else{                                           //登陆成功  返回用户信息、Token

            unset($user_info -> pwd);       //消除密码

            //登陆成功存入Session

            $key = Session::put('users' , $user_info);

            return $this -> resultHandler('登陆成功。。。' , true , $data = [$key] , '10000');

        }
    }

    /**
     * 验证码登陆
     * @param Request $request
     * @return mixed
     */
    public function codeLogin(Request $request)
    {
        $tell = $request -> phone;

        $code = $request -> code;

        $info = DB::table('mz_code') -> where(['code' => $code]) -> first();

        if(empty($info)){

            throw new ApiException('验证码不正确。。。');

        }else if($info -> end_time < time()){

            throw new ApiException('验证码已过期。。。');

        }else if($tell != $info -> tell){

            throw new ApiException('请输入正确手机号。。。');

        }

        $user_info = DB::Table('mz_users') -> where(['tell' => $tell]) -> first();

        $user_info = json_decode(json_encode($user_info), true);

        if(empty($user_info)){                          //判断有没有账号

            return $this -> resultHandler('没有该账号' , false , $data = [] , '10001');

        }else{

            unset($user_info['pwd']);       //消除密码

            //登陆成功存入Session

            $key = Session::put('users' , $user_info);

                return $this -> resultHandler('登陆成功' , true , $data = [] , '10000');

        }
    }
    /*调试  找回密码*/
    public function forgotpwd()
    {
        return view('Pc/forgotpwd/forgotpwd');
    }

}
