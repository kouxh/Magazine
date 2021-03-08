<?php

namespace App\Http\Controllers\BusinessLogic\Comment;

interface  Comput {
    //评论文章
    public function commentInsert($data);

    //评论列表
    public function commentList($data);

    //我的评论
    public function myComment($data);

    //删除评论
    public function delComment($data);


}

