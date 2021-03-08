<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>修改密码-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/grzx/xgmm.css">
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/css/grzx/jbxx.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
</head>
<body>
{{--修改密码--}}
@include('Pc.layout.personal')

<div class="wapper">
    <div class="grzx_main">
        @include('Pc.layout.personal_side')
        <div class="grzx_mainList">

            <div class="grzx_mainListD">
                <!-- 修改密码 -->
                <div class="gezxlist">
                    <p class="TiTle">修改密码</p>
                    <b class="bj"></b>
                    <div class="Change-Password">
                        <div class="register-top">
                            <span>1.验证身份</span>
                            <span class="jingdu">2.设置密码</span>
                            <span>3.完成</span>

                        </div>
                        <div class="register-con" id="rc">
                            <div class="register-conCenter" id="register-conCenter2">
                                <div class="aui-register-form-item ">
                                    <div class="item_top">
                                        <span class="spanL">输入旧密码</span>
                                        <input type="password" id="usedpwd" class="used_password" placeholder="请输入旧密码" autocomplete="off">
                                    </div>
                                    <div id="usedpwdId" class="YZ"></div>
                                </div>
                                <div class="aui-register-form-item ">
                                    <div class="item_top">
                                        <span class="spanL">设置新密码</span>
                                        <input type="password" id="pwd" class="password" placeholder="请输入新密码" autocomplete="off">
                                    </div>
                                    <div id="pwdId" class="YZ"></div>
                                </div>
                                <div class="aui-register-form-item ">
                                    <div class="item_top">
                                        <span class="spanL">确认新密码</span>
                                        <input type="password" id="repwd" class="passwords" placeholder="请再次输入密码" autocomplete="off">
                                    </div>
                                    <div id="repwdId" class="YZ"></div>
                                </div>
                                <div class="aui-register-form-item">
                                    <button type="button" class="btn" id="btn2">提交</button>
                                </div>
                            </div>
                            <div class="register-conCenter" id="register-conCenter3">
                                <dl>
                                    <dt><img src="/static/picImG/forgotpwd/22.png" alt=""></dt>
                                    <dd>
                                        <p>修改密码设置成功! </p>
                                    </dd>
                                </dl>
                            </div>
                            <!-- 验证成功之后， register-conCenter3 显示 2隐藏 -->
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
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script src="/static/json/grzx/modifypass.js"></script>