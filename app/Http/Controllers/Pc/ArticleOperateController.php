<?php

namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Common\CommonController;
use App\Model\ActicleCommentModel;
use App\Model\ArticleModel;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Service\Fiter;

/**
 * @文章操作类
 * Class ArticleOperateController
 * @package App\Http\Controllers\Pc
 */
class ArticleOperateController extends CommonController
{
    /**
     * @文章的好评与差评
     * @param Request $request
     * @return mixed
     */
    public function praiseArticle(Request $request)
    {
        $type = $request -> type;                   #type为接收的类型 1为好评 2为臭鸡蛋

        $article_id = $request -> article_id;       #接收的文章id

        if(empty($type) || empty($article_id)){

            throw new ApiException('参数错误');

        }

        if($type == 1){
            ArticleModel::where('id', $article_id) -> increment('praise');
        }else{
            ArticleModel::where('id', $article_id)-> increment('bad');
        }

        return $this -> resultHandler('成功' , true  ,  $data = [] ,10000);
    }

    /**
     * @评论文章
     * @param Request $request
     * @return mixed
     */
    public function commentArticle(Request $request)
    {
        $data['u_id'] = self::$uid;
        $data['ac_id'] = $request -> article_id;
        $comment = $request -> comment;
        $data['crea_at'] = time();

        if(empty($data['ac_id']) || empty($comment)){

            throw new ApiException('参数错误');

        }

        $fiter = new Fiter('/home/wwwroot/Magazine/public/static/Sensitive/');

        $data['content'] = $fiter -> filter($comment);          #过滤敏感词

        $res = ActicleCommentModel::insert($data);

        if($res){
            return $this -> resultHandler('成功' , true  ,  $data = [] ,10000);
        }else{
            return $this -> resultHandler('失败' , false  ,  $data = [] ,10001);
        }
    }
}
