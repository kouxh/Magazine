<?php

namespace App\Http\Controllers\BusinessLogic\Order;

use App\Model\IntegralModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BusinessLogic\Order\Order;
use \Exception;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use App\Model\ArticleOrderDescModel;
use App\Model\ArticleModel;
use App\Model\UserModel;

/**
 * @文章订单
 * Class ArticleOrder
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class ArticleOrder extends Order implements Comput
{
    //创建订单
    public function creaOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        $orderNum = self::$orderNum;    //获取订单号
        $this->isEmpty($data['aid'], '缺少文章id');
        $this->isEmpty($data['mode'], '缺少支付方式');

        //查询是否购买过文章
        $article = ArticleOrderDescModel::where(['uid' => self::$uid, 'aid' => $data['aid'], 'status' => 1])->first();

        //查询文章内容
        $articleData = ArticleModel::where('id', $data['aid'])->select('price', 'charge_content')->first();

        //检测用户重复购买文章
        if (!empty($article)) {
            throw new ApiException('您已经购买过文章，请不要重复购买');
        }

        //设置订单过期时间
        $end_at = strtotime('+0.5 hours');

//        dd($articleData);

        //判断参数是否正确 根据不同的参数进行不同的订单操作
        try {
            $error = "Please input the '1', '2'symbols of Math.";

            //文章不是付费文章
            if($articleData -> price == false && $articleData -> charge_content == false)
            {
                throw new ApiException('传入参数有误！');
            }

            switch ($data['mode']) {
                case '1' :

                    //添加到总订单
                    $res = $this -> InsertBigOrder(['order_num' => $orderNum, 'uid' => $uid, 'all_price' => $articleData -> price, 'all_num' => 1, '_class' => 2, 'crea_at' => time(),
                        'end_at' => $end_at]);

                    //加入到文章详细
                    $res1 = ArticleOrderDescModel::insert(['order_num' => $orderNum, 'uid' => self::$uid, 'aid' => $data['aid'], 'crea_at' => time(), 'status' => 2, '_class' => 1]);

                    if ($res && $res1) {
                        return $this -> resultHandler('创建订单成功' , true , $orderNum , 10000);
                    }
                    break;


                case '2' :

                    //查询用户积分
                    $user = UserModel::where('id', $uid)
                        -> select('integral')
                        -> first();

                    //查询文章相关内容
                    $article = ArticleModel::where('id', $data['aid'])
                        -> select('id', 'integral', 'charge_content')
                        -> first();

                    if ($user->integral == 0.00 || $user->integral < $article->integral) {

                        return $this -> resultHandler('您的积分不足！', false, '', 10001);

                    } else {

                        //处理逻辑    比如写入积分详情   写入已购买文章表

                        DB::beginTransaction();

                        try {

                            //扣掉用户买文章的积分
                            $res = UserModel::where('id',$uid)
                                -> decrement('integral', $article -> integral);
                            //添加到文章详情订单
                            $res1 = ArticleOrderDescModel::insert(['order_num' => $orderNum, 'uid' => $uid, 'aid' => $data['aid'], 'crea_at' => time(), 'status' => 1, '_class' => 2]);
                            //添加积分详情
                            $res2 = IntegralModel::AddIntegralLog($uid, '购买文章', '2', $article -> integral, 1);

                            if ($res && $res1 && $res2) {
                                DB::commit();
                                return $this -> resultHandler('购买成功,请到个人中心文章合集查看', true, $article -> charge_content, 10000);
                            }
                            return true;
                        } catch (Exception $e) {
                            echo 'Caught exception: ', $e->getMessage(), "\n";
                            exit;
                        }
                    }
                default :
                    throw new Exception($error);
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            exit;
        }
    }

    //订单列表
    public function listOrder($data)
    {
        $uid = self::$uid;              //获取用户id
        try {
            //查询用户购买的所有文章订单
            $data = $this -> formOrderNum($uid, $data['type'], $data['status']);
            //查询订单详情
            $desc = ArticleOrderDescModel::SelectOrderDesc($uid);

            foreach ($desc as $key => $val)
            {
                //dd($val['aid']);
                $desc[$key]['url'] = '/'.$val['english'].'/list/'.$val['aid'];
            }

            //拼接数据
            $data = $this -> formOrderData($data, $desc);
            
            return $this -> resultHandler('查询订单成功' , true , $data , 10000);

        }catch (Exception $e){
            throw new ApiException( $this -> $e);
        }
    }

}
