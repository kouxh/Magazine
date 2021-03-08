<?php
/**
 * Created By PhpStorm
 * Date 2019-7-31
 * Time 10:55
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use App\Model\ColumnModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;
use App\Model\ArticleModel;


/**
 * 文章
 * Class Article
 * @package App\Http\Controllers\Admin
 */
class Article extends BaseController
{
    static $column_id = '';

    /**
     * 加载列表
     * @param Request $request
     * @return mixed
     */
    public function ArticleList(Request $request)
    {
        $column = ColumnModel::getHomeList();
//        dd($column);
        return view('/Home/Article/list') -> with('column' , $column);
    }

    /**
     * 分页展示
     * @param Request $request
     * @return mixed
     */
    public function ArticlePage(Request $request)
    {

        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;                                         //关键字

        self::$column_id = empty($request -> column_id)?1:$request->column_id;                //分类

        $page = $pageNum - 1;

       if($searContent){

           $data = ArticleModel::where('mz_article.status' ,1)
               -> where('mz_article.column_id' , self::$column_id)
               -> where('mz_article.title' , 'like' , "%$searContent%")
               -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
               -> select('mz_article.id' , 'mz_article.title' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_article.view')
               -> orderBy('mz_article.crea_at' , 'desc')
               -> offset($page)
               -> limit($limit)
               -> get()
               -> toArray();

           $count = ArticleModel::where('title' , 'like' , "%$searContent%") -> where('column_id' , self::$column_id) -> where('status' , 1) -> count();

       }else{

           $data = ArticleModel::where('mz_article.status' ,1)
               -> where('mz_article.column_id' , self::$column_id)
               -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
               -> select('mz_article.id' , 'mz_article.title' , 'mz_article.author' , 'mz_article.crea_at' ,'mz_column.column' , 'mz_article.view')
               -> orderBy('mz_article.crea_at' , 'desc')
               -> offset($page)
               -> limit($limit)
               -> get()
               -> toArray();

           $count =ArticleModel::where('column_id' , self::$column_id) -> where('status' , 1) -> count();

       }


        foreach ($data as $key => $val){

            //转换时间
            $data[$key]['crea_at'] = date('Y-m-d' , $val['crea_at']);

        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
            'cloumn' => self::$column_id
        ]);

    }

    /**
     * 加载增加
     * @return mixed
     */
    public function ArticleAdd(Request $request)
    {
        $column = ColumnModel::getHomeList();

        $data['hang'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 1) -> get();
        $data['xing'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 2) -> get();
        $data['zhi'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 3) -> get();

        return view('/Home/Article/add') -> with(['data' => $data , 'column' => $column]);
    }

    /**
     * 执行增加
     * @param Request $request
     * @return mixed
     */
    public function ArticleDoAdd(Request $request)
    {
        $data = $request -> data;

        $data['keyword'] = $data['hy'] . ',' . $data['zy'] . ',' . $data['qt'];   //拼接keyword

        unset($data['file']);
        $data['crea_at'] = time();

        $res =  ArticleModel::insert($data);

        if($res){

            return $this -> resultHandler('增加成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败。。。' , false , $data = [] , 10001);
        }
    }

    /**
     * 文章删除
     * @param Request $request
     * @return mixed
     */
    public function ArticleDel(Request $request)
    {
        $id = $request -> id;

        $res = ArticleModel::where('id' , $id) -> delete();

        if($res){

            return $this -> resultHandler('删除成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('删除失败。。。' , false , $data = [] , 10001);

        }
    }

    /**
     * 查看文章
     * @param Request $request
     * @return mixed
     */
    public function ArticleShow(Request $request)
    {
        $column = ColumnModel::getHomeList();

        $id = $request -> id;

        $data = ArticleModel::where('mz_article.id' , $id)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.*' ,'mz_column.column' , 'mz_column.id as column_id')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> first()
            -> toArray();

        $data['keyword'] = explode(',' , $data['keyword']);

        $data['hang'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 1) -> get() -> toArray();
        $data['xing'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 2) -> get() -> toArray();
        $data['zhi'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 3) -> get() -> toArray();

        //判断分类

        return view('/Home/Article/Seeshow') -> with(['data' => $data , 'column' => $column]);

    }

    /**
     * 加载编辑
     * @param Request $request
     * @return mixed
     */
    public function ArticleEdit(Request $request)
    {

        $column = ColumnModel::getHomeList();

        $id = $request -> id;

        $data = ArticleModel::where('mz_article.id' , $id)
            -> join('mz_column' , 'mz_article.column_id' , '=' , 'mz_column.id' , 'left')
            -> select('mz_article.*' ,'mz_column.column' , 'mz_column.id as column_id')
            -> orderBy('mz_article.crea_at' , 'desc')
            -> first()
            -> toArray();

        $data['keyword'] = explode(',' , $data['keyword']);

        $data['hang'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 1) -> get() -> toArray();
        $data['xing'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 2) -> get() -> toArray();
        $data['zhi'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 3) -> get() -> toArray();


//        dd($data);

        //判断分类

        return view('/Home/Article/edit') -> with(['data' => $data , 'column' => $column]);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function ArticleDoEdit(Request $request)
    {
        $data = $request -> data;

        $data['keyword'] = $data['hy'] . ',' . $data['zy'] . ',' . $data['qt'];   //拼接keyword

        unset($data['file']);

        $data['up_at'] = time();

        $res = ArticleModel::where('id' , $data['id']) -> update($data);


        if($res){

            return $this -> resultHandler('编辑成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败。。。' , false , $data = [] , 10001);

        }

    }
}
