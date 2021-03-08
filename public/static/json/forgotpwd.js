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
	var code = $('#code').val();
	var tel = $('#tel').val();
	var flag = true;
	if (!checkUser()) {
		flag = false;
	}
	if (!checkTel()) {
		flag = false;
	} 
	if (!checkCode()) {
		flag = false;
	}
	else {
		$.ajax({
			type: "POST",
			url: '/Verification',
			data: {
				account: userName,
				tell: tel,
				code: code,
			},
			success: function(e) {
				// console.log(e)
				if (e.bol == true) {
					$('#register-conCenter2').show();
					$('#register-conCenter1').hide()
					// location.href = './login.html';
					$('#reg-top dl').eq(1).addClass("jingdu").siblings().removeClass("jingdu")
				}
				if (e.bol == false) {
					// console.log(e.bol.msg)
					$('#codeId').html(e.msg);
				} else {
					// console.log(e.msg)
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
	if (!checkPwd()) flag = false; //密码
	if (!checkRepwd()) flag = false; //确认密码
	else {
		$.ajax({
			type: "POST",
			url: '/editpass',
			data: {
				account: userName,
				new_pwd: repwd,
			},
			success: function(e) {
				if (e.bol == true) {
					$('#register-conCenter3').show();
					$('#register-conCenter2').hide();
					$('#reg-top dl').eq(2).addClass("jingdu").siblings().removeClass("jingdu");
					setTimeout(function() {
						location.href = '/loadLogin';
					}, 2000);
					
				} else if (e.bol == false) {
					$('#codeId').html(e.msg);
				} else {
					$('#codeId').html(e.msg);
				}
			},
			error: function() {
				console.log("错误！！")
			},
		});
	}
})
// 获取 验证码
var clock = '';
var nums = 60;
var btn;
var isSlide=false;
//发送验证码
function sendCode(thisBtn) {
	var userName = $('#userName').val(); //用户名
	var repwd = $('#repwd').val(); //确认密码
	var code = $('#code').val();
	var tel = $('#tel').val();
	//var phoneurl = 'http://www.ynresearch.net/code?phone=17611071700';
	var phoneurl = 'code?phone=' + tel + '';
	var flag = true;
	if (!checkUser()) {
		flag = false;
	}
	if (!checkTel()) {
		flag = false;
	} else {
		if(isSlide){
			btn = thisBtn;
			btn.disabled = true; //将按钮置为不可点击
			btn.value = nums + '秒可后重新获取';
			clock = setInterval(doLoop, 1000); //一秒执行一次
			// console.log('发送成功')
			$.ajax({
				url: phoneurl,
				type: "get",
				headers: {
					'mode': 2
				},
				async: true,
				success: function(res) {
					console.log(res)
				}
			})
		}else{
			layui.use('layer', function() {
				layer.msg('请按住滑块，拖动到最右边', {
					time: 2000 //2秒关闭（如果不配置，默认是3秒）
				}, function() {});
			})
		}

	}
	// return flag;
}
$(function() {
	var SlideVerifyPlug = window.slideVerifyPlug;
	var slideVerify2 = new SlideVerifyPlug('#verify-wrap2', {
		wrapWidth: '330', //设置 容器的宽度 ，默认为 350 ，也可不用设，你自己css 定义好也可以，插件里面会取一次这个 容器的宽度
		initText: '请按住滑块，拖动到最右边', //设置  初始的 显示文字
		sucessText: '验证通过', //设置 验证通过 显示的文字
		getSucessState: function(res) {
			//当验证完成的时候 会 返回 res 值 true，只留了这个应该够用了
			isSlide = true;
		}
	});
	$("#resetBtn2").on('click', function() {
		slideVerify2.resetVerify();
	})
	$("#getState2").on('click', function() {
		alert(slideVerify2.slideFinishState);
	})
})
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
$('#zc').click(function(data) {
	var userName = $('#userName').val(); //用户名
	var repwd = $('#repwd').val(); //确认密码
	var code = $('#code').val();
	var tel = $('#tel').val();
	// console.log(userName);
	// console.log(repwd + "repwd")
	// console.log(code + "code")
	// console.log(tel + "tel")
	var flag = true;
	if (!checkUser()) flag = false; //用户名
	if (!checkPwd()) flag = false; //密码
	if (!checkRepwd()) flag = false; //确认密码
	if (!checkTel()) flag = false;
	else {
		console.log("dd")
		$.ajax({
			type: "POST",
			url: '/register',
			data: {
				account: userName,
				pwd: repwd,
				code: code,
				phone: tel,
			},
			success: function(e) {
				// console.log(e.bol)
				if (e.bol == true) {
					location.href = '/loadLogin';
				} else if (e.bol == false) {
					// console.log(e.bol.msg)
					$('#codeId').html(e.msg);
					// console.log("该账号已经注册")
				} else {
					// console.log(e.msg)
					$('#codeId').html(e.msg);

				}


			},
			error: function() {
				console.log("错误！！")

			},
		});
	}
	return flag;

});
//失去焦点时，开始验证
$("#userName").blur(checkUser); //用户名
$("#pwd").blur(checkPwd); //验证密码
$("#repwd").blur(checkRepwd); //确认密码
$("#tel").blur(checkTel); //手机号验证
$("#code").blur(checkCode); //验证码验证
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
	}
}
// 用户名由汉字、字母、数字、等特殊字符组成，长度为4-18个字符
//验证密码
function checkPwd() {
	var pwd = $("#pwd").val().trim();
	var regpwd = /^[0-9a-zA-Z]{4,18}$/;
	var regpwd = /^[0-9a-zA-Z]{4,18}$/;
	if (pwd == "") {
		$("#pwdId").html("*请输入密码");
		$("#pwd").addClass("error_prompt").removeClass("ok_prompt");
		return false;
	} if (regpwd.test(pwd) == false) {
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
	if (repwd == "" ) {
		$("#repwdId").html("*请输入确认密码");
		$("#repwd").addClass("error_prompt").removeClass("ok_prompt");
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
	if (tel=="") {
		$("#tel").addClass("error_prompt").removeClass("ok_prompt");
		$("#telId").html("*请输入手机号");
		return false;
	} else if (regtel.test(tel) == false) {
		$("#tel").addClass("error_prompt").removeClass("ok_prompt");
		$("#telId").html("*请输入正确手机号");
	} else {
		$("#tel").addClass("ok_prompt").removeClass("error_prompt");
		$("#telId").html("");
		return true;
	}
}
//验证验证码
function checkCode() {
	var code = $("#code").val().trim();
	if (code=="") {
		$("#code").addClass("error_prompt").removeClass("ok_prompt");
		$("#codeId").html("*请输入验证码");
		return false;
	} else if(/^\d{6}$/.test(code) == false) {
		$("#code").addClass("error_prompt").removeClass("ok_prompt");
		$("#codeId").html("*请输入正确的验证码");
		return false;
	}else{
		$("#codeId").html("");
		$("#code").addClass("ok_prompt").removeClass("error_prompt");
		return true;
	}
}
