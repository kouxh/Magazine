<?php
/*
|--------------------------------------------------------------------------
| Wechat applets
|--------------------------------------------------------------------------
|
| Here is where you can register Home routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Home" middleware group. Now create something great!
|
*/

/*登陆*/
Route::post('/applets/forum/login' , 'Applets\Forum\Login@login');
/*小程序课堂列表*/
Route::get('/applets/forum/classRoomList' , 'Applets\Forum\ClassRoom@classRoomList');
/*检测Token中间件*/
Route::group(['middleware' => ['CheckToken']] , function () {
    /*小程序课堂详情*/
    Route::get('/applets/forum/classRoomDesc' , 'Applets\Forum\ClassRoom@classRoomDesc');
    /*小程序基本信息展示*/
    Route::get('/applets/forum/basicInfo' , 'Applets\Forum\Basic@basicInfo');
    /*小程序修改基本信息*/
    Route::get('/applets/forum/basicUp' , 'Applets\Forum\Basic@basicUp');
    /*小程序收藏列表*/
    Route::get('/applets/forum/collectionList' , 'Applets\Forum\Collection@collectionList');
    /*小程序加入收藏*/
    Route::get('/applets/forum/insertCollection' , 'Applets\Forum\Collection@insertCollection');
    /*小程序支付接口*/
    Route::get('/applets/forum/Pay/getPrepayId' , 'Applets\Forum\Prepay@getPrepayId');

    Route::post('/applets/forum/Pay/unifiedPay' , 'Applets\Forum\Prepay@unifiedPay');
    /*小程序查询用户是否是vip*/
    Route::get('/applets/forum/checkUserVip' , 'Applets\Forum\User@checkUserVip');
    /*小程序查询用户积分余额*/
    Route::get('/applets/forum/getUserInfo' , 'Applets\Forum\User@getUserInfo');
    /*小程序获取用户下的评论*/
    Route::get('/applets/forum/getUserComment' , 'Applets\Forum\User@getUserComment');
    /*获取用户评论课堂之后 作者回复数量*/
    Route::get('/applets/forum/getReplyNumApi' , 'Applets\Forum\User@getReplyNumApi');
    //Route::get('/applets/forum/getCommentList' , 'Applets\Forum\Comment@getCommentList');
    /*小程序获取直播内容*/
    Route::get('/applets/forum/getLiveDesc' , 'Applets\Forum\Live@getLiveDesc');
    /*小程序获取直播列表*/
    Route::get('/applets/forum/getLiveList' , 'Applets\Forum\Live@getLiveList');
    /*小程序获取用户订单*/
    Route::get('/applets/forum/getOrderList' , 'Applets\Forum\Order@getOrderList');
    /*小程序分享成团添加地址*/
    Route::get('/applets/forum/orderAddressApi' , 'Applets\Forum\Order@orderAddressApi');
    /*小程序分享成团添加发票*/
    Route::get('/applets/forum/orderInvoiceApi' , 'Applets\Forum\Order@orderInvoiceApi');
    /*小程序报名直播观看*/
    Route::get('/applets/forum/getUserSignUp' , 'Applets\Forum\User@getUserSignUp');
    /*小程序添加收货地址---购买VIP送杂志地址*/
    Route::post('/applets/forum/insertAddressVip' , 'Applets\Forum\User@insertAddressVip');
    /*小程序展示收货地址*/
    Route::get('/applets/forum/getAddressListApi' , 'Applets\Forum\User@getAddressListApi');
    /*小程序查询单条地址*/
    Route::get('/applets/forum/getOneAddressApi' , 'Applets\Forum\User@getOneAddressApi');
    /*小程序修改收货地址*/
    Route::post('/applets/forum/upAddressVip' , 'Applets\Forum\User@upAddressVip');
    /*小程序添加发票信息---购买VIP*/
    Route::post('/applets/forum/insertInvoiceVip' , 'Applets\Forum\User@insertInvoiceVip');
    /*小程序展示我的发票信息*/
    Route::get('/applets/forum/getInvoiceApi' , 'Applets\Forum\User@getInvoiceApi');
    /*小程序修改发票信息*/
    Route::post('/applets/forum/upInvoiceVip' , 'Applets\Forum\User@upInvoiceVip');
    /*小程序点赞增加数量*/
    Route::get('/applets/forum/classRoomGive' , 'Applets\Forum\ClassRoom@classRoomGive');
    /*小程序分享增加数量*/
    Route::get('/applets/forum/classRoomShare' , 'Applets\Forum\ClassRoom@classRoomShare');
    /*购买读者*/
    Route::get('/applets/forum/purchaseAnnualSetMeal' , 'Applets\Forum\Plus@purchaseAnnualSetMeal');
    /*检测手机号是否是会员*/
    Route::get('/applets/forum/checkTellIsVip' , 'Applets\Forum\User@checkTellIsVip');
    /*查询用户是否购买VIP发送通知信*/
    Route::get('/applets/forum/getPayMail' , 'Applets\Forum\User@getPayMail');
    /*修改用户站内信为已读*/
    Route::get('/applets/forum/upUserMailStatus' , 'Applets\Forum\User@upUserMailStatus');
    /*购买vip一起支付*/
    Route::get('/applets/forum/togetherPay' , 'Applets\Forum\Together@togetherPay');
    /**
     * 成团开始
     */
    /*检测用户是否在成团列表中*/
    Route::get('/applets/forum/checkUserInGroup' , 'Applets\Forum\Group@checkUserInGroup');
    Route::get('/applets/forum/establishGroupCodeNum' , 'Applets\Forum\Group@establishGroupCodeNum');
    Route::get('/applets/forum/sharePageShow' , 'Applets\Forum\Group@sharePageShow');
    Route::get('/applets/forum/getPayStatus' , 'Applets\Forum\Group@getPayStatus');

});

/*小程序支付回调地址*/
Route::post('/applets/forum/Pay/notifyUrl' , 'Applets\Forum\Pay\Notify@notifyUrl');
Route::post('/applets/forum/Pay/tuikuan' , 'Applets\Forum\Group@tuikuan');

//Route::get('/applets/forum/getAccessToken' , 'Applets\Forum\upAppletsActicle@upActicle');





