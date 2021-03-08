$(function () {
	$('.aui-tag-tp,.tab-box').hide();
	$(".register-top h2").siblings().hide();
	$(".register-top").css({
		borderBottom: "1px solid transparent"
	});
	// 扫码登录
	var obj = new WxLogin({
		self_redirect: false,
		id: "login_container",//显示二维码的容器id
		appid: "wxe55c63ef03977067",//应用唯一标识
		scope: "snsapi_login",//应用授权作用域,网页应用目前仅填写snsapi_login即可
		redirect_uri: encodeURIComponent("https://www.chinamas.cn/wechatLogin"),//重定向地址，需要进行UrlEncode
		style: "black",
		href: "data:text/css;base64,LmltcG93ZXJCb3ggLnFyY29kZSB7d2lkdGg6IDEzMHB4O21hcmdpbi10b3A6MDt9DQouaW1wb3dlckJveCAudGl0bGUge2Rpc3BsYXk6IG5vbmU7fQ0KLmltcG93ZXJCb3ggLmluZm8ge3dpZHRoOiAyMDBweDt9DQouc3RhdHVzX2ljb24ge2Rpc3BsYXk6IG5vbmV9DQouaW1wb3dlckJveCAuc3RhdHVzIHt0ZXh0LWFsaWduOiBjZW50ZXI7fSA=",
	});
	var example = window.location.pathname;
	var urlArr = document.referrer.split('/');
	var urlTZ = urlArr[3];
	$('.lang').click(function () { //账号登陆
		var adminNoname = $('#rc #mobel').val();
		var password = $('#rc #pwd').val();
		var flag = true;
		if (!checkMobel()) flag = false; //手机号
		if (!checkPwd()) flag = false; //密码
		else {
			$.ajax({
				type: "POSt",
				url: "login",
				data: {
					account: adminNoname,
					pwd: password,
				},
				success: function (data) {
					if (data.bol == true) {
						layui.use('layer', function () {
							layui.use('layer', function () {
								layer.msg('登陆成功', {
									// skin: 'demo-class',
									time: 2000 //2秒关闭（如果不配置，默认是3秒）
								}, function () {
									console.log(document.referrer)
									var cc = window.location.host;
									if (document.referrer == "") {
										location.href = '/';
									}
									else if (urlTZ == "loadRegister") {
										location.href = '/';
									}
									else {
										location.href = '' + document.referrer + '';
									}
								});
							})
						})
						//location.href = './index.html';
					} else {

						$("#pwdId").html(data.msg);
					}
				},
				error: function () {
					console.log("错误！！！")
				}
			});
		}

	});
	$('.landtwo').click(function () { // 动态码登陆
		var tel = $('#tel').val();
		var code = $('#verifyNo').val();
		var flag = true;
		if (!checkTel()) flag = false; //手机号
		if (!checkCode()) flag = false; //验证码
		else {
			$.ajax({
				type: "POST",
				url: "codelogin",
				data: {
					phone: tel,
					code: code
				},
				success: function (data) {

					if (data.bol == true) {
						// 提示登陆成功
						layui.use('layer', function () {
							layui.use('layer', function () {
								layer.msg('登陆成功', {
									// skin: 'demo-class',
									time: 2000 //2秒关闭（如果不配置，默认是3秒）
								}, function () {
									if (document.referrer == "") {
										location.href = '/';
									}
									else if (urlTZ == "loadRegister") {
										location.href = '/';
									}
									else {
										location.href = '' + document.referrer + '';
									}
								});
							})
						})
					} else {
						var fs = data.msg;
						var html = '';
						html += data.msg;
						$("#codeId").html(fs);
					}
				},
				error: function () {
					console.log("错误！！！")
				}

			})
		}


	})
	$('#qrcode').click(function () {//扫码登录
		 	$('.saoma').fadeIn(2000);
			$('.aui-tag-tp,.tab-box').hide();
			$(".register-top h2").siblings().hide();
			$(".register-top").css({
				borderBottom: "1px solid transparent"
			});
		var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
		//判断是否Firefox浏览器
		if (userAgent.indexOf("Firefox") > -1) {
			setTimeout(() => {
				reLoad();
			}, 500);
		} 

	})

	$('#screen').click(function () {//账号密码登录
		$('.aui-tag-tp,.tab-box').fadeIn(2000);
		$(".register-top h2").siblings().fadeIn(2000);
		$('.saoma').hide();
		$(".register-top").css({
			borderBottom: "1px solid #ebebeb"
		});
	})
	function IsPC() {
		var userAgentInfo = navigator.userAgent;
		var Agents = ["Android", "iPhone",
			"SymbianOS", "Windows Phone",
			"iPad", "iPod"];
		var typeFlag = true;
		for (var v = 0; v < Agents.length; v++) {
			if (userAgentInfo.indexOf(Agents[v]) > 0) {
				typeFlag = false;
				break;
			}
		}
		return typeFlag;
	}
	var typeFlag = IsPC(); //true为PC端，false为手机端
	if (typeFlag == false) {
		$('#qrcode').unbind("click"); //移除click
		// 扫码登录
		$('.aui-tag-tp,.tab-box').fadeIn(2000);
		$(".register-top h2").siblings().fadeIn(2000);
		$('.saoma').hide();
		$(".register-top").css({
			borderBottom: "1px solid #ebebeb"
		});

	}

})



