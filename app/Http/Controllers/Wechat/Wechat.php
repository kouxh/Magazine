<?php

namespace App\Http\Controllers\Wechat;
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/5/30
 * Time: 10:30
 */
use App\Model\HeaderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FollowModel;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Model\TokenModel;


class Wechat extends Controller
{
    static $appid = 'wxe55c63ef03977067';
    static $secret = '6109288b8a55da8915e7ae8ce38305ad';
    static $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
    static $grant_type = 'authorization_code';
    static $getInfoUrl = 'https://api.weixin.qq.com/sns/userinfo';


    /**
     * @获取token
     * @param $code
     */
    static public function  getToken($code)
    {
        $newUrl = self::$url.'?appid='.self::$appid.'&secret='.self::$secret.'&code='.$code.'&grant_type=authorization_code';

        $data = file_get_contents($newUrl);

        return json_decode($data,true);

    }

    /**
     * @获取用户信息
     * @param $token
     * @param $openid
     * @return mixed
     */
    static public function getUserInfo($token, $openid)
    {
        $newUrl = self::$getInfoUrl.'?access_token='.$token.'&openid='.$openid;

        $data = file_get_contents($newUrl);

        return json_decode($data,true);
    }

}