<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link rel="stylesheet" href="/static/swiperCss/swiper.min.css">
    <link rel="stylesheet" href="/static/css/zz.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
{{--    评论css--}}
    <link rel="stylesheet" href="/static/picss/wzZt.css">
</head>
@include('Pc.layout.header')
<body>
<!-- 杂志购买 -->
<div class="clear" id="Magazine">
    <input type="hidden" value="{{ $data['magazine'] -> m_id  }}" id="id">
</div>
<div class="wapper" id="{{ $data['magazine'] -> m_id  }}" type="2">
    <div class="h_top"> </div>
    <section id="section">
        <div class="section_details">
            <div class="section_detailsL">
                <div class="section_detailsL_tp">
                    <div class="bj"></div>
                    <!-- 杂志展示 -->
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper" id="swiper-wrapper_one">
                            <div class="swiper-slide slide_one" id="default">
                                <img src="{{ $data['magazine'] -> cover_img }}" alt="">
                            </div>

                            <div class="swiper-slide slide_one">
                                <img src="{{ $data['magazine'] -> side_img }}" alt="">
                            </div>

                            <div class="swiper-slide slide_one">
                                <img src="{{ $data['magazine'] -> side_img }}" alt="">
                            </div>

                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper" id="swiper-wrapper2">
                            <div class="swiper-slide "><img src="{{ $data['magazine'] -> cover_img }}" alt=""></div>
                            <div class="swiper-slide "><img src="{{ $data['magazine'] -> side_img }}" alt=""></div>
                            <div class="swiper-slide "><img src="{{ $data['magazine'] -> side_img }}" alt=""></div>

                        </div>
                    </div>
                </div>
                <div class="section_detailsL_xp">
                    <h1>{{ $data['magazine'] -> name}}{{ $data['magazine'] -> year}}{{ $data['magazine'] -> title}}</h1>
                    <h2>{{ $data['magazine'] -> subtitle}}</h2>
                    <div class="details_guig">
                        <p class="xz">
                            <a class="">
                                <span class="lb">平装</span>
                                <br>
                                <span id="">¥<i>{{$data['magazine'] -> flat }}</i></span>
                            </a>
                        </p >
                        <p class="xsyh" id="xsyh" style="display: none;">
                            <span class="details_guigS">限时优惠：</span>
                            <span>x元 还剩x天x小时</span>
                        </p >
                        <div class="clear"></div>
                        <div class="details_Number">
                            <p>
                                <span class="Subscribe">订阅数量：</span>
                                <label class="_Number">
                                    <button class="button  reduce" >-</button>
                                    <input type="text" value="1 " class="centent_number">
                                    <button class="button  plus" >+</button>
                                </label><label class="stock">库存：<span class="Stock_text">{{ $data['magazine'] -> num }}</span>本<span class="kuc">库存不足！</span></label>
                            </p >
                        </div>
                        <div class="SubscribeMore">
                            <button class="purchase immediately" > 立即订阅 </button>
                            <button class="purchase join" id="join" > 加入购物车 </button>
                            <span class="Magazine_collection">收藏</span>
                            <div class="More">
                                <span class="Subscribe"> 更多订阅： </span>
                                <b>下单日即为起订日，起订期刊为起订日后的最新一期杂志。
                                </b>
                            </div>
                                <p class="SubscribeMoreP">
                                    <input type="checkbox" id="1" title="半年/3期" value="150.00" name="test" onclick="checkedThis(this);"> 半年/3期<span>¥150.00</span>
                                    <input type="checkbox" id="2" title=" 全年 / 共6期 " value="300.00" name="test" onclick="checkedThis(this);">
                                    全年 / 共6期 <span> ¥300.00</span>
{{--                                    <input type="checkbox" id="1" title="半年/3期" value="150.00" name="test" > 半年/3期<span>¥150.00</span>--}}
{{--                                    <input type="checkbox" id="2" title=" 全年 / 共6期 " value="300.00" name="test" >--}}
{{--                                    全年 / 共6期 <span> ¥300.00</span>--}}
                                </p >
                                <p class="SubscribeP">
                                    <span class="Subscribe"> 活动积分： </span>
                                    <span> <span class="integral"> 2</span>积分</span>
                                </p >
                                <p class="Tips">全国快递投递， 快递不到地区采用邮局挂号配送。 包邮地区不含西藏， 新疆， 甘肃， 青海， 宁夏， 内蒙古， 海南。（邮发代码：80-841） </p >
                            <a  class="Tmall" id="Tmall" target="_blank" href="https://gdjjcbs.tmall.com/category-1434218016.htm?spm=a1z10.5-b-s.w5842-22524865067.7.39ab756caUm6id&search=y&parentCatId=1434218015&parentCatName=%BB%E1%BC%C6%2F%B2%C6%B1%A8&catName=%BB%E1%BC%C6%C8%EB%C3%C5#bd">天猫购买入口<span>GO</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section_detailsR">
                <!-- 广告图 -->
                <div class="section_detailsR_Advertisement">
                    <img src="/static/img/guanG.png" alt="">
                </div>
                <div class="Contribution">
                    <span>杂志投稿：400-819-1255</span>
                    <span>edit@chinamas.cn</span>
                </div>
            </div>
        </div>
        <div class="section_introduce">
            <div class="section_introduceL">
                <h6>杂志推荐</h6>
                <div class="section_introduceLD">

                    @foreach($data['r_magazine'] as $k => $v)
                        <a href="/zz/{{ $v -> m_id }}">
                            <dl id="m_id15">
                                <dt><img src="{{ $v -> cover_img }}" alt=""></dt>
                                <dd>{{ $v -> year }} {{ $v -> title }}</dd>
                            </dl>
                        </a>
                    @endforeach

                    <div class="clear"></div>
                </div>
            </div>
            <div class="section_introduceR">
                <div class="tab">
                    <div class="tab-menu ">
                        <ul>
                            <li class="change">杂志简介</li>
                            <li>杂志评论</li>
                            <li>订阅须知</li>
                        </ul>
                    </div>
                    <div class="tab-box">
                        <div class="div div1">
                            <div class="information">
                                <ol>
                                    <li>主管单位：<span>{{ $data['magazine'] -> executive_director }}</span></li>
                                    <li>主办单位：<span>{{ $data['magazine'] -> host_company }}</span></li>
                                    <li>出版单位：<span>{{ $data['magazine'] -> publish }}</span></li>
                                    <li>创刊时间：<span>{{ $data['magazine'] -> publication_time }}</span></li>
                                    <li>国内刊号：<span>{{ $data['magazine'] -> publication_number }}</span></li>
                                    <li>出版周期：<span>{{ $data['magazine'] -> publication_cycle }}</span></li>
                                    <li>ISBN：<span>{{ $data['magazine'] -> ISBN }}</span></li>
                                    <li>页数：<span>{{ $data['magazine'] -> number }}</span></li>
                                    <li>开本：<span>{{ $data['magazine'] -> open_book }}</span>
                                    </li>
                                </ol>
                            </div>

                            <div class="briefIntroduction">
                                <?php echo $data['magazine'] -> text?>

                            </div>
                        </div>
                        <div class="div div2">
{{--                            <p style="line-height: 46px; text-align: center;">敬请期待!</p>--}}

                            {{--            文章评论¬--}}
                            <div class="comments_mod_v1">
                                <div class="post-comment" id="comment">
                                    {{--<<<<<<< Updated upstream--}}
                                    {{--                                    <h2>评论（<span class="total_num">1</span>）</h2>--}}
                                    {{--=======--}}
                                    <h2>评论（<span class="total_num">0</span>）</h2>
                                    {{-->>>>>>> Stashed changes--}}
                                <!-- 登录之后 -->
                                    <div class="form-part">
                                        <form class="comment-form clear">
                                            <div class="user-info">


                                                @if(!Session::get('users'))
                                                    <a target="_blank"  class="avatar"><img  src=""  width="30" height="30"></a>
                                                @else
                                                    <a target="_blank" class="avatar"><img src="{{ Session::get('users')['photo'] }}  "  width="30" height="30"></a>
                                                @endif

                                                    <h3 class="name"></h3>

