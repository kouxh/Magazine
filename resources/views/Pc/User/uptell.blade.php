<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/jbxx.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/data.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/province3.js" type="text/javascript" charset="utf-8"></script>

</head>
<style>

</style>
<!--修改手机号 -->
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <p class="TiTle">修改手机号</p>
            <b class="bj"></b>
            <div class="tab_subject">
                <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">手机号</label>
                            <div class="layui-input-inline">
                                <input type="tel" autocomplete="off" lay-verify="required|phone" id="phone"
                                       class="layui-input" placeholder="请输入正确的手机号" value="18610164557">
                            </div>
                            <span class="Obtain_Verification">获取动态码</span>

                        </div>
                    </div>
                    <div class="layui-form-item Verification">
                        <div class="layui-inline">
                            <label class="layui-form-label">验证码</label>
                            <div class="layui-input-inline">
                                <input type="tel" autocomplete="off" placeholder="请输入正确的验证码" class="layui-input"
                                       value="">
                            </div>

                        </div>
                    </div>


                    <div class="layui-form-item">
                        <div class="layui-input-block" style="margin-left: 0px">
                            <button class="layui-btn" lay-submit="" style="width: 416px; background: #f3414d;"
                                    lay-filter="demo1">立即提交
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
{{--        <div class="info">--}}
{{--            <label>地址</label>--}}
{{--            <div>--}}
{{--                <select id="s_province" name="s_province"></select>  --}}
{{--                <select id="s_city" name="s_city"></select>  --}}
{{--                <select id="s_county" name="s_county"></select>--}}
{{--                <script class="resources library" src="/static/picJs/area.js" type="text/javascript"></script>--}}
{{--                <script type="text/javascript">_init_area();</script>--}}
{{--            </div>--}}
{{--            <div id="show"></div>--}}
{{--        </div>--}}
        <script type="text/javascript">
            var Gid = document.getElementById;
            var showArea = function () {
                Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +
                    Gid('s_city').value + " - 县/区" +
                    Gid('s_county').value + "</h3>"
            }

            Gid('s_county').setAttribute('onchange', 'showArea()');

        </script>

    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
@include('Pc.layout.footer')

<!-- <script src="/picJs/footer.js" type="text/javascript" charset="utf-8"></script> -->
</body>
</html>
{{--<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>--}}
{{--<script src="/layui/layui.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<link rel="stylesheet" href="/layui/css/layui.css">--}}

