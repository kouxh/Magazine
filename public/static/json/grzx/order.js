//我的订单lhy
//我的订单lhy
var type_id = 1;
var ID = '';
var url = 'newListOrderApi?type=' + type_id + '';
var level = 1;
$(function () {
    var keyword = 100;
    var keyword = 100;
    var options = ""
    $(".pay_icon").hide();
    selects();
    // type();
    //订单类型切换
    $(".type li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index() + 1;

        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".type_ment>div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
        type_id = $(this).attr('id');
        // console.log(type_id);
        url = 'newListOrderApi?type=' + type_id + '';
        // console.log(ID)
        if (ID != "") {
            url = 'newListOrderApi?type=' + type_id + '&status=' + keyword + '';
        }
        // type()
        selects();
    });
    //订单切换
    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index() + 1;
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
        ID = $(this).attr('id');
        keyword = ID;
        if (keyword == 100) {
            url = 'newListOrderApi?type=' + type_id + '';
        } else {
            url = 'newListOrderApi?type=' + type_id + '&status=' + keyword + '';
        }

        selects();
    });
    $(".MyOrderMainListTitle li select").change(function () {
        // var options = $(".MyOrderMainListTitle option:selected").val();
        selects();
    })
    $('.MyOrderMainListTitle select').show()


})

