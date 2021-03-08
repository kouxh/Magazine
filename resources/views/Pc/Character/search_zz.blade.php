{{--著作搜索结果页--}}
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $data['column']['search']['title'] }}</title>
    <meta name="description" content="{{ $data['column']['search']['column'] }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <!-- 公共css -->
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <!--  -->
    <link rel="stylesheet" type="text/css" href="/static/css/technology.css" />
</head>
@include('Pc.layout.header')
<body>
{{--<script src="static/picJs/header.js" type="text/javascript" charset="utf-8"></script>--}}
<div class="wapper" id="wapper">
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg"  href="https://www.yuanian.com/gz/hdfm/1786/">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="sectionL">
            <b class="bj"></b>
            <div class="sectionLb caseA">
                <div class="tab">
                    <div class="tab-menu search">
                        <h2>搜索<span>{{$data['keyword']}}</span>的结果：</h2>
                    </div>
                    <div class="clear"></div>
                    <div class="tab-box">
                        <div class="div div1">
                            <div class="clear"></div>
                            <ul id="biuuu_city_list">
                                @foreach($data['list'] as $v)
                                    <a class="wznr search" href="/{{ $v -> english }}/list/{{ $v -> id }}" id="m_id88">
                                        <dl>
                                            <dd>
                                                <h3>{{ $v -> title }}</h3>
                                                <p>{{ $v -> message }}</p>
                                                <b>
                                                    <div class="b-sL">
                                                        <span>{{ $v -> column}}</span>
                                                    </div>
                                                    <div class="b-sR">
                                                        <span>{{ $v -> author }}</span>
                                                        <span>{{ $v -> crea_at }}</span>
                                                    </div>
                                                </b>
                                            </dd>
                                        </dl>
                                    </a>
                                @endforeach
                                {{ $data['list'] -> appends(['type' => $data['type'] , 'keyword' => $data['keyword']]) -> links('Common.pagination')}}

                            </ul>
                            <div class="clear"></div>

                        </div>
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

                <a class="wytg">我要投稿</a>
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
{{--<img src="img/0002.png" alt="" class="yd">--}}
</body>
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
<script type="text/javascript" src="/static/picJs/wytg.js"> </script>
<script src="/static/picJs/ydheader.js" type="text/javascript" charset="utf-8"></script>
