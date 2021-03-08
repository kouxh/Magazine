<?php

namespace App\Http\Controllers\BusinessLogic\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use \Exception;
/**
 * @订单工厂
 * Class OperationFactory
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class OperationFactory
{
    private static $obj;

    public static function CreateOperation($type)
    {
        try {
            $error = "Please input the '1', '2', '3', '4' symbols of Math.";

            switch($type){
                case '1' :  //杂志
                    self::$obj = new MagazineOrder();
                    break;
                case '2' :  //文章
                    self::$obj = new ArticleOrder();
                    break;
                case '3' :  //预售
                    self::$obj = new PresaleOrder();
                    break;
                case '4' :  //VIP
                    self::$obj = new VipOrder();
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
