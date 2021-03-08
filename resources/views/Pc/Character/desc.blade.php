<!DOCTYPE html>
<!-- 人物内容 -->
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/css/rwnr.css"/>
    <link rel="stylesheet" href="/static/picss/pic.css">
</head>
<body>
<div class="wapper">
    @include('Pc.layout.header')
    <div class="introduce" id="introduce">
        <div class="introduce_banner" id="introduce_banner">
            <div class="introduce_bannerLeft">
                <p class="name">{{ $data['character_info'] -> name }}</p>
                <p class="sentence">{{ $data['character_info'] -> golden }}</p>
            </div>
            <div class="introduce_bannerRight">
                <img src="{{ $data['character_info'] -> banner_video }}" alt="">
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <section id="section">
        <div id="section_mian">
            <div class="Essential_information">
                <div class="Essential_information_main">
                    <p class="Essential_information_title">
                        <a class="Selection" onclick="skip('#information')">基本信息</a>
                        <a onclick="skip('#js')">介绍</a>
                        <a onclick="skip('#Work')">著作</a>
                        @if(!empty($data['book']))
                            <a onclick="skip('#book')" class="leven">出版书籍</a>
                        @endif
                        @if(!empty($data['character_info'] -> achievement))
                            <a onclick="skip('#achievement')" class="leven">学术成就</a>
                        @endif
                        <a class="curriculum">TA的课程</a>
                    </p>
                </div>


                <div class="information" id="information">
                    <b class="bj"></b>
                    <div class="information_main">
                        <div class="information_main_left">
                            <dl>
                                <dt><img src="{{ $data['character_info'] -> photo }}" alt=""></dt>
                                <dd>
                                    <div class="main_left_name"><span
                                                class="Character_name">{{ $data['character_info'] -> name }}</span>
                                        <span class="follow Character_center">关注ta</span>
                                        <span class="Character_center">已有{{ $data['character_info'] -> fans }}粉丝</span>
                                    </div>
                                    <p class="research_field"><span class="_field-title">研究领域：</span>
                                        @foreach($data['research'] as $v)
                                            <span class="_field">{{ $v -> title }}</span>
                                        @endforeach
                                    </p>

                                    <div class="research_field Golden_sentence">
                                        <p class="_field-title">经&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;历：</p>
                                        <span class="clear"></span>
                                        <span class="sentence"><?php echo $data['character_info']->experience?></span>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="information_main_Right">
                            <a>
                                <div><img src="{{ $data['character_info'] -> curriculum_img }}" alt=""></div>
                                <p class="curriculum">报名课程</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section_mian">
                <div class="sectionLeft">
                    <div class="sectionLeft_introduce" id="js">
                        <h2 class="section_H2">介绍</h2>
                        <div class="achievement_main">
                            <?php echo $data['character_info']->introduce?>
                        </div>
                    </div>
                    <div class="sectionLeft_Work" id="Work">
                        <h2 class="section_H2">著作</h2>
                        <div class="Work_content">
                            <ul>
                                @foreach($data['work'] as $v)
                                    <li><a href="/{{ $v -> english }}/list/{{ $v -> id }}">
                                            <span class="Label">{{ $v -> column }}</span>
                                            <p>{{ $v -> title }}</p>
                                            <span class="time">{{ $v -> crea_at }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    @if(!empty($data['book']))
                        <div class="sectionLeft_book" id="book">
                            <h2 class="section_H2">出版书籍</h2>
                            <div class="sectionLeft_book_main">
                                <dl>
                                    <dt><a href="/sj/{{ $data['book'] -> id }}"><img src="{{ $data['book'] -> book_img }}" alt=""></a></dt>
                                    <dd>
                                        <a href="/sj/{{ $data['book'] -> id }}"><p class="book_title">{{ $data['book'] -> book_name }}</p></a>
                                        <div class="brief_introduction"><span>简介 ：</span>
                                            <p>{{ $data['book'] -> book_message }}</p>
                                        </div>
                                        <a href="/sj/{{ $data['book'] -> id }}" class="View_more">查看更多</a>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    @endif

                    @if(!empty($data['character_info'] -> achievement))
                        <div class="sectionLeft_introduce" id="achievement">
                            <h2 class="section_H2">学术成就</h2>
                            <div class="achievement_main"> <?php echo $data['character_info']->achievement?></div>
                        </div>
                    @endif

                </div>
                <div class="sectionRight">
                    <div class="sectionR_two">
                        <h2 class="h2">人物新闻</h2>
                        <div class="sectionR_twoUL sectionR_twoUL1">
                            <b class="bj"></b>
                            <div class="clear"></div>
                            <div class="ul">
                                @foreach($data['news'] as $v)
                                    <li>
                                        <a href="/xw/{{ $v -> id  }}" id="like1">{{ $v -> title }}</a>
                                        <b>作者：<span>{{ $v -> author }}</span></b>
                                    </li>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="sectionR_two">
                        <h2 class="h2">猜你喜欢</h2>
                        <div class="sectionR_twoUL sectionR_twoUL1">
                            <b class="bj"></b>
                            <div class="clear"></div>
                            <div class="ul">
                                @foreach($data['like'] as $v)
                                    <li>
                                        <a href="/{{ $v -> english }}/list/{{ $v['id'] }}"> {{ $v -> title }}</a>
                                    </li>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="sectionR_Recommend">
                        <h2 class="h2">人物推荐</h2>
                        <div class="sectionR_Recommend_main sectionR_twoUL">
                            <b class="bj"></b>
                            <div class="clear"></div>
                            @foreach($data['relevant'] as $v)
                                <a href="/rw/{{ $v -> id }}" class="sectionR_Recommend_main_list">
                                    <dl>
                                        <dt><img src="{{ $v -> photo }}" alt=""></dt>
                                        <dd>
                                            <p class="sectionR_Recommend_main_name">{{ $v -> name }}</p>
                                            <p class="sectionR_Recommend_main_introduce">{{ $v -> post }}</p>
                                        </dd>
                                    </dl>
                                </a>
                            @endforeach

                            <a href="/rw" class="View_more">查看更多</a>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="clear"></div>
<link rel="stylesheet" type="text/css" href="/static/css/rw_list.css"/>

<script src="/static/js/rwnr.js"></script>
<script>
    $('.curriculum').click(function () {
        layui.use('layer', function() {
            layui.use('layer', function() {
                layer.msg('暂未开课', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                });
            })
        })
    })


</script>
@include('Pc.layout.footer'){{--页脚--}}
</body>
</html>
