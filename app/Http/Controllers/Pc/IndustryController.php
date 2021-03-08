<?php
/**
 * Created By PhpStorm
 * Date:2019-9-26
 * Time:16:33
 * Name:马哥
 */
namespace App\Http\Controllers\Pc;

use App\Model\ActivityModel;
use App\Model\ArticleModel;
use App\Model\ColumnModel;
use App\Model\HeaderModel;
use App\Model\MagazineModel;
use App\Model\NewsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\BaseController;
use Illuminate\Support\Facades\DB;

/**
 * 业界控制器
 * Class IndustryController
 * @package App\Http\Controllers\Pc
 */
class IndustryController extends BaseController
{

    public function industryList(Request $request)
    {
        //头部
        $data['header'] = HeaderModel::getHeaderInfo();

        //获取热点事件的id
        $rdsj_id = ColumnModel::column('rdsj') -> id;

        //获取政策解读的id
        $zcjd_id = ColumnModel::column('zcjd') -> id;

        //获取案例的id
        $al_id = ColumnModel::column('al') -> id;

        //获取荐读的id
        $jd_id = ColumnModel::column('jd') -> id;

        //获取人物的id
        $rw_id = ColumnModel::column('rw') -> id;

        //新闻
        $data['news'] = NewsModel::news(5);
        //热点事件
        $data['hotspot'] = ArticleModel::article($rdsj_id , 5);
        //政策&解读
        $data['policy'] = ArticleModel::article($zcjd_id , 5);
        //案例研究
        $data['research'] = ArticleModel::article($al_id , 3);
        //文章荐读
        $data['recommend'] = ArticleModel::article($jd_id , 8);
        //人物
        $data['rw'] = ArticleModel::article($rw_id , 4);
        //活动
        $data['activity'] = ActivityModel::activity();
        //杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        //描述
        $data['column'] = ColumnModel::column('yj');
        //设置搜索后的变量
        $data['column']['column'] = '';
        //dd($data);
        return view('Pc/Industry/list') -> with('data' , $data);

    }
}
