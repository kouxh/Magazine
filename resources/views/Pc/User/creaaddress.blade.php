<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link rel="stylesheet" href="/static/css/grzx/creaaddress.css">
    <link rel="stylesheet" href="/static/picss/xcConfirm.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/data.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/province3.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var defaults = {
            s1: 'provid',
            s2: 'cityid',
            s3: 'areaid',
            v1: null,
            v2: null,
            v3: null
        };
    </script>
</head>
<style type="text/css">
    .custom-layerb_R select {
        width: 20% !important;
    }

    .layui-form-item .layui-input-inline {
        width: 170px;
        width: 25% !important;
    }
</style>
<body>
    @include('Pc.layout.personal')
<form class="layui-form layui-form-pane custom-layerD" action="" lay-filter="example" id="id">
    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label"><em>*</em>收货人ddd</label>
        <div class="layui-input-block custom-layerb_R">
{{--            <input type="text" id="name" name="title" class="module-text select580 Consignee"required lay-verify="required"--}}
{{--                   placeholder="请输入收货人信息" autocomplete="off" class="layui-input" autocomplete="off">--}}
{{--            <input type="text" id="desc_address" name="desc_address" class="module-text select580 Consignee" required lay-verify="required"--}}
{{--                   placeholder="请输入详细地址" autocomplete="off" class="layui-input">--}}

            <input type="text"lay-verType id="name"   name="title" lay-verify="title" autocomplete="off" placeholder="请输入姓名" class="layui-input">
{{--            <input name="fname" id="name"  class="layui-input" type="text"autocomplete="off"  placeholder="请输入姓名" required autocomplete="off" lay-verify="fname">--}}
        </div>
        <div id="usedpwdId" class="YZ"></div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item custom-layerD_" id="sjld">
        <label class="layui-form-label"><em>*</em>选择地区</label>
        <div class="custom-layerb_R">
            <div class="layui-input-inline">
                <select name="provid" id="provid" lay-filter="provid" class="xl" lay-verify="required" lay-search="ni">
                    <option value="" class="sd">请选择省</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="cityid" id="cityid" lay-filter="cityid" class="xl">
                    <option value="">请选择市</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="areaid" id="areaid" lay-filter="areaid" class="xl">
                    <option value="">请选择县/区</option>
                </select>
            </div>
        </div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label"><em>*</em>详细地址</label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text" id="desc_address" name="desc_address" class="module-text select580 Consignee" required lay-verify="required"
                   placeholder="请输入详细地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="errorMessage"></div>

    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label"><em>*</em>手机号</label>
        <div class="layui-input-block custom-layerb_R">
{{--            <input type="text" name="phone"  type="tel" required lay-verify="required" class="module-text select180 Consignee" placeholder="请输入手机号"--}}
{{--                   autocomplete="off" class="layui-input">--}}
            <input name="phone" class="layui-input" id="tell" type="tel" autocomplete="off" placeholder="请输入手机" lay-verify="phone">
        </div>
    </div>
    <div class="errorMessage"></div>

    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label">固定号码</label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text"  id="fixed_number"name="fixed_number"  lay-verify="" class="module-text select180 Consignee" placeholder="请输入固定号码"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label">邮政编码 </label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text" id="zip_code" name="zip_code"  lay-verify="" class="module-text select180 Consignee" placeholder="请输入邮政编码"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" id="bc" class="layui-btn layui-layer-btn0" lay-submit lay-filter="demo1">保存</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
</html>
<script>
    // layui.use(['form', 'layedit', 'laydate'], function() {
    //     var form = layui.form
    //         , layer = layui.layer
    //         , layedit = layui.layedit
    //         , laydate = layui.laydate;
        // form.val('example', {
        //     "title": "贤心", // "name": "value"
        //     // ,"password": "123456"
        //     // ,"interest": 1
        //     // ,"like[write]": true //复选框选中状态
        //     // ,"close": true //开关状态
        //     // ,"sex": "女"
        //     // ,"desc": "我爱 layui"
        // });

        // form.verify({
        //     title: function(value){
        //         if(value.length < 1){
        //             return '请输入收货人姓名';
        //         }
        //     },
        //     desc_address:function (value) {
        //         if(value.length < 1){
        //             return '请您填写收货人详细地址';
        //         }
        //     }
        //     ,pass: [
        //         /^[\S]{6,12}$/
        //         ,'密码必须6到12位，且不能出现空格'
        //     ]
        //     ,content: function(value){
        //         layedit.sync(editIndex);
        //     }
        // });
        // layui.$('#bc').on('click', function(){
        //     form.val('example', {
        //         "username": "贤心" // "name": "value"
        //         ,"password": "123456"
        //         ,"interest": 1
        //         ,"like[write]": true //复选框选中状态
        //         ,"close": true //开关状态
        //         ,"sex": "女"
        //         ,"desc": "我爱 layui"
        //     });
        // });
        // form.on('submit(demo1)', function(data,index){
        //     layer.closeAll(index);
        //     $('.layui-layer').hide();
        //     // layer.alert(JSON.stringify(data.field), {
        //     //     title: '最终的提交信息'
        //     // })
        //     return false;
        // });
    // });

    // $("#bc").click(function(){
    //     console.log("点击事件");
    // });
