<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <title>管理会计研究--专业管理会计信息传播与互动交流平台</title>
    <meta name="keywords" content="管理会计,管理会计信息化,管理会计工具,数字化转型,财务转型,财务管理,智能财务,财务智能化,人工智能,预算管理,成本管理 ,绩效管理,合并报表管理,管理会计报告,财务共享,大数据,商业智能,数据分析" />
    <meta name="description" content="管理会计研究网高度关注财务转型、数字化转型浪潮中我国会计领域的理论演进和企事业单位的管理实践和新技术应用，深入诠释与持续传播实用案例、智能技术应用和前沿理论，为管理会计人搭建一个经验交流、互动学习的专业平台。" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="/static/swiperCss/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/Home.css" />
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.0/skins/default/aliplayer-min.css" />
    <script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.0/aliplayer-min.js"></script>
    <script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/layui/data.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="import" href="/static/tips/header.html" id="page1" />
</head>
@include('Pc.layout.header')

<style>
    .Home-section4_cB ul li {
        height: 82px;
    }

    .Home-section4_cB ul li:nth-child(1) {
        float: left;
        width: 604px;
        height: 404px;
        margin-top: 0px;
        padding-bottom: 0px;
        margin-left: 0px;
        border-bottom: none;
    }
    #footer .footerD {
    width: 1120px;
    margin: 0 auto;
    height: 315px;
    padding-top: 60px;
   }
   
</style>

