// $(document).ready(function() {
// 	//失去焦点时，开始验证
// 	$("#userName").blur(checkUser); //用户名
// 	$("#pwd").blur(checkPwd); //验证密码
// 	$("#repwd").blur(checkRepwd); //确认密码
// 	$("#tel").blur(checkTel); //手机号验证
// 	//验证用户名
// 	function checkUser() {
// 		var user = $("#userName").val().trim();
// 		var reguser = /^[a-zA-Z0-9](\w|.|-){2,16}[a-zA-Z0-9]$/;
// 		if (reguser.test(user) == false) {
// 			$("#nickNameId").html("1、由字母、数字、下划线、点、减号组成<br/>2、只能以数字、字母开头或结尾，组长度为4-18");
// 		} else {
// 			$("#nickNameId").html("用户名输入正确");
// 		}
// 	}
// 	//验证密码
// 	function checkPwd() {

// 		var pwd = $("#pwd").val().trim();
// 		var regpwd = /^[0-9a-zA-Z]{4,18}$/;
// 		if (regpwd.test(pwd) == false) {
// 			$("#pwdId").addClass("error_prompt").removeClass("ok_prompt");
// 			$("#nickNameId").html("密码由英文字母和数字组成的4-18位字符");
// 			return false;
// 		} else {
// 			$("#pwdId").addClass("ok_prompt").removeClass("error_prompt");
// 			$("#nickNameId").html("密码输入正确");
// 			return true;
// 		}
// 	}
// 	//确认密码
// 	function checkRepwd() {
// 		var pwd = $("#pwd").val().trim();
// 		var repwd = $("#repwd").val().trim();
// 		if (pwd == "") {
// 			$("#repwdId").html("");
// 			return false;
// 		}
// 		if (repwd != pwd) {
// 			$("#nickNameId").html("两次密码输入不一致");
// 			return false;
// 		} else {
// 			$("#nickNameId").html("输入正确");
// 			return true;
// 		}
// 	}
// 	//验证手机号
// 	function checkTel() {
// 		var tel = $("#tel").val().trim();
// 		var regtel = /^(13|15|18)[0-9]{9}$/;
// 		if (regtel.test(tel) == false) {
// 			$("#nickNameId").html("手机号只能是以13、15、18开头的11位数字");
// 		} else {
// 			$("#nickNameId").html("手机号输入正确");
// 		}
// 	}
// })
// 