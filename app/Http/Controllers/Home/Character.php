<?php
/**
 * Created By PhpStorm
 * Date 2019-12-2
 * Time 16:02
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Service\BaseController;
use App\Model\CharacterModel;
use App\Model\DimensionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Character extends BaseController
{
    /**
     * 加载人物列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function characterList()
    {
        return view('/Home/Character/list');
    }

    /**
     * 人物列表分页
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function characterPage(Request $request)
    {
        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $data = CharacterModel::select('id' , 'name', 'post',  'golden', 'introduce')
            -> orderBy('crea_at' , 'desc')
            -> offset($page)
            -> limit($limit)
            -> get();

        $count =CharacterModel::count();

        foreach ($data as $key => $val){
            $data[$key] -> crea_at = date('Y-m-d' , $val -> crea_at);
        }

        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }

    /**
     * 加载添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function characterAdd()
    {
        $zy = DimensionModel::where('class' , 2) -> get();

        return view('/Home/Character/add') -> with('zy' , $zy);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function characterDoAdd(Request $request)
    {
        $data = $request -> data;
        //dd($data);
        $data['crea_at'] = time();

        unset($data['file']);

        $res = CharacterModel::insert($data);

        if($res){
            return $this -> resultHandler('添加成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('添加失败' , false , $data = [] , 10001);
        }
    }

    /**
     * 加载编辑
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function characterEdit(Request $request)
    {
        $id = $request -> id;

        $zy = DimensionModel::where('class' , 2) -> get();

        $data = CharacterModel:: where('id' , $id) -> first();

        return view('Home/Character/edit') -> with('data' , $data) -> with('zy' , $zy);
    }

    /**
     * 执行编辑
     * @param Request $request
     * @return mixed
     */
    public function characterDoEdit(Request $request){

        $data = $request -> data;
        //dd($data);
        $data['up_at'] = time();

        unset($data['file']);

        $res = CharacterModel::where('id' , $data['id']) -> update($data);

        if($res){
            return $this -> resultHandler('编辑成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
        }
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function characterDel(Request $request)
    {
        $id = $request -> id ;

        $res = CharacterModel::where('id' , $id) -> delete();

        if($res){
            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
        }else{
            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
        }
    }
}
