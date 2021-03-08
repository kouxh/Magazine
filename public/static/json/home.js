// 首页列表
$(function() {
	var  zym='http://www.chinamas.cn';
	function getCookie(name) {
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg)) return unescape(arr[2]);
		else return null;
	}
	var token=getCookie("token")
})

