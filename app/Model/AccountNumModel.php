<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccountNumModel extends Model
{
    const TABLE_NAME = 'mz_account_num';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
