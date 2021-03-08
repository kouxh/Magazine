<html>
<head>
    {{-- 研究领域的搜索结果--}}
    <meta charset="UTF-8"/>
    <title></title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="/static/picss/pic.css">
    <!--  -->
    <link rel="stylesheet" type="text/css" href="/static/css/technology.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/rw_list.css"/>

</head>
<body>
<div class="wapper" id="wapper">
    @include('Pc.layout.header')
    <!-- 广告位 -->
        <div class="Home-section2">
            <img src="{{ $data['column'] -> Pc_advert }}" alt="" class="pc">
            <img src="{{ $data['column'] -> App_advert }}" alt="" class="yd">
            <a class="Home-section2-bg" href="{{ $data['column'] -> Pc_advert_url }}">
                <span class="gb"></span>
            </a>
        </div>
    <section>
        <div class="sectionL">
            <b class="bj"></b>
            <div class="sectionLb caseA">
                <div class="tab">
                    <div class="tab-menu ">
                        <h2>搜索<span>{{ $data['keyword'] }}</span>领域的结果</h2>
                    </div>
                    <div class="clear"></div>
                    <div class="tab-box">
                        <ul id="biuuu_city_list">
                            @foreach($data['list'] as $v)

                                <a class="wznr" href="/rw/{{ $v -> id }}" id="m_id88">
                                    <dl>
                                        <dt style="width: 200px;">
                                            <img src="{{ $v -> photo }}" alt="">
                                        </dt>
                                        <dd style="width: 472px;">
                                            <h4><span class="character">{{ $v -> name }}</span><span
                                                        class="post"> （{{ $v -> post }}）</span></h4>
                                            <p class="research_field"><span class="_field-title">研究领域：</span>
                                                @foreach($v -> research as $val)
                                                    <span class ="_field">{{ $val -> title }}</span>
                                                @endforeach
                                            </p>
                                            <div class="research_field Golden_sentence">
                                                <span class="clear"></span>
                                                <span class="sentence">{{ $v -> golden }}</span>
                                            </div>

                                        </dd>
                                    </dl>
                                </a>
                            @endforeach
                            {{ $data['list'] -> appends(['type' => $data['type'] , 'keyword' => $data['keyword']]) -> links('Common.pagination')}}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionR">
            <div class="sectionR_two">
                <h2 class="h2">Top5</h2>
                <div class="sectionR_twoUL sectionR_twoUL1">
                    <b class="bj"></b>
                    <div class="clear"></div>
                    <div class="ul">

                        @foreach($data['top'] as $val)
                            <li>
                                <a href="/{{ $val -> column }}/list/{{ $val -> id }}" id="like1">{{ $val -> title }}</a>
                                <b>作者：<span>{{ $val -> author }}</span></b>
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
</div>
@include('Pc.layout.footer'){{--页脚--}}
</body>
</html>
<!-- 公共 js -->
<script type="text/javascript" src="/staticjs/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/staticjs/jquery.1.7.2.min.js"></script>
<script src="/staticlayui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="/staticjs/index_pc.js" type="text/javascript" charset="utf-8"></script>
<script src="/staticpicJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/gt.js"></script>
<!--  -->
<script src="/static/json/allist.js" type="text/javascript" charset="utf-8"></script>
<!-- 我要投稿 -->
<script type="text/javascript" src="/static/picJs/wytg.js"></script>
<script type="text/javascript">
    $('.city-info').on('click', function () {
        $('.select-down-div2').toggle();
        $('.select-down-div2 ul li').on('click', function () {
            $(this).addClass('on').siblings().removeClass('on')
            var City = $(this).text();
            $('.city-info .region').html(City)
            $('.city-present .city').html(City)
        })
    });

</script>