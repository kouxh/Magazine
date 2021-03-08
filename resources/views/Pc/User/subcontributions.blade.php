<!DOCTYPE html>
<!-- 提交稿件 -->
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    {{--    <link rel="stylesheet" href="/static/layui/css/layui.css">--}}
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
</head>
<!--提交稿件 -->
<body>
@include('Pc.layout.personal')
<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <p class="TiTle">提交稿件</p>
            <b class="bj"></b>
            <div class="tjgj_div1">
                <p class="tjgj_div1_title">一、投稿内容：</p>
                <p class="tjgj_div1_center">以管理会计为主，涉及预算管理、成本管理、财务共享、数据分析等领域。对高质量的热点议题来稿，将优先刊用。</p>
                <p class="tjgj_div1_title">二、稿件要求：</p>
                <p class="tjgj_div1_center">
                    (1)选题具有前瞻性、新颖性、重要性、实用性；(2)观点新颖独到，具有学术参考价值或实务指导意义；(3)论述充分有力，研究方法严 谨创新；(4)请务必标
                    明中图分类号和文献标识码，请标明英文标题；（5）请把稿件重合率控制在15%以下。
                </p>
                <p class="tjgj_div1_title">三、投稿方式：</p>
                <p class="tjgj_div1_center">
                    请不要将同一文章重复向本刊投稿，可选择E-mail投稿及在线投稿（请投WORD文档格式）。
                </p>
                <p class="tjgj_div1_title">投稿邮箱：tg@chinamas.cn</p>
            </div>

            <div class="tjgj_div2">
                <p class="TiTle TiTle2">在线投稿</p>
                <form class="layui-form" action="" id="tjGj">
                    <div class="layui-form-item">
                        <label class="layui-form-label">稿件标题</label>
                        <div class="layui-input-block">
                            <input type="text" id="man_title" name="man_title" lay-verify="required|man_title" autocomplete="off"
                                   value=""  placeholder="请输入稿件标题" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item" pane="">
{{--                        <div class="layui-inline">--}}
                            <label class="layui-form-label">投稿栏目</label>
                            <div class="layui-input-block">
                                <select name="man_column" lay-verify="required" lay-search="" id="man_column" lay-verify="required">
                                    <option value="">投稿栏目</option>
                                    <option value="业界">业界</option>
                                    <option value="观察">观察</option>
                                    <option value="案例">案例</option>
                                    <option value="理论前沿">理论前沿</option>
                                    <option value="新技术">新技术</option>
                                    <option value="人物">人物</option>
                                    <option value="文库">文库</option>
                                    <option value="活动">活动</option>
                                    <option value="杂志">杂志</option>
                                </select>

                            </div>
{{--                        </div>--}}
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" >作者</label>
                        <div class="layui-input-block" >
                            <input type="text" name="man_author" id="man_author" autocomplete="off"
                                   placeholder="请输入作者姓名" lay-verify="required|man_author" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
{{--                        <div class="layui-inline">--}}
                            <label class="layui-form-label">联系方式</label>
                            <div class="layui-input-block">
                                <input type="tel" lay-verify="required|phone" autocomplete="off" placeholder="请输入手机号"  class="layui-input" name="man_tell" id="man_tell">
                            </div>
{{--                        </div>--}}
                    </div>
                    <div class="layui-form-item">
{{--                        <div class="layui-inline">--}}
                            <label class="layui-form-label">邮箱</label>
                            <div class="layui-input-block">
                                <input type="text" name="man_email" id="man_email" lay-verify="required|email" autocomplete="off"
                                       class="layui-input" placeholder="请输入邮箱" >
                            </div>
{{--                        </div>--}}
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">工作单位</label>
                        <div class="layui-input-block">
                            <input type="text" name="man_work" id="man_work" lay-verify="required|man_work"  autocomplete="off"
                                   placeholder="请输入工作单位" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-form-item" pane="">
{{--                        <div class="layui-inline">--}}
                            <label class="layui-form-label">职务</label>
                            <div class="layui-input-block">
                                <select name="man_post"  lay-verify="required" id="man_post">
                                    <option value="">职位</option>
                                    <option value="管理者">管理者</option>
                                    <option value="财务人员">财务人员</option>
                                    <option value="技术人员">技术人员</option>
                                    <option value="教育工作者">教育工作者</option>
                                    <option value="学生">学生</option>
                                </select>
                            </div>
{{--                        </div>--}}
                    </div>
                    <div class="layui-form-item" pane="">
{{--                        <div class="layui-inline">--}}
                            <label class="layui-form-label">上传稿件</label>
                            <div class="layui-input-block">
                            <button type="button" class="button-upload" id="test3" >点击上传文件</button>
                                <span class="_ts"></span>
                                <span class="Tips" id="Tips" style="color: #f3414d;font-size: 14px;display: block;
    line-height: 36px">支持文档 格式有pdf,doxc</span>

                            </div>
{{--                    </div>--}}
            </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit="" style="width: 416px; background: #f3414d;"
                                lay-filter="demo1" id="button">提交
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

@include('Pc.layout.footer')

