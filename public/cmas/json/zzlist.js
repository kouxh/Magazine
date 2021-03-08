// 杂志列表
$(function() {
	var zym = 'http://www.chinamas.cn';
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/magationlist",
		success: function(data) {
			// console.log(data.data["2019年"]);
			// 2019年
			$.each(data.data["2019年"], function(k, v) {
				var html = '';
				var html = $('<a href="/buy.html?mmid=' + v.m_id + '" class="M_a" id="m_id' + v.m_id +
					'"><dl><dt><img src="' + zym + '' + v.cover_img + '"alt=""></dt><dd>' + v.year + '' + v.title +
					'</dd></dl></a >');
				// div.data('item', v);
				$('.main1 .clear').before(html);

			});
			// 2018年
			$.each(data.data["2018年"], function(k, v) {
				var div = '';
				var div = $('<a class="M_a" href="/buy.html?mmid=' + v.m_id + '" id="m_id' + v.m_id + '"><dl><dt><img src="' +
					zym + '' + v.cover_img + '"alt=""></dt><dd>' + v.year + '' + v.title +
					'</dd></dl></a >');
				$('.main2 .clear').before(div);


			});
		},
		error: function() {
			console.log("错误！！！")

		}
	});

});