{{--                                                <a target="_blank" class="avatar"><img src="{{ Session::get('users')['photo'] }} "  width="30" height="30"></a>--}}
{{--                                                <h3 class="name"></h3>--}}

                                            </div>
                                            <!--不用许输入 !@#$%^&* -->
                                            <textarea rows="2" cols="20" name="comments"
                                                      onkeypress="if ((event.keyCode > 32 &amp;&amp; event.keyCode < 48) || (event.keyCode > 57 &amp;&amp; event.keyCode < 65) || (event.keyCode > 90 &amp;&amp; event.keyCode < 97)) event.returnValue = false;"
                                                      class="border-box" id="comment-input" placeholder="请输入评论内容"></textarea>
                                            <a class="bind-tip" href="javascript:;" target="_blank">根据《网络安全法》实名制要求，请绑定手机号后发表评论</a>
                                            <a class="js-comment btn " id="btn">发表评论</a>
                                        </form>
                                    </div>
                                    <div class="clear"></div>
                                    <!-- 没有登陆提示登录后评论 -->

                                    <div class="login-tip tc">
                                        【登录后才能评论哦！点击 <a href="/loadLogin" target="_blank">登录</a>】
                                    </div>
                                    <ul class="comment-list">
                                        <div class="clear"></div>
                                    {{--                        <li class="comment-item" id="608426">--}}
                                    {{--                            <div class="comment-info">--}}
                                    {{--                                <a class="avatar" href="/user/4185838" target="_blank" title="hizYDP">--}}
                                    {{--                                    <img src="https://images.tmtpost.com/uploads/avatar/89406bcb124bc802a240d5513b1737f4_1573016615.jpeg?imageMogr2/strip/interlace/1/quality/85/thumbnail/40x40&amp;ext=.jpeg"--}}
                                    {{--                                            alt="hizYDP" width="40" height="40">--}}
                                    {{--                                </a>--}}
                                    {{--                                <span class="user"><a class="name" href="/user/4185838" target="_blank" title="hizYDP">hizYDP</a></span>--}}

                                    {{--                            </div>--}}
                                    {{--                            <p class="comment-cont">狗咬狗一嘴毛吧？</p>--}}
                                    {{--                        </li>--}}

                                    {{--                    <div class="login-tip tc">--}}
                                    {{--                        【登录后才能评论哦！点击 <a href="/" target="_blank">登录</a>】--}}
                                    {{--                    </div>--}}
                                    {{--                    <ul class="comment-list">--}}
                                    {{--                        <div class="clear"></div>--}}
                                    {{--                        --}}
                                    {{--                        <li class="comment-item" id="608426">--}}
                                    {{--                            <div class="comment-info">--}}
                                    {{--                                <a class="avatar" href="/user/4185838" target="_blank" title="hizYDP">--}}
                                    {{--                                    <img src="https://images.tmtpost.com/uploads/avatar/89406bcb124bc802a240d5513b1737f4_1573016615.jpeg?imageMogr2/strip/interlace/1/quality/85/thumbnail/40x40&amp;ext=.jpeg"--}}
                                    {{--                                            alt="hizYDP" width="40" height="40">--}}
                                    {{--                                </a>--}}
                                    {{--                                <span class="user"><a class="name" href="/user/4185838" target="_blank" title="hizYDP">hizYDP</a></span>--}}

                                    {{--                            </div>--}}
                                    {{--                            <p class="comment-cont">狗咬狗一嘴毛吧？</p>--}}
                                    {{--                        </li>--}}

                                    {{--                    </ul>--}}
                                </div>
                                <!-- 删除评论提示弹窗 -->
                            </div>

                        </div>

                        <div class="div div3">
                            <p class="dyzz_p">《管理会计研究》杂志为广东经济出版社主办的管理会计专业期刊，双月刊，单月份26日出刊，国内统一刊号：CN 44-1740/F。
                            </p>
                            <p class="dyzz_p">本杂志可以进行单期杂志购买与订阅、半年期订阅以及一年期订阅，集团订阅请直接和我们联系（400-819-1255）。</p>
                            <p class="dyzz_p">1.购买往期杂志：购买成功后2个工作日内寄出。</p>
                            <p class="dyzz_p">2.订阅单期杂志：新版杂志出刊后3个工作日内寄出。</p>
                            <p class="dyzz_p">3.订阅半年期杂志：半年期杂志共3本，从预定起始月开始每两个月邮寄一次，共邮寄3次.</p>
                            <p class="dyzz_p">4.订阅一年期杂志：一年期杂志共6期，从预定起始月开始每两个月邮寄一次，共邮寄6次.</p>
                            <p class="dyzz_p">举例：张先生在2018年12月份订阅了半年期杂志，那么他的订单中预定起始月为2019年1月份，张先生会在2019年1月份、3月份、5月份这个三个月里分别收到一本《管理会计研究》杂志新刊。</p>
                            <p class="dyzz_p">如果您在新版杂志出刊半月内未收到我们邮寄的杂志，请查询订单发货信息后及时联系客服处理。</p>
                            <p class="dyzz_p">付款方式：</p>
                            <p class="dyzz_p">网站在线支付支持微信、支付宝扫码支付。</p>
                            <p class="dyzz_p">关于发票：</p>
                            <p class="dyzz_p">我们可以提供增值税普通发票（电子）、增值税专用发票，请提供准确的开票信息。</p>
                            <p class="dyzz_p">关于运费：</p>
                            <p class="dyzz_p">西藏、新疆、甘肃、青海、宁夏、内蒙古、海南、港澳台地区除外，其他地区免运费配送，非免邮地区具体运费以网站实际标识为准。</p>
                            <p class="dyzz_p">关于退款：</p>
                            <p class="dyzz_p">杂志订阅为预付款业务，付款成功后暂不支持线上退款，如果您有退款的需求请联系在线客服或拨打400电话进行沟通，将会有专门人员进行处理！</p>
                            <p class="dyzz_p">银行汇款：</p>
                            <p class="dyzz_p">户    名：北京元年诺亚舟咨询有限公司</p>
                            <p class="dyzz_p">开户银行：中国民生银行北京分行营业部</p>
                            <p class="dyzz_p">帐 号：695181999</p>
                            <p class="dyzz_p" style="color: red;">汇款后请尽快通过电话、电子邮件通知编辑部，以便我们及时给您邮寄杂志！谢谢合作！</p>
                            <p class="dyzz_p">邮局订阅：</p>
                            <p class="dyzz_p">《管理会计研究》杂志支持邮局订阅，邮发代号：80-841，详情请拨打杂志社电话进行咨询。</p>
                            <p class="dyzz_p">杂志社联系方式：</p>
                            <p class="dyzz_p">电话：400-819-1255</p>
                            <p class="dyzz_p">邮箱：edit@chinamas.cn</p>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section_s">
            <div class="section_sl">
                <h4>精彩内容推荐</h4>
                <div class="gc_bottomLUL">
                    <ul class="ul">
                        <li><a href="../杂志—v2/lilun01.html" target="_blank">管理会计信息化的新思维</a><b>作者：<span>李彤</span></b></li>
                        <li><a href="../杂志—v2/lilun02.html" target="_blank">立足共享服务 构建集团级企业数据中心</a><b>作者：<span>屈涛</span></b></li>
                        <li><a href="../杂志—v2/lilun05.html" target="_blank">“后金税三期”时代，企业税务管理应何去何从？</a><b>作者：<span>元年</span></b></li>
                    </ul>
                    <a href="" class="ckgd">查看更多</a>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="section_sr">
                <h4>精彩内容推荐</h4>
                <dl>
                    <dt><img src="/static/img/hd1.png"></dt>
                    <dd>
                        <h3> 人工智能大数据领域额现在越演越烈、冶铜材加 工于一体预算体系建设 </h3>
                        <p>活动时间：<span>2019-10-1</span></p>
                        <p>活动地点：<span>领航</span></p>
                        <span class="signUp">报名</span>
                    </dd>
                    <div class="clear"></div>
                </dl>
                <dl>
                    <dt><img src="/static/img/hd1.png"></dt>
                    <dd>
                        <h3> 人工智能大数据领域额现在越演越烈、冶铜材加 工于一体预算体系建设 </h3>
                        <p>活动时间：<span>2019-10-1</span></p>
                        <p>活动地点：<span>领航</span></p>
                        <span class="signUp">报名</span>
                    </dd>

                </dl>
            </div>
        </div>
    </section>
</div>
{{--<script src="picJs/footer.js" type="text/javascript" charset="utf-8"></script>--}}

</body>
@include('Pc.layout.footer')
</html>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
{{--<script src="static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script src="static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}
<script type="text/javascript" src="/static/swiperJs/swiper.min.js"></script>
<script type="text/javascript" src="/static/json/buy.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script src="/static/js/pl/djt_pl.js"></script>
<script>

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
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });
</script>
{{--<input type="checkbox" name="test" onclick="checkedThis(this);">1--}}
{{--<input type="checkbox" name="test" onclick="checkedThis(this);">2--}}
{{--<input type="checkbox" name="test" onclick="checkedThis(this);">3--}}
{{--<input type="checkbox" name="test" onclick="checkedThis(this);">4--}}
{{--<input type="checkbox" name="test" onclick="checkedThis(this);">5--}}
