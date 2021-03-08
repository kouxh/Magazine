<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理会记研究</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../../layui/css/font.css">
    <link rel="stylesheet" href="../../layui/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../layui/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="../../layui/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <input type="hidden" name="m_id" value="{{$data -> m_id}}">
            <label for="username" class="layui-form-label">
                年份
            </label>
            <div class="layui-input-inline">
                <input type="text" id="year" name="year" required="" value="{{$data -> year}}" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                类别
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" value="{{$data -> name}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="title" name="title" required="" value="{{$data -> title}}" lay-verify="required"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                副标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="subtitle" name="subtitle"  value="{{$data -> subtitle}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                电子版
            </label>
            <div class="layui-input-inline">
                <input type="text" id="electronics" name="electronics" value = "{{$data -> electronics}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                平装
            </label>
            <div class="layui-input-inline">
                <input type="text" id="flat" name="flat" value = "{{$data -> flat}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                库存
            </label>
            <div class="layui-input-inline">
                <input type="text" id="num" name="num"  required="" value="{{$data -> num}}" lay-verify="required"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                优惠折扣(折)
            </label>
            <div class="layui-input-inline">
                <input type="text" id="fold" name="fold" placeholder="如：5 ,没有请不填" required="" lay-verify=""
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                优惠时间(月)
            </label>
            <div class="layui-input-inline">
                <input type="text" id="fold" name="discount" placeholder="如：5 ,没有请不填" required="" lay-verify=""
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" style="width: 65%" name="message">{{$data -> message}}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                图片1
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="test1"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="cover_img" id="img1" value="{{$data -> cover_img}}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                图片2
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="test2"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="side_img" id="img2" value="{{$data -> side_img}}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                图片3
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="test3"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="other_img" id="img3" value="{{$data -> other_img}}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                文本内容
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="text" name="text" style="display: none;"  lay-verify="text" >{{ $data -> text }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label"></label>
            <button  type="button" class="layui-btn" lay-filter="add" lay-submit="">修改</button>
        </div>
    </form>
</div>

<script>

    // var indexs;
     var indess2;
    layui.use(['form','layer','layedit'], function(){
        var $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer,
            layedit = layui.layedit;

            //插入图片
            layedit.set({
                uploadImage: {
                    url: '/uploadImg' //接口url
                    ,type: 'post' //默认post
                }
            });

            //建立编辑器
            indexs2 = layedit.build('text' ,{
                height: 260 //设置编辑器高度
                ,tool:[
                    'strong' //加粗
                    ,'italic' //斜体
                    ,'underline' //下划线
                    ,'del' //删除线
                    ,'|' //分割线
                    ,'left' //左对齐
                    ,'center' //居中对齐
                    ,'right' //右对齐
                    ,'|' //分割线
                    ,'link' //超链接
                    ,'unlink' //清除链接
                    ,'image' //插入图片
                ]
            });
        //
        //     //建立编辑器
        //     indexs2 = layedit.build('charge_content' ,{
        //         height: 260 //设置编辑器高度
        //         ,tool:[
        //             'strong' //加粗
        //             ,'italic' //斜体
        //             ,'underline' //下划线
        //             ,'del' //删除线
        //             ,'|' //分割线
        //             ,'left' //左对齐
        //             ,'center' //居中对齐
        //             ,'right' //右对齐
        //             ,'|' //分割线
        //             ,'link' //超链接
        //             ,'unlink' //清除链接
        //             ,'image' //插入图片
        //         ]
        //     });

        // //自定义验证规则
        // form.verify({
        //     free_content: function(value){
        //         //console.log(value.length);
        //         if(value.length < 5){
        //             return '内容至少得5个字符啊';
        //         }
        //     }
        //     ,free_content: function(value){
        //         layedit.sync(indexs);
        //     }
        // });
        //
        //自定义验证规则
        form.verify({
            text: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,text: function(value){
                layedit.sync(indexs2);
            }
        });

        //监听提交
        form.on('submit(add)', function(data){
            // console.log(data);
            // return false;
            $.ajax({
                url:'/home/magazine/DoEdit',
                type: 'post',
                dataType:'json',
                data:{data:data.field},
                success:function(res){

                    if(res.err_code === 10000){
                        layer.alert('修改成功' , function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                    }else{
                        layer.alert('修改失败' , function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                    }
                }
            })
        });
    });

</script>

<script>
    //普通文件上传1
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#test1'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $('#img1').val(res.data.src)
                    $('#test1').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#test1').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")

                }
            }
        });

    })

    //普通文件上传2
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#test2'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $('#img2').val(res.data.src)
                    $('#test2').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#test2').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")

                }
            }
        });
    })
    //普通文件上传3
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#test3'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $('#img3').val(res.data.src)
                    $('#test3').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#test3').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")
                }
            }
        });
    })
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>