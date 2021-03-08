<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleModel
 * @package App\Model
 */
class RoleModel extends Model
{
    const TABLE_NAME = 'mz_user_role';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     *
     * @param $id
     * @return mixed
     */
    static public function getRole($id)
    {
        return  self::where('user_id' , $id)
            -> select('id' , 'role_id')
            -> first();
    }
}
