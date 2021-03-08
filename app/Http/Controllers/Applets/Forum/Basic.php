<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\UserModel;

class Basic extends CheckParameter
{
    protected $sign;

    /**
     * @小程序基本信息展示
     * @param Request $request
     * @return mixed
     */
    public function basicInfo(Request $request)
    {
        $uid = $request -> uid;

        $userInfo = UserModel::where('id', $uid)
            -> select('name', 'tell', 'email', 'sex', 'birthday', 'age', 'company', 'occupation')
            -> first();

        return $this -> Result('Success', true, $userInfo, 10000);
    }

    /**
     * @小程序修改基本信息
     * @param Request $request
     * @return mixed
     */
    public function basicUp(Request $request)
    {
        $json = $request -> json;

        $dataArr = $this -> jsonToArr($json);

        $this -> testingEncryption($dataArr);

        $uid = $dataArr['uid'];
        unset($dataArr['uid']);
        unset($dataArr['sign']);
        unset($dataArr['timestamp']);

        $res = UserModel::where("id", $uid) -> update($dataArr);

        if($res){
            return $this -> Result('Success', true, 1, 10000);
        }else{
            return $this -> Result('ERROR', false, 0, 100001);
        }
    }

    /**
     * @检验签名
     * @param $arr
     */
    protected function testingEncryption($arr)
    {
        $this -> sign = $arr['sign'];
        $sign = $this -> getCustomSign($arr);
        if($this -> sign != $sign){
            $this -> ApiException('Sign错误');
        }
    }
}
