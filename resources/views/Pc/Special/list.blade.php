<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/special/special_index.css">
</head>
<body>
{{--@include('Pc.layout.header')--}}
<div class="wapper">
    @include('Pc.layout.header')
    <div class="Home-section2">
        <img src="{{ $data['column'] -> Pc_advert }}" alt="" class="pc">
        <img src="{{ $data['column'] -> App_advert }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['column'] -> Pc_advert_url }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="activity_main">
            <a href="/anlipx" class="activity">
                <dl>
                    <dt><img src="http://html.chinamas.cn/upload/2019/09/17/15686890531642.png" alt=""></dt>
                    <dd>
                        <p class="title">中国本土管理会计2019十大案例评选</p>
                        <p class="xt"></p>
                        <p class="centent">由《管理会计研究》杂志推出的第一届“中国本土管理会计十大案例评选“主题为“新技术驱动下的财务转型”，力求寻找过去一年推动所在企业引领财务管理创新、探寻新商业模式、实现质量和效益统一的实践案例。</p>
                    </dd>
                </dl>
            </a>
            <a href="/summit" class="activity">
                <dl>
                    <dt><img src="http://html.chinamas.cn/upload/2019/09/17/15686866194872.png" alt=""></dt>
                    <dd>
                        <p class="title">2019管理会计国际高峰论坛</p>
                        <p class="xt"></p>
                        <p class="centent">《管理会计研究》杂志携手ACCA联合举办“新技术驱动下的财务转型”论坛，助力企业管理会计 的发展，为财务负责人搭建产、学、研交流平台，就热点话题展开深入研讨。</p>

                    </dd>
                </dl>
            </a>

            <div class="clear"></div>
        </div>
        <!-- <p class="View_more">查看更多</p> -->

    </section>
</div>
@include('Pc.layout.footer')

</body>
</html>
