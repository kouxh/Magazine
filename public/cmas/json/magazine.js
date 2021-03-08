$(function() {
	var zym = 'http://www.chinamas.cn';
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/magationlist",
		// dataType: "json",
		success: function(e) {
			$.each(e.data.six, function(k, v) {
				var html = '';
				// + data.data[0].content
				// html += '<a	class="M_a"><dl><dt><img src="M-img/02.jpg"alt=""></dt><dd>' + v.title +
				// 	'</dd></dl></a >';
				// $('.section_TwoD').html(html);	
				var div = $('<a	class="M_a" id="m_id'+v.m_id+'"><dl><dt><img src="'+zym+''+v.cover_img+'"alt=""></dt><dd>'+v.year+'' + v.title +
					'</dd></dl></a >');
				div.data('item', v);
				$('.section_TwoD .clear ').before(div);
				// $('.section_TwoD .M-ckgd').click(function(){
				// 	console.log('加载更多')
				// })
				$("#m_id" + v.m_id+ "").click(function(){
					location.href = './buy.html?mmid=' + v.m_id + '';
				})
				
			});

			for (var i in e.data.magazine) {
				var html = '';
				// html += '<a class="M_a"><dl><dt><img src="M-img/02.jpg"alt=""></dt><dd>' + e.data.magazine[i].title +
				// 	'</dd></dl></a >';

				// 				for (var k in e.data[i]) {
				// 					console.log(e.data[i])
				// 					var html = '';
				// 					// + data.data[0].content
				// 					html += '<a	class="M_a"><dl><dt><img src="M-img/02.jpg"alt=""></dt><dd>' + e.data[i][k].title +
				// 						'</dd></dl></a >';
				// 
				// 				}

				// console.log(data.data[0].content);
				// $('#resText').empty();   //清空resText里面的所有内容

				// console.log(data.data[0].keyword.length)
				// "#" + data.data[i].id + ""
				
				// $('.section_TwoD ').html(html);
				
			}

		},
		error: function() {
			console.log("错误！！！")

		}
	});
});
