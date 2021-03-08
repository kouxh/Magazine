<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登陆-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <!-- 引入微信扫码登录js文件 -->
    <script type="text/javascript" src="/static/js/wx.js"></script>
    <script type="text/javascript">
        function Responsive($a) {
            if ($a == true) $("#Device").css("opacity", "100");
            if ($a == false) $("#Device").css("opacity", "0");
            $('#iframe-wrap').removeClass().addClass('full-width');
            $('.icon-tablet,.icon-mobile-1,.icon-monitor,.icon-mobile-2,.icon-mobile-3').removeClass('active');
            $(this).addClass('active');
            return false;
        };
    </script>
    
</head>
<body id="by">
<script src="/static/picJs/dzw.js" type="text/javascript" charset="utf-8"></script>
<div id="switcher">
    <div class="center">
        <div class="aui-register-left">
        </div>
        <div class="aui-register-popup" style="opacity: 0.7;">
            <div class="aui-register-box">
                <div class="aui-register-form" id="verifyCheck">
                    <div class="register-wrap" id="register-wrap">
                        <div class="register" id="register">
                            <div class="register-top" id="reg-top">
                                <h2 class="normal change" id="normal">密码登录</h2>
                                <h2 class="nopassword" id="nopw">动态登录</h2>
                                <a id="qrcode" href="javescript:,">
                                    <span class="aui-tag-size"><b></b>点击扫码登录</span>
                                    <span class="aui-tag-tp"></span>
                                </a>
                            </div>
                            <div class="clear"></div>
                            <div class="tab-box">
                                <!--账户密码登录-->
                                <div class="register-con div" id="rc">
                                    <div class="aui-register-form-item before1">
                                        <span class="user"></span>
                                        <input class="user-name" autocomplete="off" maxlength="11" placeholder="请输入手机号" class="txt03 f-r3 required "
                                               id="mobel">
                                        <div id="mobelId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item before">
                                        <span class="password_"></span>
                                        <input type="password" name="password" lay-verify="pass" maxlength="6" autocomplete="off" placeholder="请输入密码" id="pwd" class="layui-input">
{{--                                        <input class="password" name="password" autocomplete="off" placeholder="请输入密码" id="pwd">--}}
                                        <div id="pwdId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item">
                                        <a id="aui-btn-reg lands" class="aui-btn-reg lang" placeholder="" readonly="readonly" value="">登录</a>
                                    </div>
                                    <div class="aui-protocol">
                                        <p>没有账号？
                                            <a href="/loadRegister" class="ljzc"> 立即注册 </a>
                                            <a href="/forgotpwd" class="zhma"> 找回密码 </a></p>
                                        <p>
                                            <a class="dh"><span></span>400-819-1255</a></p>
                                    </div>

                                </div>
                                <!--手机动态码登录-->
                                <div class="login-con div" id="lc">
                                    <div class="aui-register-form-item before1 texDl h5-style">
                                        <span class="user"></span>
                                        <input type="text"  name="phone" placeholder="请输入手机号" keycodes="tel" maxlength="11"  id="tel">
                                        <span class="aui-get-code btn btn-gray f-r3 f-ml5 f-size13" id="time_box" disabled style="display:none;"></span>
                                        <input class="verifyYz  aui-get-code " id="J_getCode" type="button" style="width: 119px !important;right: 2px; text-align: center;border: none;text-indent:0px; line-height: 26px; height: 26px;padding-left: 0;"
                                               value="获取动态码" onclick="sendCode(this)" />
                                        <div id="telId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item h5-style">
                                        <span class="password_"></span>
                                        <input type="text" placeholder="请输入动态码" maxlength="6" id="verifyNo" class="txt02 f-r3 f-fl required"
                                               tabindex="2">
                                        <div id="codeId" class="YZ"></div>

                                    </div>
                                    <div class="verify-wrap" id="verify-wrap2" style="width:296px;margin-bottom: 22px;margin-left: 28px;">
                                        <div class="drag-progress dragProgress"></div>
                                        <span class="drag-btn dragBtn" style="left: -1px;"></span>
                                        <span class="fix-tips fixTips">请按住滑块，拖动到最右边</span>
                                        <span class="verify-msg sucMsg">验证通过</span>
                                    </div>
                                    <div class="aui-register-form-item h5-style">
                                        <a id="aui-btn-reg lands" class="aui-btn-reg landtwo" placeholder="" readonly="readonly" value="">登录</a>
                                    </div>
                                    <div class="aui-protocol">
                                        <p>没有账号？
                                            <a href="/loadRegister" class="ljzc"> 立即注册 </a>
                                            <a href="/forgotpwd" class="zhma"> 找回密码 </a></p>
                                        <p>
                                            <a href="#" class="dh"><span></span>400-819-1255</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- 扫码登录 -->
                            <div class="saoma" id="sm">
                                <div class="screen-tu" id="screen">
                                    <span class="aui-tag-size"><b></b>账号密码登陆</span><span class="aui-tag-tp2"></span>
                                </div>
                                <div class="saoma-box">
                                    <div class="aui-text-item">
                                        <h1>手机扫码,安全登陆</h1>
                                    </div>
                                    <div class="qr-code">
                                        <div id="login_container" class="wx_qrcode"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>
@include('Pc.layout.footer')
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/json/login.js" charset="utf-8"> </script>
<script type="text/javascript" src="/static/layui/layui.js" charset="utf-8"> </script>
<script type="text/javascript" src="/static/js/jq-slideVerify.js"></script>
<script type="text/javascript">
    $().ready(function() {
        $(".register-top h2").click(function(index) {
            //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
            var _index = $(this).index();
            //让内容框的第 _index 个显示出来，其他的被隐藏
            $(".tab-box>div").eq(_index).show().siblings().hide();
            //改变选中时候的选项框的样式，移除其他几个选项的样式
            $(this).addClass("change").siblings().removeClass("change");
        });
    });
</script>
<script type="text/javascript" src="/static/picJs/jquery.cookie.js"></script>

</body>
