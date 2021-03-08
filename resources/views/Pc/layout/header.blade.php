<link rel="stylesheet" href="/static/picss/footer_header.css">
<div class="header_pc" id="header_pc">
    <div class="header_pcD" id="header_pcD">
        <div class="header_pcB" id="header_pcB">
            <a href="/" class="loge"><img src="/static/img/logo2.png" alt=""></a>
            <ul class="header_pcBU">
                @foreach($data['header'] as $v)
                    @if($v -> english == 'sy')
                        @continue;
                    @else
                        <li><a href="/{{ $v -> english }}/list">{{ $v -> column }}</a></li>

                    @endif
                @endforeach

            </ul>
            <div class="header_pcBUr">

                {{--                <div class="form">--}}
                {{--                    @if($data['column'][0]['column'] != '')--}}
                {{--                        <input type="text" placeholder="搜索" id="keyword" value="{{ $data['column'][0]['column'] }}">--}}
                {{--                    @else--}}
                {{--                        <input type="text" placeholder="搜索" id="keyword" value="">--}}
                {{--                    @endif--}}
                {{--                    <button class="xw">新闻</button>--}}
                {{--                    <button class="zy">专业</button>--}}
                {{--                </div>--}}

                <div class="form">
                    @if($data['column']['search']['column'] != '')
                        <input type="text" placeholder="请输入关键词" id="keyword"
                               value="{{ $data['column']['search']['column'] }}">
                    @else
                        <input type="text" placeholder="请输入关键词" id="keyword" value="">
                    @endif
                    <button class="zy">搜专业</button>
                    <button class="xw">搜新闻</button>
                </div>


                @if(!Session::get('users'))
                    <div class="NOzc">
                        <ul>
                            <li><a href="/loadLogin">登录</a></li>
                            <li><a href="/loadRegister">注册</a></li>
                        </ul>
                        {{--                        <a href="/magation" class="dg">订购</a>--}}
                    </div>
                @else
                    <div class="Gmheader_pcB">
                        <p class="Tc"><span class="Tc_user"><a id="login"
                                                               href="/userpageshow">{{ Session::get('users')['account'] }}</a></span><label
                                    for="">|<span class="" onclick="outlogin()">退出</span></label></p>
                    </div>
                @endif
                <div class="Settled" id="Settled">
                    <a href="/sjrz">商家入驻</a>
                    <a class="Shopping_bag" style="margin-left:10px"><img src="/static/img/gwd.png" alt="" width="17px"
                                                                          height="25px"></a>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="yd_header">
    <div class="yn_main">
        <div class="yn_motop">
            <div class="yn_motop_left">
                <a class="search"><img src="/static/picImG/yd/public/03.png" alt=""></a>
                <a href="/loadLogin" class="personal"><img src="/static/picImG/yd/public/05.png" alt=""></a>
            </div>
            <div class="yn_motop_center">
                <a href="/" class="motop_logo"><img src="/static/img/logo2.png"></a>
            </div>
            <div class="yn_motop_right">
                <div class="three  col1">
                </div>
            </div>
        </div>
        <div class="sous" id="sous">
            <div class="form">
                @if($data['column']['search']['column'] != '')
                    <input type="text" placeholder="请输入关键词" id="keyword_yd"
                           value="{{ $data['column']['search']['column'] }}">
                @else
                    <input type="text" placeholder="请输入关键词" id="keyword_yd" value="">
                @endif
                <div class="btn">
                    <button class="zy">搜专业</button>
                    <button class="xw">搜新闻</button>
                </div>

            </div>

        </div>
        <div class="mo_dropmenu">
            <ul>

                @foreach($data['header'] as $v)
                    <li class="">
                        <div class="mo_dropmenu_title">
                            <a href="/{{ $v -> english }}/list">{{ $v -> column }}</a>
                        </div>
                    </li>
                @endforeach
                <li>
                    <a href="/userpageshow">个人中心</a>
                </li>
                <li>
                    <a href="/sjrz">商家入驻</a>
                </li>


            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js">
</script>
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="/static/layui/css/layui.css">
<script type="text/javascript" src="/static/js/header/header.js"></script>

