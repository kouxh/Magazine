$(function () {
    // var price = localStorage.getItem()
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) return unescape(arr[2]);
        else return null;
    }

    var price = getCookie("price");
    
    $.ajax({
        type: "GET",
        url: '/cartApi',
        success: function (data) {
            console.log(data)
            var dd = data.data.normal;
            // console.log(dd);
            //normal
            var html = "";
            var vs=data.data.normal;

                $.each(data.data.normal, function (k, v) {
                // console.log(v)
                if (v.type == 1) {
                    v.type = "电子版"
                } else if (v.type == 2) {
                    v.type = "平装"
                }
                html += '<tr  pid=' + v.p_id + ' mid=' + v.m_id +
                    ' id="' + v.id + '" class="active tr' + v.id +
                    ' "><td class="check" id="id' + v.id +
                    '"><label><input type="checkbox"  /></label></td></th><td class="sp"><a style="cursor:'+ ((v.type==0) ?  'default' : '')  + '" href=" ' + ((v.type==0) ?  'javascript:void(0)' : '/zz/' + v.m_id + '') + ' "><dl><dt><img src="'+v.m_img+'" alt=""></dt><dd><h3>' +
                    v.title + '</h3><button style="display:'+ ((v.type==0) ?  'none' : 'block')  + '" class="type">' + v.type +
                    '</button></dd></dl></a></td><td  class="price">' +
                    v.flat +
                    '</td><td><p class="_Number"><span class="button  sub">-</span><input type="text" class="num centent_number" value="' +
                    v.num +
                    '" class="centent_number"><span  class="button  add">+</span></td><td clsss="subtotal" id="subtotal">' +v.notes + '</td><td  class="del" id="del"><span  class="delete">删除</span><span class="Collection">收藏</span></td></tr>';

                }
            )

                    $('#biuuu_city_list4').html(html);            operation();


            // arr.push(html);
// 全选
                $("#checkAll input").click(function () {
                    var flag = $(this).prop("checked");
                    // console.log("dd")
                    // console.log($('.check').attr('id'));

                    if (flag) {
                        $(".check label input").prop("checked", true);

                    } else {
                        $(".check label input").prop("checked", false);
                    }
                    counts();
                    totalPrice();
                });
//单选
                $(".check input").click(function () {
                    var flag = $(this).prop("checked"); //获取当前input的状态
                    var CL = $(".check input").length; //列表长度；
                    var CH = $(".check input:checked").length; //列表中被选中的长度
                    // var i = 0;
                    //多选但是删除其中一条
                    $('.check input:checked').each(function () {
                        $(".del .delete").click(function () {
                            var id = $(this).parents().parents('tr.active').attr('id');
                            $(this).parents("tr").remove();
                            $.ajax({
                                type: "GET",
                                url: '/delCartApi',
                                data: {
                                    id: id
                                },
                                success: function (data) {
                                    if (data.bol == true) {
                                        layui.use('layer', function () {
                                            layui.use('layer', function () {
                                                layer.msg('删除成功', {
                                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                                }, function () {
                                                });
                                            })
                                        })
                                    }
                                },
                                error: function () {
                                    console.log("错了");
                                }
                            })
                        })

                    })
                    counts();
                    totalPrice();
                })
                //单行删除
                $(".del .delete").click(function () {
                    var flag = $(this).parent().siblings().find("input").prop("checked");
                    if (flag == false) {
                        var id = $(this).parents().parents('tr.active').attr('id');
                        $(this).parents("tr").remove();
                        $.ajax({
                            type: "GET",
                            url: 'delCartApi',
                            data: {
                                id: id
                            },
                            success: function (data) {
                                if (data.bol == true) {
                                    layui.use('layer', function () {
                                        layui.use('layer', function () {
                                            layer.msg('删除成功', {
                                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                            }, function () {
                                            });
                                        })
                                    })
                                }
                            },
                            error: function () {
                                console.log("错我");
                            }
                        })
                    }
                    // $(this).parents("tr").remove();
                    // $(this).parents.delete("id")
                    var CL = $(".check input").length; //列表长度；
                    counts();
                    totalPrice();
                })

                // 清空购物车
                $('.qkgwc').click(function () {
                    var movePos = [];
//                         $('#biuuu_city_list4 tr').each(function () {
// $(this).attr("id")
//                             console.log($(this).attr("id"));
//                         })
                    $('.check input:checked').each(function () {
                        var id = $(this).parents().parents('tr.active').attr('id');
                        // console.log(id)
                        movePos.push(id);
                        var arr = movePos.join(",");
                        $(this).parents("tr").remove();
                        // console.log(arr);
                        url = '/delCartApi?id=' + arr + '';
                        // console.log(url);
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function (data) {
                                if (data.bol == true) {
                                    layui.use('layer', function () {
                                        layui.use('layer', function () {
                                            layer.msg('删除成功', {
                                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                            }, function () {
                                            });
                                        })
                                    })
                                }


                            },
                            error: function () {
                                console.log("错我");
                            }
                        })
                    })
                })
                //数目加
                $(".add").click(function () {
                    var num = $(this).prev().val();
                    // console.log(num)
                    var price = parseFloat($(this).parent().parent().siblings(".price").text());
                    num++;
                    $(this).prev().val(num);
                    //      小计
                    $(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2));
                    // $(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2));
                    console.log($(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2)));
                    counts();
                    totalPrice();
                })

                //数目减
                $(".sub").click(function () {
                    var num = $(this).next().val();
                    // console.log(num)
                    var price = parseFloat($(this).parent().parent().siblings(".price").text());
                    num--;
                    if (num <= 1) {
                        num = 1
                    }
                    $(this).next().val(num);
                    //      小计
                    $(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2))
                    // $(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2));
                    console.log($(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2)));
                    counts();
                    totalPrice();
                })
                //文本框脱里焦点处理
                $('.num').each(function (i) {
                    $(this).blur(function () {
                        console.log($(this))
                        let p = parseFloat($(this).parent().parent().siblings(".price").text());
                        let c = parseFloat(this.value);
                        // console.log()
                        // console.log(p * c);
                        //
                        // console.log(p);
                        // console.log(c)
                        $(this).parents('tr').find("#subtotal").text((c * p).toFixed(2));
                        counts();
                        totalPrice();
                    })
                })
                // 总价格
                totalPrice()

                function totalPrice() {
                    var prices = 0;
                    $('.check input:checked').each(function (i) {
                        prices += parseFloat($(this).parents("tr").find('#subtotal').text());
                    })
                    $('#total').text(prices);
                }

                //总数目
                counts();

                function counts() {
                    var sum = 0;
                    $('.check input:checked').each(function (i) {
                        sum += parseInt($(this).length);
                        var num = parseInt($(this).parents("tr").find('.num').val());
                        var id = $(this).parents().parents('tr.active').attr('id');
                        $('#numAll').text(sum);
                    })
                }


        }
    })


