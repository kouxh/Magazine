<?php

namespace App\Http\Controllers\Applets\Forum\Prepay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\Forum\Prepay;
use App\Http\Controllers\Applets\Forum\Pay\Pay;
use App\Exceptions\ApiException;
use App\Model\UserModel;

/**
 * @ 创建(读者)支付
 * Class Together
 * @package App\Http\Controllers\Applets\Forum\Prepay
 */
class Readers extends PayConfigure implements Comput
{
    public function establishPay($json)
    {
        //JSON转成数组
        $data = $this -> JsonToArr($json);
        //验证VIPid是否正确
        $this -> verificationVid($data);
        //验证手机号和验证码是否正确是否购买全年套餐
        $this -> verificationTellCode($data);
        //获取用户OpenID
        $userData = $this -> getUserOpenId($data);
        //获取VIP金额与名字
        $vipData = $this -> getVipMoneyAndName($data);
        //获取订单号
        $orderNum = $this -> getOrederNum($data['uid']);
        //需要参数 $uid, $money, $name, $openid, $orderNum, $vid,$level
        $data = (new Pay) -> getPrepayId($data['uid'], $vipData -> money, $vipData -> name, $userData -> openid, $orderNum, $data['vid'], 1, $data['payChoice']);

        return $this -> Result('Success', true, $data, 10000);
    }

}