function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod"
    ];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}
var flag = IsPC(); //true为PC端，false为手机端
if (flag == true) {

}
if (flag == false) {
    document.write('<script src="/static/picJs/yd_index.js" type="text/javascript" charset="utf-8"></script>');
    // $(".mo_dropmenu .mo_dropmenu_title").click(function() {
    //     $(this).toggleClass("current").siblings('.mo_dropmenu_title').removeClass("current"); //切换图标
    //     //$(this).next("mo_dropmenu_drop").show();
    //     $(this).next(".mo_dropmenu_drop").slideToggle(500).siblings(".mo_dropmenu_drop").slideUp(500);
    // });
}
