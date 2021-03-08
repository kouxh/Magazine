<?php
/**
 * Created By PhpStorm
 * Date 2019-9-9
 * Time 17:43
 * Name 马哥
 */

namespace App\Http\Controllers\Home;

use App\Model\CharacterModel;
use App\Model\GuestModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;

/**
 * 活动
 * Class Activity
 * @package App\Http\Controllers\Home
 */
class Activity extends BaseController
{
    /**
     * 加载活动列表
     * @param Request $request
     * @return mixed
     */
    public function artivityList(Request $request)
    {

        return view('/Home/Activity/list');
    }

    /**
     * 活动列表
     * @param Request $request
     * @return mixed
     */
    public function artivityPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;         //关键字

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        if(!empty($searContent)){

            $where = [
                'title',
                'like',
                "%$searContent%",
            ];

            $data = DB::table('mz_activity')
                -> where($where[0] , $where[1] , $where[2])
                -> where('status' , 1)
                -> offset($page)
                -> limit($limit)
                -> select('id' , 'title' , 'start_at' , 'end_at' , 'limit_num' , 'address', 'host' , 'co_sponsor' , 'ticket' , 'status' , 'crea_at')
                -> orderBy('crea_at' , 'desc')
                -> get()
                -> toArray();

            $count =DB::table('mz_activity') -> where($where[0] , $where[1] , $where[2]) -> where('status' , 1) -> count();


        }else{

            $data = DB::table('mz_activity')
                -> where('status' , 1)
                -> offset($page)
                -> limit($limit)
                -> select('id' , 'title' , 'start_at' , 'end_at' , 'limit_num' , 'address', 'host' , 'co_sponsor' , 'ticket' , 'status' , 'crea_at')
                -> orderBy('crea_at' , 'desc')
                -> get()
                -> toArray();

            $count =DB::table('mz_activity') -> where('status' , 1) -> count();

        }

        foreach ($data as $key => $val){

            $data[$key] -> crea_at = date('Y-m-d' , $val -> crea_at);

            if($val -> end_at < date('Y-m-d')){
                $data[$key] -> status = '正常';
            }else{
                $data[$key] -> status = '已结束';
            }

            if($val -> ticket == 0){
                $data[$key] -> ticket = '免费';
            }else{
                $data[$key] -> ticket = '收费';
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
    public function artivityAdd(Request $request)
    {
        $data['hang'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 1) -> get();
        $data['xing'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 2) -> get();
        $data['zhi'] = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 3) -> get();
        $data['rw'] = CharacterModel::select('id', 'name') -> get();
        return view('/Home/Activity/add') -> with('data' , $data);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function artivityDoAdd(Request $request)
    {
        $data = $request -> data;

        if($data['ticket'] == 0){

            $data['price'] = 0;

        }

        unset($data['file']);

        $data['crea_at'] = time();

        $res = DB::table('mz_activity') -> insert($data);

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
    public function artivityEdit(Request $request)
    {
        $id = $request -> id;

        $data = DB::table('mz_activity') -> where('id' , $id) -> first();

            if($data -> ticket == 0){
                $data -> ticket = '免费';
            }else{
                $data -> ticket = '收费';
            }

        $data -> hang = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 1) -> get();
        $data -> xing = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 2) -> get();
        $data -> zhi = DB::table('mz_keyword') -> where('status' , 1) -> where('class' , 3) -> get();
        $data -> rw  = CharacterModel::select('id', 'name') -> get();

        return view('/Home/Activity/edit') -> with('data' , $data);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function artivityDoEdit(Request $request)
    {
        $data = $request -> data;

        if($data['ticket'] == 0){

            $data['price'] = 0;

        }

        unset($data['file']);

        $data['up_at'] = time();
        
        $res = DB::table('mz_activity') -> where('id' , $data['id']) -> update($data);

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
    public function artivityDel(Request $request)
    {
        $id = $request -> id;

        $res = DB::table('mz_activity') -> where('id' , $id) -> delete();

        if($res){

            return $this -> resultHandler('删除成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('删除失败。。。' , false , $data = [] , 10001);

        }
    }


}
