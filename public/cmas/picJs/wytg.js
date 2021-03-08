//我要投稿 列表 文章
function getCookie(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
	else return null;
}
var token = getCookie("token", token);
$('.wytg').click(function() {
	console.log("我要投稿");
	if (token != null) {
		location.href = 'https://www.wjx.top/jq/44388041.aspx';
	} else {
		layui.use('layer', function() {
			layui.use('layer', function() {
				layer.msg('请登陆后投稿', {
					skin: 'demo-class',
					time: 2000 //2秒关闭（如果不配置，默认是3秒）
				}, function() {
					location.href = '/login.html';

				});
			})
		})
	}
})
