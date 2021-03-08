<?php

namespace App\Http\Controllers\Applets\Forum\Prepay;

use Illuminate\Http\Request;
use App\Http\Controllers\Applets\Forum\Prepay\Comput;
use App\Http\Controllers\Applets\Forum\Pay\Pay;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use App\Model\UserModel;

/**
 * @ 创建(团购一起付)支付
 * Class Together
 * @package App\Http\Controllers\Applets\Forum\Prepay
 */
class Together extends PayConfigure implements Comput
{
    public function establishPay($json)
    {
        //JSON转成数组
        $data = $this -> JsonToArr($json);
        //验证VIPid是否正确
        $this -> verificationVid($data);
        //获取用户OpenID
        $userData = $this -> getUserOpenId($data);
        //获取订单号
        $orderNum = $this -> getOrederNum($data['uid']);
        //获取VIP金额与名字
        $vipData = $this -> getVipMoneyAndName($data);
        //验证用户传过来的手机号合集，并且返回手机号数组
        $telephoneCollection = $this -> verificationTelephoneCollection($data);
        //把手机号数组循环插入数据库
        $res = $this -> loopInsertTell($telephoneCollection, $orderNum);
        //获取一起付的总价
        $money = $vipData -> money * count($telephoneCollection);
        //需要参数 $uid, $money, $name, $openid, $orderNum, $vid,$level
        $data = (new Pay) -> getPrepayId($data['uid'], $money, $vipData -> name, $userData -> openid, $orderNum, $data['vid'], 3, $data['payChoice']);

        return $this -> Result('Success', true, $data, 10000);
    }
}
