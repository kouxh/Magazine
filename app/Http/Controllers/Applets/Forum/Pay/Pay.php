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

class Pay extends Base
{
    public function getPrepayId($uid, $money, $name, $openid, $orderNum, $vid, $level, $payChoice)
    {
        //按照顺序生成数组生成签名
        if($payChoice == 1){
            $params['appid']           =      config('appletsCmasPay.AppID');
        }elseif ($payChoice == 2){
            $params['appid']           =      config('appletsPlusPay.AppID');
        }

        $params['body']                =      $name;
        $params['mch_id']              =      config('appletsPlusPay.mch_id');
        $params['nonce_str']           =      uniqid();
        $params['notify_url']          =      config('appletsPlusPay.NOTIFY');
        $params['out_trade_no']        =      $orderNum;
        $params['spbill_create_ip']    =      $_SERVER['REMOTE_ADDR'];
        $params['total_fee']           =      $money * 100;
        $params['trade_type']          =      'JSAPI';
        $params['openid']              =      $openid;
//        dd($params);
        //统一下单获取prepay_id
        $data = $this -> unifiedorder($params);
            $res = OrderModel::insert(['order_num' => $orderNum, 'uid' => $uid, 'all_price' => $money,
                '_class' => 4,  'crea_at' => time(), 'level' => $level, 'end_at' => strtotime('+0.5 hour')]);

            $res1 = VipOrderDescModel::insert(['order_num' => $orderNum, 'vid' => $vid, 'uid' => $uid,
                'price' => $money,'crea_at' => time()]);

            $params1['appId'] = $params['appid'];
            $params1['timeStamp'] = time();
            $params1['nonceStr'] = uniqid();
            $params1['package'] = 'prepay_id='.$data['prepay_id'];
            $params1['signType'] = 'MD5';
            $params1['sign'] = $this -> getSign($params1);
            if($res){
                return $params1;
            }
            return '添加订单信息错误';
    }
}
