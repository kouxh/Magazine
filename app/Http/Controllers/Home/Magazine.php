<?php

namespace App\Http\Controllers\Home;

use App\Model\MagazineModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Service\BaseController;

class Magazine extends BaseController
{
    /**
     * 加载列表
     * @return mixed
     */
    public function magazineList()
    {
        return view('/Home/Magazine/list');
    }

    /**
     * 加载分页
     * @param Request $request
     * @return mixed
     */
    public function magazinPage(Request $request)
    {

        $pageNum = $request -> page;                    //页数

        $limit = $request -> limit;                     //每页显示条数

        $searContent = $request -> searContent;         //关键字

        $page = $pageNum - 1;

        if ($page != 0) {
            $page = $limit * $page;
        }

        $where = [
            'year',
            'like',
            "%$searContent%",
        ];

        $data = MagazineModel::where($where[0], $where[1], $where[2])
            -> where('status', 1)
            -> offset($page)
            -> limit($limit)
            -> select('m_id', 'year' , 'title', 'name', 'subtitle', 'num', 'electronics', 'flat', 'fold', 'status' , 'crea_time')
            -> orderBy('crea_time', 'desc')
            -> get()
            -> toArray();

        $count = MagazineModel::where($where[0], $where[1], $where[2]) -> where('status', 1) -> count();

        foreach ($data as $key => $val){

            if(!$val['fold']){

                $data[$key]['fold'] = '无';

            }

            if($val['status'] == 1){

                $data[$key]['status'] = '正常';

            }else{

                $data[$key]['status'] = '已删除';

            }

            $data[$key]['crea_time'] = date('Y-m-d' , $val['crea_time']);

        }

//        dd($data);
        return response([
            'code' => '0',
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);

    }

    /**
     * 加载添加页面
     * @return mixed
     */
    public function magazinAdd()
    {
        $date = date('Y' , time());
        return view('/Home/Magazine/add') -> with(['date' => $date]);
    }

    /**
     * 执行添加
     * @param Request $request
     * @return mixed
     */
    public function MagazineDoAdd(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $data['crea_time'] = time();

        if($data['discount']){

            $data['discount'] = strtotime('+'.$data['discount'] . 'month');

        }

        $res = MagazineModel::insert($data);

        if($res){

            return $this -> resultHandler('增加成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('增加失败。。。' , false , $data = [] , 10001);
        }
    }

    /**
     * 杂志删除
     * @param Request $request
     * @return mixed
     */
    public function MagazineDoDelete(Request $request)
    {
        $id = $request -> id;

        $res = MagazineModel::where('m_id' , $id) -> delete();

        if($res){

            return $this -> resultHandler('删除成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('删除失败。。。' , false , $data = [] , 10001);

        }
    }

    /**
     * 杂志编辑
     * @param Request $request
     * @return mixed
     */
    public function MagazineEdit(Request $request)
    {
        $id = $request -> id;

        $data = MagazineModel :: where('m_id' , $id) -> first();

        return view('/Home/Magazine/edit') -> with(['data' => $data]);

    }

    /**
     * 执行杂志编辑
     * @param Request $request
     * @return mixed
     */
    public function MagazineDoEdit(Request $request)
    {
        $data = $request -> data;

        unset($data['file']);

        $res =  MagazineModel::where('m_id' , $data['m_id']) -> update($data);

        if($res){

            return $this -> resultHandler('编辑成功。。。' , true , $data = [] , 10000);

        }else{

            return $this -> resultHandler('编辑失败。。。' , false , $data = [] , 10001);

        }
    }
}
