$(function () {
    var url = "register"
    var user = $('.user').val();
    var password = $('#password').val();
    var code = $('#code').val();
    var sj = $('#sj').val();
});
// 获取 验证码
var clock = '';
var nums = 60;
var btn;
var isSlide = false;

//发送验证码
function sendCode(thisBtn) {
    var userName = $('#userName').val(); //用户名
    var repwd = $('#repwd').val(); //确认密码
    var code = $('#code').val();
    var tel = $('#tel').val();
    var phoneurl = 'code?phone=' + tel + '';
    var flag = true;
    if (!checkUser() == false && !checkPwd() == false && !checkRepwd() == false && checkTel() == true) {
        if (isSlide) {
            btn = thisBtn;
            btn.disabled = true; //将按钮置为不可点击
            btn.value = nums + '秒可后重新获取';
            clock = setInterval(doLoop, 1000); //一秒执行一次
            $.ajax({
                url: phoneurl,
                type: "get",
                headers: {
                    'mode': 2
                },
                success: function (res) {
                    console.log(res)
                    // btn.value = '获取动态码';
                    // if (res.code == "9999") {
                        $('#telId').html(res.msg)
                        $("#zc").attr("disabled", true)
                        clearInterval(clock); //清除js定时器
                        $("#tel").addClass("error_prompt").removeClass("ok_prompt");
                    // } else {
                    //     console.log("不读取时间")
                    // }
                }
            })
        } else {
            layui.use('layer', function () {
                layer.msg('请按住滑块，拖动到最右边', {
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function () {
                });
            })
        }
    }
    return flag;
}

$(function () {
    var SlideVerifyPlug = window.slideVerifyPlug;
    var slideVerify2 = new SlideVerifyPlug('#verify-wrap2', {
        wrapWidth: '330', //设置 容器的宽度 ，默认为 350 ，也可不用设，你自己css 定义好也可以，插件里面会取一次这个 容器的宽度
        initText: '请按住滑块，拖动到最右边', //设置  初始的 显示文字
        sucessText: '验证通过', //设置 验证通过 显示的文字
        getSucessState: function (res) {
            //当验证完成的时候 会 返回 res 值 true，只留了这个应该够用了
            isSlide = true;
        }
    });

})

function doLoop() {
    nums--;
    if (nums > 0) {
        btn.value = nums + '秒后可重新获取';
    } else {
        clearInterval(clock); //清除js定时器
        btn.disabled = false;
        btn.value = '获取动态码';
        nums = 60; //重置时间
    }
}

$('#zc').click(function (data) {
    var userName = $('#userName').val(); //用户名
    var pwd = $('#pwd').val(); //确认密码
    var repwd = $('#repwd').val(); //确认密码
    var code = $('#code').val();
    var tel = $('#tel').val();
    var flag = true;
    if (!checkUser()) flag = false; //用户名
    if (!checkPwd()) flag = false; //密码
    if (!checkRepwd()) flag = false; //确认密码
    if (!checkTel()) flag = false;//手机号
    if (!checkCode()) flag = false;//验证码
    if (!checkUser() == false && !checkPwd() == false && !checkRepwd() == false && !checkTel() == false && !checkCode() == false) {
        var arr = [];
        layer.open({
            type: 2,
            title: ['设置你的兴趣，以下内容的更新会出现在这里'],
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area: ['800px', '450px'],
            content: 'interest',
            btn: ['下一步', '取消'],
            success: function (layero, index) {
                var body = layer.getChildFrame('body', index);
                // console.log(body.html())
                // console.log();
                $.ajax({
                    type: "GET",
                    url: 'loadKeyword',
                    beforeSend: function (request) {
                    },
                    success: function (e) {
                        // console.log(e)
                        $.each(e.data, function (k, v) {
                            var h = '';
                            h +=
                                '<li class=""   id=' + v.id + '><label for="setting-interest-' + v.id +
                                '"><input type="checkbox" name="editor_2" value="19" id="setting-interest-19">' +
                                v.title + '</label></li>';
                            body.find('.Interest .item .clear').before(h)

                        })

                        body.find(".Interest .item li").click(function () {
                            if (!$(this).hasClass("on")) {
                                $(this).addClass("on");
                                var kid = parseFloat(body.find($(this)).attr("id"));
                                arr.push(kid);
                            } else {
                                $(this).removeClass('on');
                                var kid = parseFloat(body.find($(this)).attr("id"));
                                // var local = $.inArray(kid, json); //根据元素值查找下标，不存在返回-1
                                var cc = arr.splice($.inArray(kid, arr), 1)
                            }
                        });

                    }
                })
            },
            yes: function (index, layero) {
                var kid = '';
                for (i = 0; i < arr.length; i++) {
                    kid += arr[i] + ',';
                }
                if (kid !== '') {
                    $.ajax({
                        type: "POST",
                        url: 'register',
                        data: {
                            account: userName,
                            pwd: repwd,
                            code: code,
                            phone: tel,
                            kid: kid,
                        },
                        success: function (e) {
                            // console.log(e)
                            if (e.bol == true) {
                                layui.use('layer', function () {
                                    layui.use('layer', function () {
                                        layer.msg('注册成功', {
                                            // skin: 'demo-class',
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            location.href = 'loadLogin';

                                        });
                                    })
                                })
                            } else if (e.bol == false) {
                                // console.log(e)
                                $('#codeId').html(e.msg);
                                layui.use('layer', function () {
                                    layui.use('layer', function () {
                                        layer.msg(e.msg, {
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            layer.close(index)
                                            // location.href = 'loadLogin';

                                        });
                                    })
                                })
                            } else {
                                // console.log(e)
                                $('#codeId').html(e.msg);
                                layui.use('layer', function () {
                                    layui.use('layer', function () {
                                        layer.msg(e.msg, {
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            layer.close(index)
                                            // location.href = 'loadLogin';

                                        });
                                    })
                                })
                            }
                        },
                        error: function () {
                            console.log("错误！！")

                        },
                    });
                } else {
                    //console.log
                    console.log("不可注册")
                }
            },
        });
    }
    return flag;
});


//失去焦点时，开始验证
$("#userName").blur(checkUser); //用户名
$("#pwd").blur(checkPwd); //验证密码
$("#repwd").blur(checkRepwd); //确认密码
$("#tel").blur(checkTel); //手机号验证
$("#code").blur(checkCode); //手机号验证
//验证用户名
function checkUser() {
    var user = $("#userName").val().trim();
    var regnick = /^([\u4e000-\u9fa5]|\w|[@!#$%*])+$/;
    var len = user.replace("/[\u4e000-\u9fa5]/g", "xx").length; //计算字符串长度，一个汉字表示2个字符
    // if (regnick.test(user) == false) {
    // 	$("#nickNameId").html("*请输入用户名称");
    // 	$("#userName").addClass("error_prompt").removeClass("ok_prompt");
    // } else if (len < 4 || len > 18) {
    // 	$("#nickNameId").html("*用户名长度为4-18个字符");
    // 	$("#userName").addClass("error_prompt").removeClass("ok_prompt");
    // } else if(cc.test(user) ==false){
    // 	console.log(cc.test)
    // 	$("#nickNameId").html("*用户名长度为4-18个字符000000");
    // }else {
    // 	$("#nickNameId").html("");
    // 	$("#userName").addClass("ok_prompt").removeClass("error_prompt");
    // 	return true;
    //
    // }
    var cc = '';
    if (user == "") {
        $("#nickNameId").html("*请输入用户名");
        $("#userName").addClass("error_prompt").removeClass("ok_prompt");

        return false;
    } else if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(user)) {
        $("#nickNameId").html("*用户名不能有特殊字符");
        $("#userName").addClass("error_prompt").removeClass("ok_prompt");

        return false;
    } else if (/(^\_)|(\__)|(\_+$)/.test(user)) {
        $("#nickNameId").html("*用户名首尾不能出现下划线\'_\'");
        $("#userName").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    } else if (!/^[a-zA-Z0-9_]{0,}$/.test(user)) {
        $("#nickNameId").html("*用户名不能输入中文或者空格");
        $("#userName").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    } else if (len < 4 || len > 12) {
        $("#nickNameId").html("*用户名长度为4-12个字符");
        $("#userName").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    } else {
        $("#nickNameId").html("");
        $("#userName").addClass("ok_prompt").removeClass("error_prompt");
        return true;
    }

}

//验证密码
function checkPwd() {
    var pwd = $("#pwd").val().trim();
    var regpwd = /^[0-9a-zA-Z]{4,18}$/;
    if (pwd == "") {
        $("#pwdId").html("*请输入密码");
        $("#pwd").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    } else if (regpwd.test(pwd) == false) {
        $("#pwd").addClass("error_prompt").removeClass("ok_prompt");
        $("#pwdId").html("*密码由英文字母和数字组成的4-18位字符");
        return false;
    } else {
        $("#pwd").addClass("ok_prompt").removeClass("error_prompt");
        $("#pwdId").html("");
        return true;
    }
}

//确认密码
function checkRepwd() {
    var pwd = $("#pwd").val().trim();
    var repwd = $("#repwd").val().trim();
    if (repwd == "") {
        $("#repwdId").html("*请输入确认密码");
        $("#repwd").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    }
    if (repwd != pwd) {
        $("#repwd").addClass("error_prompt").removeClass("ok_prompt");
        $("#repwdId").html("*两次密码输入不一致");
        return false;
    } else {
        $("#repwdId").html("");
        $("#repwd").addClass("ok_prompt").removeClass("error_prompt");
        return true;
    }
}

//验证手机号
function checkTel() {
    var tel = $("#tel").val().trim();
    var regtel = /^(13|15|18)[0-9]{9}$/;
    if (tel == "") {
        $("#telId").html("*请输入手机号");
        $("#tel").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    }
    if (regtel.test(tel) == false) {
        $("#telId").html("*请输入正确的手机");
        $("#repwd").addClass("error_prompt").removeClass("ok_prompt");
        return false;
    } else {
        $("#tel").addClass("ok_prompt").removeClass("error_prompt");
        $("#telId").html("");
        return true;
    }
}

//验证动态码
function checkCode() {
    var code = $("#code").val().trim();
    if (code == "") {
        $("#code").addClass("error_prompt").removeClass("ok_prompt");
        $("#codeId").html("*请输入验证码");
        return false;
    } else if (/^\d{6}$/.test(code) == false) {
        $("#code").addClass("error_prompt").removeClass("ok_prompt");
        $("#codeId").html("*请输入正确的验证码");
        return false;
    } else {
        $("#codeId").html("");
        $("#code").addClass("ok_prompt").removeClass("error_prompt");
        return true;
    }
}
