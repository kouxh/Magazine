<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['Column']['title'] }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="{{ $data['Column']['describe']}}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/css/Classroom/desc.css">
{{--    --}}
    {{--    评论css--}}
    <link rel="stylesheet" href="/static/picss/wzZt.css">
</head>
@include('Pc.layout.header')
<body>
<div class="wapper" id="{{ $data['data'] -> cl_id  }}" type="3">

    <div class="Home-section2">
        <img src="{{ $data['Column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['Column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['Column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <div class="main" id="main">
        <div class="center">
            <div class="center_left">
                <div class="title">
                    <p><span><a href="/djt">CMAS大讲堂 </a> ></span><span>{{ $data['data'] -> cl_title }}</span></p>
                    <p>{{ $data['data'] -> cl_title }}</p>

                </div>
                <div class="speak">
                    <p>主讲老师:<span>{{ $data['data'] -> cl_lecturer }}</span><span>{{ $data['data'] -> cl_complete_post }}</span></p>
                    <p><span>发布时间:</span>{{ $data['data'] -> cl_crea_at }}</p>
                    <video controls="controls">
                        <source src="{{ $data['data'] -> cl_video_path }}">
                    </video>

                    {{--     {{ $data['data'] -> cl_video_path }}--}}


                </div>
                <div class="sectionL_1">
                    <h2 class="section_H2">内容简介</h2>
                    <div class="Activity_details">
                        <p class="Activity_describe">

                            {{ $data['data'] -> cl_msg }}
                        </p>

                    </div>
                </div>
                <div class="clear"></div>
                <div class="Related_videos">
                    <p>相关视频</p>
                    @foreach($data['related'] as $key => $val)
                        <dl>
                            <dt>
                                <img src="{{ $val -> cl_img }}" alt="">
{{--                                <video  controls="">--}}
{{--                                    <source src="{{ $val -> cl_video_path }}{{ $val -> cl_video_path }}" >--}}
{{--                                    </video>--}}
                            </dt>
{{--                            {{ $val -> cl_video_path }}--}}
                            <dd>
                                <a href="/djt/{{ $val -> cl_id }}">
                                    {{ $val -> cl_title }}
                                </a>
                            </dd>
                        </dl>
                    @endforeach
<div class="clear"></div>
                    <a href="/djt" class="ckgd">更多内容</a>
                </div>
                <div class="comments_mod_v1">
                    <div class="post-comment" id="comment">
                        {{--<<<<<<< Updated upstream--}}
                        {{--                                    <h2>评论（<span class="total_num">1</span>）</h2>--}}
                        {{--=======--}}
                        <h2>评论（<span class="total_num">0</span>）</h2>
                        {{-->>>>>>> Stashed changes--}}
                    <!-- 登录之后 -->
                        <div class="form-part">
                            <form class="comment-form clear">
                                <div class="user-info">
                                    @if(!Session::get('users'))
                                        <a target="_blank"  class="avatar"><img  src=""  width="30" height="30"></a>
                                    @else
                                        <a target="_blank"  title="hizYDP" class="avatar"><img src="{{ Session::get('users')['photo'] }}  "alt="hizYDP" width="30" height="30"></a>
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
                        </ul>>
                    </div>
                </div>
                    <!-- 删除评论提示弹窗 -->




                <div class="clear"></div>

            </div>
            <div class="center_right">
                {{--                <div class="clear"></div>--}}
                <div class="sectionR_two">
                    <h2 class="h2">猜你喜欢</h2>
                    <div class="sectionR_twoUL sectionR_twoUL2">
                        <b class="line_bj"></b>
                        <div class="ul">
                            @foreach($data['like'] as $key => $val)
                                <li><a href="/{{ $val -> wz_url }}">{{ $val -> title }}</a></li>
                            @endforeach
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                {{--  广告位           --}}

                <div class="advertisement">
{{--                    <a href="{{ $data['Column'] -> Pc_advert_url }}">--}}
                        <img src="/upload/2020/05/19/15898690976687.jpg" alt="">
{{--                        <img src="{{ $data['Column'] -> Pc_advert }}" alt="">--}}
{{--                    </a>--}}
                </div>
                {{--                人物推荐--}}
{{--                <div class="Character_recommendation">--}}
{{--                    <h2 class="h2">人物推荐</h2>--}}
{{--                    <div class="sectionR_twoUL">--}}
{{--                        <b class="line_bj"></b>--}}

{{--                        @foreach($data['character'] as $key => $val)--}}
{{--                            <a href="/rw/{{ $val -> id }}">--}}
{{--                                <dl>--}}
{{--                                    <dt><img src="{{ $val -> photo }}" alt=""></dt>--}}
{{--                                    <dd>--}}
{{--                                        <p>{{ $val -> name }}</p>--}}
{{--                                        <p>{{ $val -> golden }}</p>--}}
{{--                                    </dd>--}}
{{--                                </dl>--}}
{{--                            </a>--}}
{{--                        @endforeach--}}

{{--                        <a href="/rw" class="ckgd">查看更多</a>--}}
{{--                        <div class="clear"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="sectionR_two">
                    <h2 class="h2">Top5</h2>
                    <div class="sectionR_twoUL sectionR_twoUL1">
                        <b class="bj"></b>
                        <div class="clear"></div>
                        <div class="ul">

                            @foreach($data['top'] as $v)
                                <li>
                                    <a href="/{{$v -> english }}/list/{{ $v -> id }}" id="like1">{{ $v -> title }}</a>
                                    <b>作者：<span>{{ $v -> author }}</span></b>
                                </li>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
            <div class="clear"></div>


        </div>
    </div>
</div>
<div class="clear"></div>
</body>
@include('Pc.layout.footer');
</html>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<script type="text/javascript" src="/static/js/pl/djt_pl.js"></script>


