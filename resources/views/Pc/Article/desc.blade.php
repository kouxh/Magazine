<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $data['content'] -> title }} - 管理会计研究</title>
    <meta name="keywords" content="{{ $data['content'] -> keyboard }}">
    <meta name="description" content="{{ $data['content'] -> message }}"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" type="text/css" href="/static/picss/theory_C.css"/>
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/paging.css">
    <link rel="stylesheet" href="/static/picss/wzZt.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">

    {{--   文章评论--}}
{{--    <script type="text/javascript" src="/static/js/wz/comment.js"></script>--}}
</head>

<body>
<div class="wapper" id="{{ $data['content'] -> id }}" type="1">
    @include('Pc.layout.header')
    <div class="Home-section2">
        <img src="{{ $list -> Pc_advert }}" alt="" class="pc">
        <img src="{{ $list -> App_advert }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $list -> Pc_advert_url }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <script src="/static/picJs/sectionlLeft.js" type="text/javascript" charset="utf-8"></script>
        <main class="sectionc" id="{{ $data['content'] -> id }}">
            <div class="clear"></div>
            <h1>{{ $data['content'] -> title }}</h1>
            <div class="theory_p1">
                <span class="author">{{ $data['content'] -> author }} </span>
                <a class="Title" href="/{{ $list -> english }}/list">{{ $title }}</a>
                <span class="time">{{ $data['content'] -> crea_at }}</span>
            </div>
            <div class="box">
                <div class="Article page" id="Article">
                    <?php echo $data['content']->free_content ?>
                    <div class="clear"></div>
                    <!-- 会员级别分类 -->
                    <div id="ArtiCle_status" class="ArtiCle_status">
                        <!-- 没有登陆是付费文章提示 -->
                        <div class="ArtiCle1">
                            <div class="word">本文为付费文章，成为用户可购买。应付（￥{{ $data['content'] -> price }}
                                ）<br>请先<a>登陆</a>或<a>注册</a>
                            </div>
                            <div class="Button">
                                <a href="/loadLogin" id="btn1" class="btn">立即登陆</a>
                                <a href="/loadRegister" id="btn2" class="btn">立即注册</a>
                                <!-- 链接注册，登陆地址 -->
                            </div>
                        </div>
                        {{--                //<input type="text" id="session" value="{{ $session }}">--}}
                        {{--登陆后提示购买--}}
                        <div class="ArtiCle2">
                            <div class="next"></div>
                            <!-- 向下提示图片，图片不显示，查看图片路径 -->
                            <div class="word">本文为付费文章 购买后可查看全文</div>
                            <div class="Radio">
                                <div class="bINput"><label><input type="radio" id="1"
                                                                  name="1"><span>￥{{ $data['content'] -> price }}</span><input
                                                type="radio" id="2" name="1"><span>{{ $data['content'] -> integral }} 积分</span></label></div>
                            </div>
                            <div class="Button">
                                <div id="purchase" class="btn">立即购买</div>
                            </div>
                        </div>
                        <div class="ArtiCle3">
                            <div class="next"></div>
                            <!-- 向下提示图片，图片不显示，查看图片路径 -->
                            <div class="word">本文为付费文章 您已购买成功！</div>
                            <div class="Continue">继续浏览</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 分页 -->
            
            {{--            <div class="buttons">--}}
            {{--                <a href="javascript:void(0)" class="prev disable">上一页</a><span class="active">1</span><a href="javascript:void(0)" class="next">下一页</a>--}}
            {{--            </div>--}}
        
            <div class="bimain" id="div"><img src="" id="worldMap" border="0" alt="" class="bigimg"
                                              style="display: none;"></div>
            <div class="mask" style="display: none;">
                <img src="/static/img/cancel.png">
            </div>
            {{--            文章评论¬--}}
            <div class="comments_mod_v1">
                <div class="post-comment" id="comment">
{{--                     <h2>评论（<span class="total_num">1</span>）</h2>--}}
                <!-- 登录之后 -->
                                        <div class="form-part">
                                            <form class="comment-form clear">
                                                <div class="user-info">
                                                    @if(!Session::get('users'))
                                                        <a target="_blank"  class="avatar"><img  src=""  width="30" height="30"></a>
                                                    @else
                                                        <a target="_blank"  class="avatar"><img  src="{{ Session::get('users')['photo'] }}"  width="30" height="30"></a>
                                                    @endif
                                                        <h3 class="name"></h3>
                                                </div>
                                                <!--不用许输入 !@#$%^&* -->
                                                <textarea rows="2" cols="20" name="comments"
                                                          onkeypress="if ((event.keyCode > 32 &amp;&amp; event.keyCode < 48) || (event.keyCode > 57 &amp;&amp; event.keyCode < 65) || (event.keyCode > 90 &amp;&amp; event.keyCode < 97)) event.returnValue = false;"
                                                          class="border-box" id="comment-input" placeholder="请输入评论内容"></textarea>
                                                <a class="bind-tip" href="javascript:;" target="_blank">根据《网络安全法》实名制要求，请绑定手机号后发表评论</a>
                                                <a class="js-comment btn " id="btn">发表评论</a>
                                            </form>
                                        </div>
                    <div class="clear"></div>
                    <!-- 没有登陆提示登录后评论 -->

                                        <div class="login-tip tc">
                                            【登录后才能评论哦！点击 <a href="/loadLogin" target="_blank">登录</a>】
                                        </div>
                    <ul class="comment-list">
                        <div class="clear"></div>
                    {{--                        <li class="comment-item" id="608426">--}}
                    {{--                            <div class="comment-info">--}}
                    {{--                                <a class="avatar" href="/user/4185838" target="_blank" title="hizYDP">--}}
                    {{--                                    <img src="https://images.tmtpost.com/uploads/avatar/89406bcb124bc802a240d5513b1737f4_1573016615.jpeg?imageMogr2/strip/interlace/1/quality/85/thumbnail/40x40&amp;ext=.jpeg"--}}
                    {{--                                            alt="hizYDP" width="40" height="40">--}}
                    {{--                                </a>--}}
                    {{--                                <span class="user"><a class="name" href="/user/4185838" target="_blank" title="hizYDP">hizYDP</a></span>--}}

                    {{--                            </div>--}}
                    {{--                            <p class="comment-cont">狗咬狗一嘴毛吧？</p>--}}
                    {{--                        </li>--}}

                    {{--                    <div class="login-tip tc">--}}
                    {{--                        【登录后才能评论哦！点击 <a href="/" target="_blank">登录</a>】--}}
                    {{--                    </div>--}}
                    {{--                    <ul class="comment-list">--}}
                    {{--                        <div class="clear"></div>--}}
                    {{--                        --}}
                    {{--                        <li class="comment-item" id="608426">--}}
                    {{--                            <div class="comment-info">--}}
                    {{--                                <a class="avatar" href="/user/4185838" target="_blank" title="hizYDP">--}}
                    {{--                                    <img src="https://images.tmtpost.com/uploads/avatar/89406bcb124bc802a240d5513b1737f4_1573016615.jpeg?imageMogr2/strip/interlace/1/quality/85/thumbnail/40x40&amp;ext=.jpeg"--}}
                    {{--                                            alt="hizYDP" width="40" height="40">--}}
                    {{--                                </a>--}}
                    {{--                                <span class="user"><a class="name" href="/user/4185838" target="_blank" title="hizYDP">hizYDP</a></span>--}}

                    {{--                            </div>--}}
                    {{--                            <p class="comment-cont">狗咬狗一嘴毛吧？</p>--}}
                    {{--                        </li>--}}

                    {{--                    </ul>--}}
                </div>
                <!-- 删除评论提示弹窗 -->
            </div>
        </main>
        <div class="sectionR">
            <div class="sectionR_two xgwz">
                <h2 class="h2">相关文章</h2>
                <div class="sectionR_twoUL sectionR_twoUL1">
                    <b class="bj"></b>
                    <div class="ul">

                        @foreach($data['relevant'] as $v)
                            <li><a href="/{{ $v -> english }}/list/{{ $v['id'] }}"> {{ $v -> title }}</a></li>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <!-- 下一篇文章 -->
            {{--                <div class="Chapter">--}}
            {{--                    <div class="wzcemter">--}}
            {{--                        <div class="line_bj"></div>--}}
            {{--                        <div class="wzcemterCenter">--}}
            {{--                            <p>下一篇</p>--}}
            {{--                            <span class="line"></span>--}}
            {{--                            <div class="strip"><a id="" target="_blank"> 以史为鉴，预见财会的未来以史为鉴，预见财会的未来</a><b>2019-06-12</b></div>--}}
            {{--                        </div>--}}

            {{--                    </div>--}}
            {{--                </div>--}}
            <div class="sectionR_two">
                <h2 class="h2">猜你喜欢</h2>
                <div class="sectionR_twoUL sectionR_twoUL2">
                    <b class="line_bj"></b>
                    <div class="ul">

                        @foreach($data['like'] as $v)
                            <li><a href="/{{ $v -> english }}/list/{{ $v['id'] }}"> {{ $v -> title }}</a></li>
                        @endforeach

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="sectionR_one">
                <b class="bj"></b>
                <div class="gc_bottomRD">
                    <div class="name-box">
                        <span class="D_Rbspan1">{{$data['magazine'] -> year}}</span>
                        <span class="name1"> {{ $data['magazine'] -> title }} </span>
                    </div>
                    <h4>邮发代码：80-841</h4>
                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>
                    <img src="{{$data['magazine'] -> cover_img}}" alt="">
                    <a href="/gdzz" class="ckgd">更多阅读</a>
                </div>
                <a class="wytg"><span>我要投稿</span></a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </section>
</div>
@include('Pc.layout.article')
</body>
@include('Pc.layout.footer'){{--页脚--}}

</html>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script src="/static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/static/js/gt.js"></script>
<!-- 我要投稿 -->
<script type="text/javascript" src="/static/picJs/wytg.js"></script>
<script type="text/javascript" src="/static/picJs/ydheader.js"></script>
<script type="text/javascript" src="/static/js/Fp.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script src="/static/js/wz/pc_yd.js" type="text/javascript"></script>
<script src="/static/js/axios.min.js" type="text/javascript" charset="utf-8"></script>
{{--文章收藏--}}
<script src="/static/js/wz/wz_sh.js" type="text/javascript"></script>
{{--评论--}}
<script src="/static/js/pl/djt_pl.js" type="text/javascript"></script>

{{----}}
{{--<script src="/static//json/Article/desc.js"></script>--}}
<script>
    var is_charge = "{{$data['content'] -> is_charge}}";
    var zx_id = $('.sectionc').attr('id');

    var dh = '';
    var rel = '';
    //会员 2 1登陆没有付费 //0没有登陆||免费  3是购买完成
    if (is_charge == 2) {
        //会员，但是没有购买文章
        $('#ArtiCle_status .ArtiCle3').show();
        $('.Continue').click(function () {
            $('.sectionc .Article .clear').after('<?php echo $data['content']->charge_content;?>');
            $('#ArtiCle_status .ArtiCle3').hide();
        })
    } else if (is_charge == 0) {
        //文章，免费
        $('#ArtiCle_status').hide();
    } else if ("{{ $data['uid']}}" == 0) {
        console.log("{{ $data['uid']}}");
        $('#ArtiCle_status .ArtiCle1').show();//没有登陆或者注册

    } else if (is_charge == 3) {
        console.log("购买完成");
        $('#ArtiCle_status .ArtiCle3').show();
        $('.Continue').click(function () {
            $('.sectionc .Article .clear').after('<?php echo $data['content']->charge_content; ?>');
            $('#ArtiCle_status .ArtiCle3').hide();
        })
    } else {
        $('#ArtiCle_status .ArtiCle2').show();
        // 如果等于1为付费 文章
        $("#purchase").click(function () {
            //console.log("222222")
            // 选中状态 如：扫码  积分
            var moDe = $('.bINput input:checked').attr('id');
            //console.log(moDe)
            var wenZurl = '/newCreaOrderApi?aid=' + {{$data['content'] -> id}} +'&&mode=' + moDe; //购买单篇文章
            //console.log(wenZurl+"wenZurl")
            //
            console.log(moDe)
            if (moDe == undefined) {//判断是否选择购买方式/没有选择购买
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg("请选择购买方式！", {
                            // skin: 'demo-class',
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function (data) {
                            // location.href = './index.html';
                            // console.log(data.article.charge_content)
                        });
                    })
                })
            } else {//选中
                // 购买文章
                $.ajax({
                    type: "POST",
                    url: '/newCreaOrderApi',
                    data: {
                        aid: zx_id,
                        mode: moDe,
                        type: "2"
                    },
                    success: function (data) {
                        // console.log(data)
                        // 判断是钱还是积分购买
                        if (moDe == 1) {//微信扫码支付
                            dh = data.data; //单号
                            var urll = "/refreshorder?orderNum" + dh;
                            layui.use('layer', function (layero, index) {  //支付方式
                                var layer = layui.layer;
                                layer.open({
                                    type: 2,
                                    title: ['支付方式','background: #000;text-align: center; color:#fff'],
                                    maxmin: true,
                                    shade: 0.8,
                                    area: ['800px', '570px'],
                                    content: '/static/tips/wzZf.html',
                                    btn: ['确认'],
                                    success: function (layero, index) {
                                                //生成二维码
                                                axios.get('/GenerateCodeApi?orderNum=' + dh + '', {
                                                    responseType: "arraybuffer",

                                                }).then(res => {
                                                    return 'data:image/png;base64,' + btoa(
                                                        new Uint8Array(res.data)
                                                            .reduce((data, byte) => data + String.fromCharCode(byte), '')
                                                    );
                                                })
                                                    .then(data => {
                                                        body.find('.jb img').attr("src", data);
                                                    })
                                                    .catch(ex => {
                                                        console.error(ex);
                                                    });
                                                var body = layer.getChildFrame('body', index);
                                                // 1.杂志 2单篇文章
                                        //定时请求是否支付
                                        //         setTimeout(alertHello(), 2000);
                                        // rel=setInterval(function(){
                                        //
                                        // },2000)
                                        rel = setInterval(function(){
                                            alertHello();
                                        },1000);

                                    }
                                    , yes: function () {
                                        //确定
                                        // console.log("购买失败");
                                        var url = "/refreshorder?orderNum=" + dh;
                                        f();
                                        return false //开启该代码可禁止点击该按钮关闭
                                    }

                                    , cancel: function () {
                                        //右上角关闭回调
                                        console.log("购买失败2");
                                        // clearInterval(rel);
                                        f();
                                        // clearTimeout(alertHello);
                                        var url = "/refreshorder?orderNum=" + dh;
                                        // $.ajax({
                                        //     url: url,
                                        //     headers: {
                                        //         "mode": 2
                                        //     },
                                        //     cache: false,
                                        //     async: false,
                                        //     type: "GET",
                                        //     success: function (result) {
                                        //         console.log(result)
                                        //         f();
                                        //     }
                                        //
                                        // });
                                        return false //开启该代码可禁止点击该按钮关闭
                                    }
                                });
                            });

                        } else if (moDe == 2) {
                            // console.log(data)
                            if (data.bol == false) {//积分不足
                                layui.use('layer', function () {
                                    layer.msg(data.msg, {
                                        // skin: 'demo-class',
                                        time: 1000 //1秒关闭（如果不配置，默认是3秒）
                                    }, function (datau) {
                                    });
                                })
                            } else {
                                //积分购买
                                layui.use('layer', function () {
                                    layer.msg(data.msg, {
                                        time: 1000 //1秒关闭（如果不配置，默认是3秒）
                                    }, function (datau) {
                                        $('#ArtiCle_status .ArtiCle2').hide();
                                        $('#ArtiCle_status .ArtiCle3').show();
                                        $('.Continue').click(function () {
                                            $('.sectionc .Article .clear').after(data.data);
                                            $('#ArtiCle_status .ArtiCle3').hide();
                                        })
                                    });
                                })

                            }


                        }


                    },
                    error: function (xhr, type, errorThrown) {
                        console.log("chuq")
                    }

                })

            }
        })


    }

    function f() {
        if (layer.open({
            type: 1,
            title: false,//不显示标题栏,
            closeBtn: false,
            area: '300px;',
            shade: 0.8,
            id: 'LAY_layuipro' , //设定一个id，防止重复弹出
            btn: ['是', '否'],
            btnAlign: 'c',
            moveType: 1, //拖拽模式，0或者1
            content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">您还没有付款，本篇文章为付费文章，是否要继续支付</div>',
            success: function (layero, index) {
                //有询问式提示信息，
                console.log("成功")
                clearInterval(rel);
            },
            yes:function(index){//要继续支付，关闭弹窗继续调用
                layer.close(index);
                rel = setInterval(function(){
                    alertHello();
                },1000);
                console.log("yes");
            },
            btn2: function (index, layero) {//不继续支付，关闭所有弹出层
                console.log("no")
                clearInterval(rel);
                //do something
                layer.closeAll(); //如果设定了yes回调，需进行手工关闭
            }
        }))
        { //只有当点击confirm框的确定时，该层才会关闭
             // console.log("no");
            //  clearInterval(rel);
        }
    }
    function alertHello() {
        // console.log("查看是否付费")
        $.ajax({
            type: "GET",
            url: "/refreshorder?orderNum=" + dh,
            success: function (data) {
                console.log(data);
                if (data.bol == false) {//没有付款成功 //继续定时请求
                    // setTimeout(alertHello, 2000);
                } //
                else {
                    // console.log(data.data.data);
                    // 停止定时请求
                    // console.log("停止请求，付款成功")

                    layer.closeAll('iframe'); //关闭所有的iframe层
                    layui.use('layer', function () {
                        layui.use('layer', function () {
                            layer.msg("购买成功", {
                                time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            }, function () {
                                clearInterval(rel);
                                $('#ArtiCle_status .ArtiCle2').hide();
                                $('#ArtiCle_status .ArtiCle3').show();
                                $('.Continue').click(function () {
                                    $('.sectionc .Article .clear').after(data.data.data);
                                    $('#ArtiCle_status .ArtiCle3').hide();
                                })
                                location.href = '/myarticle';
                            });
                        })
                    })
                }
            }
        })

    }

</script>
