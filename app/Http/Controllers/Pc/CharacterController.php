<?php

namespace App\Http\Controllers\Pc;

use App\Http\Controllers\Service\BaseController;
use App\Model\BookModel;
use App\Model\CharacterModel;
use App\Model\ColumnModel;
use App\Model\KeywordModel;
use App\Model\ArticleModel;
use App\Model\NewsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\PublicColumn;

/**
 * @人物控制器
 * Class CharacterController
 * @package App\Http\Controllers\Pc
 */
class CharacterController extends BaseController
{
    /**
     * @人物板块列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function characterList(Request $request)
    {
        #获取column的id
        $data['column'] = ColumnModel::column('rw');
        #获取其他栏目
        $data = PublicColumn::getPublicColumn($data);
        #人物列表
        $data['list'] = CharacterModel::character();
        #查询人物研究领域
        foreach($data['list'] as $key => $val)
        {
            $data['list'][$key] -> research = $this -> getResearch($val -> research);
        }
        return view('Pc/Character/list') -> with('data' , $data);
    }

    /**
     * @人物列表搜索
     * @param Request $request
     */
    public function characterSearch(Request $request)
    {
        $type = $request -> type;
        $keyword = $request -> keyword;

        #获取column的id
        $data['column'] = ColumnModel::column('rw');
        #获取其他栏目
        $data = PublicColumn::getPublicColumn($data);
        #设置搜索的变量
        $data['keyword'] = $keyword;
        $data['type'] = $type;

        switch ($type){
            case '人物名称':
                #获取搜索后的列表
                $data['list'] = CharacterModel::search_rwmc($keyword);
                #处理查询出数据的研究领域
                $data['list'] = $this -> getOneCharacterResearch($data['list']);

                #设置加载哪个模板
                $view = 'search_rwmc';
                break;

            case '研究领域':
                #获取搜索后的列表
                $data['list'] = CharacterModel::search_yjly($keyword);
                #处理查询出数据的研究领域
                $data['list'] = $this -> getOneCharacterResearch($data['list']);

                #设置加载哪个模板
                $view = 'search_yjly';
                break;

            case '著作':
                $data['list'] = ArticleModel::getArticleTitle(6, 1, $keyword);
                //转换时间
                foreach ($data['list'] as $k => $v){
                    $data['list'][$k] -> crea_at = $this -> getDate($v -> crea_at);
                }
                #设置加载哪个模板
                $view = 'search_zz';
                break;

            case '书籍':
                $data['list'] = BookModel::IndexSearchBook($keyword);
                $view = 'search_sj';
                break;
        }
        //dd($data['list']);
        return view('Pc/Character/'.$view) -> with('data' , $data);



    }

    /**
     * @人物详情
     * @param Request $request
     */
    public function characterDesc(Request $request)
    {
        $id = $request -> id;
        #头部
        $data['header'] = self::$header;
        #获取column的id
        $data['column'] = ColumnModel::column('rw');
        #获取人物信息
        $data['character_info'] = CharacterModel::where('id' , $id) -> first();
        #获取个人得研究领域
        $key_id = explode(',',  $data['character_info'] -> research);

        #查询人物下的研究领域
        $data['research'] = KeywordModel::whereIn('id', $key_id) -> select('id', 'title') -> get();
        #查询人物下的广告图
        $data['advert'] = ColumnModel::where('english', 'rw') -> select('id', 'Pc_advert', 'Pc_advert_url', 'App_advert', 'App_advert_url') -> first();
        #查询人物下的新闻
        $data['news'] = NewsModel::where('related_figures', 'like', "%".$data['character_info'] -> name."%") -> select('id', 'title', 'author') -> get();
        #查询猜你喜欢的文章
        $data['like'] = ArticleModel::like($key_id[0]);
        #查询相关人物推荐
        $data['relevant'] = CharacterModel::where('is_relevant', 1) -> where('id', '!=', $data['character_info'] -> id) -> limit(3) -> select('id', 'photo', 'name', 'post')-> orderBy('crea_at', 'desc') -> get();
        #查询书籍
        $data['book'] = BookModel::where('book_author', 'like', "%".$data['character_info'] -> name."%") -> select('id', 'book_name', 'book_img', 'book_message') -> orderBy('crea_at', 'desc') -> first();
        #查询人物著作
        $data['work'] = ArticleModel::where('mz_article.author', 'like', "%".$data['character_info'] -> name."%")
            -> where('mz_article.status', 1)
            -> join('mz_column', 'mz_article.column_id', '=', 'mz_column.id', 'left')
            -> select('mz_article.id', 'mz_article.title', 'mz_article.crea_at', 'mz_column.column', 'mz_column.english')
            -> orderBy('mz_article.crea_at', 'desc')
            -> limit(7)
            -> get();

        //转化时间
        foreach ($data['work'] as $k => $v){
            $data['work'][$k] -> crea_at = date('Y-m-d' , $v -> crea_at);
        }

        return view('Pc/Character/desc') -> with('data', $data);

    }

    /**
     * @循环获取每个人物的研究领域
     * @param $data
     * @return mixed
     */
    protected function getOneCharacterResearch($data)
    {
        #查询人物研究领域
        foreach($data as $key => $val)
        {
            $data[$key] -> research = $this -> getResearch($val -> research);
        }
        return $data;
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




}
