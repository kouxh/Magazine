$(function() {
	var url = "http://www.ynresearch.net/register"
	var user = $('.user').val();
	var password = $('#password').val();
	var code = $('#code').val();
	var sj = $('#sj').val();
});
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
	var phoneurl = 'http://www.ynresearch.net/code?phone=' + tel + '';
	var flag = true;
	// if (!checkUser()) {
	// 	flag = false;
	// 	console.log("用户名");
	// 	console.log(flag)
	// }
	// if (!checkPwd()) {
	// 	flag = false;
	// 	console.log("密码");			console.log(flag)
	// }
	// if (!checkRepwd()) {
	// 	flag = false;
	// 	console.log("确认密码");
	// 	console.log(flag)
	// }
	if (!checkUser() == false && !checkPwd() == false && !checkRepwd() == false && checkTel() == true) {
		console.log("用户名,密码OK");
		btn = thisBtn;
		btn.disabled = true; //将按钮置为不可点击
		btn.value = nums + '秒可后重新获取';
		clock = setInterval(doLoop, 1000); //一秒执行一次
		$.ajax({
			url: phoneurl,
			type: "get",
			headers: {
				'mode': 1
			},
			success: function(res) {
				console.log(res)
				console.log(res.code)
				// $("#zc").attr("disabled", true)
				if (res.code == 9999) {
					$('#telId').html("该手机号已经注册")
					$("#zc").attr("disabled", true)
				} else {
					btn = thisBtn;
					btn.disabled = true; //将按钮置为不可点击
					btn.value = nums + '秒可后重新获取';
					clock = setInterval(doLoop, 1000); //一秒执行一次
				}
			}
		})
	} else {
		console.log("有其他，内容没有输入完成")

	}

	console.log("else")

	// if (!checkUser() && !checkPwd() && !checkRepwd() == false) {
	// 	flag = false;
	// 	console.log("ok")
	// } 
	// else {
	// 	console.log("else")
	// btn = thisBtn;
	// btn.disabled = true; //将按钮置为不可点击
	// btn.value = nums + '秒可后重新获取';
	// clock = setInterval(doLoop, 1000); //一秒执行一次
	// $.ajax({
	// 	url: phoneurl,
	// 	type: "get",
	// 	headers: {
	// 		'mode': 1
	// 	},
	// 	success: function(res) {
	// 		console.log(res)
	// 		console.log(res.code)
	// 		// $("#zc").attr("disabled", true)
	// 		if (res.code == 9999) {
	// 			$('#telId').html("该手机号已经注册")
	// 			$("#zc").attr("disabled", true)
	// 		} else {
	// 			btn = thisBtn;
	// 			btn.disabled = true; //将按钮置为不可点击
	// 			btn.value = nums + '秒可后重新获取';
	// 			clock = setInterval(doLoop, 1000); //一秒执行一次
	// 		}
	// 	}
	// })
	// }
	return flag;
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
$('#zc').click(function(data) {
	var userName = $('#userName').val(); //用户名
	var repwd = $('#repwd').val(); //确认密码
	var code = $('#code').val();
	var tel = $('#tel').val();
	var flag = true;
	if (!checkUser()) flag = false; //用户名
	if (!checkPwd()) flag = false; //密码
	if (!checkRepwd()) flag = false; //确认密码
	if (!checkTel()) flag = false;
	if (!checkUser() == false && !checkPwd() == false && !checkRepwd() == false && !checkTel() == false) {
		var arr = [];
		layer.open({
			type: 2,
			title: ['设置你的兴趣，以下内容的更新会出现在这里'],
			maxmin: true,
			shadeClose: true, //点击遮罩关闭层
			area: ['800px', '450px'],
			content: '/tips/Interest.html',
			btn: ['下一步', '取消'],
			success: function(layero, index) {
				var body = layer.getChildFrame('body', index);
				console.log(body.html())
				console.log();
				$.ajax({
					type: "GET",
					url: 'http://www.ynresearch.net/loadKeyword',
					beforeSend: function(request) {
						request.setRequestHeader("TOKEN", token);
					},
					success: function(e) {
						console.log(e)
						$.each(e.data, function(k, v) {
							var h = '';
							h +=
								'<li class=""   id=' + v.id + '><label for="setting-interest-' + v.id +
								'"><input type="checkbox" name="editor_2" value="19" id="setting-interest-19">' +
								v.title + '</label></li>';
							body.find('.Interest .item .clear').before(h)

						})

						body.find(".Interest .item li").click(function() {
							if (!$(this).hasClass("on")) {
								$(this).addClass("on");
								var kid = parseFloat(body.find($(this)).attr("id"));
								arr.push(kid);
							} else {
								$(this).removeClass('on');
								var kid = parseFloat(body.find($(this)).attr("id"));
								// var local = $.inArray(kid, json); //根据元素值查找下标，不存在返回-1
								var cc = arr.splice($.inArray(kid, arr), 1)
							}
						});

					}
				})
			},
			
			yes: function(index, layero) {
				var kid = '';
				for (i = 0; i < arr.length; i++) {
					kid += arr[i] + ',';
				}
				if (kid !== '') {
					$.ajax({
						type: "POST",
						url: 'http://www.ynresearch.net/register',
						data: {
							account: userName,
							pwd: repwd,
							code: code,
							phone: tel,
							kid: kid,
						},
						success: function(e) {
							if (e.bol == true) {
								layui.use('layer', function() {
									layui.use('layer', function() {
										layer.msg('注册成功', {
											skin: 'demo-class',
											time: 2000 //2秒关闭（如果不配置，默认是3秒）
										}, function() {
											location.href = '/login.html';

										});
									})
								})
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
				} else {
					//console.log
					console.log("不可注册")
				}
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
// 用户名由汉字、字母、数字、等特殊字符组成，长度为4-18个字符 不能输入空格
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
