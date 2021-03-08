<!DOCTYPE html>
{{--收货地址--}}
<html>
<head>
    <meta charset="utf-8">
    <title>收货地址-管理会计研究</title>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="author" content="元年科技股份有限公司"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <link rel="stylesheet" href="/static/css/grzx/shdz.css">
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    {{--    编辑地址 新建地址--}}
    <link rel="stylesheet" href="/static/css/grzx/creaaddress.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/picss/xcConfirm.css">
    <script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/data.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/province3.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css">

    </style>
    <script type="text/javascript">
        var defaults = {
            s1: 'provid',
            s2: 'cityid',
            s3: 'areaid',
            v1: null,
            v2: null,
            v3: null
        };
        // var defaults = {
        //     s1: 'city',
        //     s2: 'area',
        //     s3: 'county',
        //     v1: null,
        //     v2: null,
        //     v3: null
        // };
    </script>

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
                    <p class="TiTle">收货地址 <span class="xjdz" id="XjdzR" style="cursor: pointer;"><i>+</i>新建收货地址</span></p>
                    <b class="bj"></b>
                    <div class="Receiving-address">
                        <p class="Tips">最多保存10个有效地址</p>
                        <ul id="address">
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="layui-form layui-form-pane custom-layerD" action="" lay-filter="example" id="New_address"
      style="display: none">
    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label"><em>*</em>收货人</label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text" lay-verType id="name" name="consignee" lay-verify="required|title" autocomplete="off"
                   placeholder="请输入姓名" class="layui-input">
        </div>
        <div id="usedpwdId" class="YZ"></div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item custom-layerD_" id="sjld">
        <label class="layui-form-label"><em>*</em>选择地区</label>
        <div class="custom-layerb_R">
            <div class="layui-input-inline">
                <select name="provid" id="provid" lay-filter="provid" class="xl" lay-verify="required" lay-search="ni">
                    <option value="" class="sd">请选择</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="cityid" id="cityid" lay-filter="cityid" class="xl" lay-verify="required">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="areaid" id="areaid" lay-filter="areaid" class="xl" lay-verify="required">
                    <option value="">请选择</option>
                </select>
            </div>
        </div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label"><em>*</em>详细地址</label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text" id="desc_address" name="desc_address" class="module-text select580 Consignee" required
                   lay-verify="required|desc_address"
                   placeholder="请输入详细地址" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="errorMessage"></div>

    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label"><em>*</em>手机号</label>
        <div class="layui-input-block custom-layerb_R">
            <input name="phone" class="layui-input" id="tell" type="tel" autocomplete="off" placeholder="请输入手机"
                   lay-verify="phone">
        </div>
    </div>
    <div class="errorMessage"></div>

    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label">固定号码</label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text" id="fixed_number" name="fixed_number" lay-verify=""
                   class="module-text select180 Consignee" placeholder="请输入固定号码"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="errorMessage"></div>
    <div class="layui-form-item custom-layerD_">
        <label class="layui-form-label">邮政编码 </label>
        <div class="layui-input-block custom-layerb_R">
            <input type="text" id="zip_code" name="zip_code" lay-verify="" class="module-text select180 Consignee"
                   placeholder="请输入邮政编码"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="errorMessage"></div>
</form>
{{--lhy--}}
<div class="clear"></div>
@include('Pc.layout.footer')

</body>
</html>

<script src="/static/json/grzx/harvestaddress.js"></script>

