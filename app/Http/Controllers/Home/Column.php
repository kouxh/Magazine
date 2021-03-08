<?php
/**
 * Created By PhpStorm
 * Date 2019-9-23
 * Time 10:45
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use App\Model\ColumnModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;

/**
 * 栏目管理
 * Class Column
 * @package App\Http\Controllers\Home
 */
class Column extends BaseController
{
    /**
     * 加载栏目列表
     * @param Request $request
     * @return mixed
     */
    public function columnList(Request $request)
    {
        return view('/Home/Column/list');
    }

    /**
     * 栏目列表
     * @param Request $request
     * @return mixed
     */
    public function columnPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = DB::table('mz_column')
            -> select('id' , 'column' , 'leven' , 'sort' , 'crea_at')
            -> orderBy('sort' , 'asc')
            -> offset($page)
            -> limit($limit)
            -> get()
            -> toArray();
        //dd($data);
        $count =DB::table('mz_column') -> count();

        foreach ($data as $key => $val){

            $data[$key] -> crea_at = date('Y-m-d' , $val -> crea_at);

            if($val -> leven == 1){
                $data[$key] -> leven = '一级栏目';
            }elseif($val -> leven == 2){
                $data[$key] -> leven = '二级栏目';
            }
        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * 加载添加
     * @param Request $request
     * @return mixed
     */
    public function columnAdd(Request $request)
    {
        $column = ColumnModel::where('p_id' , null) -> select('id' , 'column') -> get();
        return view('/Home/Column/add') -> with('column' , $column);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function columnDoAdd(Request $request)
    {
        $data = $request -> data;

        $arr = $data;

        unset($arr['file']);

        if($arr['leven'] == 2){
            $arr = ['column' => $arr['column'] , 'is_navigation' =>  $arr['is_navigation'], 'leven' => $arr['leven'] , 'p_id' => $arr['p_id'] , 'rand' => $arr['rand'] , 'join_dimension' => $arr['join_dimension'] , 'crea_at' => time()];
        }else{
            $arr['crea_at'] = time();
        }

        $res = DB::table('mz_column') -> insert($arr);

        if($res){

            return $this -> resultHandler('增加成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败。。。' , false , $data = [] , 10001);
        }
    }

    /**
     * 加载编辑
     * @param Request $request
     * @return mixed
     */
    public function columnEdit(Request $request)
    {
        $id = $request -> id;

        $data = DB::table('mz_column') -> where('id' , $id) -> first();

        $column = ColumnModel::where('p_id' , null) -> select('id' , 'column') -> get();

        return view('/Home/Column/edit') -> with('data' , $data) -> with('column' , $column);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function columnDoEdit(Request $request)
    {
        $data = $request -> data;

        $arr = $data;
//        dd($arr);
        unset($arr['file']);

        if($arr['leven'] == 2){
            $arr = ['column' => $arr['column'] ,
                'title' => $arr['title'],
                'describe' => $arr['describe'],
                'Pc_advert' => $arr['Pc_advert'],
                'Pc_advert_url' => $arr['Pc_advert_url'],
                'App_advert' => $arr['App_advert'],
                'App_advert_url' => $arr['App_advert_url'],
                'home_list' => $arr['home_list'] ,
                'is_navigation' =>  $arr['is_navigation'],
                'leven' => $arr['leven'] ,
                'p_id' => $arr['p_id'] ,
                'rand' => $arr['rand'] ,
                'sort' => $arr['sort'],
                'join_dimension' => $arr['join_dimension'] ,
                'crea_at' => time()];
        }else{
            $arr['crea_at'] = time();
        }
        
        $res = DB::table('mz_column') -> where('id' , $data['id']) -> update($arr);

        if($res){

            return $this -> resultHandler('编辑成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败。。。' , false , $data = [] , 10001);

        }
    }

    /**
     * 执行删除
     * @param Request $request
     */
    public function columnDel(Request $request)
    {
        $id = $request -> id;

        DB::table('mz_column') -> where('p_id' , $id) -> delete();

        $res = DB::table('mz_column') -> where('id' , $id) -> delete();

        if($res){

            return $this -> resultHandler('删除成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('删除失败。。。' , false , $data = [] , 10001);

        }
    }

}
