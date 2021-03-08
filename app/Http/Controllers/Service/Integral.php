<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use App\Model\IntegralModel;

/**
 *  操作积分
 * Class Integral
 * @package App\Http\Controllers\Service
 */
class Integral extends Controller
{
    /**
     * @增加或者减少积分
     * @param $uid      用户ID
     * @param $integral 积分
     * @param $oper     增加或者是减少
     * @return bool|string
     */

    static public function OperationIntegral($uid, $integral, $oper)
    {
        #验证参数
        if(!is_numeric($uid) || !is_numeric($integral)){
            return '参数错误';
        }

        #操作数据库
        if($oper == '+'){
            $res = UserModel::where('id', $uid) -> increment('integral', $integral);
        }elseif ($oper == '-'){
            $res = UserModel::where('id', $uid) -> decrement('integral', $integral);
        }else{
            return 'oper参数错误';
        }
        return true;
    }

    /**
     * @ 积分详情
     * @param $uid  用户id
     * @param $msg  提示语
     * @param $integral 积分
     * @param $_class   类别 1积分2金钱3余额
     * @param $status   变化 1收入2支出3期限
     * @return bool
     */
    static public function IntergraLogs($uid, $msg, $status, $integral, $_class)
    {
        if($status == '收入'){
            $status = 1;
        }else if($status == '支出'){
            $status = 2;
        }else if($status == '期限') {
            $status = 3;
        }

        $res = IntegralModel::AddIntegralLog($uid, $msg, $status, $integral, $_class);

        if($res){
            return true;
        }else{
            return false;
        }
    }
}
