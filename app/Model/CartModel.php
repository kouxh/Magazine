<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @购物车模型层
 * Class CartModel
 * @package App\Model
 */
class CartModel extends Model
{
    const TABLE_NAME = 'mz_cart';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @购物车列表
     * @param $uid
     * @return array
     */
    static public function getCartInfo($uid)
    {
        $cart= self::join('mz_magazine' , 'mz_cart.m_id' , '=' , 'mz_magazine.m_id' , 'left')
            -> join('mz_periods' , 'mz_cart.p_id' , '=' , 'mz_periods.id' , 'left')
            -> select('mz_cart.id' , 'mz_cart.num' , 'mz_cart.p_id' , 'mz_cart.type' ,
                'mz_magazine.m_id' , 'mz_magazine.title' , 'mz_magazine.electronics' ,
                'mz_magazine.flat' , 'mz_magazine.cover_img as m_img' , 'mz_magazine.num as mnum' ,
                'mz_magazine.status' , 'mz_periods.title as p_title' , 'mz_periods.money as p_money' ,
                'mz_periods.img as p_img' , 'mz_periods.status as p_status')
            -> where('mz_cart.u_id' , $uid)
            -> orderBy('mz_cart.crea_at', 'desc')
            -> get();

        $data = [];

        foreach ($cart as $k => $v){

            if($v -> type == 1){                //消除 是否是 平装  还是 电子装

                unset($cart[$k] -> flat);

                $cart[$k] -> notes = $v -> num * $v -> electronics . '.00';      //计算小记

            }else{

                unset($cart[$k] -> electronics);

                $cart[$k] -> notes = $v -> num * $v -> flat . '.00';      //计算小记

            }

            if($v -> m_id == null){

                $cart[$k] -> title = $v -> p_title;
                $cart[$k] -> notes = $v -> p_money;
                $cart[$k] -> flat = $v -> p_money;
            }

            unset($cart[$k] -> p_title);
            unset($cart[$k] -> p_money);


            if($v -> m_id != null){

                if($v -> mnum == 0 || $v -> status == 2){       //如果商品的 数量 为 0  或者 已删除   则为失效商品
                    unset($cart[$k] -> mnum);                   //消除商品总数量
                    $data['no_normal'][] = $v;
                }else{
                    unset($cart[$k] -> mnum);
                    $data['normal'][] = $v;
                }

            }else{

                $data['normal'][] = $v;

            }

        }
        return $data;
    }
}