<script>
    $(".xw").click(function () {
        var keyword = $("#keyword").val();
        if (keyword == '') {
            alert('请输入关键词');
            return false;
        }
        window.location.href = "/search?keyword=" + keyword + "&type=xw";
    })
    $(".zy").click(function () {
        var keyword = $("#keyword").val();
        if (keyword == '') {
            alert('请输入关键词');
            return false;
        }
        window.location.href = "/search?keyword=" + keyword + "&type=zy";
    })
    $("#sous .xw").click(function () {
        var keyword = $("#keyword_yd").val();
        if (keyword == '') {
            // alert('请输入关键词');
            return false;
        }
        window.location.href = "/search?keyword=" + keyword + "&type=xw";
    })
    $("#sous .zy").click(function () {
        var keyword = $("#keyword_yd").val();
        if (keyword == '') {
            // alert('请输入关键词');
            return false;
        }
        window.location.href = "/search?keyword=" + keyword + "&type=zy";
    })
</script>
<script>
    function outlogin() {

        $.get('/outlogin', {}, function (data) {
            if (data.bol == true) {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('退出成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                    })
                })
                window.location.reload();
            }
        })
    }
</script>
<script>
    $(".yn_motop_right").click(function () {
        if ($(".mo_dropmenu").is(":hidden")) {
            $('.personal').hide();
            $('.yn_motop_left .personal').css({
                "display": "block"
            });
            $(".mo_dropmenu").show();
            $('.yn_motop_right').addClass("open");
            $(".yn_motop_right .three").addClass("col")
            $(".yn_motop_right .three").removeClass('col1');
            $('body').css({
                "overflow": "hidden"
            })
            $('.yn_motop_left .search').css({
                "display": "none"
            });
        } else {
            $(".mo_dropmenu").hide();
            $('.yn_motop_right').removeClass("open");
            $(".yn_motop_right .three").removeClass('col');
            $(".yn_motop_right .three").addClass("col1");
            $('.yn_motop_left .search').css({
                "display": "block"
            });
            $('.yn_motop_left .personal').css({
                "display": "none"
            });
            ;
            $('body').css({
                "overflow": "inherit"
            })
        }
    })
    // 点击任意处搜索效果关闭
    var $el = $(".search");
    $el.click(function (e) {
        e.stopPropagation();
        $(this).toggleClass('active');
        $("#sous").show();
    });
    $(document).on('click', function (e) {
        if (($(e.target) != $el) && ($el.hasClass('active'))) {
            $el.removeClass('active');
            e.stopPropagation();
            $("#sous").hide();
        }
    });
    $('.sous').click(function (e) {
        // $(this).show();
        e.stopPropagation();
    })


    $(document).ready(function () {
        $(".header_pcBU a").each(function () {
            $this = $(this);
            // console.log($this[0].href);
            // console.log($this[0].href.split('/')[3]);
            //  console.log(window.location.pathname.split('/')[1]);
            if ($this[0].href.split('/')[3] == String(window.location.pathname.split('/')[1])) {
                // console.log("dd")
                $this.addClass("hover");
            }
        });
        // $(".header_pcBU a").each(function(){
        //     $(this).click(function(){
        //         $(".header_pcBU .hover").removeClass("hover");
        //         $(this).addClass("hover");
        //         // return false;//防止页面跳转
        //     });
        // });
    });
</script>
{{--<script>--}}
{{--    $(function(){--}}
{{--        var a = $('#header_pc'),--}}
{{--            b =a.offset();--}}
{{--        $(document).on('scroll',function(){--}}
{{--            var c = $(document).scrollTop();--}}
{{--            if(b.top<=c){--}}
{{--                a.css({'position':'fixed','top':'0px'})--}}
{{--            }else{--}}
{{--                a.css({'position':'relative','top':'0px'})--}}
{{--            }--}}
{{--        })--}}
{{--    })--}}

{{--</script>--}}
{{--<script>--}}
{{--    @if(empty(Session::get('users') -> account))--}}
{{--        alert(1)--}}
{{--    @else--}}
{{--        alert(2)--}}
{{--    @endif--}}
{{--</script>--}}



