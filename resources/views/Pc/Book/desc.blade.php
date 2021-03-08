<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title></title>
    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <!-- 公共css -->
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/Magazine.css" /> -->
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/css/sj_desc.css">
</head>
<body>
@include('Pc.layout.header')

<div class="wapper">
    <div class="beij"></div>
    <section>
        <div class="main_left">
            <div class="Navigation" id="Navigation">
                <a href="/">首页<span>></span></a>
                <a href="/rw">{{ $data['desc'] -> book_author}}<span>></span></a>
                <a href="/sj">书籍<span>></span></a>
                <a href="">{{ $data['desc'] -> book_name}}<span>></span></a>
            </div>
            <dl>
                <dt><p><img src="{{ $data['desc'] -> book_img}}" alt=""></p><p>收藏/分享</p></dt>
                <dd>
                    <p class="Title">{{ $data['desc'] -> book_name}}</p>
                    <p class="classification">分类：{{ $data['desc'] -> book_zy }}</p>
                    <p class="book_introduction">
                        {{ $data['desc'] -> book_message }}
                    </p>
                    <p class="xt"></p>
                    <p class="book_brief_introduction">作者：<span>{{ $data['desc'] -> book_author }}</span></p>
                    <p class="book_brief_introduction">出版社：<span>{{ $data['desc'] -> book_press }} </span></p>
                    <p class="book_brief_introduction">出版时间：<span>{{ $data['desc'] -> book_publishing_time }}</span></p>
                </dd>
                <div class="clear"></div>
            </dl>
            <div class="clear"></div>
            <div class="sj_Introduction">
                <h2 class="section_H2">书籍介绍</h2>
                <div class="sj_mian">
                    <?php echo $data['desc'] -> book_content?>
                </div>
            </div>
        </div>
        <div class="main_right">
            <div class="sectionR_one">
                <b class="bj"></b>

                <div class="gc_bottomRD">
                    <h3><span class="D_Rbspan1">{{$data['magazine'] -> year}}</span>{{$data['magazine'] -> title}}</h3>
                    <h4>邮发代码：80-841</h4><img src="{{$data['magazine'] -> cover_img}}" alt="">
                    <a href="/zz/{{ $data['magazine'] -> m_id }}" class="msyd">马上阅读</a>
                    <a href="/gdzz" class="ckgd">更多阅读</a>
                </div>

                <a class="wytg"><span>我要投稿</span></a>
            </div>
            <div class="section_introduceL">
                <p class="book_recommendation">书籍推荐</p>
                <div class="section_introduceL_main">
                    <a href="/zz/17">
                        <dl id="m_id15">
                            <dt><img src="http://html.chinamas.cn/upload/2019/11/04/15728599048160.png" alt=""></dt>
                            <dd>2019年 第五期 总第08期</dd>
                        </dl>
                    </a>
                </div>
            </div>
        </div>

    </section>
</div>
</body>
</html>
