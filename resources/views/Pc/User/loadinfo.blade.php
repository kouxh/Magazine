<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/jbxx.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />

</head>
<style>

</style>
<!--基本信息 -->
<body>
@include('Pc.layout.personal')

<div class="grzx_main">
    @include('Pc.layout.personal_side')
    <div class="grzx_mainList">
        <div class="grzx_mainListD">
            <p class="TiTle">基本信息</p>
            <b class="bj"></b>
            <div class="tab_title">
                <ul>
                    <li class="default">个人信息</li>
                    <li>更换头像</li>
                    <li>兴趣标签</li>
                </ul>
            </div>
            <div class="tab_subject">
                <div class="div">
                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">真实姓名</label>
                            <div class="layui-input-inline">
                                <input type="text" id="name" name="name" lay-verify="name" lay-verify="name"
                                       autocomplete="off" class="layui-input" value="{{ $data['info'] -> name }}">
                            </div>

                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">注册手机</label>
                                <div class="layui-input-inline">
                                    <input type="tel" autocomplete="off" lay-verify="required|phone" id="phone"
                                           class="layui-input" placeholder="请输入正确的手机号"
                                           value="{{ $data['info'] -> tell }}">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">注册邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="email" name="email" lay-verify="email" autocomplete="off"
                                           class="layui-input" placeholder="请输入正确的邮箱"
                                           value="{{ $data['info'] -> email }}">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">性别</label>

                            <div class="layui-input-block">
                                <input type="radio" name="sex" id="sex1" value="1" title="男" >
                                <input type="radio" name="sex" id="sex2" value="2" title="女">
                                {{--                                @if($data['info'] -> sex == '男')--}}
                                {{--                                    <input type="radio" name="sex" value="1" title="男" checked>--}}
                                {{--                                    <input type="radio" name="sex" value="2" title="女">--}}
                                {{--                                @else--}}
                                {{--                                    <input type="radio" name="sex" value="1" title="男">--}}
                                {{--                                    <input type="radio" name="sex" value="2" title="女" checked>--}}
                                {{--                                @endif--}}
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <div class="layui-inline">
                                <label class="layui-form-label">生日</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="birthday" id="birthday" lay-verify="date"
                                           placeholder="yyyy-MM-dd" autocomplete="off"
                                           class="layui-input" lay-verify="required"
                                           value="{{ $data['info'] -> birthday }}">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <div class="layui-inline">
                                <label class="layui-form-label">年龄段</label>
                                <div class="layui-input-inline">
                                    <select name="age" lay-verify="required" lay-search="" id="age">
                                        <option value="">年龄段</option>
                                        <option value="20-25">20-25</option>
                                        <option value="25-35">25-35</option>
                                        <option value="35-45">35-45</option>
                                        <option value="45以上">45以上</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">公司名称</label>
                            <div class="layui-input-inline">
                                <input type="text" id="company" name="company" lay-verify="required|title" maxlength="20"
                                       autocomplete="off" class="layui-input" value="{{ $data['info'] -> company }}">
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <div class="layui-inline">
                                <label class="layui-form-label">职位</label>
                                <div class="layui-input-inline">
                                    <select name="occupation" lay-search="" lay-verify="required" lay-search=""
                                            id="occupation">
                                        <option value="">职位</option>
                                        <option value="管理者">管理者</option>
                                        <option value="财务人">财务人</option>
                                        <option value="技术人">技术人</option>
                                        <option value="其他">其他</option>
                                        <option value="学生">学生</option>
                                    </select>
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
                <div class="div">
                    <div class="ghtx">
                        <div class="layui-upload" style="position: relative">
                            <button type="button" class="layui-btn" id="test1">上传本地图片</button>
                            {{--                            <p class="field">友情提示</p>--}}
                            {{--                            <p class="field">更换头像后，其他地方（如口碑榜等）的头像同时生效</p>--}}
                            <div class="layui-upload-list">
                                <img class="layui-upload-img" id="demo1">
                                <p id="demoText"></p>
                                <p id="dwxx" style="position: absolute;
    top: 50%;
    text-align: center;
    margin: 0 auto;
    left: 10px;
    line-height: 10px;
    transform: translateY(-50%);
    font-size: 14px;    color: #666;
    width: 256px;">仅支持JPG JPEG PNG图片，<br></br>支持大小小于5M</p>
                            </div>
                            <div class="layui-form-item" style="margin-top: 20px">
                                <div class="layui-input-block" style="margin-left: 0px">
                                    <button class="layui-btn" lay-submit=""
                                            style="padding: 0px;width: 200px; background: #f3414d;"
                                            lay-filter="demo2">保存
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="div xq">
                    <div class="sectionR_oneA">
                        <div class="sectionR_oneA_left">
                            <p>感兴趣标签</p>
                            <ul>
                                @foreach($data['follow'] as $key => $val)
                                    <li id="{{ $val -> id }}" onclick="Delete(id)" title="{{ $val -> title }}">
                                        <label for="setting-interest-s">{{ $val -> title }}</label>
                                    </li>
                                @endforeach
                                <div class="clear">
                                    {{--                                    @foreach($data['follow'] as $key => $val)--}}

                                    {{--                                        <span>{{ $val -> title }}</span>--}}
                                    {{--                                     @endforeach--}}
                                </div>
                            </ul>
                        </div>
                        <div class="sectionR_oneA_right">
                            <p>趣标签库</p>
                            <ul>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <p class="xq_p"><span class="btn" id="wc">完成</span></p>

                </div>
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
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/json/grzx/loadinfo.js" type="text/javascript" charset="utf-8"></script>

