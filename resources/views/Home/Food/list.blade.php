<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-管理会记研究</title>
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
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a ><cite></cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<input type="hidden" id="column" value="">
<div class="x-body">
    <div class="layui-row">

        <div class="layui-input-inline">
            <input type="tel" name="searContent" autocomplete="off"
                   placeholder="请输入标题" class="layui-input">
        </div>
        <div class="layui-input-inline " style="width: 90px">
            <button class="layui-btn" id="searchEmailCompany" data-type="reload">
                <i class="layui-icon" style="font-size: 20px; "></i>
            </button>
        </div>

    </div>
    <xblock >

        <button class="layui-btn" onclick="x_admin_show('添加瞬间','/home/food/Add')"><i class="layui-icon"></i>添加</button>
        <input type="hidden" id = "type" value="">

    </xblock>

    <div class="yys-fluid yys-wrapper">
        <div class="layui-row lay-col-space20">
            <div class="layui-cos-xs12 layui-col-sm12 layui-col-md12 layui-col-lg12">
                <section class="yys-body animated rotateInDownLeft">
                    <div class="yys-body-content clearfix changepwd">
                        <div class="layui-col-lg12 layui-col-md10 layui-col-sm12 layui-col-xs12" style="width:100%">
                            <div class="user-tables">
                                <table id="userTables" lay-filter="userTables"> </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</div>
{{--工具栏模板：--}}
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <a title="编辑"  lay-event="edit" href="javascript:;">
            <i class="layui-icon layui-icon-edit" ></i>
        </a>
        <a title="删除" lay-event="del" href="javascript:;">
            <i class="layui-icon layui-icon-delete" style="margin-left: 10px"></i>
        </a>
    </div>
