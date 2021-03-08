$(function() {
	var ID = window.location.search.substr(4);
	var Time = window.location.search.substr(10);
		var zym = 'http://www.chinamas.cn';
	var url = 'http://www.ynresearch.net/articledesc?id=' + ID + '';
	$.ajax({
		type: "GET",
		url: url,
		headers:{
			'CLASS':'industry'
		},
		success: function(data) {
			var html = '';
			html += '<div class="theory_p1"><span class="author">' + data.data.content.author +
				'</span><a class="Title" href="./yj.html?">业界</a><span class="time">' + data.data.content.crea_at + '</span></div><h1>' +
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
					location.href = './yjwz.html?id=' + ID;
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
					location.href = './jswz.html?id=' + ID;
				})
			})
		},
		error: function(xhr, type, errorThrown) {
	
		}
	});
})
