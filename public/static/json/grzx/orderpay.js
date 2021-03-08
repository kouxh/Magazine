// 核实订单
var level=1;
$(function () {
    $(".pay_icon").hide();
    var url = location.search;
    var dh = '';
    var urlArr = document.referrer.split('/');
    var urlTZ = urlArr[3];
    var type = "";//订单类型
    var bid = '';


    function setCookie(name, value) {
        var exp = new Date();
        exp.setTime(exp.getTime() + 120 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();

    }

    // //读取cookies
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) return unescape(arr[2]);
        else return null;
    }

    var address = $('#address').attr('class');
    if (address == "") {
        $('#Edit_address').hide();
        $('#Edit_address1').hide();
        $('.remembertwo').append('<p><a href="/harvestaddress" id="xjdz">新建地址</a></p>')
    }
//预售
    if (url == '?1') {

        var datas = getCookie("data");
        orderlist = JSON.parse(datas);
        console.log(datas)
        for (var i in orderlist) {
            type = orderlist[i].type;
            var htmls = '<tr class="zxlb" id="zxlb" type="' + orderlist[i].type + '"   ><td class="Hd"><dl><dt><img src="' + orderlist[i].cover_img + '" alt=""></dt><dd><h3>' + orderlist[i].title + '</h3></dd></dl></td><td>' + orderlist[i].price + '</td><td><p>' + orderlist[i].num + '</p></td><td>1</td><td align="center">' + orderlist[i].price + '</td></tr>'
            $('.table  .clear').before(htmls);

            $('.Settlement_DR .total').text('¥' + orderlist[i].price);

            bid = orderlist[i].bid;
        }
    } else {
        // var paymentData=getCookie("paymentData")
        var datas = getCookie("data");
        var invoice = getCookie("invoice");
        invoice = JSON.parse(invoice);
        orderlist = JSON.parse(datas);
        var invoice_id = '';
        for (var i in invoice) {
            // console.log(invoice[i].type)
            //个人发票
            if (invoice[i].type == 1) {
                console.log("个人发票")
                invoice_id = invoice[i].id;
                $('.Invoice_information').html('个人发票')

            } else if (invoice[i].type == 2) {
                console.log("纳税人")

                invoice_id = invoice[i].id;
                $('.Invoice_information').html('<div>工作单位：' + invoice[i].in_company_name + ' 纳税人识别码：' + invoice[i].in_taxpayer_code + '</div>')
            }

        }
        html = "";
        var json = [];
        for (var i in orderlist) {
            var k = orderlist[i];
            type = k.type;
            html += '<tr id="' + k.mid + '" class="zxlb" type="' + k.zxlb + '"><td class="Hd" mid="' + k.mid + '" id="' + k.id + '" pid="' + k.pid + '"><dl><dt><img src="' + k.cover_img + '" alt=""></dt><dd><h3>' + k.title +
                '</h3><p class="type" style="display:' + ((type == 0) ? 'none' : 'block') + '">平装</p></dd></dl></td><td>' + k.price +
                '</td><td><p>' + k.num + '</p></td><td>1</td><td align="center">' + k.subtotal + '</td></tr>'
            if (k.mid == null) {
                var obj = {
                    "pid": parseFloat(k.pid), //
                    "id": parseFloat(k.id),
                    "num": parseFloat(k.num),
                    "type": type,

                }
            } else {
                var obj = {
                    "mid": parseFloat(k.mid), //
                    "id": parseFloat(k.id),
                    "num": parseFloat(k.num),
                    "type": type,

                }
            }
            json.push(obj)

        }
        $('.table  .clear').before(html);
        $('.jians').text(orderlist.length);
        $('.Settlement_DR .total').text('¥' + orderlist[0].total);

    }
    var remaining=$('.remaining').html();//余额
    var odermoney =orderlist[0].total;//订单钱数
    if(parseInt(remaining)<parseFloat(odermoney)){
        $('#isdisabled').attr("disabled", true);
        $('#isdisabled').attr("checked", false);
        $('#ischecked').attr("checked", true);
        level=2;
        $(".pay_icon").show();
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
    $('.Settlement').click(function () {
        var address = $('#address').attr('class');
        type = $('.zxlb').attr('type')//订单类型
        if (address == "") {
            // if (data.bol == true) {
            layui.use('layer', function () { //独立版的layer无需执行这一句
                layer.open({
                    type: 1,
                    title: ['', 'background: #000;text-align: center; color:#fff'],
                    maxmin: true,
                    skin: 'demo-class',
                    shadeClose: true, //点击遮罩关闭层
                    area: ['440px', '320px'],
                    content: '<div style="top: 50%;\n' +
                        '    position: relative;\n' +
                        '    transform: translateY(-50%);">您还没有收货地址赶快设置一个吧！</div>',
                    btn: ['确定', '取消'],
                    // success: function (layero, index) {
                    // }
                    yes: function () {
                        location.href = '/harvestaddress';

                    }
                })
            })

            // }
        } else {
            var remarksMsg = $('#remarksMsg').val();
            var addID = $('#address').attr("class");
            if (type == 1) {
                data = {
                    type: type,//类型 type 订单分类（必传：1 杂志 2 文章 3 预售 4 VIP）
                    json: JSON.stringify(json),
                    remarksMsg: remarksMsg,//备注
                    addID: addID,//收货地址id
                    invoice: invoice_id//发票id}
                }
            } else if (type == 3) {
                data = {
                    type: type,//类型 type 订单分类（必传：1 杂志 2 文章 3 预售 4 VIP）
                    bid: bid,
                    remarksMsg: remarksMsg,//备注
                    addID: addID,//收货地址id
                    invoice: invoice_id//发票id}
                }
            }
            // }

            $.ajax({
                type: "POST",
                url: "/newCreaOrderApi",
                data: data,
                success: function (data) {
                    if (data.bol == true) {
                        Odd_Numbers = data.data;
                        function setcookie(name, value, daysToLive) {
                            var cookie = name + '=' + decodeURI(value);
                            // decodeURI
                            if (typeof daysToLive == 'number') {
                                cookie += ';max-age=' + (daysToLive * 60 * 60 * 24);
                            }
                            document.cookie = cookie;
                        }
                        setcookie('Odd_Numbers', Odd_Numbers);
                        if(level==1){
                            $.ajax({
                                type: "POST",
                                url: '/pay',
                                data: {
                                    ordernum:Odd_Numbers,
                                    payMode: level
                                },
                                success: function (data) {
                                    if(data.bol==true){
                                        layui.use('layer', function () {
                                            layui.use('layer', function () {
                                                layer.msg("付款成功", {
                                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                                }, function () {
                                                    location.href = '/order';
                                                });
                                            })
                                        })
                                    }else{
                                        layui.use('layer', function () {
                                            layer.msg('付款失败', {
                                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                            }, function () {

                                            });
                                        })
                                    }
                                }
                            })
                        }else if(level==2){
                            location.href = '/pay?ordernum=' + Odd_Numbers + '&payMode=' + level + '';
                        }

                    }

                }
            })
        }


    })
})

function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"];
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
    // document.write('<script type="text/javascript" src="/ynhy/huodong/js/gg.js"></script>');
    // document.write('<script type="text/javascript" src="/ynhy/huodong/js/activitySynthesize.js"></script>');
}
if (flag == false) {
    console.log('didsf')
    // $('.section_D').before('<div class="remembertwo dz"><p><span>收货信息:<i id="address" class="127"><span>黄瓜</span><span>河北省</span><span>石家庄</span><span>长安区</span><span>黄瓜</span><span>18610156447</span></i></span></p>\n' +
    //     '                        \n' +
    //     '                            \n' +
    //     '                        <p id="Edit_address">编辑地址</p>\n' +
    //     '                    </div>')

}
;


