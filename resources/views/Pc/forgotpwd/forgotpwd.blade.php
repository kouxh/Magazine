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
    <title>找回密码-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/forgotpwd.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
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
    <div class="center" id="center">
        <div class="aui-register-popup">
            <div class="aui-register-box">
                <div class="aui-register-form" id="verifyCheck">
                    <div class="register-wrap" id="register-wrap">
                        <div class="register" id="register">
                            <div class="register-top" id="reg-top">
                                <dl class="jingdu">
                                    <dt><img src="/static/picImG/forgotpwd/01.jpg" alt=""></dt>
                                    <dd>1.账户验证</dd>
                                </dl>
                                <dl class="">
                                    <dt><img src="/static/picImG/forgotpwd/02.jpg" alt=""></dt>
                                    <dd>2.设置新密码</dd>
                                </dl>
                                <dl class="">
                                    <dt><img src="/static/picImG/forgotpwd/03.jpg" alt=""></dt>
                                    <dd>3.完成</dd>
                                </dl>
                            </div>
                            <!--账户密码登录-->
                            <div class="register-con" id="rc">
                                <div class="register-conCenter" id="register-conCenter1">
                                    <div class="aui-register-form-item  before1 ">
                                        <div class="item_top">
                                            <span class="spanL">用户名</span>
                                            <input type="text" id="userName" class="" placeholder="请输入用户名" autocomplete="off">
                                        </div>
                                        <div id="nickNameId" class="YZ"></div>
                                    </div>

                                    <div class="aui-register-form-item before">
                                        <div class="item_top">
                                            <span class="spanL">手机号</span>
                                            <div class="itemB ">
                                                <input type="text" id="tel" class="sj " maxlength="11" placeholder="请输入正确的手机号" autocomplete="off">
                                                <input class="verifyYz Verification  aui-get-code " id="J_getCode Verification" type="button" style="
														text-align: center;width:137px;line-height: 37px;margin-top: 0px;top: 0;right: 0;padding: 0;"
                                                       value="获取动态码" onclick="sendCode(this)" />
                                            </div>
                                        </div>
                                        <div id="telId" class="YZ"></div>
                                    </div>

                                    <div class="aui-register-form-item">
                                        <div class="item_top">
                                            <span class="spanL">验证码</span>
                                            <input type="text" id="code" class="code " placeholder="请输入验证码">
                                        </div>
                                        <div class="YZ" id="codeId"></div>
                                    </div>
                                    <div class="verify-wrap" id="verify-wrap2" style="width:330px;margin-bottom: 24px;margin-left: 88px;">
                                        <div class="drag-progress dragProgress"></div>
                                        <span class="drag-btn dragBtn" style="left: -1px;"></span>
                                        <span class="fix-tips fixTips">请按住滑块，拖动到最右边</span>
                                        <span class="verify-msg sucMsg">验证通过</span>
                                    </div>
                                    <div class="aui-register-form-item">
                                        <button type="button" class="btn" id="btn1">下一步</button>
                                    </div>
                                </div>
                                <div class="register-conCenter" id="register-conCenter2">
                                    <div class="aui-register-form-item ">
                                        <div class="item_top">
                                            <span class="spanL">设置密码</span>
                                            <input type="password" id="pwd" class="password" placeholder="请输入密码" autocomplete="off">
                                        </div>
                                        <div id="pwdId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item ">
                                        <div class="item_top">
                                            <span class="spanL">确认密码</span>
                                            <input type="password" id="repwd" class="passwords " placeholder="请确认密码" autocomplete="off">
                                        </div>
                                        <div id="repwdId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item">
                                        <button type="button" class="btn" id="btn2">下一步</button>
                                    </div>
                                </div>
                                <div class="register-conCenter" id="register-conCenter3">
                                    <dl style="padding-left:90px;">
                                        <dt><img src="/static/picImG/forgotpwd/22.png" alt=""></dt>
                                        <dd>
                                            <p>新密码设置成功! 请牢记您新设置的密码。</p>
                                            <a href="/">返回首页</a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('Pc.layout.footer')

<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<!-- <script type="text/javascript" src="js/logo.js" charset="utf-8"> </script> -->
 <script type="text/javascript" src="/static/json/forgotpwd.js" charset="utf-8"> </script>
<script type="text/javascript" src="/static/js/jq-slideVerify.js"></script>
<script type="text/javascript" src="/static/layui/layui.js" charset="utf-8"> </script>
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
