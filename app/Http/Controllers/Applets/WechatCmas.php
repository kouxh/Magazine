<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2020/07-28
 * Time: 16:15
 */
namespace App\Http\Controllers\Applets;



class WechatCmas
{
    /**
     * @获取Access_Token
     * @return false|string
     */
    static public function getAccessToken(){
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.config('appletsCmasPay.AppID').'&secret='.config('appletsCmasPay.AppSecret');
        return file_get_contents($url);
    }

    /**
     * @获取openId
     * @return false|string
     */
    static public function getUserOpenId($code)
    {
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".config('appletsCmasPay.AppID')."&secret=".config('appletsCmasPay.AppSecret')."&js_code=JSCODE&grant_type=authorization_code'";
        $url = str_replace('JSCODE',$code, $url);
        return file_get_contents($url);
    }

    /**
     * @获取用户的unionId
     * @param $access_token
     * @param $openid
     * @return false|string
     */
    static public function getUnionId($access_token,$openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid";

        return file_get_contents($url);
    }
}