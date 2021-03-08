<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    {{--    <link rel="stylesheet" href="/static/css/personal/personal_show.css">--}}
    <link rel="stylesheet" href="/static/picss/pic.css">
    {{--    <link rel="stylesheet" href="/static/css/grzx/mycart.css">--}}
    <link rel="stylesheet" href="/static/css/cart.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/grzx/creaaddress.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/data.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/province3.js" type="text/javascript" charset="utf-8"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <style type="text/css">
        .custom-layerb_R select {
            width: 20% !important;
        }
    </style>
</head>
<!-- 核对订单 -->
<body>
@include('Pc.layout.personal')
<div class="wapper" style="margin-top: 0px">
    <div class="Tips qr"></div>
    <section id="section">
        <div class="remembertwo dz">
            @if(empty($data['address']))
                <p><span>收货信息:<i id='address'
                                 class=""><span></span><span></span><span></span><span></span><span></span><span></span></i></span>
                </p>
            @else
                <p><span>收货信息:<i id='address'
                                 class="{{ $data['address'] -> id }}"><span>{{ $data['address'] -> consignee }}</span><span>{{ $data['address'] -> city }}</span><span>{{ $data['address'] -> area }}</span><span>{{ $data['address'] -> county }}</span><span>{{ $data['address'] -> desc_address }}</span><span>{{ $data['address'] -> tell }}</span></i></span>
                </p>
            @endif
            <p id="Edit_address1">编辑地址</p>
        </div>
        <div class="section_D">
            <div class="category">
                <span class="span2">核对订单</span>
                <a href="/mycart">返回购物车</a>
            </div>
            <table id="table" class="table qr1 ">
                <tr class="one_tr">
                    <th>商品信息</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>配送次数</th>
                    <th>小计</th>
                </tr>
                <tr class="clear"></tr>
            </table>
            <!-- 快递信息 -->
            <div class="kuaidx">
                <p><a>备注</a><label><input type="text" placeholder="请添加备注" id="remarksMsg"></label></p>
                <p><a class="FpxX" class="btn_alert" id="fpXx" href="/fpxx">填写发票信息</a><label class="Invoice_information"
                                                                                             style="    text-transform: uppercase;"></label>
                </p>
            </div>
            {{--            支付方式--}}
            <div class="pay_type">
                <div class="text_left">
                    <div class="layui-icon">&#xe630;</div>
                    <div class="text">支付方式：</div>
                </div>
                <div class="select">
                    <div class="layui-form select-form">
                        <input type="radio" id="isdisabled" name="level" lay-filter="levelM" value="1" title="余额支付"
                               checked>
                        <div class="remaining">{{Session::get('users')['balance']}}</div>
                        <input type="radio" id="ischecked" name="level" lay-filter="levelM" value="2" title="微信支付">
                        <div class="pay_icon"></div>
                    </div>
                </div>

            </div>
            <div class="Settlement_D" style="width: 100%">
                <div class="Settlement_Dl">
                    <a href="/mycart">返回购物车</a>
                </div>
                <div class="Settlement_DR">
                    <div class="remembertwo">
                        <p><span>免运费</span><span>总件数<i class="jians">0</i>件商品</span><span>应付总额<i
                                        class="total">¥</i></span>
                        </p>
                        @if(empty($data['address']))
                            <p><span>收货信息:<i id='address'
                                             class=""><span></span><span></span><span></span><span></span><span></span><span></span></i></span>
                            </p>
                        @else
                            <p><span>收货信息:<i id='address'
                                             class="{{ $data['address'] -> id }}"><span>{{ $data['address'] -> consignee }}</span><span>{{ $data['address'] -> city }}</span><span>{{ $data['address'] -> area }}</span><span>{{ $data['address'] -> county }}</span><span>{{ $data['address'] -> desc_address }}</span><span>{{ $data['address'] -> tell }}</span></i></span>
                            </p>
                        @endif
                        <p id="Edit_address">编辑地址</p>
                    </div>
                    <div class="Settlement">立即结算</div>
                </div>
            </div>

        </div>
    </section>
</div>
{{--编辑地址--}}
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
                    <option value="" class="sd">请选择省</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="cityid" id="cityid" lay-filter="cityid" class="xl" lay-verify="required">
                    <option value="">请选择市</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="areaid" id="areaid" lay-filter="areaid" class="xl" lay-verify="required">
                    <option value="">请选择县/区</option>
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
</body>
@include('Pc.layout.footer')
<script src="/static/json/grzx/orderpay.js"></script>
<script src="/static/json/grzx/xjdz.js" type="text/javascript" charset="utf-8"></script>

