// window.onload = function() {
// 	var oTop = document.getElementById("header_pc");
// 	var screenw = document.documentElement.clientWidth || document.body.clientWidth;
// 	var screenh = document.documentElement.clientHeight || document.body.clientHeight;
// 	window.onscroll = function() {
// 		var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
// 		var navH = $("#header_pc .header_pcB").offset().top;
// 		console.log(navH + "navH")
// 		console.log(scrolltop + "scrolltop");
// 		if (scrolltop > navH) {
// 			$("#header_pc .header_pcT ").css({
// 				"display": "none"
// 			});
// 			$("#header_pc .header_pcB ").css({
// 				"position": "fixed",
// 				"top": "0",
// 				"z-index": "99999",
// 				"width":"1150px"
// 			});
//
// 		}
//
// 		else if(scrolltop=4) {
// 			$("#header_pc .header_pcT ").css({
// 				"display": "block"
// 			});
// 			$("#header_pc .header_pcB ").css({
// 				"position": "inherit",
// 				"z-index": "99999",
// 				"top": "auto",
// 			});
// 		}
// 	}
//
// }
function skip(id) {
    const target = document.querySelector(id);
    var anchor = $("#section .Essential_information_title").outerHeight();
    var header_pc = $(".header_pc").outerHeight();
    document.documentElement.scrollTop = target.offsetTop - anchor - header_pc;
    console.log(target.offsetTop)
    console.log(id)
    console.log(document.documentElement.scrollTop)
};
// $(window).scroll(function () {
//     //获取滚动条的滑动距离
//
//     var scroH = $(window).scrollTop();
//     var introduce = $("#introduce").outerHeight();
//     //滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定
//     if (scroH > introduce) {
//         $("#section .Essential_information_main").css({
//             "position": "fixed",
//             "top": "30px",
//             "left": "50%",
//             "transform": "translate(-50%, 50%)",
// 			"box-shadow": "0px 5px 11px 0px rgba(95, 101, 105, 0.12)"
//         });
//     } else if (scroH < introduce) {
//         console.log()
//         $("#section .Essential_information_main").css({
//             "top": "0px",
//             "position": "inherit",
// 			"left": "0",
// 			"transform": "none",
// 			"box-shadow": "none"
// 		});
//     }
//
// })


// ;
// (function($) {
//     $.fn.navfix = function(mtop, zindex) {
//         var nav = $(this),
//             mtop = mtop,
//             zindex = zindex,
//             dftop = nav.offset().top - $(window).scrollTop(),
//             dfleft = nav.offset().left - $(window).scrollLeft(),
//             dfcss = new Array;
//         dfcss[0] = nav.css("position"), dfcss[1] = nav.css("top"), dfcss[2] = nav.css("left"), dfcss[3] = nav.css("zindex"),
//             $(window).scroll(function(e) {
//                 $(this).scrollTop() > dftop ? $.browser.msie && $.browser.version == "6.0" ? nav.css({
//                     position: "absolute",
//                     top: eval(document.documentElement.scrollTop),
//                     left: dfleft,
//                     "z-index": zindex
//                 }) : nav.css({
//                     position: "fixed",
//                     top: mtop + "px",
//                     left: dfleft,
//                     "z-index": zindex
//                 }) : nav.css({
//                     position: dfcss[0],
//                     top: dfcss[1],
//                     left: dfcss[2],
//                     "z-index": dfcss[3]
//                 })
//             })
//     }
// })(jQuery)
