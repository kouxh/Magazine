//杂志购买lhy
var data="";
immediatelylogin = $('#login').html();
ID = $('#id').val();
num = $('.Stock_text').html();


$(function () {

    isChecked = getCookie("isChecked");
    if(isChecked=="true"){
        setcookie('isChecked',false)
        window.location.reload();

    }
    $(".xz a").addClass('Selection');//是否选择平装
    
})
data = getCookie("data");
//取cookie
function getCookie(name, value) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) return unescape(arr[2]);
    else return null;
}
//存cookie
function setcookie(name, value, seconds) {
    seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。
    var expires = "";
    if (seconds != 0 ) {      //设置cookie生存时间
        var date = new Date();
        date.setTime(date.getTime()+(seconds*1000));
        expires = "; expires="+date.toGMTString();
    }
    document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值
}
//删除cookies
function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}



//天猫入口
// $('#Tmall').click(function() {
//     // $(this).attr('href', "path");
//     if (ID == 17) {
//         //第8期
//       var   path =
//             'https://detail.tmall.com/item.htm?spm=a1z10.3-b-s.w4011-18935038862.15.15104d34AsEBqQ&id=604443275228&rn=49c1757c26d95387d301810a8e4482d4&abbucket=2';
//         $(this).attr('href', path);
//     } else if (ID == 15){
//         var  path5 =
//             'https://detail.tmall.com/item.htm?spm=a1z10.3-b-s.w4011-18935038862.18.15104d34AsEBqQ&id=599698549206&rn=49c1757c26d95387d301810a8e4482d4&abbucket=2';
//         $(this).attr('href', path5);
//     }else{
//     //     //其他
//     //     // alert('')
//         layui.use('layer', function() {
//             layui.use('layer', function() {
//                 layer.msg('淘宝售罄，建议在微店购买', {
//                     time: 2000 //2秒关闭（如果不配置，默认是3秒）
//                 });
//             })
//         })
//     //
//     }
// })
// 购买页面
console.log(num,'num')
if (num == 0) {
    $('.purchase').attr("disabled", true);
    $('.button').attr("disabled", true);
    $('.purchase').css({
        "background": "#eaeaea",
        "color": "#000"
    })
    $("#join").css({
        "border": "none"
    })
}
// 选择版本
$('.details_guig .xz a').click(function() {
    $('._Number button').removeAttr('disabled','disabled');
    $(".Magazine_collection").css("pointer-events", "auto");
    $('#join').attr("disabled", false);
    $("#join").removeAttr("style","");
    // $(this).addClass("Selection").siblings().removeClass("Selection");
    // var Selectioncen = $('.Selection').text();
    var seleCen = $('.Selection .lb').text();
    if($(this).is('.Selection')){
        //选中后取消
        $(this).removeClass("Selection")
    }else{
        //没有选中添加选中
        $(this).addClass('Selection');
        $('.SubscribeMoreP input').attr('checked',false);
    }
})

//
// 选择期刊 半年 或者全年
// $(".SubscribeMoreP input:checkbox").click(function() {
//     //设置当前选中checkbox的状态为checked
//     // $(this).attr("checked", true);
// 	$(this).prop('checked', true);
// 	$(this).siblings().attr("checked", false); //设置当前选中的checkbox同级(兄弟级)其他checkbox状态为未选中
//     var json = [];
//     console.log($(this).prop('checked', true))
//     $('.SubscribeMoreP input:checked').each(function() {
//         var xzid = $(this).attr('id'); //选中id
//         // console.log(xzid)
//         json.push(xzid)
// 		console.log(json)
//     })
//
// });
function checkedThis(obj){
    $('.details_guig .xz a').removeClass("Selection");
    var json = [];
    var boxArray = document.getElementsByName('test');
    $('._Number button').attr('disabled','disabled');
    $('#join').attr("disabled", true);
    $('.join').css({
        "background": "#eaeaea",
        "color": "#000",
        "border": "none",
        "cursor": "default"
    })
    $(".Magazine_collection").css("pointer-events", "none");
    for(var i=0;i<=boxArray.length-1;i++){
        if(boxArray[i]==obj && obj.checked){
            boxArray[i].checked = true;
            var xzid = $(this).attr('id'); //选中id
            $('.centent_number').val("1")
        }else{
            boxArray[i].checked = false;
        }
    }
}

