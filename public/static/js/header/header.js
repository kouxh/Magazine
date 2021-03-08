login = $('#login').html();
$('.Shopping_bag').click(function () {
    console.log("dd")
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
        location.href = '/mycart';
    }

})

