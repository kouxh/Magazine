<?php

namespace App\Http\Controllers\BusinessLogic\Order;

/**
 * @订单接口类
 * Interface Comput
 */
interface  Comput {
    //创建订单
    public function creaOrder($data);
    //订单列表
    public function listOrder($data);
}
