$(function() {
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/frontierlist",
		success: function(data) {
			$.each(data.data, function(k, v) {
				console.log(data.data[k].crea_time);
				console.log()
				var html = '';
				html += '<a	  class="wznr" id="m_id'+data.data[k].id + '" ><dl><dt><img src=' + data.data[
						k].img +' alt=""></dt><dd><h3>' + data.data[k].title + '</h3><p>' + data.data[k].message + '</p><b><div class="b-sL">';


				for (var c in data.data[k].keyword) {
					console.log(data.data[k].keyword[c].name);
					console.log(c)
					html += '<span>' + data.data[k].keyword[c].name + '</span>';

				}
				html += '</div><div class="b-sR"><span>' + data.data[k].author + '</span><span>' + data.data[k].crea_at +
					'</span ></div ></b ></dd></dl> </a >';
				$('.sectionLb .clear').before(html);
				$("#m_id" + data.data[k].id + "").click(function(){
					var ID=data.data[k].id;
					var title = data.data[k].title;
					var img = data.data[k].img;
					var message = data.data[k].message;
					console.log(ID)
					// window.location.href = "../cmas/list.html";
					 location.href = '../cmas/lilun.html?mmid='+ID+'?time='+data.data[k].crea_at+'';
				})
				// 				for (var i in data.data) {
				// 					after
				// 					// + data.data[0].content
				// 					
				// 					
				// 					html += '</div><div class="b-sR"><span>' + data.data[i].author + '</span><span>' + data.data[i].crea_time +
				// 						'</span ></div ></b ></dd></dl> </a >';
				// 					// console.log(data.data[0].keyword.length)
				// 					// "#" + data.data[i].id + ""
				// 
				// 					
				// 				}
			})
		},
		error: function(xhr, type, errorThrown) {

		}
	});
})
