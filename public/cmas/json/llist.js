$(function() {
	// 理论列表
	var zym = 'http://www.chinamas.cn';
	$.ajax({
		type: "GET",
		headers: {
			'CLASS': 'frontier'
		},
		url: "http://www.ynresearch.net/articlelist",
		success: function(data) {
			$("meta[name='description']").attr('content',data.data.describe.describe);//简介
			$.each(data.data.list, function(k, v) {
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
							var url = "./llwz.html?id="
							console.log(url)
							document.getElementById('biuuu_city_list').innerHTML = function() {
								var arr = [],
									thisData = data.data.list.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
								console.log(thisData)
								layui.each(thisData, function(index, item) {
									console.log(item.title)
									// console.log(item.id)
									console.log(index)
									var html = '';
									html += '<a	class="wznr" href="' + url + '' + item.id + '" id="m_id' + item.id +
										'" ><dl><dt><img src=' + item.img +
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
				activity += '<li id="activity' + v.id + '"><a href='+v.img+'>' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>'
				activity += '';
				$('.Right ul .clear').before(activity);

			})

			// 右边
			// 猜你喜欢
			var like = ""
			$.each(data.data.like, function(k, v) {
				var likeurl = './jswz.html?id='
				like +=
					'<li><a href=' + likeurl + '' + v.id + ' target="_blank">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
			})
			$('.sectionR_twoUL1  .ul').html(like);
			//观察
			$.each(data.data.observation, function(k, v) {
				var caSe = '';
				caSe += '<li><a id="caSe' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author +
					'</span></b></li>'
				// Frontier += '<a href="./theory.html" class="ckgd">查看更多</a> '
				$('.sectionR_twoUL2  .ul .ckgd ').before(caSe);
				$("#caSe" + v.id + "").click(function() {
					var ID = v.id;
					// location.href = './alwz.html?id=' + ID;
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
