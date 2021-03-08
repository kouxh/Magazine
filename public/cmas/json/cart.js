$(function() {
	function getCookie(name) {
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg)) return unescape(arr[2]);
		else return null;
	}
	var zym = 'http://www.chinamas.cn';
	var token = getCookie("token");
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/cartlist",
		headers: {
			"TOKEN": token
		},
		success: function(data) {
			var dd = data.data.normal;
			html = "";
			for (var i in data.data.normal) {
				if (data.data.normal[i].type == 1) {
					data.data.normal[i].type = "电子版"
				} else if (data.data.normal[i].type == 2) {
					data.data.normal[i].type = "平装"
				}
				html += '<tr  pid=' + data.data.normal[i].p_id + ' mid=' + data.data.normal[i].m_id +
					' id="' + data.data.normal[
						i].id + '" class="active tr' + data.data.normal[
						i].id +
					' "><td class="check" id="id' + data.data.normal[i].id +
					'"><label><input type="checkbox"  /></label></td></th><td class="sp"><dl><dt><img src="' + zym + '' + data.data
					.normal[i].cover_img +
					'" alt=""></dt><dd><h3>' +
					data.data.normal[i].title + '</h3><button class="type">' + data.data.normal[i].type +
					'</button></dd></dl></td><td  class="price">' +
					data.data.normal[i].flat +
					'</td><td><p class="_Number"><span class="button  sub">-</span><input type="text" class="num centent_number" value="' +
					data.data.normal[i].num +
					'" class="centent_number"><span  class="button  add">+</span></td><td clsss="subtotal" id="subtotal">' + data
					.data.normal[i].notes + '</p></td><td  class="del"><span  >删除</span><span>收藏</span></td></tr>';
			}
			$('table .clear').before(html);
			// 全选
			$("#checkAll input").click(function() {
				var flag = $(this).prop("checked");
				if (flag) {
					$(".check label input").prop("checked", true);

				} else {
					$(".check label input").prop("checked", false);
				}
				counts();
				totalPrice();
			});
			//单选
			$(".check input").click(function() {
				var flag = $(this).prop("checked"); //获取当前input的状态
				var CL = $(".check input").length; //列表长度；
				var CH = $(".check input:checked").length; //列表中被选中的长度
				// var i = 0;
				//多选但是删除其中一条
				$('.check input:checked').each(function() {
					$(".del span").click(function() {
						var id = $(this).parents().parents('tr.active').attr('id');
						console.log(id);
						$(this).parents("tr").remove();
						$.ajax({
							type: "GET",
							url: 'http://www.ynresearch.net/delcart',
							beforeSend: function(request) {
								request.setRequestHeader("TOKEN", token);
							},
							data: {
								id: id
							},
							success: function(data) {
								console.log(data);
							},
							error: function() {
								console.log("错了");
							}
						})
					})

				})
				counts();
				totalPrice();
			})
			// 选中
			//点击立即结算
			$('.Settlement').click(function() {
				var json = [];
				$('.check input:checked').each(function() {
					var sum = parseInt($(this).parents("tr").find('.num').val()); //数量
					var type = $(this).parents().parents("tr").find('.type').text() //类型 
					var id = $(this).parents().parents('tr.active').attr('id');
					var m_id = $(this).parents().parents('tr.active').attr('mid');
					var p_id = $(this).parents().parents('tr.active').attr('pid');
					if (type == "平装") {
						type = 2
					} else {
						console.log("电子")
					}
					if (m_id == "null") { //选中pid
						console.log("p_id")
						var obj = {
							"pid": parseFloat(p_id), //
							"id": parseFloat(id),
							"num": sum,
							"type": type,
							"dvfq": 1,
						}

					} else {
						var obj = {
							"mid": parseFloat(m_id),
							"id": parseFloat(id),
							"num": sum,
							"type": type,
							"dvfq": 1,
						}
					}
					json.push(obj)
				})
				$.ajax({
					type: "POST",
					url: 'http://www.ynresearch.net/careorder',
					headers: {
						"TOKEN":token
					},
					data: {
						json: JSON.stringify(json)
					},
					success: function(data) {
						console.log("第三方的")
						location.href = '/order.html';
					},
					error: function() {
						console.log("错的");
					}
				})
			})
			//数目加
			$(".add").click(function() {
				var num = $(this).prev().val();
				var price = parseFloat($(this).parent().parent().siblings(".price").text());
				num++;
				$(this).prev().val(num);
				//      小计
				$(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2));
				// $(this).parent().parent().siblings("#subtotal").text((price * num).toFixed(2));
				counts();
				totalPrice();
			})

			//数目减
			$(".sub").click(function() {
				var num = $(this).next().val();
				var price = parseFloat($(this).parent().siblings(".price").text());
				num--;

				if (num <= 0) {
					num = 0
				}
				$(this).next().val(num);
				//      小计
				$(this).parent().siblings("#subtotal").text((price * num).toFixed(2));
				counts();
				totalPrice();
			})
			//文本框脱里焦点处理
			$('.num').each(function(i) {
				$(this).blur(function() {
					let p = parseFloat($(this).parents('tr').find("#subtotal").text());
					let c = parseFloat(this.value);
					console.log(p * c);
					$(this).parents('tr').find("#subtotal").text((c * p).toFixed(2));
					counts();
					totalPrice();
				})
			})
			//单行删除
			$(".del span").click(function() {
				var flag = $(this).parent().siblings().find("input").prop("checked");
				console.log(flag);
				if (flag == false) {
					console.log("直接删除")
					var id = $(this).parents().parents('tr.active').attr('id');
					$(this).parents("tr").remove();
					$.ajax({
						type: "GET",
						url: 'http://www.ynresearch.net/delcart',
						beforeSend: function(request) {
							request.setRequestHeader("TOKEN", token);
						},
						data: {
							id: id
						},
						success: function(data) {
							console.log(data);
						},
						error: function() {
							console.log("错我");
						}
					})
				}
				// $(this).parents("tr").remove();
				// $(this).parents.delete("id")
				var CL = $(".check input").length; //列表长度；
				counts();
				totalPrice();

			})

			// 清空购物车
			$('.qkgwc').click(function() {
				console.log("清空购物车")
				var movePos = [];
				$('.check input:checked').each(function() {
					var id = $(this).parents().parents('tr.active').attr('id');
					movePos.push(id);
					var arr = movePos.join(",");
					$(this).parents("tr").remove();
					$.ajax({
						type: "GET",
						url: 'http://www.ynresearch.net/delcart',
						beforeSend: function(request) {
							request.setRequestHeader("TOKEN", token);
						},
						data: {
							id: arr
						},
						success: function(data) {
							console.log(data);
						},
						error: function() {
							console.log("错我");
						}
					})
				})
			})
			// 总价格
			totalPrice()

			function totalPrice() {
				var prices = 0;
				$('.check input:checked').each(function(i) {
					prices += parseFloat($(this).parents("tr").find('#subtotal').text());
				})
				$('#total').text(prices);
			}
			//总数目
			counts();

			function counts() {
				var sum = 0;
				$('.check input:checked').each(function(i) {
					sum += parseInt($(this).length);
					var num = parseInt($(this).parents("tr").find('.num').val());
					var id = $(this).parents().parents('tr.active').attr('id');
					$('#numAll').text(sum);
				})
			}
			// ------------------------失效产品
			src = "<ul>";
			// console.log(data.data.no_normal.length)
			for (var i in data.data.no_normal) {
				console.log(data.data.no_normal[i]);
				src += "<li id=" + data.data.no_normal[i].id +
					"><dl><dt><span>已失效</span><img src='M-img/02.jpg' ></dt><dd><h3>" + data.data.no_normal[i].title +
					"</h3><p>该商品已不能购买,有问题请咨询客服</p></dd></dl><div class='operation'><span  class='sc'>删除</span><span>客服</span></div></li>"
			}
			src += "</ul>"
			$('.Invalid ul').html(src);
			$('.Invalid  p  span i').text()
			//失效删除
			// $("#"+data.data.no_normal[i].id + " .operation  .sc").click(function(){
			// 	var scid=data.data.no_normal[i].id
			// 	$(this).parents("li").remove();
			// 	$.ajax({
			// 		type: "GET",
			// 		url: 'http://www.ynresearch.net/delcart',
			// 		beforeSend: function(request) {
			// 			request.setRequestHeader("TOKEN", token);
			// 		},
			// 		data: {
			// 			id: scid
			// 		},
			// 		success: function(data) {
			// 			console.log(data);
			// 		},
			// 		error: function() {
			// 			console.log("错我");
			// 		}
			// 	})
			// })


		},
		error: function() {
			console.log("cuowu")
		}
	});



})
