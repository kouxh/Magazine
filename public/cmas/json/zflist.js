// 专访列表
$(function() {
		var zym = 'http://www.chinamas.cn';
	$.ajax({
		type: "GET",
		headers:{
			'CLASS':'interview'
		},
		url: "http://www.ynresearch.net/articlelist",
		success: function(data) {
			$("meta[name='description']").attr('content',data.data.describe.describe);//简介
			$.each(data.data.interview, function(k, v) {
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
							var url = "./zfwz.html?id="
							document.getElementById('biuuu_city_list').innerHTML = function() {
								var arr = [],
									thisData = data.data.list.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
								layui.each(thisData, function(index, item) {
									var html = '';
									html += '<a	class="wznr" href="' + url + '' + item.id + '" id="m_id' + item.id +
										'" ><dl><dt><img src='+zym+'' + item.img +
										' alt=""></dt><dd><h3>' + item.title +
										'</h3><p>' + item.message +
										'</p><b><div class="b-sL">';
									for (var c in item.keyword) {
										html += '<span>' + item.keyword[c].name + '</span>';
									}
									html += '</div><div class="b-sR"><span>' + item.author + '</span><span>' + item.crea_at +
										'</span ></div ></b ></dd></dl> </a >';
									// console.log(html)
									arr.push(html);
								});
								return arr.join('');
							}();
				
						}
					});
				})
			})
			// frontier 理论
			$.each(data.data.frontier, function(k, v) {
				var Frontier = '';
				Frontier +=
					'<li><a id="Frontier' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
				Frontier += '</div>';
				$('.bottomL1 .ul .clear').before(Frontier);
				$("#Frontier" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './llwz.html?id=' + ID;
				})
			})
			// 技术
			$.each(data.data.technigue, function(k, v) {
				var technigue = '';
				technigue +=
					'<li><a id="technigue' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
				technigue += '</div>';
				$('.bottomL2 .ul .clear').before(technigue);
				$("#technigue" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './jswz.html?id=' + ID;
				})
			})
			// 案例 case
			$.each(data.data.research, function(k, v) {
				var research = '';
				research +=
					'<li><a id="research' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
				research += '</div>';
				$('.bottomL3 .ul .clear').before(research);
				$("#research" + v.id + "").click(function() {
					var ID = v.id;
					location.href = './alwz.html?id=' + ID;
				})
			})
			// 活动 activity
			$.each(data.data.activity, function(k, v) {
				var activity = '';
				activity +=
					'<li><a id="activity' + v.id + '" href='+v.img+'>' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
				activity += '</div>';
				$('.bottomL4 .ul .clear').before(activity);

			})
			// 右边
			// 猜你喜欢
			var like = ""
			$.each(data.data.like, function(k, v) {
				var likeurl = './jswz.html?id='
				like +=
					'<li><a href="' + likeurl + '' + v.id + '" id="like' + v.id + '">' + v.title +
					'</a><b>作者：<span>' + v.author + '</span></b></li>';
				$('.sectionR_twoUL1  .ul ').html(like);
			})
			// 观察
			$.each(data.data.observation, function(k, v) {
				var observation = '';
				observation += '<li><a id="observation' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>'
				// Frontier += '<a href="./theory.html" class="ckgd">查看更多</a> '
				$('.sectionR_twoUL2  .ul .ckgd ').before(observation);
				$("#observation" + v.id + "").click(function() {
					var ID = v.id;
					var title = v.title;
					var time = v.crea_at;
					var message = v.message;
					location.href = './gcwz.html?id=' + ID + '?' + 'time' + time;
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
