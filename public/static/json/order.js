// 核实订单
$(function() {
	function getCookie(name) {
		var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
		if (arr = document.cookie.match(reg)) return unescape(arr[2]);
		else return null;
	}
	// setCookie("token",token);
	var token = getCookie("token");
	console.log(token)
	$.ajax({
		type: "GET",
		url: "http://www.ynresearch.net/orderlist",
		headers: {
			"TOKEN": token
		},
		success: function(data) {
			console.log(data)
			html = "";
			for (var i in data.data) {
				var dh = data.data[i].order_num; //单号
				var all_price = data.data[i].all_price; //总价格
				var all_num = data.data[i].all_num; //总件数
				for (var k in data.data[i].order_desc) {
					console.log(data.data[i].order_desc[k].subtotal)
					html +=
						'<tr>><td class="Hd"><dl><dt><img src="M-img/03.jpg" alt=""></dt><dd><h3>' + data.data[i].order_desc[k].title +
						'</h3><p class="type">平装</p><p class="qdate">起订：总第01期 2018年第一期</p></dd></dl></td><td>' + data.data[i].order_desc[
							k].price +
						'</td><td><p>' + data.data[i].order_desc[k].num + '</p></td><td>' + data.data[i].order_desc[k].delivery_frequency +
						'</td><td align="center">'+data.data[i].order_desc[k].subtotal +'</td></tr>'
				}

			}
			$('.table  .clear').before(html);
			$('.Settlement_DR .total').text(all_price);
			$('.Settlement_DR .jians').text(all_num)
			console.log(dh)
			$('.Settlement').click(function() {
				console.log("Settlement");
				location.href = './orderstatus.html?' + dh + '';
			})
		}
	})
})
