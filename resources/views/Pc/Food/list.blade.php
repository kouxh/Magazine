<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $data['column']['title']}}</title>
    <meta name="description" content="{{ $data['column']['describe']}}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <!-- 公共css -->
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <!--  -->
    <link rel="stylesheet" type="text/css" href="/static/css/technology.css"/>
</head>
<style>

</style>
@include('Pc.layout.header')
<body>
{{--<script src="static/picJs/header.js" type="text/javascript" charset="utf-8"></script>--}}
<div class="wapper" id="wapper">
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="sectionL">
            <b class="bj"></b>
            <div class="sectionLb caseA">
                <div class="tab" id="tab">
                    <div class="tab-menu ">
                        <h2>{{ $data['column']['column']}}</h2>
                        <ol class="two_title" id="two_title">

                        </ol>
                    </div>
                    <div class="dimension_list" id="dimension_list">

                    </div>
                    <div class="clear"></div>
                    <div class="tab-box">
                        <div class="clear"></div>
                        <ul id="biuuu_city_list">
                            @foreach($data['list'] as $v)
                                <a class="wznr" href="/gh/{{ $v -> id }}" id="m_id88">
                                    <dl>
                                        <dt>
                                            <img src="{{$v -> img}}" alt="">
                                        </dt>
                                        <dd>
                                            <h3>{{ $v -> title }}</h3>
                                            <p>{{ $v -> message }}</p>
                                            <b>
{{--                                                <div class="b-sL">--}}
{{--                                                    <span>{{ $v -> column}}</span>--}}
{{--                                                </div>--}}
                                                <div class="b-sR">
                                                    <span>{{ $v -> author }}</span>
                                                    <span>{{ $v -> crea_at }}</span>
                                                </div>
                                            </b>
                                        </dd>
                                    </dl>
                                </a>
                            @endforeach

                            {{ $data['list'] -> links('Common.pagination')}}
                            <div class="clear"></div>

                        </ul>
                        <div class="clear"></div>
                        <div id="pagge" class="pagge"></div>

                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sectionR">
            <div class="sectionR_two">
                <h2 class="h2">Top5</h2>
                <div class="sectionR_twoUL sectionR_twoUL1">
                    <b class="bj"></b>
                    <div class="clear"></div>
                    <div class="ul">

                        @foreach($data['top'] as $v)
                            <li>
                                <a href="/{{$v -> english }}/list/{{ $v -> id }}" id="like1">{{ $v -> title }}</a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="sectionR_two">
                <h2 class="h2">荐读</h2>
                <div class="sectionR_twoUL sectionR_twoUL2">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach($data['jd'] as $v)
                            <li>
                                <a href="/{{$v -> english }}/list/{{ $v -> id }}">{{ $v -> title }}</a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                        @endforeach

                        {{--                        <a href="/articleList1/industry" class="ckgd">查看更多</a>--}}
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="sectionR_one">
                <b class="bj"></b>

                <div class="gc_bottomRD">
                    <h3><span class="D_Rbspan1">{{$data['magazine'] -> year}}</span>{{$data['magazine'] -> title}}</h3>
                    <h4>邮发代码：80-841</h4><img src="{{$data['magazine'] -> cover_img}}" alt="">
                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>
                    <a href="/gdzz" class="ckgd">更多阅读</a>
                </div>
                <a class="wytg"><span>我要投稿</span></a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </section>
    <div class="clear"></div>
    <div class="gc_bottom">

        @foreach($data['rand'] as $v)
            <div class="gc_bottomL bottomL1">
                <h2 class="h2">{{ $v -> column }}</h2>
                <b class="bj"></b>
                <div class="gc_bottomLUL  ">
                    <div class="ul">

                        @foreach($v -> data as $key => $val)
                            <li id="interview{{$val -> img}}">
                                <a href="/{{ $v -> english }}/list/{{ $val -> id }}">
                                    {{ $val -> title }}

                                </a>
                                <b>作者：<span>{{ $val -> author }}</span></b>
                            </li>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                    <a href="/{{ $v -> english }}/list" class="ckgd">查看更多</a>
                    <div class="clear"></div>
                </div>
            </div>
        @endforeach

        <div class="gc_bottomL gc_bottomL3">
            <h2 class="h2">活动</h2>
            <b class="bj"></b>
            <div class="gc_bottomLUL">
                <div class="ul">

                    <li>
                        <a href="/summit">2019管理会计国际高峰论坛</a>
                        <b>开始时间：<span>2019-09-21</span></b>
                    </li>

                    <li>
                        <a href="/selection">中国本土管理会计2019十大案例评选</a>
                        <b>开始时间：<span>2019-07-15</span></b>
                    </li>

                    <div class="clear"></div>
                </div>
                <a href="/activity" class="ckgd">查看更多</a>
                <div class="clear"></div>
            </div>
        </div>

        {{--        <div class="gc_bottomL bottomL4">--}}
        {{--            <h2 class="h2">活动</h2>--}}
        {{--            <b class="bj"></b>--}}
        {{--            <div class="gc_bottomLUL">--}}
        {{--                <div class="ul">--}}

        {{--                    @foreach($data['activity'] as $v)--}}
        {{--                        <li>--}}
        {{--                            <a href="/activitydesc/{{ $v ->id }}">{{ $v -> title }}</a>--}}
        {{--                            <b>开始时间：<span>{{ $v -> start_at }}</span></b>--}}
        {{--                        </li>--}}
        {{--                    @endforeach--}}

        {{--                    <div class="clear"></div>--}}
        {{--                </div>--}}
        {{--                <a href="/activity" class="ckgd">查看更多</a>--}}
        {{--                <div class="clear"></div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
</div>
<img src="img/0002.png" alt="" class="yd"></body>
@include('Pc.layout.footer')
</html>
<!-- 公共 js -->
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
{{--<script src="/static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}
<script type="text/javascript" src="/static/js/gt.js"></script>
<!--  -->
{{--<script src="static/json/sjlist.js" type="text/javascript" charset="utf-8"></script>--}}
<!-- 我要投稿 -->
<script type="text/javascript" src="/static/picJs/wytg.js"></script>
<script src="/static/picJs/ydheader.js" type="text/javascript" charset="utf-8"></script>
<script>
    $('#tab .tab-menu h2').live("click", function () {
        $('.dimension_list').hide();
        $('.sectionLb ol#two_title li').css({"color": "#848484", "border-bottom": "none"})
        $.ajax({
            url: '/sonColumn',
            data: {column_id:{{ $data['column']['id'] }}},
            dataType: 'json',
            type: 'get',
            success: function (data) {
                // console.log(data)
                //调用分页
                $.each(data.data.list, function (k, v) {
                    layui.use(['laypage', 'layer'], function () {
                        var laypage = layui.laypage,
                            layer = layui.layer;
                        laypage.render({
                            elem: 'pagge',
                            limit: 6,
                            count: data.data.list.length,
                            layout: ['prev', 'page', 'next', 'skip', 'count'],
                            theme: '#d82a39',
                            jump: function (obj) {
                                document.getElementById('biuuu_city_list').innerHTML = function () {
                                    var arr = [],
                                        thisData = data.data.list.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                    layui.each(thisData, function (index, item) {
                                        var html = '';
                                        html += "<a class=\"wznr\" href=\"/" + item.english + "/list/" + item.id + "\" id=\"m_id\">\n" +
                                            "<dl>\n" +
                                            "<dt>\n" +
                                            "<img src=\"" + item.img + "\" alt=\"\">\n" +
                                            "</dt>\n" +
                                            "<dd>\n" +
                                            "<h3>" + item.title + "</h3>\n" +
                                            "<p>" + item.message + "</p>\n" +
                                            "<b>\n" +
                                            "<div class=\"b-sL\">\n" +
                                            "<span>" + item.column + "</span>\n" +
                                            "</div>\n" +
                                            "<div class=\"b-sR\">\n" +
                                            "<span>" + item.author + "</span>\n" +
                                            "<span>" + item.crea_at + "</span>\n" +
                                            "</div>\n" +
                                            "</b>\n" +
                                            "</dd>\n" +
                                            "</dl>\n" +
                                            "</a>";
                                        arr.push(html);
                                    });
                                    return arr.join('');
                                }();
                            }
                        })
                    })
                })
            }
        })
    })
</script>

