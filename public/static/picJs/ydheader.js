//
//
//
// // 退出
//
// // function getCookie(name) {
// // 	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
// // 	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
// // 	else return null;
// // }
// //
// // function getCookies(name) {
// // 	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
// // 	console.log(new RegExp("(^| )" + name + "=([^;]*)(;|$)"))
// // 	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
// // 	else return null;
// // }
// // //删除cookies
// // function delCookie(name) {
// // 	var exp = new Date();
// // 	exp.setTime(exp.getTime() - 1);
// // 	var cval = getCookie(name);
// // 	if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
// // }
// // // setCookie("token",token);
// // var token = getCookie("token")
// // var user = getCookies("user")
// // console.log(token)
// // console.log(user)
//
//
//
//
// session = localStorage.getItem("key");
// console.log(session);
// if (session == null) { //没有登陆Í
// 	console.log('没有登陆');
// 	$('.Gmheader_pcBR').hide();
// 	// 文章没有登陆提示
// 	// 提示登陆注册
// 	$('.sectionc #ArtiCle').hide();
// } else { //已经登陆
// 	console.log("登陆")
// 	$('.NOzc').hide();
// 	$('.Tc .Tc_user span').text(user)
// }
// //
// // //
// // $("#outlogin").click(function() {
// // 	// var token = localStorage.getItem(token)
// // 	// console.log(token);
// // 	console.log("tuichu")
// // 	$.ajax({
// // 		url: 'outlogin',
// // 		type: 'GET', //HTTP请求类型
// // 		timeout: 10000, //超时时间设置为10秒；
// // 		beforeSend: function(request) {
// // 			request.setRequestHeader("TOKEN", token);
// // 		},
// // 		success: function(data) {
// // 			console.log(data.bol)
// // 			if (data.bol = true) {
// // 				// console.log(data.bol)
// // 				location.href = '/';
// // 				delCookie("token");
// //
// // 			}
// // 		},
// // 		error: function(xhr, type, errorThrown) {
// //
// // 		}
// // 	});
// // })
// // $(window).unload( function () {
// // 	delCookie("token");
// // 	console.log("退出")
// // } );
// // window.onbeforeunload = function() {
// // 	alert("关闭浏览器")
// // 	// var n = window.event.screenX - window.screenLeft;
// // 	// var b = n > document.documentElement.scrollWidth - 20;
// // 	// if (b && window.event.clientY < 0 || window.event.altKey) {
// // 	// 	delCookie();
// // 	// }
// // }
// // window.onbeforeunload = function() {
// // 	 // return "我在这写点东西...";
// // 	  delCookie(token);
// // // }
// window.close=function() {
// 	 // return "我在这写点东西...";
// 	  delCookie(token);
// }
$(document).ready(function() {

	// 	var onind = ind = -1;
	//
	// 	$(document).bind("click", function(e) {
	// 		var target = $(e.target);
	// 		if (target.closest(".yntop_menu_icon").length == 0 && target.closest(".mo_dropmenu_title").length == 0 && $(
	// 				window).width() <= 1024) {
	// 			$(".yntop_menu_icon .hamburger").removeClass("is-active");
	//
	// 			$(".mo_dropmenu").slideUp();
	// 			$(".mo_dropmenu_drop").slideUp();
	// 			oldind = -1;
	// 		}
	//
	// 		if (target.closest(".moseacher_icon").length == 0 && target.closest(".mo_search_form").length == 0 && $(window).width() <=
	// 			1024) {
	// 			$(".mo_search_form").slideUp();
	// 		}
	// 	})
	// 	$(".yntop_menu_icon .hamburger").click(function() {
	// 		console.log("aa")
	//
	// 		if ($(this).attr("class") == "hamburger is-active") {
	// 			$(".mo_dropmenu_drop").slideUp();
	// 			oldind = -1;
	// 			$(".yntop_menu_icon .hamburger span:eq(1)").css({
	// 				"opacity": "1"
	// 			});
	// 			// $('.yn_motop_left').css({
	// 			// 	"background": "#000"
	// 			// })
	// 		} else {
	// 			$(".yntop_menu_icon .hamburger span:eq(1)").css({
	// 				"opacity": "1"
	// 			});
	// 			$('.yn_motop_left').css({
	// 				"background": "#000"
	// 			})
	// 		}
	// 		$(this).toggleClass("is-active");
	//
	// 		$(".mo_dropmenu").slideToggle();
	//
	// 	});
	//
	// 	$(".mo_dropmenu_title").click(function() {
	// 		ind = $(this).parent("li").index();
	//
	// 		$(".mo_dropmenu_drop").slideUp();
	//
	// 		if (onind == ind) {
	// 			onind = -1;
	// 		} else {
	// 			$(this).parent("li").find(".mo_dropmenu_drop").slideDown();
	//
	// 			onind = ind;
	// 		}
	// 	});
	//
	// 	$(".moseacher_icon").click(function() {
	// 		console.log('dd')
	// 		$(".mo_search_form").slideToggle();
	//
	// 	});
	// $(".yn_motop_right").click(function() {
	// 	if($(".mo_dropmenu").is(":hidden")) {
	// 		$.get('contribute', {}, function (data) {
	// 			if (data.bol == true) {
	// 				$('.yn_motop_left').hide();
	// 				$(".mo_dropmenu").show();
	// 				$(this).addClass("open");
	// 				$(".yn_motop_right .three").addClass("col")
	// 				$(".yn_motop_right .three").removeClass('col1');
	// 				$('.yn_motop_left .personal').css({
	// 					"display":"block"
	// 				});
	// 				$('body').css({
	// 					"overflow": "hidden"
	// 				})
	// 				$('.yn_motop_left .search').css({
	// 					"display":"none"
	// 				});
	// 			} else {
	//
	// 				// location.href = '/loadLogin';
	// 			}
	// 		})
	//
	// 	} else {
	// 		$(".mo_dropmenu").hide();
	// 		$(this).removeClass("open");
	// 		$(".yn_motop_right .three").removeClass('col');
	// 		$(".yn_motop_right .three").addClass("col1");
	// 		$('.yn_motop_left .search').css({
	// 			"display":"none"
	// 		});
	// 		$('.yn_motop_left .personal').css({
	// 			"display":"none"
	// 		});		;
	// 		$('body').css({
	// 			"overflow": "inherit"
	// 		})
	// 	}
	// });
	// $(".yn_motop_right").click(function() {
	// 	console.log(2)
	// 	$.get('contribute', {}, function (data) {
	// 			if($(".mo_dropmenu").is(":hidden")) {
	// 				if(data.bol == true){
	// 					$('.personal').hide();
	// 					$('.yn_motop_left').hide();
	// 					console.log("登陆")
	// 				}
	// 				else{
	// 					console.log("没有登陆")
	// 					$('.yn_motop_left .personal').css({
	// 						"display":"block"
	// 					});
	// 				}
	//
	// 				$(".mo_dropmenu").show();
	// 				$('.yn_motop_right').addClass("open");
	// 				$(".yn_motop_right .three").addClass("col")
	// 				$(".yn_motop_right .three").removeClass('col1');
	// 				// $('.yn_motop_left .personal').css({
	// 				// 	"display":"block"
	// 				// });
	// 				$('body').css({
	// 					"overflow": "hidden"
	// 				})
	// 				$('.yn_motop_left .search').css({
	// 					"display":"none"
	// 				});
	//
	//
	// 			}else{
	// 				console.log("nin")
	// 				$(".mo_dropmenu").hide();
	// 				$('.yn_motop_right').removeClass("open");
	// 				$(".yn_motop_right .three").removeClass('col');
	// 				$(".yn_motop_right .three").addClass("col1");
	// 				$('.yn_motop_left .search').css({
	// 					"display":"none"
	// 				});
	// 				$('.yn_motop_left .personal').css({
	// 					"display":"none"
	// 				});		;
	// 				$('body').css({
	// 					"overflow": "inherit"
	// 				})
	// 			}
	//
	// 	})
	//
	// })

});
