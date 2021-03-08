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
    <!-- <link rel="stylesheet" type="text/css" href="css/Magazine.css" /> -->
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/activity_list.css">

    <title>杂志-管理会计研究</title>
</head>

@include('Pc.layout.header')
<body>

<div class="wapper">
    <section>
        <div class="main">
            @foreach($data['data'] as $v)
                <a href="/hd/{{ $v -> id }}" class="hd">
                    <dl>
                        <dt><img src="{{ $v -> img }}" alt="">
                            <span class="span1">{{ $v -> status }}</span>
                        </dt>
                        <dd>
                            <h3>{{ $v -> title }}</h3>
                            <p><span class="span1">{{ $v -> start_at }}</span><span class="span2">{{ $v -> address }}</span></p>
                        </dd>
                    </dl>
                </a>
            @endforeach

        </div>
    </section>
    <div class="clear"></div>
</div>


</body>
@include('Pc.layout.footer')
</html>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
{{--<script src="static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script src="static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script type="text/javascript" src="static/json/zzlist.js"> </script>--}}

