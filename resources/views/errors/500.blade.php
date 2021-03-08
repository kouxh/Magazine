<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理会计研究</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
</head>

<body>
{{--@include('Pc.layout.header')--}}
<div class="wapper">
    <a href="/">
        <img src="/static/img/404.jpg" alt="" style="width: 100%;height: auto;" class="_pc">
        <img src="/static/img/404_yd.jpg" alt="" style="width: 100%;height: auto;" class="_yd">

    </a>

</div>
{{--<script src="static/picJs/footer.js" type="text/javascript" charset="utf-8"></script>--}}

</body>
@include('Pc.layout.footer');
<style type="text/css">
    .wapper{
        margin-bottom: 0px;
    }
    ._yd{
        display: none;
    }
    @media screen and (max-width: 1024px) {
        ._yd{
            display: block;
        }
        ._pc{
            display: none;
        }

    }
</style>
</html>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>

</html>