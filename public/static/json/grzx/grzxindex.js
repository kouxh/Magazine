// 个人中心首页  会员中心
$(function() {
	function getCookie(name) {
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg)) return unescape(arr[2]);
		else return null;
	}
	var zym = 'http://test.chinamas.cn';
	var token = getCookie("token"); //
	console.log(token)
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/homePage",
		headers: {
			'token': token
		},
		success: function(data) {
			console.log(data.data);
			// 购物车数量
			$('.TitleSearch_right label span').html(data.data.cart);
			//个人信息 user

			
			//$('.member_one dl dt .user ').html(data.data.user.photo) //头像photo
			$('.member_one dl dd .user ').html(data.data.user.account); //用户名
			$('.member_two dl dd #ye ').html(data.data.user.balance); //余额
			$('.member_two dl dd #jf ').html(data.data.user.integral); //积分
			$('.member_two dl dd .tz ').html(data.data.notice.length)
			//提醒
			var remind = '';
			$.each(data.data.remind, function(k, v) {
				remind += '<li>' + v.message + '</li>';
			});
			$('.MembershipCenter_Tips .li-box  ul').html(remind);
			// 我的订单，
			// 所有订单
// 			$.each(data.data.order, function(k, v) {
// 				console.log(v)
// 				var html = '';
// 				html +=
// 					'<tr><tr><td><div class="orderTitle"><p>订单号 :</p><p>' + v.order_num + '</p><p>' + v.crea_at +
// 					'</p></div></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
// 
// 				$.each(v.order_desc, function(k, v) {
// 					// console.log(v)
// 					html +=
// 						'<tr><td><div class="orderlist"><dl><dt><img src=' + zym + '' + v.cover_img +
// 						' alt=""></dt><dd>' + v.title + '</dd></dl></div></td><td>' + v.num + '</td><td>' + v.price +
// 						'</td><td>' + v.address.consignee + '</td>';
// 				})
// 				html += '<td><label>¥<span>' + v.all_price +
// 						'</span></label><p>(含运费¥<span>10</span>)<br>在线支付</p></td><td>' + data.data.order.status +
// 					'</td><td><span class="span payment">立即支付</span><span class="span OrderDetails">订单详情</span><span class="span CancellationOrder">取消订单</span><span class="span Repurchase">再次购买</span></td></tr></tr>'
// 
// 				console.log(data.data.order.order_num);
// 				$('.Order #form1 table .clear').before(html);
// 
// 			});
			// 待支付
			// default2
			// 			$('.default2').click(function() {
			// 				$.ajax({
			// 					type: "GET",
			// 					url: "http://www.ynresearch.net/myOrder?status=1",
			// 					headers: {
			// 						'token': token
			// 					},
			// 					success: function(data) {
			// 						$.each(data.data, function(k, v) {
			// 							var html = '';
			// 							html +=
			// 								'<tr><tr><td><div class="orderTitle"><p>订单号 :</p><p>' + v.order_num + '</p><p>' + v.crea_at +
			// 								'</p></div></td></tr>';
			// 
			// 							$.each(v.order_desc, function(k, v) {
			// 								console.log(v)
			// 								html +=
			// 									'<tr><td><div class="orderlist"><dl><dt><img src='+zym+'' + v.cover_img +
			// 										' alt=""></dt><dd>'+v.title+'</dd></dl></div></td><td>'+v.num+'</td><td>'+v.price+'</td><td>'+v.address.consignee+'</td><td><label>¥<span>'+v.subtotal+'</span></label><p>(含运费¥<span>10</span>)<br>在线支付</p></td><td>待支付</td><td><span class="span payment">立即支付</span><span class="span OrderDetails">订单详情</span><span class="span CancellationOrder">取消订单</span><span class="span Repurchase">再次购买</span></td></tr></tr>'
			// 							})
			// 							console.log(data.data);
			// 							$('#form2 table .clear').before(html);
			// 
			// 						});
			// 					}
			// 				})
			// 			})

			//猜你喜欢
			var like = ""
			$.each(data.data.like, function(k, v) {
				var likeurl = './jswz.html?id='
				like +=
					'<li><a href=' + likeurl + '' + v.id + ' target="_blank">' + v.title + '</a></li>'
			});
			$('.mAinR ul').html(like);

		},
		error: function() {
			console.log("错误！！！")

		}
	});

});
