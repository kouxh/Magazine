$(function () {
    var example = window.location.pathname;
    var urlArr = document.referrer.split('/');
    var urlTZ = urlArr[3];
    // ;orderpay
    var man_filepath = '';
    var li = $('#tabs');
    var fp = $('#fp_zz');
    var cc = $('#tabs option');
    var len = cc.length;
    var t = 0;
    var fp_type = '1';//发票类型
    var fp_zz = "1";//发票纸质
    //存发票id
    var invoice = [];
    var obj = {}

    function setcookie(name, value, daysToLive) {
        var cookie = name + '=' + decodeURI(value);
        // decodeURI
        if (typeof daysToLive == 'number') {
            cookie += ';max-age=' + (daysToLive * 60 * 60 * 24);
        }
        document.cookie = cookie;
    }

    li.change(function () {//选择类型
        $(this).attr("id")
        $("#tabs option:selected").text();
        fp_type = $("#tabs option:selected").val()
        t = parseInt(li.get(0).selectedIndex);
        for (var i = 0; i < len; i++) {
            if (t == 0) {
                // console.log(i)
                $('#chanpin1').show();
                $('#chanpin' + i).hide();
                $('#chanpin3').hide();

            } else if (t == 1) {
                // console.log( $(cc).html())
                $('#chanpin2').show();
                $('#chanpin1').hide();
                $('#chanpin3').hide();
            } else if (t == 2) {
                $('#chanpin3').show();
                $('#chanpin' + i).hide();
            }
        }

    });
    fp.change(function () {//选择纸质
        fp_zz = $("#fp_zz option:selected").attr("id");
    });
    layui.use(['form', 'layedit', 'laydate'], function (data) {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        //监听提交
        form.verify({
            man_work: function (value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '工作单位地址不能有特殊字符';
                } else if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '工作单位地址首尾不能出现下划线\'_\'';
                } else if (/^\d+\d+\d$/.test(value)) {
                    return '工作单位地址不能全为数字';
                } else if (value.lenth > 25) {
                    return '工作单位地址不能大于25位';
                }

            },
            Unit_name: function (value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '注册地址不能有特殊字符';
                } else if (/[^\u4E00-\u9FA5]/g.test(value)) {
                    return '只能输入中文';
                } else if (/^\d+\d+\d$/.test(value)) {
                    return '注册地址不能全为数字';
                } else if (value.length > 25) {
                    return '不能大于25位';
                }
            },
            sbm: function (value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '不能有特殊字符';
                } else if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '首尾不能出现下划线\'_\'';
                } else if (!/^[a-zA-Z0-9_]{0,}$/.test(value)) {
                    return '不能输入中文';
                } else if (value.length < 18) {
                    return '不能小于18位';
                }

            },

            tellphone: function (value) {
                var mobile = /^1[3|4|5|7|8]\d{9}$/, phone = /^0\d{2,3}-?\d{7,8}$/;
                var flag = mobile.test(value) || phone.test(value);
                if (!/^\d{3,4}\-\d{7,8}$/.test(value)) {
                    return '请输入正确座机号码如：404-6802995';
                }
            },


            yh: function (value) {//开户行
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '不能有特殊字符';
                } else if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '首尾不能出现下划线\'_\'';
                } else if (!/[^u4e00-u9fa5]/.test(value)) {
                    return '只能输入中文';
                } else if (value.indexOf("银行") == -1) {
                    return '必须包含银行';
                } else if (value.length < 4) {
                    return '不能小于4位';
                }
            },

            zh: function (value) {//开户行
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '不能有特殊字符';
                } else if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '首尾不能出现下划线\'_\'';
                } else if (value.length < 16) {
                    return '不能小于16位';
                }
            },
        });
        form.on('submit(demo1)', function () {
            var in_tell = $('#phone').val();//电话
            var in_email = $('#in_email').val();//邮箱
            var in_company_name = $('#in_company_name ').val();//in_company_name 单位名称
            var in_taxpayer_code = $('#in_taxpayer_code').val(),//纳税人识别码
                in_register_address = $('#in_register_address').val(),//注册地址
                in_register_tell = $('#in_register_tell').val(),//注册电话
                in_deposit_bank = $('#in_deposit_bank').val(),//开户银行
                in_bank_account = $('#in_bank_account').val()
//个人发票
            console.log(fp_zz);
            var json = {
                "in_type": fp_type,//(必选参数 发票类型1个人发票2普通发票3专用发票)
                "in_paper": fp_zz,//（必选参数 1纸质2电子)
                "in_tell": in_tell,//可选参数	 电话）
                "in_email": in_email,//联系方式（可选参数	 邮箱）
                // "in_company_name": in_company_name, //	 单位名称）
                // "in_taxpayer_code": in_taxpayer_code,// 工作单位
                // "in_register_address": in_register_address,//注册地址
                // "in_register_tell": in_register_tell,//可选参数	 注册电话）
                // "in_deposit_bank":in_deposit_bank,//
                // "in_bank_account":in_bank_account//可选参数	 银行账户）
            };
            $.ajax({
                type: "POST",
                url: "/AddInvoiceApi",
                data: {
                    json: JSON.stringify(json)
                },
                success: function (data) {
                    // console.log(data);
                    // invoice=data.data.id
                    obj = {
                        id: data.data.id,
                        type:1,//个人发票
                        tell: in_tell,
                        email: in_email
                    }
                    invoice.push(obj);
                    var invoice_data = JSON.stringify(invoice);
                    console.log(invoice)
                    setcookie('invoice', invoice_data)
                    if (data.bol == true) {
                        layer.msg('提交成功');
                    }
                    if(urlTZ=="orderpay"){
                        location.href = ''+document.referrer+'';
                    }
                },
                error: function () {
                    console.log("错误！！！")

                }
            });
            return false;

        });
        //表单初始赋值
        form.on('submit(demo2)', function () {
            var in_company_name = $('#in_company_name ').val();//in_company_name 单位名称
            var in_taxpayer_code = $('#in_taxpayer_code').val();//纳税人识别码
            var in_email = $('#in_email2').val()
            var json = {
                "in_type": fp_type,//(必选参数 发票类型1个人发票2普通发票3专用发票)
                "in_paper": fp_zz,//（必选参数 1纸质2电子)
                "in_company_name": in_company_name, //	 单位名称）
                "in_taxpayer_code": in_taxpayer_code,// 纳税人识别码
                "in_email": in_email,//联系方式（可选参数	 邮箱）
                // "in_register_address": in_register_address,//注册地址
                // "in_register_tell": in_register_tell,//可选参数	 注册电话）
                // "in_deposit_bank":in_deposit_bank,//
                // "in_bank_account":in_bank_account//可选参数	 银行账户）
            };
            // console.log(json)
            $.ajax({
                type: "POST",
                url: "/AddInvoiceApi",
                data: {
                    json: JSON.stringify(json)
                },
                success: function (data) {
                    console.log(data)
                    obj = {
                        id: data.data.id,
                        type:2,//个人发票
                        in_company_name: in_company_name,//单位名称
                        in_taxpayer_code: in_taxpayer_code,//纳税人识别码
                    }
                    invoice.push(obj);
                    var invoice_data = JSON.stringify(invoice);
                    setcookie('invoice', invoice_data)
                    if (data.bol == true) {
                        layer.msg('提交成功');
                    }
                    if (urlTZ == "orderpay") {
                        location.href = '' + document.referrer + '';
                    }
                },
                error: function () {
                    console.log("错误！！！")

                }
            });
            return false;

        })
        form.on('submit(demo3)', function () {
            var in_company_name = $('#in_company_name2').val(),//in_company_name 单位名称
                in_taxpayer_code = $('#in_taxpayer_code2').val(),//纳税人识别码
                in_register_address = $('#in_register_address').val(),//注册地址
                in_register_tell = $('#in_register_tell').val(),//注册电话
                in_deposit_bank = $('#in_deposit_bank').val();//开户银行
            var in_bank_account = $('#in_bank_account').val();//银行账户
            var json = {//个人发票
                "in_type": fp_type,//(必选参数 发票类型1个人发票2普通发票3专用发票)
                "in_paper": fp_zz,//（必选参数 1纸质2电子)
                "in_company_name": in_company_name, //	 单位名称）
                "in_taxpayer_code": in_taxpayer_code,//纳税人识别码
                "in_register_address": in_register_address,//注册地址
                "in_register_tell": in_register_tell,//可选参数	 注册电话）
                "in_deposit_bank": in_deposit_bank,//开户银行
                "in_bank_account": in_bank_account//可选参数	 银行账户）
            };
            console.log(json)
            $.ajax({
                type: "POST",
                url: "/AddInvoiceApi",
                data: {
                    json: JSON.stringify(json)
                },
                success: function (data) {
                    console.log(json)
                    obj = {
                        id: data.data.id,
                        type:2,//个人发票
                        in_company_name: in_company_name,//单位名称
                        in_taxpayer_code: in_taxpayer_code,//纳税人识别码
                    }
                    invoice.push(obj);
                    var invoice_data = JSON.stringify(invoice);
                    setcookie('invoice', invoice_data)
                    if (data.bol == true) {
                        layer.msg('提交成功');
                    }
                    if (urlTZ == "orderpay") {
                        location.href = '' + document.referrer + '';
                    }
                },
                error: function () {
                    console.log("错误！！！")

                }
            });
            return false;

        });
    });


})