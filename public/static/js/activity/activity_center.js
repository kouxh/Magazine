
//




function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}
var flag = IsPC(); //true涓篜C绔紝false涓烘墜鏈虹
if(flag==true){
    //手机
    var num = 0;
    var timer = null;
    var timeout = null;
    var full=$('.pic .lnr1 a').outerWidth(true);
    console.log(full);
    var width=$('.sectionL_1 .pic .lnr1 .two').width();
// var number=$('.sectionL_1 .pic .lnr1 .two').length;
    var number=$('.sectionL_1 .pic .lnr1 .two').length-4;
    console.log(number)
// $('.sectionL_1 .pic .inner').css({"width":"1200px"})
// 设置鼠标悬浮在按钮切换事件
    $(".pic ul li a").mouseenter(function(event) {

        //设置定时器前应先判断有没有定时器，有就清除
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        num = $(this).parent().index();

        //设置悬浮时500毫秒时切换，不足500毫秒时不会切换
        timeout = setTimeout(changgeMg, 500);

        return false;
    })
//悬浮在窗口时停止轮播
    $(".pic").mouseenter(function() {
        //清除定时器
        clearInterval(timer);
    })
//	//点击next切换
    var lengths=$('.pic .lnr1 a').length-1;

    $(".next").click(function() {
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        if(num < number) {
            num++;
        } else {
            num = 0;
            // alert("不能点")

        }
        //设置点击后500毫秒去切换，如果点击间隔小于500毫秒不停点击则不会切换
        timeout = setTimeout(changgeMg, 500);
        //不让a元素去默认跳转
        return false;
    })
//点击prev切换
    $(".prev").click(function() {
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        if(num > 0) {
            num--;
        } else {
            num = 1;
        }
        //设置点击后500毫秒去切换，如果点击间隔小于500毫秒不停点击则不会切换
        timeout = setTimeout(changgeMg, 500);
        return false;
    })
//轮播定时器

//移动盒子和给当前索引上色
    function changgeMg() {
//		var aa=330;
        console.log(full)
        var movePx = num * -full + "px";
//		console.log(movePx);
//		console.log(movePx);
        $(".inner").animate({
            "marginLeft": movePx
        }, 500);
        $(".pic ul li").eq(num).find("a").addClass("active").parent().siblings().find("a").removeClass("active");
    }

}if(flag==false){
    //手机端
    var num = 0;
    var aLi = document.querySelectorAll(".pic .inner .two");
    var inner = document.querySelector('.pic .inner');
    var pic = document.querySelector(' .pic');
    var aLiWidth = pic.offsetWidth;
    pic.style.height = aLi[0].offsetHeight + 'px';
// 设置盒子的宽度
    inner.style.width = aLi.length * 100 + '%';
    for (var i = 0; i < aLi.length; i++) {
        aLi[i].style.width = 1 / aLi.length * 100 + '%';
    };
    var timer = null;
    var timeout = null;
    var full = $('.pic .lnr1 .two').outerWidth(true);

//	//点击next切换
    var lengths = $('.pic .lnr1 a').length - 1;
    console.log(lengths)
    $(".next").click(function() {
        if (timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        if (num < lengths) {
            num++;
        } else {
            num = 0;
        }
        //设置点击后500毫秒去切换，如果点击间隔小于500毫秒不停点击则不会切换
        timeout = setTimeout(changgeMg, 500);
        //不让a元素去默认跳转
        return false;
    })
//点击prev切换
    $(".prev").click(function() {
        if (timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        if (num > 0) {
            num--;
        } else {
            num = lengths;
        }
        //设置点击后500毫秒去切换，如果点击间隔小于500毫秒不停点击则不会切换
        timeout = setTimeout(changgeMg, 500);
        return false;
    })
//轮播定时器

//移动盒子和给当前索引上色
    function changgeMg() {
        //		var aa=330;
        var movePx = num * -full + "px";
        //		console.log(movePx);
        //		console.log(movePx);
        $(".inner").animate({
            "marginLeft": movePx
        }, 1500);
        $(".pic ul li").eq(num).find("a").addClass("active").parent().siblings().find("a").removeClass("active");
    }

}
