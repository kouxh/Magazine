<?php

namespace App\Http\Controllers\Pc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BusinessLogic\Comment;
use App\Http\Controllers\BusinessLogic\Comment\OperationFactory;
use App\Http\Controllers\Service\BaseController;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Service\Fiter;
use App\Services\SensitiveWords;


class CommentController extends BaseController
{
    /**
     * @评论
     * @param Request $request
     * @return mixed
     */
    public function commentInsertApi(Request $request)
    {
        $data['type'] = $request -> type;
        $data['com_aid'] = $request -> aid;
        $data['com_mid'] = $request -> mid;
        $data['com_cid'] = $request -> cid;
        $data['com_uid'] = $request -> uid;
        $data['com_comment'] = $request -> comment;
        if(!isset($data['com_uid']))
        {
            //取出用户ID
            $data['com_uid'] = $this -> getSessionUserId();
        }

        if(!isset($_SERVER['HTTP_TOKEN'])){
            if (!$data['com_uid']) {
                return redirect('/loadLogin');
            }
        }
        $bad_word = SensitiveWords::getBadWord($data['com_comment']);
        if (!empty($bad_word)) {
            return $this -> resultHandler('ERROR' , FALSE , ['MSG' => '包含敏感词:' . current($bad_word)] , 10001);
        }

        $obj = OperationFactory::CommentOperation($data['type']);
        return $obj -> commentInsert($data);
    }

    /**
     * @评论列表
     * @param Request $request
     * @return mixed
     */
    public function commentListApi(Request $request)
    {
        $data['type'] = $request -> type;
        $data['id'] = $request -> id;

        $obj = OperationFactory::CommentOperation($data['type']);
        return $obj -> commentList($data);



    }

    /**
     * @我的评论
     * @param Request $request
     * @return mixed
     */
    public function myCommentApi(Request $request)
    {
        $data['type'] = empty($request -> type)?1:$request -> type;

        //取出用户ID
        $data['com_uid'] = $this -> getSessionUserId();

        if (!$data['com_uid']) {
            return redirect('/loadLogin');
        }

        $obj = OperationFactory::CommentOperation($data['type']);
        return $obj -> myComment($data);

    }

    /**
     * @删除评论
     * @param Request $request
     * @return mixed
     */
    public function delCommentApi(Request $request)
    {
        $data['type'] = $request -> type;
        $data['com_id'] = $request -> com_id;

        $uid = $this -> getSessionUserId();

        if (!isset($uid)) {
            return redirect('/loadLogin');
        }

        $data['com_uid'] = $uid;
        $this -> isEmpty($data['type'], '缺少参数，【type】');
        $this -> isEmpty($data['com_id'], '缺少参数，【com_id】');

        $obj = OperationFactory::CommentOperation($data['type']);
        return $obj -> delComment($data);

    }
}
