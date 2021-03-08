<?php
/**
 * Created By PhpStorm
 * Date 2020-7-31
 * Time 11:00
 * Name 马哥
 */
namespace App\Http\Controllers\Applets;

use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Applets\Base;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\CustomTokenModel;


class CheckTokenApi extends Base
{
    private $token;
    private $uid;


    public function __construct($token, $uid)
    {
        $this -> token = $token;
        $this -> uid = $uid;
    }

    /**
     * @检测TOKEN是否过期
     */
    public function checkToken()
    {
        $token = CustomTokenModel::where(['cu_token' => $this -> token, 'cu_uid' => $this -> uid]) -> first();
        if(empty($token) || $token -> cu_end_at < time()){
           return $this -> Result('ERROR', false, ['msg' => 'TOKEN已过期！请从新获取'], 10043);
        }
    }
}
