<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

use Illuminate\Http\Request;
use App\Http\Controllers\Applets\CheckParameter;
use App\Model\UserModel;

/**
 * @创建(回放权限)回调
 * Class Notify
 * @package App\Http\Controllers\Applets\Forum\Pay\Operation
 */
class PlaybackNotify extends NotifyConfigure implements Comput
{
    public function establishNotify()
    {
        dd('创建(回放权限)回调');
    }
}
