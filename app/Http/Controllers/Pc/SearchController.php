<?php

namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\BaseController;
use Illuminate\Http\Request;
use App\Model\HeaderModel;
use App\Model\ArticleModel;
use App\Model\ActivityModel;
use App\Model\MagazineModel;
use App\Model\ColumnModel;
use App\Model\NewsModel;

class SearchController extends BaseController
{

    // $type 为搜索点击的是文章还是新闻;
    public function search(Request $request)
    {
        $keyword = $request -> keyword;

        $type = $request -> type;

        //处理关键词
        $keyword = self::HandleKeyword($keyword);

        //搜索文章的标题
        if ($type == 'zy' && $keyword['class'] == 'title')
        {
            $data['list'] = ArticleModel::getArticleTitle(8 , 1 , $keyword['keyword']);
        }
        //搜索文章的关键词
        elseif ($type == 'zy' && $keyword['class'] == 'keyboard')
        {
            $data['list'] = ArticleModel::getArticleKeyboard(8 , 1 , $keyword['keyword']);
        }
        //搜索新闻的标题
        elseif ($type == 'xw' && $keyword['class'] == 'title')
        {
            $data['list'] = NewsModel::getNewsTitle($keyword['keyword'] ,1 ,8);
            $data = self::HandleNewsList($data);
        }
        //搜索新闻的关键词
        elseif ($type == 'xw' && $keyword['class'] == 'keyboard')
        {
            $data['list'] = NewsModel::getNewsKeyword($keyword['keyword'] ,1 ,8);
            $data = self::HandleNewsList($data);
        }

        /*设置页面title  content*/
        $data['column']['search']['column']= $keyword['keyword'];
        $data['column']['search']['title']= $keyword['keyword'] . "-管理会计研究";
        $data['column']['search']['describe']= '';

        //头部
        $data['header'] = HeaderModel::getHeaderInfo();
        //活动
        $data['activity'] = ActivityModel::activity();
        //杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        //热度
        $data['top'] = ArticleModel::topNum();
        //随机栏目
        $data['rand'] = ColumnModel::randColumn(3);
        //荐读
        $data['jd'] = ArticleModel::article(9 ,3);

        $data['type'] = $type;

        //随机栏目下的数据
        foreach($data['rand'] as $key => $val){
            $data['rand'][$key] -> data = ArticleModel::article($val -> id ,'3');
        }

        //转化时间
        foreach ($data['list'] as $k => $v){
            $data['list'][$k] -> crea_at = date('Y-m-d' , $v -> crea_at);
        }

        //活动的开始时间
        foreach($data['activity'] as $k => $v){
            $data['activity'][$k] -> start_at = substr($v -> start_at , 0  ,strpos($v -> start_at ,' ' ) +1);
        }

//        dd($data);
        return view('Pc/Search/search') -> with('data' , $data);
    }

    /**
     * 处理关键词
     * @param $keyword
     * @return array|null
     */
    static private function HandleKeyword($keyword)
    {
        //为空返回null
        if(empty($keyword)){
            return null;
        }

        //去掉左右特殊符号
        $keyword = trim($keyword);

        //判断是标题还是关键词
        if(strlen($keyword) >= 30){
//            dd(strlen($keyword).'123');
            return $arr = ['class' => 'title' , 'keyword' => $keyword];
        }else{
//            dd(strlen($keyword).'456');
            return $arr = ['class' => 'keyboard' , 'keyword' => $keyword];
        }
    }

    /**
     * 处理搜索后新闻列表
     * @param $data
     * @return mixed
     */
    static private function HandleNewsList($data)
    {
        //为空返回null
        if(empty($data)){
            return null;
        }

        foreach ($data['list'] as $k => $v){

            $data['list'][$k] -> english = 'xw';

            if($v -> class_id == 1){

                $data['list'][$k] -> column = '业界新闻';

            }else{

                $data['list'][$k] -> column = '活动新闻';

            }
        }
        return $data;
    }
}
