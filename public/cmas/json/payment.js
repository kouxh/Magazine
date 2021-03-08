// 支付方式
var dh = window.location.search.substr(1);
var token = localStorage.getItem(token)
console.log(dh);
console.log(token)
var url = 'http://www.ynresearch.net/creaCode?orderNum=' + dh + '';
$.ajax({
	type: "GET",
	url: url,
	beforeSend: function(request) {
		request.setRequestHeader("TOKEN", token);
	},
	success: function(data) {
		console.log(data)
		$("#test img").attr("src", url);
	}
})
//同步
setTimeout(tongbu, 2000);
var tt = setTimeout(tongbu, 2000);

function tongbu() {
	$.ajax({
		url: "http://www.ynresearch.net/refreshorder?orderNum=" + dh,
		headers: {
			"token": token,
			"mode": 1
		},
		cache: false,
		async: false,
		type: "GET",
		success: function(result) {
			console.log(result);
			if (result.data)
				setTimeout(tongbu, 2000);
		}
	});

};
