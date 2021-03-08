//获取域名
url = window.location.pathname;
url = url.substring(url.lastIndexOf('/') + 1, url.length);
/* console.log(url); /Land.html */
var text = "Land.html";
if (url == text) {
	$("#header_pcB .header_pcr .heade_two").hide();
	// console.log("隐藏")
}else{
	$("#header_pcB .header_pcr .heade_two").show();	
	// console.log("显示")
}
// 注册页面显示登陆