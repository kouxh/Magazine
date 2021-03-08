<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthorityModel
 * @package App\Model
 */
class AuthorityModel extends Model
{
    const TABLE_NAME = 'mz_power_role';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    static public function getAuth($role_id)
    {

        //echo $role_id;die;
        return self::where('role_id' , 1)
            -> join('mz_power' , 'mz_power_role.power_id' , '=' , 'mz_power.id' , 'left')
            -> select('mz_power.id' , 'mz_power.power_name' , 'mz_power.power_url' )
            -> get();
    }
}
