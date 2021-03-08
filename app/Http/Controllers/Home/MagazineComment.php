<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\MagazineCommentModel;

/**
 * @杂志评论
 * Class MagazineComment
 * @package App\Http\Controllers\Home
 */
class MagazineComment extends BaseController
{
    /**
     * @加载杂志评论列表
     * @return string
     */
    public function magazineCommentList()
    {
        return view('/Home/MagazineComment/list');
    }

    /**
     * @ 文章评论分页列表
     * @param Request $request
     * @return mixed
     */
    public function magazineCommentPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = MagazineCommentModel::HomeMagazineCommentList($page, $limit);

        $count = MagazineCommentModel::HomeMagazineCommentCount();

        foreach($data as $k => $v)
        {
            if($v -> com_status == 1){
                $data[$k] -> com_status = '未通过';
            }else{
                $data[$k] -> com_status = '已通过';
            }
            $data[$k] -> com_crea_at = date("Y-m-d", $v -> com_crea_at);
        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @通过评论
     * @param Request $request
     * @return mixed
     */
    public function magazineCommentDoEdit(Request $request)
    {
        $id = $request -> id;

        $res = MagazineCommentModel::where('com_id', $id) -> update(['com_status' => 2, 'com_crea_at' => time()]);

        if($res){
            return $this -> resultHandler('修改成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('修改失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @删除评论
     * @param Request $request
     * @return mixed
     */
    public function magazineCommentDel(Request $request)
    {
        $id = $request -> id;

        $res = MagazineCommentModel::where('com_id', $id) -> delete();

        if($res){
            return $this -> resultHandler('修改成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('修改失败' , false , $data = [] , 10001);
        }
    }
}