function selects() {
    var options = '';
    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            // console.log(data)
            if (data.data == "") {
                //   判断是否有数据
                $('.MyOrderMainListTitle').hide()
                $('.Order').html('<p class="NO_sj my_order">您还没有相关的订单</p>');
                $('#pagge').hide();
            } else {
                $('#pagge').show();
                $.each(data.data, function (k, v) {
                    layui.use(['laypage', 'layer'], function () {
                        var laypage = layui.laypage,
                            layer = layui.layer;
                        //调用分页
                        laypage.render({
                            elem: 'pagge',
                            limit: 6,
                            count: data.data.length,
                            layout: ['prev', 'page', 'next', 'skip', 'count'],
                            theme: '#d82a39',
                            jump: function (obj) {
                                //模拟渲染
                                document.getElementById('biuuu_city_list').innerHTML = function () {
                                    var arr = [],
                                        thisData = data.data.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                    layui.each(thisData, function (index, item) {
                                        var html = "";
                                        var cc = '';
                                        html += '<ul class="OrderListDetail" id="' + item.order_num + '" _class="' + item._class + '">\n' +
                                            '                                <li>\n' +
                                            '                                    <div class="status">\n' +
                                            '                                        <div class="orderTitle">\n' +
                                            '                                            <p>订单号 :</p>\n' +
                                            '                                            <p>' + item.order_num + '</p>\n' +
                                            '                                            <p>' + item.crea_at + '</p>\n' +
                                            '                                        </div>\n';
                                        if (type_id == "1" && item.desc != undefined) {
                                            if (item.addID[0] == null) {
                                                cc = '';
                                            } else {
                                                cc = item.addID[0].consignee;
                                            }

                                            $.each(item.desc, function (k, t) {
                                                if (t.m_id == null) {
                                                    //全年，或者半年
                                                    html += '<ul class="oneShoppingList">\n' +
                                                        '                                                <li >\n' +
                                                        '                                                    <a  href="javascript:void(0);" style="border: none;cursor: default;"><dl><dt><img src="' + t.p_img + '" alt=""></dt><dd>\n' +
                                                        '                                                    <div class="m_id" style="display: none">' + t.m_id + '</div>\n' +
                                                        '                                                    <div class="p_id" style="display: none">' + t.p_id + '</div>\n' +
                                                        '                                                    <div class="type_num" style="display: none">' + t.type + '</div>\n' +
                                                        '                                                    <div class="productName">' + t.p_title + '</div>\n' +
                                                        '                                                    <div class="productMain">起订日期</div>\n' +
                                                        '                                                    <div class="productTip" id=' + item._class + '>规格: 平装</div>\n' +
                                                        '                                                    <div class="yd_sl" id=' + item._class + '>' + t.num + '</div></dd></dl></a>\n' +

                                                        '                                                </li>\n' +
                                                        '                                                <li>\n' +
                                                        '                                                    <p class="num">' + t.num + '</p>\n' +
                                                        '                                                </li>\n' +
                                                        '                                                <li>\n' +
                                                        '                                                    <p>¥<span>' + t.price + '</span></p>\n' +
                                                        '                                                </li>\n' +
                                                        '                                                <li></li>\n' +
                                                        '                                            </ul>\n'
                                                } else {
                                                    //单期杂志
                                                    html += '<ul class="oneShoppingList">\n' +
                                                        '                                                <li>\n' +
                                                        '                                                    <a href="/zz/' + t.m_id + '" style="border: none"><dl><dt><img src="' + t.m_img + '" alt=""></dt><dd>\n' +
                                                        '                                                    <div class="productName">' + t.m_title + '</div>\n' +
                                                        '                                                    <div class="m_id" style="display: none">' + t.m_id + '</div>\n' +
                                                        '                                                    <div class="p_id" style="display: none">' + t.p_id + '</div>\n' +
                                                        '                                                    <div class="type_num" style="display: none">' + t.type + '</div>\n' +
                                                        '                                                    <div class="productMain">起订日期</div>\n' +
                                                        '                                                    <div class="productTip" id=' + item._class + '>规格: 平装</div>\n' +
                                                        '                                                    <div class="yd_sl" id=' + item._class + '>' + t.num + '</div></dd></dl></a>\n' +
                                                        '                                                </li>\n' +
                                                        '                                                <li>\n' +
                                                        '                                                    <p class="num">' + t.num + '</p>\n' +
                                                        '                                                </li>\n' +
                                                        '                                                <li>\n' +
                                                        '                                                    <p>¥<span>' + t.price + '</span></p>\n' +
                                                        '                                                </li>\n' +
                                                        '                                                <li></li>\n' +
                                                        '                                            </ul>\n'
                                                }
                                            })
                                        }
                                        if (type_id == "2" && item.desc != undefined) {//文章没有收获地址
                                            cc = ""
                                            $.each(item.desc, function (k, t) {
                                                html += '<ul class="oneShoppingList">\n' +
                                                    '                                                <li>\n' +
                                                    '                                                    <a href="' + t.url + '" style="border: none"><dl><dt></dt><dd>\n' +
                                                    '                                                    <div class="productName">' + t.title + '</div>\n' +
                                                    '                                                    </dd></dl></a>\n' +
                                                    '                                                </li>\n' +
                                                    '                                                <li>\n' +
                                                    '                                                    <p>' + item.all_num + '</p>\n'
                                                '                                                </li>\n' +
                                                '                                                <li>\n' +
                                                '                                                    <p>¥<span>' + item.all_price + '</span></p>\n' +
                                                '                                                </li>\n' +
                                                '                                                <li></li>\n' +
                                                '                                            </ul>\n'
                                            })
                                        }
                                        if (type_id == "3") {
                                            //预售
                                            $.each(item.desc, function (k, t) {
                                                html += '<ul class="oneShoppingList">\n' +
                                                    '                                                <li>\n' +
                                                    '                                                    <a href="javascript:void(0);" style="border: none;cursor: default;"><dl><dt><img src="' + t.img + '" alt=""></dt><dd>\n' +
                                                    '                                                    <div class="productName">' + t.title + '</div>\n' +
                                                    '                                                    <div class="productMain">起订日期</div>\n' +
                                                    '                                                    <div class="productTip" id=' + item._class + '>规格: 平装</div>\n' +
                                                    '                                                    <div class="yd_sl" id=' + item._class + '>' + t.num + '</div></dd></dl></a>\n' +

                                                    '                                                </li>\n' +
                                                    '                                                <li>\n' +
                                                    '                                                    <p>' + t.num + '</p>\n' +
                                                    '                                                </li>\n' +
                                                    '                                                <li>\n' +
                                                    '                                                    <p>¥<span>' + t.price + '</span></p>\n' +
                                                    '                                                </li>\n' +
                                                    '                                                <li></li>\n' +
                                                    '                                            </ul>\n'
                                            })
                                        }
                                        html += '   </div><div class="statusAndControl" style="height: 170px;">\n' +
                                            '                                        <div class="nameTypeTable" style="height: 170px;">\n' +
                                            '                                            <div class="module ">\n' +
                                            '                                                <p class="' + item.add_id + '">' + cc + '</p>\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>\n' +
                                            '                                        <div class="totalTypeTable" style="height: 170px;">\n' +
                                            '                                            <div class="module">\n' +
                                            '                                                <p>￥<span class="allprice">' + item.all_price + '</span></p>\n' +
                                            '                                               <p>在线支付</p>\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>\n' +
                                            '                                        <div class="statusTypeTable" style="height: 170px;">\n' +
                                            '                                            <div class="module "><p style="display:' + ((type_id == "2" && item.status == "待发货") ? 'none' : 'block') + '">' + item.status + '</p></div>\n' +
                                            '                                        </div>\n' +
                                            ' <div class="controlTable" style="height: 170px;">\n' +
                                            '<div class="module">\n' +
                                            '</div>\n' +
                                            '</div>\n' +
                                            '</div>\n' +
                                            '</li>\n';
                                        html += '</ul>';

                                        arr.push(html);


                                    });

                                    return arr.join('');
                                }();
                                operation();
                            }
                        });
                    });

                })
            }

        }


    })
}

