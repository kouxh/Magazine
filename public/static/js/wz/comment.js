//评论
//文章评论
// var ID = $('.sectionc').attr("id");//获取当前文章id
// console.log(ID)
$(function() {
    var pl_id =$('.sectionc').attr('id');

    $.ajax({
        type: "GET",
        url: "/commentListApi?type=1&id="+ pl_id +"",
        success: function (data) {
            // console.log()
            //初始化
            $('.total_num').html(data.data.data.length);
            $('.name').html(data.data.data[0].account);
            console.log(data)
            $.each(data.data.data, function (k, v) {
                console.log(v.account)
                var index = $('.comment-item').length + 1;
                var html = "";
                html +='<li class="comment-item" id='+index+'>\n' +
                    '                            <div class="comment-info">\n' +
                    '                                <a class="avatar" href="/user/4185838" target="_blank" title="hizYDP">\n' +
                    '                                    <img src="https://images.tmtpost.com/uploads/avatar/89406bcb124bc802a240d5513b1737f4_1573016615.jpeg?imageMogr2/strip/interlace/1/quality/85/thumbnail/40x40&amp;ext=.jpeg" alt="hizYDP" width="40" height="40">\n' +
                    '                                </a>\n' +
                    '                                <span class="user"><a class="name" href="/user/4185838" target="_blank" title="">'+v.account+'</a></span>\n' +
                    '                               \n' +
                    '                            </div>\n' +
                    '                            <p class="comment-cont">'+v.com_comment+'</p>\n' +
                    '                            <p class="comment-crea_at">'+v.com_crea_at+'</p>\n' +

                    '                        </li>'

                $(".comment-list").prepend(html);

            })
        }
    })

    console.log(pl_id)
    if ($('#login').html() !== null) {//登录
        //登录后评论
        $('.form-part').show();
        $('.login-tip').hide();//提示登录隐藏

        $("#btn").on("click", function () {
            var i = 0;
            var comment = $(".comment-form .border-box").val();//获取评论内容
            console.log(comment);
            if (comment  == "") {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('请输入评论内容', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                    })
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "/commentInsertApi",
                    data: {
                        type:1,//type (必传 1、文章 2、杂志 3 、课堂)
                        aid: pl_id ,
                        comment: comment,

                    },
                    success: function (data) {
                         console.log(data.data.MSG)
                        //评论
                        if(data.bol==true){
                        layui.use('layer', function () {
                            layui.use('layer', function () {
                                layer.msg(data.data.MSG, {
                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                });
                            })
                        })
                        }
                        // if (data.err_code) {//评论成功
                        //     var index = $('.comment-item').length + 1;
                        //     var html = "";
                        //     html +='<li class="comment-item" id='+index+'>\n' +
                        //         '                            <div class="comment-info">\n' +
                        //         '                                <a class="avatar" href="/user/4185838" target="_blank" title="hizYDP">\n' +
                        //         '                                    <img src="https://images.tmtpost.com/uploads/avatar/89406bcb124bc802a240d5513b1737f4_1573016615.jpeg?imageMogr2/strip/interlace/1/quality/85/thumbnail/40x40&amp;ext=.jpeg" alt="hizYDP" width="40" height="40">\n' +
                        //         '                                </a>\n' +
                        //         '                                <span class="user"><a class="name" href="/user/4185838" target="_blank" title="hizYDP">hizYDP</a></span>\n' +
                        //         '                               \n' +
                        //         '                            </div>\n' +
                        //         '                            <p class="comment-cont">'+comment+'</p>\n' +
                        //         '                            <p class="comment-cont">'+comment+'</p>\n' +
                        //
                        //         '                        </li>'
                        //
                        //     $(".comment-list").prepend(html);
                        // }
                    }
                })

            }



        })

    } else {
        console.log("没有等旅")
    }
//
    console.log("D")

})

//




