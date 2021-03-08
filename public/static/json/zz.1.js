var ID = window.location.search.substr(6);
var token = localStorage.getItem(token);
console.log(token)
$(function() {
	var url = 'http://www.ynresearch.net/magationdesc?id=' + ID + '';
	$.ajax({
		type: "GET",
		url: url,
		// dataType: "json",
		beforeSend: function(request) {
			request.setRequestHeader("TOKEN", token);
		},
		success: function(e) {
			console.log(e);
			console.log(e.data.magazine);
			// 标题信息
			var html = '<h1>' + e.data.magazine.title + '</h1><h2>' + e.data.magazine.subtitle + '</h2>';
			console.log(e.data.magazine.s_date.all_periods)
			html +=
				'<div class="details_guig"><p class="xz"><a class="Selection"><span class="lb">平装</span><br><span id="">¥50</span></a></p><p><span class="details_guigS">限时优惠：</span><span>x元 还剩x天x小时</span></p><div class="clear"></div></div><div class="details_Number"><p><span class="Subscribe">订阅数量：</span><label class="_Number"><span class="button  reduce">-</span><input type="text" value="1 " class="centent_number"><span class="button  plus">+</span></label><label class="stock">库存：<span>' +
				e.data.magazine.num +'</span>本<span class="kuc">库存不足！</span></label></p></div> <div class = "SubscribeMore" ><a class = "purchase immediately" > 立即订阅 </a> <a class = "purchase join" id="join"> 加入购物车 </a> <div class = "More"><span class = "Subscribe" > 更多订阅： </span> <b> 起订： 总第 <span class = "Start" >'+e.data.magazine.s_date.all_periods+'</span>期<span class="Start">'+e.data.magazine.s_date.year+'</span > 年第 <span class = "Start" >'+e.data.magazine.s_date.periods+'</span>期</b></div><p class="SubscribeMoreP"><input type="checkbox" id=' +e.data.magazine.half_year.id + '>半年/3期<span>¥' + e.data.magazine.half_year.money +'</span> <input type = "checkbox" id=' + e.data.magazine.one_year.id + '> 全年 / 共6期 <span> ¥' + e.data.magazine.one_year.money +'</span> </p><p><span class = "Subscribe"> 活动积分： </span> <span> <span class = "integral"> 3 </span>积分</span> </p> <p class = "Tips" >全国快递投递， 快递不到地区采用EMS配送。 包邮地区不含西藏， 新疆， 甘 肃， 青海， 宁夏， 内蒙古， 海南。 </p > </div >';
			$('.section_detailsL_xp ').html(html);
			// 选择期刊 
			$(".SubscribeMoreP input:checkbox").click(function() {
				//设置当前选中checkbox的状态为checked
				$(this).attr("checked", true);
				$(this).siblings().attr("checked", false); //设置当前选中的checkbox同级(兄弟级)其他checkbox状态为未选中
				var json = [];
				$('.SubscribeMoreP input:checked').each(function() {
					var xzid = $(this).attr('id'); //选中id
					// console.log(xzid)
					json.push(xzid)
					console.log(xzid)
				})

			});
			// console.log(json)
			// 选择版本
			$('.details_guig .xz a').click(function() {
				$(this).addClass("Selection").siblings().removeClass("Selection");
				var Selectioncen = $('.Selection').text();
				// console.log($('.Selection').text());
				var seleCen = $('.Selection .lb').text();
				// console.log(seleCen);
			})
			// console.log("seleCen"+);
			$(".plus").click(function() {
				var centent_number = $('.centent_number').val();
				var vb = parseInt(centent_number) + 1;
				console.log(e.data.magazine.num)
				if (vb > e.data.magazine.num) {
					vb = e.data.magazine.num
					$(".centent_number").val(vb);
					$('.details_Number .kuc').show();
					console.log("库存不足！")
				} else {
					$('.details_Number .kuc').hide();
					$(".centent_number").val(vb);
				}
				$(".centent_number").val(vb);
			})

			// 监听回车
			$(".centent_number").keypress(function() {
				var centent_number = $('.centent_number').val();
				if (centent_number > e.data.magazine.num) {
					$('.details_Number .kuc').show();
				} else if (centent_number <= 0) {
					$('.details_Number .kuc').hide();
					$('.centent_number').val(centent_number)
					console.log(centent_number)
					console.log("sdf")
				}
			});
			$(".reduce").click(function() {
				$('.details_Number .kuc').hide();
				var centent_number = $('.centent_number').val();
				var num = parseInt(centent_number) - 1;
				$(".centent_number").val(num);
				console.log(num);
				if (num < 1) {
					num = 1
					$(".centent_number").val(num);
				}
			})

			// 立即订阅
			$('.immediately').click(function() {
				console.log("立即订阅");
				
				
				
			})
			// 杂志出版内容
			srt = "";
			srt += '<div class="information"><ol><li>主管单位:<span>' + e.data.magazine.executive_director +
				'</span></li><li>主办单位:<span>' + e.data.magazine
				.host_company + '</span></li><li>出版地方:<span>' + e.data.magazine.publish + '</span></li><li>创刊时间:<span>' + e
				.data
				.magazine.publication_time + '</span></li><li>国内刊号：:<span>' + e.data
				.magazine.publication_number + '</span></li><li>出版周期:<span>' + e.data
				.magazine.publication_cycle + '</span></li><li>ISBN:<span>' + e.data
				.magazine.ISBN + '</span></li><li>页数:<span>' + e.data
				.magazine.number + '</span></li><li>开本:<span>' + e.data
				.magazine.open_book + '</span></li></ol></div><p class="briefIntroduction">' + e.data.magazine.message +
				'</p>';
			$('.div1 ').html(srt);
			// 相关杂志推荐
			var introduce = "";
			for (var i in e.data.r_magazine) {
				console.log(e.data.r_magazine[i])
				// html +='<h2>'+e.data.f_id[i].name+'</h2>'
				introduce += '<dl id="m_id' + e.data.r_magazine[i].m_id + '"><dt><img src="M-img/03.jpg" alt=""></dt><dd>' +
					e.data.r_magazine[i].title + '</dd></dl>'
			}
			$('.section_introduce .section_introduceLD ').html(introduce);
			$("#m_id" + e.data.r_magazine[i].m_id + "").click(function() {
				// console.log(k)
				location.href = '../杂志—v2/details.html?mmid=' + e.data.r_magazine[i].m_id + '';
			})
			// 加入购物车
			$('.join').click(function() {
				// 数量
				var num = $(".centent_number").val();
				//最后的数量
				var seleCen = $('.Selection .lb').text();
				if (seleCen == "平装") {
					seleCen = 2;
				}
				var json = [];
				$('.SubscribeMoreP input:checked').each(function() {
					var xzid = $(this).attr('id'); //选中id
					json.push(xzid)
				})
				var xuanZId = json.join(",");
				var token = localStorage.getItem(token)
				$.ajax({
					type: "POST",
					url: "http://www.ynresearch.net/addcart",
					data: {
						"mid": ID,
						"num": num,
						'type': seleCen,
						'periods': xuanZId
					},
					beforeSend: function(request) {
						request.setRequestHeader("TOKEN", token);
					},
					success: function(data) {
						var result = JSON.stringify(data);
						console.log(result);
						console.log(data)
						if (data.bol == true) {
							console.log(data.bol);
							location.href = '../杂志—v2/cart.html';
						}
					},
					error: function() {
						console.log("错误！！！")

					}
				})
			})
		},
		error: function() {
			console.log("错误！！！")

		}
	});
});
// function joinCart(id) {
// 	// 数量
// 	var num = $(".centent_number").val();
// 	//最后的数量
// 	var seleCen = $('.Selection .lb').text();
// 	if (seleCen == "平装") {
// 		seleCen = 2;
// 	}
// 	
// 	var xzid = $('.SubscribeMore .SubscribeMoreP input:checkbox').attr('id'); //选中id
// 	console.log(xzid)
// 	// console.log(seleCen)
// 	var token = localStorage.getItem(token)
// 	console.log(token)
// 	$.ajax({
// 		type: "POST",
// 		url: "http://www.ynresearch.net/addcart",
// 		data: {
// 			"mid": ID,
// 			"num": num,
// 			'type': seleCen,
// 			'periods': 1
// 		},
// 		beforeSend: function(request) {
// 			console.log(request);
// 			request.setRequestHeader("TOKEN", token);
// 		},
// 		// dataType: "json",
// 		success: function(data) {
// 			var result = JSON.stringify(data);
// 			console.log(result);
// 			console.log(data)
// 			// if (data.bol == true) {
// 			// 	console.log(data.bol);
// 			// 	location.href = '../杂志—v2/cart.html';
// 			// }
// 
// 
// 		},
// 		error: function() {
// 			console.log("错误！！！")
// 
// 		}
// 	})
// 
// 
// }

// 返回当前页面
// 排除注册页面
