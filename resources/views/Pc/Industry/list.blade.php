<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $data['column'] -> title }}</title>
    <meta name="description" content="{{ $data['column'] -> describe }}"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" type="text/css" href="/static/css/yjlist.css"/>
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
</head>
@include('Pc.layout.header')
<body>
<div class="wapper" id="wapper">
    <!-- 广告位置 -->
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>

        <div class="Home-section3">
            <div class="Home-section3_l  D_1">
                <b class="bj"></b>
                <div class="Home-section3_lB Left">
                    <h2>新闻</h2>
                    <div class="section3_lBD ">
                        <ul>
                            @foreach($data['news'] as $k => $v)
                                <li>
                                    <a href="/xw/list/{{ $v -> id }}">{{ $v -> title }}</a>
                                </li>
                            @endforeach

                            <div class="clear"></div>
                        </ul>
                        <a href="/xw/list" class="ckgd">查看更多</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="Home-section3_l  D_1">
                <b class="bj"></b>
                <div class="Home-section3_lB Center">
                    <h2>热点</h2>
                    <div class="section3_lBD ">
                        <ul>

                            @foreach( $data['hotspot'] as $k => $v)
                                <li>
                                    <a href="/rdsj/list/{{ $v -> id }}">{{ $v['title'] }}</a>
                                </li>
                            @endforeach

                            <div class="clear"></div>

                        </ul>
                        <a href="/rdsj/list" class="ckgd">查看更多</a>
                    </div>
                </div>
            </div>
            <div class="Home-section3_l  D_1">
                <b class="bj"></b>
                <div class="Home-section3_lB right">
                    <h2>政策&解读</h2>
                    <div class="section3_lBD">
                        <ul>

                            @foreach( $data['policy'] as $k => $v)
                                <li>
                                    <a href="/zcjd/list/{{ $v -> id }}">{{ $v['title'] }}</a>
                                </li>
                            @endforeach

                            <div class="clear"></div>
                        </ul>
                        <a href="/zcjd/list" class="ckgd">查看更多</a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="Home-section1" id="Home-section1">
            <div class="Home-section1D">
                <div class="Home-section1D_l D_">
                    <h2>文章</h2>
                    <ul class="ul">

                        @foreach($data['recommend'] as $k => $v)
                            <li id="recommend91">
                                <a href="/jd/list/{{ $v -> id }}">{{ $v['title'] }}</a>
                                <b>{{ $v['author'] }}</b>
                            </li>
                        @endforeach


                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="Home-section1D_R D_">
                    <h2>活动</h2>
                    <div class="section5r_lB">
                        <div class="section5r_lB_main">
                            @foreach($data['activity'] as $k => $v)
                                <a href="/hd/{{ $v -> id }}">
                                    <dl>
                                        <dt><img src="{{ $v -> img }}" alt=""></dt>
                                        <dd>{{ $v -> title }}</dd>
                                    </dl>
                                </a>
                            @endforeach
                            <div class="clear"></div>
                        </div>
                        <a href="/hd" class="ck">查看更多</a>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <div class="Home-section4" id="industry_section4">
        <div class="Home-section4_c  D_1" id="limit">
            <h2>人物</h2>
            <b class="bj"></b>
            <div class="Home-section4_cB">
                <ul class="ul">
                    @foreach($data['rw'] as $k => $v)
                        <li id="interview{{$v -> img}}">
                            <a href="/rw/list/{{ $v -> id }}">
                                <img src="{{ $v -> img }}" alt="">
                                <h3>{{ $v -> title }}</h3>
                            </a>
                            <b>作者：<span>{{ $v -> author }}</span></b>
                        </li>
                    @endforeach
                    <a href="/rw/list" class="ckgd">查看更多</a>
                </ul>
            </div>
        </div>

        <div class="Home-section4_l Right ">
            <h2>杂志</h2>
            <div class="bj"></div>
            <div class="section5r_lB">
                <div class="Home-section1D_Rb">
                    <div class="name-box">
                        <span class="D_Rbspan1">{{$data['magazine'] -> year}}</span>
                        <span class="name"> {{$data['magazine'] -> title}} </span>
                    </div>
                    <h4>邮发代码：80-841</h4>
                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="btn_a">马上阅读</a>
                    <img src="{{$data['magazine'] -> cover_img}}" alt="">
                    <a href="/gdzz" class="btn_a2">更多阅读</a>
{{--                    <h3><span class="D_Rbspan1">{{$data['magazine'] -> year}}</span> {{$data['magazine'] -> title}}--}}
{{--                    </h3>--}}
{{--                    <h4>邮发代码：80-841</h4>--}}
{{--                    <img src="{{$data['magazine'] -> cover_img}}" alt="">--}}
{{--                    <a href="/magazinedesc/{{ $data['magazine'] -> m_id }}" class="btn_a">马上阅读</a>--}}
{{--                    <a href="/zz" class="btn_a2">更多阅读</a>--}}

                </div>
            </div>
        </div>

    </div>
</div>
<script>
    //360自动抓取页面
    (function(){
        var src = "https://jspassport.ssl.qhimg.com/11.0.1.js?d182b3f28525f2db83acfaaf6e696dba";
        document.write('<script src="' + src + '" id="sozz"><\/script>');
    })();
</script>
</body>
</html>
@include('Pc.layout.footer')
<script src="/static/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script src="/static/picJs/ydheader.js" type="text/javascript" charset="utf-8"></script>
{{--<script src="static/json/yjlist.js" type="text/javascript" charset="utf-8"></script>--}}
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
