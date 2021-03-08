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
            <label class="layui-form-label">栏目级别</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">

                <input type="radio" name="leven"  lay-filter="erweima" value="1" title="一级">
                <input type="radio" name="leven"  lay-filter="erweima" value="2" title="二级">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*   慎选（一级为导航栏目，二级为子栏目）</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1 leven3">
            <label for="username" class="layui-form-label">
                栏目
            </label>
            <div class="layui-input-inline">
                <input type="text" id="column" name="column" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1 leven3">
            <label for="username" class="layui-form-label">
                栏目缩写
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="english" name="english" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label for="username" class="layui-form-label">
                Title
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="title" name="title" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*   栏目的title属性</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label for="username" class="layui-form-label">
                Describe
            </label>
            <div class="layui-input-inline" >
                <input type="text" id="describe" name="describe" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*   栏目的desc属性</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label for="username" class="layui-form-label">
                Pc广告图
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="Pc_advert"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="Pc_advert" id="Pc_advert">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label for="username" class="layui-form-label">
                Pc广告图Url
            </label>
            <div class="layui-input-inline">
                <input type="text" id="Pc_advert_url" name="Pc_advert_url" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label for="username" class="layui-form-label">
                App广告图
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="App_advert"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="App_advert" id="App_advert">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label for="username" class="layui-form-label">
                App广告图Url
            </label>
            <div class="layui-input-inline">
                <input type="text" id="App_advert_url" name="App_advert_url" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label class="layui-form-label">是否添加弹出图</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="is_alert" lay-filter="is-alert" value="1" title="是">
                <input type="radio" name="is_alert" lay-filter="is-alert" value="2" title="否" checked>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item leven is-alert ">
            <label for="username" class="layui-form-label">
                Pc弹出图
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="Pc_alert_advert"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="Pc_alert_advert" id="Pc_alert_advert">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item leven is-alert">
            <label for="username" class="layui-form-label">
                Pc弹出图Url
            </label>
            <div class="layui-input-inline">
                <input type="text" id="Pc_alert_advert_url" name="Pc_alert_advert_url" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven is-alert ">
            <label for="username" class="layui-form-label">
                App弹出图
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="App_alert_advert"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="App_alert_advert" id="App_alert_advert">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item leven is-alert">
            <label for="username" class="layui-form-label">
                App弹出图Url
            </label>
            <div class="layui-input-inline">
                <input type="text" id="App_alert_advert_url" name="App_alert_advert_url" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1">
            <label class="layui-form-label">是否添加Banner</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="is_banner" lay-filter="is-banner" value="1" title="是">
                <input type="radio" name="is_banner" lay-filter="is-banner" value="2" title="否" checked>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item leven is-banner ">
            <label for="username" class="layui-form-label">
                Pc-Banner
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="Pc_banner"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="Pc_banner" id="Pc_banner">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item leven is-banner">
            <label for="username" class="layui-form-label">
                Pc-Banner-Url
            </label>
            <div class="layui-input-inline">
                <input type="text" id="Pc_banner_url" name="Pc_banner_url" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-form-item leven is-banner ">
            <label for="username" class="layui-form-label">
                App-Banner
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="App_banner"><i class="layui-icon"></i>上传文件</button>
            </div>
            <div>
                <input type="hidden" name="App_banner" id="App_banner">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必选</span>
            </div>
        </div>

        <div class="layui-form-item leven is-banner">
            <label for="username" class="layui-form-label">
                App_Banner-Url
            </label>
            <div class="layui-input-inline">
                <input type="text" id="App_banner_url" name="App_banner_url" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 必填</span>
            </div>
        </div>

        <div class="layui-inline leven leven2 leven3">
            <label class="layui-form-label">父级</label>
            <div class="layui-input-block" style="width: 100px;float: left; margin-left: 0px;">
                <select name="p_id" id="p_id" lay-filter="aihao">
                    <option value=""></option>
                    @foreach($column as $v)
                        <option value="{{ $v -> id }}">{{ $v -> column }}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-form-mid layui-word-aux" style="margin-left: 98px;">
                <span class="x-red">* 父级导航</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1 leven3">
            <label class="layui-form-label">是否参与随机</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="rand" value="1" title="是" >
                <input type="radio" name="rand" value="2" title="否" checked="">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*   随机栏目为文章列表底部出现</span>
            </div>
        </div>

        <div class="layui-form-item leven leven2 leven3">
            <label class="layui-form-label">是否显示导航栏</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="is_navigation" lay-filter="sort" value="1" title="是" >
                <input type="radio" name="is_navigation" lay-filter="sort" value="2" title="否" checked="">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*  主：显示导航会在网站导航栏显示该栏目</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1 leven3">
            <label class="layui-form-label">是否显示后台文章管理</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="home_list" value="1" title="是" >
                <input type="radio" name="home_list" value="2" title="否" checked="">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 主：后台文章管理的导航显示</span>
            </div>
        </div>

        <div class="layui-form-item leven leven1 leven3">
            <label class="layui-form-label">是否加入维度</label>
            <div class="layui-input-block" style=" width: 200px;float: left; margin-left: 0px">
                <input type="radio" name="join_dimension" value="1" title="是" >
                <input type="radio" name="join_dimension" value="2" title="否" checked="">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*   主：加入维度说明导航栏下会出现维度选择</span>
            </div>
        </div>

        <div class="layui-inline leven leven1 sort">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block" style="width: 100px;float: left; margin-left: 0px;">
                <select name="sort" lay-filter="aihao">
                    <option value=""></option>
                    @for($i=1;$i<=20;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="layui-form-mid layui-word-aux" style="margin-left: 98px;">
                <span class="x-red">* 排序为出现的顺序，1则是第一个出现依此类推</span>
            </div>
        </div>

        <div class="layui-form-item" style="margin-top: 30px">
            <label for="L_repass" class="layui-form-label"></label>
            <button  type="button" class="layui-btn" lay-filter="add" lay-submit="">增加</button>
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
        /*全部隐藏*/
        $('.leven').hide();

        /*选择性添加表单  1 --- 一级栏目表单  2 --- 二级栏目表单*/
        form.on('radio(erweima)', function (data) {
            //alert(data.value);//判断单选框的选中值
            if(data.value == 1){
                $('.leven1').show();
                $('.leven2').hide();
                $('#p_id').val('');

            }else{
                $('.leven1').hide();
                $('.is-alert').hide();
                $('.is-banner').hide();
                $('.leven2').show();
                $('.leven3').show();
            }
        })

        /*是否添加弹出图*/
        form.on('radio(is-alert)', function (data) {
            //alert(data.value);//判断单选框的选中值
            if(data.value == 1){
                $('.is-alert').show();
            }else{
                $('.is-alert').hide();
                $('#Pc_alert_advert').val('');
                $('#Pc_alert_advert_url').val('');
                $('#App_alert_advert').val('');
                $('#App_alert_advert_url').val('');
            }
        })

        /*是否显示排序  --  控制排序*/
        form.on('radio(sort)' , function(data){
            if(data.value == 1){
                $('.sort').show();
            }else{
                $('.sort').hide();
            }
        })

        /*是否添加Banner图*/
        form.on('radio(is-banner)', function (data) {
            //alert(data.value);//判断单选框的选中值
            if(data.value == 1){
                $('.is-banner').show();
            }else{
                $('.is-banner').hide();
                $('#Pc_banner').val('');
                $('#Pc_banner_url').val('');
                $('#App_banner').val('');
                $('#App_banner_url').val('');
            }
        })


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
            console.log(data);
            // return false;
            $.ajax({
                url:'/home/column/DoAdd',
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
    /*普通文件上传*/
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //Pc广告图
        upload.render({
            elem: '#Pc_advert'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $("input[name=Pc_advert]").val(res.data.src)
                    $('#Pc_advert').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")
                    $('#cuowu').hide();
                    $('#msg').hide();
                }else{
                    $("#Pc_advert").after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"cuowu\"></i>")
                    $('#Pc_advert').after("<span  id='msg' style='color:red;display: block'>"+res.msg+"</span>")
                    $("input[name=Pc_advert]").val('')
                    $('#duigou').hide();
                }
            }
        });
        //App广告图
        upload.render({
            elem: '#App_advert'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $("input[name=App_advert]").val(res.data.src)
                    $('#App_advert').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")
                    $('#cuowu').hide();
                    $('#msg').hide();
                }else{

                    $("#App_advert").after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"cuowu\"></i>")
                    $('#App_advert').after("<span style='color:red;display: block'>"+res.msg+"</span>")
                    $("input[name=App_advert]").val('')
                    $('#duigou').hide();
                }
            }
        });
        //Pc弹出图
        upload.render({
            elem: '#Pc_alert_advert'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $("input[name=Pc_alert_advert]").val(res.data.src)
                    $('#Pc_alert_advert').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")
                    $('#cuowu').hide();
                    $('#msg').hide();
                }else{

                    $("#Pc_alert_advert").after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"cuowu\"></i>")
                    $('#Pc_alert_advert').after("<span style='color:red;display: block'>"+res.msg+"</span>")
                    $("input[name=Pc_alert_advert]").val('')
                    $('#duigou').hide();
                }
            }
        });
        //App弹出图
        upload.render({
            elem: '#App_alert_advert'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $("input[name=App_alert_advert]").val(res.data.src)
                    $('#App_alert_advert').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")
                    $('#cuowu').hide();
                    $('#msg').hide();
                }else{

                    $("#App_alert_advert").after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"cuowu\"></i>")
                    $('#App_alert_advert').after("<span style='color:red;display: block'>"+res.msg+"</span>")
                    $("input[name=App_alert_advert]").val('')
                    $('#duigou').hide();
                }
            }
        });
        //Pc-Banner
        upload.render({
            elem: '#Pc_banner'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $("input[name=Pc_banner]").val(res.data.src)
                    $('#Pc_banner').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")
                    $('#cuowu').hide();
                    $('#msg').hide();
                }else{

                    $("#Pc_banner").after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#Pc_banner').after("<span style='color:red;display: block'>"+res.msg+"</span>")
                    $("input[name=Pc_banner]").val('')
                    $('#duigou').hide();
                }
            }
        });
        //App-Banner
        upload.render({
            elem: '#App_banner'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){
                    $("input[name=App_banner]").val(res.data.src)
                    $('#App_banner').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")
                    $('#cuowu').hide();
                    $('#msg').hide();
                }else{
                    $("#App_banner").after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#App_banner').after("<span style='color:red;display: block'>"+res.msg+"</span>")
                    $("input[name=App_banner]").val('')
                    $('#duigou').hide();
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