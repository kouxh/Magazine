
{{--个人中心 首页--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
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
                                    <dt><img src="../picImg/zjtd/t4.jpg" alt=""></dt>
                                    <dd>
                                        <!-- 用户名 -->
                                        <p class="user">lihdf</p>
                                        <!-- 会员级别 -->
                                        <div class="member_level">
                                            <p><label></label>普通用户</p>
                                            <p><a href="">升级会员</a></p>
                                        </div>
                                        <!-- 查看级别详情 -->
                                        <a class="level_">查看会员级别</a>
                                    </dd>
                                </dl>
                                <!-- <div class="clear"></div> -->
                            </div>
                            <!-- 账户信息 -->
                            <div class="member member_two">
                                <dl>
                                    <dt>账户余额</dt>
                                    <dd><label for="" id="ye"></label><span>元</span></dd>
                                </dl>
                                <dl>
                                    <dt>积分</dt>
                                    <dd><label for="" id="jf"></label><span>分</span></dd>
                                </dl>
                                <dl>
                                    <dt>通知</dt>
                                    <dd><img src="/static/img/tsx.png" alt=""><span class="tz"></span></dd>
                                </dl>

                            </div>
                        </div>
                        <div class="MembershipCenter_R">
                            广告图
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
                    <div class="tab_title">
                        <ul>
                            <li class="default">所有订单</li>
                            <li class="default2">待支付</li>
                            <li>已支付</li>
                            <li>待发货</li>
                            <li>已发货</li>
                            <li>待评价</li>
                            <li>待评价</li>
                            <li>已完成</li>
                        </ul>
                        <!-- <div class="search" id="search">
                            <input type="text" placeholder="请输入内容">
                            <button type="button" class="button"></button>
                        </div>
-->
                    </div>
                    <div class="tab_subject">
                        <div class="div Order">
                            <ul class="MyOrderMainListTitle">
                                <li><select>
                                        <option value="">全部</option>
                                        <option value="">最近三个月订单</option>
                                    </select>
                                    <span class="shangP">商品</span>
                                </li>
                                <li>数量</li>
                                <li>单价</li>
                                <li>收货人</li>
                                <li>合计</li>
                                <li><select>
                                        <option value="">全部状态</option>
                                        <option value="">待支付</option>
                                        <option value="">已支付</option>
                                        <option value="">待发货</option>
                                        <option value="">已发货</option>
                                        <option value="">待评价</option>
                                        <option value="">已完成</option>
                                    </select></li>
                                <li>操作</li>
                            </ul>
                            <ul class="OrderListDetail">
                                <li>
                                    <div class="status">
                                        <div class="orderTitle">
                                            <p>订单号 :</p>
                                            <p>1125836690163929</p>
                                            <p>2019-08-27 18:27</p>
                                        </div>
                                        <ul class="oneShoppingList">
                                            <li>
                                                <img src="/img/06.png" alt="">
                                                <div class="productName">《管理会计研究》第一期 总第04期</div>
                                                <div class="productMain">起订日期</div>
                                                <div class="productTip">规格: 平装</div>
                                            </li>
                                            <li>
                                                <p>1</p>
                                            </li>
                                            <li>
                                                <p>¥<span>120</span></p>
                                            </li>
                                            <li></li>
                                        </ul>
                                        <div class="clearFix"></div>
                                    </div>
                                    <div class="statusAndControl" style="height: 170px;">
                                        <div class="nameTypeTable" style="height: 170px;">
                                            <div class="module">
                                                <p>李还</p>
                                            </div>
                                        </div>
                                        <div class="totalTypeTable" style="height: 170px;">
                                            <div class="module">
                                                <p>￥<span>710.00</span></p>
                                                <p>(含运费￥<sapn>10</sapn>)</p>
                                                <p>在线支付</p>
                                            </div>
                                        </div>
                                        <div class="statusTypeTable" style="height: 170px;">
                                            <div class="module">
                                                <p>已取消</p>
                                            </div>
                                        </div>
                                        <div class="controlTable" style="height: 170px;">
                                            <div class="module">
                                                <span class="span payment">立即支付</span>
                                                <span class="span OrderDetails">订单详情</span>
                                                <span class="span CancellationOrder">取消订单</span>
                                                <span class="span Repurchase">再次购买</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="clear"></li>
                            </ul>
                        </div>
                        <div class="div payment">
                            <ul class="MyOrderMainListTitle">
                                <li><select>
                                        <option value="">全部</option>
                                        <option value="">最近三个月订单</option>
                                    </select>
                                    <span class="shangP">商品</span>
                                </li>
                                <li>数量</li>
                                <li>单价</li>
                                <li>收货人</li>
                                <li>合计</li>
                                <li><select>
                                        <option value="">全部状态</option>
                                        <option value="">待支付</option>
                                        <option value="">已支付</option>
                                        <option value="">待发货</option>
                                        <option value="">已发货</option>
                                        <option value="">待评价</option>
                                        <option value="">已完成</option>
                                    </select></li>
                                <li>操作</li>
                            </ul>
                            <ul class="OrderListDetail">
                                <li>
                                    <div class="status">
                                        <div class="orderTitle">
                                            <p>订单号 :</p>
                                            <p>1125836690163929</p>
                                            <p>2019-08-27 18:27</p>
                                        </div>
                                        <ul class="oneShoppingList">
                                            <li>
                                                <img src="/staic/img/06.png" alt="">
                                                <div class="productName">《管理会计研究》第一期 总第04期</div>
                                                <div class="productMain">起订日期</div>
                                                <div class="productTip">规格: 平装</div>
                                            </li>
                                            <li>
                                                <p>1</p>
                                            </li>
                                            <li>
                                                <p>¥<span>120</span></p>
                                            </li>
                                            <li></li>
                                        </ul>
                                        <div class="clearFix"></div>
                                    </div>
                                    <div class="statusAndControl" style="height: 170px;">
                                        <div class="nameTypeTable" style="height: 170px;">
                                            <div class="module">
                                                <p>李还</p>
                                            </div>
                                        </div>
                                        <div class="totalTypeTable" style="height: 170px;">
                                            <div class="module">
                                                <p>￥<span>710.00</span></p>
                                                <p>(含运费￥<sapn>10</sapn>)</p>
                                                <p>在线支付</p>
                                            </div>
                                        </div>
                                        <div class="statusTypeTable" style="height: 170px;">
                                            <div class="module">
                                                <p>已取消</p>
                                            </div>
                                        </div>
                                        <div class="controlTable" style="height: 170px;">
                                            <div class="module">
                                                <span class="span payment">立即支付</span>
                                                <span class="span OrderDetails">订单详情</span>
                                                <span class="span CancellationOrder">取消订单</span>
                                                <span class="span Repurchase">再次购买</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="clear"></li>
                            </ul>
                        </div>
                        <div class="div">待发货</div>
                        <div class="div">待收货</div>
                        <div class="div">待评价</div>
                    </div>
                </div>
            </div>
            <div class="mAin">
                <div class="mAinL">
                    <p class="TiTle">我的关注</p>
                    <div class="bj"></div>
                    <div class="mAinLD"></div>
                </div>
                <div class="mAinR">
                    <p class="TiTle">猜你喜欢</p>
                    <div class="bj"></div>
                    <ul>
                        <li><a href="">提醒：成为会员享受折扣，还有电子期刊免费阅读哟！</a></li>
                        <li><a href="">提醒：成为会员享受折扣，还有电子期刊免费阅读哟！</a></li>
                        <li><a href="">提醒：成为会员享受折扣，还有电子期刊免费阅读哟！</a></li>
                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="gaojian">
                <div class="tab_ment">
                    <ul style="cursor:pointer;">
                        <li class="change">全部稿件</li>
                        <li>审核中</li>
                        <li>已采纳</li>
                        <li>未采纳</li>
                    </ul>
                </div>
                <div class="bj"></div>
                <div class="tab_box">
                    <div class="div ">
                        <form action="" method="" class="ManuscriptForm">
                            <table border="" cellspacing="" cellpadding="">
                                <tr>
                                    <th>稿件标题</th>
                                    <th>稿件编号</th>
                                    <th>投稿日期</th>
                                    <th>投稿栏目</th>
                                    <th>状态评价</th>
                                    <th>采纳状态</th>
                                    <th>获得积分</th>
                                </tr>
                                <tr>
                                    <td>
                                        <p>财务共享，一场跨国企业的“集体冲动”!</p>
                                    </td>
                                    <td>
                                        20190818001
                                    </td>
                                    <td>
                                        2019/8/18
                                        上午12:00:00
                                    </td>
                                    <td>
                                        新技术
                                    </td>
                                    <td>
                                        审核中
                                    </td>
                                    <td>
                                        无
                                    </td>
                                    <td>
                                        无
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="div ">审核中</div>
                    <div class="div ">已采纳</div>
                    <div class="div ">未采纳</div>
                </div>
            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>
</div>
@include('Pc.layout.footer')
{{--<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>--}}
{{--<script src="/layui/layui.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<link rel="stylesheet" href="../layui/css/layui.css">--}}
<!-- 个人中心 会员中心 -->
<script src="/static/js/personal/personal_show.js" type="text/javascript" charset="utf-8"></script>
{{--<script type="text/javascript">--}}
{{--    $(".tab_title li").click(function(index) {--}}
{{--        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量--}}
{{--        var _index = $(this).index();--}}
{{--        //让内容框的第 _index 个显示出来，其他的被隐藏--}}
{{--        $(".tab_subject>.div").eq(_index).show().siblings().hide();--}}
{{--        //改变选中时候的选项框的样式，移除其他几个选项的样式--}}
{{--        $(this).addClass("default").siblings().removeClass("default");--}}
{{--    });--}}
{{--    $(".tab_ment li").click(function(index) {--}}
{{--        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量--}}
{{--        var _index = $(this).index();--}}
{{--        //让内容框的第 _index 个显示出来，其他的被隐藏--}}
{{--        $(".tab_box>.div").eq(_index).show().siblings().hide();--}}
{{--        //改变选中时候的选项框的样式，移除其他几个选项的样式--}}
{{--        $(this).addClass("change").siblings().removeClass("change");--}}
{{--    });--}}
{{--    layui.use('upload', function() {--}}
{{--        var $ = layui.jquery,--}}
{{--            upload = layui.upload;--}}

{{--        //普通图片上传--}}
{{--        var uploadInst = upload.render({--}}
{{--            elem: '#test1',--}}
{{--            url: '/upload/',--}}
{{--            before: function(obj) {--}}
{{--                //预读本地文件示例，不支持ie8--}}
{{--                obj.preview(function(index, file, result) {--}}
{{--                    $('#demo1').attr('src', result); //图片链接（base64）--}}
{{--                });--}}
{{--            },--}}
{{--            done: function(res) {--}}
{{--                //如果上传失败--}}
{{--                if (res.code > 0) {--}}
{{--                    return layer.msg('上传失败');--}}
{{--                }--}}
{{--                //上传成功--}}
{{--            },--}}
{{--            error: function() {--}}
{{--                //演示失败状态，并实现重传--}}
{{--                var demoText = $('#demoText');--}}
{{--                demoText.html(--}}
{{--                    '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');--}}
{{--                demoText.find('.demo-reload').on('click', function() {--}}
{{--                    uploadInst.upload();--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
