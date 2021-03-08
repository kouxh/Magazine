<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的收藏-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/mycollection.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
</head>
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <!-- 我的收藏 -->
            <div class="gezxlist">
                <p class="TiTle">我的收藏</p>
                <b class="bj"></b>
                <div class="tab_title">
                    <ul>
                        <li class="default">文章</li>
                        {{--                            <li class="">电子刊</li>--}}
                        <li class="">杂志平装</li>
                    </ul>
                </div>
                <div class="tab_subject" id="Collection">
                    <div class="div Article">
                        <div id="biuuu_city_list"></div>

                        <div class="clear"></div>
                        <div id="pagge" class="pagge"></div>
                    </div>
                    {{--                        <div class="div">--}}

                    {{--                        </div>--}}
                    <div class="div Collection_main">
                        <dl>
                            <dt><img src="/static/M-img/01.jpg" alt="">
                                <p class="Invalid">该商品已失效</p>
                                <!-- 不同状态不同的提示文字，和背景色 -->
                            </dt>
                            <dd>
                                <p class="">《管理会计研究》 总第<span>06</span>期</p>
                                <p class=""><span>2019</span>年 第<span>06</span>期</p>
                                <p class="money">¥ <span>50</span></p>
                            </dd>
                        </dl>
                        <dl>
                            <dt><img src="/static/M-img/01.jpg" alt="">
                                <p class="Already_purchased">宝贝已购买</p>
                                <!-- 不同状态不同的提示文字，和背景色 -->
                            </dt>
                            <dd>
                                <p class="">《管理会计研究》 总第<span>06</span>期</p>
                                <p class=""><span>2019</span>年 第<span>06</span>期</p>
                                <p class="money">¥ <span>50</span></p>
                            </dd>
                        </dl>
                        <dl>
                            <dt><img src="/static/M-img/01.jpg" alt="">
                                <p class="Already_purchased">宝贝已购买</p>
                                <!-- 不同状态不同的提示文字，和背景色 -->
                            </dt>
                            <dd>
                                <p class="">《管理会计研究》 总第<span>06</span>期</p>
                                <p class=""><span>2019</span>年 第<span>06</span>期</p>
                                <p class="money">¥ <span>50</span></p>
                            </dd>
                        </dl>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
@include('Pc.layout.footer')

</body>
</html>
<script src="/static/json/grzx/mycollection.js"></script>
<script type="text/javascript">
    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
    });
</script>
