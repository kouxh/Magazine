$(function () {
    // $('.coll_body .dy li').on('click',function(e){
    //     console.log(e,'00000000')
    //     debugger;
    //     $(this).addClass('personal_side_class') //为选中项添加高亮
       
    //     })
     var example = window.location.pathname;
         //订阅中心
    if(example=="/userpageshow"){//个人中心
        $('#qwert li:eq(0)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/mycart"){//我的购物车
        $('#qwert li:eq(1)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/order"){//我的订单
        console.log( $('#qwert li'),"order")
        $('#qwert li:eq(2)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/integral"){//我的积分
        $('#qwert li:eq(3)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/mycollection"){//我的收藏
        $('#qwert li:eq(4)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/myarticle"){//我的收藏
        $('#qwert li:eq(5)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }

    
    //我要投稿
    if(example=="/subcontributions"){//提交稿件
        $('#qwert li').removeClass('personal_side_class');
        $('#manuscript li:eq(0)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/shgj"){//审核查询
        $('#qwert li').removeClass('personal_side_class');
        $('#manuscript li:eq(1)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    //会员中心
    if(example=="/loadinfo"){//基本信息
        $('#qwert li').removeClass('personal_side_class');
        $('#member li:eq(0)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/openingvip"){//会员中心
        $('#qwert li').removeClass('personal_side_class');
        $('#member li:eq(1)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/modifypass"){//修改密码
        $('#qwert li').removeClass('personal_side_class');
        $('#member li:eq(2)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/harvestaddress"){//收货地址
        $('#qwert li').removeClass('personal_side_class');
        $('#member li:eq(3)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/fpxx"){//发票信息
        $('#qwert li').removeClass('personal_side_class');
        $('#member li:eq(4)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }
    if(example=="/mymessage"){//我的留言
        $('#qwert li').removeClass('personal_side_class');
        $('#member li:eq(5)').addClass('personal_side_class').siblings().removeClass('personal_side_class');
    }

})
