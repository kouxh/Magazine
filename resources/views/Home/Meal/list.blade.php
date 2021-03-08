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
            <input type="text" name="searContent" autocomplete="off"
                   placeholder="请输入订单号" class="layui-input">
        </div>
        <div class="layui-input-inline " style="width: 90px">
            <span data-column_id="reload" class="layui-btn" id="searchEmailCompany" >
                <i class="layui-icon" style="font-size: 20px; "></i>
            </span>
        </div>


    </div>

    <xblock >

        {{--        <button class="layui-btn" onclick="x_admin_show('添加管理员','/home/book/Add')"><i class="layui-icon"></i>添加</button>--}}
        {{--        <input type="hidden" id = "type" value="">--}}

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
        <a title="查看" lay-event="show" href="javascript:;"   >
            <i class="layui-icon layui-icon-form" style="margin-left: -4px"></i>
        </a>
        <a title="改价"  lay-event="edit" href="javascript:;">
            <i class="layui-icon layui-icon-edit" style="margin-left: 10px"></i>
        </a>
        <a title="发货"  lay-event="deliver" href="javascript:;">
            <i class="layui-icon layui-icon-cart" style="margin-left: 10px"></i>
        </a>
        <a title="删除" lay-event="del" href="javascript:;">
            <i class="layui-icon layui-icon-delete" style="margin-left: 10px"></i>
        </a>

    </div>
</script>

<script>


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
        column = $("#column").val();

        table.render({
            elem: "#userTables"
            ,title: '业界',
            cols: [[
                // {checkbox: true, width: 60, fixed: true},
                {type: 'numbers', title: '序号', width: '40'},
                {field: "order_num", width: 250, title: "订单号", align: "left"},
                {field: "all_num", width: 80, title: "数量", align: "left" ,},
                {field: "Alr_delivery", width: 80, title: "已配送", align: "left" ,},
                {field: "should_delivered", width: 80, title: "应配送", align: "left" ,},
                {field: "all_price", width: 160, title: "总价/元", align: "left" ,},
                {field: "status", width: 110, title: "状态", align: "left" , templet:'#status'},
                {field: "crea_at", width: 160, title: "创建时间", align: "left" , },
                {fixed: 'right', title: '操作', width: 160, align:'center',toolbar: '#toolbarDemo'}
            ]],
            url: "/home/meal/Page",
            // headers: {
            //     'Column': column
            // },
            //data: userData,
            page: { //分页设定
                layout: ['count', 'prev', 'page', 'next'] //自定义分页布局
                , curr: 1 //设定初始在第 1 页
                , limit: 10//每页多少数据
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
                case 'show':
                    x_admin_show('查看订单详情','/home/order/Show?id=' + data.id);
                    break;
                case 'edit':
                    //修改金额
                    layer.open({
                        type: 1
                        ,title: "修改金额" //不显示标题栏
                        ,closeBtn: false
                        ,area: '600px;'
                        ,shade: 0.8
                        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                        ,btn: ['提交', '取消']
                        ,btnAlign: 'c'
                        ,moveType: 1 //拖拽模式，0或者1
                        ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">'+
                            '        <div class="layui-form-item">\n' +
                            '            <label for="username" class="layui-form-label">\n' +
                            '                总金额\n' +
                            '            </label>\n' +
                            '            <div class="layui-input-inline" style="width: 220px;">\n' +
                            '                <input type="text" id="all_price" name="all_price"' +
                            '                       autocomplete="off" class="layui-input" value="" placeholder="例：0.00">\n' +
                            '            </div>\n' +
                            '            <div class="layui-form-mid layui-word-aux">\n' +
                            '                <span class="x-red">*</span>\n' +
                            '            </div>\n' +
                            '        </div></div>'
                        ,yes:function (index,layero) {
                            $.ajax({
                                url:"/home/order/ModifyPrice",
                                type:'post',
                                data:{id:data.id, all_price:$("#all_price").val()},
                                dataType:'json',
                                success:function(res){
                                    if (res.bol == true && res.err_code == 10000) {
                                        layer.alert(res.msg , function(){
                                            layer.closeAll(); //再执行关闭
                                            location.reload();
                                        });
                                    } else if (res.err_code == 10001) {
                                        layer.alert(res.msg , function(){
                                            layer.closeAll(); //再执行关闭
                                            location.reload();
                                        });
                                    }


                                }
                            })
                        }
                        ,success: function(layero){
                        }
                    });
                    break;
                case 'deliver':
                    layer.open({
                        type: 1
                        ,title: "发货" //不显示标题栏
                        ,closeBtn: false
                        ,area: '600px;'
                        ,shade: 0.8
                        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                        ,btn: ['提交', '取消']
                        ,btnAlign: 'b'
                        ,moveType: 1 //拖拽模式，0或者1
                        ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">\n' +
                            '                <div class="layui-form-item" >\n' +
                            '                    <label for="username" class="layui-form-label">\n' +
                            '                        物流单号\n' +
                            '                    </label>\n' +
                            '                    <div class="layui-input-inline" style="width: 220px;">\n' +
                            '                        <input type="text" id="logistics_code" name="logistics_code" required="" lay-verify=""\n' +
                            '                               autocomplete="off" class="layui-input" value="" placeholder="例：123456879">\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '                <div class="layui-form-item">\n' +
                            '                    <label for="username" class="layui-form-label">\n' +
                            '                        快递公司\n' +
                            '                    </label>\n' +
                            '                    <div class="layui-input-inline" style="width: 220px;">\n' +
                            '                        <div class="layui-form" >\n' +
                            '                            <select name="express" id="express" lay-filter="" style="display: block">\n' +
                            '                                <option value="申通">申通</option>\n' +
                            '                                <option value="顺丰">顺丰</option>\n' +
                            '                                <option value="圆通">圆通</option>\n' +
                            '                                <option value="中通">中通</option>\n' +
                            '                                <option value="汇通快递">汇通快递</option>\n' +
                            '                                <option value="韵达">韵达</option>\n' +
                            '                            </select>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>'
                        ,yes:function (index,layero) {
                            $.ajax({
                                url:"/home/meal/mealDeliverGoods",
                                type:'post',
                                data:{id:data.id, logistics_code:$("#logistics_code").val(), express:$("#express").val()},
                                dataType:'json',
                                success:function(res){
                                    if (res.bol == true && res.err_code == 10000) {
                                        layer.alert(res.msg , function(){
                                            layer.closeAll(); //再执行关闭
                                            location.reload();
                                        });
                                    } else if (res.err_code == 10001) {
                                        layer.alert(res.msg , function(){
                                            layer.closeAll(); //再执行关闭
                                            location.reload();
                                        });
                                    }


                                }
                            })
                        }
                        ,success: function(layero){
                        }
                    });
                    break;
                case 'del':
                    layer.confirm('真的删除么', function (index) {
                        $.ajax({
                            url:'/home/order/DoDel',
                            type:'get',
                            dataType:'json',
                            data:{id:data.id},
                            success:function(res){
                                if(res.err_code === 10000){
                                    layer.close(index);
                                    layer.alert(res.msg , function(){
                                        location.reload();
                                    });

                                }else{
                                    layer.close(index);
                                    layer.alert(res.msg , function(){
                                        location.reload();
                                    });
                                }
                            }
                        })
                    });
                    break;
            }
            ;
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

