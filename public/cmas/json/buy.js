// 购买页面
var ID = window.location.search.substr(6);
var zym = 'http://www.chinamas.cn';
function getCookie(name) {
	var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
	if (arr = document.cookie.match(reg)) return unescape(arr[2]);
	else return null;
}
// setCookie("token",token);
var token = getCookie("token")
$(function() {
	var url = 'http://www.ynresearch.net/magationdesc?id=' + ID + '';
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function(request) {
			request.setRequestHeader("TOKEN", token);
		},
		success: function(e) {
			console.log(e.data)
			$('title').html('' + e.data.magazine.name + '' + e.data.magazine.year + '' + e.data.magazine.title + '-管理会计研究'); //title
			// 标题信息
			var html = '<h1>' + e.data.magazine.name + '' + e.data.magazine.year + '' + e.data.magazine.title + '</h1><h2>' +
				e.data.magazine.subtitle + '</h2>';
			html +=
				'<div class="details_guig"><p class="xz"><a class="Selection"><span class="lb">平装</span><br><span id="">¥50</span></a></p><p  class="xsyh" id="xsyh"><span class="details_guigS">限时优惠：</span><span>x元 还剩x天x小时</span></p><div class="clear"></div></div><div class="details_Number"><p><span class="Subscribe">订阅数量：</span><label class="_Number"><button class="button  reduce">-</button><input type="text" value="1 " class="centent_number"><button class="button  plus">+</button></label><label class="stock">库存：<span>' +
				e.data.magazine.num +
				'</span>本<span class="kuc">库存不足！</span></label></p></div> <div class = "SubscribeMore" ><button class = "purchase immediately" > 立即订阅 </button> <button class = "purchase join" id="join"> 加入购物车 </button> <div class = "More"><span class = "Subscribe" > 更多订阅： </span> <b> 起订  总第 <span class = "Start" >' +
				e.data.magazine.s_date.all_periods + '</span>期<span class="Start">' + e.data.magazine.s_date.year +
				'</span > 年第 <span class = "Start" >' + e.data.magazine.s_date.periods +
				'</span>期</b></div><p class="SubscribeMoreP"><input type="checkbox" id=' + e.data.magazine.half_year.id +
				'>半年/3期<span>¥' + e.data.magazine.half_year.money + '</span> <input type = "checkbox" id=' + e.data.magazine.one_year
				.id + '> 全年 / 共6期 <span> ¥' + e.data.magazine.one_year.money +
				'</span> </p><p class = "SubscribeP"><span class = "Subscribe"> 活动积分： </span> <span> <span class = "integral"> 3 </span>积分</span> </p> <p class = "Tips" >全国快递投递， 快递不到地区采用邮局挂号配送。 包邮地区不含西藏， 新疆， 甘肃， 青海， 宁夏， 内蒙古， 海南。（邮发代码：80-841） </p > </div >';
			$('.section_detailsL_xp ').html(html);
			if (e.data.magazine.num == 0) {
				$('.purchase').attr("disabled", true);
				$('.button').attr("disabled", true);
				$('.purchase').css({
					"background": "#eaeaea",
					"color": "#000"
				})
				$("#join").css({
					"border": "none"
				})
			}
			//轮播
			var tp_img = '';
			tp_img += '<div class="swiper-slide slide_one"><img src="' + zym + '' + e.data.magazine.cover_img +
				'"alt=""></div><div class="swiper-slide slide_one"><img src="' + zym + '' + e.data.magazine.other_img +
				'"alt=""></div><div class="swiper-slide slide_one"><img src="' + zym + '' + e.data.magazine.side_img +
				'"alt=""></div>'
			$('#swiper-wrapper_one').html(tp_img);
			var tp_img2 = '';
			tp_img2 += '<div class="swiper-slide"><img src="' + zym + '' + e.data.magazine.cover_img +
				'"alt=""></div><div class="swiper-slide"><img src="' + zym + '' + e.data.magazine.other_img +
				'"alt=""></div><div class="swiper-slide"><img src="' + zym + '' + e.data.magazine.side_img + '"alt=""></div>'
			$('#swiper-wrapper2').html(tp_img2);
			// console.log(json)
			// 选择版本
			$('.details_guig .xz a').click(function() {
				$(this).addClass("Selection").siblings().removeClass("Selection");
				var Selectioncen = $('.Selection').text();
				var seleCen = $('.Selection .lb').text();
			})
			if (e.fold == null) {
				$('#xsyh').hide();
			}
			// 
			// 选择期刊 半年 或者全年 
			$(".SubscribeMoreP input:checkbox").click(function() {
				//设置当前选中checkbox的状态为checked
				$(this).attr("checked", true);
				$(this).siblings().attr("checked", false); //设置当前选中的checkbox同级(兄弟级)其他checkbox状态为未选中
				var json = [];
				$('.SubscribeMoreP input:checked').each(function() {
					var xzid = $(this).attr('id'); //选中id
					// console.log(xzid)
					json.push(xzid)
				})

			});
			$(".plus").click(function() { //购物车+
				var centent_number = $('.centent_number').val();
				var vb = parseInt(centent_number) + 1;
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
			$(".reduce").click(function() { //购物车-
				$('.details_Number .kuc').hide();
				var centent_number = $('.centent_number').val();
				var num = parseInt(centent_number) - 1;
				$(".centent_number").val(num);
				if (num < 1) {
					num = 1
					$(".centent_number").val(num);
				}
			})
			// 监听回车
			$(".centent_number").keypress(function() {
				var centent_number = $('.centent_number').val();
				if (centent_number > e.data.magazine.num) {
					$('.details_Number .kuc').show();
				} else if (centent_number <= 0) {
					$('.details_Number .kuc').hide();
					$('.centent_number').val(centent_number)
				}
			});
			// 立即订阅
			$('.immediately').click(function() {
				// 判断是否登陆
				if (token == null) {
					layui.use('layer', function() {
						layui.use('layer', function() {
							layer.msg('登陆后可购买', {
								skin: 'demo-class',
								time: 2000 //2秒关闭（如果不配置，默认是3秒）
							}, function() {
								location.href = '/login.html';

							});
						})
					})
				} else {
					if (ID == 15) {
						location.href = 'https://k.weidian.com/Ab4Iu0GT';
					} else if (ID == 14) {
						location.href = 'https://k.weidian.com/TzBCa3qa ';

					} else {
						alert("补货中！！！！")
					}
					// 					var m_id = e.data.magazine.m_id; //mid
					// 					var p_id = $('.SubscribeMoreP input:checked').attr('id'); //选中pid
					// 					var num = $(".centent_number").val(); // 数量
					// 					var seleCen = $('.Selection .lb').text(); //最后的数量 type 类型 2为平装
					// 					if (seleCen == "平装") {
					// 						seleCen = 2;
					// 					}
					// 					var json = [];
					// 					var flag = $('.SubscribeMoreP input:checked').prop("checked"); //是否选中3期或者6期
					// 					if (flag == true) {
					// 						console.log("true选中")
					// 						var obj = {
					// 							"pid": parseFloat(p_id), //
					// 							"num": parseFloat(num),
					// 							"type": seleCen,
					// 							"dvfq": 1,
					// 
					// 						}
					// 						json.push(obj)
					// 						var obj = {
					// 							"mid": parseFloat(m_id), //
					// 							"num": parseFloat(num),
					// 							"type": seleCen,
					// 							"dvfq": 1,
					// 						}
					// 					} else { //没有选中 mid
					// 						console.log("没有选中")
					// 						var obj = {
					// 							"mid": parseFloat(m_id), //
					// 							"num": parseFloat(num),
					// 							"type": seleCen,
					// 							"dvfq": 1,
					// 						}
					// 					}
					// 					json.push(obj)
					// 					console.log(token)
					// 					$.ajax({
					// 						type: "POST",
					// 						url: 'http://www.ynresearch.net/careorder',
					// 						headers: {
					// 							"TOKEN": token
					// 						},
					// 						data: {
					// 							json: JSON.stringify(json)
					// 						},
					// 						success: function(data) {
					// 							console.log(data);
					// 							location.href = './order.html';
					// 						},
					// 						error: function() {
					// 							console.log("错的");
					// 						}
					// 					})
				}
			})

			// 杂志出版内容
			srt = "";
			srt += '<div class="information"><ol><li>主管单位：<span>' + e.data.magazine.executive_director +
				'</span></li><li>主办单位：<span>' + e.data.magazine
				.host_company + '</span></li><li>出版单位：<span>' + e.data.magazine.publish + '</span></li><li>创刊时间：<span>' + e
				.data
				.magazine.publication_time + '</span></li><li>国内刊号：<span>' + e.data
				.magazine.publication_number + '</span></li><li>出版周期：<span>' + e.data
				.magazine.publication_cycle + '</span></li><li>ISBN：<span>' + e.data
				.magazine.ISBN + '</span></li><li>页数：<span>' + e.data
				.magazine.number + '</span></li><li>开本：<span>' + e.data
				.magazine.open_book + '</span></li></ol></div><p class="briefIntroduction">' + e.data.magazine.text +
				'</p>';
			$('.div1 ').html(srt);
			// 相关杂志推荐
			var introduce = "";
			$.each(e.data.r_magazine, function(k, v) {
				console.log(e.data.r_magazine[k])
				// html +='<h2>'+e.data.f_id[i].name+'</h2>'
				introduce += '<a href="/buy.html?mmid=' + e.data.r_magazine[k].m_id + '"><dl id="m_id' + e.data.r_magazine[k]
					.m_id + '"><dt><img src="' + zym + '' + e.data.r_magazine[
						k]
					.cover_img + '" alt=""></dt><dd>' + e.data.r_magazine[k].year + '' +
					e.data.r_magazine[k].title + '</dd></dl></a>'
			})
			$('.section_introduce .section_introduceLD  .clear').before(introduce);
			// $("#m_id" + e.data.r_magazine[i].m_id + "").click(function() {
			// 	// console.log(k)
			// 	location.href = ;
			// })
			// 加入购物车
			$('.join').click(function() {
				if (token == null) {
					layui.use('layer', function() {
						layui.use('layer', function() {
							layer.msg('登陆后可购买', {
								skin: 'demo-class',
								time: 2000 //2秒关闭（如果不配置，默认是3秒）
							}, function() {
								location.href = '/login.html';

							});
						})
					})
				} else {
					// 数量
					if (ID == 15) {
						location.href = 'https://k.weidian.com/Ab4Iu0GT';
					} else if (ID == 14) {
						location.href = 'https://k.weidian.com/TzBCa3qa ';

					} else {
						alert("补货中！！！！")
					}
					// 					var num = $(".centent_number").val();
					// 					//最后的数量
					// 					var seleCen = $('.Selection .lb').text();
					// 					if (seleCen == "平装") {
					// 						seleCen = 2;
					// 					}
					// 					var json = [];
					// 					$('.SubscribeMoreP input:checked').each(function() {
					// 						var xzid = $(this).attr('id'); //选中id
					// 						json.push(xzid)
					// 					})
					// 					var xuanZId = json.join(",");
					// 
					// 					$.ajax({
					// 						type: "POST",
					// 						url: "http://www.ynresearch.net/addcart",
					// 						data: {
					// 							"mid": ID,
					// 							"num": num,
					// 							'type': seleCen,
					// 							'periods': xuanZId
					// 						},
					// 						headers: {
					// 							"TOKEN": token
					// 						},
					// 						success: function(data) {
					// 							var result = JSON.stringify(data);
					// 							console.log(result);
					// 							console.log(data)
					// 							if (data.bol == true) {
					// 								console.log(data.bol);
					// 								location.href = './cart.html';
					// 							}
					// 						},
					// 						error: function() {
					// 							console.log("错误！！！")
					// 
					// 						}
					// 					})
				}
			})

		},
		error: function() {
			console.log("错误！！！")

		}
	});
});
