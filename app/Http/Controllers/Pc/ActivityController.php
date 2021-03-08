<?php
/**
 * Created By PhpStorm
 * Date 2019-6-24
 * Time 16:23
 * Name 马哥
 */
namespace App\Http\Controllers\Pc;

use App\Model\ArticleModel;
use App\Model\CharacterModel;
use App\Model\ColumnModel;
use App\Model\NewsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\BaseController;
use Illuminate\Support\Facades\DB;
use App\Model\ActivityModel;
use App\Model\ObservationModel;
use App\Model\MagazineModel;
use App\Model\HeaderModel;

class ActivityController extends BaseController
{

    /**
     * 加载活动页面
     * @return mixed
     */
    public function show()
    {
        $info = $this -> get_city();

        if($info['status'] == 0){
            $data['city'] = substr($info['content']['address'] , 0  , 6 );
        }else{
            $data['city'] = '';
        }
        
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();
        $data['activity'] = DB::table('mz_activity') -> where('status' , 1) -> select('id' , 'title' , 'img' , 'start_at' , 'end_at' , 'address') -> orderBy('start_at' , 'desc') -> limit(3) -> get();
        $data['news'] = NewsModel:: where('status' , 1) -> where('class_id' , 2) -> select('id' , 'title' , 'author') -> orderBy('crea_at' , 'desc') -> limit(3) -> get();
        $data['moment'] = NewsModel::where('av_id', '!=', 'null') -> where('join_moment', 1) -> select('id' , 'title' , 'img' , 'author') -> orderBy('crea_at' , 'desc') -> limit(4) -> get();
        $data['food'] = DB::table('mz_av_food') -> where('status' , 1) -> select('id' , 'title' , 'author') -> orderBy('crea_at' , 'desc') -> limit(3) -> get();
        $data['host'] = DB::table('mz_activity') -> where('status' , 1) -> where('type' , 1) ->  select('id' , 'title' , 'img' , 'start_at' , 'host' , 'end_at' , 'address') -> orderBy('start_at' , 'desc') -> limit(3) -> get();
        $data['co_sponsor'] = DB::table('mz_activity') -> where('status' , 1) -> where('type' , 2) ->  select('id' , 'title' , 'img' , 'start_at' , 'address' , 'end_at' , 'status') -> limit(3) -> get();
        $data['other'] = DB::table('mz_activity') -> where('status' , 1) -> where('type' , 3) ->  select('id' , 'title' , 'img' , 'start_at' , 'address' , 'end_at') -> limit(3) -> get();
        $data['range'] = DB::table('mz_activity') -> where('status' , 1) -> distinct('city') -> select('id' , 'city') -> get() -> groupBy('city');
        $data['magazine'] = MagazineModel::getFirstMagazine();
        $data['hd'] = ColumnModel::where('english' , 'hd') -> first();

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        foreach($data['co_sponsor'] as $k => $v){

            if($v -> end_at < date('Y-m-d H:i:s' , time())){
                $data['co_sponsor'][$k] -> status = '已结束';
            }else{
                $data['co_sponsor'][$k] -> status = '报名中';
            }

            $data['co_sponsor'][$k]-> start_at = substr($v -> start_at ,'0' ,strpos($v -> start_at , ' '));
        }

        foreach($data['activity'] as $k => $v){

            if($v -> end_at < date('Y-m-d H:i:s' , time())){
                $data['activity'][$k] -> status = '已结束';
            }else{
                $data['activity'][$k] -> status = '报名中';
            }

            $data['activity'][$k]-> start_at = substr($v -> start_at ,'0' ,strpos($v -> start_at , ' '));

        }

        foreach($data['host'] as $k => $v){

            if($v -> end_at < date('Y-m-d H:i:s' , time())){
                $data['host'][$k] -> status = '已结束';
            }else{
                $data['host'][$k] -> status = '报名中';
            }
            $data['host'][$k]-> start_at = substr($v -> start_at ,'0' ,strpos($v -> start_at , ' '));

        }

        foreach($data['other'] as $k => $v){

            if($v -> end_at < date('Y-m-d H:i:s' , time())){
                $data['other'][$k] -> status = '已结束';
            }else{
                $data['other'][$k] -> status = '报名中';
            }
            $data['other'][$k]-> start_at = substr($v -> start_at ,'0' ,strpos($v -> start_at , ' '));
        }

        return view('Pc/Activity/show') -> with('data' , $data);
    }

