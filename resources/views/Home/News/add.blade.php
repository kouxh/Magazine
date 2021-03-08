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
            <label for="username" class="layui-form-label">
                标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="title" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                作者
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="author" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                搜索引擎
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="keyboard" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item" id="1">
            <label for="username" class="layui-form-label" >
                分类
            </label>
            <div class="layui-input-inline" id="type">
                <select lay-filter="demo" name="class_id" id="class_id">
                    <option value="1">业界新闻</option>
                    <option value="2">活动新闻</option>
                </select>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
            <div style="display: none" id = 'activity'>
                <label for="username" class="layui-form-label" >
                    活动
                </label>
                <div class="layui-input-inline">
                    <select name="av_id" >
                        @foreach($news as $v)
                            <option value="{{ $v -> id }}">{{ $v -> title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
        </div>

        <div class="layui-form-item moment" style="display: none">
            <label class="layui-form-label">加入精彩瞬间</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="join_moment"  lay-filter="erweima" value="1" title="是">
                <input type="radio" name="join_moment"  lay-filter="erweima" value="2" title="否">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                图片
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="test3"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="img" id="img">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                相关人物
            </label>
            <div class="layui-input-inline">
                <input type="text" id="related_figures" name="related_figures" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" style="width: 65%" name="message"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                内容
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="content" name="content" style="display: none;"  lay-verify="content" ></textarea>
            </div>
        </div>



        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label"></label>
            <button  type="button" class="layui-btn" lay-filter="add" lay-submit="">增加</button>
        </div>
    </form>
</div>



<script>

    var indexs;
    layui.use(['form','layer','layedit'], function(){
        var $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer,
            layedit = layui.layedit;

        form.on('select(demo)', function(data){
            if(data.value == 2){
                $('.moment').show();
            }else{
                $('.moment').hide();
            }
        });


        $("#class_id").change(function () {
            alert($("#class_id").val());
        })

        //插入图片
        layedit.set({
            uploadImage: {
                url: '/uploadImg' //接口url
                ,type: 'post' //默认post
            }
        });

        //建立编辑器
        indexs = layedit.build('content' ,{
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

        //自定义验证规则
        form.verify({
            content: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,content: function(value){
                layedit.sync(indexs);
            }
        });

        //监听提交
        form.on('submit(add)', function(data){
             // console.log(data);
            // return false;
            $.ajax({
                url:'/home/news/DoAdd',
                type: 'post',
                dataType:'json',
                data:{data:data.field},
                success:function(res){

                    if(res.err_code === 10000){
                        layer.alert('增加成功' , function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                    }else{
                        layer.alert('增加失败' , function(){
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
    //普通文件上传
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

                    $('#img').val(res.data.src)
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