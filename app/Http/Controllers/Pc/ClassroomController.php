<?php

namespace App\Http\Controllers\Pc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\HeaderModel;
use App\Model\ColumnModel;
use App\Model\ClassroomModel;
use App\Model\ArticleModel;
use App\Model\CharacterModel;
use App\Http\Controllers\Service\BaseController;
use Illuminate\Support\Facades\Session;

/**
 * @大讲堂
 * Class ClassroomController
 * @package App\Http\Controllers\Pc
 */
class ClassroomController extends BaseController
{

    /**
     * @大讲堂列表
     * @param Request $request
     * @return mixed
     */
    public function classroomList(Request $request)
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();

        $data['data'] = ClassroomModel::orderBy('cl_crea_at', 'desc')
            -> select('cl_id', 'cl_title', 'cl_img', 'cl_msg', 'cl_crea_at', 'cl_lecturer', 'cl_post')
            ->paginate(9);

        foreach($data['data'] as $key => $val){
            $data['data'][$key] -> cl_crea_at = date('Y m/d', $val -> cl_crea_at);
        }

        $data['Column'] = ColumnModel::column('djt');

        //设置搜索后的变量
        $data['column']['search']['column'] = '';
//        dd($data['Column']);
        return view('Pc/Classroom/list') -> with('data' , $data);


    }

    /**
     * @大讲堂详情
     * @param Request $request
     * @return mixed
     */
    public function classroomDesc(Request $request)
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();

        $id = $request -> id;

        //检测登录
        if (!Session::get('users')) {
            return redirect('/loadLogin');
        }
        #TOP5
        $data['top'] = ArticleModel::topNum();

        //查询课堂数据
        $data['data'] = ClassroomModel::where('cl_id', $id)
            -> select('cl_id', 'cl_title', 'cl_lecturer', 'cl_msg', 'cl_post', 'cl_complete_post', 'cl_video_path', 'cl_research', 'cl_crea_at')
            -> first();

        //转换时间
        $data['data'] -> cl_crea_at = date('m月d日');

        //分割研究领域
        if(!empty($data['data'] -> cl_research)) {
            $kid = explode(',', $data['data'] -> cl_research);
        }

        //猜你喜欢
        $data['like'] = ArticleModel::like($kid[0]);

        //处理点击文章后跳转到哪里
        foreach ($data['like'] as $k => $v){
            $data['like'][$k] -> wz_url = $v -> english . '/list/' . $v -> id;
        }

        //相关视频
        $data['related'] = ClassroomModel::RelatedVideo($data['data'] -> cl_id, $kid[0]);

        //人物
        $data['character'] = CharacterModel::characterRecommend($kid[0]);

        $data['Column'] = ColumnModel::column('djt');
//        dd($data);
        //设置搜索后的变量
        $data['column']['search']['column'] = '';
//        dd($data['related']);
        return view('Pc/Classroom/desc') -> with('data' , $data);
    }
}
