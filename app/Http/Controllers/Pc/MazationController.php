<?php
/**
 * Created by PhpStorm.
 * User: 马哥
 * Date: 2019/5/30
 * Time: 10:30
 */
namespace App\Http\Controllers\Pc;

use App\Exceptions\LoginException;
use App\Http\Controllers\Service\BaseController;
use App\Model\ColumnModel;
use App\Model\AccountNumModel;
use Illuminate\Http\Request;
use App\Model\HeaderModel;
use Illuminate\Support\Facades\DB;

class MazationController extends BaseController
{

    /*加载杂志首页*/
    public function magazineShow(Request $request)
    {

//        $referer = $_SERVER['HTTP_REFERER']?0:$_SERVER['HTTP_REFERER'];
//        echo $referer;die;
//        DD($_SERVER['HTTP_USER_AGENT']);
//
//        if(isset($_SERVER['HTTP_REFERER'])){
//            if($_SERVER['HTTP_REFERER'] != 'http://test.chinamas.cn/'){
//                echo '记录条数';die;
//            }
//
//        }

        $requestPage = $request -> requestPage;

        if($requestPage == 1){
            $this -> addNum();              //增加公众号点击次数
        }

        $data['six'] = DB::table('mz_magazine') -> where('status' , 1) -> orderBy('crea_time' , 'desc') -> limit(6) -> select('m_id' , 'year' , 'title' , 'cover_img') -> get();

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        $data['column'] = ColumnModel::column('zz');

        //dd($data);
        return view('Pc/Magazine/magazineshow') -> with(['data' => $data]);
    }

    /*加载更多杂志*/
    public function showMore(Request $request)
    {

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        $data['magazine'] = DB::table('mz_magazine')
            -> where(['status' => 1])
            -> select('year')
            -> groupBy('year')
            -> orderBy('year' , 'desc')
            -> get()
            -> toArray();

        $data['column'] = ColumnModel::column('zz');

        foreach ($data['magazine'] as $key => $val){

            $data['magazine'][$val -> year] = DB::table('mz_magazine') -> where('status' , 1) -> where('year' , $val->year) -> orderBy('crea_time' , 'desc') -> select('m_id' , 'year' , 'title' , 'cover_img') -> get();
            unset($data['magazine'][$key]);
        }

        return view('Pc/Magazine/showmore') -> with('data' , $data);
    }

    /*加载杂志详情*/
    public function magazineDesc(Request $request , $id)
    {

        $data['header'] = HeaderModel::getHeaderInfo();                         //头部

        $data['magazine'] = DB::table('mz_magazine') -> where(['mz_magazine.m_id' => $id]) -> join('mz_magazine_attribute' , 'mz_magazine.aid' , '=' , 'mz_magazine_attribute.id' , 'left') -> first();

        $data['half_year']  = DB::table('mz_periods') -> where(['id' => 1]) -> select('id' , 'money') -> first();     //半年三期价格

        $data['one_year']  = DB::table('mz_periods') -> where(['id' => 2]) -> select('id' , 'money') -> first();     //全年六期价格

//        $data['s_data'] = DB::table('mz_s_date') -> where(['id' => 1 , 'status' => 1]) -> select('all_periods' , 'year' , 'periods') -> first(); //起订日期

        //设置搜索后的变量
        $data['column']['search']['column'] = '';

        $data['r_magazine'] = DB::table('mz_magazine')
            -> where('m_id' , '<>' , $id)
            -> orderBy('crea_time' , 'desc')
            -> select('m_id' , 'year' , 'title' , 'cover_img')
            -> limit(3)
            -> get();
        //dd($data);
        return view('Pc/Magazine/magazinedesc') -> with('data' , $data);
    }
























    /*杂志列表*/
    public function mazationList(Request $request)
    {

        $data['magazine'] = DB::table('mz_magazine')
                                -> where(['status' => 1])
                                -> select('year')
                                -> groupBy('year')
                                -> orderBy('year' , 'desc')
                                -> get()
                                -> toArray();

        $data['six'] = DB::table('mz_magazine') -> where('status' , 1) -> orderBy('crea_time' , 'desc') -> limit(6) -> select('m_id' , 'year' , 'title' , 'cover_img') -> get();

        foreach ($data['magazine'] as $key => $val){

           $data[$val -> year] = DB::table('mz_magazine') -> where('status' , 1) -> where('year' , $val->year) -> orderBy('crea_time' , 'desc') -> select('m_id' , 'year' , 'title' , 'cover_img') -> get();

        }

        unset($data['magazine']);

        return $this -> resultHandler('查询成功' , true , $data , 10000);
    }

    /*杂志详情*/
    public function mazationDesc(Request $request)
    {
        $id = $request -> id;

        if(empty($id)){

            return $this -> resultHandler('缺少参数。。。' , false , $data = [] , 10001 );

        }

        $data['magazine'] = DB::table('mz_magazine') -> where(['mz_magazine.m_id' => $id]) -> join('mz_magazine_attribute' , 'mz_magazine.aid' , '=' , 'mz_magazine_attribute.id' , 'left') -> first();

        $data['magazine'] -> half_year = DB::table('mz_periods') -> where(['id' => 1]) -> select('id' , 'money') -> first();     //半年三期价格

        $data['magazine'] -> one_year = DB::table('mz_periods') -> where(['id' => 2]) -> select('id' , 'money') -> first();     //全年六期价格

        $data['magazine'] -> s_date = DB::table('mz_s_date') -> where(['id' => 1 , 'status' => 1]) -> select('all_periods' , 'year' , 'periods') -> first(); //起订日期

        $data['r_magazine'] = DB::table('mz_magazine')
            -> where('m_id' , '<>' , $id)
            -> orderBy('crea_time' , 'desc')
            -> select('m_id' , 'year' , 'title' , 'cover_img')
            -> limit(3)
            -> get();

        return $this -> resultHandler('查询成功' , true , $data , 10000 );
    }

    /**
     * 增加公众号访问次数
     * @return mixed
     */
    protected function addNum()
    {
        return AccountNumModel::insert(['acc_num' => 1, 'acc_crea_at' => time()]);
    }
}
