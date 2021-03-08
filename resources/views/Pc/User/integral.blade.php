<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的积分-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/integral.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
{{--    <script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://www.yuanian.com/son/swiperJs/swiper.min.js"></script>--}}
{{--    <script src="/static/picJs/yd_cdh.js"></script>--}}{{--    次导航--}}


</head>
<body>
{{--我的积分--}}
@include('Pc.layout.personal')
    <div class="grzx_main">
        @include('Pc.layout.personal_side')
        <div class="grzx_mainList">
            <div class="grzx_mainListD">
                <!-- 我的积分 -->
                <div class="gezxlist">
                    <p class="TiTle">我的积分</p>
                    <b class="bj"></b>
                    <div class="tab_title">
                        <ul>
                            <li class="default" id="1">积分明细</li>
                            <li class="" id="2">积分用途</li>
                            <li class="" id="3">积分来源</li>
{{--                            <li class="">即将过期</li>--}}
                        </ul>
                    </div>
                    <div class="tab_subject">
                        <div class="div" id="Detailed">
                            <div class="DetailedMain">
                                <div class="DetailedMain_top" id="DetailedMain_top">
                                    <div class="DetailedMain_top-left">
                                        <div class="DetailedMain_top-left-top">
                                            <p class="P_title">积分获得规则</p>
                                            <p class="paragraph">成功注册会员：增加10积分；评价完成订单：增加5积分。
                                                购物并付款成功后将获得订单总价10%积分。
                                                注：只展示近1年的积分变化。</p>
                                        </div>
                                        <div class="DetailedMain_top-left-bottom">
                                            <p class="P_title3">积分总数</p>
                                            <!--  积分总数-->
                                            <p class="Total"><span></span>分</p>
                                        </div>
                                    </div>
                                    <div class="DetailedMain_top-right">
                                        <p class="P_title2">积分商城</p>
                                        <p class="paragraph">兑换超值商品！</p>
                                        <a href="javascript:;" class="ToSee">去看看</a>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div    border="" cellspacing="" cellpadding="" id="Detailed_table">
                                    <ul>
                                        <li>来源/用途</li>
                                        <li>积分变化</li>
                                        <li>日期</li>

                                    </ul>
                                    <table border="" cellspacing="" cellpadding=""  id="biuuu_city_list">
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <dl>--}}
{{--                                                <dt><img src="/static/picImG/pc/grzx/jf.png" alt=""></dt>--}}
{{--                                                <dd>--}}
{{--                                                    <p class="P_title3">注册会员</p>--}}
{{--                                                    <p class="paragraph"><span>积分</span>编号<label for="">1234556789</label></p>--}}
{{--                                                </dd>--}}
{{--                                            </dl>--}}
{{--                                        </td>--}}
{{--                                        <td>-10</td>--}}
{{--                                        <td>2018年3月21日</td>--}}
{{--                                    </tr>--}}
                                    </table>
                                    <div id="pagge" class="pagge"></div>
                                </div>
                            </div>
                        </div>
                        <div class="div Detailed_table2" id="Detailed_table" >
                            <ul>
                                <li>来源/用途</li>
                                <li>积分变化</li>
                                <li>日期</li>
                            </ul>
                            <table border="" cellspacing="" cellpadding="" id="biuuu_city_list2">
                            </table>
                            <div id="pagge2" class="pagge"></div>
                        </div>
                        <div class="div Detailed_table" id="Detailed_table" ">
                            <ul>
                                <li>来源/用途</li>
                                <li>积分变化</li>
                                <li>日期</li>
                            </ul>
                            <table border="" cellspacing="" cellpadding="" id="biuuu_city_list3">
                            </table>
                            <div id="pagge3" class="pagge"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="clear"></div>
@include('Pc.layout.footer')

</body>
</html>
{{--<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>--}}
<script type="text/javascript" src="/static/json/grzx/integral.js"></script>

<script type="text/javascript">

</script>
