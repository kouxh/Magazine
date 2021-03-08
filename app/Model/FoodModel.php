<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodModel extends Model
{
    const TABLE_NAME = 'mz_av_food';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
