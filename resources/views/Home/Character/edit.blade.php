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

        <div>
            <input type="hidden" name="id" value="{{ $data -> id }}">
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">选择添加</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                @if($data -> join_character == 1)
                    <input type="radio" name ="join_character"  lay-filter="erweima" value="1" title="嘉宾" checked>
                    <input type="radio" name ="join_character"  lay-filter="erweima" value="2" title="人物">
                @else
                    <input type="radio" name ="join_character"  lay-filter="erweima" value="1" title="嘉宾" >
                    <input type="radio" name ="join_character"  lay-filter="erweima" value="2" title="人物" checked>
                @endif
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*   嘉宾展示在活动板块，人物展示在人物板块</span>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                姓名
            </label>
            <div class="layui-input-inline" style="width: 300px;">
                <input type="text" id="name" name="name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> name }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                职务
            </label>
            <div class="layui-input-inline" style="width: 300px;">
                <input type="text" id="post" name="post" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> post }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                头像
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="photo"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="photo" id="img" value="{{ $data -> photo }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 尺寸：412 * 324</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">金句</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" style="width: 65%" name="golden">{{ $data -> golden }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                视频
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="video"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="banner_video" id="banner_video" value="{{ $data -> banner_video }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 尺寸大小：412 * 324</span>
            </div>
        </div>

        <div class="layui-form-item all character" >
            <label class="layui-form-label">研究领域</label>
            <div class="layui-input-block">

                @foreach($zy as $v)
                    <input type="checkbox" name="research" lay-skin="primary" value="{{ $v -> id }}" title="{{ $v -> title }}">
                @endforeach

            </div>
        </div>

        <div class="layui-form-item all character">
            <label for="content" class="layui-form-label">
                经历
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="experience" name="experience" style="display: none;"  lay-verify="experience" >{{ $data -> experience }}</textarea>
            </div>
        </div>

        <div class="layui-form-item all character">
            <label for="content" class="layui-form-label">
                介绍
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="introduce" name="introduce" style="display: none;"  lay-verify="introduce" >{{ $data -> introduce }}</textarea>
            </div>
        </div>

        <div class="layui-form-item all character">
            <label for="content" class="layui-form-label">
                学术成就
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="achievement" name="achievement" style="display: none;"  lay-verify="achievement" >{{ $data -> achievement }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                课程图片
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="curriculum_img"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="curriculum_img" id="curriculum_img1" value="{{ $data -> curriculum_img }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 尺寸：371 * 231</span>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                课程跳转路径
            </label>
            <div class="layui-input-inline" style="width: 300px;">
                <input type="text" id="curriculum_url" name="curriculum_url" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> curriculum_url }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item all character">
            <label class="layui-form-label">是否加入推荐</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                @if($data -> is_relevant == 1)
                    <input type="radio" name ="is_relevant"  lay-filter="" value="1" title="是" checked>
                    <input type="radio" name ="is_relevant"  lay-filter="" value="2" title="否">
                @else
                    <input type="radio" name ="is_relevant"  lay-filter="" value="1" title="是" >
                    <input type="radio" name ="is_relevant"  lay-filter="" value="2" title="否" checked>
                @endif
            </div>
        </div>


        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label"></label>
            <button  type="button" class="layui-btn" lay-filter="add" lay-submit="">修改</button>
        </div>
    </form>
</div>

<script>
    index = '';
    layui.use(['form','layer','layedit','laydate'], function(){
        var $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;


        //给CheckBox赋值
        $(document).ready(function () {

            var unitType = [];
            unitType = "{{ $data -> research }}" .split(",");
            for (var j = 0; j < unitType.length; j++) {
                var unitTypeCheckbox = $("input:checkbox[name='research']");
                for (var i = 0; i < unitTypeCheckbox.length; i++) {
                    if (unitTypeCheckbox[i].value == unitType[j]) {
                        unitTypeCheckbox[i].checked = true;
                    }
                }
            }
            form.render();
        });


        //建立编辑器
        indexs = layedit.build('experience' ,{
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

        //建立编辑器
        indexs1 = layedit.build('introduce' ,{
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

        //建立编辑器
        indexs2 = layedit.build('achievement' ,{
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
            experience: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,experience: function(value){
                layedit.sync(indexs);
            }
        });

        //自定义验证规则
        form.verify({
            introduce: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,introduce: function(value){
                layedit.sync(indexs1);
            }
        });

        //自定义验证规则
        form.verify({
            achievement: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,achievement: function(value){
                layedit.sync(indexs2);
            }
        });




        //监听提交
        form.on('submit(add)', function(data){

            //获取checkbox[name='research']的值 多选框的值
            var arr = new Array();
            $("input:checkbox[name='research']:checked").each(function(i){
                arr[i] = $(this).val();
            });
            data.field.research = arr.join(",");//将数组合并成字符串
            console.log(data.field.research);
            //return false;

            $.ajax({
                url:'/home/character/DoEdit',
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
    //普通文件上传
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#photo'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){

                if(res.code == 0){

                    $('#img').val(res.data.src)
                    $('#photo').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#photo').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")

                }
            }
        });

    })
</script>

<script>
    //视频上传
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#video' //绑定元素
            ,url: '/laravelUploadImg' //上传接口
            ,accept: 'file' //视频
            ,method: 'post'
            ,done: function(res){

                if(res.code == 0){

                    $('#banner_video').val(res.data.src)
                    $('#banner_video').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#banner_video').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")

                }
            }
        });

    })
</script>
<script>
    //普通文件上传
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#curriculum_img' //绑定元素
            ,url: '/laravelUploadImg' //上传接口
            ,accept: 'file' //视频
            ,method: 'post'
            ,done: function(res){

                if(res.code == 0){

                    $('#curriculum_img1').val(res.data.src)
                    $('#curriculum_img1').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#curriculum_img1').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
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
