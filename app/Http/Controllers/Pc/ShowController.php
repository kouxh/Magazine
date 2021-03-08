<?php
/**
 * Created By PhpStorm
 * Date 2019-6-26
 * Time 15:35
 * Name 马哥
 */
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\BaseController;
use App\Model\ColumnModel;
use App\Model\MagazineModel;
use Illuminate\Support\Facades\Session;
use App\Model\ArticleModel;
use App\Model\ActivityModel;
use App\Model\HeaderModel;
use App\Model\NewsModel;
use App\Model\BannerModel;

class ShowController extends BaseController
{
    /**
     * 首页
     * @return mixed
     */
    public function showPage()
    {
        $data['header'] = HeaderModel::getHeaderInfo();             //头部
        $data['observation'] = ArticleModel::article(3);            //观察
        $data['frontier'] = ArticleModel::article(4);               //前沿理论
        $data['case_list'] = ArticleModel::article(5);              //案例
        $data['technigue'] = ArticleModel::article(8);              //新技术
        $data['interview'] = ArticleModel::article(7 ,4);           //人物
        $data['recommended'] = ArticleModel::article(9,2);          //荐读
        $data['activity'] = ActivityModel::activity();                       //活动

        $data['news'] = NewsModel::news();                                   //新闻
        $data['magazine'] = MagazineModel::magazine();                       //杂志
        $data['img'] = ColumnModel::where('english' , 'sy') -> get();
//        dd($data['img']);
        foreach ($data['news'] as $key => $val){

            $data['news'][$key] -> crea_at = date('Y-m-d' , $val -> crea_at);

        }

        foreach($data['activity'] as $k => $v){         //活动的开始时间

            $data['activity'][$k] -> start_at = substr($v -> start_at , 0  ,strpos($v -> start_at ,' ' ) +1);

        }

        foreach ($data['observation'] as $key => $val){

            $data['observation'][$key] -> crea_at = date('Y-m-d' , $val -> crea_at);

        }

        $session = Session::get('users');

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        return view('Pc/Show/show') -> with(['data' => $data , 'session' => $session]);

    }

    /**
     * 法律声明
     */
    public function flsm()
    {

        $data['header'] = HeaderModel::getHeaderInfo();                      //头部
        $data['column']['search']['column'] = '';

        return view('Pc/Public/flsm') -> with('data', $data );
    }

    /**
     * 服务协议
     */
    public function fwxy()
    {

        $data['header'] = HeaderModel::getHeaderInfo();                      //头部
        $data['column']['search']['column'] = '';
        return view('Pc/Public/fwxy') -> with('data', $data );
    }

    /**商家入驻*/
    public function sjrz()
    {
        //描述
        $data['column'] = ColumnModel::column('yj');
        $data['header'] = HeaderModel::getHeaderInfo();                      //头部
        $data['column']['column'] = '';
        return view('Pc/Public/sjrz') -> with('data', $data );
    }

    /**
     * 404页面
     */
    public function magazine404()
    {

        $data['header'] = HeaderModel::getHeaderInfo();                      //头部
        $data['column']['search']['column'] = '';
        return view('Pc/404/404') -> with('data', $data );
    }

    /*预售页面*/
    /**
     * @ 加载预售页面
     * @return mixed
     */
    public function advancesale()
    {

        $data['header'] = HeaderModel::getHeaderInfo();                      //头部
        $data['column']['search']['column'] = '';
        return view('/Pc/Public/ys') -> with('data', $data);
    }

    /**
     * 讲堂介绍
     * @return mixed
     */
    public function jtjs()
    {
        //描述
        $data['column'] = ColumnModel::column('yj');
        $data['header'] = HeaderModel::getHeaderInfo();                      //头部
        $data['column']['column'] = '';
        return view('/Pc/Public/jtjs') -> with('data', $data);
    }



}
