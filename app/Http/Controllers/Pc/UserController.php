<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/6/5
 * Time: 15:46
 */

namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Redis;
use App\Model\MagazineModel;
use App\Model\UserModel;
use App\Model\ArticleModel;
use App\Model\KeywordModel;
use App\Model\ColumnModel;
use App\Model\OrderModel;
use App\Model\AddressModel;
use App\Model\ArticleOrderDescModel;
use App\Model\StationEmailModel;
use App\Http\Controllers\Service\PublicColumn;
use \Exception;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Wechat\WechatNotily;


/**
 * 个人中心
 * Class UserController
 * @package App\Http\Controllers\Pc\
 */
class UserController extends CommonController
{

    /**
     * @ 获取头部信息
     * @return mixed
     */
    public function GetHeader()
    {
        return self::$header;
    }

    /**
     * 退出登陆
     * @param Request $request
     * @return mixed
     */
    public function OutLogin(Request $request)
    {
        Session::pull('users');

        return $this->resultHandler('退出成功', true, $data = 1, 10000);
    }

    /**
     * 积分明细
     * @return mixed
     */
    public function integralDesc(Request $request)
    {
        $mode = $_SERVER['HTTP_MODE'];

        $data['total'] = 123;
        $data['log'] = '';
        switch ($mode) {
            case 'desc':
                $data['log'] = DB::table('mz_integral_log')->where('class', 1)->select('id', 'content', 'num', 'crea_at', 'status')->get();
                break;
            case 'income':
                $data['log'] = DB::table('mz_integral_log')->where('class', 1)->where('status', 1)->select('id', 'content', 'num', 'crea_at', 'status')->get();
                break;
            case 'expenditure':
                $data['log'] = DB::table('mz_integral_log')->where('class', 1)->where('status', 2)->select('id', 'content', 'num', 'crea_at', 'status')->get();
                break;
            case 'end':
                return $this->resultHandler('敬请期待', true, $data, 10000);
                break;
        }

        foreach ($data['log'] as $k => $v) {
            if ($v->status == 1) {
                $data['log'][$k]->num = '+ ' . $v->num;
            }
            if ($v->status == 2) {
                $data['log'][$k]->num = '- ' . $v->num;
            }
            $data['log'][$k]->care_time = date('Y-m-d H:i:s', $v->crea_at);
            unset($data['log'][$k]->status);
            unset($data['log'][$k]->crea_at);
        }

        return $this->resultHandler('成功', true, $data, 10000);
    }

    /**
     * 我的订单
     * @param Request $request
     */
    public function myOrder(Request $request)
    {
        $status = empty($request->status) ? 0 : $request->status;

        $arr = [1, 2, 3, 4, 5, 6, 7];

        if (!in_array($status, $arr)) {

            throw new ApiException('参数错误。。。');

        }

        $keyword = $request->keyword;


        if ($keyword == 1) {          //显示三个月订单

            $end = time();

            $start = strtotime("-0 year -3 month -0 day");
        }

        if ($keyword == 2) {          //显示全部订单

            $end = 0;
            $start = 0;

        }

        if ($status != '') {

            $end = 0;
            $start = 0;

        }

        $data = $this->OrderDesc($status, $start, $end);

        return $this->resultHandler('成功', true, $data, 10000);

    }

    /**
     * 我的关注
     * @param Request $request
     * @return mixed
     */
    public function myFollow(Request $request)
    {

        $data['kid'] = DB::table('mz_users')->where('id', self::$uid)->select('kid')->first();

        $kid = explode(',', $data['kid']->kid);

        unset($data['kid']);

        $data['list'] = DB::table('mz_keyword')->where('status', 1)->whereIn('id', $kid)->select('id', 'title')->get();

        $id = empty($request->id) ? $data['list'][0]->id : $request->id;   //设置默认展示关注的列表

        $data['desc'] = DB::table('mz_article')
            ->join('mz_class', 'mz_article.class_id', '=', 'mz_class.id', 'left')
            ->where('mz_article.keyword', 'like', "$id%")
            ->select('mz_article.id', 'mz_article.title', 'mz_class.english', 'mz_article.keyword')
            ->get();

        return $this->resultHandler('成功', true, $data, 10000);

    }

    /**
     * 加载关注编辑
     * @param Request $request
     * @return mixed
     */
    public function editFollow(Request $request)
    {
        $follow = DB::table('mz_keyword')->where('class', '!=', 3)->select('id', 'title')->get();

        return $this->resultHandler('成功', true, $follow, 10000);

    }