</script>
<!-- <script type="text/javascript" src="json/xz.js"></script> -->

{{--<script type="text/javascript">--}}
{{--    function getCookie(name) {--}}
{{--        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");--}}
{{--        if (arr = document.cookie.match(reg)) return unescape(arr[2]);--}}
{{--        else return null;--}}
{{--    }--}}
{{--    // setCookie("token",token);--}}
{{--    var token = getCookie("token");--}}
{{--    // 保存信息--}}
{{--    layui.use('form', function() {--}}
{{--        var form = layui.form;--}}
{{--        //监听提交--}}
{{--        form.on('submit(formDemo)', function(data) {--}}
{{--            layer.msg(JSON.stringify(data.field));--}}
{{--            console.log(JSON.stringify(data.field.areaid))--}}
{{--            console.log(JSON.stringify(data.field))--}}
{{--            // console.log("保存");--}}
{{--            $('.custom-layerb_R  .layui-select-title input').val--}}
{{--            var Consignee = data.field.Consignee; //收货人--}}
{{--            var cmbProvince = data.field.provid //地区  市--}}
{{--            var cmbCity = data.field.cityid;--}}
{{--            var cmbArea = data.field.areaid; //县--}}
{{--            var detailed = data.field.desc_address; //详细地址--}}
{{--            var phone = data.field.tell //手机号--}}
{{--            var gdh = data.field.fixed_number; //固定电话--}}
{{--            var yz = data.field.zip_code; //邮政编码--}}
{{--            console.log(yz);--}}
{{--            var address = Consignee + cmbProvince + cmbCity + cmbArea + detailed--}}
{{--            console.log(Consignee + cmbProvince + cmbCity + cmbArea + detailed + phone + yz + gdh);--}}
{{--            $("#address").text(address);--}}
{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: '/AddressApi',--}}
{{--                data: {--}}
{{--                    consignee: Consignee, //收货人--}}
{{--                    city: cmbProvince, //城市--}}
{{--                    area: cmbCity, //地区--}}
{{--                    county: cmbArea, //县--}}
{{--                    desc_address: detailed, //详细地址--}}
{{--                    fixed_number: gdh,--}}
{{--                    zip_code: yz, //邮政编码--}}
{{--                    tell: phone, //手机号--}}
{{--                },--}}
{{--                success: function(data) {--}}
{{--                    console.log(data);--}}
{{--                    // location.href = './order.html';--}}
{{--                },--}}
{{--                error: function() {--}}
{{--                    console.log("错我");--}}
{{--                }--}}
{{--            })--}}
{{--            alert($('.address').html())--}}
{{--            // $.ajax({--}}
{{--            // 	type: "POST",--}}
{{--            // 	url: '/AddressApi',--}}
{{--            // 	data: {--}}
{{--            // 		consignee: Consignee, //收货人--}}
{{--            // 		city: cmbProvince, //城市--}}
{{--            // 		area: cmbCity, //地区--}}
{{--            // 		county: cmbArea, //县--}}
{{--            // 		desc_address: detailed, //详细地址--}}
{{--            // 		fixed_number: gdh,--}}
{{--            // 		zip_code: yz, //邮政编码--}}
{{--            // 		tell: phone, //手机号--}}
{{--            // 	},--}}
{{--            // 	success: function(data) {--}}
{{--            // 		console.log(data);--}}
{{--            // 		// location.href = './order.html';--}}
{{--            // 	},--}}
{{--            // 	error: function() {--}}
{{--            // 		console.log("错我");--}}
{{--            // 	}--}}
{{--            // })--}}




{{--            return false;--}}
{{--        });--}}
{{--    });--}}

{{--    function alertMCLayer(layerStr, activeStr) {--}}
{{--        let oLayer = $(layerStr);--}}
{{--        // let layer_height = window.innerHeight + 'px';--}}
{{--        // oLayer.css({--}}
{{--        // 	'position': 'fixed',--}}
{{--        // 	'left': '0',--}}
{{--        // 	'top': '0',--}}
{{--        // 	'width': '100%',--}}
{{--        // 	'height': layer_height,--}}
{{--        // 	'background': 'rgba(0,0,0,0.7)',--}}
{{--        // 	'display': 'none',--}}
{{--        // 	'justify-content': 'center',--}}
{{--        // 	'align-items': 'center',--}}
{{--        // });--}}
{{--        oLayer.find('div').on('click', function(event) {--}}
{{--            event.stopPropagation(); //取消事件冒泡，点击外层时才会弹出--}}
{{--        })--}}
{{--        oLayer.on('click', function() {--}}
{{--            $(this).css('display', 'none'); //点击外层隐藏蒙层--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}
