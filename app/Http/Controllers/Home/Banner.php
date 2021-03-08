<?php
/**
 * Created By PhpStorm
 * Date 2019-9-23
 * Time 10:45
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;

/**
 * 广告图管理
 * Class Banner
 * @package App\Http\Controllers\Home
 */
class Banner extends BaseController
{
    /**
     * 加载广告图列表
     * @param Request $request
     * @return mixed
     */
    public function bannerList(Request $request)
    {
        //dd(123456);
        return view('/Home/Banner/list');
    }

    /**
     * 广告图列表
     * @param Request $request
     * @return mixed
     */
    public function bannerPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }



        $data = DB::table('mz_c_banner')
            -> where('mz_c_banner.status' , 1)
            -> join('mz_column' , 'mz_c_banner.c_id' , '=' , 'mz_column.id' , 'left')
            -> offset($page)
            -> limit($limit)
            -> select('mz_c_banner.id' , 'mz_column.column' , 'mz_c_banner.banner' , 'mz_c_banner.status' , 'mz_c_banner.type' , 'mz_c_banner.alert' , 'mz_c_banner.crea_at')
            -> orderBy('mz_c_banner.crea_at' , 'desc')
            -> get();

        $count =DB::table('mz_c_banner')
            -> join('mz_column' , 'mz_c_banner.c_id' , '=' , 'mz_column.id' , 'left')
            -> where('mz_c_banner.status' , 1)
            -> count();

        foreach ($data as $key => $val){

            $data[$key] -> crea_at = date('Y-m-d' , $val -> crea_at);

            if($val -> status == 1){
                $data[$key] -> status = '正常';
            }else{
                $data[$key] -> status = '删除';
            }

            if($val -> type == 1){
                $data[$key] -> type = 'pc';
            }else{
                $data[$key] -> type = 'app';
            }

            if($val -> alert == null){
                $data[$key] -> alert = '无';
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
    public function bannerAdd(Request $request)
    {
        $column = DB::table('mz_column') -> where('status' , 1) -> select('id' , 'column') -> get();

        return view('/Home/Banner/add') -> with('column' , $column);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function bannerDoAdd(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['crea_at'] = time();

        $res = DB::table('mz_c_banner') -> insert($data);

        if($res){

            return $this -> resultHandler('增加成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败' , false , $data = [] , 10001);
        }
    }

    /**
     * 加载编辑
     * @param Request $request
     * @return mixed
     */
    public function bannerEdit(Request $request)
    {
        $id = $request -> id;

        $column = DB::table('mz_column') -> where('status' , 1) -> select('id' , 'column') -> get();

        $data = DB::table('mz_c_banner') -> where('id' , $id) -> first();

        return view('/Home/Banner/edit') -> with('data' , $data) -> with('column' , $column);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function bannerDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['up_at'] = time();

        $res = DB::table('mz_c_banner') -> where('id' , $data['id']) -> update($data);

        if($res){

            return $this -> resultHandler('编辑成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);

        }
    }

    /**
     * 执行删除
     * @param Request $request
     */
    public function bannerDel(Request $request)
    {
        $id = $request -> id;

        $res = DB::table('mz_c_banner') -> where('id' , $id) -> update(['status' => 2 , 'up_at' => time()]);

        if($res){

            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);

        }
    }
}
