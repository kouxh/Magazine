<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*输出SQL*/
Event::listen('illuminate.query', function($sql,$param) {
    file_put_contents(public_path().'/sql.log',$sql.'['.print_r($param, 1).']'."\r\n",8);
});

/*首页页面*/
Route::get('/','Pc\ShowController@showPage');

/*发送验证码*/
Route::get('code','Service\SendCode@sendCode');

/*调试  ---- 加载兴趣页面*/
Route::get('interest','Pc\RegController@Interest');

/*加载兴趣词*/
Route::get('loadKeyword','Pc\RegController@loadKeyword');

/*调试 ---- 加载注册页面*/
Route::get('loadRegister','Pc\RegController@loadRegister');

/*验证码登陆*/
Route::post('codelogin','Pc\LoginController@codeLogin');

/*调试 ---- 加载登陆页面*/
Route::get('loadLogin','Pc\LoginController@loadLogin');

//微信扫码登陆
Route::get('wechatLogin','Wechat\WechatLogin@wechatLogin');
Route::get('wechatLoginDo','Wechat\WechatLogin@wechatLoginDo');
Route::get('getSessionInfo','Wechat\WechatLogin@getSessionInfo');
Route::get('bangTell','Wechat\WechatLogin@bangTell');


/*登陆*/
Route::post('login','Pc\LoginController@login');

/*忘记密码*/
Route::get('forgotpwd','Pc\LoginController@forgotpwd');

/*搜索*/
Route::get('/search','Pc\SearchController@search');
 

/**
 * 文章订单
 */

Route::get('choiceMode','Pc\ArticleOrderController@choiceMode');


/**
 * 文章开始
 */

/*文章 ----- 列表*/
Route::get('/{column}/list' , 'Pc\ArticleController@articleList');
/*文章 ----- 详情*/
Route::get('/{column}/list/{id}' , 'Pc\ArticleController@articleDesc');
/*业界*/
Route::get('/yj' , 'Pc\IndustryController@industryList');

/*文章 ----- 获取子栏目下有没有维度*/
Route::get('/sonColumn' , 'Pc\ArticleController@sonColumn');
/*文章 ----- 维度下的文章*/
Route::get('/dimensionList' , 'Pc\ArticleController@dimensionList');
/*文章 ----- 好评与差评*/
Route::get('/plwz' , 'Pc\ArticleOperateController@praiseArticle');


/*评论*/
Route::post('/commentInsertApi' , 'Pc\CommentController@commentInsertApi');
Route::get('/commentListApi' , 'Pc\CommentController@commentListApi');
Route::get('/delCommentApi' , 'Pc\CommentController@delCommentApi');


/*新闻 ----- 列表*/
Route::get('/xw' , 'Pc\NewsController@newsList');
/*新闻 ----- 详情*/
Route::get('/xw/{id}' , 'Pc\NewsController@newsDesc');


/*人物 ----- 列表*/
Route::get('/rw' , 'Pc\CharacterController@characterList');
/*人物 ----- 详情*/
Route::get('/rw/{id}' , 'Pc\CharacterController@characterDesc');
/*人物 ----- 搜索*/
Route::get('/search/rw' , 'Pc\CharacterController@characterSearch');

/*大讲堂 ----- 列表*/
Route::get('/djt' , 'Pc\ClassroomController@classroomList');
/*大讲堂 ----- 详情*/
Route::get('/djt/{id}' , 'Pc\ClassroomController@classroomDesc');


/*书籍 ----- 列表*/
Route::get('/sj' , 'Pc\BookController@bookList');
/*书籍 ----- 详情*/
Route::get('/sj/{id}' , 'Pc\BookController@bookDesc');
/*书籍 ----- 类型*/
Route::get('/bookType' , 'Pc\BookController@bookType');


/*专题 ------ 列表*/
Route::get('/special' , 'Pc\SpecialController@specialList');


/*大咖*/
Route::get('bigshot' , 'Pc\ArticleController@bigShot');

/**
 * 文章结束
 */

//活动开始

/*活动*/
Route::get('/hd' , 'Pc\ActivityController@show');

/*搜索活动*/
Route::get('/searchhd' , 'Pc\ActivityController@searchActivity');

/*活动详情*/
Route::get('/hd/{id}' , 'Pc\ActivityController@desc');

/*活动 ---- 干货列表---- */
Route::get('/gh' , 'Pc\FoodController@foodList');

/*活动  ----- 干货详情-----*/
Route::get('/gh/{id}' , 'Pc\FoodController@foodDesc');

/*--- 更多活动 ----*/
Route::get('/gdhd' , 'Pc\ActivityController@moreHd');


//活动结束

/*调试----------加载杂志首页*/
Route::get('/zz','Pc\MazationController@magazineShow');

/*加载更多杂志*/
Route::get('/gdzz','Pc\MazationController@showMore');

/*加载杂志详情*/
Route::get('/zz/{id}','Pc\MazationController@magazineDesc');