// })


    $('.Settlement').click(function() {
        // alert("立即支付")
        var   total=$('#total').text();
        // console.log(total)
        var order = [];
        $('.check input:checked').each(function() {
            var sum = parseInt($(this).parents("tr").find('.num').val()); //数量
            var type = $(this).parents().parents("tr").find('.type').text() //类型
            var id = $(this).parents().parents('tr.active').attr('id');
            var m_id = $(this).parents().parents('tr.active').attr('mid');
            var p_id = $(this).parents().parents('tr.active').attr('pid');
            var cover_img=$('#'+id).find('img').attr('src');//图片路径
            var title=$('#'+id).find('h3').text();//标题
            var price=$('#'+id).find('.price').text();//单价
            var subtotal=$('#'+id).find('#subtotal').text();//小计
            if (type == "平装") {
                type = 2
            } else {
                console.log("电子")
            }
            if (m_id == "null") { //选中pid
                var obj = {
                    "pid": parseFloat(p_id), //
                    "id": parseFloat(id),
                    "num": sum,
                    "type": type,
                    "dvfq": 1,
                    "cover_img":cover_img,
                    "title":title,
                    "price":price,
                    "subtotal":subtotal,
                    "total":total,
                    "zxlb":1

                }

            } else {
                var obj = {
                    "mid": parseFloat(m_id),
                    "id": parseFloat(id),
                    "num": sum,
                    "type": type,
                    "dvfq": 1,
                    "cover_img":cover_img,
                    "title":title,
                    "price":price,
                    "subtotal":subtotal,
                    "total":total,
                    "zxlb":1
                }
            }
            order.push(obj)
        })


       // var  value=1;
       //  var name=value;

        // function setCookie(name, value) {//一个小时
        //     var exp = new Date();
        //     // console.log(name)
        //     console.log(value)
        //     exp.setTime(exp.getTime() + 60 * 60 * 1000);
        //     document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/";
        //     console.log(name)
        // }



// console.log(setcookie('data',test1))
//         function getCookie(name) {
//             var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
//             if (arr = document.cookie.match(reg)) return unescape(arr[2]);
//             else return null;
//         }
//
//         console.log(getCookie('data',str));
        if(total==0){
            layer.msg('您还没有选择宝贝哦');
        }else
        {
            function setcookie(name,value,daysToLive){
                // var cookie = name + '=' + encodeURIComponent(value);
                var cookie = name + '=' + decodeURI(value);
                // decodeURI
                if(typeof daysToLive == 'number'){
                    cookie += ';max-age='+(daysToLive*60*60*1000);
                }
                document.cookie = cookie;
            }
            var str=JSON.stringify(order)
            setcookie('data',str)
             location.href = '/orderpay';
        }

        //
        // function allCookie(){//读取所有保存的cookie字符串
        //     var str = document.cookie;
        //     if (str == "") {
        //         str = "没有保存任何cookie";
        //     }
        //     alert(str);
        // }
        // getCookie(name)
        // test1=escape(order)
        // console.log(getCookie(name))
        // location.href = '/orderpay?'+test1+'';
        // console.log(getCookie(username))
        // $.ajax({
        //     type: "POST",
        //     url: 'careorder',
        //     data: {
        //         json: JSON.stringify(json)
        //     },
        //     success: function(data) {
        //         console.log(data)
        //         location.href = '/orderpay';
        //     },
        //     error: function() {
        //         console.log("错的");
        //     }
        // })
    })






})


//固定立即结算
$(window).scroll(function() {
	//获取滚动条的滑动距离
    var winHeight = window.innerHeight;
    var scroH = $(window).scrollTop();
	// console.log(scroH + "scroH");
	var navH = $("#footer").offset().top-winHeight;
	// console.log(navH)
    //滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
  if(scroH < navH) {
	    console.log("固定")
		$(".Settlement_D").css({
            "position": "fixed",
            "bottom": "0px",
              "top:":" auto"

		});
	}
  else if (scroH > navH) {
      // console.log("不固定")
      $(".Settlement_D").css({
          "position": "absolute",
          "bottom": "0px",
      });
  }

})
function operation() {
    $("#biuuu_city_list4 tr").each(function () {
       var p_id=$(this).attr('pid');
       var id=$(this).attr('id')
        console.log(p_id.length)
        if(p_id.length!==4){
// $(this).find('dl dt').html();
console.log($('#'+id+' .sp img').attr('src',"/static/img/zzdd6.png"))
        }else{
            console.log("c")
        }
    })
}





