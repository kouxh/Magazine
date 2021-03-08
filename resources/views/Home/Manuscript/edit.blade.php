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
            <input type="hidden" name="man_id" value="{{$data -> man_id}}">
            <input type="hidden" name="uid" value="{{$data -> uid}}">
            <label for="username" class="layui-form-label">
                稿件编号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="year" name="man_number" required="" value="{{$data -> man_number}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                稿件标题
            </label>
            <div class="layui-input-inline" style="width: 400px;">
                <input type="text" id="name" name="man_title" value="{{$data -> man_title}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                稿件栏目
            </label>
            <div class="layui-input-inline">
                <input type="text" id="title" name="man_column" required="" value="{{$data -> man_column}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                稿件作者
            </label>
            <div class="layui-input-inline">
                <input type="text" id="subtitle" name="man_author"  value="{{$data -> man_author}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                联系方式
            </label>
            <div class="layui-input-inline">
                <input type="text" id="electronics" name="man_tell" value = "{{$data -> man_tell}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                邮箱地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="flat" name="man_email" value = "{{$data -> man_email}}" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label class="layui-form-label">是否采纳</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                    <input type="radio" name="man_adopt"  value="1" title="是" >
                    <input type="radio" name="man_adopt"  value="3" title="否" checked>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">反馈内容</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" style="width: 65%" name="sponsor_desc">{{ $data -> sponsor_desc }}</textarea>
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
                url:'/home/manuscript/DoEdit',
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