function getCookie(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
	else return null;
}
		var is_vip=getCookie("is_vip", is_vip);	
				console.log(is_vip);
if (token == null ) { //没有登陆
	// 文章没有登陆提示
	// 提示登陆注册
	$('.sectionc #ArtiCle_status .ArtiCle1').show();
}else if(is_vip==0){
	console.log("非会员");
	$('.sectionc #ArtiCle_status .ArtiCle2').show();
}else if(is_vip==1  || is_vip==2){
	console.log("普通会员。超级会员");
	$('.sectionc #ArtiCle_status .ArtiCle3').show();
}


