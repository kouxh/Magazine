<?php
/**
 * Created By PhpStorm
 * Date 2019-6-24
 * Time 11:40
 * Name 马哥
 */
namespace App\Http\Controllers\Pc;

use App\Exceptions\ApiException;
use App\Exceptions\ParamException;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Model\CartModel;
use App\Model\MagazineModel;
use App\Model\PeriodsModel;

class CartController extends CommonController
{
    /**
     * 加入购物车
     * @param Request $request
     * @return mixed
     */
    public function addCart(Request $request)
    {

        $json = $request -> json;
        $data = json_decode($json, true);
        $data['u_id'] = self::$uid;
        $data['crea_at'] = time();

        $res = CartModel::insert($data);

        if($res){
            return $this -> resultHandler('加入购物车成功' , TRUE , $data = [] , 10000);
        }else{
            return $this -> resultHandler('加入购物车失败' , FALSE , $data = [] , 10001);
        }
    }

    /**
     * @增减购物车
     * @param Request $request
     * @return mixed
     */
    public function changeCrat(Request $request)
    {

       $id = $request -> id;

       $num = $request -> num;

       $cart = CartModel::where('id' , $id) -> first();

       if(empty($cart -> p_id)){

           $magazine = MagazineModel::where('m_id' , $cart -> m_id) -> first();

           if($num > $magazine -> num){

               throw new ApiException('大于商品库存');

           }

           $money = 0;
           if($cart -> type == 2){

               $money = $num * $magazine -> flat;
           }
           if($cart -> type == 1){

               $money = $num * $magazine -> electronics;
           }
       }

       if(empty($cart -> m_id)){

           $mz_periods = PeriodsModel::where('id' , $cart -> p_id) -> first();

           $money = $num * $mz_periods -> money;
       }

        $res = CartModel::where('id' , $id) -> update(['num' => $num , 'up_at' => time()]);

        return $this -> resultHandler('' , true , $data = ['num' => $num , 'money' => $money . '.00'] , 10000);


    }
}
