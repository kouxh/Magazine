// 观察列表
$(function() {
	var zym = 'http://www.chinamas.cn';
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/articlelist",
		headers: {
			'CLASS': 'observation'
		},
		success: function(data) {
			$("meta[name='description']").attr('content',data.data.describe.describe);//简介
			layui.use(['laypage', 'layer'], function() {
				var laypage = layui.laypage,
					layer = layui.layer;
				//调用分页
				laypage.render({
					elem: 'pagge',
					limit: 6,
					count: data.data.list.length,
					layout: ['prev', 'page', 'next', 'skip', 'count'],
					theme: '#d82a39',
					jump: function(obj) {
						//模拟渲染
						var url = "./gcwz.html?id="
						document.getElementById('biuuu_city_list').innerHTML = function() {
							var arr = [],
								thisData = data.data.list.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
							layui.each(thisData, function(index, item) {
								var html = '';
								html += '<a	class="wznr" href="' + url + '' + item.id + '" id="m_id' + item.id +
									'" ><dl  class="gc_dl"><dt ><img src='+zym+''+ item.img +
									' alt=""></dt><dd><h3>' + item.title +
									'</h3><p>' + item.message +
									'</p><b><div class="b-sL">';
								for (var c in item.keyword) {
									html += '<span>' + item.keyword[c].name + '</span>';
								}
								html += '</div><div class="b-sR"><span>' + item.author + '</span><span>' + item.crea_at +
									'</span ></div ></b ></dd></dl> </a >';
								arr.push(html);
							});
							return arr.join('');
						}();

					}
				});
			})

			// 技术
			$.each(data.data.technigue, function(k, v) {
				var technigue = '';
				technigue +=
					'<li><a id="technigue' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
				technigue += '</div>';
				$('.gc_bottomL1 .ul .clear').before(technigue);
				$("#technigue" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './jswz.html?id=' + ID;
				})
			})
			// 专访
			$.each(data.data.interview, function(k, v) {
				for (var i = 0; i<k; i++) {
					 var interview = '';
					 // interview+=i
					interview +=
						'<li><a id="interview' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
					interview += '</div>';
					// console.log(i)
				}
				 $('.gc_bottomL2 .gc_bottomLUL .ul .clear').before(interview);
				$("#interview" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './zfwz.html?id=' + ID;
				})
			})
			// 活动 activity
			$.each(data.data.activity, function(k, v) {
				var activity = '';
				activity +=
					'<li><a id="activity' + v.id + '" href='+v.img+'>' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
				activity += '</div>';
				$('.gc_bottomL3 .ul .clear').before(activity);

			})
			// 右边
			// 理论
			$.each(data.data.frontier, function(k, v) {
				var frontier = '';
				frontier += '<li><a id="frontier' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>'
				// Frontier += '<a href="./theory.html" class="ckgd">查看更多</a> '
				$('.sectionR_twoUL2  .ul .ckgd ').before(frontier);
				$("#frontier" + v.id + "").click(function() {
					var ID = v.id;
					var title = v.title;
					var time = v.crea_at;
					var message = v.message;
					location.href = './llwz.html?id=' + ID + '?' + 'time' + time;
				})
			})
			// 业界
			$.each(data.data.industry, function(k, v) {
				var industry = '';
				industry += '<li><a id="industry' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>'
				// Frontier += '<a href="./theory.html" class="ckgd">查看更多</a> '
				$('.sectionR_twoUL3  .ul .ckgd ').before(industry);
				$("#industry" + v.id + "").click(function() {
					var ID = v.id;
					var title = v.title;
					var time = v.crea_at;
					var message = v.message;
					location.href = './yjwz.html?id=' + ID + '?' + 'time' + time;
				})
			})
			// 杂志
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
