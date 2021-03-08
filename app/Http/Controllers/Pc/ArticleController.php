<?php
/**
 * Created By PhpStorm
 * Date:2019-8-2
 * Time:9:47
 * Name:马哥
 */
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\PublicColumn;
use App\Model\ColumnModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use Illuminate\Support\Facades\DB;
use App\Model\HeaderModel;
use App\Model\ArticleModel;
use App\Model\MagazineModel;
use App\Model\ActivityModel;
use App\Model\BannerModel;
use App\Model\ArticleOrderDescModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class ArticleController extends BaseController
{
    /**
     * 文章列表
     * @return mixed
     */
    public function articleList(Request $request ,$column)
    {
        if($column == 'yj'){                //业界
            return redirect('/yj');
        }

        if($column == 'zz'){
            return redirect('/zz');    //杂志
        }

        if($column == 'hd'){
            return redirect('/hd');    //活动
        }

        if($column == 'xw'){
            return redirect('/xw');    //新闻
        }
        if($column == 'djt'){
            return redirect('/djt');    //新闻
        }


        $data['column'] = ColumnModel::column($column);                  //获取column的id

        $son_column = $this -> getSonColumn($data['column'] -> id);       //获取栏目下的子栏目

        //判断是否是二级栏目  是  查询父级栏目的广告图
        if(!empty($data['column'] -> p_id)){
            $fatherColumn = ColumnModel::where('id' , $data['column'] -> p_id) -> first();
            $data['column'] -> Pc_advert = $fatherColumn -> Pc_advert;
            $data['column'] -> App_advert = $fatherColumn -> App_advert;
            $data['column'] -> Pc_advert_url = $fatherColumn -> Pc_advert_url;
        }

        if(!$son_column -> isEmpty()){

            $data['list'] = ArticleModel::whereInArticle($son_column , 6);

        }else{

            $data['list'] = ArticleModel::article($data['column'] -> id , 6);

        }

        $data = PublicColumn::getPublicColumn($data);

        //转化时间
        foreach ($data['list'] as $k => $v){
            $data['list'][$k] -> crea_at = date('Y-m-d' , $v -> crea_at);
        }

        #dd($data);
        return view('Pc/Article/list') -> with('data' , $data);



    }

    /**
     * 文章详情
     * @param Request $request
     * @return mixed
     */
    public function articleDesc(Request $request ,$column , $id)
    {

        if($column == 'xw'){
            return redirect('/xw/'.$id);
        }

        $uid = $this -> getSessionUserId();

        if($uid){
            $data['uid'] = $uid;
        }

        ArticleModel::where('id' , $id) -> increment('view' , 1);               //增加阅读量

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        $data['content'] = ArticleModel::content($id);                          //查询文章

        $keyword = explode( ',' , $data['content'] -> keyword );       //关键词

        $data['content'] -> is_charge = 0;

        $charge_content = $data['content'] -> charge_content;

        //查看文章是否收费
        if(!empty($data['content'] -> charge_content)){     //判断是否是付费文章     付费文章
            $data['content'] -> is_charge = 1;
            unset($data['content'] -> charge_content);
        }

        $uid = $this -> getSessionUserId();

        if($uid){
            //如果用户登陆并且文章是收费
            if($data['uid'] != 0 && $data['content'] -> is_charge == 1){

                $users = DB::table('mz_users') -> where('id' ,$data['uid'] ) -> first();        //查询用户是不是 VIP

                if($users -> is_vip != 0 && $users -> end_time > time()) {      //说明是vip

                    $data['content']->is_charge = 2;            //可以免费阅读
                    $data['content'] -> charge_content = $charge_content;

                }else{

                    //查询用户有没有购买过文章
                    $arr = ArticleOrderDescModel::where('uid' , $data['uid']) -> where('aid' , $id) -> where('status' , 1 ) -> select('aid' , 'status') -> first();

                    if(!empty($arr)){       //用户已购买文章
                        //dd($arr);
                        $data['content'] -> is_charge = 3;
                        $data['content'] -> charge_content = $charge_content;
                    }
                }
            }
        }else{
            $data['uid'] = 0;
        }

        $data['content'] -> crea_at = $this -> getDate($data['content'] -> crea_at);        //转化时间为日期

        //查询栏目
        $column = DB::table('mz_column') -> where('english' , $column) -> first();

        //判断是否是二级栏目  是  查询父级栏目的广告图
        if(!empty($column -> p_id)){
            $fatherColumn = ColumnModel::where('id' , $column -> p_id) -> first();
            $column -> Pc_advert = $fatherColumn -> Pc_advert;
            $column -> App_advert = $fatherColumn -> App_advert;
            $column -> Pc_advert_url = $fatherColumn -> Pc_advert_url;
        }

        //相关文章
        $data['relevant'] = ArticleModel::relevant($column -> id , $data['content'] -> id);

        //猜你喜欢
        $data['like'] = ArticleModel::like($data['content'] -> column_id);

        /*杂志*/
        $data['magazine'] = MagazineModel::getFirstMagazine();
        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        return view('Pc/Article/desc') -> with(['data' => $data , 'title' => $column -> column , 'list' => $column]);
    }

    /**
     * 大咖
     * @param Request $request
     * @return mixed
     */
    public function bigShot(Request $request)
    {
        return view('Pc/Shot/bigshot');
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

    /**
     * 获取栏目或子栏目下的维度
     * @return mixed
     */
    protected function getSonDimension()
    {
        $data['zy'] = DB::table('mz_keyword') -> where('class' , 2) -> get();
        $data['hy'] = DB::table('mz_keyword') -> where('class' , 1) -> get();
        return $data;
    }

    /**
     * 维度下的文章列表
     * @param Request $request
     * @return mixed
     */
    public function dimensionList(Request $request){

        $dimension = $request -> dimension;       //接受行业或者专业

        $column_id = $request -> column_id;       //接受栏目的id

        $son_dimension = $request -> son_dimension; //接受子栏目ID

        $hy = $request -> hy;                       //接受行业

        //判断行业是否有值  有值说明 行业下的专业
        if(!empty($hy)){
            $data['list'] = ArticleModel::where('column_id' , $column_id) -> where('hy' , $hy) -> where('zy' , $son_dimension) -> get();
        }

        //查询专业维度所有文章
        if($dimension != '' && $dimension == 'zy')
        {
            $data['list'] =  ArticleModel::getMajorArticle($column_id , 'zy');
        }
        //查询行业维度所有文章
        else if($dimension != '' && $dimension == 'hy')
        {
            $data['list'] =  ArticleModel::getMajorArticle($column_id , 'hy');
        }
        //查询子维度的所有文章
        else if($son_dimension != '')
        {
            $data['list'] = ArticleModel::getSonDimensionArticle($column_id , $son_dimension);
        }

        //转换时间
        foreach ($data['list'] as $k => $v){
            $data['list'][$k] -> crea_at = date('Y-m-d' , $v -> crea_at);
        }
//        dd($data);
        return $this -> resultHandler('查询成功' , 'true' , $data , '10000');
    }

    /**
     * 获取栏目下的子栏目 或者 维度
     * @param Request $request
     * @return mixed
     */
    public function sonColumn(Request $request)
    {
        $column_id = $request -> column_id;

        $column = ColumnModel::where('id' , $column_id) -> first();

        $son_column = ColumnModel::where('p_id' , '=' , $column_id) -> select('id' , 'column') -> get();


        //如果有子栏目  就返回子栏目   如果没有子栏目返回维度
        if(!$son_column -> isEmpty()){

            $data['son_column'] = $son_column;

            $son_column = $this -> getSonColumn($column_id);       //获取栏目下的子栏目

            if(!$son_column -> isEmpty()){

                $data['list'] = ArticleModel::whereInArticleJson($son_column);

            }else{

                $data['list'] = ArticleModel::articleJson($column_id);

            }

        }else if ($son_column -> isEmpty() && $column -> join_dimension == 1){

            //查询维度
            $data = $this -> getSonDimension();

            //查询文章
            $data['list'] = ArticleModel::articleJson($column_id);


        }else{

            //查询栏目下的文章
            $data['list'] = ArticleModel::articleJson($column_id);

        }

        //转换时间
        foreach ($data['list'] as $k => $v){
            $data['list'][$k] -> crea_at = date('Y-m-d' , $v -> crea_at);
        }

        return $this -> resultHandler('查询成功' , 'true' , $data , '10000');
    }


}
