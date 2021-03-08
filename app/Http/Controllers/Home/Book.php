<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Service\BaseController;
use App\Model\BookModel;
use App\Model\KeywordModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @书籍管理
 * Class Book
 * @package App\Http\Controllers\Home
 */
class Book extends BaseController
{
    /**
     * @加载书籍列表
     * @return string
     */
    public function bookList()
    {
        return view('/Home/Book/list');
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
