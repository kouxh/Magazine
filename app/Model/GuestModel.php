<?php
/**
 * Created By PhpStorm
 * Date 2019-12-10
 * Time 15:50
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GuestModel extends Model
{
    const TABLE_NAME = 'mz_guest';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
