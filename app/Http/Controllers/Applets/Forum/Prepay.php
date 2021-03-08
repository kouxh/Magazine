<?php

namespace App\Http\Controllers\Applets\Forum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Applets\CheckParameter;
//use App\Http\Controllers\Applets\Forum\Pay\Pay;
use App\Http\Controllers\Applets\Forum\Prepay\OperationFactory;
use App\Http\Controllers\Applets\Base;
use App\Model\UserModel;
use App\Model\OrderModel;
use App\Model\VipModel;
use App\Model\GroupModel;
use App\Model\VipOrderDescModel;

class Prepay extends Base
{
    private $money;
    private $vid;

    /**
     * @ 测试支付工厂模式
     * @param Request $request
     * @return mixed
     */
    public function unifiedPay(Request $request)
    {
        $type = $request -> type;
        $json = $request -> json;
        $obj = OperationFactory::CreateOperation($type, $json);
        $res = $obj -> establishPay($json);
        return $res;
    }
}
