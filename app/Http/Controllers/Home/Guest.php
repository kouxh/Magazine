<?php
///**
// * Created By PhpStorm
// * Date 2019-12-2
// * Time 16:02
// * Name 马哥
// */
//namespace App\Http\Controllers\Home;
//
//use App\Http\Controllers\Service\BaseController;
//use App\Model\CharacterModel;
//use App\Model\GuestModel;
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//
//class Guest extends BaseController
//{
//    /**
//     * 加载嘉宾列表
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function guestList()
//    {
//        return view('/Home/Guest/list');
//    }
//
//    /**
//     * 嘉宾列表分页
//     * @param Request $request
//     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
//     */
//    public function guestPage(Request $request)
//    {
//        $pageNum = $request -> page;                    //页数
//
//        $limit = $request -> limit;                     //每页显示条数
//
//        $page = $pageNum - 1;
//
//        if ($page != 0) {
//            $page = $limit * $page;
//        }
//
//        $data = GuestModel::select('id' , 'username' , 'post')
//            -> orderBy('crea_at' , 'desc')
//            -> offset($page)
//            -> limit($limit)
//            -> get();
//
//        $count =GuestModel::count();
//
//        foreach ($data as $key => $val){
//            $data[$key] -> crea_at = date('Y-m-d' , $val -> crea_at);
//        }
//
//        return response([
//            'code' => '0',
//            'msg' => '',
//            'count' => $count,
//            'data' => $data,
//        ]);
//    }
//
//    /**
//     * 加载添加
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function guestAdd()
//    {
//
//        $character = CharacterModel::select('id' , 'name') -> get();
//
//        return view('/Home/Guest/add') -> with ('character', $character);
//    }
//
//    /**
//     * 执行添加
//     * @param Request $request
//     * @return mixed
//     */
//    public function guestDoAdd(Request $request)
//    {
//        $data = $request -> data;
//
//        $data['crea_at'] = time();
//
//        unset($data['file']);
//
//        $res = GuestModel::insert($data);
//
//        if($res){
//            return $this -> resultHandler('添加成功' , true , $data = [] , 10000);
//        }else{
//            return $this -> resultHandler('添加失败' , false , $data = [] , 10001);
//        }
//    }
//
//    /**
//     * 加载编辑
//     * @param Request $request
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function guestEdit(Request $request)
//    {
//        $id = $request -> id;
//
//        $data = GuestModel:: where('id' , $id)-> select('id' , 'username' , 'post' , 'photo') -> first();
//
//        return view('Home/Guest/edit') -> with('data' , $data);
//    }
//
//    /**
//     * 执行编辑
//     * @param Request $request
//     * @return mixed
//     */
//    public function guestDoEdit(Request $request){
//
//        $data = $request -> data;
//
//        $data['up_at'] = time();
//
//        unset($data['file']);
//
//        $res = GuestModel::where('id' , $data['id']) -> update($data);
//
//        if($res){
//            return $this -> resultHandler('编辑成功' , true , $data = [] , 10000);
//        }else{
//            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
//        }
//    }
//
//    /**
//     * 删除
//     * @param Request $request
//     * @return mixed
//     */
//    public function guestDel(Request $request)
//    {
//        $id = $request -> id ;
//
//        $res = GuestModel::where('id' , $id) -> delete();
//
//        if($res){
//            return $this -> resultHandler('删除成功' , true , $data = [] , 10000);
//        }else{
//            return $this -> resultHandler('编辑失败' , false , $data = [] , 10001);
//        }
//    }
//}
