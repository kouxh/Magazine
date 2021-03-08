<?php

namespace App\Http\Controllers\Applets\Forum\Prepay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\Base;
use App\Http\Controllers\Applets\Forum\Pay\Pay;
use App\Exceptions\ApiException;
use App\Model\VipModel;
use App\Model\AddressModel;
use App\Model\CodeModel;
use App\Model\AnnaulModel;
use App\Model\UserModel;
use App\Model\CheckTellModel;
use App\Model\GroupModel;


/**
 * @支付配置
 * Class PayConfigure
 * @package App\Http\Controllers\Applets\Forum\Prepay
 */
class PayConfigure extends Base
{
    /**
     * @ 验证vid是否正确
     * @param $vid
     */
    protected function verificationVid($data)
    {
        $vipArr = [1, 2, 3, 4, 5];
        try {
            if (isset($data['vid']) && in_array($data['vid'], $vipArr)) {
                //查询vip的价钱   设置价钱
                $vipData = VipModel::where('id', $data['vid'])->select('money', 'name')->first();
                return $vipData;
            } else {
                throw new ApiException('Parameter error "VID".');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            exit;
        };
    }

    /**
     * @ 验证手机号和验证码是否正确是否购买全年套餐
     * @param $data
     */
    protected function verificationTellCode($data)
    {
        if (!isset($data['tell']) || !isset($data['code'])) {
            throw new ApiException('Parameter error "Tell" or "Code"');
        }

        //验证手机号和验证码是否正确
        $res = CodeModel::selectCode($data['tell'], $data['code']);
        if (empty($res) || $res->end_time < time()) {
            throw new ApiException('验证码错误或已过期！请重试');
        }

        //验证手机号是否是购买的全年套餐
        $annaul = AnnaulModel::selectAnnualNum($data['tell']);
        if (empty($annaul) || $annaul->s_num == 1) {
            throw new ApiException('您并没有订阅过全年杂志套餐或该手机号已使用过！请尝试其他手机号码！');
        }
    }

    /**
     * @ 获取用户信息的OpenId
     * @param $data
     * @return mixed
     */
    protected function getUserOpenId($data)
    {
        if (!isset($data['uid'])) {
            throw new ApiException('Parameter error "UID"');
        }
        return UserModel::where(['id' => $data['uid']])->select('openid')->first();
    }

    /**
     * @ 获取VIP金额与名字
     * @param $data
     * @return mixed
     */
    protected function getVipMoneyAndName($data)
    {
        return VipModel::where(['id' => $data['vid']])->select('money', 'name')->first();
    }

    /**
     * @ 验证用户传过来的手机号合集，并且返回手机号数组
     * @param $data
     * @return array|false|string[]
     */
    protected function verificationTelephoneCollection($data)
    {
        if(!isset($data['telephoneCollection'])){
            throw new ApiException('Parameter error "Tells", (Empty)');
        }
        //分割一起付电话合集
        $tellArr = explode(',', $data['telephoneCollection']);

        if (!is_array($tellArr)) {
            throw new ApiException('Parameter error "Tell"');
        }
        return $tellArr;
    }

    /**
     * @ 把手机号数组循环插入数据库
     * @param $arr
     * @param $orderNum
     * @param int $res
     * @return int
     */
    protected function loopInsertTell($arr, $orderNum, $res=0)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $res += CheckTellModel::insert(['t_tell' => $arr[$i], 't_orderNum' => $orderNum, 't_crea_at' => time()]);
        }
        return $res;
    }

    /**
     * @ 生成团号把数据添加到数据库中
     * @param $data
     */
    public function establishGroupCodeInsert($data)
    {
        $GroupCode = $this -> establishGroupCode();

        GroupModel::insert(['G_uid' => $data['uid'], 'G_groupCode' => $GroupCode, 'G_groupEndAt' => strtotime('+3 day'), 'G_creaAt' => time()]);
    }
}
