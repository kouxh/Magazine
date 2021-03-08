<?php

namespace App\Http\Controllers\BusinessLogic\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use \Exception;
/**
 * @评论工厂类
 * Class OperationFactory
 * @package App\Http\Controllers\BusinessLogic\Order
 */
class OperationFactory
{
    private static $obj;

    public static function CommentOperation($type)
    {
        try {
            $error = "Please input the '1', '2', '3'symbols of Math.";

            switch($type){
                case '1' :  //文章
                    self::$obj = new ArticleComment();
                    break;
                case '2' :  //杂志
                    self::$obj = new MagazineComment();
                    break;
                case '3' :  //课堂
                    self::$obj = new ClassroomComment();
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
