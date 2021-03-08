<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Service\BaseController;
use App\Model\LiveModel;
use App\Model\KeywordModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @直播管理
 * Class Book
 * @package App\Http\Controllers\Home
 */
class Live extends BaseController
{
    /**
     * @加载直播列表
     * @return string
     */
    public function LiveList()
    {
        return view('/Home/Live/list');
    }

    /**
     * @获取直播列表
     * @return mixed
     */
    public function livePage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = LiveModel::offset($page)
            -> limit($limit)
            -> orderBy('I_crea_at', 'desc')
            -> get();
        $count = LiveModel::count();

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @加载直播编辑
     * @param Request $request
     * @return mixed
     */
    public function liveAdd(Request $request)
    {
        $data = LiveModel::where('l_id', 1) -> first();
        return view('/Home/Live/add');
    }

    /**
     * @执行添加
     * @param Request $request
     * @return mixed
     */
    public function liveDoAdd(Request $request)
    {
        $data = $request -> data;
        unset($data['file']);
        $data['I_crea_at'] = time();
        $res = LiveModel::insert($data);
        if($res){
            return $this -> resultHandler('添加成功' , true , $data = [] , 10000);
        }else
        {
            return $this -> resultHandler('添加失败' , false , $data = [] , 10001);
        }
    }


    /**
     * @加载直播编辑
     * @param Request $request
     * @return mixed
     */
    public function liveEdit(Request $request)
    {
        $l_id = $request -> l_id;
        $data = LiveModel::where('l_id', $l_id) -> first();
        return view('/Home/Live/edit') -> with('data', $data);
    }

    /**
     * 直播执行编辑
     * @param Request $request
     * @return mixed
     */
    public function liveDoEdit(Request $request)
    {
        $data = $request -> data;
        unset($data['file']);

        $data['I_up_at'] = time();
        $res = LiveModel::where('l_id', $data['l_id']) -> update($data);
        if($res){
            return $this -> resultHandler('修改成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('修改失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @删除直播
     * @param Request $request
     * @return mixed
     */
    public function liveDel(Request $request)
    {
        $l_id = $request -> l_id;
        $res = LiveModel::where('l_id', $l_id) -> delete();
        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }

    }


























    /**
     * @书籍列表分页
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function bookPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = BookModel::HomeBookList($page, $limit);

        $count = BookModel::HomeBookCount();

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @书籍加载添加
     * @param Request $request
     * @return mixed
     */
    public function bookAdd(Request $request)
    {
        $zy = KeywordModel::HomeGetKeywordZy();
        return view('/Home/Book/add') -> with('zy' , $zy);
    }

    /**
     * @书籍执行添加
     * @param Request $request
     * @return mixed
     */
    public function bookDoAdd(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['crea_at'] = time();

        $res = BookModel::insert($data);

        if($res){

            return $this -> resultHandler('增加成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @书籍加载编辑
     * @param Request $request
     * @return mixed
     */
    public function bookEdit(Request $request)
    {
        $id = $request -> id;
        $zy = KeywordModel::HomeGetKeywordZy();
        $data = BookModel::HomeGetFirst($id);
        return view('/Home/Book/edit') -> with('zy' , $zy) -> with('data' , $data);
    }

    /**
     * @ 书籍执行编辑
     * @param Request $request
     * @return mixed
     */
    public function bookDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['up_at'] = time();

        $res = BookModel::where('id', $data['id']) -> update($data);

        if($res){

            return $this -> resultHandler('修改成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('修改失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @书籍执行删除
     * @param Request $request
     */
    public function bookDel(Request $request)
    {
        $id = $request -> id;

        $res = BookModel::where('id' , $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }
    }
}
