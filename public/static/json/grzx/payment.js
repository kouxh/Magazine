// 支付方式
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) return unescape(arr[2]);
    else return null;
}

//删除cookies
function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

var typeId = getCookie('typeId')
var orderNum = getCookie("Odd_Numbers");
console.log(orderNum, typeId)
var rel = '';
$.ajax({
    type: "GET",
    // url: '/creaCode?orderNum='+dh+'&addressID='+addressIDs+'&remarksMsg='+remarksMsgs+'',
    url: '/GenerateCodeApi',
    data: {
        orderNum: orderNum
    },
    success: function (data) {
        // console.log(data)
        if (data.code == 9999) {
            layui.use('layer', function () {
                layui.use('layer', function () {
                    layer.msg(data.msg, {
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                    });
                })
            })
        }


    }
})
//同步png 请求是否支付  没有问题请求成功
rel = setInterval(function () {
    tongbu();
}, 3000);
function tongbu() {
    $.ajax({
        url: "/refreshorder?orderNum=" + orderNum,
        type: "GET",
        success: function (res) {
            console.log(res, 'res')
            if (!res.bol) {

            } else {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg("付款成功", {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            clearInterval(rel);
                            if (typeId == 2) {
                                console.log(typeId)
                                delCookie("typeId");
                                location.href = '/myarticle';
                            } else {
                                location.href = '/order';
                            }


                        });
                    })
                })
            }


        },
        // complete: (XMLHttpRequest, status) => {
        //     if (status == 'timeout') {
        //         tongbu();
        //     }
        // }

    });

};
// function getCookie(name) {
//     var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
//     if (arr = document.cookie.match(reg)) return unescape(arr[2]);
//     else return null;
// }
var orderNum = getCookie("Odd_Numbers");
// axios.get('/GenerateCodeApi?orderNum='+orderNum+'', {
axios.get('/GenerateCodeApi?orderNum=' + orderNum + '', {
    responseType: "arraybuffer",

}).then(res => {
    return 'data:image/png;base64,' + btoa(
        new Uint8Array(res.data)
            .reduce((data, byte) => data + String.fromCharCode(byte), '')
    );
})
    .then(data => {
        // console.log(data);
        $("#test img").attr("src", data);
    })
    .catch(ex => {
        console.error(ex);
    });