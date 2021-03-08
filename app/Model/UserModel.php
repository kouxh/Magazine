<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @用户模型层
 * Class UserModel
 * @package App\Model
 */
class UserModel extends Model
{
    const TABLE_NAME = 'mz_users';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @后台获取用户数量
     * @param $page
     * @param $limit
     * @return mixed
     */
    static function HomeUserList($page, $limit, $searContent)
    {
        if(empty($searContent)){
            return self::offset($page)
                -> limit($limit)
                -> orderBy('crea_time' , 'desc')
                -> select('id', 'account', 'tell', 'integral', 'balance', 'is_vip', 'crea_time')
                -> get();
        }else{
            return self::where('tell', $searContent)
                -> offset($page)
                -> limit($limit)
                -> orderBy('crea_time' , 'desc')
                -> select('id', 'account', 'tell', 'integral', 'balance', 'is_vip', 'crea_time')
                -> get();
        }

    }

    static function HomeUserCount($searContent)
    {
        if(empty($searContent)){
            return self::count();
        }else{
            return self::where('tell', $searContent) -> count();
        }

    }
}