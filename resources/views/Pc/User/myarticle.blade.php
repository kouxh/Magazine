<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>购买的文章-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/myarticle.css">
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
            {{--            购买的文章--}}
            <div class="gezxlist">
                <p class="TiTle">我的文章</p>
                <b class="bj"></b>
                <div class="article_content" >
                    <ul class="title">
                        <li>文章标题</li>
                        <li>购买日期</li>
                    </ul>
{{--                    有数据--}}
                        <ul class="article_box" id="article_data">
{{--                            <li class="item_article" >--}}
{{--                                <a  href="#" class="article_left" >--}}
{{--                                    <h4>文章标题RPA如何驱动管理会计转型升级——基于四家企业案例分析的证据</h4>--}}
{{--                                </a>--}}
{{--                                <div class="article_right">2020-07-01 06:46:58</div>--}}
{{--                            </li>--}}
                        </ul>

{{--                    无数据--}}
{{--                    <p class="no_article"> 暂无数据</p>--}}
                    <div class="clear"></div>
                    <div id="pagge" class="pagge"></div>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="clear"></div>
@include('Pc.layout.footer')

</body>
</html>
<script src="/static/json/grzx/myarticle.js"></script>