function Repurchase() {
    location.href = '/gdzz';
}

//确认收货
function confirmFn(id) {
    var OrderListDetail_id = $(id).parents('.OrderListDetail').attr('id');
    $.ajax({
        type: "GET",
        url: 'confirmGoodsApi?order_num=' + OrderListDetail_id + '',
        success: function (data) {
            if (data.bol == true) {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg("确认收货成功", {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                        });
                    })
                })
            } else {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg(data.msg, {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                        });
                    })
                })
            }
        }
    })
}


//订单详情
function OrderDetails(id) {
    var OrderListDetail_id = $(id).parents('.OrderListDetail').attr('id');
    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;
        // 订单
        var layer = layui.layer;
        layer.open({
            type: 1,
            title: ['订单详情', 'background: #000;text-align: center; color:#fff'],
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area: ['800px', '530px'],
            content: $('#Order_details'),
            btn: ['保存', '取消'],
            success: function (layero, index) {
                var url = 'orderDescApi?orderNum=' + OrderListDetail_id + '';
                src = '<div class="Order_details_main">\n' +
                    '        <div class="Order_details_main-left"><h4 class="field">订单信息:</h4>';
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {
                        if (data.bol = true) {
                            src += `
                                    <div class="info-box">
                                        <div class="top">订单编号: ${data.data.order_num}</div>
                                        <div class="top">商品信息：${data.data.describe[0].p_title == null ? data.data.describe[0].m_year + data.data.describe[0].m_title : data.data.describe[0].p_title} ￥${data.data.all_price}</div>
                                        <div class="top">收货信息：${data.data.area}${data.data.city}${data.data.county}${data.data.desc_address} ${data.data.consignee} ${data.data.tell}</div>
                                        <div class="top">客服电话: ${data.data.customer_tell}</div>
                                    </div>`
                                // <div class="top" >付款时间：${data.data.pay_at=="1970-01-01 00:00:00"? "": data.data.pay_at}</div>
                            if (data.data.express == '0' || data.data.logistics_code == '0') {
                                src += `
                                    
                                    <div class="express-box">
                                        <h4>物流信息:</h4>
                                        <div class="top">${data.data.msg}</div>
                                    </div>`
                            } else {
                                src += `
                                   <div class="express-box">
                                        <h4>物流信息:<span class="top">送货方式:${data.data.typename}</span> <span class="top">货运单号:${data.data.number}</span></h4>
                                    </div><ul class="layui-timeline" >`
                                $.each(data.data.list, function (k, v) {
                                    src += '<li class="layui-timeline-item">\n' +
                                        '            <i class="layui-icon layui-timeline-axis"></i>\n' +
                                        '            <div class="layui-timeline-content layui-text">\n' +
                                        '                <h3 class="layui-timeline-title">' + v.time + '</h3>\n' +
                                        '                <p>' + v.status + '</p>\n' +
                                        '            </div>\n' +
                                        '        </li>'

                                })
                                src += '</ul></div>';
                            }

                        }
                        $('#Order_details').html(src);

                    }
                })
                $('#Order_details').html(src);


            },
            yes: function (index, layero) {
                layer.close(index); //再执行关闭
            }
        })
    });

}

//取消订单
function CancellationOrder(id) {
    // var OrderListDetail_id = $("#" + id).parents('.OrderListDetail').attr('id');
    var OrderListDetail_id = $(id).parents('.OrderListDetail').attr('id');
    $.ajax({
        type: "GET",
        url: '/cancelOrder?orderNum=' + OrderListDetail_id + '',
        success: function (data) {
            // console.log(data)
            if (data.bol == true) {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('取消订单成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {

                        });
                    })
                })
                $('#' + OrderListDetail_id).remove();
                selects();//列表数据
            } else {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg(data.msg, {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                        });
                    })
                })
            }
            // console.log(data)
        }
    })

}

