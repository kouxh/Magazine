<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 稿件模型层
 * Class ManuscriptModel
 * @package App\Model
 */
class ManuscriptModel extends Model
{
    const TABLE_NAME = 'mz_manuscript';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;


    /**
     * @添加
     * @param $data
     * @return mixed
     */
    static public function insertManuscript($data)
    {
        return self::insert($data);
    }

    /**
     * @ 查询
     * @return mixed
     */
    static public function getManuscript($uid, $class)
    {

        if($class == 1){
            return self::where('uid', $uid)
                ->select('man_title', 'man_number', 'man_crea_at', 'man_column', 'man_status', 'man_opinion', 'man_integral', 'man_adopt')
                -> get();
        }elseif ($class == 2){
            return self::where('uid', $uid)
                -> where('man_status', 1)
                ->select('man_title', 'man_number', 'man_crea_at', 'man_column', 'man_status', 'man_opinion', 'man_integral', 'man_adopt')
                -> get();
        }elseif ($class == 3){
            return self::where('uid', $uid)
                -> where('man_adopt', 3)
                ->select('man_title', 'man_number', 'man_crea_at', 'man_column', 'man_status', 'man_opinion', 'man_integral', 'man_adopt')
                -> get();
        }elseif($class == 4){
            return self::where('uid', $uid)
                -> where('man_adopt', 1)
                ->select('man_title', 'man_number', 'man_crea_at', 'man_column', 'man_status', 'man_opinion', 'man_integral', 'man_adopt')
                -> get();
        }

    }

    /**
     * @查询稿件后台列表
     * @param $page
     * @param $limit
     * @return mixed
     */
    static public function HomeManuscriptList($page, $limit)
    {
        return self::select('man_id', 'uid', 'man_number', 'man_title', 'man_author', 'man_column', 'man_tell', 'man_status', 'man_adopt', 'man_crea_at')
            -> offset($page)
            -> limit($limit)
            -> orderBy('man_crea_at' , 'desc')
            -> get();
    }

    /**
     * @订单后台总条数
     * @return mixed
     */
    static public function HomeManuscriptCount()
    {
        return self::count();
    }



}
