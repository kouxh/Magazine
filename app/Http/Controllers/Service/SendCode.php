<?php

namespace App\Http\Controllers\Service;

use App\Exceptions\ApiException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service;
use Illuminate\Support\Facades\DB;

class SendCode extends BaseController
{
    //发送验证码
    public function sendCode(Request $request)
    {
        $ip = $this -> get_real_ip();

        $phone = $request -> phone;

        if(empty($phone) || !is_numeric($phone)){

            throw new ApiException('参数错误。。。');

        }

        $mode = $_SERVER['HTTP_MODE'];

        if(empty($mode)){
            throw new ApiException('缺少参数');
        }

        switch ($mode){

            case 1:
                $info = DB::table('mz_users') -> where('tell' , $phone) -> first();

                if(!empty($info)){
                    throw new ApiException('改手机号已注册。。。');

                }
                break;

        }

        //限制IP开始
        $data = DB::table('mz_ip') -> where('ip' , $ip) -> first();

//        if(!$data){
//
//            DB::table('mz_ip') -> insert(['ip' => $ip , 'num' => 1 , 'end_at' => strtotime('+1 minute')]);
//
//        }else{
//
//            if($data -> end_at > time()){
//
//                throw new ApiException('请稍后再试。。。');
//
//            }else{
//
//                DB::table('mz_ip') -> where('ip' , $ip) -> increment('num' , 1);
//                DB::table('mz_ip') -> where('ip' , $ip)  -> update(['end_at' => strtotime('+1 minute')]);
//
//            }
//        }
        //限制IP结束

        $code = $this -> creaCode();

        $end_time = strtotime('+5 minute');         //过期时间

        $info = DB::table('mz_code') -> where(['tell' => $phone]) -> first();   //判断code表是否有数据 有数据修改 没有数据添加

        if(empty($info)){

            DB::table('mz_code') -> insert(['tell' => $phone , 'code' => $code , 'end_time' => $end_time , 'crea_time' => time()]);

        }else{

            DB::table('mz_code') -> where(['tell' => $phone]) -> update(['code' => $code , 'end_time' => $end_time , 'up_time' => time()]);

        }

        $res = Sms::send($phone , $code);

        $codeData = json_decode($res, true);

        if($codeData['Code'] == 'OK' && $codeData['Message'] == 'OK'){
            return $this -> resultHandler('发送成功' , 'true' , $data = [] , '10000');
        }else{
            return $this -> resultHandler('发送失败' , 'false' , $data = ['msg' => '请稍后再试'] , '10001');
        }

    }

    //生成验证码
    public function creaCode()
    {
        $code = rand(000000,999999);

        if(strlen($code) < 6){

            $code = rand(000000,999999);
        }
        if(strlen($code) < 6) {

            $code = rand(000000, 999999);
        }

        return $code;
    }

    /**
     * 获取客户端ip
     * @return bool|mixed
     */
    private function get_real_ip()
    {
        $ip = false;
        if (!empty($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && !$ip) {
            $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = false;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match("/^(10|172.16|192.168).$/", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }

        return ($ip ? $ip : $_SERVER['HTTP_CLIENT_IP']);

    }
}
