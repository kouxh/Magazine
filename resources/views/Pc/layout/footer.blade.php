<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    
</head>
<body>
<div class="footer" id="footer">
    <div class="footerD">
        <div class="footerLeft">
            <ul>
                <li><a class="footer-bt">学术支持单位</a></li>
                <li><a class="footer-bt">中国人民大学管理会计研究中心</a></li>
                <li><a class="footer-bt">上海财经大学管理会计项目研究中心</a></li>
                <li><a class="footer-bt">西南财经大学中国管理会计研究中心</a></li>
                <li><a class="footer-bt">江苏管理会计研究中心</a></li>
                <li><a class="footer-bt">元年管理会计研究院</a></li>
            </ul>
            <ul>
                <li><a class="footer-bt">战略合作单位</a></li>
                <li><a class="footer-bt">中国医药会计学会</a></li>
                <li><a class="footer-bt">上海市成本研究会</a></li>
            </ul>
            <ul>
                <li><a class="footer-bt">关于<img src="/static/img/32.png" alt=""></a></li>
                <li><a class="footer-bt">关于我们</a></li>
                <li><a class="footer-bt">联系方式：400-819-1255</a></li>
            </ul>
        </div>
        <div class="footerRight">
            <dl>
                <dt><img src="/static/picImG/header-footer/footer.jpg" alt=""></dt>
                <dd>官方微信</dd>
            </dl>

        </div>
    </div>
    <div class="footerB">
        <p>
            <a href="/flsm" class="flsm">法律声明</a>  北京元年诺亚舟咨询有限公司版权所有 <a href="http://www.beian.miit.gov.cn" class="record">京ICP备17056011号-2</a>京公网安备 11010802027279
        </p>
        <p class="paragraph"><span>地址：北京市海淀区知春路68号院1号楼三层301-12</span> <span>电话：010-82252999</span></p>

    </div>
</div>
<div class="footer_yd">
    <div class="footer_yd_main">
        <div class="footer_tab">
            <div class="footer_tab-menu">
                <p class="Collapsing"><label for="">学术支持单位</label><span>+</span></p>
                <div class="coll_body">
                    <ul>
                        <li><a class="footer-bt">中国人民大学管理会计研究中心</a></li>
                        <li><a class="footer-bt">上海财经大学管理会计项目研究中心</a></li>
                        <li><a class="footer-bt">西南财经大学中国管理会计研究中心</a></li>
                        <li><a class="footer-bt">江苏管理会计研究中心</a></li>
                        <li><a class="footer-bt">元年管理会计研究院</a></li>
                    </ul>
                </div>
                <p class="Collapsing"><label for="">战略合作单位</label><span>+</span></p>
                <div class="coll_body">
                    <ul>
                        <li><a class="footer-bt">中国医药会计学会</a></li>
                        <li><a class="footer-bt">上海市成本研究会</a></li>
                    </ul>
                </div>
                <p class="Collapsing" ><label>关于<img src="/static/img/32.png" alt=""></a></label><span>+</span></p>
                <div class="coll_body">
                    <ul>
                        <li><a class="footer-bt">关于我们</a></li>
                    </ul>
                </div>

            </div>

        </div>
        <div class="contact">联系方式：400-819-1255</div>
        <p class="paragraph">
            <a href="/flsm.html" class="flsm">法律声明</a><span>北京元年科技股份有限公司版权所有</span><span> <a href="http://www.beian.miit.gov.cn" class="record">京ICP备17056011号-2</a>  京公网安备 11010802027279</span>

        </p>
        <p class="paragraph"><span>地址：北京市海淀区知春路68号院1号楼三层301-12</span> <span>电话：010-82252999</span></p>
        <dl>
            <dt><img src="/static/picImG/header-footer/footer.jpg" alt=""></dt>
            <dd>官方微信</dd>
        </dl>

    </div>
</div>

{{--360自动抓取页面--}}
<script>
    (function(){
        var src = "https://jspassport.ssl.qhimg.com/11.0.1.js?d182b3f28525f2db83acfaaf6e696dba";
        document.write('<script src="' + src + '" id="sozz"><\/script>');
    })();
</script>

</body>
</html>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
{{--<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<link rel="stylesheet" href="/static/layui/css/layui.css">--}}
<script type="text/javascript">
    $().ready(function() {
        $(".Collapsing").click(function() {
            $(this).toggleClass("current").siblings('.Collapsing').removeClass("current"); //切换图标
            $(this).next(".coll_body").slideToggle(500).siblings(".coll_body").slideUp(500);
        });
    });
    //自动推送
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
    //百度统计
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?f9f26394467d66acbd5a05013241107e";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();

</script>
