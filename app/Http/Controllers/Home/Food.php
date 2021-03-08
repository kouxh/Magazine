<?php
/**
 * Created By PhpStorm
 * Date 2019-9-16
 * Time 13：50
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;
use App\Model\ArticleModel;

class Food extends BaseController
{
    /**
     * 加载列表
     * @param Request $request
     * @return mixed
     */
    public function foodList(Request $request)
    {
        return view('/Home/Food/list') ;
    }

    /**
     * 分页展示
     * @param Request $request
     * @return mixed
     */
    public function foodPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;         //关键字

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $where = [
            'mz_av_food.title',
            'like',
            "%$searContent%",
        ];

        $data = DB::table('mz_av_food') -> where($where[0] , $where[1] , $where[2])
            -> where('mz_av_food.status' , 1)
            -> join('mz_activity' , 'mz_av_food.av_id' , '=' , 'mz_activity.id' , 'left')
            -> offset($page)
            -> limit($limit)
            -> select('mz_av_food.id' , 'mz_av_food.title' , 'mz_av_food.message' , 'mz_av_food.keyboard' , 'mz_av_food.author' , 'mz_av_food.view' , 'mz_av_food.status' , 'mz_av_food.crea_at' , 'mz_activity.title as av_title')
            -> orderBy('mz_av_food.crea_at' , 'desc')
            -> get()
            -> toArray();

        $count = DB::table('mz_av_food') -> where($where[0] , $where[1] , $where[2]) -> where('status' , 1) -> count();
        //dd($data);
        foreach ($data as $key => $val){

            if($val -> status == 1){
                $data[$key]->status = '正常';
            }

            $data[$key]->crea_at = date('Y-m-d' , $val -> crea_at);
        }

        return response([
            'code' => '0',
            'msg' => '',
            'data' => $data,
            'count' => $count
        ]);
    }

    /**
     * 加载添加
     * @param Request $request
     * @return mixed
     */
    public function foodAdd(Request $request)
    {
        $news = DB::table('mz_activity') -> where('status' , 1) -> select('id' , 'title') -> limit(10) -> get();

        return view('/Home/Food/add') -> with('news' , $news);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function foodDoAdd(Request $request)
    {
        $data = $request -> data;

        $data['crea_at'] = time();

        unset($data['file']);

        $res = DB::table('mz_av_food') -> insert($data);

        if($res){

            return $this -> resultHandler('增加成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败。。。' , false , $data = [] , 10001);
        }
    }

    /**
     * 执行删除
     * @param Request $request
     * @return mixed
     */
    public function foodDel(Request $request)
    {
        $id = $request -> id;

        $res = DB::table('mz_av_food') -> where('id' , $id) -> delete();

        if($res){

            return $this -> resultHandler('删除成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('删除失败。。。' , false , $data = [] , 10001);

        }
    }

    /**
     * 加载编辑
     * @param Request $request
     * @return mixed
     */
    public function foodEdit(Request $request)
    {
        $id = $request -> id;

        $food = DB::table('mz_av_food') -> where('id' , $id) -> first();

        $activity = DB::table('mz_activity') -> where('status' , 1) -> orderBy('crea_at' , 'desc') -> limit(10) -> get();

        return view('Home/Food/edit') -> with('food' , $food) -> with('activity' , $activity);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function foodDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['up_at'] = time();

        $res = DB::table('mz_av_food') -> where('id' , $data['id']) -> update($data);

        if($res){

            return $this -> resultHandler('编辑成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败。。。' , false , $data = [] , 10001);

        }
    }
}
