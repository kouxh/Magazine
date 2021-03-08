{{--书籍的搜索结果页--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['column'] -> title }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <!-- <link rel="stylesheet" type="text/css" href="css/Magazine.css" /> -->
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/More_books.css">
</head>
<body>
<div class="wapper">
    @include('Pc.layout.header')
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg"  href="{{ $data['column'] -> Pc_advert_url }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="main">
            <div class="main_ main1">
                <p class="zzlist_title">搜索<span>{{ $data['keyword'] }}</span>书籍的结果</p>

                @foreach($data['list'] as $v)
                    <a href="javascript:;" class="M_a">
                        <dl>
                            <dt><img src="{{ $v -> book_img }}" alt=""></dt>
                            <dd>{{ $v -> book_name  }}</dd>
                        </dl>
                    </a>
                @endforeach

                <div class="clear"></div>
            </div>

        </div>
    </section>
</div>
<div class="clear"></div>
@include('Pc.layout.footer')
</body>
</html>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>

