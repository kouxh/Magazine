<?php

namespace App\Http\Controllers\BusinessLogic\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use App\Http\Controllers\BusinessLogic\Order\Order;
use App\Model\UserModel;
use App\Model\VipModel;
use App\Model\VipOrderDescModel;
use \Exception;

class VipOrder extends Order implements Comput
{
    public function creaOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        $orderNum = self::$orderNum;    //获取订单号

        $this -> isEmpty($data['vid'], '传入不是vip参数');

        try {
            $error = "Please input the '1', '2' , '3 , '4'vid value";

            if($data['vid'] < 5){

                //查询VIP相关数据
                $vip = VipModel::where('id', $data['vid']) -> select('time', 'integral', 'money') -> first();

                //设置订单过期时间
                $end_at = strtotime('+0.5 hours');

                //添加到总订单
                $res = $this -> InsertBigOrder(['order_num' => $orderNum, 'uid' => $uid, 'all_price' => $vip -> money, 'all_num' => 1, '_class' => 4, 'crea_at' => time(),
                    'end_at' => $end_at]);

                //加入到VIP详细
                $res1 = VipOrderDescModel::insert(['order_num' => $orderNum, 'uid' => self::$uid, 'vid' => $data['aid'], 'crea_at' => time()]);

                if ($res && $res1) {
                    return $this -> resultHandler('创建订单成功' , true , $orderNum , 10000);
                }else{
                    return $this -> resultHandler('创建订单失败' , false , 0 , 10001);
                }
            }else{
                throw new Exception($error);
            }

        }catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            exit;
        }
//            //计算VIP过期时间
//            $endAt = strtotime("".$vip -> time." month");


        echo 'VIP订单';
    }
}
