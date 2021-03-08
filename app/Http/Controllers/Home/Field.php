<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Service\BaseController;
use App\Model\BookModel;
use App\Model\KeywordModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class Field
 * @package App\Http\Controllers\Home
 */
class Field extends BaseController
{

    /**
     * @ 领域管理
     * @return mixed
     */
    public function fieldList()
    {
        return view('/Home/Field/list');
    }

    /**
     * @ 领域列表分页
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fieldPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = KeywordModel::HomeKeywordList($page, $limit);

        $count = KeywordModel::HomeKeywordCount();

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @领域加载添加
     * @param Request $request
     * @return mixed
     */
    public function fieldAdd(Request $request)
    {
        return view('/Home/Field/add');
    }

    /**
     * @领域执行添加
     * @param Request $request
     * @return mixed
     */
    public function fieldDoAdd(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['crea_at'] = time();

        $res = KeywordModel::insert($data);

        if($res){

            return $this -> resultHandler('增加成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @领域加载编辑
     * @param Request $request
     * @return mixed
     */
    public function fieldEdit(Request $request)
    {
        $id = $request -> id;
        $data = KeywordModel::where('id', $id) -> first();
        return view('/Home/Field/edit') -> with('data' , $data);
    }

    /**
     * @ 书籍执行编辑
     * @param Request $request
     * @return mixed
     */
    public function fieldDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['up_at'] = time();

        $res = KeywordModel::where('id', $data['id']) -> update($data);

        if($res){

            return $this -> resultHandler('修改成功' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('修改失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @领域执行删除
     * @param Request $request
     */
    public function fieldDel(Request $request)
    {
        $id = $request -> id;

        $res = KeywordModel::where('id' , $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }
    }
}
