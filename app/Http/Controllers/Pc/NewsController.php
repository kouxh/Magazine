<?php

namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\PublicColumn;
use App\Model\BannerModel;
use App\Model\ColumnModel;
use App\Model\HeaderModel;
use App\Model\MagazineModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use Illuminate\Support\Facades\DB;
use App\Model\ArticleModel;
use App\Model\NewsModel;
use App\Model\ActivityModel;
use Illuminate\Support\Facades\Session;

class NewsController extends BaseController
{
    /**
     * 新闻列表
     * @return mixed
     */
    public function newsList()
    {
        $data['column'] = ColumnModel::column('xw');                          //获取column的id

        $son_column = $this -> getSonColumn($data['column'] -> id);       //获取栏目下的子栏目

        //判断是否是二级栏目  是  查询父级栏目的广告图
        if(!empty($data['column'] -> p_id)){
            $fatherColumn = ColumnModel::where('id' , $data['column'] -> p_id) -> first();
            $data['column'] -> Pc_advert = $fatherColumn -> Pc_advert;
            $data['column'] -> App_advert = $fatherColumn -> App_advert;
            $data['column'] -> Pc_advert_url = $fatherColumn -> Pc_advert_url;
        }

        //dd($son_column);
        if(!$son_column -> isEmpty()){

            $data['list'] = ArticleModel::whereInArticle($son_column , 6);

        }else{

            $data['list'] = NewsModel::news(6);

        }

        #获取数据
        $data = PublicColumn::getPublicColumn($data);


        //随机栏目下的数据
        foreach($data['rand'] as $key => $val){
            $data['rand'][$key] -> data = ArticleModel::article($val -> id ,'3');
        }

        //活动的开始时间
        foreach($data['activity'] as $k => $v){
            $data['activity'][$k] -> start_at = substr($v -> start_at , 0  ,strpos($v -> start_at ,' ' ) +1);
        }

        //区分
        foreach ($data['list'] as $k => $v){

            $data['list'][$k] -> crea_at = date('Y-m-d' , $v -> crea_at);
            $data['list'][$k] -> english = 'xw';

            if($v -> class_id == 1){

                $data['list'][$k] -> column = '业界新闻';

            }else{

                $data['list'][$k] -> column = '活动新闻';

            }
        }
//        dd($data);
        return view('Pc/Article/list') -> with('data' , $data);

    }

    /**
     * 新闻详情
     * @param $id
     * @return mixed
     */
    public function newsDesc($id)
    {

        $uid = $this -> getSessionUserId();
        $data['uid'] = 0;
        if($uid){
            $data['uid'] = $uid;
        }

        NewsModel::where('id' , $id) -> increment('view' , 1);               //增加阅读量

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部
        //dd($id);
        $data['content'] = NewsModel::content($id);                          //查询文章
//        dd($data);
        $data['content'] -> crea_at = date('Y-m-d' , $data['content'] -> crea_at);

        $data['content'] -> free_content = $data['content'] -> content;

        //查询栏目
        $column = DB::table('mz_column') -> where('english' , 'xw') -> first();

        //判断是否是二级栏目  是  查询父级栏目的广告图
        if(!empty($column -> p_id)){
            $fatherColumn = ColumnModel::where('id' , $column -> p_id) -> first();
            $column -> Pc_advert = $fatherColumn -> Pc_advert;
            $column -> App_advert = $fatherColumn -> App_advert;
            $column -> Pc_advert_url = $fatherColumn -> Pc_advert_url;
        }

        //相关文章
        $data['relevant'] = NewsModel::where('id' , '!=' , $data['content'] -> id)
            -> where('status' , 1)
            -> where('class_id' , 1)
            -> orderBy(DB::raw('RAND()'))
            -> take(3)
            -> select('id' , 'title' , 'img' , 'message' , 'author' )
            -> get();

        //猜你喜欢
        $data['like'] = NewsModel::where('status' , 1)
            -> orderBy('crea_at' , 'desc')
            -> select('id' , 'title' , 'img' , 'message' , 'author' )
            -> limit(3)
            -> get();

        /*相关文章*/
        foreach ($data['relevant'] as $k => $v){
            $data['relevant'][$k] -> english = 'xw';
        }

        /*猜你喜欢*/
        foreach ($data['like'] as $k => $v){
            $data['like'][$k] -> english = 'xw';
        }

        /*杂志*/
        $data['magazine'] = MagazineModel::where('status', 1) -> select('m_id', 'year', 'title', 'cover_img') -> orderBy('crea_time', 'desc') -> first();
//        dd($data);
        /*加载模板*/
        return view('Pc/Article/desc') -> with(['data' => $data , 'title' =>  '新闻' , 'list' => $column]);
    }


    /**
     * 获取栏目下的子栏目
     * @param $column_id
     * @return mixed
     */
    protected function getSonColumn($column_id)
    {
        return  ColumnModel::getSonColumn($column_id);
    }
}
