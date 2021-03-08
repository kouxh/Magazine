<?php
/**
 * Created By PhpStorm
 * Date 2019-12-12
 * Time 17:45
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @维度模型
 * Class DimensionModel
 * @package App\Model
 */
class DimensionModel extends Model
{
    const TABLE_NAME = 'mz_keyword';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
