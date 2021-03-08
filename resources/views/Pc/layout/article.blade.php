<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<div class="Bottom-share">
    <div class="Bottom-share_mian">
        <div class="share" data-cmd="more"></div>
        <div class="Return-Top" id="to_top" style="left: 282px; top: 2652px;"></div>
        <div class="Collection sc"></div>
    </div>
    <div class="Bottom-share_pc">
        <div class="Bottom-share_pc_left">
            <p>发表于 2019-11-04</p>
        </div>
        <div class="Bottom-share_pc_right">
            <div id="container" class="btn">
                <div class="feed" id="feed1">
                    <div class="heart" type="1" id="like1" rel="like"
                         style="background-position: left center; pointer-events: auto;"></div>
                    <div class="likeCount1" id="likeCount1">2019</div>
                </div>
            </div>
            <div id="No" class="btn">
                <div class="xh" id="xh">
                    <div class="xhheart" type="2" id="like1" rel="likejd"
                         style="pointer-events: auto; background-position: left center; left: 10px;"></div>
                    <div class="likeCount2" id="likeCount">2022</div>
                </div>
            </div>
        </div>
    </div>
    <div class="shelf-layer " id="shelf-layer">
        <div class="share-top"><a href="#" class="close-layer"><i class="icon-arrow-l"></i></a><strong>分享</strong></div>
        <div class="share-post bdsharebuttonbox bdshare-button-style0-32" data-bd-bind="1568599948046">
            <dl>
                <dt><a class="bds_weixin" data-cmd="weixin"></a></dt>
                <dd>微信</dd>
            </dl>
            <dl>
                <dt><a class="bds_tsina" data-cmd="tsina"></a></dt>
                <dd>微博</dd>
            </dl>
            <dl>
                <dt><a class="bds_douban" data-cmd="douban"></a></dt>
                <dd>豆瓣</dd>
            </dl>
            <!-- <ul class="justify-flex">
                <li class="child">

                    <span><i class="icon-sina"></i></span></li>

            </ul> -->
        </div>
    </div>
</div>
</body>
</html>
<script>
    window.onload = function () {
        var oTop = document.getElementById("to_top");
        var screenw = document.documentElement.clientWidth || document.body.clientWidth;
        var screenh = document.documentElement.clientHeight || document.body.clientHeight;
        oTop.style.left = screenw - oTop.offsetWidth + "px";
        oTop.style.top = screenh - oTop.offsetHeight + "px";
        window.onscroll = function () {
            var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
            oTop.style.top = screenh - oTop.offsetHeight + scrolltop + "px";
        }
        oTop.onclick = function () {
            document.documentElement.scrollTop = document.body.scrollTop = 0;
        }
    }
    //评论头部的距离
    $(window).scroll(function () {
        //获取滚动条的滑动距离
        var scroH = $(this).scrollTop();
        // console.log(scroH)
        var pmH = document.body.clientHeight - $('.header_pc').height() - $('.Bottom-share').height(); //可是区域的高度
        // var comments_mod_v1Top = $(".comments_mod_v1").offset().top;
        // console.log("pmH" + pmH)
        // if (scroH >= comments_mod_v1Top) {
        //     $('.Bottom-share').hide();
        //
        // } else {
        //
        //     $('.Bottom-share').show();
        // }
    })
    $(document).ready(function () {
        $('body').on("click", '.heart', function () {
            var A = $(this).attr("id");
            var B = A.split("like");
            var messageID = B[1];
            var C = parseInt($("#likeCount" + messageID).html());
            var D = $(this).attr("rel");
            var type = $(this).attr("type");
            var ID = $('.sectionc').attr("id");
            var xhheartrel = $('.xhheart').attr("rel");
            // console.log(xhheartrel);
            if (xhheartrel == "unlike") {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('已经评论过了，不可重复评论', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                    })
                })

            } else {
                if (D === 'like') {
                    $.ajax({
                        type: "GET",
                        url: "/plwz",
                        data: {
                            type: type,
                            article_id: ID
                        },
                        success: function (data) {
                            // console.log(data)
                            if (data.err_code) {
                                $('.heart').addClass("heartAnimation").attr("rel", "unlike");
                                // $('.xhheart').css("pointer-events", "none");
                                $("#likeCount" + messageID).html(C + 1);
                                $(this).css("background-position", "left");
                            } else {

                                layui.use('layer', function () {
                                    layui.use('layer', function () {
                                        layer.msg('请先登录', {
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        });
                                    })
                                })
                            }

                        }
                    })
                } else {
                    layui.use('layer', function () {
                        layui.use('layer', function () {
                            layer.msg('已经评论过了，不可重复评论', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            });
                        })
                    })
                }

            }
        });
        $('body').on("click", '.xhheart', function () {
            var A = $(this).attr("id");
            var B = A.split("like");
            var messageID = B[1];
            var C = parseInt($("#No #likeCount").html());
            var D = $(this).attr("rel");
            var ID = $('.sectionc').attr("id");//获取文章id
            var type = $(this).attr("type");
            var heartrle = $('.heart').attr("rel");
            if (heartrle == "unlike") {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('已经评论过了，不可重复评论', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                    })
                })
            } else {
                if (D === 'likejd') {
                    $.ajax({
                        type: "GET",
                        url: "/plwz",
                        data: {
                            type: type,
                            article_id: ID
                        },
                        success: function (data) {
                            if (data.err_code) {
                                // $("#likeCount" + messageID).html(C + 1);
                                $("#No #likeCount").html(C + 1);
                                $('.xhheart').addClass("xhAnimation").attr("rel", "unlike");
                                $('.xhheart').css("background-position", "right center");
                                $('.xhheart').css("left", "-14px");
                            } else {
                                layui.use('layer', function () {
                                    layui.use('layer', function () {
                                        layer.msg('请先登录', {
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        });
                                    })
                                })
                            }

                        }
                    })
                } else {
                    layui.use('layer', function () {
                        layui.use('layer', function () {
                            layer.msg('已经评论过了，不可重复评论', {
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            });
                        })
                    })

                }
            }

        });
    });
    //
</script>

