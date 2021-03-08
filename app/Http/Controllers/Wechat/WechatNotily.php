<?php
/**
 * Created By PhpStorm
 * Data 2019-6-26
 * Time 14:33
 * Name 马哥
 */
namespace App\Http\Controllers\Wechat;
header('content-type: ');
use App\Http\Controllers\Service\BaseController;
use Couchbase\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Model\OrderModel;
use App\Model\VipModel;
use App\Model\UserModel;
use App\Model\ArticleOrderDescModel;
use App\Http\Controllers\Service\StationEmail;
use App\Http\Controllers\Service\Integral;
use App\Http\Controllers\Controller;

/**
 * @微信支付通知
 * @param
 * @return
 *
 * */

class WechatNotily extends BaseController
{
    //初始变量

    protected static $money = 0.01;

    /**
     * 异步通知
     */
    public function notifyUrl()
    {
        $xml = file_get_contents("php://input");
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logs/log.log' , $xml , FILE_APPEND);
//        die;

//        $arr = [
//            'appid' => 'wxe2308e42d3c2048a',
//            'bank_type' => 'OTHERS',
//    'cash_fee' => '1',
//    'fee_type' => 'CNY',
//    'is_subscribe' => 'N',
//    'mch_id' => '1385937402',
//    'nonce_str' => '336358fd7202ba8085adcd08d4009537',
//    'openid' => 'oUb3RslDX418nmQiq-9Ltlpiv1r0',
//    'out_trade_no' => '202004260804535887000393',
//    'result_code' => 'SUCCESS',
//    'return_code' => 'SUCCESS',
//    'sign' => '00242644DA7988871D081A4072C23CA2',
//    'time_end' => '20200426152157',
//    'total_fee' => 1,
//    'trade_type'=> 'NATIVE',
//    'transaction_id' => '4200000567202004269952539574'];

        //将XML格式的数据转换为数组
        $arr = $this -> XmlToArr($xml);

        //file_put_contents('logs/log.log' , print_r($arr , true) , FILE_APPEND);

        if( $this -> checkSign($arr)){        //验证签名

            ///$this -> checkPrice($arr);

            if($this -> checkPrice($arr)){       //验证金额

                echo '<xml>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <return_msg><![CDATA[OK]]></return_msg>
</xml>';

            }else{

                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logs/error.txt' , '异步请求失败。。。' , FILE_APPEND);

            }

        }else{

            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logs/error.txt' , '签名错误。。。' , FILE_APPEND);

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

            $data = OrderModel::where('order_num', $arr['out_trade_no']) -> first();

            if(!empty($data) && $data -> all_price == ($arr['total_fee'] / 100))
            {

                //修改总订单状态
                $res = OrderModel::where('order_num', $arr['out_trade_no'])
                    -> update(['status' => 2, 'transaction_id' => $arr['transaction_id'], 'pay_at' => $arr['time_end']]);

                switch ($data -> _class){

                    case 1:         //杂志订单
                        $res1 = $this -> orderAddIntegral($data);
                        $res2 = true;
                        break;

                    case 2:         //文章订单//修改状态
                        $res1 = ArticleOrderDescModel::where('order_num', $arr['out_trade_no'])
                            -> update(['status' => 1]);
                        $res2 = true;
                        break;

                    case 3:         //VIP订单
                        $vip = VipModel::where('id' , $data -> level) -> first();      //查询VIP表
                        $end = strtotime('+' . $vip -> time . 'month');                         //计算VIP的过期时间
                        $res1 = UserModel::where('id' , $data -> uid)
                            -> update(['is_vip' => $data -> level , 'end_time' => $end , 'up_time' => time()]);
                        $res2 = true;
                        break;
            }


                if($res && $res1 && $res2){

                    return true;
                }
                return false;

            }
                    return false;
        }
                    return false;
    }

