// 首页列表
$(function() {
	var  zym='http://www.chinamas.cn';
	function getCookie(name) {
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg)) return unescape(arr[2]);
		else return null;
	}
	var token=getCookie("token")
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/show",
		beforeSend: function(request) {
			request.setRequestHeader("TOKEN", token);
		},
		success: function(data) {
			//观察
			$.each(data.data.observation, function(k, v) {
				var html = '';
				html += '<dl  id="observation' + v.id + '"><dt><img src='+zym+''+v.img+' alt=""></dt><dd><p class="title">'+v.title+'</p><p class="message">'+v. message+'</p><p class="p2">'+v.crea_at+'</p></dd></dl>';
				// for (var c in v.keyword) {
				// 	html += '<span>' + v.keyword[c].name + '</span>';
				// }
				$('.Gc .Gc_1  .ck').before(html);
				// 点击跳转技术文章
				$("#observation" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './gcwz.html?id=' + ID;
				})
			})
			// 荐读 recommended
			$.each(data.data.recommended, function(k, v) {
				var html = '';
				html +=
					'<dl id="recommended' + v.id + '" ><a><dt><img src='+v.img+' alt=""></dt><dd><p>' +
					v.title + '</p></dd></a></dl>';
				for (var c in v.keyword) {
					html += '<span>' + v.keyword[c].name + '</span>';
				}
				$('.jD .clear').before(html);
				// 点击跳转技术文章
				$("#recommended" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './tjyd.html?id=' + ID;
				})
			})
			//新闻
			$.each(data.data.news, function(k, v) {
				var news = '';
				news += '<li  id="observation' + v.id + '"><a  ><p class="p1">'+v.title+'</p><p class="p3">'+v.message+'</p><p class="p2">'+ v.crea_at + '</p></li>';
				for (var c in v.keyword) {
					html += '<span>' + v.keyword[c].name + '</span>';
				}
				$('.Xw2 ul .ck').before(news);
				$("#observation" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './yjwz.html?id=' + ID;
				})
			})
			//理论
			$.each(data.data.frontier, function(k, v) {
				var html = '';
				html += '<li><a  id="frontier' + v.id + '" >' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>';
				for (var c in v.keyword) {
					html += '<span>' + v.keyword[c].name + '</span>';
				}
				$('.section3_lB1 ul .clear').before(html);
				// 点击跳转技术文章
				$("#frontier" + v.id + "").click(function() {
					var ID = v.id;
					location.href = '/llwz.html?id=' + ID;
				})
			})
			// 案例列表
			$.each(data.data.case_list, function(k, v) {
				var html = '';
				html += '<li><a  id="case_list' + v.id + '" >' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>';
				for (var c in v.keyword) {
					html += '<span>' + v.keyword[c].name + '</span>';
				}
				$('.section3_lB2 ul .clear').before(html);
				// 点击跳转技术文章
				$("#case_list" + v.id + "").click(function() {
					var ID = v.id;
					location.href = '/alwz.html?id=' + ID;
				})
			})
			//技术
			$.each(data.data.technigue, function(k, v) {
				var html = '';
				html += '<li><a  id="technigue' + v.id + '" >' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>';
				for (var c in v.keyword) {
					html += '<span>' + v.keyword[c].name + '</span>';
				}
				$('.section3_lB3 ul .clear').before(html);
				// 点击跳转技术文章
				$("#technigue" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './jswz.html?id=' + ID;
				})
			})


			// // 活动
			$.each(data.data.activity, function(k, v) {
				var html = '';
				html += '<li><a  href='+v.img+' id="activity' + v.id + '" >' + v.title + '</a></li>';
				for (var c in v.keyword) {
					html += '<span>' + v.keyword[c].name + '</span>';
				}
				$('.section5r_lB ul .clear').before(html);
				// 点击跳转技术文章
				// $("#activity" + v.id + "").click(function() {
				// 	var ID = v.id;
				// 	location.href = './hdwz.html?id=' + ID;
				// })
			})
			//interview专访
			$.each(data.data.interview, function(k, v) {
				var interview = '';
				interview += '<li  id="interview' + v.id + '"><a><img src=' + v.img +
					' alt=""><h3>' + v.title + '</h3></a><b>作者：<span>' + v.author + '</span></b></li>'
				$('.Home-section4_cB ul .ckgd').before(interview);
				$("#interview" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './zfwz.html?id=' + ID;
				})

			})

			// 杂志
			$.each(data.data.magazine, function(k, v) {
				var magazine = '';
				magazine += '<h3><span class="D_Rbspan1">' + data.data.magazine.year + '</span>' + data.data.magazine.title +
					'</h3><h4>邮发代码：80-841</h4><img src="'+zym+''+data.data.magazine.cover_img+'" alt=""><a href="./buy.html?mmid='+data.data.magazine.m_id+'" class="btn_a">马上阅读</a><a href="./zz.html" class="btn_a2">更多阅读</a>'
				$('.Home-section1D_Rb').html(magazine);
				$("#magazine" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './hdwz.html?id=' + ID;
				})
			})

		},
		error: function(xhr, type, errorThrown) {

		}
	});
})