$(".plus").click(function() { //购物车+
     centent_number = $('.centent_number').val();
    var vb = parseInt(centent_number) + 1;
    if (vb > num) {
        vb = num
        $(".centent_number").val(vb);
        $('.details_Number .kuc').show();
    } else {
        $('.details_Number .kuc').hide();
        $(".centent_number").val(vb);
    }
    $(".centent_number").val(vb);
})
$(".reduce").click(function() { //购物车-
    centent_number = $('.centent_number').val();
    $('.details_Number .kuc').hide();
    var vb = parseInt(centent_number) - 1;
    $(".centent_number").val(vb);
    if (vb < 1) {
        vb = 1
        $(".centent_number").val(vb);
    }
})
// 监听回车
$(".centent_number").keypress(function() {
    var centent_number = $('.centent_number').val();
    if (centent_number > num) {
        $('.details_Number .kuc').show();
    } else if (centent_number <= 0) {
        $('.details_Number .kuc').hide();
        $('.centent_number').val(centent_number)
    }
});
// 立即订阅
$('.immediately').click(function() {
     var zzlx= $('.xz a').attr("class");//是否选择
    var p_id = $('.SubscribeMoreP input:checked').attr('id'); //选中pid
    // 判断是否登陆
    if (login == undefined) {
        layui.use('layer', function() {
            layui.use('layer', function() {
                layer.msg('登陆后可购买', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function() {
                    location.href = '/loadLogin';

                });
            })
        })
    }
    else if(p_id==undefined && zzlx==""){//什么都没有选
        layui.use('layer', function() {
            layui.use('layer', function() {
                layer.msg('您还没有选择要购买的内容哦', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function() {

                });
            })
        })
    }

    else {
        var num = $(".centent_number").val(); // 数量
        var seleCen = $('.Selection .lb').text(); //最后的数量 type 类型 2为平装
        if (seleCen == "平装") {
            seleCen = 2;
        }
        var json = [];
        var flag = $('.SubscribeMoreP input:checked').prop("checked"); //是否选中3期或者6期
        var title=$('.section_detailsL_xp h1').text();//
        var cover_img=$('#default img').attr('src');
        var price=$('.Selection span i').text()
        var subtotal=price*num;
        var subtotal2="";
        var cover_img2='';//期刊路径
        $('.SubscribeMoreP input:checked').each(function() {
            var qd_id=$(this).attr('id')//选中id
            var xzid = $(this).val();
            title2=$(this).attr('title');
            price2=$(this).val();
            subtotal2=price2*num;
            // console.log(qd_id)

            if(qd_id==1){
                //	半年
                cover_img2='/static/img/zzdd3.png'
            }else if(qd_id==2){
                cover_img2='/static/img/zzdd6.png'
            }
        })
        var total2=subtotal2+subtotal;
        // console.log(total)
        if (flag == true) {
            var obj = {
                //定半年
                "pid": parseFloat(p_id), //
                "id": parseFloat(p_id), //
                "num": parseFloat(num),
                "type": seleCen,
                "dvfq": 1,
                "cover_img":cover_img2,
                "title":title2,
                "price":price2,
                "subtotal":subtotal2,
                "total":total2,
                "zxlb":1,
            }
        } else { //没有选中 mid
            var obj = {
                "mid": parseFloat(ID), //
                "id": parseFloat(ID), //
                "num": parseFloat(num),
                "type": seleCen,
                "title":title,
                "dvfq": 1,
                "cover_img":cover_img,
                "price":price,
                "subtotal":subtotal,
                "total":subtotal,
                "zxlb":1,//
            //判断是否是杂志
            }
        }
        json.push(obj)
        var  data=JSON.stringify(json);
        console.log(data)
        setcookie('data',data)
        setcookie('isChecked',true)
        location.href = '/orderpay';
        // location.href = '/orderpay';
        // $.ajax({
        // 	type: "POST",
        // 	url: '/careorder',
        // 	data: {
        // 		json: JSON.stringify(json)
        // 	},
        // 	success: function(data) {
        // 		console.log(data);
        // 		 location.href = '/orderpay';
        // 	},
        // 	error: function() {
        // 		console.log("错的");
        // 	}
        // })
    }
})
// 加入购物车
$('.join').click(function() {
    var zzxz= $('.xz a').attr("class");//是否选择
    var p_id = $('.SubscribeMoreP input:checked').attr('id'); //选中pid
    console.log(p_id)
    if (login == undefined) {
        layui.use('layer', function() {
            layui.use('layer', function() {
                layer.msg('登陆后可购买', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function() {
                    location.href = '/loadLogin';

                });
            })
        })
    }
    else if(p_id==undefined && zzxz==""){//什么都没有选
        layui.use('layer', function() {
            layui.use('layer', function() {
                layer.msg('您还没有选择要加入购物车的内容哦', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function() {

                });
            })
        })
    }
    else {
        var num = $(".centent_number").val();
        //最后的数量
        var seleCen = $('.Selection .lb').text();
        if (seleCen == "平装") {
            seleCen = 2;
        }
        var json = [];
        $('.SubscribeMoreP input:checked').each(function() {
            var xzid = $(this).attr('id'); //选中id
            json.push(xzid)
        })
        var xuanZId = json.join(",");
        var cartData={
            "num": num,
            'type': seleCen,
        };
        if(xuanZId!=''){
            cartData['p_id']=xuanZId
        }else if(ID!=''){
            cartData['m_id']=ID
        }
        console.log(cartData,'000000222')
        $.ajax({
            type: "POST",
            url: "/addcart",
            data:{json:JSON.stringify(cartData)},
            success: function(data) {
                var result = JSON.stringify(data);
                if (data.bol == true) {
                    // location.href = './cart.html';
                    layui.use('layer', function() {
                        layui.use('layer', function() {
                            layer.msg('加入购物车成功', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function() {
                                // location.href = '/';
                            });
                        })
                    })
                }
            },
            error: function() {
                console.log("错误！！！")

            }
        })
    }
})
//收藏
$('.Magazine_collection').click(function(){
    var Magazine_collection_ID=$('#Magazine input').val();
    if (login == undefined) {
        layui.use('layer', function() {
            layui.use('layer', function() {
                layer.msg('游客无法收藏  请登录或注册', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function() {
                    location.href = '/loadLogin';

                });
            })
        })
    }
    else{
        $.ajax({
            type: "POST",
            url: "/joinCollectionApi",
            data: {
                type: 2,
                id: Magazine_collection_ID
            },
            success: function (data) {
                // console.log(data)
                if(data.bol==true){
                    layui.use('layer', function() {
                        layui.use('layer', function() {
                            layer.msg('收藏成功', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function() {
                            });
                        })
                    })
                }else{
                    layui.use('layer', function() {
                        layui.use('layer', function() {
                            layer.msg('您已经收藏过了', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function() {
                            });
                        })
                    })
                }
            }
        })
    }
})