    /**
     * 执行关注编辑
     * @param Request $request
     * @return mixed
     */
    public function editDoFollow(Request $request)
    {
        $data['kid'] = $request->kid;

        $data['up_time'] = time();

        $data['kid'] = trim($data['kid'], ',');

        $res = DB::table('mz_users')->where('id', self::$uid)->update($data);

        if ($res) {
            return $this->resultHandler('成功', true, $data = [], 10000);
        } else {
            return $this->resultHandler('失败', false, $data = [], 10001);
        }
    }

    /**
     * @个人中心首页
     */
    public function userPageShow()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        $data['cart'] = DB::table('mz_cart')-> where('u_id', self::$uid)-> count();
        $data['user'] = DB::table('mz_users')-> where('id', self::$uid)-> select('account', 'photo', 'is_vip', 'balance', 'integral', 'kid') -> first();
        $data['notice'] = DB::table('mz_notice')-> where('status', 1)-> limit(3)->select('id', 'message')-> orderBy('crea_at', 'desc') -> get();
        $data['remind'] = DB::table('mz_remind')-> where('status', 1)->limit(3)->select('id', 'message')->orderBy('crea_at', 'desc') -> get();
        $data['order'] = $this -> OrderDesc(0, 0, 0);

        //关注
        $follow = UserModel::where('id', self::$uid) -> select('kid') -> first();
        if(!empty($data['user'] -> kid)){
            $kid = explode(',', $follow->kid);
            $data['follow'] = KeywordModel::whereIn('id', $kid) -> select('id', 'title') -> get();
        }else{
            $data['follow'] = [[]];
        }


        if(!empty($data['user'] -> kid)){
            $kid = explode(',', $data['user'] -> kid);

            //猜你喜欢
            $data['like'] = ArticleModel::like($kid[0]);

            foreach ($data['like'] as $k => $v){
                $data['like'][$k] -> wz_url = $v -> english . '/list/' . $v -> id;
            }
        }else{
            $data['like'] = [[]];
        }



    #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();

        #站内通知
        $data['email'] = StationEmailModel::where('em_uid', self::$uid) -> where('em_status', 2)-> count();

        #广告图
        $data['img'] = DB::table('mz_all_img') -> where('type', 1) -> first();



