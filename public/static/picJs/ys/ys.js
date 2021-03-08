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
    login = $('#login').html();
    $('#ys').click(function () {
        console.log("ys")
        if (login == undefined) {
            layui.use('layer', function() {
                layui.use('layer', function() {
                    layer.msg('登录后将显示您之前加入的商品', {
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function() {
                        location.href = '/loadLogin';

                    });
                })
            })
        }
        else{
            console.log("ddd")
            // location.href = '/orderpay';
            var json=[];
            var obj = {
                type:3,//1 杂志 2 文章 3 预售 4 VIP
                title:"《财务共享的智能化升级》预售",
                cover_img:'/upload/2020/03/29/15854584672788.jpg',
                price:"68.90",
                num:"1",
                subtotal:"1",
                bid:"1"
            }
        json.push(obj)
            var  data=JSON.stringify(json);
            console.log(data)
            setcookie('data',data)
            location.href = '/orderpay?1';
            // $.ajax({
            //     type: "GET",
            //     url: "/createBookOrderApi?bid=1",
            //     success: function (data) {
            //         var dh=data.data.order_num
            //         console.log(dh);
            //         location.href = '/orderpay?id=1';
            //     }
            // })
        }
    })
