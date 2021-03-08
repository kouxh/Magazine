//政策&解读文章
$(function() {
	var ID = window.location.search.substr(4);
	var zym = 'http://www.chinamas.cn';
	var url = 'http://www.ynresearch.net/articledesc?id=' + ID + '';

	$.ajax({
		type: "GET",
		url: url,
		headers: {
			'CLASS': 'policy'
		},
		success: function(data) {
			$('title').html(''+data.data.content.title+'-管理会计研究');//title
			$("meta[name='description']").attr('content',data.data.content.message);//简介
			var html = '';
			html += '<div class="theory_p1"><span class="author">' + data.data.content.author +
				'</span><a class="Title" href="/zcjd.html">政策&解读</a><span class="time">' + data.data.content.crea_at +
				'</span></div><h1>' +
				data.data.content.title +
				'</h1><div class="Article">' + data.data.content.free_content + '</div>';
			$('.sectionc ').html(html);
			// 相关文章
			$.each(data.data.relevant, function(k, v) {
				relevant = '';
				relevant +=
					'<li><a id="relevant' + v.id + '" target="_blank"> ' + v.title + '</a></li>'
				$('.sectionR_twoUL1 .ul .clear').before(relevant);
				$("#relevant" + v.id + "").click(function() {
					var ID = v.id;
					var title = v.title;
					var time = v.crea_at;
					var message = v.message;
					location.href = './zcjdwz.html?id=' + ID;
				})
			})
			// 猜你喜欢
			$.each(data.data.like, function(k, v) {
				like = '';
				like +=
					'<li><a id="like' + v.id + '" target="_blank"> ' + v.title + '</a></li>'
				$('.sectionR_twoUL2 .ul .clear').before(like);
				$("#like" + v.id + "").click(function() {
					var ID = v.id;
					var title = v.title;
					var time = v.crea_at;
					var message = v.message;
					location.href = './yjwz.html?id=' + ID;
				})
			})
			//杂志
			$.each(data.data.magazine, function(k, v) {
				var magazine = '';
				magazine += '<h3><span class="D_Rbspan1">' + data.data.magazine.year + '</span>' + data.data.magazine.title +
					'</h3><h4>邮发代码：80-841</h4><img src="' + zym + '' + data.data.magazine.cover_img +
					'" alt=""><a href="./buy.html?mmid=' + data.data.magazine.m_id +
					'" class="msyd">马上阅读</a><a href="./zz.html" class="ckgd">更多阅读</a>'
				$('.gc_bottomRD').html(magazine);

			})
		},
		error: function(xhr, type, errorThrown) {

		}
	});
})
