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

@include('Pc.layout.header')
<body>

<div class="wapper">
    <div class="Home-section2">
        <img src="{{ $data['column'] -> Pc_advert }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg"  href="{{ $data['column'] -> Pc_advert_url }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="main">

            @foreach($data['magazine'] as $k => $v)
                <div class="main_ main1">
                    <p class="zzlist_title">{{ $k }}</p>
                    @foreach($v as $key => $val)
                        <a href="/zz/{{ $val -> m_id}}" class="M_a">
                            <dl>
                                <dt><img src="{{ $val -> cover_img }}" alt=""></dt>
                                <dd>{{ $val -> year }}{{ $val -> title }}</dd>
                            </dl>
                        </a>
                    @endforeach

                    <div class="clear"></div>
                </div>
            @endforeach

        </div>
    </section>
</div>


</body>
@include('Pc.layout.footer')
</html>
{{--<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>--}}
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.1.7.2.min.js"></script>
<!-- <script type="text/javascript" src="static/js/lazyload.js"></script> -->
{{--<script src="static/js/index_pc.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script src="static/picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>--}}
{{--<script type="text/javascript" src="static/json/zzlist.js"> </script>--}}
<!-- <script type="text/javascript" charset="utf-8">
  $(function() {
      $("img.lazy").lazyload({
          placeholder : "https://via.placeholder.com/150",
          effect: "fadeIn",
          threshold: 200, // 提前开始加载
        });
  }); -->
</script>