///*加载购物车列表*/
//Route::get('cart','Pc\CartController@Cart');
//
///*购物车*/
//Route::get('cartlist','Pc\CartController@cartList');

/*加入购物车*/
Route::post('addcart','Pc\CartController@addCart');

/*购物车删除*/
Route::get('delcart','Pc\CartController@delCart');

/*加减购物车*/
Route::get('changeCrat','Pc\CartController@changeCrat');

/*生成订单*/
Route::post('GenerateOrderApi' , 'Pc\OrderController@GenerateOrderApi');

/*立即支付 重新生成收款二维码*/
Route::get('ImmediatePaymentApi' , 'Pc\OrderController@ImmediatePaymentApi');

///*订单列表*/
//Route::get('orderlist' , 'Pc\OrderController@orderList');

/*收款二维码*/
Route::get('GenerateCodeApi' , 'Wechat\PatternTwoPay@GenerateCodeApi');


/*异步通知*/
Route::any('notifyurl' , 'Wechat\WechatNotily@notifyUrl');

/*同步通知*/
Route::get('refreshorder' , 'Wechat\WechatNotily@RefreshOrder');



/*新建收获地址*/
Route::post('creaaddress' , 'Pc\UserController@creaAddress');

/*退出登陆*/
Route::get('outlogin' , 'Pc\UserController@OutLogin');

/*验证修改密码*/
Route::post('Verification' , 'Common\EditController@Verification');

/*修改密码*/
Route::post('editpass' , 'Common\EditController@editPass');

/*加载预售页面*/
Route::get('cwgxys' , 'Pc\ShowController@advancesale');            #预售页面

/*创建书籍订单*/
Route::get('createBookOrderApi' , 'Pc\OrderController@createBookOrderApi');

/*书籍订单列表*/
Route::get('BookOrderListApi' , 'Pc\OrderController@BookOrderListApi');


/*新版创建订单*/
Route::post('newCreaOrderApi' , 'Pc\OrderController@CreaOrderApi');
/*新版订单列表*/
Route::get('newListOrderApi' , 'Pc\OrderController@ListOrderApi');




/**
 * @个人中心开始
 */
Route::get('userPageShow' , 'Pc\UserController@userPageShow');



#########################
Route::get('userpageshow' , 'Pc\UserController@userPageShow');          #首页
Route::get('loadinfo' , 'Pc\UserController@loadInfo');                  #加载基本信息
Route::get('integral' , 'Pc\UserController@loadIntegral');              #加载积分详情
Route::get('order' , 'Pc\UserController@loadOrder');                    #加载订单
Route::get('openingvip' , 'Pc\UserController@openingVip');              #开通会员
Route::get('auditmanuscript' , 'Pc\UserController@auditManuscript');    #审核稿件
Route::get('harvestaddress' , 'Pc\UserController@harvestAddress');      #收货地址
Route::get('creaaddress' , 'Pc\UserController@creaAddress');            #新建收货地址
Route::get('subcontributions' , 'Pc\UserController@subContributions');  #提交稿件
Route::get('myredeenvelopes' , 'Pc\UserController@myRedeEnvelopes');    #我的红包
Route::get('mymessage' , 'Pc\UserController@myMessage');                #我的留言
Route::get('mycollection' , 'Pc\UserController@myCollection');          #我的收藏
Route::get('modifypass' , 'Pc\UserController@modifyPass');              #修改密码
Route::get('capitaladmin' , 'Pc\UserController@capitalAdmin');          #资金管理
Route::get('mycart' , 'Pc\UserController@myCart');                      #我的购物车
Route::get('czvip' , 'Pc\UserController@czVip');                        #充值VIP
Route::get('shgj' , 'Pc\UserController@auditManuscript');               #审核稿件
Route::get('fpxx' , 'Pc\UserController@invoiceInfo');                   #发票信息
Route::get('uptell' , 'Pc\UserController@upTell');                      #修改手机号
Route::get('orderpay' , 'Pc\UserController@orderPay');                  #生成订单页面
Route::any('pay' , 'Pc\UserController@Pay');                            #支付页面
Route::get('myarticle' , 'Pc\UserController@myArticle');                #我的文章


#########################


/* -------个人中心接口路由------------*/

