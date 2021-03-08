<?php

namespace App\Http\Controllers\BusinessLogic\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Http\Controllers\Common\CommonController;
use App\Model\ArticleCommentModel;
use App\Model\MagazineCommentModel;
use App\Model\ClassroomCommentModel;

class Comment extends CommonController
{
    /**
     * @根据类型 区分 是哪里的评论
     * @param $data
     * @return mixed
     */
    protected function typeInsertComment($data)
    {
        $data['com_crea_at'] = time();
        //dd($data);
        try {
            $error = 'Please input the 1 , 2 , 3 symbols of Math.';

            switch ($data['type']){
                case 1:
                    unset($data['type']);
                    return ArticleCommentModel::insertComment($data);
                case 2:
                    unset($data['type']);
                    return MagazineCommentModel::insertComment($data);
                case 3:
                    unset($data['type']);
                    return ClassroomCommentModel::insertComment($data);
                default:
                    throw new Exception($error);
            }
        }catch (\Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        }
    }

    /**
     * @根据类型 区分 查询评论
     * @param $data
     * @return mixed
     */
    protected function typeListComment($data)
    {
        $this -> isEmpty($data['id'], '缺少id');
        try {
            $error = 'Please input the 1 , 2 , 3 symbols of Math.';

            switch ($data['type']){
                case 1:
                    unset($data['type']);
                    return ArticleCommentModel::getListComment($data);
                case 2:
                    unset($data['type']);
                    return MagazineCommentModel::getListComment($data);
                case 3:
                    unset($data['type']);
                    return ClassroomCommentModel::getListComment($data['id']);
                default:
                    throw new Exception($error);
            }
        }catch (\Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        }
    }

    /**
     * @转换时间戳到日期格式
     * @param $data
     * @return mixed
     */
    public function getDate($data)
    {
        foreach ($data as $key => $val)
        {
            $data[$key] -> com_crea_at = date('Y-m/d');
        }
        return $data;
    }

    /**
     * @我的评论
     * @param $data
     * @return mixed
     */
    public function typeMyComment($data)
    {
        try {
            $error = 'Please input the 1 , 2 , 3 symbols of Math.';

            switch ($data['type']){
                case 1:
                    return ArticleCommentModel::getMyComment($data);
                case 2:
                    return MagazineCommentModel::getMyComment($data);
                case 3:
                    return ClassroomCommentModel::getMyComment($data['com_uid']);
                default:
                    throw new Exception($error);
            }
        }catch (\Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        }
    }

    /**
     * @获取状态
     * @param $data
     * @return mixed
     */
    public function getStatus($data)
    {
        foreach ($data as $k => $v)
        {
            if($v -> com_status == 1)
            {
                $data[$k] -> com_status = '未审核';
            }else{
                $data[$k] -> com_status = '已通过';
            }
            //转换时间
            $data[$k] -> com_crea_at = date('Y-m/d');

        }
        return $data;
    }

    /**
     * @生成文章URL
     * @param $data
     * @return mixed
     */
    public function getArticleUrl($data)
    {
        foreach ($data as $key => $val) {
            //生成url链接
            $data[$key]->com_url = $val->english . '/list/' . $val->aid;

            unset($val->aid);
            unset($val->english);
        }
        return $data;
    }

    /**
     * @删除评论
     * @param $data
     * @return mixed
     */
    public function typeDelComment($data)
    {
        try {
            $error = 'Please input the 1 , 2 , 3 symbols of Math.';

            switch ($data['type']){
                case 1:
                    return ArticleCommentModel::delComment($data);
                case 2:
                    return MagazineCommentModel::delComment($data);
                case 3:
                    return ClassroomCommentModel::delComment($data);
                default:
                    throw new Exception($error);
            }
        }catch (\Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        }
    }


}
