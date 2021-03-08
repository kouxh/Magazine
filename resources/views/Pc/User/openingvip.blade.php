<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>开通会员-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/openingvip.css">
</head>
<body>
<div class="wapper">
    @include('Pc.layout.personal')
    <div class="grzx_main">
        @include('Pc.layout.personal_side')
        <div class="grzx_mainList">
            <div class="grzx_mainListD">
                <!-- 开通会员 -->
                <div class="gezxlist">
                    <p class="TiTle">开通会员</p>
                    <b class="bj"></b>
                    <div class="Member" id="Member">
                        <ul>
                            <li>会员特权</li>
                            <li><span>级别</span><span>会员有效期</span><span><label for="" class="label_one">获取方式</label><label class="label_center">注册</label><label
                                            class="label_center">购买/积分</label></span><span><label for="" class="label_one">特权</label><label class="label_center-two">文章免费阅读</label><label
                                            class="label_center-two">电子杂志折扣</label><label class="label_center-two">纸质志折扣</label></span></li>
                            <li><span>注册会员</span><span>永久</span><span><label class="label_center"><img src="/static/picImG/pc/grzx/01_1.png" alt=""></label><label
                                            class="label_center">0</label></span><span><label class="label_center-two">0.5小时</label><label class="label_center-two">0</label><label
                                            class="label_center-two">0</label></span></li>
                            <li><span>初级会员</span><span>1（月）</span><span><label class="label_center"><img src="/static/picImG/pc/grzx/01_1.png"
                                                                                                         alt=""></label><label class="label_center">30元</label></span><span><label class="label_center-two">免费</label><label
                                            class="label_center-two">5折</label><label class="label_center-two">0</label></span></li>
                            <li><span>中级会员</span><span>6（月）</span><span><label class="label_center"><img src="/static/picImG/pc/grzx/01_1.png"
                                                                                                         alt=""></label><label class="label_center">180元</label></span><span><label class="label_center-two">免费</label><label
                                            class="label_center-two">免费</label><label class="label_center-two">9折</label></span></li>
                            <li><span>高级会员</span><span>18（月）</span><span><label class="label_center"><img src="/static/picImG/pc/grzx/01_1.png"
                                                                                                          alt=""></label><label class="label_center">360元</label></span><span><label class="label_center-two">免费</label><label
                                            class="label_center-two">免费</label><label class="label_center-two">8折</label></span></li>
                            <li><span>超级会员</span><span>38（月）</span><span><label class="label_center"><img src="/static/picImG/pc/grzx/01_1.png"
                                                                                                          alt=""></label><label class="label_center">888元</label></span><span><label class="label_center-two">免费</label><label
                                            class="label_center-two">免费</label><label class="label_center-two">7.5折</label></span></li>

                        </ul>
                        <div class="Recharge_main" id="Recharge_main">
                            <a href="/czvip" class="Recharge">充值</a>
                            <p class="paragraph-title">温馨提示:</p>
                            <p class="paragraph-Three">1、开通包月会员可以享受包月精品内容免费读的特权！</p>
                            <p class="paragraph-Three">2、部分书刊包月不可免费读！</p>
                        </div>
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