Route::get('orderApi' , 'Pc\User_ApiController@orderApi');                      #我的订单
Route::post('basicInfoApi' , 'Pc\User_ApiController@upUserInfoApi');            #基本信息修改
Route::get('cancelOrder' , 'Pc\User_ApiController@cancelOrder');                #取消订单
Route::get('orderDescApi' , 'Pc\User_ApiController@orderDescApi');              #订单详情
Route::post('upPasswordApi' , 'Pc\User_ApiController@upPasswordApi');           #修改密码
Route::get('cartApi' , 'Pc\User_ApiController@myCartApi');                      #我的购物车
Route::get('delCartApi' , 'Pc\User_ApiController@delCartApi');                  #删除购物车
Route::get('myCommentApi' , 'Pc\CommentController@myCommentApi');               #我的留言
Route::get('delMessageApi' , 'Pc\User_ApiController@delMessageApi');            #删除留言
Route::post('AddressApi' , 'Pc\User_ApiController@creaAddressApi');             #收货地址创建
Route::get('listAddressApi' , 'Pc\User_ApiController@listAddressApi');          #收货地址列表
Route::post('editAddressApi' , 'Pc\User_ApiController@editAddressApi');         #收货地址编辑
Route::get('setAddressApi' , 'Pc\User_ApiController@setAddressApi');            #设置默认收货地址
Route::get('delAddressApi' , 'Pc\User_ApiController@delAddressApi');            #收货地址删除
Route::get('integralDescApi' , 'Pc\User_ApiController@integralDescApi');        #积分详细
Route::post('subManuscriptApi' , 'Pc\User_ApiController@subManuscriptApi');     #提交稿件
Route::get('exaManuscriptApi' , 'Pc\User_ApiController@exaManuscriptApi');      #审核稿件
Route::get('myCollectionApi' , 'Pc\User_ApiController@myCollectionApi');        #我的收藏
Route::get('delCollectionApi' , 'Pc\User_ApiController@delCollectionApi');      #删除我的收藏
Route::post('joinCollectionApi' , 'Pc\User_ApiController@joinCollectionApi');   #加入我的收藏
Route::post('upUserPhotoApi' , 'Pc\User_ApiController@upUserPhotoApi');         #修改我的头像
Route::get('StationEmailApi' , 'Pc\User_ApiController@StationEmailApi');        #站内信
Route::post('AddInvoiceApi' , 'Pc\User_ApiController@AddInvoiceApi');           #添加发票信息
Route::post('UpKeywordApi' , 'Pc\User_ApiController@UpKeywordApi');             #用户修改关注关键字
Route::get('MyFollowApi' , 'Pc\User_ApiController@MyFollowApi');                #每个关注词下面的文章
Route::any('myArticleApi' , 'Pc\User_ApiController@myArticleApi');              #我购买的文章合集
Route::get('confirmGoodsApi' , 'Pc\User_ApiController@confirmGoods');           #确认收货
Route::get('OutLoginApi' , 'Pc\User_ApiController@OutLoginApi');                #退出登录


/*测试物流接口*/
Route::get('logistics' , 'Pc\User_ApiController@testLogistics');


/*基本信息修改*/
Route::post('basicInfo' , 'Pc\UserController@basicInfo');

/*积分详情*/
Route::get('integralDesc' , 'Pc\UserController@integralDesc');



/*我的关注*/
Route::get('myFollow' , 'Pc\UserController@myFollow');

/*编辑关注*/
Route::get('editFollow' , 'Pc\UserController@editFollow');

/*执行编辑关注*/
Route::post(' ' , 'Pc\UserController@editDoFollow');

/*我要投稿*/
Route::get('contribute' , 'Pc\UserController@Contribute');

/*成为会员*/
Route::get('becomeVip' , 'Pc\UserController@becomeVip');

/*收获地址*/
Route::get('myAddress' , 'Pc\UserController@myAddress');

/*编辑地址*/
Route::get('editAddress' , 'Pc\UserController@editAddress');

/*执行编辑地址*/
Route::post('editDoAddress' , 'Pc\UserController@editDoAddress');

/*设置默认地址*/
Route::get('setAddress' , 'Pc\UserController@setAddress');

/*下载文件*/
Route::get('downloadFile' , 'Pc\UserController@downloadFile');



//个人中心
//首页
Route::get('grzxsy' , 'Pc\UserController@grzxsy');




/**
 * 个人中心结束
 */



/*
 * 活动
 * */

Route::get('/summit' , 'Pc\ActivityController@summit');

Route::get('/selection' , 'Pc\ActivityController@selection');

Route::get('/anlipx' , 'Pc\ActivityController@anlipx');



/*公共*/
Route::get('/flsm' , 'Pc\ShowController@flsm');

/*服务协议*/
Route::get('/fwxy' , 'Pc\ShowController@fwxy');

/*商家入驻*/
Route::get('/sjrz' , 'Pc\ShowController@sjrz');

/*404*/
Route::get('/404' , 'Pc\ShowController@magazine404');

/*讲堂介绍*/
Route::get('/jtjs' , 'Pc\ShowController@jtjs');






///*测试上传接口*/
//Route::get('/testtest' , 'Pc\ShowController@testTest');
///**
// * 测试二维码
// */
//Route::get('testCode' , 'Pc\UserController@testCode');





///*注册*/
Route::post('register','Pc\RegController@register');
//
///*杂志列表*/
//Route::get('magationlist','Pc\MazationController@mazationList');
//
///*杂志详情*/
//Route::get('magationdesc','Pc\MazationController@mazationDesc');