<body>

    <div class="wapper" id="wapper">
        <div class="banner">
            <a href="{{$data['img'][0] -> Pc_banner_url}}">
                <img src="{{ $data['img'][0] -> Pc_banner }}" alt="" class="pc_banner">
                <img src="{{ $data['img'][0] -> App_banner }}" alt="" class="yd_banner">
            </a>
        </div>
        <section>
            <div class="Home-section1" id="Home-section1">
                <div class="Home-section1D">
                    <div class="Home-section1D_l D_ Gc">
                        <h2>观察</h2>
                        <b class="bj"></b>
                        <div class="Gc_1">
                            @foreach($data['observation'] as $k => $v)
                            <a href="/gc/list/{{$v -> id}}" class="gc">
                                <dl id="observation{{$v -> id}}">
                                    <dt><img src="{{ $v -> img }}" alt=""></dt>
                                    <dd>
                                        <p class="title">{{$v -> title}}</p>
                                        <p class="message">{{$v -> message}}</p>
                                        <p class="p2">{{ $v -> crea_at }}</p>
                                    </dd>
                                </dl>
                            </a>
                            @endforeach
                            <a href="/gc/list" class="ck">查看更多</a>
                        </div>
{{--                        <a href="/gc/list" class="ck">查看更多</a>--}}

                    </div>
                    <div class="Home-section1D_C D_ jD">
                        <h2>荐读</h2>
                        <b class="bj"></b>
                        @foreach($data['recommended'] as $k => $v)
                        <dl id="recommended{{$v -> id}}" class="recommended">
                            <a href="/jd/list/{{$v -> id}}">
                                <dt><img src="{{ $v -> img }}" alt=""></dt>
                                <dd>
                                    <p class="title">{{$v -> title}}</p>
                                </dd>
                            </a>
                        </dl>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                    <div class="Home-section1D_l D_ Xw2">
                        <h2>新闻</h2>
                        <b class="bj"></b>
                        <div class="news">
                            <ul>
                                @foreach($data['news'] as $k => $v)
                                    <li id="yjwz{{$v -> id}}">
                                        <a href="/xw/list/{{$v -> id}}">
                                            <p class="p1">{{$v -> title}}</p>
                                            <p class="p3">{{$v -> message}}</p>
                                            <p class="p2">{{$v -> crea_at}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="/xw/list" class="ck">查看更多</a>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Home-section1 end -->
            <!-- <b class="bj"></b> -->
            <div class="Home-section2">

                <img src="{{ $data['img'][0] -> Pc_advert }}" alt="" class="pc">
                <img src="{{ $data['img'][0] -> App_advert }}" alt="" class="yd">
                <a class="Home-section2-bg" href="{{ $data['img'][0] -> Pc_advert_url }}">
                </a>
            </div>
            <div class="Home-section3">
                <div class="Home-section3_l">
                    <b class="bj"></b>
                    <div class="Home-section3_lB">
                        <h2>理论前沿</h2>
                        <div class="section3_lB section3_lB1">
                            <ul>

                                @foreach($data['frontier'] as $k => $v)
                                <li>
                                    <a href="/llqy/list/{{$v -> id}}">{{$v -> title}}</a>
                                    <b>作者：<span>{{$v -> author}}</span></b>
                                </li>
                                @endforeach

                                <div class="clear"></div>
                            </ul>
                            <a href="/llqy/list" class="ck">查看更多</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="Home-section3_l  ">
                    <b class="bj"></b>
                    <div class="Home-section3_lB">
                        <h2>案例</h2>
                        <div class="section3_lB  section3_lB2">
                            <ul>

                                @foreach($data['case_list'] as $k => $v)
                                <li>
                                    <a href="/al/list/{{$v -> id}}">{{$v -> title}}</a>
                                    <b>作者：<span>{{$v -> author}}</span></b>
                                </li>

                                @endforeach

                                <div class="clear"></div>
                            </ul>
                            <a href="al/list" class="ck">查看更多</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="Home-section3_l  ">
                    <b class="bj"></b>
                    <div class="Home-section3_lB">
                        <h2>新技术</h2>
                        <div class="section3_lB section3_lB3">
                            <ul>
                                @foreach($data['technigue'] as $k => $v)
                                <li>
                                    <a href="xjs/list/{{$v -> id}}">{{$v -> title}}</a>
                                    <b>作者：<span>{{$v -> author}}</span></b>
                                </li>
                                @endforeach

                                <div class="clear"></div>
                            </ul>
                            <a href="xjs/list" class="ck">查看更多</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="Home-section4">
                <div class="Home-section4_c  D_1">
                    <h2>人物</h2>
                    <b class="bj"></b>
                    <div class="Home-section4_cB">

                        <ul class="ul">
                            @foreach($data['interview'] as $k => $v)
                            <li id="interview{{$v -> img}}">
                                <a href="/rw/list/{{$v -> id}}">
                                    <img src="{{ $v -> img }}" alt="">
                                    <h3>{{ $v -> title }}</h3>
                                </a>
                                <b>作者：<span>{{ $v -> author }}</span></b>
                            </li>
                            @endforeach
                            <a href="rw/list" class="ckgd">查看更多</a>
                        </ul>
                    </div>
                </div>
                <div class="Home-section4_l Right D_1">
                    <h2>杂志</h2>
                    <b class="bj"></b>
                    <div class="Home-section1D_Rb">
                        <div class="name-box">
                            <span class="D_Rbspan1">{{$data['magazine'][0] -> year}}</span>
                            <span class="name"> {{$data['magazine'][0] -> title}} </span>
                        </div>
                        <h4>邮发代码：80-841</h4>
                        <a href="/zz/{{ $data['magazine'][0]  -> m_id }}" class="btn_a">马上阅读</a>
                        <img src="{{$data['magazine'][0]  -> cover_img}}" alt="">
                        <a href="/gdzz" class="btn_a2">更多阅读</a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="Home-section5">
                <div class="bj"></div>
                <div class="Home-section5D">
                    <div class="Home-section5l">
                        <h2>大咖</h2>
                        <div class="Home-section5l_b">
                            <dl>
                                <dt><img src="/static/picImG/index/01.jpg"></dt>
                                <dd>顾惠忠：北京航空航天大学国际金融专业硕士，长江商学院EMBA，研究员级高级会计师</dd>
                            </dl>
                            <dl>
                                <dt><img src="/static/picImG/index/02.jpg"></dt>
                                <dd>肖泽忠：英国CardiffUniversity会计学教授，北京工商大学北京市特聘讲座教授，英国ACCA 研究委员会委员，中国审计学会理事会理事</dd>
                            </dl>
                            <dl>
                                <dt><img src="/static/picImG/index/03.jpg"></dt>
                                <dd>李守武：中国兵器装备集团公司副总经理</dd>
                            </dl>
                            <dl>
                                <dt><img src="/static/picImG/index/04.jpg"></dt>
                                <dd>汤谷良：经济学博士，现任对外经贸大学国际商学院院长，博士生导师</dd>
                            </dl>

                            <dl>
                                <dt><img src="/static/picImG/index/05.jpg"></dt>
                                <dd>北京大学光华管理学院会计系副教授、博士生导师，北京大学会计专业硕士项目（MPAcc）执行主任</dd>
                            </dl>

                            <dl>
                                <dt><img src="/static/picImG/index/06.jpg"></dt>
                                <dd>Rajiv Banker 美国Temple University Fox商学院会计教授</dd>
                            </dl>
                            <div class="clear"></div>
                        </div>
                        <a href="/bigshot" class="ck">更多专家</a>
                        <div class="clear"></div>
                    </div>
                    <div class="Home-section5r">
                        <div class="bj"></div>
                        <h2>活动</h2>
                        <div class="section5r_lB">
                            <div class="section5r_lB_main">
                                @foreach($data['activity'] as $k => $v)
                                <a href="/hd/{{ $v -> id }}">
                                    <dl>
                                        <dt><img src="{{ $v -> img }}" alt=""></dt>
                                        <dd>{{ $v -> title }}</dd>
                                    </dl>
                                </a>
                                @endforeach
                                <div class="clear"></div>
                            </div>
                            <a href="/hd" class="ck">查看更多</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <div id="bindPhone" class="form-box" >
        <div class="bind-item mobel">
            <span class="pre">+86</span>
            <i class="layui-icon" style="margin-left: 4px;color: #999;">&#xe625;</i>
            <input type="text" maxlength="11" name="phone" placeholder="请输入手机号" keycodes="tel" id="tel" class="tel-input">
            <div id="telId" class="YZ"></div>
        </div>
        <div  class="bind-item code" style="position: relative;">
            <span class="bind-code"></span>
            <input type="text" placeholder="请输入验证码" maxlength="6" id="code" class="code-input">
            <span class="aui-get-code" id="time_box" disabled style="display:none;"></span>
            <input class="verifyYz  aui-get-code " id="J_getCode" type="button" style="width: 146px !important;position: absolute;right: 10px; margin-top: -4px;text-align: center;border: none;background: none; " value="获取验证码" onclick="sendCode(this)" />
            <div id="codeId" class="YZ"></div>
        </div>
        <div class="verify-wrap" id="verify-wrap2" style="width:336px;margin-bottom: 24px;">
            <div class="drag-progress dragProgress"></div>
            <span class="drag-btn dragBtn" style="left: -1px;"></span>
            <span class="fix-tips fixTips">请按住滑块，拖动到最右边</span>
            <span class="verify-msg sucMsg">验证通过</span>
        </div>
        <div class="bind-btn" id="bindBtn">快速绑定</div>
    </div>

</body>

</html>
@include('Pc.layout.footer')
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script type="text/javascript" src="/static/js/jq-slideVerify.js"></script>
<script type="text/javascript" src="/static/js/gt.js"></script>
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    function getQueryString(name) {
        if (!name) return null;
        // 查询参数：先通过search取值，如果取不到就通过hash来取
        var after = window.location.search;
        after = after.substr(1) || window.location.hash.split('?')[1];
        // 地址栏URL没有查询参数，返回空
        if (!after) return null;
        // 如果查询参数中没有"name"，返回空
        if (after.indexOf(name) === -1) return null;
        var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)');
        // 当地址栏参数存在中文时，需要解码，不然会乱码
        var r = decodeURI(after).match(reg);
        // 如果url中"name"没有值，返回空
        if (!r) return null;
        return r[2];
    }
    $().ready(function() {
        $('#bindPhone').hide();
        var typeVal = getQueryString("type") //截取参数
        if (typeVal == 2) { //参数不等于1
            $('#bindPhone').show();
            layui.use('layer', function() {
                var layer = layui.layer;
                layer.open({
                    type: 1,
                    title: ['绑定手机号', 'background-color: #020202;text-align: center; color:#fff'],
                    maxmin: true,
                    shadeClose: false, //点击遮罩关闭层
                    area: ['640px', '420px'],
                    content: $('#bindPhone'),
                    success: function() {

                    },
                    cancel: function(index, layero){
                        $("#bindPhone,.bind-item, .verify-wrap,.bind-btn").hide();
                    }
                })
            })
        }
    });
    // 获取 验证码
    var clock = '';
    var nums = 60;
    var btn;
    var flag = false;
    //发送验证码
    function sendCode(thisBtn) {
        var tel = $('#tel').val();
        var code = $('#code').val();
        var phoneurl = 'code?phone=' + tel + '';
        if (checkTel()) {
            if (flag) {
                btn = thisBtn;
                btn.disabled = true; //将按钮置为不可点击
                btn.value = nums + '秒后重新获取';
                clock = setInterval(doLoop, 1000); //一秒执行一次
                $.ajax({
                    type: "get",
                    url: phoneurl,
                    headers: {
                        'mode': 2
                    },
                    async: true,
                    success: function(e) {
                        console.log(e, '9999')
                    }
                });
            } else {
                layui.use('layer', function() {
                    layer.msg('请按住滑块，拖动到最右边', {
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function() {});
                })
            }
        } else {
            // alert("手机号")
        }


    }
    //快速绑定按钮
    $('#bindBtn').click(function() {
        var tel = $('#tel').val();
        var code = $('#code').val();
        var flag = true;
        if (!checkTel()) flag = false; //手机号
        if (!checkCode()) flag = false; //验证码
        else {
            $.ajax({
                type: "get",
                url: "/bangTell",
                data: {
                    tell: tel,
                    code: code
                },
                success: function(data) {
                    if (data.bol == true) {
                        layui.use('layer', function() {
                            layui.use('layer', function() {
                                layer.msg(data.data.msg, {
                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                }, function() {
                                    layer.closeAll();
                                    location.href = '/';
                                    $("#bindPhone,.bind-item, .verify-wrap,.bind-btn").hide();
                                });
                            })
                        })
                    } else {
                        var fs = data.msg;
                        layui.use('layer', function() {
                            layer.msg(fs, {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function() {});
                        })
                    }
                },
                error: function() {
                    console.log("错误！！！")
                }

            })
        }
    })


    function doLoop() {
        nums--;
        if (nums > 0) {
            btn.value = nums + '秒后重新获取';
        } else {
            clearInterval(clock); //清除js定时器
            btn.disabled = false;
            btn.value = '获取动态码';
            nums = 60; //重置时间
        }
    }
    $("#tel").blur(checkTel); //手机号验证
    $("#verifyNo").blur(checkCode); //验证码验证
    //验证手机号
    function checkTel() {
        var tel = $("#tel").val().trim();
        var regtel = /^(13|15|18)[0-9]{9}$/;
        if (tel == "") {
            $("#tel").addClass("error_prompt").removeClass("ok_prompt");
            $("#telId").html("*请输入手机号");
            return false;
        } else if (regtel.test(tel) == false) {
            $("#telId").html("*请输入正确手机号");
            $("#tel").addClass("error_prompt").removeClass("ok_prompt");
            return false;
        } else {
            $("#telId").html("");
            $("#tel").addClass("ok_prompt").removeClass("error_prompt");
            return true;
        }
    }
    //验证动态码  
    function checkCode() {
        var code = $("#code").val().trim();
        if (code == "") {
            $("#code").addClass("error_prompt").removeClass("ok_prompt");
            $("#codeId").html("*请输入验证码");
            return false;
        } else if (/^\d{6}$/.test(code) == false) {
            $("#code").addClass("error_prompt").removeClass("ok_prompt");
            $("#codeId").html("*请输入正确的验证码");
            return false;
        } else {
            $("#codeId").html("");
            $("#code").addClass("ok_prompt").removeClass("error_prompt");
            return true;
        }
    }
</script>
<script>
    $(function() {
        var SlideVerifyPlug = window.slideVerifyPlug;
        var slideVerify2 = new SlideVerifyPlug('#verify-wrap2', {
            wrapWidth: '336', //设置 容器的宽度 ，默认为 350 ，也可不用设，你自己css 定义好也可以，插件里面会取一次这个 容器的宽度
            initText: '请按住滑块，拖动到最右边', //设置  初始的 显示文字
            sucessText: '验证通过', //设置 验证通过 显示的文字
            getSucessState: function(res) {
                //当验证完成的时候 会 返回 res 值 true，只留了这个应该够用了 
                flag = true;
            }
        });
        $("#resetBtn2").on('click', function() {
            slideVerify2.resetVerify();
        })
        $("#getState2").on('click', function() {
            alert(slideVerify2.slideFinishState);
        })
    })
</script>