<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

/**
 * @回调方法接口
 * Interface Comput
 */
interface  Comput {
    //创建回调方法
    public function establishNotify($arr, $data);
}
