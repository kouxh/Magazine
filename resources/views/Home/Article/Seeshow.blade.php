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
        {{--        <input type="hidden" name= 'column' value="{{$column}}">--}}
        <input type="hidden" name= 'id' value="{{$data['id']}}">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                标题
            </label>
            <div class="layui-input-inline" style="width: 300px;">
                <input type="text" id="username" name="title" required=""  lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$data['title']}}">
            </div>
            <div class="layui-form-mid layui-word-aux" >
                <span class="x-red" >*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                作者
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="author" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$data['author']}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">关键词</label>
            <div class="layui-input-inline">
                <select name="keyword1">
                    @if(empty($data['keyword'][0]) ||$data['keyword'][0] == 0)
                        <option value="0" selected>未选择</option>
                    @endif
                    @foreach($data['hang'] as $key => $val)
                        @if($data['keyword'][0] == $val-> id)
                            <option value="{{$val -> id}}" selected>{{$val -> title}}</option>
                        @else
                            <option value="{{$val -> id}}">{{$val -> title}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="layui-input-inline">
                <select name="keyword2">
                    @if(empty($data['keyword'][1]) || $data['keyword'][1] == 0)
                        <option value="0" selected>未选择</option>
                    @endif
                    @foreach($data['xing'] as $key => $val)
                        @if($data['keyword'][1] == $val-> id)
                            <option value="{{$val -> id}}" selected>{{$val -> title}}</option>
                        @else
                            <option value="{{$val -> id}}">{{$val -> title}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="layui-input-inline">
                <select name="keyword3">
                    @if(empty($data['keyword'][2]) ||$data['keyword'][2] == 0)
                        <option value="0" selected>未选择</option>
                    @endif
                    @foreach($data['zhi'] as $key => $val)
                        @if($data['keyword'][2] == $val-> id)
                            <option value="{{$val -> id}}" selected>{{$val -> title}}</option>
                        @else
                            <option value="{{$val -> id}}">{{$val -> title}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                搜索引擎
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="keyboard" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{$data['keyboard']}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label" >
                分类
            </label>
            <div class="layui-input-inline">
                <select name="column_id">
                    @foreach($column as $v)
                        @if($data['column_id'] == $v -> id)
                            <option value="{{ $v -> id }}" selected>{{ $v -> column }}</option>
                        @else
                            <option value="{{ $v -> id }}" >{{ $v -> column }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
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
                <input type="hidden" name="img" id="img" value="{{$data['img']}}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                价钱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="price" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$data['price']}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" style="width: 65%" name="message" value="">{{$data['message']}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                免费内容
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="free_content" name="free_content" style="display: none;"  lay-verify="free_content" value="">{{$data['free_content']}}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                付费内容
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="charge_content" name="charge_content" style="display: none;"  lay-verify="charge_content" value="">{{$data['charge_content']}}</textarea>
            </div>
        </div>
        
    </form>
</div>

<script>

    var indexs;
    var indexs2;
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
                ,headers:{'type' : 'full'}
            }
        });


        //建立编辑器
        indexs = layedit.build('free_content' ,{
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
        indexs2 = layedit.build('charge_content' ,{
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
            free_content: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,free_content: function(value){
                layedit.sync(indexs);
            }
        });

        //自定义验证规则
        form.verify({
            charge_content: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,charge_content: function(value){
                layedit.sync(indexs2);
            }
        });

        //监听提交
        form.on('submit(add)', function(data){

            //console.log(data);
            //console.log(data.field);
            $.ajax({
                url:'/home/article/DoEdit',
                type: 'post',
                dataType:'json',
                data:{data:data.field},
                success:function(res){

                    if(res.code === 10000){

                        layer.alert(res.msg , {icon: 6},function () {
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                        return false;

                    }else{
                        layer.alert(res.msg , {icon: 6},function () {
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });

                    }
                }


            })
            //发异步，把数据提交给php

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
