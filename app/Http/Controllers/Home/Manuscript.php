<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ManuscriptModel;
use App\Http\Controllers\Service\StationEmail;
use App\Http\Controllers\Service\BaseController;
use App\Http\Controllers\Service\Integral;

/**
 * @后台稿件管理
 * Class Manuscript
 * @package App\Http\Controllers\Home
 */
class Manuscript extends BaseController
{
    /**
     * @加载稿件列表
     * @return string
     */
    public function manuscriptList()
    {
        return view('/Home/Manuscript/list');
    }

    /**
     * @ 稿件分页列表
     * @param Request $request
     * @return mixed
     */
    public function ManuscriptPage(Request $request)
    {

        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = ManuscriptModel::HomeManuscriptList($page, $limit);

        $count = ManuscriptModel::HomeManuscriptCount();

        foreach($data as $k => $v)
        {
            if($v -> man_status == 1){
                $data[$k] -> man_status = '未审核';
            }elseif($v -> man_status == 3) {
                $data[$k] -> man_status = '已审核';
            }elseif ($v -> man_status == 2){
                $data[$k] -> man_status = '审核中';
            }
            if($v -> man_adopt == 1){
                $data[$k] -> man_adopt = '未采纳';
            }elseif ($v -> man_adopt == 2){
                $data[$k] -> man_adopt = '采纳中';
            }elseif ($v -> man_adopt == 3){
                $data[$k] -> man_adopt = '已采纳';
            }

            $data[$k] -> man_crea_at = date("Y-m-d H:i:s", $v -> man_crea_at);

        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * @ 加载稿件编辑
     * @param Request $request
     * @return mixed
     */
    public function ManuscriptEdit(Request $request)
    {
        $id = $request -> id;
        $info = ManuscriptModel::where('man_id', $id) -> first();
        return view('/Home/Manuscript/edit') -> with('data', $info);

    }

    /**
     * @稿件执行编辑
     * @param Request $request
     * @return mixed
     */
    public function ManuscriptDoEdit(Request $request)
    {
        $data = $request -> data;

        //判断采纳状态 1已采纳 获得相应积分   3 未采纳 什么都不获得
        if($data['man_adopt'] == 1){
            //调用积分
            $bol = Integral::OperationIntegral($data['uid'], 180, '+');
            //通知消息
            $res = StationEmail::AddStationEmail($data['uid'], '恭喜您投稿文件被我们网站采用，奖励180积分，请注意查收！', 1);
            //积分详情
            $res1 = Integral::IntergraLogs($data['uid'], '稿件采纳', '收入', '180', '1');

            if($bol && $res && $res1){
                //修改信息
                $res = ManuscriptModel::where('man_id', $data['man_id'])
                    -> update(['man_status' => 3, 'man_adopt' => 3, 'man_opinion' => $data['sponsor_desc'], 'man_integral' => 180, 'man_up_at' => time()]);
            }
        }elseif ($data['man_adopt'] == 3){
            $res = ManuscriptModel::where('man_id', $data['man_id'])
                -> update(['man_status' => 3, 'man_adopt' => 1, 'man_opinion' => $data['sponsor_desc'], 'man_integral' => 0, 'man_up_at' => time()]);
        }

        if($res){
            return $this -> resultHandler('编辑成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
        }
    }

    /**
     * @查看稿件
     * @param Request $request
     * @return mixed
     */
    public function ManuscriptShow(Request $request)
    {
        $id = $request -> id;
        $info = ManuscriptModel::where('man_id', $id) -> first();
        return view('/Home/Manuscript/show') -> with('data', $info);
    }

    /**
     * @稿件删除
     * @param Request $request
     * @return mixed
     */
    public function ManuscriptDel(Request $request)
    {
        $id = $request -> id;

        $res = ManuscriptModel::where('man_id', $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('删除失败' , false , $data = [] , 10001);
        }

    }


}
