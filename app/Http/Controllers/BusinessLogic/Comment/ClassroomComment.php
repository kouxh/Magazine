<?php

namespace App\Http\Controllers\BusinessLogic\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BusinessLogic\Comment\Comment;
use App\Model\ClassroomCommentModel;

class ClassroomComment extends Comment implements Comput
{
    /**
     * @课堂评论
     * @param $data
     */
    public function commentInsert($data)
    {
        $this -> isEmpty($data['com_cid'], '缺少课堂id');
        $this -> isEmpty($data['com_comment'], '缺少评论内容');
        unset($data['com_aid']);
        unset($data['com_mid']);

//        //验证用户是否评论过
//        $comment = ClassroomCommentModel::where(['com_uid' => $data['com_uid'], 'com_cid' => $data['com_cid']]) -> first();
//
//        if($comment){
//            return $this -> resultHandler('ERROR' , false , ['MSG' => '您已经评论过了！'] , 10001);
//        }

        $res = $this -> typeInsertComment($data);

        if($res){
            return $this -> resultHandler('SUCCESS' , true , ['MSG' => '评论成功！待管理员审核后方可展示'] , 10000);
        }else{
            return $this -> resultHandler('ERROR' , false , ['MSG' => '评论失败！请稍后重试'] , 10001);
        }
    }

    /**
     * @课堂评论列表
     * @param $data
     * @return mixed
     */
    public function commentList($data)
    {
        $data = $this -> typeListComment($data);

        $data = $this -> getDate($data);

        return $this -> resultHandler('SUCCESS' , true , ['MSG' => '查询成功', 'data' => $data] , 10000);
    }

    /**
     * @获取用户课堂下的评论
     * @param $data
     * @return mixed
     */
    public function myComment($data)
    {
        $data =  $this -> typeMyComment($data);         //调用数据

        $data = $this -> getStatus($data);              //转换状态

        return $this -> resultHandler('SUCCESS' , true , ['MSG' => '查询成功', 'data' => $data] , 10000);
    }

    /**
     * @删除我的评论
     * @param $data
     * @return mixed
     */
    public function delComment($data)
    {
        $res =  $this -> typeDelComment($data);     //进行删除

        if($res){
            return $this -> resultHandler('SUCCESS' , true , ['MSG' => '删除成功'] , 10000);
        }else{
            return $this -> resultHandler('ERROR' , false , ['MSG' => '删除失败！刷新再试请重试'] , 10001);
        }

    }
}
