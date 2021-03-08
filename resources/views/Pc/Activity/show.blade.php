<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['hd'] -> title}}</title>
    <meta name="description" content="{{ $data['hd'] -> describe}}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/activity.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/css/paging.css">
</head>
@include('Pc.layout.header')
<body>
<script src="/static/picJs/header.js" type="text/javascript" charset="utf-8"></script>
<div class="wapper">
    <div class="auto-width">
        <div class="feature-head-bottom-left flex">
            <span class="border-line" style=""></span>
            <div class="city-select" style="">
                <p class="city-info flex"><span class="region">{{ $data['city'] }}</span><span class="icon icon-down"></span></p>
                <div class="select-down-div">
                    <div class="select-down-div-item flex city-present-item">
                        <span class="city-type">当前定位城市:</span>
                        <div class="city-present"><a class="city">{{ $data['city'] }}</a></div>
                    </div>
                    <div class="select-down-div-item flex"><span class="city-type">热门城市:</span>
                        <div class="city-list">
                            <a href="javascript:">全国</a>
                            @foreach($data['range'] as $k => $v)
                                <a href="javascript:">{{ $k }}</a>
                            @endforeach
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="Close">x</div>
                </div>
            </div>
        </div>
        <div class="feature-head-bottom-right flex">
            <div class="search-div-wrap">
                <div class="search-div flex">
                    <input class="js-search-input" type="text" placeholder="搜索活动或关键词" value="" />
                    <a class="search-link" ><span class="icon search-top-icon"></span>搜索</a>
                </div>
                <div class="history-list">
{{--                    <a href="javascript:">数据化转型</a>--}}
{{--                    <a href="javascript:">管理会计</a>--}}
{{--                    <a href="javascript:">智能财务</a>--}}
{{--                    <a href="javascript:">财务共享</a>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="banner">
        <a href="{{ $data['hd'] -> Pc_banner_url }}">
            <img src="{{ $data['hd'] -> Pc_banner }}" alt=""class="pc_banner">
            <img src="{{ $data['hd'] -> App_banner }}"  class="app_banner">

        </a>
    </div>
    <section>
        <div class="sectionL">
            <div class="sectionL1">
                <h2 class="sectionL_h2"><span class="span1"></span><span class="span2">推荐活动</span></h2>
                <div class="">

                    @foreach($data['activity'] as $v)
                        <a href="/hd/{{ $v -> id }}" class="hd">
                            <dl>
                                <dt><img src="{{ $v -> img }}" alt="">
                                    <span class="span1">{{ $v -> status }}</span>
                                </dt>
                                <dd>
                                    <h3>{{ $v -> title }}</h3>
                                    <p><span class="span1">{{ $v -> start_at }}</span><span class="span2">{{ $v -> address }}</span></p>
                                </dd>
                            </dl>
                        </a>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <a href="/gdhd" class="gdhd">更多活动</a>
{{--                <a href="" class="gdhd">更多活动</a>--}}
                <div class="clear"></div>
            </div>
            <div class="sectionL2" >
                <h2 class="sectionL_h2"><span class="span1"></span><span class="span2">精彩瞬间</span></h2>
                <b class="bj"></b>
                <div class="Home-section4_c  D_1" id="jcsj">
                    <div class="Home-section4_cB">
                        <ul class="ul">

                            @foreach( $data['moment'] as $v)
                                <li id="">
                                    <a href="/xw/{{ $v -> id }}">
                                        <img src="{{ $v -> img }}" alt="">
                                        <h3>{{ $v -> title }}</h3>
                                    </a>
                                    <b>作者：<span>{{ $v -> author }}</span></b>
                                </li>
                            @endforeach

{{--                            <a href="/hd" class="ckgd" style="float: right;">查看更多</a>--}}
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
{{--                <a href="" class="gdhd">更多活动</a>--}}
            </div>
            <div class="sectionL3 sectionL1">
                <div class="tab">
                    <div class="tab-menu sectionL_h2">
                        <!-- <h2 class="">案例研究</h2> -->
                        <ul>
                            <li class="change">主办</li>
                            <li>合办</li>
                            <li>其他</li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div class="tab-box">
                        <div class="div">

                            @foreach( $data['host'] as $v)
                                <a href="/hd/{{ $v -> id }}" class="hd">
                                    <dl>
                                        <dt><img src="{{ $v -> img }}" alt="">
                                            <span class="span1">{{ $v -> status }}</span>
                                        </dt>
                                        <dd>
                                            <h3>{{ $v -> title }}</h3>
                                            <p><span class="span1">{{ $v -> start_at }}</span><span class="span2">{{ $v -> address }}</span></p>
                                        </dd>
                                    </dl>
                                </a>
                            @endforeach

                        </div>
                        <div class="div">

                            @foreach( $data['co_sponsor'] as $v)
                                <a href="/hd/{{ $v -> id }}" class="hd">
                                    <dl>
                                        <dt><img src="{{ $v -> img }}" alt="">
                                            <span class="span1">{{ $v -> status }}</span>
                                        </dt>
                                        <dd>
                                            <h3>{{ $v -> title }}</h3>
                                            <p><span class="span1">{{ $v -> start_at }}</span><span class="span2">{{ $v -> address }}</span></p>
                                        </dd>
                                    </dl>
                                </a>
                            @endforeach

                        </div>
                        <div class="div">

                            @foreach( $data['other'] as $v)
                                <a href="/hd/{{ $v -> id }}" class="hd">
                                    <dl>
                                        <dt><img src="{{ $v -> img }}" alt="">
                                            <span class="span1">{{ $v -> status }}</span>
                                        </dt>
                                        <dd>
                                            <h3>{{ $v -> title }}</h3>
                                            <p><span class="span1">{{ $v -> start_at }}</span><span class="span2">{{ $v -> address }}</span></p>
                                        </dd>
                                    </dl>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionR" >
            <div class="sectionR_two">
                <h2 class="h2">活动新闻</h2>
                <div class="sectionR_twoUL">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach($data['news'] as $v)
                            <li>
                                <a href="/xw/list/{{ $v -> id }}"> {{ $v -> title }} </a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                        @endforeach

                        <a href="/xw/list" class="ckgd">查看更多</a>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="sectionR_two">
                <h2 class="h2">专业内容</h2>
                <div class="sectionR_twoUL">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach( $data['food'] as $v)
                            <li>
                                <a href="/gh/{{ $v -> id }}"> {{ $v -> title }}</a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                        @endforeach

                        <a href="/gh" class="ckgd">查看更多</a>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="sectionR_one">
                <b class="bj"></b>
{{--                <div class="gc_bottomRD">--}}
{{--                    <h3><span class="D_Rbspan1">{{$data['magazine'] -> year}}</span>{{$data['magazine'] -> title}}</h3>--}}
{{--                    <h4>邮发代码：80-841</h4><img src="{{$data['magazine'] -> cover_img}}" alt="">--}}
{{--                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>--}}
{{--                    <a href="/gdzz" class="ckgd">更多阅读</a>--}}
{{--                </div>--}}
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

    </section>
</div>
<div class="clear"></div>
<!-- <script src="picJs/footer.js" type="text/javascript" charset="utf-8"></script> -->
</body>
</html>
@include('Pc.layout.footer')
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
{{--<script src="/static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}

<!--  搜索  -->
<script>
    $('.search-link').on('click' , function(){
        var city = $('.city').html();
        var keyword = $('.js-search-input').val();
        location.href="/searchhd?city="+city+"&keyword="+keyword;

    })
</script>

 <script type="text/javascript" charset="utf-8">
	$('.city-info').on('click', function() {
		$('.select-down-div').toggle();
        $('.city-list a').on('click',function () {
               var City=$(this).text();
            $('.city-info .region').html(City)
            $('.city-present .city').html(City)
        })
	});
	$().ready(function() {
		$(".tab-menu li").click(function(index) {
			//通过 .index()方法获取元素下标，从0开始，赋值给某个变量
			var _index = $(this).index();
			//让内容框的第 _index 个显示出来，其他的被隐藏
			$(".tab-box>div").eq(_index).show().siblings().hide();
			//改变选中时候的选项框的样式，移除其他几个选项的样式
			$(this).addClass("change").siblings().removeClass("change");
		});
	});
//	关闭
     $('.Close').on('click',function () {
         $('.select-down-div').hide()
     })
</script>
