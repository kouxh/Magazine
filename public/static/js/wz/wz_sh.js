login = $('#login').html();
//文章收藏
$('.sc').click(function(){
    var  article=$('.sectionc').attr("id");
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
    }else{
        $.ajax({
            type: "POST",
            url: '/joinCollectionApi',
            data:{
                id:article,
                type:1
            },
            success: function (data) {
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
                            layer.msg('您已经收藏过了！', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function() {
                            });
                        })
                    })
                }
            },
            error: function () {
                console.log("错了");
            }
        })


    }


})