{{--<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>--}}
{{--<script src="/layui/layui.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<link rel="stylesheet" href="/layui/css/layui.css">--}}
<script type="text/javascript">
    function setcookie(name, value, seconds) {
        seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。
        var expires = "";
        if (seconds != 0) {      //设置cookie生存时间
            var date = new Date();
            date.setTime(date.getTime() + (seconds * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        document.cookie = name + "=" + escape(value) + expires + "; path=/";   //转码并赋值
    }

    {{--    修改手机号--}}
    $('.Verification').hide();
    $(".Obtain_Verification").hide();
    $('.modify').click(function () {
        // $('.modify').hide();
        $("#phone").attr("value", "");
        $(".Obtain_Verification").show();
        console.log()
        $('.Verification').show();
    })

    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) return unescape(arr[2]);
        else return null;
    }

    //初始化基本信息赋值
   var data = getCookie("informationData");
    if(data==null){
        // alert("noll")
    }else{
        var informationData = JSON.parse(data);
        console.log(data)
        console.log(informationData.name)
        $('#name').val(informationData.name);
        $('#email').val(informationData.email);//邮箱
        $('#company').val(informationData.company);//公司
        $('#birthday').val(informationData.birthday)
        // $('#birthday').attr('placeholder',informationData.birthday)
        $('#age').val(informationData.age);//年龄
        $('#occupation').val(informationData.occupation);//职位
        // $('#name').val(data.field.name);
        // $('#name').val(data.field.name);
        //性别
        $("input[name=sex][value=1]").attr("checked", informationData.sex == 1 ? true : false);
        $("input[name=sex][value=2]").attr("checked", informationData.sex == 2 ? true : false);
        JSON.parse(data)
    }
console.log(data)


    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#birthday',
            // value: new Date()
            value: '',
        });
        laydate.render({
            elem: '#date1'
        });
        //性别
        // $("input[name=sex][value=1]").attr("checked", informationData.sex == 1 ? true : false);
        // $("input[name=sex][value=2]").attr("checked", informationData.sex == 2 ? true : false);
        form.render(); //更新全部
        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            name: function (value) {
                if (value.length == 0) {
                    return '姓名不能为空';
                }
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '姓名不能有特殊字符';
                }
                if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '姓名首尾不能出现下划线\'_\'';
                }
                if (/^\d+\d+\d$/.test(value)) {
                    return '姓名不能全为数字';
                }
                if (value.length > 6) {
                    return '姓名不能大于6位';
                }
            },

            title: function (value) {
                if (value.length == 0) {
                    return '公司名称 不能为空';
                }
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '公司名称不能有特殊字符';
                }
                if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '公司名称首尾不能出现下划线\'_\'';
                }
                if (/^\d+\d+\d$/.test(value)) {
                    return '公司名称全为数字';
                }
                if (value.length > 25) {
                    return '公司名称不能大于25位';
                }
            },


        });
        //监听提交

        //基本信息
        form.on('submit(demo1)', function (datas) {
            var json = [];
            var informationobj = JSON.stringify(datas.field)
            $('#name').val();
            console.log(JSON.stringify(datas.field.name))
            var occupation = $('。')
            // data.field.Consignee
            $.ajax({
                type: "POSt",
                url: "/basicInfoApi",
                data: {info:JSON.stringify(datas.field)},
                success: function (data) {
                    console.log(data);
                    if (data.bol == true) {
                        layui.use('layer', function () {
                            layui.use('layer', function () {
                                layer.msg('完善成功', {
                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                }, function () {
                                    // location.href = '/';
                                    console.log('d')
                                    json.push(informationobj);
                                    setcookie('informationData', json)
                                    $('#birthday').val(informationData.birthday)


                                });
                            })
                        })
                    }
                },
                error: function () {
                    console.log("错误！！！")

                }
            });
            // layer.alert(JSON.stringify(data.field), {
            // 	title: '最终的提交信息'
            // })
            return false;
        });

    });


    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
    });
    $(".tab_ment li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
    });

    //更换头像
    var man_lJ = '';
    layui.use('upload', function () {
        var $ = layui.jquery,
            form = layui.form,

            upload = layui.upload;
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test1',
            url: '/laravelUploadImg',
            accept: 'file', //普通文件
            exts: 'jpg|png|gif|bmp|jpeg',
            before: function (obj) {
                // console.log(obj);
                $('#dwxx').hide();
                //预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            },
            done: function (res) {
                // console.log(res)
                man_lJ = res.data.src;
                //如果上传失败
                // console.log( man_lJ)
                // if (res.code > 0) {
                //     return layer.msg('上传失败');
                // }
                //上传成功
            },

        });
        form.on('submit(demo2)', function () {
            // console.log("dd");
            // console.log(man_lJ);
            $.ajax({
                type: "POSt",
                url: "/upUserPhotoApi",
                data: {
                    photo: man_lJ
                },
                success: function (data) {
                    // console.log(data);
                    if (data.bol == true) {
                        layui.use('layer', function () {
                            layui.use('layer', function () {
                                layer.msg('更换头像成功', {
                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                }, function () {
                                    // location.href = '/';
                                });
                            })
                        })
                    } else {
                        layui.use('layer', function () {
                            layui.use('layer', function () {
                                layer.msg('您还没有上传图片哦！', {
                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                }, function () {
                                    // location.href = '/';
                                });
                            })
                        })
                    }
                },
                error: function () {
                    console.log("错误！！！")

                }
            });


        })
    });
</script>
