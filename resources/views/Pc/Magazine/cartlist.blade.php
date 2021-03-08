<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link rel="stylesheet" href="/static/swiperCss/swiper.min.css">
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" href="/static/css/cart.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
</head>
@include('Pc.layout.gmheader')
<body>
<!-- 购买头部导航 -->
<div class="wapper">
    <div class="Tips guc">
    </div>
    <section id="section">
        <div class="section_D">
            <div class="category">
                <span class=" span2">我的购物车</span>
            </div>
            <table id="table" class="table">
                <tr class="one_tr">
                    <th id="checkAll"><span><input type="checkbox"/>全选</span></th>
                    <th>商品信息</th>
                    <th>定价(元)</th>
                    <th>数量</th>
                    <th>小计(元)</th>
                    <th>操作</th>
                </tr>

                <tr class="clear"></tr>
            </table>
            <div class="Settlement_D">
                <div class="Settlement_Dl">
                    <th><input type="checkbox" name="" id="" value="" />全选</th><span class="qkgwc">清空购物车</span>
                </div>
                <div class="Settlement_DR">
                    <div class="remember">
                        <p> <span>已选<i id="numAll">0</i>件商品</span>共计:<i id="total">24000</i></p>
                        <p>折扣:<span>0</span></p>
                    </div>
                    <div class="Settlement">立即结算</div>

                </div>


            </div>
            <!-- 失效 -->
            <div class="Invalid">
                <p><span>已失效商品<i>2</i>件</span><span>清空失效产品</span></p>
                <ul>
                    <li>
                        <dl>
                            <dt>
                                <span>已失效</span>
                                <img src="static/M-img/02.jpg" alt="">
                            </dt>
                            <dd>
                                <h3>《管理会计研究》2019年第1期</h3>
                                <p>该商品已不能购买,有问题请咨询客服</p>
                            </dd>
                        </dl>
                        <div class="operation">
                            <span>删除</span>
                            <span>客服</span>
                        </div>
                    </li>
                    <li>
                        <dl>
                            <dt>
                                <span>已失效</span>
                                <img src="static/M-img/02.jpg" alt="">
                            </dt>
                            <dd>
                                <h3>《管理会计研究》2019年第1期</h3>
                                <p>该商品已不能购买,有问题请咨询客服</p>
                            </dd>
                        </dl>
                        <div class="operation">
                            <span>删除</span>
                            <span>客服</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>
</body>
</html>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/json/cart.js"> </script>
