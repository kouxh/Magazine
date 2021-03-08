<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的红包-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/grzx/hb.css">
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
</head>
<body>
<div class="wapper">
    @include('Pc.layout.personal')

    <div class="grzx_main">
        @include('Pc.layout.personal_side')
        <div class="grzx_mainList">
            <div class="grzx_mainListD">
                <!-- 我的红包 -->
                <div class="gezxlist">
                    <p class="TiTle">我的红包</p>
                    <b class="bj"></b>
                    <div class="tab_title">
                        <p class="TiTle">全部红包</p>
                        <table border="" cellspacing="" cellpadding="" id="envelopes">
                            <tr>
                                <th>红包名称</th>
                                <th>红包金额</th>
                                <th>有效期</th>
                                <th>使用规则</th>
                            </tr>
                            <tr>
                                <td>
                                    <dl>
                                        <dt><img src="/static/img/06.png" alt=""></dt>
                                        <dd>购物专享红包</dd>
                                    </dl>

                                </td>
                                <td>10元</td>
                                <td>
                                    <p>2019-08-18 08:30:00 开始</p>
                                    <p>2019-10-18 08:30:00 结束</p>
                                </td>
                                <td>满150元可用，限平装刊物使用</td>

                            </tr>
                        </table>
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
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(".tab_title li").click(function(index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
    });
</script>
