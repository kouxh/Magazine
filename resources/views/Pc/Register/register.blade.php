<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" href="/static/css/register.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
</head>
<body id="by">
<script src="/static/picJs/dzw.js" type="text/javascript" charset="utf-8"></script>
<div id="switcher">
    <div class="center">
        <ul>
            <div class="aui-register-popup">
                <div class="aui-register-box">
                    <div class="aui-register-form" id="verifyCheck">
                        <div class="register-wrap" id="register-wrap">
                            <div class="register" id="register">
                                <div class="register-top" id="reg-top">
                                    <h2 class="neWuser" id="normal"><span>注册新用户</span><label for="">已有账号?<a href="loadLogin">立即登陆</a></label></h2>
                                </div>
                                <!--账户密码登录-->
                                <div class="register-con" id="rc">
                                    <div class="aui-register-form-item  before1 ">
                                        <div class="item_top">
                                            <span class="spanL">用户名</span>
                                            <input type="text" id="userName" class="" placeholder="请输入用户名" autocomplete="off">
                                        </div>
                                        <div id="nickNameId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item ">
                                        <div class="item_top">
                                            <span class="spanL">密码</span>
                                            <input type="password" id="pwd" class="password" placeholder="请输入密码" autocomplete="off">
                                        </div>
                                        <div id="pwdId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item ">
                                        <div class="item_top">
                                            <span class="spanL">确认密码</span>
                                            <input type="password" id="repwd" class="passwords " placeholder="请输入确认密码" autocomplete="off">
                                        </div>
                                        <div id="repwdId" class="YZ"></div>
                                    </div>
                                    <div class="aui-register-form-item before">
                                        <div class="item_top">
                                            <span class="spanL">手机号</span>
                                            <div class="itemB ">
                                                <input type="text" id="tel" class="sj " placeholder="请输入手机号" maxlength="11" autocomplete="off">
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
                                        <label class="YZ" id="codeId"></label>

                                    </div>
                                    <div class="verify-wrap h5-verify" id="verify-wrap2" style="width:330px;margin-bottom: 24px;margin-left: 140px;">
                                        <div class="drag-progress dragProgress"></div>
                                        <span class="drag-btn dragBtn" style="left: -1px;"></span>
                                        <span class="fix-tips fixTips">请按住滑块，拖动到最右边</span>
                                        <span class="verify-msg sucMsg">验证通过</span>
                                    </div>
                                    <div class="aui-register-form-item_2">
                                        <button id="zc" class="aui-btn-reg zc">同意条款并注册</button><br>
                                        <input id="color-input-red" class="Xzhong" type="checkbox" checked="checked" name="color-input-red" value="#f0544d"
                                               autocomplete="off" />
                                        <label for="color-input-red"></label>
                                        <span class="label" id="label">
											<span type="checkbox " name="btn" id="btn1 "><span for="btn1">我已阅读并同意<a class="fwxy" id="fwxy">《服务协议》</a></span></sapn>
										</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </ul>
    </div>
    <div class="clear"></div>
</div>
@include('Pc.layout.footer')
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<!-- <script type="text/javascript" src="js/land.js"> </script> -->
<script type="text/javascript" src="/static/json/register.js"> </script>
<script type="text/javascript" src="/static/js/jq-slideVerify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    //注册服务协议
    layui.use('layer', function() {
        // 服务协议
        var layer = layui.layer;
        $('#fwxy').on('click', function() {
            layer.open({
                type: 2,
                title: ['管理会计研究网站服务协议'],
                maxmin: true,
                shadeClose: true, //点击遮罩关闭层
                area: ['800px', '570px'],
                content: '/fwxy',
                btn: ['确认', '取消'],
                cancel: function() {
                    // 你点击右上角 X 取消后要做什么

                }
            });
        });
    });
</script>
</body>