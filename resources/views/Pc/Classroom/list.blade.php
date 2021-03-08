<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data['Column']['title'] }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="{{ $data['Column']['describe']}}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/css/Classroom/list.css">
</head>
@include('Pc.layout.header')
<body>
<div class="wapper">
    <div class="Home-section2">
        <img src="{{ $data['Column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['Column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['Column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <div class="main" id="main">
        <p class="title">CMAS大讲堂 <a href="/jtjs">关于cmas大讲堂</a></p>
        <div class="center">
{{--            渲染数据--}}
            @foreach($data['data'] as $key => $val)
                <dl>
                    <dt>
                        <a href="/djt/{{ $val -> cl_id }}">
                            <img src="{{ $val -> cl_img }}" alt="">
                            <div><span>{{ $val -> cl_lecturer }}</span><span>{{ $val -> cl_post }}</span></div>
                        <p>{{ $val -> cl_title }}</p>
                        </a>
                    </dt>
                    <dd>


                        <a href="/djt/{{ $val -> cl_id }}">{{ $val -> cl_msg }}</a>
                        <span>{{ $val -> cl_crea_at }}</span>
                    </dd>
                </dl>
            @endforeach
        </div>
        <div class="clear"></div>
{{--        分页--}}
        <div class="pull-right paginate" style="margin-top: 24px;margin-bottom: 74px">
            {{ $data['data'] -> links() }}
        </div>

    </div>
</div>
<div class="clear"></div>
</body>
@include('Pc.layout.footer');
</html>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>

