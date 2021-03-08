{{--个人中心头部--}}
<link rel="stylesheet" href="/static/picss/footer_header.css">
<link rel="stylesheet" href="/static/css/personal/personal_header.css">
<link rel="stylesheet" href="/static/swiperCss/swiper.min.css">
{{--<script src="http://test.chinamas.cn/static/js/personal/personal_show.js"></script>--}}
<script type="text/javascript" src="/static/swiperJs/swiper.min.js"></script>
<div class="PersonalCenter">
    <div class="gmheader" id="gmheader">
        <div class="gmheaderD_pcD" id="gmheaderD_pcD">
            <div class="Gmheader_pcB" id="Gmheader_pcB">
                <a href="/" class="loge"><img src="/static/img/logo2.png" alt=""></a>
            </div>
            <div class="Gmheader_pcBR" id="Gmheader_pcBR">
                <ul>
                    <li><a href="/mycart">购物车</a></li>
                    <li><a href="/order">我的订单</a></li>
                    {{--                    <li><a href="">在线客服</a></li>--}}
                </ul>
                <div class="Gmheader_pcB">
                    <p class="Tc"><span class="Tc_user">你好：<a
                                    href="/userpageshow">{{ Session::get('users')['account'] }}</a></span><label for="">|<span
                                    class="outlogin" onclick="outlogin()" id="outlogin">退出</span></label></p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="yd_header">
        <div class="yd_header_top">
            <div class="yd_header_top_mian">
                <div class="yd_header_top_mian_left">
                    <a href="/" class="loge"><img src="/static/img/logo3.png" alt=""></a>
                </div>
                <div class="yd_header_top_mian_right">
                    <a href="/mycart">购物车</a>
                    <a href="/order">我的订单</a>
                    <p class="tx"><img src="/static/img/logo2.png" alt=""></p>
                </div>
            </div>
        </div>
        <div class="yn_motop">
            <div class="yn_motop_left">
                <a class="search"><img src="/static/picImG/yd/public/05.png" alt=""></a>
{{--                <a href="/loadLogin" class="personal"><img src="/static/picImG/yd/public/05.png" alt=""></a>--}}
            </div>
            <div class="yn_motop_center">
                <a href="/userpageshow" class="Grzx">个人中心</a>
            </div>
            <div class="yn_motop_right">
                <div class="three  col1">
                </div>
            </div>
        </div>
        <div class="mo_dropmenus">
            <ul>
<li>账号中心</li>
                <li><a href="/loadinfo">基本信息</a></li>
                <li  onclick="outlogin()" id="outlogin">退出</li>
            </ul>
        </div>
<div class="mo_dropmenu mo_dropmenu2">
    <div class="accountNav">
        <div title="订阅中心" class="Collapsing"><em></em>订阅中心</div>
        <div class="coll_body">
            <em></em>
            <ul class="clearFix dy">
                <li class="personal_side_class"><a href="/userpageshow" title="个人中心" >个人中心</a></li>
                <li><a href="/mycart" title="我的购物车">我的购物车</a></li>
                <li><a href="/order" title="我的订单">我的订单</a></li>
                <li><a href="/integral" title="我的积分" >我的积分</a></li>
                <li><a href="/mycollection" title="我的收藏" >我的收藏</a></li>
                <li><a href="/myarticle" title="购买的文章" >购买的文章</a></li>
            </ul>
        </div>
        <div title="我要投稿" class="Collapsing"><em></em>我要投稿</div>
        <div class="coll_body">
            <em></em>
            <ul class="clearFix my_tg">
                <li><a href="/subcontributions" title="提交稿件" >提交稿件</a></li>
                <li><a href="/shgj" title="审核查询">审核查询</a></li>
            </ul>
        </div>
        <div title="会员中心" class="Collapsing"><em></em>会员中心</div>
        <div class="coll_body">
            <em></em>
            <ul class="clearFix hyzx">
                <li><a href="/loadinfo" title="基本信息" >基本信息</a></li>
                <li><a href="/openingvip" title="开通会员" >开通会员</a></li>
                <li><a href="/modifypass" title="修改密码">修改密码</a></li>
                <li><a href="/harvestaddress" title="收货地址" >收货地址</a></li>
                <li><a href="/fpxx" title="发票信息" >发票信息</a></li>
                {{--                        <li><a href="/myredeenvelopes" title="我的红包" >我的红包</a></li>--}}
                <li><a href="/mymessage" title="我的留言" >我的留言</a></li>
            </ul>
        </div>
    </div>

</div>
    </div>
    <div class="clear"></div>
    <div id="TouchNav" class="Vice-header swiper-containerv fr nav">
        <ul class="swiper-wrapper navbar_nav" data-in="fadeInDown" data-out="fadeOutUp">
            @foreach($data['header'] as $v)
                @if($v -> english == 'sy')
                    @continue;
                @else
                    <li class="swiper-slide "><a href="/{{ $v -> english }}/list">{{ $v -> column }}</a></li>
                @endif
            @endforeach

            {{--            <li><a href="../cmas/yj.html" target="_blank">业界</a></li>--}}
            {{--            <li><a href="../cmas/gc.html" target="_blank">观察</a></li>--}}
            {{--            <li><a href="../cmas/ll.html" target="_blank">理论</a></li>--}}
            {{--            <li><a href="../cmas/al.html" target="_blank">案例</a></li>--}}
            {{--            <li><a href="../cmas/js.html" target="_blank">技术</a></li>--}}
            {{--            <li><a href="../cmas/zf.html" target="_blank">人物</a></li>--}}
            {{--            <li><a href="../cmas/activity.html" target="_blank">活动</a></li>--}}
            {{--            <li><a href="../cmas/zz.html" target="_blank">杂志</a></li>--}}
        </ul>
    </div>
    <div class="clear"></div>
</div>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>

<script>
    $(".tx").click(function () {
        if ($(".mo_dropmenus").is(":hidden")) {
            $('.personal').hide();
            $('.yn_motop_left .personal').css({
                "display": "block"
            });
            $(".mo_dropmenus").show();
            $('.yn_motop_right').addClass("open");
            $(".yn_motop_right .three").addClass("col")
            $(".yn_motop_right .three").removeClass('col1');
            $('body').css({
                "overflow": "hidden"
            })
            // $('.yn_motop_left .search').css({
            //     "display": "none"
            // });
        } else {
            $(".mo_dropmenus").hide();
            $('.yn_motop_right').removeClass("open");
            $(".yn_motop_right .three").removeClass('col');
            $(".yn_motop_right .three").addClass("col1");
            // $('.yn_motop_left .search').css({
            //     "display": "block"
            // });
            $('.yn_motop_left .personal').css({
                "display": "none"
            });
            ;
            $('body').css({
                "overflow": "inherit"
            })
        }
    })
{{--    导航栏目--}}
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

        } else {
            $(".mo_dropmenu").hide();
            $('.yn_motop_right').removeClass("open");
            $(".yn_motop_right .three").removeClass('col');
            $(".yn_motop_right .three").addClass("col1");
            $('body').css({
                "overflow": "inherit"
            })
        }
    })
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
