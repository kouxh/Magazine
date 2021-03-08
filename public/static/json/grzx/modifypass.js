//修改密码
$(function () {
    $('#btn2').click(function () {
        if (!usedpwd() == false && !checkPwd() == false && !checkRepwd() == false) {
            var userName = $('#usedpwd').val().trim();
            var newpwd = $('#repwd').val().trim();
            // console.log(userName);
            // console.log(newpwd)
            $.ajax({
                type: "POST",
                url: '/upPasswordApi',
                data: {
                    usedpwd: userName,//旧密码
                    newpwd: newpwd,//新密码
                },
                success: function (data) {
                    if (data.data == 1) {
                        $('#register-conCenter2').hide();
                        $('#register-conCenter3').show();
                        $('.register-top span:eq(1)').removeClass();
                        $('.register-top span:eq(2)').addClass('jingdu');

                    } else {
                        $("#usedpwdId").html("旧密码错误，请输入正确的密码！");
                        $("#usedpwd").removeClass('ok_prompt');
                        $("#usedpwd").addClass('error_prompt');
                    }

                }

            })
        }
    })

//    旧密码
    function usedpwd() {
        console.log(123)
        var usedpwd = $("#usedpwd").val().trim();
        var regpwd = /^[0-9a-zA-Z]{4,18}$/;
        if (regpwd.test(usedpwd) == false) {
            $("#usedpwd").addClass("error_prompt").removeClass("ok_prompt");
            $("#usedpwdId").html("*密码由英文字母和数字组成的4-18位字符");
            return false;
        } else {
            $("#usedpwd").addClass("ok_prompt").removeClass("error_prompt");
            $("#usedpwdId").html("");
            return true;
        }
    }

    function checkPwd() {
        var pwd = $("#pwd").val().trim();
        var regpwd = /^[0-9a-zA-Z]{4,18}$/;
        if (regpwd.test(pwd) == false) {
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
        if (pwd == "") {
            $("#repwdId").html("*确认密码不能为空");
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
})
