<?php
/**
 * Created By PhpStorm
 * Date 2020-4-15
 * Time 11:36
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @ 发票模型
 * Class DimensionModel
 * @package App\Model
 */
class InvoiceModel extends Model
{
    const TABLE_NAME = 'mz_invoice';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}