<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    const TABLE_NAME = 'mz_home_admin';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
