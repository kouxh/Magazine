$(function () {
    var man_filepath = '';
    layui.use('upload', function () {
        var $ = layui.jquery,
            upload = layui.upload;
        var uploadInst = upload.render({
            elem: '#test3',
            url: '/laravelUploadImg',
            accept: 'file', //普通文件
            exts: 'pdf|docx|doc',
            //默认post
            before: function (obj) {
                //预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                });
            },
            done: function (res) {
                //如果上传失败
                console.log(res)
                if (res.code > 0) {
                    // return layer.msg('上传失败');
                    $('._ts').text("上传失败");
                } else {
                    man_filepath = res.data.src;
                    console.log(man_filepath);
                    // return layer.msg('上传成功');
                    $('._ts').text("上传成功");
                    ///upload/2020/04/01/15857295112414.pdf

                }
            },
            error: function () {
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html(
                    '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function () {
                    uploadInst.upload();
                });
            }
        });
    })
    layui.use(['form', 'layedit', 'laydate'], function (data) {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        //监听提交
        form.verify({
            man_title: function (value) {
                console.log(value);
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    console.log(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value))
                    return '稿件标题不能有特殊字符';
                }
                else if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '稿件标题首尾不能出现下划线\'_\'';
                }
                else if(/^\d+\d+\d$/.test(value)){
                    console.log(!/^\d+\d+\d$/.test(value));
                    return '稿件标题不能全为数';
                }
                else if (value.length > 25) {
                    return '稿件标题不能大于25位';
                }
            },
            //作者
            man_author: function (values) {
                console.log(values)
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(values)) {
                    return '作者不能有特殊字符';
                }
                else if (/(^\_)|(\__)|(\_+$)/.test(values)) {
                    return '作者首尾不能出现下划线\'_\'';
                }
                else if(/^\d+\d+\d$/.test(values)){
                    return '作者不能全为数字';
                }
                else if (values.length > 25) {
                    return '作者不能大于25位';
                }

            },
            man_work: function (value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '工作单位地址不能有特殊字符';
                }
                else if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '工作单位地址首尾不能出现下划线\'_\'';
                }
                else if(/^\d+\d+\d$/.test(value)){
                    console.log(value)
                    return '工作单位地址不能全为数字';
                }
                else if (value.length > 25) {
                    return '工作单位地址不能大于25位';
                }

            }

        });
        form.on('submit(demo1)', function () {
            var man_title = $('#man_title').val();
            var man_column = $('#man_column').val();
            var man_author = $('#man_author').val();
            var man_tell = $('#man_tell').val();
            var man_email = $('#man_email').val();
            var man_work = $('#man_work').val();
            var man_post = $('#man_post').val();
            var json = [];
            var data = {
                "man_title": man_title,//稿件标题
                "man_column": man_column,//稿件栏目
                "man_author": man_author,//稿件作者
                "man_tell": man_tell,//联系方式
                "man_email": man_email, //邮箱地址
                "man_work": man_work,// 工作单位
                "man_post": man_post,
                "man_filepath": man_filepath,
            }
            json.push(data);
            if(man_filepath== ""){
                layui.use('layer', function() {
                    layer.msg('请上传附件', {
                        // skin: 'demo-class',
                        icon: 5,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    }, function() {

                    });
                })
                return false;
            }else{
                $.ajax({
                    type: "POST",
                    url: "/subManuscriptApi",
                    data: {
                        data: JSON.stringify(data)
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.bol == true) {
                            // layer.msg('投稿成功');
                            layer.msg(data.msg, function(){
                                //do something
                                // location.href = '/shgj';
                            });

                        }

                    },
                    error: function () {
                        console.log("错误！！！")

                    }
                });
            }

            return false;

        });
        // var datas= {"man_title ": man_title, "man_title": man_title,//稿件标题
        //     "man_column": man_column,//稿件栏目
        //     "man_autho": man_autho,//稿件作者
        //     "man_tell": man_tell,//联系方式
        //     "man_email": man_email, //邮箱地址
        //     "man_work": man_work,// 工作单位
        //     "man_post": man_post,
        //     "man_filepath": man_filepath,
        // }
        // upload.render({
        //     elem: '#test3'
        //     ,url: 'https://httpbin.org/post' //改成您自己的上传接口
        //     ,accept: 'file' //普通文件
        //     ,done: function(res){
        //         layer.msg('上传成功');
        //         console.log(res);
        //     }
        // });
        //表单初始赋值
    });
    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
    });
    $(".tab_ment li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
    });

})