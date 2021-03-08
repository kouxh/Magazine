<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/Order_details.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/css/grzx/order.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <style>
        .type_ment .div {
            display: none;
        }

        .type_ment .div:nth-child(1) {
            display: block;
        }
    </style>
</head>
<!--我的订单 -->
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <!-- 我的订单My order-->
            <div class="MyOrder">
                <p class="TiTle">我的订单</p>
                <b class="bj"></b>
                <div class="MyOrder_tab">
                    <!-- 切换导航 -->
                    <div class="tab_subject">
                        <ul class="type">
                            <li id="1" class="default">杂志</li>
                            <li id="2">文章</li>
                            <li id="3">预售</li>
                            <li id="4">VIP</li>
                        </ul>
                        <div class="type_ment">
                            <div class="div">
                                <div class="MyOrder_tab">
                                    <!-- 切换导航 -->
                                    <div class="tab_title">
                                        <ul>
                                            <li id="100" class="default">所有订单</li>
                                            <li id="1">待支付</li>
                                            <li id="2">待发货</li>
                                            <li id="3">待收货</li>
                                            <li id="4">待评价</li>
                                            <li id="5">已完成</li>
                                            <li id="6">过期订单</li>
                                        </ul>
                                    </div>
                                    <div class="tab_subject">
                                        <div class="MyOrderMainListTitle">
                                            <li><select>
                                                    <option value="100">全部</option>
                                                    <option value="101">最近三个月订单</option>
                                                </select>
                                                <span class="shangP">商品</span>
                                            </li>
                                            <li>数量</li>
                                            <li>单价</li>
                                            <li>收货人</li>
                                            <li>合计</li>
                                            <li>状态</li>
                                            <li>操作</li>
                                        </div>
                                        <div class="Order" id="biuuu_city_list">
                                            <div class="tab_data"></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div id="pagge" class="pagge"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <form action="" id="Order_details" style="display: none; ">
        <ul class="layui-timeline">

        </ul>
    </form>
</div>
{{--请选择支付方式--}}
<div id="selectType" style="display: none;">
    <div class="layui-form select-form" >
            <input type="radio" id="isdisabled"  name="level" lay-filter="levelM" value="1" title="余额支付" checked >
            <div class="remaining">{{Session::get('users')['balance']}}</div>
            <input type="radio" id="ischecked" name="level" lay-filter="levelM" value="2" title="微信支付" >
            <div class="pay_icon"></div>
    </div>
</div>
<div class="clear"></div>
@include('Pc.layout.footer')
</body>
</html>

<script src="/static/json/grzx/order.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
    });
    $(".tab_ment li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
    });

    layui.use('upload', function () {
        var $ = layui.jquery,
            upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test1',
            url: '/upload/',
            before: function (obj) {
                //预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            },
            done: function (res) {
                //如果上传失败
                if (res.code > 0) {
                    return layer.msg('上传失败');
                }
                //上传成功
            },
            error: function () {
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html(
                    '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function () {
                    uploadInst.upload();
                });
            }
        });
    });
</script>
