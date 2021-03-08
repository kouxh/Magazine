// 业界
$(function() {
	var token = localStorage.getItem(token);
	var  zym='http://www.chinamas.cn';
	console.log(token)
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/articlelist",
		headers:{
			'CLASS':'industry'
		},
		beforeSend: function(request) {
			request.setRequestHeader("TOKEN", token);
		},
		success: function(data) {
			$("meta[name='description']").attr('content',data.data.describe.describe);//简介
			// 业界新闻
			$.each(data.data.news, function(k, v) {
				var news = "";
				news += '<li><a id="news' + v.id + '">' + v.title + '</a></li>'
				$('.Left .section3_lBD ul .clear').before(news);
				$("#news" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './yjxwwz.html?id=' + ID;
				})
			})
			// before
			// 热点hotspot
			$.each(data.data.hotspot, function(k, v) {
				var hotspot = '';
				hotspot += '<li><a id="hotspot' + v.id + '">' + v.title + '</a></li>'

				$('.Center .section3_lBD ul .clear').before(hotspot);
				$("#hotspot" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './rdwz.html?id=' + ID;
				})
			})
			// 政策policy
			$.each(data.data.policy, function(k, v) {
				var policy = '';
				policy += '<li><a id="policy' + v.id + '">' + v.title + '</a></li>'
				$('.right .section3_lBD ul .clear').before(policy);
				$("#policy" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './zcjdwz.html?id=' + ID;
				})
			})

			// recommendModel文章
			$.each(data.data.recommend, function(k, v) {
				var recommend = '';
				recommend += '<li id="recommend' + v.id + '"><a>' + v.title + '</a><b>' + v.author + '</b></li>'

			$('.Home-section1D .ul .clear ').before(recommend);
				$("#recommend" + v.id + "").click(function() {
				var ID = v.id;
				location.href = './tjyd.html?id=' + ID;
			})
			})
			// interview专访 
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
			// 活动
			$.each(data.data.activity, function(k, v) {
				var activity = '';
				activity += '<li id="activity' + v.id + '" ><a href='+v.img+'>' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>'
				activity += '';
				$('.Right ul .clear').before(activity);

			})
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

	})
})