function operation() {
    $(".OrderListDetail").each(function () {
        var idd = $(this).attr("id");
        var statusHtml = $("#" + idd + " .statusTypeTable  .module").text();
        // 判断是文章订单还是杂志订单
        var _class = $("#" + idd).attr("_class");
        //如果是文章订单隐藏
        if (_class == 2) {
            // $("#" + idd ).hide()
        }
        //判断是杂志订单还是书籍订单
        //根据规格id ==4为书籍订单
        var productTipHtml = $("#" + idd + " .productTip").attr("id");
        if ($("#" + idd + " .statusTypeTable  .module").text() == "待支付") {
            var src = "";
            if (type_id == 2) {
                src += "<span class=\"span payment\"  id=\'payment\'  onclick=\'payment(this)\'>立即支付</span>\n" +
                    " <span class=\"span CancellationOrder\" id=\'CancellationOrder\' onclick=\'CancellationOrder(this)\'>取消订单</span>\n" +
                    "<span class=\"span Repurchase\" onclick=\"Repurchase()\">再次购买</span>";
                $("#" + idd + " .controlTable  .module").html(src);
            } else {
                src += "<span class=\"span payment\"  id=\'payment\'  onclick=\'payment(this)\'>立即支付</span>\n" +
                    " <span class=\"span OrderDetails\"  id=\'OrderDetailsÅ\' onclick=\'OrderDetails(this)\'>订单详情</span>\n" +
                    " <span class=\"span CancellationOrder\" id=\'CancellationOrder\' onclick=\'CancellationOrder(this)\'>取消订单</span>\n" +
                    "<span class=\"span Repurchase\" onclick=\"Repurchase()\">再次购买</span>";
                $("#" + idd + " .controlTable  .module").html(src);
            }

        } else if ($("#" + idd + " .statusTypeTable  .module").text() == "待发货") {
            var src2 = "";
            if (type_id == 2) {
                src2 += "<span class=\"span Paid\">购买成功</span>\n" +
                    "<span class=\"span Repurchase\" onclick=\"Repurchase()\">再次购买</span>";
                $("#" + idd + " .controlTable  .module").html(src2);
            } else {
                src2 += "<span class=\"span Paid\">已支付</span>\n" +
                    " <span class=\"span OrderDetails\" id=\'OrderDetailsÅ\' onclick=\'OrderDetails(this)\'>订单详情</span>\n" +
                    "<span class=\"span remind_goods\">提醒发货</span>\n" +
                    "<span class=\"span Repurchase\" onclick=\"Repurchase()\">再次购买</span>";
                $("#" + idd + " .controlTable  .module").html(src2);
            }
        } else if ($("#" + idd + " .statusTypeTable  .module").text() == "待评价") {
            var src3 = "";
            src3 += "<span class=\"span Confirm_receipt\">确认收货</span>\n" +
                " <span class=\"span OrderDetails\" id=\'OrderDetailsÅ\' onclick=\'OrderDetails(this)\'>订单详情</span>\n" +
                "<span class=\"span remind_goods\">提醒发货</span>\n" +
                "<span class=\"span Repurchase\" onclick=\"Repurchase()\">再次购买</span>";
            $("#" + idd + " .controlTable  .module").html(src3);
        } else if ($("#" + idd + " .statusTypeTable  .module").text() == "待收货") {
            var src4 = "";
            src4 += "<span class=\"span Deliver_goods\">已发货</span>\n" +
                " <span class=\"span OrderDetails\" id=\'OrderDetailsÅ\' onclick=\'OrderDetails(this)\'>订单详情</span>\n" +
                "<span class=\"span Repurchase\" onclick=\"Repurchase()\">再次购买</span>\n" +
                "<span class=\"span Repurchase\" onclick=\"confirmFn(this)\">确认收货</span>";
            $("#" + idd + " .controlTable  .module").html(src4);

        } else if ($("#" + idd + " .statusTypeTable  .module").text() == "已过期") {
            var src5 = "";
            // src4 += "<span class=\"span Confirm_receipt\">代收货</span>"
            src5 += "<span class=\"span CancellationOrder\" id=\'CancellationOrder\' onclick=\'CancellationOrder(this)\'>取消订单</span>\n";
            $("#" + idd + " .controlTable  .module").html(src5);

        }

    });
}

// //读取cookies
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) return unescape(arr[2]);
    else return null;
}

//删除cookies
function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

//存cookie
function setcookie(name, value, daysToLive) {
    var cookie = name + '=' + decodeURI(value);
    if (typeof daysToLive == 'number') {
        cookie += ';max-age=' + (daysToLive * 60 * 60 * 24);
    }
    document.cookie = cookie;
}


// 支付方式

layui.use(['form'], function () {
    var form = layui.form;
    form.render();
    //此处即为 radio 的监听事件
    form.on('radio(levelM)', function (data) {
        level = data.value;//被点击的radio的value值
        if (level == 2) {
            $(".pay_icon").show();
            $('.remaining').hide();
        } else {
            $('.remaining').show();
            $(".pay_icon").hide();
        }

    });
});

