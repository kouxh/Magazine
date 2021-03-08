<?php
/**
 * Created By PhpStorm
 * Date:2019-11-29
 * Time:12:54
 * Name:马哥
 */
namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\BaseController;
use App\Model\ActivityModel;
use App\Model\ColumnModel;
use App\Model\HeaderModel;
use Illuminate\Http\Request;
use App\Model\MagazineModel;
use App\Model\ArticleModel;
use App\Model\FoodModel;
use Illuminate\Support\Facades\DB;

class FoodController extends BaseController
{
    /**
     * 干货列表  ----  专业文章
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function foodList(Request $request)
    {
        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        $data['column'] = ColumnModel::where('english' , 'hd') -> first();

        $data['list'] = FoodModel::select('id' , 'title' , 'author' , 'crea_at' , 'img' , 'message')
            -> orderBy('crea_at' , 'desc')
            -> Paginate(6);

        $data['magazine'] = MagazineModel::getFirstMagazine();

        $data['top'] = ArticleModel::topNum();

        $data['rand'] = ColumnModel::randColumn($data['column'][0]['id'] , 3);     //随机栏目

        $data['jd'] = ArticleModel::article(9 ,3);              //荐读

        $data['activity'] = ActivityModel::activity();                          //活动

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

        return view('Pc/Food/list') -> with('data' , $data);

    }

    /**
     * @干货详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function foodDesc(Request $request)
    {
        $id = $request -> id;

        $data['column'] = ColumnModel::where('english' , 'hd') -> first();

        FoodModel::where('id' , $id) -> increment('view' , 1);               //增加阅读量

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        $data['content'] = FoodModel::where('id' , $id) -> first();                        //查询文章

        $data['content'] -> crea_at = $this -> getDate($data['content'] -> crea_at);        //转化时间为日期

        //相关文章
        $data['relevant'] = FoodModel::where('id' , '!=' , $id) -> get();

        //猜你喜欢
        $data['like'] = ArticleModel::like($data['content'] -> id , 3 );

        /*杂志*/
        $data['magazine'] = MagazineModel::getFirstMagazine();

        return view('Pc/Food/desc') -> with(['data' => $data]);
    }
}
