<?php
/**
 * Created By PhpStorm
 * Date 2020-7-28
 * Time 11:00
 * Name 马哥
 */
namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Applets\CheckParameter;
use App\Http\Controllers\Applets\Decrypt\Decrypt;
use App\Http\Controllers\Applets\WechatCmas;
use App\Http\Controllers\Applets\WechatPlus;
use App\Model\UserModel;
use App\Model\TokenModel;
use App\Model\CustomTokenModel;
use App\Model\StationEmailModel;
use App\Model\CheckTellModel;

class Login extends CheckParameter
{
    /**
     * @小程序登陆
     * @return mixed
     */
    public function login(Request $request)
    {
        //接收Json参数
        $json = $request -> json;
        //转json到数组
        $dataArr = $this -> jsonToArr($json);
        //获取用户的openId
        if($dataArr['type'] == 1){
            //大讲堂
            $dataJson = WechatCmas::getUserOpenId($dataArr['code']);
        }else if($dataArr['type'] == 2){
            //PLus会员购买
            $dataJson = WechatPlus::getUserOpenId($dataArr['code']);
        }

        //转json到数组
        $dataOpenidArr = $this -> jsonToArr($dataJson);

        if(!isset($dataOpenidArr['session_key'])){
            return  $this -> Result('Error', false, ['msg' => '授权失败'], 10001);
        }

        //获取加密用户信息
        $infoJson = Decrypt::decryptGetUserinfo($dataOpenidArr['session_key'], $dataArr['encryptedDataInfo'], $dataArr['ivInfo'], $dataArr['type']);
        //转json到数组
        $infoArr = $this -> jsonToArr($infoJson);

        //获取加密用户手机号
        $phoneJson = Decrypt::decryptGetUserinfo($dataOpenidArr['session_key'],$dataArr['encryptedDataPhone'], $dataArr['ivPhone'], $dataArr['type']);
        //转json到数组
        $phoneArr = $this -> jsonToArr($phoneJson);

        //检测微信返回数据是否正常
        $this -> checkError($dataArr);
        $this -> checkError($phoneArr);

        //生成自定义Token
        $cu_token = $this -> getRandChar(32);
        //dd($infoArr);
        //查询用户有没有注册CMAS,如果有直接返回自定义Token,如果没有查询用户的unionId将前端传过来的数据存入到数据库中
        $userInfo = $this -> getUserInfo($phoneArr['phoneNumber']);
        //判断用户信息是否存在，
        //dd($userInfo);
        if(empty($userInfo)){

            $userData = CheckTellModel::where('t_tell', $phoneArr['phoneNumber']) -> select('t_status', 't_crea_at') -> first();

            $is_vip = 0;
            $start_at = 0;
            $end_at = 0;

            if(isset($userData -> t_status)){
                if($userData -> t_status == 1){
                    $is_vip = 3;
                    $start_at = $userData -> t_crea_at;
                    $end_at = strtotime('+12 month', $userData -> t_crea_at);
                }
            }

            //组装用户信息
            $data = [];
            $data = $this -> assembleUserInfo($infoArr['openId'], $infoArr['unionId'], $infoArr['nickName'], $infoArr['avatarUrl'], $phoneArr['phoneNumber'], $is_vip, $start_at, $end_at, $data);
            //存入数据库
            $uid = $this -> inserUserInfo($data);
            if($uid){
                //添加自定义token
                CustomTokenModel::insertCustomToken($cu_token, $uid);
                //通知站内信奖励2积分
                StationEmailModel::addEmail($uid, '恭喜您成为管理会计研究杂志的普通会员，奖励2积分，请注意查收！', 1);
                $data = ['uid' => $uid,
                    'account' => $infoArr['nickName'],
                    'photo' => $infoArr['avatarUrl'],
                    'is_vip' => 3,
                    'token' => $cu_token
                ];
            }
        }else{

            $cuToken = CustomTokenModel::selectCustomToken($userInfo -> id);

            if(empty($cuToken)){
                //添加自定义token
                CustomTokenModel::insertCustomToken($cu_token, $userInfo -> id);
            }
            if(!empty($cuToken) && $cuToken -> cu_end_at < time()){
                //修改自定义token
                CustomTokenModel::upCustomToken($cu_token, $userInfo -> id);
            }
            if(!empty($cuToken && $cuToken -> cu_end_at > time()))
            {
                $cu_token = $cuToken -> cu_token;
            }

            $data = ['uid' => $userInfo -> id,
                'account' => $userInfo -> account,
                'is_vip' => $userInfo -> is_vip,
                'photo' => $userInfo -> photo,
                'token' => $cu_token
            ];
        }

        //返回前端用户id跟用户名自定义token
        return $this -> Result('Success', true, $data, 10000);

    }

    /**
     * @查询用户的信息
     * @param $openid
     * @return mixed
     */
    protected function getUserInfo($tell)
    {
        return UserModel::where(['tell' => $tell])-> select('id', 'account', 'is_vip') -> first();
    }

    /**
     * @组装用户信息
     * @param $opneid
     * @param $UnionId
     * @param $nikeName
     * @param $ptoto
     * @param $data
     * @return mixed
     */
    protected function assembleUserInfo($opneid, $UnionId, $nikeName, $ptoto, $tell, $is_vip, $start_at, $end_at, $data)
    {
        $data['openid'] = $opneid;
        $data['unionid'] = $UnionId;
        $data['tell'] = $tell;
        $data['pwd'] = md5(123456);
        $data['account'] = $nikeName;
        $data['photo'] = $ptoto;
        $data['integral'] = 2;
        $data['is_vip'] = $is_vip;
        $data['start_time'] = $start_at;
        $data['end_time'] = $end_at;
        $data['crea_time'] = time();
        return $data;
    }

    /**
     * @向用户表里插入数据
     * @param $dataArr
     * @param $UnionId
     * @param $openid
     * @return mixed
     */
    protected function inserUserInfo($data)
    {
        return UserModel::insertGetId($data);
    }


    /**
     * @获取Access_Token
     * @return mixed
     */
    protected function getaccessToken()
    {
        //从数据库获取Access_Token
        $token = TokenModel::getToken();
        //如果token过期时间小于当前时间从新获取token
        if($token -> we_end_at < time()){
            //请求微信URL获取Access_Token
            $tokenJson = Wechat::getAccessToken();
            //将获取微信的Json转成数组
            $tokenArr = $this -> jsonToArr($tokenJson);
            //验证微信返回的数据是否正常
            $this -> checkError($tokenArr);
            //修改数据库的token
            $res = TokenModel::upToken($tokenArr['access_token']);
            if($res){
                return $tokenArr['access_token'];
            }
        }
        return $token -> we_access_token;
    }

    /**
     * @添加自定义Token
     * @param $cu_token
     * @return mixed
     */
    protected function insertCuToken($cu_token)
    {
        return CustomTokenModel::insertCustomToken($cu_token);
    }
}
