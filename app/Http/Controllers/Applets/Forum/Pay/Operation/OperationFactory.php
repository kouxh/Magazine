<?php

namespace App\Http\Controllers\Applets\Forum\Pay\Operation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use \Exception;
/**
 * @支付回调工厂模式（读者购买回调、单独购买回调、一起购买回调、分享购买回调、回放权限回调）
 * Class OperationFactory
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class OperationFactory
{
    private static $obj;

    public static function CreateOperation($arr, $data)
    {
        try {
            $error = "Please input the '1', '2', '3', '4', '5' symbols of Math.";

            switch($data['level']){
                case '1' :  //读者购买回调
                    self::$obj = new ReadersNotify();
                    break;
                case '2' :  //单独购买回调
                    self::$obj = new AloneNotify();
                    break;
                case '3' :  //一起购买回调
                    self::$obj = new TogetherNotify();
                    break;
                case '4' :  //分享购买回调
                    self::$obj = new ShareNotify();
                    break;
                case '5' :  //回放权限回调
                    self::$obj = new PlaybackNotify();
                    break;
                default:
                    throw new Exception($error);
            }
            return self::$obj;

        }catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        }
    }
}
