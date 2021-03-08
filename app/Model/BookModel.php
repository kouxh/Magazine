<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @书籍模型层
 * Class BookModel
 * @package App\Model
 */
class BookModel extends Model
{
    const TABLE_NAME = 'mz_book';
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    /**
     * @书籍后台列表
     * @param int $page
     * @param $limit
     * @return mixed
     */
    static public function HomeBookList($page=6, $limit)
    {
         return self::where('status' , 1)
             -> join('mz_keyword', 'mz_book.book_zy', '=', 'mz_keyword.id', 'left')
             -> offset($page)
             -> limit($limit)
             -> orderBy('mz_book.crea_at' , 'desc')
             -> select('mz_book.id', 'mz_book.book_name', 'mz_keyword.title', 'mz_book.book_author', 'mz_book.book_publishing_time')
             -> get();
    }

    /**
     * @书籍后台总条数
     * @return mixed
     */
    static public function HomeBookCount()
    {
        return self::count();
    }

    /**
     * @书籍后台编辑查询数据
     * @param $id
     * @return mixed
     */
    static public function HomeGetFirst($id)
    {
        return self::where('id', $id) -> first();
    }

    /**
     * @书籍前台搜索结果页
     * @param $keyword
     * @param int $page
     * @return mixed
     */
    static public function IndexSearchBook($keyword, $page=6)
    {
        return self::where('book_name', 'like', "%$keyword%")
            -> select('id', 'book_img', 'book_name')
            -> orderBy('book_publishing_time', 'desc')
            -> Paginate($page);
    }
}
