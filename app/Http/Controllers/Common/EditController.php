<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ApiException;
use App\Http\Controllers\Service\BaseController;

class EditController extends BaseController
{
    /**
     * 验证一些信息
     * @param Request $request
     * @return mixed
     */
    public function Verification(Request $request)
    {
        $account = $request -> account;

        $tell = $request -> tell;

        $code = $request -> code;

        $user = DB::table('mz_users') -> where('account' , $account) -> first();

        $data = DB::table('mz_code') -> where('tell' , $tell) -> first();

        if(empty($user)){

            throw new ApiException('该账号不存在。。。');

        }elseif ($tell != $user -> tell){

            throw new ApiException('与绑定的手机号不符。。。');

        }

        if($data -> code != $code || $data -> end_time < time()){

            throw new ApiException('验证码不正确。。。');

        }

        return $this -> resultHandler('可以进行下一步' , true , $data=[] , 10000);


    }

    /**
     * 执行修改密码
     * @param Request $request
     * @return mixed
     */
    public function editPass(Request $request)
    {
        $account = $request -> account;

        $new_pwd = $request -> new_pwd;

        $user = DB::table('mz_users') -> where('account' , $account) -> first();

        if(!$user){

            throw new ApiException('用户名错误。。。');

        }

        $res = DB::table('mz_users') -> where('account' , $account) -> update(['pwd' => md5($new_pwd) , 'up_time' => time()]);

        if($res){

            return $this -> resultHandler('修改成功' , true , $data=[] , 10000);

        }else{

            return $this -> resultHandler('修改失败' , false , $data=[] , 10001);

        }
    }
}
