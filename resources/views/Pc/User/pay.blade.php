<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <link rel="stylesheet" href="/static/css/personal/personal_show.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/css/grzx/mycart.css">
    <link rel="stylesheet" href="/static/css/cart.css">
    <link rel="stylesheet" href="/static/picss/xcConfirm.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
</head>
{{--支付方式--}}
<body>

@include('Pc.layout.personal')
<div class="wapper">
    <div class="Tips zt">
        <!-- <p> <img src="img/tsx.png" alt=""> 提醒：成为会员享受折扣，还有电子期刊免费阅读哟！ </p> -->
    </div>
    <section id="section">
        <div class="section_D">
            <div class="category">
						<span class=" span2"><span class="zF">支付方式</span><label>
								<div class="time-item">
									<span id="day_show">0天</span>
									<strong id="hour_show">0时</strong>
									<strong id="minute_show">0分</strong>
									<strong id="second_show">0秒</strong>
								</div>
							</label>内付款，否则订单将会被取消！</span>
            </div>
            <div class="section_body">
                <div class="section_body2">
                    <dl>
                        <dt></dt>
                        <dd>微信支付</dd>
                    </dl>
                </div>
                <div class="section_body3">

                    <div class="section_body3l">
                        <span>请使用微信扫一扫扫码支付</span>
                        <p id="test"><img src="" alt=""></p>

                    </div>
                    <div class="section_body3r">
                        <img src="/static/img/zf_19.jpg" alt="" id="imgid">
                    </div>
                    <div class="clear"></div>

                </div>
            </div>
{{--            <div class="category category2">--}}
{{--                <span class="span1">订单状态</span>--}}
{{--                <a href="/mycart">返回购物车</a>--}}
{{--            </div>--}}
{{--            <div class="section_body">--}}
{{--                <div class="section_body1">--}}
{{--                    <dl>--}}
{{--                        <dt><img src="/static/img/zf_11.jpg" alt=""></dt>--}}
{{--                        <dd>您的订单已经下单成功!</dd>--}}
{{--                    </dl>--}}
{{--                </div>--}}
{{--                <p>收货信息 ：</p>--}}
{{--                <p><strong>北京 北京市 东城区 世纪大道三号 孙先生 139****8878</strong></p>--}}
{{--                <p> 应付总额：<>2000</span></p>--}}
{{--                <p>您的订单号 : 1189206170415676 查看订单详情 修改收货地址</p>--}}
{{--            </div>--}}

        </div>
    </section>
</div>
</div>

</body>
</html>
<script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
{{--定时--}}
<script src="/static/js/djs.js" type="text/javascript" charset="utf-8"></script>
{{--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}
<script src="/static/js/axios.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/layui/layui.js" type="text/javascript" charset="utf-8"></script>

<script>
{{--    var dh = window.location.search.substr(1);--}}
{{--    var url = '/creaCode?orderNum=' + dh + '';--}}
{{--    var str=location.href; //取得整个地址栏--}}
{{--    var num=str.indexOf("&")--}}
{{--    str=str.substr(num+1); //取得所有参数   stringvar.substr(start [, length ]--}}
{{--    var addressIDs=str.split("&")[0];//id--}}
{{--    var remarksMsgs=str.split("&")[1];--}}
{{--    var dz='/creaCode?orderNum='+dh+'&addressID='+addressIDs+'&remarksMsg='+remarksMsgs+'';--}}
{{--    var url2='/'+dz+'';--}}
{{--    console.log(addressIDs);--}}
{{--    console.log(remarksMsgs);--}}
{{--    console.log(dz);--}}
{{--    axios.get(`http://test.chinamas.cn/creaCode?orderNum=20200322103940158091954&addressID=1553&remarksMsg=999`, {--}}
{{--        responseType: "arraybuffer",--}}
{{--    }).then(res => {--}}
{{--        return 'data:image/png;base64,' + btoa(--}}
{{--            new Uint8Array(res.data)--}}
{{--                .reduce((data, byte) => data + String.fromCharCode(byte), '')--}}
{{--        );--}}
{{--    })--}}
{{--        .then(data => {--}}
{{--            //console.log(data);--}}

{{--            $("#test img").attr("src", data);--}}
{{--        })--}}
{{--        .catch(ex => {--}}
{{--            console.error(ex);--}}
{{--        });--}}
//
// function getCookie(name) {
//     var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
//     if (arr = document.cookie.match(reg)) return unescape(arr[2]);
//     else return null;
// }
// var orderNum = getCookie("Odd_Numbers");
// // axios.get('/GenerateCodeApi?orderNum='+orderNum+'', {
// axios.get('/GenerateCodeApi?orderNum='+orderNum+'', {
// 	responseType: "arraybuffer",
//
// }).then(res => {
// 	return 'data:image/png;base64,' + btoa(
// 		new Uint8Array(res.data)
// 			.reduce((data, byte) => data + String.fromCharCode(byte), '')
// 	);
// })
// 	.then(data => {
// 		console.log(data);
// 		$("#test img").attr("src", data);
// 	})
// 	.catch(ex => {
// 		console.error(ex);
// 	});
</script>
<script type="text/javascript" src="/static/json/grzx/payment.js"> </script>
