<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $data['content'] -> title }} - 管理会计研究</title>
    <meta name="keywords" content="{{ $data['content'] -> keyboard }}">
    <meta name="description" content="{{ $data['content'] -> message }}" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" type="text/css" href="/static/picss/theory_C.css" />
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/paging.css">
    <link rel="stylesheet" href="/static/picss/wzZt.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
</head>
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
        <script src="/static/picJs/sectionlLeft.js" type="text/javascript" charset="utf-8"></script>
            <main class="sectionc">
                <h1>{{ $data['content'] -> title }}</h1>
                <div class="theory_p1">
                    <span class="author">{{ $data['content'] -> author }} </span>
                    <a class="Title" href="/gh">干货</a>
                    <span class="time">{{ $data['content'] -> crea_at }}</span>
                </div>
                <div class="box">
                    <div class="Article page" id="Article">
                     <?php echo $data['content'] -> content ?>
{{--                <div class="Article">{{ $data['content'] -> content }}<div class="clear"></div></div>--}}
                    </div>
                </div>
                <div class="buttons">
                    <a href="javascript:void(0)" class="prev disable">上一页</a><span class="active">1</span><a href="javascript:void(0)" class="next">下一页</a>
                </div>
                <div class="bimain" id="div"><img src="" id="worldMap" border="0" alt="" class="bigimg"
                                                  style="display: none;"></div>
                <div class="mask" style="display: none;">
                    <img src="/static/img/cancel.png">
                </div>
            </main>
        <div class="sectionR">
            <div class="sectionR_two xgwz">
                <h2 class="h2">相关文章</h2>
                <div class="sectionR_twoUL sectionR_twoUL1">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach($data['relevant'] as $v)
                            <li><a href="/{{ $v -> english }}/list/{{ $v['id'] }}"> {{ $v -> title }}</a></li>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <!-- 下一篇文章 -->
            {{--                <div class="Chapter">--}}
            {{--                    <div class="wzcemter">--}}
            {{--                        <div class="line_bj"></div>--}}
            {{--                        <div class="wzcemterCenter">--}}
            {{--                            <p>下一篇</p>--}}
            {{--                            <span class="line"></span>--}}
            {{--                            <div class="strip"><a id="" target="_blank"> 以史为鉴，预见财会的未来以史为鉴，预见财会的未来</a><b>2019-06-12</b></div>--}}
            {{--                        </div>--}}

            {{--                    </div>--}}
            {{--                </div>--}}
            <div class="sectionR_two">
                <h2 class="h2">猜你喜欢</h2>
                <div class="sectionR_twoUL sectionR_twoUL2">
                    <b class="line_bj"></b>
                    <div class="ul">

                        @foreach($data['like'] as $v)
                            <li><a href="/{{ $v -> english }}/list/{{ $v['id'] }}"> {{ $v -> title }}</a></li>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="sectionR_one">
                <b class="bj"></b>
                <div class="gc_bottomRD">

                    <h3><span class="D_Rbspan1">{{ $data['magazine'] -> year }}</span>{{ $data['magazine'] -> title }}</h3>
                    <h4>邮发代码：80-841</h4><img src="{{ $data['magazine'] -> cover_img }}" alt="">
                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>
                    <a href="/gdzz" class="ckgd">更多阅读</a>

                </div>
                <a  class="wytg"><span>我要投稿</span></a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </section>
</div>
@include('Pc.layout.article')
</body>
@include('Pc.layout.footer')
</html>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
{{--<script src="/static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}
<script type="text/javascript" src="/static/js/gt.js"></script>
{{--<script src="static/json/yjxwwz.js"></script>--}}
<!-- 我要投稿 -->
<script type="text/javascript" src="/static/picJs/wytg.js"> </script>
<script type="text/javascript" src="/static/picJs/ydheader.js"> </script>

<script type="text/javascript" src="/static/js/Fp.js"> </script>
<script type="text/javascript" src="/static/layui/layui.js"> </script>
<script src="/static/js/wz/pc_yd.js" type="text/javascript"></script>
<script type="text/javascript">
    var map = new SpryMap({
        id: "worldMap",
        height: "100%",
        width: 800,
        startX: 200,
        startY: 200,
        cssClass: "mappy"
    });
</script>