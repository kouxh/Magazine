<?php

namespace App\Http\Controllers\Applets\Forum\Pay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Http\Controllers\Applets\Base;
use App\Model\UserModel;
use App\Model\OrderModel;
use App\Model\VipModel;
use App\Model\VipOrderDescModel;

class Refund extends Base
{
    const URL = 'https://api.mch.weixin.qq.com/secapi/pay/refund';

    /**
     * @ 退款接口
     * @param $orderNum
     * @param $money
     * @return mixed
     */
    public function refundApi($orderNum, $money)
    {
        //按照顺序生成数组生成签名
        $params['appid']               =      config('appletsCmasPay.AppID');
        $params['mch_id']              =      config('appletsCmasPay.mch_id');
        $params['nonce_str']           =      uniqid();
        $params['notify_url']          =      config('appletsCmasPay.NOTIFY');
        $params['out_trade_no']        =      $orderNum;
        $params['out_refund_no']       =      'F-'.rand(6,12);
        $params['total_fee']           =      $money * 100;
        $params['refund_fee']          =      $money * 100;
        $sign                          =      $this -> getSign($params);

        $params['sign'] = $sign;
        $params1 = $this -> ArrToXml($params);
        $data = $this -> refundRequest(self::URL, $params1);

        return $this -> XmlToArr($data);
    }
}