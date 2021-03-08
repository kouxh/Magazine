<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/5/30
 * Time: 10:30
 */
namespace App\Http\Controllers\Pc;

use App\Exceptions\ApiException;
use App\Http\Controllers\Service\BaseController;
use App\Http\Controllers\Service\Integral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\StationEmailModel;

class RegController extends BaseController
{

    /**
     * 加载关键词页面
     * @return mixed
     */
    public function Interest()
    {
        return view('Pc/Register/interest');
    }


    /**
     * 加载关键词
     * @return mixed
     */
    public function loadKeyword()
    {
        $data = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , '=' , '2') -> select('id' , 'title') -> get();

        return $this -> resultHandler('Yes' , true , $data , '10000');

    }

    /**
     * 加载注册页面
     * @return mixed
     */
    public function loadRegister()
    {
        return view('Pc/Register/register');
    }

    /**
     * 注册
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
          $code = $request -> code;

          $pwd = $request -> pwd;

          $info = DB::table('mz_code') -> where(['code' => $code]) -> first();

          if(empty($info)){

              throw new ApiException('验证码不正确。。。');

          }else if($info -> end_time < time()){

              throw new ApiException('验证码已过期。。。');

          }

          $data = [
              'account' => $request -> account,
              'pwd' => md5($pwd),
              'tell' => $request -> phone,
              'crea_time' => time(),
              'kid' => $request -> kid,
              'integral' => 2
          ];

          $data['kid'] = trim($data['kid'] , ',');

          $tell = DB::table('mz_code') -> where('tell' , $data['tell']) -> first();

          if(empty($tell) || $code != $tell -> code){

              throw new ApiException('请输入正确手机号。。。');

          }

          $user_info = DB::table('mz_users') -> where(['tell' => $data['tell']]) -> first();

          $account = DB::table('mz_users') -> where('account' , $data['account']) -> first();

          if(!empty($account)){

              return $this -> resultHandler('该用户名已存在' , false , $data=[] , '10001');

          }


          if(!empty($user_info)){           //判断手机号有没有注册

              return $this -> resultHandler('改手机号已注册' , false , $data=[] , '10001');
          }


          $uid = DB::table('mz_users') -> insertGetId($data);      //插入数据库

          if($uid){
              //通知消息
              $res = StationEmailModel::addEmail($uid, '恭喜您成为管理会计研究杂志的普通会员，奖励2积分，请注意查收！', 1);
              //积分详情
              $res1 = Integral::IntergraLogs($uid, '注册成功', '收入', '2', '1');

              if($res && $res1){
                  return $this -> resultHandler('注册成功' , true , $res , '10000');
              }
          }

          return $this -> resultHandler('注册失败' , false , $res , '10001');


    }
}
