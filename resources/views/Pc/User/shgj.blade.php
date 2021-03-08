<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/grzx/shgj.css">

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
</head>
<!-- 审核查询 -->
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <!-- 会员中心 -->
            <div class="gaojian">
                <div class="tab_ment ">
                    <ul style="cursor:pointer;">
                        <li class="change" id="1">全部稿件</li>
                        <li id="2">审核中</li>
                        <li id="3">已采纳</li>
                        <li id="4">未采纳</li>
                    </ul>
                </div>
                <div class="bj"></div>
                <div class="tab_box">
{{--                    <div class="div ">--}}
                        <div class="tab_title sh">
                            <ul>
                                <li>稿件标题</li>
                                <li>稿件编号</li>
                                <li>投稿日期</li>
                                <li>投稿栏目</li>
                                <li>审核状态</li>
                                <li>采纳状态</li>
                                <li>反馈建议</li>
                                <li>获得积分</li>
                            </ul>
                        </div>
                        <form action="" method="" class="ManuscriptForm">
                            <table border="" cellspacing="" cellpadding="" id="biuuu_city_list2" class="cc"
                                   style="width: 100%"></table>
                        </form>
                        <div id="paggetj" class="pagge"></div>
{{--                    </div>--}}
                  
                </div>
            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>
</div>
@include('Pc.layout.footer')

<script src="/picJs/footer.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/json/grzx/shgj.js"></script>
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
</body>
</html>
