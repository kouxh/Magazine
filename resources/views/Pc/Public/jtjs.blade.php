<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="author" content="元年科技股份有限公司"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" type="text/css" href="/static/css/sjrz.css"/>
    <link rel="stylesheet" type="text/css" href="/static/picss/pic.css"/>
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <title>商家入住-管理会计研究</title>
</head>
<body>
@include('Pc.layout.header')
<div class="wapper">
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="tab">
            <div class="tab-menu">
                <ul>
                    <li class="change">关于cmas大讲堂</li>
                </ul>
            </div>
            <div class="tab-box">
                <div class="div">
                    {{--                    <p class="p_two">一.入驻说明</p>--}}
                    <p class="p_three">
                        为进一步加强作者、读者和财会各界人士线上沟通与交流，更好地进行财务知识和管理技能普及，更大程度地促进企业管理和个人能力提升，《管理会计研究》正式推出CMAS大讲堂线上直播活动。</p>
                    <p class="p_three">本讲堂从2020年4月起，每周一次邀请国内外各大院校的知名财会学者/企业总会计师或CFO等高管以及成长型知识精英，以直播+在线互动方式，进行财会观点分享、热点讨论、难点交流，推动智慧生产和传播。</p>
                    <p class="p_three">在主题设置上，线上直播讲堂将坚持前沿、务实、贴地气的原则，关注时代背景下企业管理的现实需求和个人价值提升要点，着力解决企业在新型冠状病毒疫情与企业危机管理、管理会计实践和创新、业财融合、数字化运营等四个方面的难点与焦点问题，推动企业管理模式创新和个人价值提升，为企业跨越经济周期提供源源不断的驱动力。</p>
                    <p class="p_three" style="margin-bottom: 50px">合作联系方式：400-819-1255</p>
                </div>
            </div>


    </section>
</div>
@include('Pc.layout.footer')

</body>

</html>



