<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link rel="stylesheet" href="swiperCss/swiper.min.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="picss/footer_header.css">
    <link rel="stylesheet" href="picss/xcConfirm.css">
    <link rel="stylesheet" href="picss/pic.css">
</head>
<body>
<script src="picJs/gmHeader.js" type="text/javascript" charset="utf-8"></script>
<div class="wapper">
    <div class="Tips qr"></div>
    <section id="section">
        <div class="section_D">
            <div class="category">
                <span class="span2">核对订单</span>
                <a href="./cart.html">返回购物车</a>
            </div>
            <table id="table" class="table qr ">
                <tr class="one_tr">
                    <th>商品信息</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>配送次数</th>
                    <th>小计</th>
                </tr>
                <!--
                <tr>
                    <td>
                        <dl>
                            <dt><img src="M-img/03.jpg" alt=""></dt>
                            <dd>
                                <h3>《管理会计研究》2019年第1期</h3>
                                <p>平装</p>
                            </dd>
                        </dl>
                    </td>
                    <td>260</td>
                    <td>
                        <p>
                            <label class="_Number"><span class="button  reduce">-</span><input type="text" value="1 " class="centent_number"><span
                                 class="button  plus">+</span>
                                <p>
                    </td>
                    <td>520</td>
                    <td align="center">
                        <span>删除</span>
                        <span>收藏</span>
                    </td>
                </tr> -->
                <tr class="clear"></tr>
            </table>
            <!-- 快递信息 -->
            <div class="kuaidx">
                <p>*<span>备注</span> <label><input type="text" placeholder="请添加备注"></label></p>
                <p><span class="XjdzR" id="XjdzR">新建收获地址</span></p>
                <p><span class="FpxX" class="btn_alert" id="fpXx">填写发票信息</span></p>
            </div>
            <div class="Settlement_D">
                <div class="Settlement_Dl">
                    <a href="./cart.html">返回购物车</a>
                </div>
                <div class="Settlement_DR">
                    <div class="remembertwo">
                        <p> <span>运费<i>x</i>元</span>/<span>免运费</span><span>总件数<i class="jians">0</i>件商品</span><span>应付总额<i class="total">¥2000.00</i></span></p>
                        <p> <span>收货信息:<i class="address" id="address"></i></span></p>
                    </div>
                    <div class="Settlement">立即结算</div>
                </div>
            </div>
    </section>
</div>
</body>
</html>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script src="layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/json/order.js"></script>
<script src="picJs/xcConfirm.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    layui.use('layer', function() {
        // 新建地址
        var layer = layui.layer;
        $('#XjdzR').on('click', function() {
            layer.open({
                type: 2,
                title: ['新建地址','background: #000;text-align: center; color:#fff'],
                maxmin: true,
                skin: 'demo-class',
                shadeClose: true, //点击遮罩关闭层
                area: ['800px', '570px'],
                content: './xjdz.html',
                btn: ['确认', '取消'],cancel : function(){
                    // 你点击右上角 X 取消后要做什么
                    $(this).css({
                        // "background":"red"
                    })
                }
            });
        });
        // 发票信息
        $('#fpXx').on('click', function() {
            layer.open({
                type: 2,
                title: ['发票信息', 'text-align: center;'],
                maxmin: true,
                shadeClose: true, //点击遮罩关闭层
                area: ['800px', '570px'],
                content: './fpXx.html',
                btn: ['确认', '取消']
            });
        });
    });


</script>
<script src="js/Fp.js" type="text/javascript" charset="utf-8"></script>
<!--


 -->
