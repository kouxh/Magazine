<?php
/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Home routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Home" middleware group. Now create something great!
|
*/

/*登陆*/
Route::get('/home/login' , 'Home\LoginController@login');

/*执行登陆*/
Route::post('/home/loginDo' , 'Home\LoginController@loginDo');

/*登陆中间件*/
Route::group(['middleware' => ['checkLogin']], function() {

    /*首页*/
    Route::get('/home/index' , 'Home\IndexController@index');
    Route::get('/home/welcome' , 'Home\IndexController@welcome');

    /*权限中间件*/
    Route::group(['middleware' => ['Privilege']] , function (){

        /*文章*/
        Route::get('/home/article/List' , 'Home\Article@ArticleList');
        Route::get('/home/article/Page' , 'Home\Article@ArticlePage');
        Route::get('/home/article/Add' , 'Home\Article@ArticleAdd');
        Route::post('/home/article/DoAdd' , 'Home\Article@ArticleDoAdd');
        Route::get('/home/article/Del' , 'Home\Article@ArticleDel');
        Route::get('/home/article/Show' , 'Home\Article@ArticleShow');
        Route::get('/home/article/Edit' , 'Home\Article@ArticleEdit');
        Route::post('/home/article/DoEdit' , 'Home\Article@ArticleDoEdit');

        /*活动*/
        Route::get('/home/artivity/List' , 'Home\Activity@artivityList');
        Route::get('/home/artivity/Page' , 'Home\Activity@artivityPage');
        Route::get('/home/artivity/Add' , 'Home\Activity@artivityAdd');
        Route::post('/home/artivity/DoAdd' , 'Home\Activity@artivityDoAdd');
        Route::get('/home/artivity/Edit' , 'Home\Activity@artivityEdit');
        Route::post('/home/artivity/DoEdit' , 'Home\Activity@artivityDoEdit');
        Route::get('/home/artivity/Del' , 'Home\Activity@artivityDel');
        Route::get('/home/artivity/Show' , 'Home\Activity@artivityShow');

        /*新闻*/
        Route::get('/home/news/List' , 'Home\News@newsList');
        Route::get('/home/news/Page' , 'Home\News@newsPage');
        Route::get('/home/news/Add' , 'Home\News@newsAdd');
        Route::post('/home/news/DoAdd' , 'Home\News@newsDoAdd');
        Route::get('/home/news/Edit' , 'Home\News@newsEdit');
        Route::post('/home/news/DoEdit' , 'Home\News@newsDoEdit');
        Route::get('/home/news/Del' , 'Home\News@newsDel');

        /*杂志*/
        Route::get('/home/magazine/List' , 'Home\Magazine@magazineList');
        Route::get('/home/magazine/Page' , 'Home\Magazine@magazinPage');
        Route::get('/home/magazine/Add' , 'Home\Magazine@magazinAdd');
        Route::post('/home/magazine/DoAdd' , 'Home\Magazine@MagazineDoAdd');
        Route::get('/home/magazine/Del' , 'Home\Magazine@MagazineDoDelete');
        Route::get('/home/magazine/Edit' , 'Home\Magazine@MagazineEdit');
        Route::post('/home/magazine/DoEdit' , 'Home\Magazine@MagazineDoEdit');

        /*干货列表*/
        Route::get('/home/food/List' , 'Home\Food@foodList');
        Route::get('/home/food/Page' , 'Home\Food@foodPage');
        Route::get('/home/food/Add' , 'Home\Food@foodAdd');
        Route::post('/home/food/DoAdd' , 'Home\Food@foodDoAdd');
        Route::get('/home/food/Edit' , 'Home\Food@foodEdit');
        Route::post('/home/food/DoEdit' , 'Home\Food@foodDoEdit');
        Route::get('/home/food/Del' , 'Home\Food@foodDel');

        /*精彩瞬间*/
        Route::get('/home/moment/List' , 'Home\Moment@momentList');
        Route::get('/home/moment/Page' , 'Home\Moment@momentPage');
        Route::get('/home/moment/Add' , 'Home\Moment@momentAdd');
        Route::post('/home/moment/DoAdd' , 'Home\Moment@momentDoAdd');
        Route::get('/home/moment/Edit' , 'Home\Moment@momentEdit');
        Route::post('/home/moment/DoEdit' , 'Home\Moment@momentDoEdit');
        Route::get('/home/moment/Del' , 'Home\Moment@momentDel');

        /*栏目管理*/
        Route::get('/home/column/List' , 'Home\Column@columnList');
        Route::get('/home/column/Page' , 'Home\Column@columnPage');
        Route::get('/home/column/Add' , 'Home\Column@columnAdd');
        Route::post('/home/column/DoAdd' , 'Home\Column@columnDoAdd');
        Route::get('/home/column/Edit' , 'Home\Column@columnEdit');
        Route::post('/home/column/DoEdit' , 'Home\Column@columnDoEdit');
        Route::get('/home/column/Del' , 'Home\Column@columnDel');

        /*维度管理*/
        Route::get('/home/dimension/List' , 'Home\Dimension@dimensionList');
        Route::get('/home/dimension/Page' , 'Home\Dimension@dimensionPage');
        Route::get('/home/dimension/Add' , 'Home\Dimension@dimensionAdd');
        Route::post('/home/dimension/DoAdd' , 'Home\Dimension@bdimensionDoAdd');
        Route::get('/home/dimension/Edit' , 'Home\Dimension@dimensionEdit');
        Route::post('/home/dimension/DoEdit' , 'Home\Dimension@dimensionDoEdit');
        Route::get('/home/dimension/Del' , 'Home\Dimension@bdimensionDel');

        /*管理员管理*/
        Route::get('/home/admin/List' , 'Home\Admin@adminList');
        Route::get('/home/admin/Page' , 'Home\Admin@adminPage');
        Route::get('/home/admin/Add' , 'Home\Admin@adminAdd');
        Route::post('/home/admin/DoAdd' , 'Home\Admin@adminDoAdd');
        Route::get('/home/admin/Edit' , 'Home\Admin@adminEdit');
        Route::post('/home/admin/DoEdit' , 'Home\Admin@adminDoEdit');
        Route::get('/home/admin/Del' , 'Home\Admin@adminDel');

        /*权限管理*/
        Route::get('/home/role/List' , 'Home\Role@roleList');
        Route::get('/home/role/Page' , 'Home\Role@rolePage');
        Route::get('/home/role/Add' , 'Home\Role@roleAdd');
        Route::post('/home/role/DoAdd' , 'Home\Role@roleDoAdd');
        Route::get('/home/role/Edit' , 'Home\Role@roleEdit');
        Route::post('/home/role/DoEdit' , 'Home\Role@roleDoEdit');
        Route::get('/home/role/Del' , 'Home\Role@roleDel');

        /*嘉宾管理*/
        Route::get('/home/guest/List' , 'Home\Guest@guestList');
        Route::get('/home/guest/Page' , 'Home\Guest@guestPage');
        Route::get('/home/guest/Add' , 'Home\Guest@guestAdd');
        Route::post('/home/guest/DoAdd' , 'Home\Guest@guestDoAdd');
        Route::get('/home/guest/Edit' , 'Home\Guest@guestEdit');
        Route::post('/home/guest/DoEdit' , 'Home\Guest@guestDoEdit');
        Route::get('/home/guest/Del' , 'Home\Guest@guestDel');

        /*人物管理*/
        Route::get('/home/character/List' , 'Home\Character@characterList');
        Route::get('/home/character/Page' , 'Home\Character@characterPage');
        Route::get('/home/character/Add' , 'Home\Character@characterAdd');
        Route::post('/home/character/DoAdd' , 'Home\Character@characterDoAdd');
        Route::get('/home/character/Edit' , 'Home\Character@characterEdit');
        Route::post('/home/character/DoEdit' , 'Home\Character@characterDoEdit');
        Route::get('/home/character/Del' , 'Home\Character@characterDel');

        /*书籍管理*/
        Route::get('/home/book/List' , 'Home\Book@bookList');
        Route::get('/home/book/Page' , 'Home\Book@bookPage');
        Route::get('/home/book/Add' , 'Home\Book@bookAdd');
        Route::post('/home/book/DoAdd' , 'Home\Book@bookDoAdd');
        Route::get('/home/book/Edit' , 'Home\Book@bookEdit');
        Route::post('/home/book/DoEdit' , 'Home\Book@bookDoEdit');
        Route::get('/home/book/Del' , 'Home\Book@bookDel');

        /*领域管理*/
        Route::get('/home/field/List' , 'Home\Field@fieldList');
        Route::get('/home/field/Page' , 'Home\Field@fieldPage');
        Route::get('/home/field/Add' , 'Home\Field@fieldAdd');
        Route::post('/home/field/DoAdd' , 'Home\Field@fieldDoAdd');
        Route::get('/home/field/Edit' , 'Home\Field@fieldEdit');
        Route::post('/home/field/DoEdit' , 'Home\Field@fieldDoEdit');
        Route::get('/home/field/Del' , 'Home\Field@fieldDel');

        /*订单*/
        Route::get('/home/order/List' , 'Home\Order@orderList');
        Route::get('/home/order/Page' , 'Home\Order@orderPage');
        Route::post('/home/order/ModifyPrice' , 'Home\Order@ModifyPrice');
        Route::post('/home/order/DeliverGoods' , 'Home\Order@DeliverGoods');
        Route::get('/home/order/Edit' , 'Home\Order@orderEdit');
        Route::get('/home/order/Show' , 'Home\Order@orderShow');
        Route::post('/home/order/DoEdit' , 'Home\Order@orderDoEdit');
        Route::get('/home/order/remarksMsg' , 'Home\Order@remarksMsg');
        Route::get('/home/order/invoice' , 'Home\Order@invoice');
        Route::get('/home/order/address' , 'Home\Order@address');
        Route::get('/home/order/logistics' , 'Home\Order@logistics');
        Route::get('/home/order/DoDel' , 'Home\Order@orderDel');
        Route::get('/home/order/logistics' , 'Home\Order@logistics');

        /*稿件*/
        Route::get('/home/manuscript/List' , 'Home\Manuscript@ManuscriptList');
        Route::get('/home/manuscript/Page' , 'Home\Manuscript@ManuscriptPage');
        Route::get('/home/manuscript/Edit' , 'Home\Manuscript@ManuscriptEdit');
        Route::post('/home/manuscript/DoEdit' , 'Home\Manuscript@ManuscriptDoEdit');
        Route::get('/home/manuscript/Show' , 'Home\Manuscript@ManuscriptShow');
        Route::get('/home/manuscript/Del' , 'Home\Manuscript@ManuscriptDel');

        /*课堂*/
        Route::get('/home/classroom/List' , 'Home\Classroom@ClassroomList');
        Route::get('/home/classroom/Page' , 'Home\Classroom@ClassroomPage');
        Route::get('/home/classroom/Add' , 'Home\Classroom@ClassroomAdd');
        Route::post('/home/classroom/DoAdd' , 'Home\Classroom@ClassroomDoAdd');
        Route::get('/home/classroom/Edit' , 'Home\Classroom@ClassroomEdit');
        Route::post('/home/classroom/DoEdit' , 'Home\Classroom@ClassroomDoEdit');
        Route::get('/home/classroom/Del' , 'Home\Classroom@ClassroomDel');

        /*文章评论*/
        Route::get('/home/articleComment/List' , 'Home\ArticleComment@articleCommentList');
        Route::get('/home/articleComment/Page' , 'Home\ArticleComment@articleCommentPage');
        Route::get('/home/articleComment/DoEdit' , 'Home\ArticleComment@articleCommentDoEdit');
        Route::get('/home/articleComment/Del' , 'Home\ArticleComment@articleCommentDel');

        /*杂志评论*/
        Route::get('/home/magazineComment/List' , 'Home\MagazineComment@magazineCommentList');
        Route::get('/home/magazineComment/Page' , 'Home\MagazineComment@magazineCommentPage');
        Route::get('/home/magazineComment/DoEdit' , 'Home\MagazineComment@magazineCommentDoEdit');
        Route::get('/home/magazineComment/Del' , 'Home\MagazineComment@magazineCommentDel');

        /*课堂评论*/
        Route::get('/home/classroomComment/List' , 'Home\ClassroomComment@classroomCommentList');
        Route::get('/home/classroomComment/Page' , 'Home\ClassroomComment@classroomCommentPage');
        Route::get('/home/classroomComment/DoEdit' , 'Home\ClassroomComment@classroomCommentDoEdit');
        Route::get('/home/classroomComment/Del' , 'Home\ClassroomComment@classroomCommentDel');

        /*用户管理*/
        Route::get('/home/user/List' , 'Home\User@userList');
        Route::get('/home/user/Page' , 'Home\User@userPage');
        Route::post('/home/user/editIntegral' , 'Home\User@editIntegral');
        Route::post('/home/user/editBalance' , 'Home\User@editBalance');
        Route::get('/home/user/DoDel' , 'Home\User@DoDel');
        Route::get('/home/user/resetPwd' , 'Home\User@resetPwd');

        /*套餐订单*/
        Route::get('/home/meal/List' , 'Home\Meal@mealList');
        Route::get('/home/meal/Page' , 'Home\Meal@mealPage');
        Route::post('/home/meal/mealDeliverGoods' , 'Home\Meal@mealDeliverGoods');

        /*直播*/
        Route::get('/home/live/List' , 'Home\Live@liveList');
        Route::get('/home/live/Page' , 'Home\Live@livePage');
        Route::get('/home/live/add' , 'Home\Live@liveAdd');
        Route::post('/home/live/DoAdd' , 'Home\Live@liveDoAdd');
        Route::get('/home/live/Edit' , 'Home\Live@liveEdit');
        Route::post('/home/live/DoEdit' , 'Home\Live@liveDoEdit');
        Route::get('/home/live/Del' , 'Home\Live@liveDel');

    });
});

/*上传图片*/
Route::post('/uploadImg' , 'Home\UploadImg@uploadImg');

/*文件视频上传*/
Route::any('/laravelUploadImg' , 'Home\UploadImg@laravelUploadImg');

Route::get('/home/403' , 'Home\LoginController@privilege');