</script>
<script>

    column = '';
    layui.use(["jquery", "upload", "form", "table", "layer", "element", "laydate"], function () {
        $ = layui.jquery;
        var element = layui.element,
            layer = layui.layer,
            upload = layui.upload,
            form = layui.form,
            laydate = layui.laydate,
            table = layui.table;
        //记录选中的数据:做缓存使用,作为参数传递给后台,然后生成pdf ,压缩
        var ids =new Array();
        //当前表格中的全部数据:在表格的checkbox全选的时候没有得到数据, 因此用全局存放变量
        var table_data=new Array();


        table.render({
            elem: "#userTables"
            ,title: '新闻',
            cols: [[
                {type: 'numbers', title: '序号', width: '40'},
                {field: "title", width: 290, title: "标题", align: "left"},
                {field: "keyboard", width: 160, title: "关键词", align: "left"},
                {field: "author", width: 105, title: "作者", align: "left"},
                {field: "av_title", width: 280, title: "活动", align: "left"},
                {field: "view", width: 80, title: "浏览量", align: "center" ,sort: true, totalRow: true},
                {field: "status", width: 80, title: "状态", align: "left"},
                {field: "crea_at", width: 120, title: "创建时间", align: "left" , sort: true, totalRow: true},
                {fixed: 'right', title: '操作', width: 110, align:'center',toolbar: '#toolbarDemo'}
            ]],
            url: "/home/food/Page",
            headers:{'COLUMN' : 1},
            // headers: {
            //     'Column': column
            // },
            //data: userData,
            page: { //分页设定
                layout: ['count', 'prev', 'page', 'next'] //自定义分页布局
                , curr: 1 //设定初始在第 1 页
                , limit: 7//每页多少数据
                , groups: 5 //只显示 5 个连续页码
            },
            even: true,
            done: function(res, curr, count , msg){
                //数据表格加载完成时调用此函数
                //如果是异步请求数据方式，res即为你接口返回的信息。
                //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度

                //设置全部数据到全局变量
                table_data=res.data;

                //在缓存中找到id ,然后设置data表格中的选中状态
                //循环所有数据，找出对应关系，设置checkbox选中状态
                for(var i=0;i< res.data.length;i++){
                    for (var j = 0; j < ids.length; j++) {
                        //数据id和要勾选的id相同时checkbox选中
                        if(res.data[i].id == ids[j])
                        {
                            //这里才是真正的有效勾选
                            res.data[i]["LAY_CHECKED"]='true';
                            //找到对应数据改变勾选样式，呈现出选中效果
                            var index= res.data[i]['LAY_TABLE_INDEX'];
                            $('.layui-table-fixed-l tr[data-index=' + index + '] input[type="checkbox"]').prop('checked', true);
                            $('.layui-table-fixed-l tr[data-index=' + index + '] input[type="checkbox"]').next().addClass('layui-form-checked');
                        }
                    }
                }
                //设置全选checkbox的选中状态，只有改变LAY_CHECKED的值， table.checkStatus才能抓取到选中的状态
                var checkStatus = table.checkStatus('my-table');
                if(checkStatus.isAll){
                    $(' .layui-table-header th[data-field="0"] input[type="checkbox"]').prop('checked', true);
                    $('.layui-table-header th[data-field="0"] input[type="checkbox"]').next().addClass('layui-form-checked');
                }
                //得到所有数据
                console.log(res);
                //得到当前页码
                console.log(curr);
                //得到数据总量
                console.log(count);

                //console.log(msg)
            }
        });

        //复选框选中监听,将选中的id 设置到缓存数组,或者删除缓存数组
        table.on('checkbox(userTables)', function (obj) {
            if(obj.checked==true){
                if(obj.type=='one'){
                    ids.push(obj.data.id);
                }else{
                    for(var i=0;i<table_data.length;i++){
                        ids.push(table_data[i].id);
                    }
                }
            }else{
                if(obj.type=='one'){
                    for(var i=0;i<ids.length;i++){
                        if(ids[i]==obj.data.id){
                            ids.remove(i);
                        }
                    }
                }else{
                    for(var i=0;i<ids.length;i++){
                        for(var j=0;j<table_data.length;j++){
                            if(ids[i]==table_data[j].id){
                                ids.remove(i);
                            }
                        }
                    }
                }
            }
        });
        /*获取选中的数组*/
        //console.log(ids);

        //搜索加载--数据表格重载
        var $ = layui.$, active = {
            reload: function () {
                //执行重载
                table.reload('userTables', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    , where: {
                        searContent: $("input[name=searContent]").val(),
                        type:$("#type").val()
                    }
                });
            }
        };


        $('#searchEmailCompany').on('click', function () {
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });     //搜索

        $('#getclass1') .on('click' , function(){
            $("#type").val(1);
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';

        })              //热点事件

        $('#getclass2') .on('click' , function(){
            $("#type").val(2)
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        })              //政策解读

        $('#getclass5') .on('click' , function(){
            $("#type").val(5)
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        })              //案例研究

        $('#getclass6') .on('click' , function(){
            $("#type").val(6)
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        })              //案例故事

        $('#getclass10') .on('click' , function(){
            $("#type").val(1)
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        })             //业界新闻

        $('#getclass11') .on('click' , function(){
            $("#type").val(2)
            ids=new Array();
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        })             //活动新闻

        element.init();
    });

    //删除数组自定义函数
    Array.prototype.remove=function(dx)
    {
        if(isNaN(dx)||dx>this.length){return false;}
        for(var i=0,n=0;i<this.length;i++)
        {
            if(this[i]!=this[dx])
            {
                this[n++]=this[i]
            }
        }
        this.length-=1
    }

    layui.use('table', function() {
        table = layui.table;

        //监听行工具事件
        table.on('tool(userTables)', function (obj) {
            var data = obj.data;
            switch (obj.event) {
                // case 'show':
                //     //console.log(column);
                //     //return false;
                //     //layer.msg('查看');
                //     x_admin_show('查看活动','artivityShow?id=' + data.id);
                //     break;
                case 'del':
                    //layer.msg('删除');
                    layer.confirm('真的删除么', function (index) {
                        $.ajax({
                            url:'/home/food/Del',
                            type:'get',
                            dataType:'json',
                            data:{id:data.id},
                            success:function(res){
                                if(res.err_code === 10000){
                                    layer.close(index);
                                    layer.alert('删除成功' , function(){
                                        location.reload();
                                    });

                                }else{
                                    layer.close(index);
                                    layer.alert('删除失败' , function(){
                                        location.reload();
                                    });
                                }
                            }
                        })
                    });
                    break;
                case 'edit':
                    x_admin_show('编辑活动','/home/food/Edit?id=' + data.id );
                    break;
            }
        })
    })


</script>

<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        alert(id);
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }



    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>

</html>