    /**
     * 同步通知
     * @param Request $request
     * @return mixed
     */
    public function RefreshOrder(Request $request)
    {
        $ordernum = $request -> orderNum;

        $this -> isEmpty($ordernum, '传入参数错误！请重试');

        $order = OrderModel::where('order_num', $ordernum) -> select('id', '_class', 'status') -> first();

        try {
            $error = 'orderNum DATA is empty';

            if($order){
                if($order -> status == 2){
                    if($order -> _class == 2){
                        $article = ArticleOrderDescModel::where('order_num', $ordernum)
                            -> join('mz_article', 'mz_order_article_descripe.aid', '=', 'mz_article.id')
                            -> select('mz_article.id', 'mz_article.charge_content')
                            -> first();
                        return $this -> resultHandler('SUEECSS' , true , ['msg' => '支付成功', 'data' => $article-> charge_content] , '10000');
                    }
                    return $this -> resultHandler('SUEECSS' , true , '支付成功' , '10000');
                }else{
                    return $this -> resultHandler('ERROR' , false , '未支付' , '10001');
                }

            }else{
                throw new ApiException($error);
            }

        }catch (Exception $e){
            throw new ApiException( $this -> $e);
        }

//        switch ($mode) {
//            case 1:
//                $order = OrderModel::where('order_num', $ordernum)
//                    ->select('order_num', 'status')
//                    ->first();
//                break;
//            case 2:
//                $order = DB::table('mz_user_article')
//                    ->join('mz_article', 'mz_user_article.aid', '=', 'mz_article.id', 'left')
//                    ->where('mz_user_article.order_num', $ordernum)
//                    ->where('mz_user_article.status', 1)
//                    ->select('mz_article.id' , 'mz_article.charge_content')
//                    ->first();
//                break;
//        }
//        dd($order);
//
        return $this -> resultHandler('查询成功' , true , $order , '10000');

    }

    /**
     * @ 购买杂志奖励积分与通知站内信
     * @param $data
     */
    public function orderAddIntegral($data)
    {
        //判断是否是杂志订单 再进行根据数量进行增加积分
        if($data -> _class == 1){
            if(1 <= $data -> all_num && $data -> all_num <= 5){
                //奖励1积分
                $res = Integral::OperationIntegral($data -> uid, 1 , '+');
                //站内信
                StationEmail::AddStationEmail($data -> uid, '恭喜您购买'.$data->all_num.'本杂志，奖励1积分，请注意查收！', 1);
                //积分详情
                $res1 = Integral::IntergraLogs($data -> uid, '购买杂志', '收入', '1', '1');
            }elseif (6 <=  $data -> all_num &&  $data -> all_num <= 10){
                //奖励2积分
                $res = Integral::OperationIntegral($data -> uid, 2 , '+');
                //站内信
                StationEmail::AddStationEmail($data -> uid, '恭喜您购买'.$data->all_num.'本杂志，奖励2积分，请注意查收！', 1);
                //积分详情
                $res1 = Integral::IntergraLogs($data -> uid, '购买杂志', '收入', '2', '1');
            }elseif(11 <= $data -> all_num && $data -> all_num <= 50){
                //奖励5积分
                $res = Integral::OperationIntegral($data -> uid, 5 , '+');
                //站内信
                StationEmail::AddStationEmail($data -> uid, '恭喜您购买'.$data->all_num.'本杂志，奖励5积分，请注意查收！', 1);
                //积分详情
                $res1 = Integral::IntergraLogs($data -> uid, '购买杂志', '收入', '5', '1');
            }elseif(51 <= $data -> all_num && $data -> all_num <= 100){
                //奖励10积分
                $res = Integral::OperationIntegral($data -> uid, 10 , '+');
                //站内信
                StationEmail::AddStationEmail($data -> uid, '恭喜您购买'.$data->all_num.'本杂志，奖励10积分，请注意查收！', 1);
                //积分详情
                $res1 = Integral::IntergraLogs($data -> uid, '购买杂志', '收入', '10', '1');
            }elseif (101 <= $data -> all_num){
                //奖励15积分
                $res = Integral::OperationIntegral($data -> uid, 15 , '+');
                //站内信
                StationEmail::AddStationEmail($data -> uid, '恭喜您购买'.$data->all_num.'本杂志，奖励15积分，请注意查收！', 1);
                //积分详情
                $res1 = Integral::IntergraLogs($data -> uid, '购买杂志', '收入', '15', '1');
            }
            return $res;
        }
    }
}
