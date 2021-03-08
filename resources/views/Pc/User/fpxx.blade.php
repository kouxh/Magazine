<!DOCTYPE html>
{{--发票信息--}}
<html>
<head>
    <meta charset="utf-8">
    <title>发票信息-管理会计研究</title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/fpxx.css">
    <script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />

    <style>
        .content #chanpin1 ,#chanpin2 ,#chanpin3 {
            display: none;
        }
        .content #chanpin1{
            display: block;
        }
    </style>
</head>
<body>
<div class="wapper">
    @include('Pc.layout.personal')
    <div class="grzx_main">
        @include('Pc.layout.personal_side')
        <div class="grzx_mainList">
            <div class="grzx_mainListD">
                <!-- 收货地址 -->
                <div class="gezxlist">
                    <p class="TiTle">发票信息</p>
                    <b class="bj"></b>
                    <div class="fqxx" id="fqxx">
                        <div class="fplx">
                            <span>*</span>
                            发票类型： <select name="status" id="tabs">
                                <option id="1" value="1">个人发票</option>
                                <option id="2" value="2">增值税普通发票</option>
                                <option id="3" value="3">增值税专用发票</option>
                            </select></div>
                        <div class="fplx">
                            <span>*</span>
                            发票类型： <select name="status" id="fp_zz">
                                <option id="1" value="1">纸质</option>
                                <option id="2" value="2">电子</option>
                            </select></div>
                        <div id="content">
                            <div id="chanpin1">
                                <form class="layui-form" action="">
                                    <div class="layui-form-item">
                                        <div class="layui-inline">
                                            <label class="layui-form-label">电话</label>
                                            <div class="layui-input-inline">
                                                <input type="tel" autocomplete="off" lay-verify="required|phone" id="phone" class="layui-input" placeholder="请输入正确的手机号" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-inline">
                                            <label class="layui-form-label">邮箱</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="email" lay-verify="required|email" autocomplete="off" class="layui-input" placeholder="请输入正确的邮箱" value="" id="in_email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-input-block" style="margin-left: 0px">
                                            <button class="layui-btn" lay-submit="" style="width: 416px; background: #f3414d;" type="button"  lay-filter="demo1">立即提交
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="chanpin2" >
                                <p class="tsxx">填写增票资质信息<span>(所有信息均为必填)</span></p>
                                <form class="layui-form" action="">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">单位名称</label>
                                        <div class="layui-input-inline">
                                            <input type="text" lay-verify="required|Unit_name" maxlength="20"
                                                   autocomplete="off" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-inline">
                                            <label class="layui-form-label">纳税人识别码</label>
                                            <div class="layui-input-inline">
                                                <input type="text" id="in_taxpayer_code"name="" lay-verify="required|sbm" autocomplete="off" class="layui-input"  value="" id="in_company_name " style="text-transform:uppercase;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-inline">
                                            <label class="layui-form-label">邮箱</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="email" lay-verify="required|email" autocomplete="off" class="layui-input" placeholder="请输入正确的邮箱" value="" id="in_email2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-input-block" style="margin-left: 0px">
                                            <button class="layui-btn" lay-submit="" style="width: 416px; background: #f3414d;" lay-filter="demo2">确定
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="chanpin3">
                                <p class="tsxx">填写增票资质信息<span>(所有信息均为必填)</span></p>
                                　　<form class="layui-form" action="">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">单位名称</label>
                                        <div class="layui-input-inline">
                                            <input type="text"  lay-verify="required|Unit_name" maxlength="20"
                                                   autocomplete="off" class="layui-input" id="in_company_name2">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-inline">
                                            <label class="layui-form-label">纳税人识别码</label>
                                            <div class="layui-input-inline">
                                                <input type="text" id="in_taxpayer_code2"  lay-verify="required|sbm" autocomplete="off" class="layui-input" style="text-transform:uppercase;" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">注册地址</label>
                                        <div class="layui-input-inline">
                                            <input type="text"  lay-verify="required|Unit_name" maxlength="20"
                                                   autocomplete="off" class="layui-input" id="in_register_address">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">注册电话</label>
                                        <div class="layui-input-inline">
                                            <input type="tel" autocomplete="off" lay-verify="required|tellphone" id="in_register_tell" class="layui-input" >
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">开户银行</label>
                                        <div class="layui-input-inline">
                                            <input type="text"  lay-verify="required|yh" maxlength="20"
                                                   autocomplete="off" class="layui-input" id="in_deposit_bank">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">银行账户</label>
                                        <div class="layui-input-inline">
                                            <input type="text" autocomplete="off" lay-verify="required|number|zh" class="layui-input" id="in_bank_account">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-input-block" style="margin-left: 0px">
                                            <button class="layui-btn" lay-submit="" style="width: 416px; background: #f3414d;" lay-filter="demo3">确定
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
@include('Pc.layout.footer')

</body>
</html>
<script src="/static/json/grzx/fpxx.js"></script>
<script>
    $(function(){

    });
</script>