//立即支付
function payment(id) {
    var order_num = $(id).parents('.OrderListDetail').attr('id');//单号
    var subtotal = $("#" + order_num + "").find('.module  p .allprice').html();//单价/
    var odermoney = subtotal;//订单钱数
    var remaining = $('.remaining').html();//余额
    var Odd_Numbers = '';
    Odd_Numbers = order_num;

    if (type_id == 1) {
        var order = [];
        var title = $("#" + order_num + "").find('.productName');
        var num = $("#" + order_num + "").find('.oneShoppingList li .num');//购买，书名
        var price = $("#" + order_num + "").find('.oneShoppingList li p span');//单价
        var subtotal = $("#" + order_num + "").find('.module  p .allprice').html();//单价
        var cover_img = $("#" + order_num + "").find('.oneShoppingList  img');//图片路径
        var m_id = $("#" + order_num + "").find('.m_id');
        var p_id = $("#" + order_num + "").find('.p_id');
        var type = $("#" + order_num + "").find('.type_num');
        // var obj = {"order_num": order_num, "title": title, "num": num, "price": price, "subtotal": subtotal,"cover_img":cover_img,};
        for (var i = 0; i < title.length; i++) {
            if (m_id[i].innerText == "null") { //选中pid
                var obj = {
                    "pid": p_id[i].innerText,
                    "num": num[i].innerText,
                    "type": type[i].innerText,
                    "dvfq": 1,
                    "cover_img": cover_img[i].src,
                    "title": title[i].innerText,
                    "price": price[i].innerText,
                    "subtotal": price[i].innerText,
                    "total": subtotal,
                    "zxlb": 1

                }
            } else {
                var obj = {
                    "mid": m_id[i].innerText,
                    "num": num[i].innerText,
                    "type": type[i].innerText,
                    "dvfq": 1,
                    "cover_img": cover_img[i].src,
                    "title": title[i].innerText,
                    "price": price[i].innerText,
                    "subtotal": price[i].innerText,
                    "total": subtotal,
                    "zxlb": 1
                }
            }
            order.push(obj)
        }
        var str = JSON.stringify(order)
        setcookie('data', str);
        location.href = '/orderpay';
    } else {
        if (parseInt(remaining) < parseFloat(odermoney)) {
            $('#isdisabled').attr("disabled", true);
            $('#isdisabled').next().addClass('layui-radio-disbaled layui-disabled');
            level = 2;
            $('#ischecked').attr("checked", true);
            $(".pay_icon").show();
        }
        $.ajax({
            type: "GET",
            url: '/ImmediatePaymentApi?orderNum=' + Odd_Numbers + '',
            success: function (data) {
                if (data.bol == true) {
                    Odd_Numbers = data.data.orderNum;
                    console.log(data.data.orderNum)
                    setcookie('Odd_Numbers', Odd_Numbers);
                    layui.use(['form', 'layer'], function (layero, index) {  //支付方式
                        var layer = layui.layer;
                        var form = layui.form;
                        layer.open({
                            type: 1,
                            title: ['请选择支付方式', 'background: #000;text-align: center; color:#fff'],
                            maxmin: true,
                            area: ['400px', '300px'],
                            content: $('#selectType'),
                            btn: ['确认支付'],
                            success: function (layero, index) {
                            },
                            yes: function () {
                                if (level == 1) {
                                    $.ajax({
                                        type: "POST",
                                        url: '/pay',
                                        data: {
                                            ordernum: Odd_Numbers,
                                            payMode: level
                                        },
                                        success: function (data) {
                                            if (data.bol == true) {
                                                layui.use('layer', function () {
                                                    layui.use('layer', function () {
                                                        layer.msg("付款成功", {
                                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                                        }, function () {
                                                            if (type_id == 2) {
                                                                location.href = '/myarticle';
                                                            } else {
                                                                location.href = '/order';
                                                            }
                                                        });
                                                    })
                                                })
                                            } else {
                                                layui.use('layer', function () {
                                                    layer.msg('付款失败', {
                                                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                                    }, function () {

                                                    });
                                                })
                                            }
                                        }
                                    })
                                } else if (level == 2) {
                                    if (type_id == 2) {
                                        setcookie('typeId', "2");
                                    }
                                    location.href = '/pay?ordernum=' + Odd_Numbers + '&payMode=' + level + '';
                                }

                            },
                        });
                        form.render()
                    });
                } else {
                    layui.use('layer', function () {
                        layui.use('layer', function () {
                            layer.msg('单号错误', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function () {
                                // location.href = '/';
                            });
                        })
                    })
                }
            }
        })
    }

}


