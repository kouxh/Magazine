// 退出

function getCookie(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
	else return null;
}

function getCookies(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
	console.log(new RegExp("(^| )" + name + "=([^;]*)(;|$)"))
	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
	else return null;
}
//删除cookies 
function delCookie(name) {
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval = getCookie(name);
	if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}
// setCookie("token",token);
var token = getCookie("token")
var user = getCookies("user")
console.log(token)
console.log(user)
if (token == null) { //没有登陆
	console.log('没有登陆');
	$('.Gmheader_pcBR').hide();
	// 文章没有登陆提示
	// 提示登陆注册
	$('.sectionc #ArtiCle').hide();
} else { //已经登陆
	console.log("登陆")
	$('.NOzc').hide();
	$('.Tc .Tc_user span').text(user)
}

// 
$("#outlogin").click(function() {
	// var token = localStorage.getItem(token)
	// console.log(token);
	console.log("tuichu")
	$.ajax({
		url: 'http://www.ynresearch.net/outlogin',
		type: 'GET', //HTTP请求类型
		timeout: 10000, //超时时间设置为10秒；
		beforeSend: function(request) {
			request.setRequestHeader("TOKEN", token);
		},
		success: function(data) {
			console.log(data.bol)
			if (data.bol = true) {
				// console.log(data.bol)
				location.href = '/index.html';
				delCookie("token");

			}
		},
		error: function(xhr, type, errorThrown) {

		}
	});
})
// $(window).unload( function () { 
// 	delCookie("token");
// 	console.log("退出")
// } );
// window.onbeforeunload = function() {
// 	alert("关闭浏览器")
// 	// var n = window.event.screenX - window.screenLeft;
// 	// var b = n > document.documentElement.scrollWidth - 20;
// 	// if (b && window.event.clientY < 0 || window.event.altKey) {
// 	// 	delCookie();
// 	// }
// }
// window.onbeforeunload = function() {
// 	 // return "我在这写点东西...";
// 	  delCookie(token);
// // }
window.close=function() {
	 // return "我在这写点东西...";
	  delCookie(token);
}
