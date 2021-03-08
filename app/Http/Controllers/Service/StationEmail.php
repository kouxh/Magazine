<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\StationEmailModel;
use App\Http\Controllers\Service\BaseController;

/**
 * @站内通知信类
 * Class StationEmail
 * @package App\Http\Controllers\Service
 */
class StationEmail extends BaseController
{
    /**
     * @param $uid          用户ID
     * @param $msg          提示语
     * @param $type         1个人2全站
     * @return mixed
     */
    static public function AddStationEmail($uid, $msg, $type)
    {
       return  StationEmailModel::addEmail($uid, $msg, $type);
    }
}
