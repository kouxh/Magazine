{{--个人中心 首页--}}
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>个人中心</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/css/grzx/order.css">
    <link rel="stylesheet" href="/static/css/grzx/Order_details.css">
    <link rel="stylesheet" href="/static/css/grzx/shgj.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
</head>
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <!-- 会员中心 -->
            <div class="gezxlist">
                <p class="TiTle">个人中心</p>
                <b class="bj"></b>
                <div class="gezxlistL">
                    <!-- 会员中心 -->
                    <div class="MembershipCenter">
                        <div class="MembershipCenter_l">
                            <div class="member member_one">
                                <dl>
                                    <dt><img src="{{ $data['user'] -> photo }}" alt=""></dt>
                                    <dd>
                                        <!-- 用户名 -->
                                        <div class="member_level1"><p class="user">{{ $data['user'] -> account }}</p>
                                            <p><label></label>普通用户</p></div>
                                    {{--                                        昵称：--}}

                                    <!-- 会员级别 -->
                                        <div class="member_level">
                                            <p><a href="/czvip">升级会员</a></p>
                                        </div>
                                        <!-- 查看级别详情 -->
                                        <a class="level_" href="/openingvip">查看会员级别</a>
                                    </dd>
                                </dl>
                                <!-- <div class="clear"></div> -->
                            </div>
                            <!-- 账户信息 -->
                            <div class="member member_two">
                                <dl>
                                    <dt>账户余额</dt>
                                    <dd><label for="" id="ye">{{ $data['user'] -> balance }}</label><span>元</span></dd>
                                </dl>
                                <dl>
                                    <dt>积分</dt>

                                    <dd><a href="/integral"><label for=""
                                                                   id="jf">{{ $data['user'] -> integral }}</label><span>分</span></a>
                                    </dd>
                                </dl>
                                <dl class="znx">
                                    <dt>通知</dt>
                                    <dd><img src="/static/img/tsx.png" alt=""><span class="tz" 
                                                                                    id="noticeId">{{ $data['email'] }}</span>
                                    </dd>
                                </dl>

                            </div>
                        </div>
                        <div class="MembershipCenter_R">
                            <img src="{{ $data['img'] -> file_path }}" alt="" style="width: 100%;height: 100%">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="MembershipCenter_Tips container">
                        <div class="li-box">
                            <ul></ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 我的订单My order-->
            <div class="MyOrder">
                <p class="TiTle">我的订单</p>
                <b class="bj"></b>
                <div class="MyOrder_tab">
                    <!-- 切换导航 -->
                    <div class="tab_subject">
                        <ul class="type">
                            <li id="1" class="default">杂志</li>
                            <li id="2">文章</li>
                            <li id="3">预售</li>
                            <li id="4">VIP</li>
                        </ul>
                        <div class="type_ment">
                            <div class="div">
                                <div class="MyOrder_tab">
                                    <!-- 切换导航 -->
                                    <div class="tab_title">
                                        <ul>
                                            <li id="100" class="default">所有订单</li>
                                            <li id="1">待支付</li>
                                            <li id="2">待发货</li>
                                            <li id="3">待收货</li>
                                            <li id="4">待评价</li>
                                            <li id="5">已完成</li>
                                            <li id="6">过期订单</li>
                                        </ul>
                                    </div>
                                    <div class="tab_subject">
                                        <div class="MyOrderMainListTitle">
                                            <li><select>
                                                    <option value="100">全部</option>
                                                    <option value="101">最近三个月订单</option>
                                                </select>
                                                <span class="shangP">商品</span>
                                            </li>
                                            <li>数量</li>
                                            <li>单价</li>
                                            <li>收货人</li>
                                            <li>合计</li>
                                            <li>状态</li>
                                            <li>操作</li>
                                        </div>
                                        <div class="Order" id="biuuu_city_list">
                                            <div class="tab_data"></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div id="pagge" class="pagge"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mAin">
                    <div class="mAinL">
                        <p class="TiTle">我的关注</p>
                        <div class="bj"></div>
                        <div class="mAinLD">
                            <div class="mAinLD_main">
                                @foreach($data['follow'] as $val)
                                    <span id="{{ $val -> id }}">{{ $val -> title }}</span>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="mAinR">
                        <p class="TiTle">猜你喜欢</p>
                        <div class="bj"></div>
                        <ul>
                            @foreach($data['like'] as $val)
                                <li><a href="{{ $val -> wz_url }}">{{ $val -> title }}</a></li>
                            @endforeach
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="gaojian">
                    <div class="tab_ment">
                        <ul style="cursor:pointer;">
                            <li class="change" id="1">全部稿件</li>
                            <li id="2">审核中</li>
                            <li id="3">已采纳</li>
                            <li id="4">未采纳</li>
                        </ul>
                    </div>
                    <div class="bj"></div>
                    <div class="tab_box">
                        <div class="div ">
                            <div class="tab_title sh">
                                <ul>
                                    <li>稿件标题</li>
                                    <li>稿件编号</li>
                                    <li>投稿日期</li>
                                    <li>投稿栏目</li>
                                    <li>审核状态</li>
                                    <li>采纳状态</li>
                                    <li>反馈建议</li>
                                    <li>获得积分</li>
                                </ul>
                            </div>
                            <form action="" method="" class="ManuscriptForm">
                                <table border="" cellspacing="" cellpadding="" class="tab_subject" id="biuuu_city_list2"
                                       style="width: 100%">

                                </table>
                            </form>
                            <div id="paggetj" class="pagge"></div>

                        </div>
                        {{--                    <div class="div ">审核中</div>--}}
                        {{--                    <div class="div ">已采纳</div>--}}
                        {{--                    <div class="div ">未采纳</div>--}}
                    </div>
                </div>
            </div>

        </div>
        <div class="clear"></div>

    </div>

    <div class="clear"></div>
</div>
{{--通知弹框--}}
<div id="noticeBox" style="display: none; ">
    <ul class="layui-timeline" style="width: 90%;margin: 0 auto;margin-top: 30px">
    </ul>
</div>
{{--订单详情弹框--}}
<form action="" id="Order_details" style="display: none; ">
    <ul class="layui-timeline">

    </ul>
</form>
{{--请选择支付方式--}}
<div id="selectType" style="display: none;">
    <div class="layui-form select-form">
        <input type="radio" id="isdisabled" name="level" lay-filter="levelM" value="1" title="余额支付" checked>
        <div class="remaining">{{Session::get('users')['balance']}}</div>
        <input type="radio" id="ischecked" name="level" lay-filter="levelM" value="2" title="微信支付">
        <div class="pay_icon" style="top:84px;"></div>
    </div>
</div>
<div class="clear"></div>
@include('Pc.layout.footer')

{{--@include('Pc.layout.footer')--}}
{{--<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>--}}
{{--<script src="/layui/layui.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<link rel="stylesheet" href="../layui/css/layui.css">--}}
<!-- 个人中心 会员中心 -->
{{--<script src="/static/js/personal/personal_show.js" type="text/javascript" charset="utf-8"></script>--}}
<script src="/static/json/grzx/order.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/static/json/grzx/shgj.js"></script>
<script type="text/javascript" src="/static/json/grzx/userpageshow.js"></script>
<script type="text/javascript">
    $(".tab_ment li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
    });
</script>
</body>
</html>
