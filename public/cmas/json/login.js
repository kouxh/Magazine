$(function() {
	$('.lang').click(function() { //账号登陆
		var adminNoname = $('#rc #userName').val();
		var password = $('#rc #pwd').val();
		var flag = true;
		if (!checkUser()) flag = false; //用户名
		if (!checkPwd()) flag = false; //密码
		else {
			$.ajax({
				type: "POSt",
				url: "http://www.ynresearch.net/login",
				data: {
					account: adminNoname,
					pwd: password,
				},
				success: function(data) {


					// // //读取cookies
					// function getCookie(name) {
					// 	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
					// 	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
					// 	else return null;
					// }

					// console.log(getCookie(token))
					if (data.bol == true) {

						var is_vip = data.data.is_vip;
						var token = data.data.token;
						var user = data.data.account;
						// 创建
						function setCookie(name, value) {
							// var Days = 1;
							var exp = new Date();
							exp.setTime(exp.getTime() + 120 * 60 * 1000);
							// console.log(exp.getTime() + 20 * 60 * 1000);
							// exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
							document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();

						}

						setCookie("token", token);
						setCookie("user", user);
						setCookie("is_vip", is_vip);

						layui.use('layer', function() {
							layui.use('layer', function() {
								layer.msg('登陆成功', {
									skin: 'demo-class',
									time: 2000 //2秒关闭（如果不配置，默认是3秒）
								}, function() {
									location.href = '/index.html';
								});
							})
						})
						//location.href = './index.html';
					} else {
						var fs = data.msg;
						var html = '';
						html += data.msg;
						$("#pwdId").html(data.msg);
						console.log("chuowu")
					}
				},
				error: function() {
					console.log("错误！！！")
				}
			});
		}

	});
	$('.landtwo').click(function() { // 动态码登陆
		var tel = $('#tel').val();
		var code = $('#verifyNo').val();
		$.ajax({
			type: "POST",
			url: "http://www.ynresearch.net/codelogin",
			data: {
				phone: tel,
				code: code
			},
			success: function(data) {

				if (data.bol == true) {

					var token = data.data.token;
					var user = data.data.account;
					var is_vip = data.data.is_vip;

					function setCookie(name, value) {
						// var Days = 1;
						var exp = new Date();
						exp.setTime(exp.getTime() + 120 * 60 * 1000);
						// console.log(exp.getTime() + 20 * 60 * 1000);
						// exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
						document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
					}

					setCookie("token", token);
					setCookie("user", user);
					setCookie("is_vip", is_vip);

					// 提示登陆成功
					layui.use('layer', function() {
						layui.use('layer', function() {
							layer.msg('登陆成功', {
								skin: 'demo-class',
								time: 2000 //2秒关闭（如果不配置，默认是3秒）
							}, function() {
								location.href = '/index.html';
							});
						})
					})
				} else {
					var fs = data.msg;
					var html = '';
					html += data.msg;
					$("#codeId").html(fs);
					console.log(data.msg)
				}
			},
			error: function() {
				console.log("错误！！！")
			}

		})

	})

})
// 获取 验证码
var clock = '';
var nums = 60;
var btn;
//发送验证码
function sendCode(thisBtn) {
	var tel = $('#tel').val();
	var code = $('#verifyNo').val();
	var phoneurl = 'http://www.ynresearch.net/code?phone=' + tel + '';
	if (!checkUser()) {
		flag = false;
	}
	if (!checkTel()) {
		flag = false;
	} else {
		// console.log("nihao ")
		btn = thisBtn;
		btn.disabled = true; //将按钮置为不可点击
		btn.value = nums + '秒可后重新获取';
		clock = setInterval(doLoop, 1000); //一秒执行一次
		$.ajax({
			type: "get",
			url: phoneurl,
			headers: {
				'mode': 2
			},
			async: true,
			success: function(e) {
				console.log(e)
			}
		});
	}

}


function doLoop() {
	nums--;
	if (nums > 0) {
		btn.value = nums + '秒后可重新获取';
	} else {
		clearInterval(clock); //清除js定时器
		btn.disabled = false;
		btn.value = '获取动态码';
		nums = 60; //重置时间
	}
}
$("#userName").blur(checkUser); //用户名
$("#pwd").blur(checkPwd); //验证密码
$("#tel").blur(checkTel); //手机号验证
function checkUser() {
	var user = $("#userName").val().trim();
	var regnick = /^([\u4e000-\u9fa5]|\w|[@!#$%*])+$/;
	var len = user.replace("/[\u4e000-\u9fa5]/g", "xx").length; //计算字符串长度，一个汉字表示2个字符
	if (regnick.test(user) == false) {
		$("#nickNameId").html("*请输入用户名称");
		$("#userName").addClass("error_prompt").removeClass("ok_prompt");
	} else if (len < 4 || len > 18) {
		$("#nickNameId").html("*用户名长度为4-18个字符");
		$("#userName").addClass("error_prompt").removeClass("ok_prompt");
	} else {
		$("#nickNameId").html("");
		$("#userName").addClass("ok_prompt").removeClass("error_prompt");
	}
}
//验证密码
function checkPwd() {
	var pwd = $("#pwd").val().trim();
	var regpwd = /^[0-9a-zA-Z]{4,18}$/;
	if (regpwd.test(pwd) == false) {
		$("#pwd").addClass("error_prompt").removeClass("ok_prompt");
		$("#pwd").html("密码由英文字母和数字组成的4-18位字符");
		return false;
	} else {
		$("#pwd").html("");
		$("#pwd").addClass("ok_prompt").removeClass("error_prompt");
		// $("#nickNameId").html("密码输入正确");
		return true;
	}
}
//验证手机号
function checkTel() {
	var tel = $("#tel").val().trim();
	var regtel = /^(13|15|18)[0-9]{9}$/;
	if (regtel.test(tel) == false) {
		$("#tel").addClass("error_prompt").removeClass("ok_prompt");
		$("#telId").html("*手机号码输入不正确");
	} else {
		$("#telId").html("");
		$("#tel").addClass("ok_prompt").removeClass("error_prompt");
		return true;
	}
}
