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
                            {{--                            @if(!empty($data['son_column']))--}}
                            {{--                                @foreach($data['son_column'] as $v)--}}
                            {{--                                    <li onclick="getDimension({{ $v -> id }})">{{ $v -> column }}</li>--}}
                            {{--                                @endforeach--}}
                            {{--                            @endif--}}
                        </ol>
                    </div>
                    <div class="dimension_list" id="dimension_list">
                    </div>
                    <div class="clear"></div>
                    <div class="tab-box">
                        <div class="clear"></div>
                        <ul id="biuuu_city_list">
                            @foreach($data['list'] as $v)
                                <a class="wznr" href="/{{ $v -> english }}/list/{{ $v -> id }}" id="m_id88">
                                    <dl>
                                        <dt>
                                            <img src="{{$v -> img}}" alt="">
                                        </dt>
                                        <dd>
                                            <h3>
                                                @if($v -> price)
                                                    <span class="Pay" id="Pay">付费</span>{{ $v -> title }}
                                                @else
                                                    {{ $v -> title }}
                                                @endif
                                            </h3>
                                            <p>{{ $v -> message }}</p>
                                            <b>
                                                <div class="b-sL">
                                                    <span>{{ $v -> author }}</span>
                                                    <span>{{ $v -> author_post}}</span>
                                                </div>
                                                <div class="b-sR">
                                                    <span>{{ $v -> crea_at }}</span>
                                                </div>
                                            </b>
                                        </dd>
                                    </dl>
                                </a>
                            @endforeach

                            {{ $data['list'] -> links('Common.pagination') }}
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
                    <div class="name-box">
                        <span class="D_Rbspan1">{{$data['magazine'] -> year}}</span>
                        <span class="name"> {{$data['magazine'] -> title}} </span>
                    </div>
                    <h4>邮发代码：80-841</h4>
                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>
                    <img src="{{$data['magazine'] -> cover_img}}" alt="">
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
        <div class="gc_bottomL bottomL4">
            <h2 class="h2">活动</h2>
            <b class="bj"></b>
            <div class="gc_bottomLUL">
                <div class="ul">

                    @foreach($data['activity'] as $v)
                        <li>
                            <a href="/hd/{{ $v ->id }}">{{ $v -> title }}</a>
                            <b>开始时间：<span>{{ $v -> start_at }}</span></b>
                        </li>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <a href="/hd" class="ckgd">查看更多</a>
                <div class="clear"></div>
            </div>
        </div>
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
<script type="text/javascript" src="/static/js/gt.js"></script>
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
<script>
    $(document).ready(function () {
        // alert("aa");
        $.ajax({
            url: '/sonColumn',
            data: {column_id:{{ $data['column']['id'] }}},
            dataType: 'json',
            type: 'get',
            success: function (data) {
                // console.log(data.data)
                // return false;
                if (data.data.join_dimension != 2) {

                    if (data.data.hy) {
                        var html = "<div class=\"wendu \"><h3 onclick=\"dimension('hy' , {{ $data['column']['id'] }})\">行业</h3>";
                        $.each(data.data.hy, function (k, v) {
                            html += '<h4 onclick="hySonDimension(' + v.id + ' ,{{ $data['column']['id'] }})">' + v.title + '</h4>'
                        })
                        html += '</div>'
                        $('.dimension_list ').html(html);

                        var zyhtml = "<div class=\"wendu\"><h3 onclick=\"dimension('zy' , {{ $data['column']['id'] }})\">专业</h3>";
                        $.each(data.data.zy, function (k, v) {
                            zyhtml += '<h4 onclick="zySonDimension(' + v.id + ' ,{{ $data['column']['id'] }})">' + v.title + '</h4>'
                        })
                        zyhtml += '</div>'
                        $('.dimension_list .wendu').before(zyhtml);
                    } else if (data.data.son_column != 0) {
                        // console.log(data.data)
                        var html = "";
                        $.each(data.data.son_column, function (k, v) {
                            html += '<li onclick="getDimension(' + v.id + ')" id=' + v.id + '>' + v.column + '</li>'
                        })
                        html += '</div>'
                        $('.two_title ').html(html);
                    } else {
                        $('.two_title').hide();
                    }


                }


            }
        })
    });
</script>

