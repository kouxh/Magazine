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
        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                订单号
            </label>
            <div class="layui-input-inline" style="width: 300px;">
                <input type="text" id="username" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data['order_num'] }}">
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                快递公司
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="english" name="password" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data['typename'] }}">
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                快递单号
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="english" name="password" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data['logistics_code'] }}">
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                收货人
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data['consignee'] }}">
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                收货人电话
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data['tell'] }}">
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                收货地址
            </label>
            <div class="layui-input-inline" style="width: 600px;">
                <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data['city'] }} {{ $data['area'] }} {{ $data['county'] }} {{ $data['desc_address'] }}">
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                规格
            </label>
            <div class="layui-input-inline" >
                @foreach($data['describe'] as $key => $val)
                    <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                           autocomplete="off" class="layui-input" value="{{ $val -> year }} {{ $val -> title }}" >
                @endforeach
                    <input type="text" id="nickname" name="nickname" required="" lay-verify="required"
                           autocomplete="off" class="layui-input"  >
            </div>
        </div>

        <div >
            <label for="username" >
                物流信息
            </label>
            <div class="layui-input-inline" >

                @foreach($data['resultList']  as $key => $val)
                    <div><p>{{ $val['time']  }}</p></div>
                    <div><p>{{ $val['status']  }}</p></div>
                @endforeach
            </div>
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

            //获取checkbox[name='like']的值
            var arr = new Array();
            $("input:checkbox[name='role_id']:checked").each(function(i){
                arr[i] = $(this).val();
            });
            data.field.role_id = arr.join(",");//将数组合并成字符串

            $.ajax({
                url:'/home/admin/DoAdd',
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