//刷新当前页面
function reLoad() {
	window.location.reload()//刷新当前页面
}

// 获取 验证码
var clock = '';
var nums = 60;
var btn;
var isSlide=false;
//发送验证码
function sendCode(thisBtn) {
	var tel = $('#tel').val();
	var code = $('#verifyNo').val();
	var phoneurl = 'code?phone=' + tel + '';
	if (!checkTel()) {
		flag = false;
	} else {
		if(isSlide){
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
				success: function (e) {
					// console.log(e)
				}
			});
		}else{
			layui.use('layer', function() {
				layer.msg('请按住滑块，拖动到最右边', {
					time: 2000 //2秒关闭（如果不配置，默认是3秒）
				}, function() {});
			})
		}


	}

}

$(function() {
	var SlideVerifyPlug = window.slideVerifyPlug;
	var slideVerify2 = new SlideVerifyPlug('#verify-wrap2', {
		wrapWidth: '296', //设置 容器的宽度 ，默认为 350 ，也可不用设，你自己css 定义好也可以，插件里面会取一次这个 容器的宽度
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
$("#mobel").blur(checkMobel); //用户名
$("#pwd").blur(checkPwd); //验证密码
$("#tel").blur(checkTel); //手机号验证
$("#verifyNo").blur(checkCode); //验证码验证

//验证密码
function checkPwd() {
	var pwd = $("#pwd").val().trim();
	var regpwd = /^[0-9a-zA-Z]{4,18}$/;
	if (pwd == "") {
		$("#pwdId").html("*请输入密码");
		$("#pwd").addClass("error_prompt").removeClass("ok_prompt");
		return false;
	} else if (regpwd.test(pwd) == false) {
		$("#pwdId").html("*密码由英文字母和数字组成的4-18位字符");
		$("#pwd").addClass("error_prompt").removeClass("ok_prompt");
		return false;
	} else {
		$("#pwdId").html("");
		$("#pwd").addClass("ok_prompt").removeClass("error_prompt");
		// $("#nickNameId").html("密码输入正确");
		return true;
	}
}
//验证手机号
function checkTel() {
	var tel = $("#tel").val().trim();
	var regtel = /^(13|15|18)[0-9]{9}$/;
	if (tel == "") {
		$("#tel").addClass("error_prompt").removeClass("ok_prompt");
		$("#telId").html("*请输入手机号");
		return false;
	} else if (regtel.test(tel) == false) {
		$("#telId").html("*请输入正确手机号");
		$("#tel").addClass("error_prompt").removeClass("ok_prompt");
		return false;
	} else {
		$("#telId").html("");
		$("#tel").addClass("ok_prompt").removeClass("error_prompt");
		return true;
	}
}
//验证密码登录手机号
function checkMobel() {
	var tel = $("#mobel").val().trim();
	var regtel = /^(13|15|18)[0-9]{9}$/;
	if (tel == "") {
		$("#mobel").addClass("error_prompt").removeClass("ok_prompt");
		$("#mobelId").html("*请输入手机号");
		return false;
	} else if (regtel.test(tel) == false) {
		$("#mobelId").html("*请输入正确手机号");
		$("#mobel").addClass("error_prompt").removeClass("ok_prompt");
		return false;
	} else {
		$("#mobelId").html("");
		$("#mobel").addClass("ok_prompt").removeClass("error_prompt");
		return true;
	}
}
//验证动态码  var res =/^\d{6}$/;
function checkCode() {
	var code = $("#verifyNo").val().trim();
	if (code == "") {
		$("#verifyNo").addClass("error_prompt").removeClass("ok_prompt");
		$("#codeId").html("*请输入动态码");
		return false;
	} else if (/^\d{6}$/.test(code) == false) {
		$("#verifyNo").addClass("error_prompt").removeClass("ok_prompt");
		$("#codeId").html("*请输入正确的验证码");
		return false;
	} else {
		$("#codeId").html("");
		$("#verifyNo").addClass("ok_prompt").removeClass("error_prompt");
		return true;
	}
}
