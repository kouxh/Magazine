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
                订单类别
            </label>
            <div class="layui-input-inline" style="width: 250px;">
                <input type="text" id="year" name="year" required="" value="{{$order -> _class}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled style="color: #9A0000">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                订单号
            </label>
            <div class="layui-input-inline" style="width: 250px;">
                <input type="text" id="order_num" name="order_num" required="" value="{{$order -> order_num}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                数量
            </label>
            <div class="layui-input-inline" style="width: 250px;">
                <input type="text" id="year" name="year" required="" value="{{$order -> all_num}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                总价
            </label>
            <div class="layui-input-inline" style="width: 250px;">
                <input type="text" id="year" name="year" required="" value="{{$order -> all_price}}元" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                交易编号
            </label>
            <div class="layui-input-inline" style="width: 250px;">
                <input type="text" id="year" name="year" required="" value="{{$order -> transaction_id}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">为空说明没有支付</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                支付时间
            </label>
            <div class="layui-input-inline" style="width: 250px;">
                <input type="text" id="year" name="year" required="" value="{{$order -> pay_at}}" lay-verify="required"
                       autocomplete="off" class="layui-input" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">为空说明没有支付</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                规格
            </label>
            @foreach($order -> describe as $key => $val)
                <div class="layui-input-inline" style="width: 250px;">
                    <input type="text" id="year" name="year" required="" value="{{ $val -> year}} {{ $val -> title }}" lay-verify="required"
                           autocomplete="off" class="layui-input" disabled>
                </div>
            @endforeach
        </div>



        <div class="layui-form-item">
            <button type="button" id="remarksMsg" class="layui-btn  layui-bg-red del-activity" style="width: 150px">
                备注信息
            </button>
            <button type="button" id="invoice" class="layui-btn layui-bg-orange switch-activity" style="width: 150px">
                发票信息
            </button>
            <button type="button" id="address" class="layui-btn layui-bg-green switch-activity" style="width: 150px">
                收货地址
            </button>

{{--            判断有没有发货，如果发货展示查看物流信息，没有发货不展示--}}
            @if($order -> logistics_code !=0)
                <button type="button" id="logistics" class="layui-btn layui-bg-blue switch-activity" style="width: 150px">
                    物流信息
                </button>
            @endif
        </div>



    </form>
</div>
<script>
    layui.use(["jquery", "upload", "form", "table", "layer", "element", "laydate"], function () {
        $ = layui.jquery;
        //var data = obj.data
        layer = layui.layer,
        /*备注信息*/
        $("#remarksMsg").click(function () {
            $.get('/home/order/remarksMsg', {id:{{$order -> id}}}, function (res) {
                layer.open({
                    type: 1
                    ,title: "备注信息" //不显示标题栏
                    ,closeBtn: false
                    ,area: '600px;'
                    ,shade: 0.8
                    ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,btn: '关闭'
                    ,btnAlign: 'c'
                    ,moveType: 1 //拖拽模式，0或者1
                    ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">\n' +
                        '            <div class="layui-form-item">\n' +
                        '                <label for="content" class="layui-form-label">\n' +
                        '                    备注信息\n' +
                        '                    </label>\n' +
                        '                <div style="margin-left:110px;width: 60%">\n' +
                        '                    <textarea style="line-height: 60px;" class="layui-textarea" id="careful" name="careful" lay-verify="careful" disabled>\n' +
                        ''+res.data+'\n' +
                        '                    </textarea>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div>'
                    ,yes:function (index,layero) {
                        layer.closeAll();
                    }
                    ,success: function(layero){
                    }
                });
            })
        })
        /*发票信息*/
        $("#invoice").click(function () {
            $.get('/home/order/invoice', {id:{{$order -> id}}}, function (res) {
                layer.open({
                    type: 1
                    ,title: "发票信息" //不显示标题栏
                    ,closeBtn: false
                    ,area: '600px;'
                    ,shade: 0.8
                    ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,btn: '关闭'
                    ,btnAlign: 'c'
                    ,moveType: 1 //拖拽模式，0或者1
                    ,content: '<div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                发票\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_paper+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                发票类型\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_type+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                电话\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_tell+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                邮箱\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_email+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                单位名称\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_company_name+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                纳税人识别码\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_taxpayer_code+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                注册地址\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_register_address+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                注册电话\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_register_tell+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                开户银行\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_deposit_bank+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                银行账户\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.in_bank_account+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>'
                    ,yes:function (index,layero) {
                        layer.closeAll();
                    }
                    ,success: function(layero){
                    }
                });
            })
        })
        /*收获地址*/
        $("#address").click(function () {
            $.get('/home/order/address', {id:{{$order -> id}}}, function (res) {
                layer.open({
                    type: 1
                    ,title: "备注信息" //不显示标题栏
                    ,closeBtn: false
                    ,area: '600px;'
                    ,shade: 0.8
                    ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,btn: '关闭'
                    ,btnAlign: 'c'
                    ,moveType: 1 //拖拽模式，0或者1
                    ,content: '<div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                收货人\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.consignee+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                市\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.city+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                区\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.area+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                县\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.county+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                详细地址\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.desc_address+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                手机号\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.tell+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                固定号码\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.fixed_number+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="layui-form-item">\n' +
                        '            <label for="username" class="layui-form-label">\n' +
                        '                邮编\n' +
                        '            </label>\n' +
                        '            <div class="layui-input-inline" style="width: 250px;">\n' +
                        '                <input type="text" id="year" name="year" required="" value="'+res.data.zip_code+'" lay-verify="required"\n' +
                        '                       autocomplete="off" class="layui-input" disabled>\n' +
                        '            </div>\n' +
                        '        </div>'
                    ,yes:function (index,layero) {
                        layer.closeAll();
                    }
                    ,success: function(layero){
                    }
                });
            })
        })
        /*物流信息*/
        $("#logistics").click(function () {
            x_admin_show('添加栏目','/home/order/logistics?id={{$order -> id}}')
        })
    })

</script>
</body>

</html>
