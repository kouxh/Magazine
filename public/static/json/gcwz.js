$(function() {
	var ID = window.location.search.substr(4);
	var zym = 'http://test.chinamas.cn';;

	function getCookie(name) {
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg)) return unescape(arr[2]);
		else return null;
	}
	var token = getCookie("token", token);
	var url = 'http://www.ynresearch.net/articledesc?id=' + ID + '&&token=' + token;
	$.ajax({
		type: "GET",
		url: url,
		headers: {
			'CLASS': 'observation'
		},
		success: function(data) {
			var cc = data.data.like[0].id;
			var html = '';
			$('title').html(''+data.data.content.title+'-管理会计研究');//title
			$("meta[name='description']").attr('content',data.data.content.message);//简介

			html += '<div class="theory_p1"><span class="author">' + data.data.content.author +
				'</span><a class="Title" href="./gc.html?">观察</a><span class="time">' + data.data.content.crea_at +
				'</span></div><h1>' +
				data.data.content.title +
				'</h1><div class="Article" >' + data.data.content.free_content + '</div>';
			$('.sectionc .longText2 ').html(html);
			// $('.longText2').textify({
			// 	numberOfColumn: 1,
			// 	margin: 20,
			// 	padding: 15,
			// 	width: "auto",
			// 	height: "auto",
			// 	showNavigation: true,
			// 	textAlign: 'justify'
			// })
			$('#ArtiCle_status .ArtiCle2 .bINput #label b').text(data.data.content.price);
			// 如果等于1为付费 文章
			if (data.data.content.is_charge == 0) {
				$('#ArtiCle_status').hide();
			} else if (data.data.content.is_charge == 2) {
				$('.ArtiCle_status').hide();
				var charge_content = data.data.charge_content;
				$(".Article").append(charge_content);
				// console.log($('.Article').append(2))

			}
			// 购买单片文章 
			// 1积分 2人民币
			$("#purchase").click(function() {
				// 选中状态 如：扫码  积分
				var moDe = $('.bINput input:checked').attr('id');
				var wenZurl = 'http://www.ynresearch.net/choiceMode?aid=' + ID + '&&mode=' + moDe; //购买单篇文章
				// 购买文章
				$.ajax({
					type: "GET",
					url: wenZurl,
					headers: {
						"token": token
					},
					success: function(data) {
						var dh = data.data.order_num; //单号
						var urlll = "http://www.ynresearch.net/creaCode?orderNum=" + dh;
						// 判断是钱还是积分购买
						if (moDe == 1) { //微信扫码支付
							//支付方式
							layui.use('layer', function() {
								// 服务协议
								var layer = layui.layer;
								layer.open({
									type: 2,
									title: ['支付方式'],
									maxmin: true,
									shadeClose: true, //点击遮罩关闭层
									area: ['800px', '570px'],
									content: '/tips/wzZf.html',
									btn: ['确认', '取消'],
									success: function(layero, index) {
										$.ajax({
											type: "GET",
											url: urlll,
											headers: {
												"token": token
											},
											success: function(data) {
												console.log(data);
												var body = layer.getChildFrame('body', index);
												body.find('.jb img').attr("src", urlll);
												// 1.杂志 2单篇文章
												setTimeout(alertHello, 2000);
												var tt = setTimeout(alertHello, 2000);

												function alertHello() {
													$.ajax({
														type: "GET",
														url: "http://www.ynresearch.net/refreshorder?orderNum=" + dh,
														headers: {
															"token": token,
															"mode": 2
														},
														success: function(data) {
															console.log(data);
															//
															if (data.data == null) {
																//继续定时请求
																console.log("继续定时请求");
																setTimeout(alertHello, 2000);
																console.log("购买成功");
															} //
															//
															else {
																// 停止定时请求
																console.log("停止请求，付款成功")
																clearTimeout(tt);
																layer.closeAll('iframe'); //关闭所有的iframe层
																var charge_content = data.data.charge_content;
																console.log(charge_content);
																$(".Article").append(charge_content);
																layui.use('layer', function() {
																	layui.use('layer', function() {
																		layer.msg("购买成功", {
																			skin: 'demo-class',
																			time: 2000 //2秒关闭（如果不配置，默认是3秒）
																		}, function() {
																			// location.href = './index.html';
																		});
																	})
																})
																$('.ArtiCle_status').hide();
															}
														}
													})

												}
											}
										})
									}
								});
							});

						} else if (moDe == 2) {
							// 提示登陆成功
							var dd = data.msg
							layui.use('layer', function() {
								layui.use('layer', function() {
									layer.msg(dd, {
										skin: 'demo-class',
										time: 2000 //2秒关闭（如果不配置，默认是3秒）
									}, function() {
										// location.href = './index.html';
									});
								})
							})
						}

					},
					error: function(xhr, type, errorThrown) {
						console.log("chuq")
					}

				})
			})

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
					location.href = './gcwz.html?id=' + ID;
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
					location.href = './llwz.html?id=' + ID;
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
