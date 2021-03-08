<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/mycart.css">
    <link rel="stylesheet" href="/static/css/cart.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
</head>
<!-- 我的购物车 -->
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <!-- 我的购物车 -->
            <div class="gaojian">
                <div class="tab_ment">
                    <p class="TiTle">我的购物车</p>
                </div>
                <div class="bj"></div>
                <div id="table" class="table Shopping_Cart">
                    <ul class="one_tr tab_title">
                        <li id="checkAll"><span><input type="checkbox" id="all">全选</span></li>
                        <li>商品信息</li>
                        <li>定价(元)</li>
                        <li>数量</li>
                        <li>小计(元)</li>
                        <li>操作</li>
                    </ul>
                    <table id="biuuu_city_list4" >
                    </table>
                    <div class="claear"></div>
                    <div id="pagge" class="pagge"></div>
                </div>
                <div class="Settlement_D">
                    <div class="Settlement_Dl">
                        <input type="button" value="取消" id="btn" style="display: none;">
                        <span class="qkgwc">清空购物车</span>
                    </div>
                    <div class="Settlement_DR">
                        <div class="remember">
                            <p> <span>已选<i id="numAll">0</i>件商品</span><span>共计:¥<i id="total">0</i></span></p>
                            <p>折扣:<span>0</span></p>
                        </div>
                        <div class="Settlement">立即结算</div>

                    </div>
                </div>
<div class="clear"></div>
            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>
</div>
@include('Pc.layout.footer')
<script type="text/javascript">
    $(".tab_title li").click(function(index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
    });
    $(".tab_ment li").click(function(index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
    });
    layui.use('upload', function() {
        var $ = layui.jquery,
            upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test1',
            url: '/upload/',
            before: function(obj) {
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result) {
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            },
            done: function(res) {
                //如果上传失败
                if (res.code > 0) {
                    return layer.msg('上传失败');
                }
                //上传成功
            },
            error: function() {
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html(
                    '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function() {
                    uploadInst.upload();
                });
            }
        });
    });
</script>
<script src="/static/json/grzx/mycart.js"></script>
{{--<script src="/static/json/grzx/modifypass.js"></script>--}}
{{--<script type="text/javascript">--}}
{{--    /*--}}
{{--     * 1、实现全选--}}
{{--     * 2、实现反选--}}
{{--     * 3、单个选择--}}
{{--     * */--}}

{{--    // 1、实现全选--}}
{{--    let all = document.querySelector('#all');--}}
{{--    let per = document.querySelectorAll('#goods input');--}}
{{--    console.log(per)--}}
{{--    all.onclick = function() {--}}
{{--        let flag = all.checked;--}}
{{--        console.log(all)--}}
{{--        for (let i = 0; i < per.length; i++) {--}}
{{--            let perFlag = per[i].checked--}}
{{--            if (perFlag === flag) {--}}
{{--                continue--}}
{{--            } else {--}}
{{--                per[i].checked = flag--}}
{{--            }--}}
{{--        }--}}
{{--    }--}}

{{--    // 2、实现反选--}}
{{--    let btn = document.querySelector('#btn')--}}
{{--    btn.onclick = function() {--}}
{{--        for (let i = 0; i < per.length; i++) {--}}
{{--            let flag = per[i].checked--}}
{{--            per[i].checked = !flag--}}
{{--        }--}}
{{--        // 检测全选的checkbox是否要被选中--}}
{{--        checkAllCheckBox()--}}
{{--    }--}}

{{--    // 3、单个选择，判断全选--}}
{{--    for (let i = 0; i < per.length; i++) {--}}
{{--        per[i].onclick = function() {--}}
{{--            // 检测全选的checkbox是否要被选中--}}
{{--            checkAllCheckBox()--}}
{{--        }--}}
{{--    }--}}

{{--    /// 检测全选的checkbox是否要被选中--}}
{{--    function checkAllCheckBox() {--}}
{{--        let isAllCheck = true; // 先假设tobody每一个checkbox都被选中--}}
{{--        for (var j = 0; j < per.length; j++) {--}}
{{--            if (per[j].checked == false) {--}}
{{--                isAllCheck = false;--}}
{{--            }--}}
{{--        }--}}
{{--        // 把isAllCheck赋值给全选的checkbox--}}
{{--        all.checked = isAllCheck;--}}
{{--    }--}}
{{--    //--}}
{{--</script>--}}
</body>
</html>
