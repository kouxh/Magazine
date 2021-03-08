// 个人中心首页
// 个人中心首页  会员中心
$(function() {

    // var zym = 'http://test.chinamas.cn';
    // var token = getCookie("token"); //
    // console.log(token)
    $.ajax({
        type: "GET",
        url: "/homePage",
        success: function(data) {
            console.log(data.data);
            // 购物车数量
            $('.TitleSearch_right label span').html(data.data.cart);
            //个人信息 user
            //$('.member_one dl dt .user ').html(data.data.user.photo) //头像photo
            $('.member_one dl dd .user ').html(data.data.user.account); //用户名
            $('.member_two dl dd #ye ').html(data.data.user.balance); //余额
            $('.member_two dl dd #jf ').html(data.data.user.integral); //积分
            $('.member_two dl dd .tz ').html(data.data.notice.length)
            //提醒
            var remind = '';
            $.each(data.data.remind, function(k, v) {
                remind += '<li>' + v.message + '</li>';
            });
            $('.MembershipCenter_Tips .li-box  ul').html(remind);
            // 我的订单，
            // 所有订单
            $.each(data.data.order, function(k, v) {
                // console.log(v)
                var html = '<li>';
                html += '<div class="status"><div class="orderTitle"><p>订单号 :</p><p>' + v.order_num + '</p><p>' + v.crea_at +
                    '</p></div >';
                $.each(v.order_desc, function(k, v) {
                    // console.log(v)
                    html += '<ul class="oneShoppingList"><li><img src=' + zym + '' + v.cover_img +
                        '  alt=""><div class="productName">' + v.title +
                        '</div><div class="productMain">起订日期</div><div class="productTip">规格: 平装</div></li><li><p>' + v.num +
                        '</p></li><li><p>¥<span>' + v.price +
                        '</span></p></li><li></li></ul>'

                })
                html += '</div><div class="statusAndControl" ><div class="nameTypeTable" ><div class="module"><p>' + v.address
                        .consignee + '</p></div></div><div class="totalTypeTable" ><div class="module"><p>￥<span>' + v.all_price +
                    '</span></p><p>(含运费￥<sapn>10</sapn>)</p><p>在线支付</p></div></div><div class="statusTypeTable" style="height: 170px;"><div class="module"><p>'+data.data.order[k].status +
                    '</p></div></div><div class="controlTable" style="height: 170px;"><div class="module"><span class="span payment">立即支付</span><span class="span OrderDetails">订单详情</span><span class="span CancellationOrder">取消订单</span><span class="span Repurchase">再次购买</span></div></div></div>'
                html += '</li>'
                console.log(data.data.order[k].status);
                $('.Order .OrderListDetail .clear').before(html);

            });
            // 待支付			default2
            $('.default2').click(function() {
                $.ajax({
                    type: "GET",
                    url: "http://www.ynresearch.net/myOrder?status=1",
                    headers: {
                        'token': token
                    },
                    success: function(data) {
                        console.log(data);
                        $.each(data.data, function(k, v) {
                            console.log(v)
                            var html = '<li>';
                            html += '<div class="status"><div class="orderTitle"><p>订单号 :</p><p>' + v.order_num + '</p><p>' + v.crea_at +
                                '</p></div >';
                            $.each(v.order_desc, function(k, v) {
                                // console.log(v)
                                html += '<ul class="oneShoppingList"><li><img src=' + zym + '' + v.cover_img +
                                    '  alt=""><div class="productName">' + v.title +
                                    '</div><div class="productMain">起订日期</div><div class="productTip">规格: 平装</div></li><li><p>' + v.num +
                                    '</p></li><li><p>¥<span>' + v.price +
                                    '</span></p></li><li></li></ul>'

                            })
                            html += '</div><div class="statusAndControl" ><div class="nameTypeTable" ><div class="module"><p>' +
                                v.address.consignee + '</p></div></div><div class="totalTypeTable" ><div class="module"><p>￥<span>' +
                                v.all_price +
                                '</span></p><p>(含运费￥<sapn>10</sapn>)</p><p>在线支付</p></div></div><div class="statusTypeTable" style="height: 170px;"><div class="module"><p>'+data.data.order.status+'</p></div></div><div class="controlTable" style="height: 170px;"><div class="module"><span class="span payment">立即支付</span><span class="span OrderDetails">订单详情</span><span class="span CancellationOrder">取消订单</span><span class="span Repurchase">再次购买</span></div></div></div>'
                            html += '</li>'
                            $('.payment .OrderListDetail .clear').before(html);

                        });
                    }
                })
            })

            //猜你喜欢
            var like = ""
            $.each(data.data.like, function(k, v) {
                var likeurl = './jswz.html?id='
                like +=
                    '<li><a href=' + likeurl + '' + v.id + ' target="_blank">' + v.title + '</a></li>'
            });
            $('.mAinR ul').html(like);

        },
        error: function() {
            console.log("错误！！！")

        }
    });

});
function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"
    ];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}
var flag = IsPC(); //true为PC端，false为手机端
if (flag == true) {

}
if (flag == false) {
    document.write('<script src="/static/js/personal/personal.js" type="text/javascript" charset="utf-8"></script>');
    $(".mo_dropmenu .mo_dropmenu_title").click(function() {
        $(this).toggleClass("current").siblings('.mo_dropmenu_title').removeClass("current"); //切换图标
        //$(this).next("mo_dropmenu_drop").show();
        $(this).next(".mo_dropmenu_drop").slideToggle(500).siblings(".mo_dropmenu_drop").slideUp(500);
    });
}
