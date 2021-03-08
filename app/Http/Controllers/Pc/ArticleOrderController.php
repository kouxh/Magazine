<?php
/**
 * Created By PhpStorm
 * Date:2019-7-31
 * Time:18：52
 * Name:马哥
 */
namespace App\Http\Controllers\Pc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ApiException;
use App\Model\ArticleModel;

class ArticleOrderController extends CommonController
{
    /**
     * 文章订单
     * @param Request $request
     * @return mixed
     */
    public function choiceMode(Request $request)
    {


//        $order_num = $this->getCreaOreder(self::$uid);              //获取订单号
//        //dd($order_num);
//        //支付方式
//        switch ($mode) {
//
//            case 1:
//                $end_at = strtotime('+0.5 hours');
//
//
//
//                if ($res && $res1 && $res2) {
//
//                    return $this -> resultHandler('下单成功。。', true, $data = ['order_num' => $order_num], 10000);
//
//                } else {
//
//                    return $this->resultHandler('下单失败', false, $data = [], 10001);
//
//                }
//            break;      //金钱购买
//
//            case 2:
//                $user = DB::table('mz_users')->where('id', self::$uid)->select('integral')->first();
//
//                $article = ArticleModel::where('id', $aid) -> select('id', 'integral', 'charge_content') -> first();
//
//                $data = DB::table('mz_user_article') -> where(['uid' => self::$uid, 'aid' => $article -> id]) -> select('status') -> first();
//
//
//                if(!empty($data)){
//                    //判断是否购买过文章
//                    if($data -> status == 1){
//                        throw new ApiException('您已购买过文章，请不要重复购买');
//                    }
//                }
//
//                if ($user->integral == 0.00 || $user->integral < $article->integral) {
//
//                    throw new ApiException('您的积分不足');
//
//                } else {
//
//                    //处理逻辑    比如写入积分详情   写入已购买文章表
//
//                    DB::beginTransaction();
//
//                    try {
//
//                        $res = DB::table('mz_users')->where('id', self::$uid)->decrement('integral', $article->integral);
//
//                        $res1 = DB::table('mz_user_article')->insert(['order_num' => $order_num, 'uid' => self::$uid, 'aid' => $aid, 'crea_at' => time(), 'status' => 1, 'class' => 2]);
//
//                        $res2 = DB::table('mz_integral_log')->insert(['uid' => self::$uid, 'content' => '购买文章', 'num' => $article->integral, 'status' => 2, 'class' => 1, 'crea_at' => time()]);
//
//                        $res3 = DB::table('mz_cumulative')->insert(['uid' => self::$uid, 'integral' => $article->integral, 'crea_at' => time()]);
//
//                        if ($res && $res1 && $res2 && $res3) {
//
//                            DB::commit();
//                            return $this->resultHandler('购买成功', true, $article -> charge_content, 10000);
//
//                        } else {
//
//                            return $this->resultHandler('购买失败', false, $data = [], 10001);
//                        }
//
//
//                    } catch (Exception $e) {
//
//                        DB::rollback();
//
//                        throw new ApiException($this->$e);
//
//                    };
//                }
//            break;      //积分购买
//
//            case 3:
//                echo '敬请期待';
//            break;      //余额购买
//        }
//    }


}