</body>
</html>
{{--<script src="/layui/layui.js" type="text/javascript" charset="utf-8"></script>--}}
<script src="/static/json/grzx/subcontributions.js"></script>
<script type="text/javascript">
    // var man_filepath = '';
    //
    // function getCookie(name) {
    //     var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    //     if (arr = document.cookie.match(reg)) return unescape(arr[2]);
    //     else return null;
    // }
    //
    // layui.use(['form', 'layedit', 'laydate'], function () {
    //     var form = layui.form,
    //         layer = layui.layer,
    //         layedit = layui.layedit,
    //         laydate = layui.laydate;
    //
    //     form.verify({
    //         //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
    //         // digital: [
    //         //     /^[0-4]*$/
    //         //     ,'请填入0-4的分数'
    //         // ]
    //     });
    //     // form.on("submit(submit_button)", function (data) {
    //     //     return false;
    //     // });
    //     //监听提交
    //     form.on('submit(demo1)', function () {
    //         var man_title = $('#man_title').val();
    //         var man_column = $('#man_column').val();
    //         var man_author = $('#man_author').val();
    //         var man_tell = $('#man_tell').val();
    //         var man_email = $('#man_email').val();
    //         var man_work = $('#man_work').val();
    //         var man_post = $('#man_post').val();
    //         var man_filepath = $('#man_filepath').val();
    //         consoel.log(man_title+man_column)
    //         // var datas= {"man_title ": man_title, "man_title": man_title,//稿件标题
    //         //     "man_column": man_column,//稿件栏目
    //         //     "man_autho": man_autho,//稿件作者
    //         //     // "man_tell": man_tell,//联系方式
    //         //     // "man_email": man_email, //邮箱地址
    //         //     // "man_work": man_work,// 工作单位
    //         //     // "man_post": man_post,
    //         //     // "man_filepath": man_filepath,
    //         // }
    //         console.log(man_title);
    //
    //         // console.log(datas)
    //         // $.ajax({
    //         //     type: "POSt",
    //         //     url: "/laravelUploadImg",
    //         //     data:data,
    //         //     success: function (data) {
    //         //         console.log(data);
    //         //         if (data.bol == true) {
    //         //             alert("完善成功")
    //         //         }
    //         //
    //         //     },
    //         //     error: function () {
    //         //         console.log("错误！！！")
    //         //
    //         //     }
    //         // });
    //         // layer.alert(JSON.stringify(data.field), {
    //         //     title: '最终的提交信息'
    //         // })
    //         return false;
    //     });
    //     // upload.render({
    //     //     elem: '#test3'
    //     //     ,url: 'https://httpbin.org/post' //改成您自己的上传接口
    //     //     ,accept: 'file' //普通文件
    //     //     ,done: function(res){
    //     //         layer.msg('上传成功');
    //     //         console.log(res);
    //     //     }
    //     // });
    //     //表单初始赋值
    // });
    // $(".tab_title li").click(function (index) {
    //     //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
    //     var _index = $(this).index();
    //     //让内容框的第 _index 个显示出来，其他的被隐藏
    //     $(".tab_subject>.div").eq(_index).show().siblings().hide();
    //     //改变选中时候的选项框的样式，移除其他几个选项的样式
    //     $(this).addClass("default").siblings().removeClass("default");
    // });
    // $(".tab_ment li").click(function (index) {
    //     //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
    //     var _index = $(this).index();
    //     //让内容框的第 _index 个显示出来，其他的被隐藏
    //     $(".tab_box>.div").eq(_index).show().siblings().hide();
    //     //改变选中时候的选项框的样式，移除其他几个选项的样式
    //     $(this).addClass("change").siblings().removeClass("change");
    // });
    // layui.use('upload', function () {
    //     var $ = layui.jquery,
    //         upload = layui.upload;
    //     //普通图片上传
    //     // upload.render({
    //     //         elem: '#test3'
    //     //     ,url: 'https://httpbin.org/post' //改成您自己的上传接口
    //     //     ,accept: 'file' //普通文件
    //     //     ,done: function(res){
    //     //         layer.msg('上传成功');
    //     //         console.log(res);
    //     //     }
    //     // });
    //     var uploadInst = upload.render({
    //         elem: '#test3',
    //         url: '/laravelUploadImg',
    //         accept: 'file', //普通文件
    //         exts: 'pdf|doxc',
    //         before: function (obj) {
    //             console.log(obj)
    //             //预读本地文件示例，不支持ie8
    //             obj.preview(function (index, file, result) {
    //                 console.log(index);
    //                 console.log(file);
    //                 console.log(result)
    //             });
    //         },
    //         done: function (res) {
    //             //如果上传失败
    //             console.log(res)
    //             if (res.code > 0) {
    //                 return layer.msg('上传失败');
    //             } else {
    //                 return layer.msg('上传成功');
    //                 console.log('')
    //                 man_filepath = res.data;
    //                 ///upload/2020/04/01/15857295112414.pdf
    //
    //             }
    //         },
    //         error: function () {
    //             //演示失败状态，并实现重传
    //             var demoText = $('#demoText');
    //             demoText.html(
    //                 '<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
    //             demoText.find('.demo-reload').on('click', function () {
    //                 uploadInst.upload();
    //             });
    //         }
    //     });
    // });
</script>
