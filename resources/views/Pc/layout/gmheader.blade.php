<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <!-- 购买部分头部 -->
</head>
<body>
<div class="gmheader" id="gmheader">
    <div class="gmheaderD_pcD" id="gmheaderD_pcD">
        <div class="Gmheader_pcB" id="Gmheader_pcB">
            <a href="/" class="loge"><img src="static/img/logo2.png" alt=""></a>
        </div>
        <div class="Gmheader_pcBR" id="Gmheader_pcBR">
            <ul>
                <li><a href="">个人中心</a></li>
                <li><a href="">我的订单</a></li>
                <li><a href="">客户服务</a></li>
            </ul>
            <div class="Gmheader_pcBR">
                <p class="Tc"><span class="Tc_user">你好：<span>{{ Session::get('users') -> account }}</span></span><label for="">|<span class="outlogin" onclick="outlogin()">退出</span></label></p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>

<script>
    function outlogin() {

        $.get('outlogin' , {} ,function(data){
            if(data.bol == true){
                alert('退出成功');
                window.location.reload();
            }
        })
    }
</script>
