<?php
/**
 * Created By PhpStorm
 * Date 2020-7-28
 * Time 11:00
 * Name 马哥
 */
namespace App\Http\Controllers\Applets;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Applets\Base;
use App\Model\ClassroomCommentModel;

class CheckParameter extends Base
{
    /**
     * @检测是否是数组
     * @param $arr
     */
    public function isArray($arr){
        if(!is_array($arr)){
            throw new ApiException('传入参数错误（json对象）');
        }
    }

    /**
     * @抛出异常
     * @param $msg
     */
    protected function ApiException($msg)
    {
        throw new ApiException($msg);
    }

    /**
     * @检测微信返回数据是否正常
     */
    protected function checkError($dataArr)
    {
        if(isset($dataArr['errcode'])){
            $this -> ApiException($dataArr['errmsg']);
        }
    }

    /**
     * @验证参数是否为空
     * @param $data
     * @return bool
     */
    protected function checkParameter($data)
    {
        if(empty($data)){
            return false;
        }else{
            return $data;
        }
    }

    /**
     * @递归获取课程详情用户评论及作者回复
     * @param $uid
     * @param int $parent_id
     * @param array $result
     * @return array
     */
    protected function getCommlist($cid, $parent_id = 0,&$result = array()){
        $arr = ClassroomCommentModel::getClassroomComment($cid, $parent_id);
        if(empty($arr)){
            return array();
        }

        foreach ($arr as $item => $cm) {
            $arr[$item] -> com_crea_at = date('Y/m-d', $cm -> com_crea_at);
            $thisArr = &$result[];
            $cm["children"] = $this -> getCommlist($cid,$cm["com_id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }


    /**
     * @递归获取用户下的作者回复用户评论
     * @param $uid
     * @param int $parent_id
     * @param array $result
     * @return array
     */
    protected function getUserCommlist($uid, $parent_id = 0,&$result = array()){
        $arr = ClassroomCommentModel::getUserClassroomComment($uid, $parent_id);

        if(empty($arr)){
            return array();
        }

        foreach ($arr as $item => $cm) {
            $arr[$item] -> com_crea_at = date('Y/m-d', $cm -> com_crea_at);
            $thisArr = &$result[];
            $cm["children"] = $this -> getUserCommlist($uid,$cm["com_id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }

}