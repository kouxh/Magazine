<?php

namespace App\Http\Controllers\Pc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\BaseController;
use App\Model\ColumnModel;
use App\Http\Controllers\Service\PublicColumn;
use App\Model\BookModel;
use App\Model\CharacterModel;
use App\Model\KeywordModel;
use Illuminate\Support\Facades\DB;

class BookController extends BaseController
{
    /**
     * @书籍列表
     * @return mixed
     */
    public function bookList()
    {
        #获取column的id
        $data['column'] = ColumnModel::column('rw');
        #获取其他栏目
        $data = PublicColumn::getPublicColumn($data);

        #分组查询
        $data['type'] = BookModel::select('book_zy', DB::raw('count(*) as num'))
            -> groupBy('book_zy')
            -> get();
        #组建id数组
        $ids = [];
        foreach ($data['type'] as $k => $v){
            $ids[] = $v -> book_zy;
        }
        #查询专业维度
        $data['zy'] = KeywordModel::whereIn('id', $ids) -> select('id', 'title') -> get();
        
        $data['list'] = BookModel::orderBy('crea_at', 'desc') -> get();

        return view('Pc/Book/list') -> with(['data' => $data]);
    }

    /**
     * @书籍详情
     * @param Request $request
     * @return mixed
     */
    public function bookDesc(Request $request)
    {
        $id = $request -> id;

        $data['desc'] = BookModel::where('id', $id) -> first();

        #获取column的id
        $data['column'] = ColumnModel::column('rw');

        #获取其他栏目
        $data = PublicColumn::getPublicColumn($data);

//        #获取人物路径 -- Id
//        $data['rwId'] = $this -> getBookAuthor($data['desc'] -> book_author);
//        dd($data['rwId']);
        $zy = $this -> getResearch($data['desc'] -> book_zy);

        $str='';
        foreach($zy as $k=>$v){
            $str .= $v -> title . ',';
        }

        $data['desc'] -> book_zy = rtrim($str, ',');

        return view('Pc/Book/desc') -> with('data', $data);
        
    }

    /**
     * @书籍分类
     * @param Request $request
     * @return mixed
     */
    public function bookType(Request $request)
    {
        $type = $request -> type;

        if($type == 0){
            $data = BookModel::select('id', 'book_img', 'book_name') -> get();
        }else{
            $data = BookModel::where('book_zy', $type) -> select('id', 'book_img', 'book_name') -> get();
        }

        return $this -> resultHandler('成功', true, $data, 10000);
    }

    /**
     * @查询字段如：【1，2，3，】下的研究领域
     * @param $key_id
     * @return mixed
     */
    protected function getResearch($key_id)
    {
        $key_id = explode(',',  $key_id);
        #查询人物下的研究领域
        return KeywordModel::whereIn('id', $key_id) -> select('id', 'title') -> get();
    }

    /**
     * @查询书籍多个作者如：【1,2,3，】的作者
     * @param $author
     * @return mixed
     */
    protected function getBookAuthor($author)
    {
        $author = explode(',',  $author);
        #dd($author);
        $arr=[];
        for($i=0;$i<count($author);$i++){

            $arr[] = DB::table('mz_character') -> where('name', $author[$i]) -> select('id') -> first();
        }
        dd($arr);
        dd($arr);

        $data =  CharacterModel::whereIn('name', $author) -> select('id', 'name') -> get();

        dd($data);
    }
}
