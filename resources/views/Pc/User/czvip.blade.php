<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>充值会员-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/czvip.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
</head>
<body>
<div class="wapper">
    @include('Pc.layout.personal')
    <div class="grzx_main">
        @include('Pc.layout.personal_side')
        <div class="grzx_mainList">
            <div class="grzx_mainListD">
                <!-- 充值会员 -->
                <div class="gezxlist">
                    <p class="TiTle">充值会员</p>
                    <b class="bj"></b>
                    <div class="recharge">
                        <div class="recharge_main" id="_main1">
                            <div class="recharge_mainLeft">
                                <p>充值方式:</p>
                            </div>
                            <div class="recharge_mainRight">
                                <dl class="default">
                                    <dt><img src="/static/picImG/pc/grzx/wx.png" alt=""></dt>
                                    <dd>微信支付</dd>
                                </dl>
                                {{--                                <span class="xt"></span>--}}
                                {{--                                <dl><dt><img src="/static/picImG/pc/grzx/zfb.png" alt=""></dt>--}}
                                {{--                                    <dd>支付宝支付</dd>--}}
                                {{--                                </dl>--}}
                            </div>
                        </div>
                        <div class="recharge_main" id="_main2">
                            <div class="recharge_mainLeft">
                                <p>充值金额:</p>
                            </div>
                            <div class="recharge_mainRight">
                                <dl class="default">
                                    <dt>初级会员1个月</dt>
                                    <dd>30元</dd>
                                </dl>
                                <span class="xt"></span>
                                <dl>
                                    <dt>中级会员6个月</dt>
                                    <dd>180元</dd>
                                </dl>
                                <span class="xt"></span>
                                <dl>
                                    <dt>高级会员12个月</dt>
                                    <dd>360元</dd>
                                </dl>
                                <div class="clear"></div>
                                <dl>
                                    <dt>超级会员36个月</dt>
                                    <dd>888元</dd>
                                </dl>


                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <a class="Recharge" style="width: 126px;
    height: 43px;
    margin: 0 auto;
    background: rgba(243, 65, 77, 1);
    border-radius: 22px;
    display: block;
    line-height: 43px;
    text-align: center;
    color: #fff;">确定</a>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
@include('Pc.layout.footer')

</body>
</html>

<script type="text/javascript" charset="utf-8">
    $(function () {
        $('.Recharge').click(function(){
            layui.use('layer', function() {
                layer.msg('努力搭建中...', {
                    time: 2000 //2秒关闭
                }, function() {

                });
            })
        })
    });
    $(".recharge_main .recharge_mainRight dl").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        $(this).addClass("default").siblings().removeClass("default");
    });


</script>