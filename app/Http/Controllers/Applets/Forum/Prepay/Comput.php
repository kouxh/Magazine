<?php

namespace App\Http\Controllers\Applets\Forum\Prepay;

/**
 * @订单接口类
 * Interface Comput
 */
interface  Comput {
    //创建支付
    public function establishPay($data);
}
