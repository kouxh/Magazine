<?php
/**
 * Created By PhpStorm
 * Data 2019-6-26
 * Time 14:33
 * Name 马哥
 */
namespace App\Http\Controllers\Wechat;

use App\Exceptions\ApiException;
use App\Http\Controllers\Service\BaseController;
use Illuminate\Http\Request;
use App\Qrcode\Qrcode;
use Illuminate\Support\Facades\DB;
use App\Model\OrderModel;

class PatternTwoPay extends BaseController
{
    /**
     * 生成微信支付码
     * @param $orderNum
     * @param $price
     * @return mixed
     */
    public function getQrUrl($orderNum , $price)
    {
        $money = floatval($price) * 100;        //计算价钱

        //调用统一下单API
        $params = [
            'appid' => config('pay.AppID'),
            'mch_id' => config('pay.mch_id'),
            'nonce_str' => md5(time()),
            'body' => '管理会记杂志网站',
            'out_trade_no' => $orderNum,
            'total_fee' => $money,
            'spbill_create_ip' => $_SERVER['SERVER_ADDR'],
            'notify_url' =>  config('pay.NOTIFY'),
            'trade_type' => 'NATIVE',
            'product_id' => $orderNum
        ];
        //dd($params);

        $arr = $this -> unifiedorder($params);
//        dd($arr);
        if($arr){
            return $arr['code_url'];
        }else{
            throw new ApiException('请不要重复提交订单！谢谢！');
        }


    }

    /**
     * 微信支付二维码
     *
     * @param Request $request
     */
    public function GenerateCodeApi(Request $request){

        $orderNum = $request -> orderNum;       //接受订单号

        if(empty($orderNum))
        {
            throw new ApiException('参数错误');
        }

        $data = OrderModel::where('order_num' , $orderNum)
            -> first();

        $data = json_decode(json_encode($data) , true);

        if(empty($data)){                               //查询订单
            //echo "<script>alert('订单号错误')</script>>";
            throw new ApiException('订单号错误');
        }

        if($data['end_at'] < time()){                   //过期订单

            $res = DB::table('mz_order') -> where('order_num' , $orderNum) -> update(['status' => 6]);

            if($res){
                throw new ApiException('订单已过期，请重新下单');
            }else{
                throw new ApiException('订单错误');
            }
        }

            $qrurl = $this -> getQrUrl($orderNum , $data['all_price']);
            QRcode::png($qrurl);
    }
}
