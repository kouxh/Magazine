<?php
/**
 * Created By PhpStorm
 * Date 2019-12-2
 * Time 16:02
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoleColumnModel
 * @package App\Model
 */
class RoleColumnModel extends Model
{
    const TABLE_NAME = 'mz_role';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    static public function getColumn($status = 1)
    {

        return self::where('status' , $status)
            -> select('id' , 'role_name')
            ->get();

    }
}
