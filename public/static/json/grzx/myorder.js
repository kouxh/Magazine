$('.default2').click(function() {
	 console.log("ddd")
				$.ajax({
					type: "GET",
					url: "http://www.ynresearch.net/myOrder?status=1",
					headers: {
						'token': token
					},
					success: function(data) {
						$.each(data.data, function(k, v) {
							var html = '';
							html +=
								'<tr><tr><td><div class="orderTitle"><p>订单号 :</p><p>' + v.order_num + '</p><p>' + v.crea_at +
								'</p></div></td></tr>';

							$.each(v.order_desc, function(k, v) {
								console.log(v)
								html +=
									'<tr><td><div class="orderlist"><dl><dt><img src='+zym+'' + v.cover_img +
										' alt=""></dt><dd>'+v.title+'</dd></dl></div></td><td>'+v.num+'</td><td>'+v.price+'</td><td>'+v.address.consignee+'</td><td><label>¥<span>'+v.subtotal+'</span></label><p>(含运费¥<span>10</span>)<br>在线支付</p></td><td>待支付</td><td><span class="span payment">立即支付</span><span class="span OrderDetails">订单详情</span><span class="span CancellationOrder">取消订单</span><span class="span Repurchase">再次购买</span></td></tr></tr>'
							})
							console.log(data.data);
							$('#form2 table .clear').before(html);

						});
					}
				})
			})