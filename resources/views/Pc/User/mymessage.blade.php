<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/wdly.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
     <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
</head>
<!-- 我的留言 ，我的评论-->
<body>
@include('Pc.layout.personal')

<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <!-- 会员中心 -->
            <div class="gaojian">
                <div class="tab_ment">
                    <ul>
                        <li class="change">我的留言</li>
{{--                        <li>我的评论</li>--}}

                    </ul>
                </div>
                <div class="bj"></div>
                <div class="tab_title">
                <ul>
                    <li class="default" id="1">文章</li>
                    <li id="2">杂志</li>
                    <li id="3">cmas大讲堂</li>
                </ul>
            </div>
                <div class="tab_box">
                    <div class="div">
                        <form action="" method="" class="wdlyForm" id="stay_word">
                            <ul><li>日期</li><li>主题</li><li>留言内容</li><li>审核状态</li><li>操作</li></ul>
                            <table border="" cellspacing="" cellpadding=""  id="biuuu_city_list">
                            </table>
                            <div id="pagge" class="pagge"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
@include('Pc.layout.footer')
</body>
</html>
{{--s z--}}
<script src="/static/json/grzx/mymessage.js"></script>
<script type="text/javascript">
    // 切换
    $(".tab_ment li").click(function(index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
    });
    // 单行删除
    $('.delete').click(function(){
        var cc=$(this).parent().parent().attr("id");
        $('#'+cc+'').remove();
    })

</script>