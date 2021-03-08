<?php

namespace App\Http\Controllers\Applets\Forum\Prepay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\Forum\Prepay\Comput;
use App\Http\Controllers\Applets\Forum\Pay\Pay;
use App\Exceptions\ApiException;
use App\Model\UserModel;

/**
 * @ 创建(单独)支付
 * Class Together
 * @package App\Http\Controllers\Applets\Forum\Prepay
 */
class Alone extends PayConfigure implements Comput
{
    public function establishPay($json)
    {
        //JSON转成数组
        $data = $this -> JsonToArr($json);
        //验证VIPid是否正确
        $this -> verificationVid($data);
        //获取VIP金额与名字
        $vipData = $this -> getVipMoneyAndName($data);
        //获取用户OpenID
        $userData = $this -> getUserOpenId($data);
        //获取订单号
        $orderNum = $this -> getOrederNum($data['uid']);
        //需要参数 $uid, $money, $name, $openid, $orderNum, $vid,$level,$payChoice
        $data = (new Pay) -> getPrepayId($data['uid'], $vipData -> money, $vipData -> name, $userData -> openid, $orderNum, $data['vid'], 2, $data['payChoice']);

        return $this -> Result('Success', true, $data, 10000);
    }
}