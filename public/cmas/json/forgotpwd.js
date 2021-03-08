$(function() {
	var url = "http://www.ynresearch.net/register"
	var user = $('.user').val();
	var password = $('#password').val();
	var code = $('#code').val();
	var sj = $('#sj').val();
});
// 账户验证
$('#btn1').click(function() {
	var userName = $('#userName').val(); //用户名
	var repwd = $('#repwd').val(); //确认密码
	var code = $('#code').val();
	var tel = $('#tel').val();
	if (!checkUser()) {
		flag = false;
	}
	if (!checkTel()) {
		flag = false;
	} else {
		$.ajax({
			type: "POST",
			url: 'http://www.ynresearch.net/Verification',
			data: {
				account: userName,
				tell: tel,
				code: code,
			},
			success: function(e) {
				if (e.bol == true) {
					$('#register-conCenter2').show();
					$('#register-conCenter1').hide()
					// location.href = './login.html';
					$('#reg-top dl').eq(1).addClass("jingdu").siblings().removeClass("jingdu")
				}
				if (e.bol == false) {
					console.log(e.bol.msg)
					$('#codeId').html(e.msg);
				} else {
					console.log(e.msg)
					$('#codeId').html(e.msg);
				}
			},
			error: function() {
				console.log("错误！！")
			},
		});
	}

})
// 设置新密码
$('#btn2').click(function() {
	var userName = $('#userName').val(); //用户名
	var repwd = $('#repwd').val(); //确认密码
	var pwd = $('#pwd').val()
	var code = $('#code').val();
	var tel = $('#tel').val();
	$('#reg-top dl').eq(2).addClass("jingdu").siblings().removeClass("jingdu");

	// var flag = true;
	if (!checkPwd() == false && !checkRepwd() == false ) {
		console.log("ok")
		$.ajax({
			type: "POST",
			url: 'http://www.ynresearch.net/editpass',
			data: {
				account: userName,
				new_pwd: repwd,
			},
			success: function(e) {
				console.log(e)
				if (e.bol == true) {
					$('#reg-top dl').eq(2).addClass("jingdu").siblings().removeClass("jingdu");
					$('#register-conCenter2').hide();
					$('#register-conCenter3').show();
					location.href = '/login.html';
				} else if (e.bol == false) {
					console.log(e.bol.msg)
					$('#codeId').html(e.msg);
				} else {
					console.log(e.msg)
					$('#codeId').html(e.msg);
				}
			},
			error: function() {
				console.log("错误！！")
			},
		});
	} else {
		console.log("cup")
	}
})
// 获取 验证码
var clock = '';
var nums = 60;
var btn;
//发送验证码
function sendCode(thisBtn) {
	var userName = $('#userName').val(); //用户名
	var repwd = $('#repwd').val(); //确认密码
	var code = $('#code').val();
	var tel = $('#tel').val();
	console.log(tel)
	//var phoneurl = 'http://www.ynresearch.net/code?phone=17611071700';
	var phoneurl = 'http://www.ynresearch.net/code?phone=' + tel;
	console.log(phoneurl)
	// var flag = true;
	if (!checkUser() == false && !checkTel() == false) {
		flag = false;
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
	} else {
		console.log("cui ")
	}
	// return flag;
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
//失去焦点时，开始验证
$("#userName").blur(checkUser); //用户名
$("#pwd").blur(checkPwd); //验证密码
$("#repwd").blur(checkRepwd); //确认密码
$("#tel").blur(checkTel); //手机号验证
//验证用户名
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
		return true;

	}
}
// 用户名由汉字、字母、数字、等特殊字符组成，长度为4-18个字符
//验证密码
function checkPwd() {
	var pwd = $("#pwd").val().trim();
	var regpwd = /^[0-9a-zA-Z]{4,18}$/;
	if (regpwd.test(pwd) == false) {
		$("#pwd").addClass("error_prompt").removeClass("ok_prompt");
		$("#pwdId").html("*密码由英文字母和数字组成的4-18位字符");
		return false;
	} else {
		$("#pwd").addClass("ok_prompt").removeClass("error_prompt");
		$("#pwdId").html("");
		return true;
	}
}
//确认密码
function checkRepwd() {
	var pwd = $("#pwd").val().trim();
	var repwd = $("#repwd").val().trim();
	if (pwd == "") {
		$("#repwdId").html("*确认密码不能为空");
		return false;
	}
	if (repwd != pwd) {
		$("#repwd").addClass("error_prompt").removeClass("ok_prompt");
		$("#repwdId").html("*两次密码输入不一致");
		return false;
	} else {
		$("#repwdId").html("");
		$("#repwd").addClass("ok_prompt").removeClass("error_prompt");
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
		//  
	} else {
		$("#tel").addClass("ok_prompt").removeClass("error_prompt");
		$("#telId").html("");
		return true;
	}
}
