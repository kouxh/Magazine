<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['column'] -> title }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" type="text/css" href="static/css/Magazine.css" />
    <link rel="stylesheet" href="static/picss/footer_header.css">

</head>
@include('Pc.layout.header')
<body>

<div class="wapper">
    <div class="M-banner" style="background-image:url({{ $data['column'] -> Pc_banner }})">
        <div class="M-bannerD">
        </div>
    </div>
    <section>
        <div class="section_one">
            <h3>期刊定位</h3>
            <div class="section_oneD">

                <dl>
                    <dt><img src="/static/img/zzdw.png" alt=""></dt>
                       <dd></dd> 
                </dl>
                <p>《管理会计研究》是一本以管理会计理论和实践创新为基础，<br> 专注新技术驱动数字化转型和新时代的业财融合，用案例启迪管理智慧的新锐权威期刊</p>
{{--                <p>《管理会计研究》立足企事业单位的成长与发展，以提炼总结和传播中国企事业单位的管理会计优秀实践为主旨，以推动我国企事业单位管理及管理会计相关理论的繁荣发展和中国企事业单位的管理进步为目标，致力于成为国内具有学术和实践价值、媒体和商业价值的管理会计权威期刊。 </p>--}}
            </div>

        </div>
        <div class="section_Two jq22">
            <h3>管理会计研究</h3>
            <div class="section_TwoD hidden">

                @foreach($data['six'] as $v)
                    <a href="/zz/{{ $v -> m_id }}" class="M_a" id="">
                        <dl>
                            <dt><img src="{{ $v -> cover_img }}" alt=""></dt>
                            <dd>{{ $v -> year }}{{ $v -> title }}</dd>
                        </dl>
                    </a>
                @endforeach

                <div class="clear"></div>
            </div>
            <div class="more M-ckgd"><a href="/gdzz" >查看更多</a></div>
        </div>
    </section>
</div>

</body>
@include('Pc.layout.footer')
</html>
{{--<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>--}}
<script type="text/javascript" src="static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="static/js/jquery.1.7.2.min.js"></script>
{{--<script src="static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script src="static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script type="text/javascript" src="static/json/magazine.js"> </script>--}}