    /**
     * 活动详情
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function desc(Request $request , $id)
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();

        $data['desc'] = DB::table('mz_activity') -> where('id' , $id) -> where('status' , 1) -> first();

        $data['food'] = DB::table('mz_av_food')  -> where('av_id' , $id) -> where('status' , 1) -> where('av_id' , $id) -> select('id' , 'title' , 'author' ,'crea_at') -> orderBy('crea_at' , 'desc') -> get();

        $data['news'] =NewsModel::where('av_id' , $id) -> where('class_id' , 2) -> select('id' , 'title' , 'author' , 'crea_at') -> orderBy('crea_at' , 'desc') -> get();

        $guest_id = explode( ',' , $data['desc'] -> guest);

        $data['guest'] = CharacterModel::whereIn('id' , $guest_id) -> select('id', 'name', 'photo', 'post', 'join_character') -> get();

        $data['article'] = ArticleModel::where('zy' , $data['desc'] -> zy)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id')
            -> select('mz_article.id' , 'mz_article.title' , 'mz_column.english')
            -> limit(10)
            -> get();

        $data['relevant'] = DB::table('mz_activity') -> where('zy' , $data['desc'] -> zy) -> where('id' , '!=' , $data['desc'] -> id) -> select('id' , 'img' , 'title' , 'start_at' , 'city') -> get();

        $data['hd'] = ColumnModel::where('english' , 'hd') -> first();

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        if($data['desc'] -> end_at < date('Y-m-d H:i:s' , time())){
            $data['desc'] -> status = '结束';
        }else{
            $data['desc'] -> status = '报名';
        }

        $data['desc'] -> end_at = substr($data['desc'] -> end_at , strpos($data['desc'] -> end_at , ' '));
        $data['desc'] -> start_at = substr($data['desc'] -> start_at, '0', strrpos($data['desc'] -> start_at , ':'));
        $data['desc'] -> end_at = substr($data['desc'] -> end_at, '0', strrpos($data['desc'] -> end_at , ':'));

        foreach($data['food'] as $k => $v){

            $data['food'][$k]-> crea_at = date('Y/m/d' , $v -> crea_at);
        }

        foreach($data['news'] as $k => $v){

            $data['news'][$k]-> crea_at = date('Y/m/d' , $v -> crea_at);
        }

        return view('Pc/Activity/desc') -> with('data' , $data);
    }


    /**
     * 活动搜索
     * @param Request $request
     * @return mixed
     */
    public function searchActivity(Request $request)
    {

        $keyword = $request -> keyword;

        $city = $request -> city;

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        $data['keyword'] = $keyword;

        if( $city == '全国'){
            $data['data'] =  DB::table('mz_activity')
                -> where('title' , 'like' , "%$keyword%")
                -> orWhere('keyword' , 'like' , "%$keyword%")
                -> select('id' , 'title' , 'img' , 'start_at' , 'end_at' , 'address')
                -> orderBy('start_at' , 'desc')
                -> get();
        }

        if(!empty($city) && $city != '全国'){
            $data['data'] =  DB::table('mz_activity')
                -> where('city' , $city)
                -> where('title' , 'like' , "%$keyword%")
                -> orWhere('keyword' , 'like' , "%$keyword%")
                -> select('id' , 'title' , 'img' , 'start_at' , 'end_at' , 'address')
                -> orderBy('start_at' , 'desc')
                -> get();
        }else{
            $data['data'] =  DB::table('mz_activity')
                -> where('title' , 'like' , "%$keyword%")
                -> orWhere('keyword' , 'like' , "%$keyword%")
                -> select('id' , 'title' , 'img' , 'start_at' , 'end_at' , 'address')
                -> orderBy('start_at' , 'desc')
                -> get();
        }


        foreach($data['data'] as $k => $v){

            if($v -> end_at < date('Y-m-d H:i:s' , time())){
                $data['data'][$k] -> status = '已结束';
            }else{
                $data['data'][$k] -> status = '报名中';
            }

            $data['data'][$k]-> start_at = substr($v -> start_at ,'0' ,strpos($v -> start_at , ' '));

        }

        return view('Pc/Activity/searchHd') -> with('data' , $data);

//        return $this -> resultHandler('查询成功' , 'true' , $data , '10000');
    }

    /**
     * 更多活动
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moreHd()
    {
        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        $data['data'] =  ActivityModel::select('id' , 'title' , 'img' , 'start_at' , 'end_at' , 'address')
            -> orderBy('start_at' , 'desc')
            -> get();


        foreach($data['data'] as $k => $v){

            if($v -> end_at < date('Y-m-d H:i:s' , time())){
                $data['data'][$k] -> status = '已结束';
            }else{
                $data['data'][$k] -> status = '报名中';
            }

            $data['data'][$k]-> start_at = substr($v -> start_at ,'0' ,strpos($v -> start_at , ' '));

        }

        return view('Pc/Activity/moreHd') -> with('data' , $data);

    }

    /*国际峰会*/
    public function summit()
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();
        //设置搜索后的变量
        $data['column']['search']['column'] = '';
        return view('Pc/Activity/summit') -> with('data' , $data);
    }

    /*案例评选*/
    public function selection()
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();
        //设置搜索后的变量
        $data['column']['search']['column'] = '';
        return view('Pc/Activity/selection')-> with('data' , $data);
    }

    public function anlipx()
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();
        //设置搜索后的变量
        $data['column']['search']['column'] = '';
        return view('Pc/Activity/anlipx')-> with('data' , $data);
    }

    /**
     * 活动列表
     * @return mixed
     */
    public function activityList()
    {
        $data = ActivityModel::where('status' , 1)
            -> select('id' , 'title' , 'img' , 'message' , 'author' , 'crea_at')
            -> get();

        $data = $this -> getKeyword($data);

        return $this -> resultHandler('查询成功。。。' , true , $data , 10000);
    }

    /**
     * 活动详情
     * @param Request $request
     * @return mixed
     */
    public function activityDesc(Request $request)
    {
        $id = $request -> id;

        ActivityModel::where('id' , $id) -> increment('view' , 1);

        $data['content'] = ActivityModel::where('id' , $id) -> first() -> toArray();
        

        /*相关*/
        $data['relevant'] =
            ActivityModel::where('id' , '<>' , $id)
                -> orderBy('crea_at' , 'desc')
                -> limit(3)
                -> select('id' , 'title' , 'img'  , 'author' , 'crea_at')
                -> get();

        /*猜你喜欢*/
        /*观察*/
        $data['like'] = ObservationModel::where('status' , 1)
            -> select('id' , 'title' , 'author' )
            -> orderBy('crea_at' , 'desc')
            -> limit(3)
            -> get();

        /*杂志*/
        $data['magazine'] = MazationModel::where('status', 1)
            ->select('m_id', 'year', 'title', 'cover_img')
            ->orderBy('crea_time', 'desc')
            ->first();

        return $this -> resultHandler('查询成功。。。。' , true , $data , 10000);
    }
}
