<?php

namespace App\Http\Controllers\Applets\Forum\Prepay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use \Exception;
/**
 * @支付工厂模式（读者购买、单独购买、一起购买、分享购买、回放权限）
 * Class OperationFactory
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class OperationFactory
{
    private static $obj;

    public static function CreateOperation($type, $json)
    {
        try {
            $error = "Please input the '1', '2', '3', '4', '5' symbols of Math.";

            switch($type){
                case '1' :  //读者购买
                    self::$obj = new Readers();
                    break;
                case '2' :  //单独购买
                    self::$obj = new Alone();
                    break;
                case '3' :  //一起购买
                    self::$obj = new Together();
                    break;
                case '4' :  //分享购买
                    self::$obj = new Share();
                    break;
                case '5' :  //回放权限
                    self::$obj = new Playback();
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
