<?php
/**
 * Created By PhpStorm
 * Date 2019-12-2
 * Time 16:02
 * Name 马哥
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\String_;
use App\Model\KeywordModel;

/**
 * @人物模型层
 * Class CharacterModel
 * @package App\Model
 */
class CharacterModel extends Model
{
    const TABLE_NAME = 'mz_character';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @人物列表
     * @param int $page
     * @param int $c_id
     * @param int $status
     * @return mixed
     */
    static public function character($page=6,$c_id=0,$status=1)
    {
        return self::where('join_character', '2')
            -> select('id', 'name', 'photo','post', 'research', 'golden')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * @搜索 ----- 人物名称
     * @param int $page
     * @param string $keyword
     * @return mixed
     */
    static public function search_rwmc( $keyword='', $page=6)
    {
        return self::where('join_character', '2')
            -> where('name', 'like', '%'.$keyword.'%')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * @搜索 ----- 研究领域
     * @param $keyword
     * @return mixed
     */
    static public function search_yjly($keyword, $page=6)
    {
        $key_id = KeywordModel::where('title' , $keyword) -> select('id') -> first();

        if($key_id == null){
            $id = 0;
        }else{
            $id = $key_id -> id;
        }
        return self::whereRaw('FIND_IN_SET('.$id.',research)',true)
            //-> select('id', 'name', 'research')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }

    /**
     * @相关人物
     * @param $id
     * @param int $page
     * @return mixed
     */
    protected function characterRecommend($id, $page=3)
    {
        return self::whereRaw('FIND_IN_SET('.$id.',research)',true)
            -> select('id', 'photo', 'name', 'golden')
            -> orderBy('crea_at' , 'desc')
            -> Paginate($page);
    }
}
