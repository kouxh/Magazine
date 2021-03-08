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

class Moment extends BaseController
{
    /**
     * 加载列表
     * @param Request $request
     * @return mixed
     */
    public function momentList(Request $request)
    {
        return view('/Home/Moment/list') ;
    }

    /**
     * 分页展示
     * @param Request $request
     * @return mixed
     */
    public function momentPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;         //关键字

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $where = [
            'mz_av_moment.title',
            'like',
            "%$searContent%",
        ];

        $data = DB::table('mz_av_moment') -> where($where[0] , $where[1] , $where[2])
            -> where('mz_av_moment.status' , 1)
            -> join('mz_activity' , 'mz_av_moment.av_id' , '=' , 'mz_activity.id' , 'left')
            -> offset($page)
            -> limit($limit)
            -> select('mz_av_moment.id' , 'mz_av_moment.title' , 'mz_av_moment.message' , 'mz_av_moment.keyboard' , 'mz_av_moment.author' , 'mz_av_moment.view' , 'mz_av_moment.status' , 'mz_av_moment.crea_at' , 'mz_activity.title as av_title')
            -> orderBy('mz_av_moment.crea_at' , 'desc')
            -> get()
            -> toArray();

        $count = DB::table('mz_av_moment') -> where($where[0] , $where[1] , $where[2]) -> where('status' , 1) -> count();

        foreach ($data as $key => $val){

            if($val -> status == 1){
                $data[$key]->status = '正常';
            }else{
                $data[$key]->status = '删除';
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
    public function momentAdd(Request $request)
    {
        $news = DB::table('mz_activity') -> where('status' , 1) -> select('id' , 'title') -> limit(10) -> get();

        return view('/Home/Moment/add') -> with('news' , $news);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function momentDoAdd(Request $request)
    {
        $data = $request -> data;

        $data['crea_at'] = time();

        unset($data['file']);

        $res = DB::table('mz_av_moment') -> insert($data);

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
    public function momentDel(Request $request)
    {
        $id = $request -> id;

        $res = DB::table('mz_av_moment') -> where('id' , $id) -> update(['status' => 2 , 'up_at' => time()]);

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
    public function momentEdit(Request $request)
    {
        $id = $request -> id;

        $moment = DB::table('mz_av_moment') -> where('id' , $id) -> first();

        $activity = DB::table('mz_activity') -> where('status' , 1) -> orderBy('crea_at' , 'desc') -> limit(10) -> get();

        return view('Home/Moment/edit') -> with('moment' , $moment) -> with('activity' , $activity);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function momentDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['up_at'] = time();

        $res = DB::table('mz_av_moment') -> where('id' , $data['id']) -> update($data);

        if($res){

            return $this -> resultHandler('编辑成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败。。。' , false , $data = [] , 10001);

        }
    }
}
