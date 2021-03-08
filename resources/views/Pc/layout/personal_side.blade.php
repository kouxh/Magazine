<!--个人中心 测导航 -->
<link rel="stylesheet" href="/static/css/personal/personal_side.css">
<script src="/static/js/personal/personal_side.js"></script>
<div class="PersonalCenter_side">
    <div class="Side">
        <p class="TiTle"><a href="/">首页</a> &gt; <a href="/userpageshow">个人中心</a></p>
        <div class="Side_main">
            <b class="bj"></b>
            <div class="accountNav">
                <div title="订阅中心" class="Collapsing"><em></em>订阅中心</div>
                <div class="coll_body">
                    <em></em>
                    <ul id="qwert" class="clearFix dy">
                        <li class="personal_side_class"><a href="/userpageshow" title="个人中心" >个人中心</a></li>
                        <li><a href="/mycart" title="我的购物车">我的购物车</a></li>
                        <li><a href="/order" title="我的订单">我的订单</a></li>
                        <li><a href="/integral" title="我的积分" >我的积分</a></li>
                        <li><a href="/mycollection" title="我的收藏" >我的收藏</a></li>
                        <li><a href="/myarticle" title="购买的文章" >购买的文章</a></li>
                    </ul>
                </div>
                <div title="我要投稿" class="Collapsing"><em></em>我要投稿</div>
                <div class="coll_body">
                    <em></em>
                    <ul class="clearFix my_tg" id="manuscript">
                        <li><a href="/subcontributions" title="提交稿件" >提交稿件</a></li>
                        <li><a href="/shgj" title="审核查询">审核查询</a></li>
                    </ul>
                </div>
                <div title="会员中心" class="Collapsing"><em></em>会员中心</div>
                <div class="coll_body">
                    <em></em>
                    <ul class="clearFix hyzx" id="member">
                        <li><a href="/loadinfo" title="基本信息" >基本信息</a></li>
                        <li><a href="/openingvip" title="开通会员" >开通会员</a></li>
                        <li><a href="/modifypass" title="修改密码">修改密码</a></li>
                        <li><a href="/harvestaddress" title="收货地址" >收货地址</a></li>
                        <li><a href="/fpxx" title="发票信息" >发票信息</a></li>
                        <li><a href="/mymessage" title="我的留言" >我的留言</a></li>
                    </ul>
                </div>
            </div>

            <div class="Recommend">
                <p class="TiTle">新刊推荐</p>
                <b class="bj"></b>
                <div class="Recommend_main">
                    <a href="/zz/{{ $data['magazine'] -> m_id }}">
                        <img src="{{ $data['magazine'] -> cover_img }}" alt="">
                        <p class="book">《管理会计研究》  {{ $data['magazine'] -> year }} {{ $data['magazine'] -> title }}</p>
                    </a>

                </div>
            </div>
        </div>


    </div>
</div>
