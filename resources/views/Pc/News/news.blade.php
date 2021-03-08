<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>业界新闻-管理会计研究</title>
    <meta name="description" content="" />
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
<h3>{{ $data['column']['id'] }}</h3>
<script src="/static/picJs/header.js" type="text/javascript" charset="utf-8"></script>
<div class="wapper" id="wapper">
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg"  href="{{ $data['column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="sectionL">
            <b class="bj"></b>
            <div class="sectionLb">
                <h2>{{ $data['column']['column'] }}</h2>
                <ul id="biuuu_city_list">

                    @foreach($data['list'] as $v)
                        <a class="wznr" href="/xw/{{ $v -> id  }}" id="m_id88">
                            <dl>
                                <dt>
                                    <img src="{{$v -> img}}" alt="">
                                </dt>
                                <dd>
                                    <h3>{{ $v -> title }}</h3>
                                    <p>{{ $v -> message }}</p>
                                    <b>
                                        <div class="b-sL">
                                            <span>业界新闻</span>
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

                    {{ $data['list'] -> appends(['mode'=>'technigue']) -> links('Common.pagination')  }}

                </ul>
                <div class="clear"></div>

            </div>
        </div>
        <div class="sectionR">
            <div class="sectionR_two">
                <h2 class="h2">猜你喜欢</h2>
                <div class="sectionR_twoUL sectionR_twoUL1">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach($data['like'] as $v)
                            <li>
                                <a href="/articledesc1/{{ $v['id'] }}" id="like1">{{ $v -> title }}</a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="sectionR_two">
                <h2 class="h2">理论前沿</h2>
                <div class="sectionR_twoUL sectionR_twoUL2">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach($data['frontier'] as $v)
                            <li>
                                <a href="/articledesc1/{{ $v['id'] }}">{{ $v -> title }}</a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                        @endforeach

                        <a href="/articleList1/frontier" class="ckgd">查看更多</a>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="sectionR_one">
                <b class="bj"></b>

                <div class="gc_bottomRD">
                    <h3><span class="D_Rbspan1">2019年</span>第四期 总第07期</h3>
                    <h4>邮发代码：80-841</h4>
                    <img src="http://www.chinamas.cn/upload/2019/08/23/15665434883390.png" alt="">
                    <a href="/magazinedesc/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>
                    <a href="/magazine" class="ckgd">更多阅读</a>
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
        <div class="gc_bottomL bottomL1">
            <h2 class="h2">人物</h2>
            <b class="bj"></b>
            <div class="gc_bottomLUL  ">
                <div class="ul">

                    @foreach($data['interview'] as $v)
                        <li>
                            <a href="/articledesc1/{{ $v['id'] }}">{{ $v -> title }}</a>
                            <b>作者：<span>{{ $v -> author }}</span></b>
                        </li>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <a href="/articleList1/interview" class="ckgd">查看更多</a>
                <div class="clear"></div>
            </div>
        </div>
        <div class="gc_bottomL bottomL2">
            <h2 class="h2">观察</h2>
            <b class="bj"></b>
            <div class="gc_bottomLUL">
                <div class="ul">

                    @foreach($data['observation'] as $v)
                        <li>
                            <a  href="/articledesc1/{{ $v['id'] }}">{{ $v -> title }}</a>
                            <b>作者：<span>{{ $v -> author }}</span></b>
                        </li>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <a href="/articleList1/observation" class="ckgd" target="_blank">查看更多</a>
                <div class="clear"></div>
            </div>
        </div>
        <div class="gc_bottomL bottomL3">
            <h2 class="h2">案例研究</h2>
            <b class="bj"></b>
            <div class="gc_bottomLUL">
                <div class="ul">

                    @foreach($data['frontier'] as $v)
                        <li>
                            <a  href="/articledesc1/{{ $v['id'] }}">{{ $v -> title }}</a>
                            <b>作者：<span>{{ $v -> author }}</span></b>
                        </li>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <a href="/articleList1/frontier" class="ckgd">查看更多</a>
                <div class="clear"></div>
            </div>
        </div>
        <div class="gc_bottomL bottomL4">
            <h2 class="h2">活动</h2>
            <b class="bj"></b>
            <div class="gc_bottomLUL">
                <div class="ul">

                    @foreach($data['activity'] as $v)
                        <li>
                            <a href="/activitydesc/{{ $v ->id }}">{{ $v -> title }}</a>
                            <b>开始时间：<span>{{ $v -> start_at }}</span></b>
                        </li>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <a href="/activity" class="ckgd">查看更多</a>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
</div>
<script src="/static/picJs/footer.js" type="text/javascript" charset="utf-8"></script>
</body>
@include('Pc.layout.footer')
</html>
<!-- 公共 css -->
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/static/js/gt.js"></script>
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>
<!--  -->
{{--<script src="static/json/yjxwlist.js"></script>--}}
<!-- 我要投稿 -->
<script type="text/javascript" src="static/picJs/wytg.js"> </script>
<script src="/static/picJs/ydheader.js" type="text/javascript" charset="utf-8"></script>

