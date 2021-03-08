<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\Wechat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Service\BaseController;
use App\Model\UserModel;
use App\Model\CodeModel;
use App\Exceptions\ApiException;

class WechatLogin extends BaseController
{
    /**
     * @微信扫码登陆
     * @param Request $request
     * @return mixed
     */
    public function wechatLogin(Request $request)
    {

        $code = $request -> code;

        $token = Wechat::getToken($code);

        $info = UserModel::where('openid', $token['openid']) -> first();

        if(empty($info)){

            $user_info = Wechat::getUserInfo($token['access_token'], $token['openid']);

            Session::put('info' , $user_info);

            return redirect("/?type=2");

        }else{
            Session::put('users' , $info);
            return redirect("/");

        }
    }

    /**
     * @绑定手机号
     * @param Request $request
     * @return mixed
     */
    public function bangTell(Request $request)
    {
        $tell = $request -> tell;
        $code = $request -> code;
        $info = Session::get('info');

        $data = UserModel::where('tell', $tell) -> select('*') ->  first();

        //根据手机号查询用户  如果有值 是否绑定微信  如果没值 直接创建永华  验证手机号是否绑定微信  如果有返回 ， 如果没有
        if(!empty($data) && $data -> openid){
            return $this -> resultHandler('ERROR' , false , ['msg' => '该手机已绑定其他账号，请重新输入手机号'] , '10001');
        }

        //查询验证码
        $tellcode = CodeModel::where('code', $code) -> select('tell', 'end_time') -> first();

        if(empty($tellcode)){

            throw new ApiException('验证码不正确');

        }else if($tellcode -> end_time < time()){

            throw new ApiException('验证码已过期');

        }else if($tell != $tellcode -> tell){

            throw new ApiException('请输入正确手机号');

        }

        //如果手机号查询用户不为空 并且openid 为空  验证验证码  对的情况 直接修改  不对返回验证码错误
        if(!empty($data)){
            if(empty($data -> openid)){
                //可以绑定手机号
                $res = UserModel::where('tell', $tell) -> update(['openid' => $info['openid'], 'unionid' => $info['unionid']]);

                if($res){
                    Session::put('users' , $data);
                    return $this -> resultHandler('SUCCESS' , true , ['msg' => '绑定成功'] , '10000');
                }else{
                    return $this -> resultHandler('ERROR' , false , ['msg' => '绑定失败'] , '10001');
                }

            }
        }else{

            $user_info = ['tell' => $tell, 'openid' => $info['openid'], 'unionid' => $info['unionid']
                , 'account' => $info['nickname'],'pwd' => md5('123456'), 'crea_time' => time()];

            $id = UserModel::insertGetId($user_info);

            if($id){
                $user_info['id'] = $id;
                Session::put('users' , $user_info);
                return $this -> resultHandler('SUCCESS' , true , ['msg' => '绑定成功,初始密码为123456,请及时修改,防止账号被盗'] , '10000');
            }else{
                return $this -> resultHandler('ERROR' , false , ['msg' => '绑定失败'] , '10001');
            }
        }

    }



    //测试获取SEEEION的值
    public function getSessionInfo()
    {
        $info = Session::get('users');

        dd($info);
    }



}
