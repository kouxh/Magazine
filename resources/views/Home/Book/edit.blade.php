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
            <input type="hidden" name="id" value="{{ $data -> id}}">
        </div>

        <div class="layui-form-item" style="width: 400px;">
            <label for="username" class="layui-form-label">
                书籍名称
            </label>
            <div class="layui-input-inline" style="width: 260px;">
                <input type="text" id="book_name" name="book_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> book_name}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                书籍图片
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="book_img"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="text" name="book_img" id="book_img" value="{{ $data -> book_img}}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">书籍简介</label>
            <div class="layui-input-block">
                <textarea name="book_message" lay-verify=""  class="layui-textarea" style="width: 65%" >{{ $data -> book_message }}</textarea>
            </div>
        </div>

        <div class="layui-form-item" style="width: 80%">
            <label class="layui-form-label">书籍内容</label>
            <div class="layui-input-block">
                <textarea id="book_content" style="width: 65%"  name="book_content" lay-verify="book_content"  class="layui-textarea">{{ $data -> book_content }}</textarea>
            </div>
        </div>

        <div class="layui-form-item" style="width: 400px;">
            <label for="username" class="layui-form-label">
                书籍作者
            </label>
            <div class="layui-input-inline" style="width: 260px;">
                <input type="text" id="book_name" name="book_author" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> book_author }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <div style=" " id = 'activity'>
                <label for="username" class="layui-form-label" >
                    专业维度
                </label>
                <div class="layui-input-inline">
                    <select name="book_zy" >
                        <option value="0">请选择</option>
                        @foreach($zy as $v)
                            @if($data -> book_zy == $v -> id)
                                <option value="{{ $v -> id }}" selected>{{ $v -> title }}</option>
                            @else
                                <option value="{{ $v -> id }}">{{ $v -> title }}</option>
                            @endif
                        @endforeach

                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
        </div>

        <div class="layui-form-item" style="width: 400px;">
            <label for="username" class="layui-form-label">
                书籍出版社
            </label>
            <div class="layui-input-inline" style="width: 260px;">
                <input type="text" id="book_press" name="book_press" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> book_press }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item" style="width: 400px;">
            <label for="username" class="layui-form-label">
                书籍出版时间
            </label>
            <div class="layui-input-inline" style="width: 260px;">
                <input type="text" id="book_publishing_time" name="book_publishing_time" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" placeholder="例：2000年1月1日" value="{{ $data -> book_publishing_time }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
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
    var indexs;
    layui.use(['form','layer','layedit','laydate'], function(){
        var $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;

        //显示金钱
        $(".divTrue").click(function () {
            $('#price').show();
        })

        //隐藏金钱
        $(".divv").click(function () {
            $('#price').hide();
        })

        //日期时间选择器
        laydate.render({
            elem: '#start_at'
            ,type: 'datetime'
        });
        //日期时间选择器
        laydate.render({
            elem: '#end_at'
            ,type: 'datetime'
        });

        //插入图片
        layedit.set({
            uploadImage: {
                url: '/uploadImg' //接口url
                ,type: 'post' //默认post
            }
        });

        //建立编辑器
        indexs = layedit.build('book_content' ,{
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
            book_content: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,book_content: function(value){
                layedit.sync(indexs);
            }
        });

        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 5){
                    return '标题至少得5个字符啊';
                }
            }
            ,num: function(value){
                if(/^\d+$/.test(value)==false )
                {
                    return '你输入的不是数字';
                }
            }
        });



        //监听提交
        form.on('submit(add)', function(data){
            console.log(data);
            // return false;
            $.ajax({
                url:'/home/book/DoEdit',
                type: 'post',
                dataType:'json',
                data:{data:data.field},
                success:function(res){

                    if(res.err_code === 10000){
                        layer.alert(res.msg , function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                    }else{
                        layer.alert(res.msg , function(){
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
            elem: '#book_img'
            ,url: '/laravelUploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $("input[name=book_img]").val(res.data.src)
                    $("#book_img").after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#laravelUploadImg').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
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