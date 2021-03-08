<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['hd'] -> title}}</title>
    <meta name="description" content="{{ $data['hd'] -> describe}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="/static/css/activity_content.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/css/paging.css">
    <script type="text/javascript">
        window.HOST_TYPE='2'
    </script>
    <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=Cc0HVG4M44aciHLu35m27CjXGKkYbQ1U&s=1"></script>
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script><!--调用jQuery-->
<body>
@include('Pc.layout.header')
<div class="wapper">
    <div class="conter">
        <dl>
            <dt><img src="{{ $data['desc'] -> img  }}" alt=""></dt>
            <dd>
                <h3>{{ $data['desc'] -> title }} </h3>
                <div class="p1">
                    <span>{{ $data['desc'] -> start_at }}  -  {{ $data['desc'] -> end_at }}</span><span class="Number">限制  <b>{{ $data['desc'] -> limit_num }}</b>人</span>
                    <p class="_address"><span class="Active_address">{{ $data['desc'] -> address }}</span>
                    <span class="Detailed_address">{{ $data['desc'] -> desc_address }} </span></p>

                </div>
                <p>主办：<span>{{ $data['desc'] -> host }}</span></p>
                <p class="hidden">协办：<span>{{ $data['desc'] -> co_sponsor }}</span></p>
                <p><a href="{{ $data['desc'] -> sign_address }}" class="bm">{{ $data['desc'] -> status }}</a> <span class="span_l"><a href="">收藏</a>/<a
                                href="">分享</a></span></p>
            </dd>
        </dl>
    </div>
    <section>
        <div class="sectionL">
            <h2 class="sectionL_h2">
                <span class="span1"></span>
                <span class="span2">活动票种</span>

                @if($data['desc'] -> ticket == 0)
                    <span class="span3">免费票</span>
                @else
                    <span class="span3">收费票</span>
                @endif

            </h2>

            <p class="xt"></p>
            <div class="sectionL_1">
                <h2 class="section_H2">活动详情描述</h2>
                <div class="Activity_details ">
                    <div class="Activity_describe"><?php echo $data['desc']->describe ?></div>
{{--                    <p class="Activity_describe">{{ $data['desc'] -> describe }}</p>--}}
                    <div class="Activity_center Activity_One">
                        <p class="Activity_title">议程</p>
                        <p class="Activity_describe agenda"><img src="{{ $data['desc'] -> agenda }}" alt=""></p>
{{--                        agenda--}}
                    </div>
                    <div class="Activity_center Activity_two">
                        <p class="Activity_title">嘉宾</p>
                        <div class="pic">
                            <div class="inner">
                                <!--内容1-->
                                <div class="lnr1">
                                    @foreach( $data[ 'guest'] as $k => $v)
{{--                                        @if($v -> join_character == 2)--}}
{{--                                            <a href="/rw/{{ $v -> id }};" class="two" rel="nofollow" id="{{ $v -> id }}">--}}
{{--                                        @else--}}
                                            <a href="javascript:void(0);" class="two" rel="nofollow" id="{{ $v -> id }}">
{{--                                        @endif--}}
                                            <dl>
                                                <dt> <img src="{{ $v -> photo }}" alt=""></dt>
                                                <dd>
                                                    <p class="name">{{ $v -> name }}</p>
                                                    <p class="position">{{ $v -> post }}</p>
                                                </dd>
                                            </dl>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                            <div class="clear"></div>
                            <!--左右切换-->
                            <a href="javascript:" class="prev"><img src="https://www.yuanian.com//ynhy/huodong/simg/left.png"
                                                          alt=""></a>
                            <a href="javascript:" class="next"><img src="https://www.yuanian.com//ynhy/huodong/simg/right.png"
                                                          alt=""></a>

                        </div>

                    </div>
                    <div class="Activity_center Activity_Three">
                        <p class="Activity_title">注意事项</p>
                        <p class="Activity_describe">{{ $data['desc'] -> careful }}</p>

                    </div>
                    <div class="Activity_center Activity_Four">
                        <p class="Activity_title">联系人</p>
                        <p class="Activity_describe">{{ $data['desc'] -> contacts }}</p>

                    </div>
                </div>
            </div>
            {{--精彩内容--}}
            <div class="sectionL_2 Marvellous">
                <h2 class="section_H2">精彩内容</h2>
                <div class="Marvellous_content">
                    <ul>
                        {{--                        @foreach($data['news'] as $v)--}}
                        {{--                            <li>【活动新闻】{{ $v -> title }}<span>{{ $v -> crea_at }}</span><span>{{ $v -> author }}</span></li>--}}
                        {{--                        @endforeach--}}

                        @foreach($data['food'] as $v)
                            <li><a href="/gh/{{ $v -> id }}"><span class="Label">专业内容</span>
                                    <p>{{ $v -> title }}</p><span class="time">{{ $v -> crea_at }}</span></a></li>
                        @endforeach
                        @foreach($data['news'] as $v)
                            <li><a href="/xw/{{ $v -> id }}"><span class="Label">活动新闻</span>
                                    <p>{{ $v -> title }}</p><span class="time">{{ $v -> crea_at }}</span></a></li>
                            {{--{{ $v -> author }} 作者--}}
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="sectionL_3 Recommend">
                <h2 class="section_H2">推荐文章</h2>
                <ul class="Recommend_center">
                    @foreach($data['article'] as $v)
                        <li><a href="/{{ $v -> english }}/list/{{ $v -> id }}">{{ $v -> title }}</a></li>
                    @endforeach
                </ul>
                <div class="clear"></div>
            </div>
            {{--            <div class="sectionL_3">--}}
            {{--                <h2 class="section_H2">您还可能感兴趣</h2>--}}

            {{--                @foreach( $data['relevant'] as $v)--}}
            {{--                    <a href="/activitydesc/{{ $v -> id }}" target="_blank" class="hd">--}}
            {{--                        <dl>--}}
            {{--                            <dt><img src="{{ $v -> img }}" alt="">--}}
            {{--                            </dt>--}}
            {{--                            <dd>--}}
            {{--                                <h3>{{ $v -> title }}</h3>--}}
            {{--                                <p><span class="span1">{{ $v -> start_at }}</span><span class="span2">{{ $v -> address }}</span></p>--}}
            {{--                            </dd>--}}
            {{--                        </dl>--}}
            {{--                    </a>--}}
            {{--                @endforeach--}}


            {{--                <div class="claer"></div>--}}
            {{--            </div>--}}
            <div class="claer"></div>
            {{--            <div class="sectionL_4">--}}
            {{--                <h2 class="section_H2">活动详情描述</h2>--}}
            {{--                <!-- <input type="text"> -->--}}
            {{--                <div class="textarea form-control">--}}
            {{--                    <textarea id="comment_text_box" placeholder="评论区"></textarea>--}}
            {{--                </div>--}}
            {{--                <button type="button" class="tj">提交</button>--}}
            {{--                <div class="clear"></div>--}}
            {{--            </div>--}}
            {{--            <div class="sectionL_4 two">--}}
            {{--                <h2 class="section_H2">全部讨论</h2>--}}
            {{--                <!-- <input type="text"> -->--}}
            {{--                <div class="textarea form-control">--}}
            {{--                    <textarea id="comment_text_box" placeholder="评论区"></textarea>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="sectionR">
            <!-- 活动地点 -->
            <div class="sectionR_1">

                <div class="dt_xx">
                    <h2 class="h2 xs">活动地点</h2>
                    <div class="dt">
                        <div id="allmap" style="height:100%"></div>
                    </div>
                    <p class="activity_place" id="activity_place"></p>
                </div>
                <div class="erwm" style="display: none">
                    <h2  class="h2 xx" >扫码参与活动</h2>
                    <div class="erwm_bj">
                        <img src="{{ $data['desc'] -> uppercode }}" alt="">
                    </div>
                    <a class="xsmf">限时免费</a>
                </div>
            </div>
            <!-- 主办方简介 -->
            <div class="sectionR_2">
                <div class="sectionR_two">
                    <h2 class="h2">主办方简介</h2>
                    <b class="bj"></b>
                    <div class="Activity_introduce">
                        <p>
                            {{ $data['desc'] -> sponsor_desc }}
                        </p>

                        {{--                        <b class="bj"></b>--}}
                        {{--                        @foreach($data['host'] as $v)--}}
                        {{--                        <dl>--}}
                        {{--                            <dt><img src="{{ $v -> img }}" alt=""></dt>--}}
                        {{--                            <dd>--}}
                        {{--                                <h3>{{ $v -> title }}</h3>--}}
                        {{--                                <p> {{ $v -> describe }}</p>--}}
                        {{--                            </dd>--}}
                        {{--                        </dl>--}}
                        {{--                        @endforeach--}}

                    </div>
                </div>
                <div class="More">
                    <h2 class="h2">更多活动</h2>
                    <b class="bj"></b>
                    <div class="More_center">
                        @foreach($data['relevant'] as $v)
                            <a href="/hd/{{ $v -> id }}">
                                <dl>
                                    <dt><img src="{{ $v -> img }}" alt=""></dt>
                                    <dd>
                                        <p class="More_title">{{ $v -> title }}</p>
                                        <p><span class="More_time">11月18日 1:21</span><span class="More_place">北京</span>
                                        </p>
                                    </dd>
                                </dl>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

            {{--            @if(!$data['news'])--}}
            {{--                <div class="sectionR_3">--}}
            {{--                    <div class="sectionR_two">--}}
            {{--                        <h2 class="h2">活动新闻</h2>--}}
            {{--                        <div class="sectionR_twoUL">--}}
            {{--                            <b class="bj"></b>--}}
            {{--                            <div class="ul">--}}
            {{--                                @foreach($data['news'] as $v)--}}
            {{--                                    <li>--}}
            {{--                                        <a href="#" target="_blank"> {{ $v -> title }}</a>--}}
            {{--                                        <b>作者：<span>{{ $v -> author }}</span></b>--}}
            {{--                                    </li>--}}
            {{--                                @endforeach--}}
            {{--                                    @if(!$data['news'])--}}
            {{--                                        <a href="" class="ckgd" target="_blank">查看更多</a>--}}
            {{--                                        <div class="clear"></div>--}}
            {{--                                    @endif--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endif--}}
        </div>
    </section>
</div>
<div class="clear"></div>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script type="text/javascript" src="/static/js/activity/activity_center.js"></script>
<script>
    //判断，
    //精彩内容显隐
    var Marvellous=$('.Marvellous .Marvellous_content ul li a').text();
    if(Marvellous==""){
        $('.Marvellous').hide()
    }
    //议程
    var Activity_OneCenter=$('.Activity_One img').attr('src');
    if(Activity_OneCenter==""){
        $('.Activity_One').hide()
    }
    //嘉宾
    var Activity_twoCenter=$('.Activity_two .pic .lnr1 dd').text();
    if(Activity_twoCenter==""){
        $('.Activity_two').hide()
    }
    //注意事项
    var Activity_ThreeCenter=$('.Activity_Three .Activity_describe').text();
    // console.log(Activity_ThreeCenter)
    if(Activity_ThreeCenter==""){
        $('.Activity_Three').hide()
    }
    var Activity_FourCenter=$('.Activity_Four .Activity_describe').text();
    // console.log(Activity_FourCenter)
    if(Activity_FourCenter==""){
        $('.Activity_Four').hide()
    }
</script>
<script type="text/javascript">
{{--  限制人数  --}}
var nrr=$('.Number b').html();
// console.log(nrr)
if(nrr==0){
    $('.Number').html('无限制')
}


//活动地址
var Active_address=$('.Active_address').text();
    //判断是线下还是线上
// console.log(Active_address)
if(Active_address=='线上')
{
 //
    $('.dt_xx').hide();
    $('.erwm').show();
}else{
    $('.dt_xx').show();
    $('.erwm').hide();
}
    var Detailed_address=$('.Detailed_address').text();
    // console.log(Detailed_address)
    $('.activity_place').html(Active_address+Detailed_address)
    var map = new BMap.Map("allmap");    // 创建Map实例
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);  // 初始化地图,设置中心点坐标和地图级别
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(116.331398,39.897445);
    map.centerAndZoom(point,12);
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint(''+Detailed_address+'', function(point){
        if (point) {
            map.centerAndZoom(point, 16);
            map.addOverlay(new BMap.Marker(point));
        }else{
            alert("您选择地址没有解析到结果!");
        }
    }, ''+Active_address+'');
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放


</script>

</body>
</html>
@include('Pc.layout.footer')