<?php

namespace App\Http\Controllers\Applets\Forum\Pay;

use Couchbase\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Http\Controllers\Applets\Forum\Pay\Operation\OperationFactory;
use App\Model\UserModel;
use App\Model\OrderModel;
use App\Model\VipOrderDescModel;
use App\Model\CheckTellModel;
use App\Model\AppletsMailModel;

class Notify extends CheckParameter
{
    //初始变量
    protected $money;

    /**
     * @异步通知
     */
    public function notifyUrl()
    {
        $xml = file_get_contents("php://input");
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/applets/logs/log.log', $xml, FILE_APPEND);
//        $xml = '<xml><appid><![CDATA[wxc7e3c8a2629a168b]]></appid>
//<bank_type><![CDATA[ICBC_DEBIT]]></bank_type>
//<cash_fee><![CDATA[2]]></cash_fee>
//<fee_type><![CDATA[CNY]]></fee_type>
//<is_subscribe><![CDATA[N]]></is_subscribe>
//<mch_id><![CDATA[1581252551]]></mch_id>
//<nonce_str><![CDATA[5f980854e5cc5]]></nonce_str>
//<openid><![CDATA[owKgL4zGLQ_eNqw3xZr2FVJUNHSc]]></openid>
//<out_trade_no><![CDATA[202010271145241392103824]]></out_trade_no>
//<result_code><![CDATA[SUCCESS]]></result_code>
//<return_code><![CDATA[SUCCESS]]></return_code>
//<sign><![CDATA[370EC6A04AADA4C601798530E3DB134A]]></sign>
//<time_end><![CDATA[20201027194536]]></time_end>
//<total_fee>2</total_fee>
//<trade_type><![CDATA[JSAPI]]></trade_type>
//<transaction_id><![CDATA[4200000747202010273408634721]]></transaction_id>
//</xml>
//';
        //将XML格式的数据转换为数组
        $arr = $this->XmlToArr($xml);

        if ($this->checkSign($arr)) {        //验证签名

            if ($this->checkPrice($arr)) {       //验证金额
                echo '<xml>
                        <return_code><![CDATA[SUCCESS]]></return_code>
                        <return_msg><![CDATA[OK]]></return_msg>
                        </xml>';
            } else {
                //dd('异步请求失败。。。');
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/applets/logs/error.txt', '金额错误', FILE_APPEND);
            }
        } else {
            //dd('签名错误。。。');
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/applets/logs/error.txt', '签名错误。。。', FILE_APPEND);
        }
    }

    /**
     * 查询订单号的金额
     * @param $arr
     * @return bool
     */
    public function checkPrice($arr)
    {

        if ($arr['return_code'] == 'SUCCESS' && $arr['result_code'] == 'SUCCESS') {

            //查询订单信息
            $data = OrderModel::where('order_num', $arr['out_trade_no'])
                -> select('id', 'order_num', 'all_price', 'level', 'uid')
                -> first();

            if (!empty($data) && $data->all_price == ($arr['total_fee'] / 100)) {

                $obj = OperationFactory::CreateOperation($arr, $data);
                $res = $obj -> establishNotify($arr, $data);
                if ($res) {

                    return true;
                }
                return false;

            }
            return false;
        }
        return false;
    }

    /**
     * @把注册的用户修改为会员
     * @param $orderNum
     * @param $vid
     * @param $end
     */
    public function togetherPay($orderNum, $vid, $end)
    {
        $tellData = CheckTellModel::where('t_orderNum', $orderNum) -> select('t_tell') -> get();
        foreach ($tellData as $key => $val){
            $user = UserModel::where('tell', $val -> t_tell) -> first();
            if(!empty($user)){
                UserModel::where('tell', $val -> t_tell)
                    ->update(['is_vip' => $vid, 'start_time' => time(), 'end_time' => $end, 'up_time' => time()]);
            }
        }
    }
}