<script>
    //文库点击
    hy = 0;

    /*点击获取维度*/
    function getDimension(son_dimension_id) {
        $('#' + son_dimension_id + '').css({
            "color": "#141718",
            "border-bottom": "1px solid #424445"
        }).siblings().css({"color": "#848484", "border-bottom": "none"});
        $.ajax({
            url: '/sonColumn',
            data: {column_id: son_dimension_id},
            dataType: 'json',
            type: 'get',
            success: function (data) {
                // console.log(data.data);
                // return false;
                if (data.data.zy) {
                    $('.dimension_list').show();
                    var html = "<div class=\"wendu \"><h3 onclick=\"dimension('hy' , " + son_dimension_id + ")\">行业</h3>";
                    $.each(data.data.hy, function (k, v) {
                        html += '<h4 onclick="hySonDimension(' + v.id + ',' + son_dimension_id + ')">' + v.title + '</h4>'
                    })
                    html += '</div>'
                    $('.dimension_list ').html(html);

                    var zyhtml = "<div class=\"wendu\"><h3 onclick=\"dimension('zy' , " + son_dimension_id + ")\">专业</h3>";
                    $.each(data.data.zy, function (k, v) {
                        zyhtml += '<h4 onclick="zySonDimension(' + v.id + ',' + son_dimension_id + ')">' + v.title + '</h4>'
                    })
                    zyhtml += '</div>'
                    $('.dimension_list .wendu').before(zyhtml);
                    $.each(data.data.list, function (k, v) {
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            laypage.render({
                                elem: 'pagge',
                                limit: 5,
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
                    if (data.data.list == 0) {
                        var html = "<p class='NO_list'>没有相关信息</p>"
                        $('#biuuu_city_list ').html(html);

                    }
                } else if (data.data.list != 0) //没维度有列表
                {
                    //
                    var html = "";
                    $('.dimension_list ').html(html);
                    // alert("没有维度,只循环列表");
                    // console.log(----------------)
                    // console.log(data.data.list.data)
                    $.each(data.data.list, function (k, v) {
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            laypage.render({
                                elem: 'pagge',
                                limit: 5,
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
                } else {
                    var html = "<p class='NO_list'>没有相关信息</p>"
                    $('#biuuu_city_list').html(html);

                }
            }
        })
    }

    /*获取子维度下的文章*/
    function dimension(obj, son_dimension_id) {
        $.ajax({
            url: '/dimensionList',
            data: {'dimension': obj, 'column_id': son_dimension_id},
            dataType: 'json',
            type: 'get',
            success: function (data) {
                // console.log(data);
                // return false;
                $.each(data.data.list, function (k, v) {
                    layui.use(['laypage', 'layer'], function () {
                        var laypage = layui.laypage,
                            layer = layui.layer;
                        laypage.render({
                            elem: 'pagge',
                            limit: 5,
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
    }

    /*获取行业维度下的文章*/
    function hySonDimension(id, son_dimension_id) {
        // console.log(son_dimension_id);
        hy = id;
        $.ajax({
            url: '/dimensionList',
            data: {'son_dimension': hy, 'column_id': son_dimension_id},
            dataType: 'json',
            type: 'get',
            success: function (data) {
                // console.log(data.data)
                if (data.data.list == 0) {
                    var html = "<p class='NO_list'>没有相关信息</p>"
                    $('#biuuu_city_list').html(html);
                } else {
                    $.each(data.data.list, function (k, v) {
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            laypage.render({
                                elem: 'pagge',
                                limit: 5,
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
                    // console.log(data)
                }
            }
        })
    }

    /*获取专业维度下的文章*/
    function zySonDimension(id, son_dimension_id) {
        $.ajax({
            url: '/dimensionList',
            data: {'hy': hy, 'son_dimension': id, 'column_id': son_dimension_id},
            dataType: 'json',
            type: 'get',
            success: function (data) {
                // return false;
                // console.log(data)
                if (data.data.list == 0) {
                    var html = "<p class='NO_list'>没有相关信息</p>"
                    $('#biuuu_city_list').html(html);
                } else {
                    $.each(data.data.list, function (k, v) {
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            laypage.render({
                                elem: 'pagge',
                                limit: 5,
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
                    // console.log(data)
                }
            }
        })
    }

</script>
<script>
    if (!$('.Pay').html() == "") {
        $(" .Pay").show();
    } else {
        $(".Pay").css("display,", " none");
    }
</script>
<script>
    {{-- 观察列表人物头像不一致  修改--}}

    if ("{{ $data['column']['column'] }}" == "观察") {
        var widths = $(window).width();
        if (widths <= 1024) {
            $('.sectionLb .wznr dl').css("cssText", "height:82px !important;")
            $('.sectionLb .wznr dl dt').css("cssText", "width:27% !important; height:auto !important");
            $('.sectionLb .wznr dl dt img').css("cssText", " height:auto !important");
            $('.sectionLb .wznr dl dd').css("cssText", "width: 68% !important;")


        } else {
            $('#biuuu_city_list  a dl dt').css({
                width: "200px"
            });
            $('#biuuu_city_list  a dl dd').css({
                width: "472px"
            });
        }

    }

</script>