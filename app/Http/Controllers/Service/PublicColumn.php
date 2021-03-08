<?php

namespace App\Http\Controllers\Service;

use App\Model\ArticleModel;
use App\Model\ColumnModel;
use App\Model\MagazineModel;
use App\Model\ActivityModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;

class PublicColumn extends BaseController
{
    /**
     * @获取每个页面需要的右侧跟底部
     * @return mixed
     */
    static public function getPublicColumn($data)
    {
        #头部
        $data['header'] = self::$header;
        #TOP
        $data['top'] = ArticleModel::topNum();
        #杂志
        $data['magazine'] = MagazineModel::getFirstMagazine();
        #荐读
        $data['jd'] = ArticleModel::article(9 ,3);
        #随机栏目
        $data['rand'] = ColumnModel::randColumn($data['column'][0]['id'] , 3);
        #活动
        $data['activity'] = ActivityModel::activity();
        #随机栏目下的数据
        foreach($data['rand'] as $key => $val){
            $data['rand'][$key] -> data = ArticleModel::article($val -> id ,'3');
        }
        #活动的开始时间
        foreach($data['activity'] as $k => $v){
            $data['activity'][$k] -> start_at = substr($v -> start_at , 0  ,strpos($v -> start_at ,' ' ) +1);
        }

        return $data;
    }



}
