// 是手机端还是移动断
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
    // 图片放大
    document.write('<script type="text/javascript" src="/static/js/wz/enlarge.js"></script>');
    //图片放大拖动
    document.write('<script type="text/javascript" src="/static/js/wz/SpryMap.js"></script>');

    // document.write('<script src="/js/wz/drag.js" type="text/javascript" charset="utf-8"></script>');Œ


}
if (flag == false) {
};
