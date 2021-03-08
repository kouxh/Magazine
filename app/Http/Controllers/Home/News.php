<?php
/**
 * Created By PhpStorm
 * Date 2019-9-11
 * Time 17：04
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;
use App\Model\ArticleModel;

class News extends BaseController
{
    /**
     * 加载列表
     * @param Request $request
     * @return mixed
     */
    public function newsList(Request $request)
    {
        return view('/Home/News/list') ;
    }

    /**
     * 分页展示
     * @param Request $request
     * @return mixed
     */
    public function newsPage(Request $request)
    {

        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;         //关键字

        $type = $request -> type;

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        if($type){

            $where = [
                'title',
                'like',
                "%$searContent%",
                $type

            ];

            $data = DB::table('mz_news') -> where($where[0] , $where[1] , $where[2])
                -> where('status' , 1)
                -> where('class_id' ,$where[3])
                -> offset($page)
                -> limit($limit)
                -> select('id' , 'title' , 'message' , 'keyboard' , 'author' , 'class_id' , 'view' , 'status' , 'crea_at')
                -> orderBy('crea_at' , 'desc')
                -> get()
                -> toArray();

            $count = DB::table('mz_news') -> where($where[0] , $where[1] , $where[2]) -> where('class_id' , $where[3]) -> where('status' , 1) -> count();

        }else{

            $where = [
                'title',
                'like',
                "%$searContent%",

            ];

            $data = DB::table('mz_news') -> where($where[0] , $where[1] , $where[2])
                -> where('status' , 1)
                -> offset($page)
                -> limit($limit)
                -> select('id' , 'title' , 'message' , 'keyboard' , 'author' , 'class_id' , 'view' , 'status' , 'crea_at')
                -> orderBy('crea_at' , 'desc')
                -> get()
                -> toArray();

            $count = DB::table('mz_news') -> where($where[0] , $where[1] , $where[2]) -> where('status' , 1) -> count();

        }

        foreach ($data as $key => $val){

            if($val -> class_id == 1){
                $data[$key]->class = '业界新闻';
            }else{
                $data[$key]->class = '活动新闻';
            }

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
    public function newsAdd(Request $request)
    {
        $news = DB::table('mz_activity') -> where('status' , 1) -> select('id' , 'title') -> limit(10) -> get();

        return view('/Home/News/add') -> with('news' , $news);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function newsDoAdd(Request $request)
    {
        $data = $request -> data;

        $data['crea_at'] = time();

        unset($data['file']);

        //dd($data);

        $res = DB::table('mz_news') -> insert($data);

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
    public function newsDel(Request $request)
    {
        $id = $request -> id;

        $res = DB::table('mz_news') -> where('id' , $id) -> delete();

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
    public function newsEdit(Request $request)
    {
        $id = $request -> id;

        $news = DB::table('mz_news') -> where('id' , $id) -> first();

        $activity = DB::table('mz_activity') -> where('status' , 1) -> orderBy('crea_at' , 'desc') -> limit(10) -> get();

        $news -> crea_at = date('Y/m/d', $news -> crea_at);

        return view('Home/News/edit') -> with('news' , $news) -> with('activity' , $activity);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function newsDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['crea_at'] = strtotime($data['crea_at']);

        $data['up_at'] = time();

        $res = DB::table('mz_news') -> where('id' , $data['id']) -> update($data);

        if($res){

            return $this -> resultHandler('编辑成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败。。。' , false , $data = [] , 10001);

        }
    }

}