        return view('/Pc/User/userpageshow') -> with('data', $data);
    }

    /**
     * @加载基本信息
     */
    public function loadInfo()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        //关注
        $data['info'] = UserModel::where('id', self::$uid) -> select('name', 'tell', 'email', 'sex', 'age', 'company', 'occupation', 'kid') -> first();
        $kid = explode(',', $data['info'] -> kid);
        $data['follow'] = KeywordModel::whereIn('id', $kid) -> select('id', 'title') -> get();

        return view('/Pc/User/loadinfo') -> with('data', $data);
    }

    /**
     * @ 修改手机号
     * @return mixed
     */
    public function upTell()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/uptell') -> with('data', $data);

    }


    /**
     * @加载积分页面
     */
    public function loadIntegral()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/integral') -> with('data', $data);
    }

    /**
     * @ 生成订单页面
     * @return mixed
     */
    public function orderPay()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        #收货地址
        $data['address'] = AddressModel::where('u_id' , self::$uid)
            -> where('status' , 1)
            -> select('id', 'consignee' , 'city' , 'area' , 'county' , 'desc_address' , 'tell' , 'zip_code')
            -> first();
        //dd($data);
        return view('/Pc/User/orderpay') -> with('data', $data);
    }


    /**
     * @加载订单
     */
    public function loadOrder()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();

        $data['order'] = $this -> OrderDesc(0, 0, 0);

        return view('/Pc/User/order') -> with('data', $data);
    }

    /**
     * @ 支付页面
     * @return mixed
     */
    public function Pay(Request $request)
    {
        $paymode = $request -> payMode;
        $ordernum = $request -> ordernum;

        #获取头部信息
        $data['header'] = $this -> GetHeader();

        try {
            $error = "Please input the '1', '2' symbols of Math.";

            switch($paymode){
                case '1' :  //余额支付
                    return $this -> balancePay($ordernum);
                    break;
                case '2' :  //微信支付
                    return view('/Pc/User/pay') -> with('data', $data);
                    break;
                default:
                    throw new Exception($error);
            }
            return flase;

        }catch (Exception $e){
            echo 'Caught exception: ',  $e -> getMessage(), "\n";
            exit;
        }
    }

    /**
     * @余额支付
     * @return mixed
     * @throws Exception
     */
    protected function balancePay($ordernum)
    {

        $order = OrderModel::where('order_num', $ordernum) -> select('all_price', 'all_num', '_class', 'uid') -> first();

        if(!$order){
            throw new Exception('订单号错误');
        }

        $user = UserModel::where('id', self::$uid) -> select('balance') -> first();

        //判断用户余额是否充足
        if($user -> balance < $order -> all_price){
            throw new Exception('余额不足');
        }else{
            $newbalance =  $user -> balance - $order -> all_price;
        }

        $res = UserModel::where(['id' => self::$uid]) -> update(['balance' => $newbalance, 'up_time' => time()]);
        $res1 = true;
        $res2 = true;
        if($order -> _class == 1){
            $res1 = (new WechatNotily) -> orderAddIntegral($order);  //通知站内信
        }
        if($order -> _class == 2){
            $res2 = ArticleOrderDescModel::where('order_num', $ordernum) -> update(['status' => 1]);
        }
        if($res & $res1 & $res2){
            $res1 = OrderModel::where('order_num', $ordernum) -> update(['status' => 2, 'pay_at' => time()]);

            if($res1){
                return $this -> resultHandler('SUCCESS', true, 1, 10000);
            }
        }
        return $this -> resultHandler('ERROR', false, 0, 10001);


        //获取订单号
        //查询订单金额
        //取出用户余额进行扣款
        //返回扣款成功或者失败
    }


    /**
     * @开通会员
     */
    public function openingVip()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/openingvip') -> with('data', $data);
    }

    /**
     * @收货地址
     */
    public function harvestAddress()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/harvestaddress') -> with('data', $data);
    }

    /**
     * @新建收货地址
     * @return mixed
     */
    public function creaaddress()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/creaaddress') -> with('data', $data);
    }

    /**
     * @提交稿件
     */
    public function subContributions()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/subcontributions') -> with('data', $data);
    }

    /**
     * @我的红包
     */
    public function myRedeEnvelopes()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/myredeenvelopes') -> with('data', $data);
    }

    /**
     * @我的留言
     */
    public function myMessage()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/mymessage') -> with('data', $data);
    }

    /**
     * @我的收藏
     */
    public function myCollection()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/mycollection') -> with('data', $data);
    }

    /**
     * @修改密码
     */
    public function modifyPass()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/modifypass') -> with('data', $data);
    }

    /**
     * @资金管理
     */
    public function capitalAdmin()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/capitaladmin') -> with('data', $data);
    }

    /**
     * 我的购物车
     * @return mixed
     */
    public function myCart()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/mycart') -> with('data', $data);
    }

    /**
     * @ 成为会员
     * @return mixed
     */
    public function czVip()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/czvip') -> with('data', $data);
    }

    /**
     * @审核稿件
     * @return mixed
     */
    public function auditManuscript()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/shgj') -> with('data', $data);
    }

    /**
     * @ 发票信息
     * @return mixed
     */
    public function invoiceInfo()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('/Pc/User/fpxx') -> with('data', $data);
    }


    /**
     * 成为会员
     * @param Request $request
     * @return mixed
     */
    public function becomeVip(Request $request)
    {

        $arr = [1, 2, 3, 4];

        $id = $request->mode;

        if (empty($id) || !in_array($id, $arr)) {

            throw new ApiException('参数错误。。。');

        }

        $order_num = $this->getCreaOreder(self::$uid);              //获取订单号

        $vip = DB::table('mz_vip')->where('id', $id)->first();

        $end_at = strtotime('+0.5 hours');      //过期时间

        /*添加到总订单*/
        $res = DB::table('mz_order')
            ->insert(['order_num' => $order_num, 'level' => $vip->level, '_class' => 3, 'uid' => self::$uid, 'all_price' => $vip->money, 'all_num' => 1, 'crea_at' => time(), 'end_at' => $end_at]);

        if ($res) {
            return $this->resultHandler('成功', true, $order_num, 10000);
        } else {
            return $this->resultHandler('下单失败', false, $data = [], 10001);
        }
    }





    /*下载参选表格*/
    public function downloadFile(Request $request)
    {

        $files = 'http://test.chinamas.cn/docx/参选表格.docx';

        header("refresh:1;url = $files");
    }

    /*我要投稿*/
    public function Contribute()
    {
        return $this->resultHandler('', true, $data = [], 10000);
    }

    /*我的文章*/
    public function myArticle()
    {
        #获取头部信息
        $data['header'] = $this -> GetHeader();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        return view('Pc/User/myarticle') -> with('data', $data);

    }



}
