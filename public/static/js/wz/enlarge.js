// console.log("2")
$(function() {
    /*
    smallimg   // 小图
    bigimg  //点击放大的图片
    mask   //黑色遮罩
    */
    var obj = new zoom('mask', 'bigimg', 'smallimg');
    obj.init();
})
$(".sectionc div[id=Article] img").each(function() {
    var src = $(this).attr("src");
    $(this).addClass("smallimg");
    $(this).attr("big", src);
    // console.log(src)

});
function zoom(mask, bigimg, smallimg) {
    this.bigimg = bigimg;
    this.smallimg = smallimg;
    this.mask = mask
}
zoom.prototype = {

    init: function() {
        var that = this;
        this.smallimgClick();
        this.maskClick();
        this.mouseWheel()
    },
    smallimgClick: function() {
        var that = this;

        $("." + that.smallimg).click(function() {
            console.log("." + that.smallimg)
            $(this).parent().addClass("G_sel").siblings().removeClass("G_sel") //涓轰簡鍖哄垎褰撳墠灏忓浘鐗囷紝涓哄叾鍔犱竴涓猚lass
            $("." + that.mask).fadeIn();
            $("." + that.bigimg).attr("src", $(this).attr("big")).fadeIn();
            console.log($("." + that.bigimg).html());
        })
    },
    maskClick: function() {
        var that = this;
        $("." + that.mask).click(function() {
            console.log(11);
            $("." + that.bigimg).fadeOut();
            $("." + that.mask).fadeOut()
        })
    },
    mouseWheel: function() {
        function mousewheel(obj, upfun, downfun) {
            if(document.attachEvent) {
                obj.attachEvent("onmousewheel", scrollFn)
            } else {
                if(document.addEventListener) {
                    obj.addEventListener("mousewheel", scrollFn, false);
                    obj.addEventListener("DOMMouseScroll", scrollFn, false)
                }
            }

            function scrollFn(e) {
                var ev = e || window.event;
                var dir = ev.wheelDelta || ev.detail;
                if(ev.preventDefault) {
                    ev.preventDefault()
                } else {
                    ev.returnValue = false
                }
                if(dir == -3 || dir == 120) {
                    upfun()
                } else {
                    downfun()
                }
            }
        }
        // 鏈湡
    }
};