var addressList_id="";//默认地址id
$(function () {
    var example = window.location.pathname;
    console.log(example);
    var urlArr = document.referrer.split('/');
    var urlTZ=urlArr[3];
    console.log(urlTZ)

    //新建地址列表
    $.ajax({
        type: "GET",
        url: '/listAddressApi',
        success: function (data) {
            console.log(data.data)
            var html = ''
            $.each(data.data, function (k, v) {
                html += '<li class="addressList" id="' + v.id + '">\n' +
                    '                                <div class="addressleft">\n' +
                    '                                    <!-- 收货用户名 -->\n' +
                    '                                    <p class="User-name">' + v.consignee + '</p>\n' +
                    '                                    <!-- 地址详情 -->\n' +
                    '                                    <p class="address-details"><span>' + v.city + '</span><span>' + v.area + '</span><span>' + v.county + '</span><span>' + v.desc_address + '</span></p>\n' +
                    '                                    <!-- 收货手机号 -->\n' +
                    '                                    <p class="phone">' + v.tell + '</p>\n';
                if (v.status == 1) {
                    console.log("moren")
                    html += '<span class="default_address">默认地址</span>';
                    $(this).html();
                }
                ;
                html += '                                </div>\n' +
                    '                                <div class="addressright">\n' +
                    '                                    <!-- 删除 -->\n' +
                    '                                    <p class="delete" style="display:' + ((data.data.length == 1) ? 'none' : 'block') + '" onclick="Delete(this)">X</p>\n' +
                    '                                    <!-- 设置默认地址 -->\n' +
                    '                                    <p class="tel default" onclick="Default(this)" >设为默认</p>\n' +
                    '                                    <!-- 编辑地址 -->\n' +
                    '                                    <p class="tel edit" id="111" style="cursor: pointer;" onclick="editAddress(this)">编辑地址</p>\n' +
                    '                                </div>\n' +
                    '                            </li>'
            })
            $('#address .clear').before(html);
            addressList_id=$('.default_address').parent().parent().attr("id");
            console.log(addressList_id)
            $('#'+addressList_id).find('.default').hide();

        }

    })
    //新建地址
    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;
        // 新建收货地址
        form.verify({
            title: function (value) {
                if(value==""||value==null){
                    return '收货人姓名不能为空';
                }
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '收货人不能有特殊字符';
                }
                if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '收货人首尾不能出现下划线\'_\'';
                }
                if (/^\d+\d+\d$/.test(value)) {
                    return '收货人不能全为数字';
                }
                if (value.length > 25) {
                    return '收货人姓名不能大于25位';
                }
            },
            desc_address: function (value) {
                if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                    return '\n' +
                        '收货人详细地址中含有非法字符';
                }
                if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                    return '收货人详细地址首尾不能出现下划线\'_\'';
                }
                if (/^\d+\d+\d$/.test(value)) {
                    return '收货人详细地址不能全为数字';
                }
                if (value.length > 25) {
                    return '收货人详细地址不能大于25位';
                }
                if (value.length > 25) {
                    return '收货人详细地址不能大于25位';
                }

            }
        });
        var layer = layui.layer;
        $('#XjdzR').on('click', function () {
            $("#New_address")[0].reset();
            layui.form.render();
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.layer.close(index);  // 关闭layer
            if ($('#address li').length >= 10) {
                alert("最多可新建10个收货地址")
            } else {
                layer.open({
                    type: 1,
                    title: ['新建地址', 'background: #000;text-align: center; color:#fff'],
                    maxmin: true,
                    skin: 'demo-class',
                    shadeClose: true, //点击遮罩关闭层
                    area: ['800px', '570px'],
                    content: $('#New_address'),
                    btn: ['保存', '取消'],
                    btns : 2,
                    success: function (layero, index) {
                        layero.addClass('layui-form');//添加form标识
                        layero.find('.layui-layer-btn0').attr('lay-filter', 'demo1').attr('lay-submit', '');//将按钮弄成能提交的
                    },
                    yes: function (index, layero) {
                        form.on('submit(demo1)', function (data) {
                            var ID = $('#address li').length + 1;
                            var body = layer.getChildFrame('body', index);
                            var Consignee = $('#New_address').find('#name').val();
                            var cmbProvince = $('#New_address').find('#sjld .layui-input-inline:eq(0) .layui-select-title input').val(); //省份
                            var cmbCity = $('#New_address').find('#sjld .layui-input-inline:eq(1) .layui-select-title input').val(); //县
                            var cmbArea = $('#New_address').find('#sjld .layui-input-inline:eq(2) .layui-select-title input').val(); //区/县
                            var desc_address = $('#New_address').find('#desc_address').val(); //详细地址
                            var fixed_number = $('#New_address').find('#fixed_number').val()//固定电话
                            var zip_code = $('#New_address').find('#zip_code').val()//固定电话
                            var tell = $('#New_address').find('#tell').val(); //手机号
                            $.ajax({
                                type: "POST",
                                url: '/AddressApi',
                                data: {
                                    consignee: Consignee, //收货人
                                    city: cmbProvince, //城市
                                    area: cmbCity, //地区
                                    county: cmbArea, //县
                                    desc_address: desc_address, //详细地址
                                    fixed_number: fixed_number,
                                    zip_code: zip_code, //邮政编码
                                    tell: tell, //手机号
                                },
                                success: function (data) {
                                    console.log(data);
                                    if (data.bol == true) {
                                        layer.close(index);
                                            layui.use('layer', function () {
                                                layer.msg('新建成功', {
                                                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                                }, function () {
                                                    var example = window.location.pathname;
                                                    console.log(urlTZ)
                                                    if(urlTZ=="orderpay"){
                                                        location.href = ''+document.referrer+'';
                                                    }
                                                    $("#New_address").css("display","none");
                                                });
                                            })
                                        var list =
                                            '<li class="addressList" id=' + ID + '><div class="addressleft"><p class="User-name">' + Consignee +
                                            '</p><p class="address-details"><span>' + cmbProvince + '</span><span>' + cmbCity + '</span><span>' + cmbArea +
                                            '</span><span>' + desc_address + '</span></p><p class="phone">' + tell +
                                            '</p></div><div class="addressright"><p class="delete">X</p><p class="tel default" onclick="Default(this)">设为默认</p><p class="tel edit" onclick="editAddress(this)">编辑地址</p></div></li>'
                                        $('#address ').prepend(list);
                                    }
                                },
                                error: function () {
                                    console.log("错我");
                                }
                            })

                        });
                    },
                    cancel: function(index, layero){
                        $("#New_address").css("display","none");
                    },
                     end: function () {
                        $("#New_address").css("display","none");
                    }
                })

            }

        });
    });

})

//删除
function Delete(e) {
    var ID = $(e).parent().parent().attr("id");
    $.ajax({
        type: "GET",
        url: '/delAddressApi?id=' + ID + '',
        success: function (data) {
            console.log(data)
            if (data.bol == true) {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('删除成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            // location.href = '/';
                        });
                    })
                })
                $('#' + ID).remove();
            }


        }
    })

}

function renderForm() {
    layui.use('form', function () {
        var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
        form.render();
    });
}

//编辑地址
function editAddress(num) {
    var addressList_id = $(num).parent().parent().attr("id"); //编辑地址ID
    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;
        // 编辑地址
        var layer = layui.layer;
        layer.open({
            type: 1,
            title: ['编辑地址', 'background: #000;text-align: center; color:#fff'],
            maxmin: true,
            skin: 'demo-class',
            shadeClose: true, //点击遮罩关闭层
            area: ['800px', '570px'],
            content: $('#New_address'),
            btn: ['保存', '取消'],
            success: function (layero, index) {
                layero.addClass('layui-form');//添加form标识
                layero.find('.layui-layer-btn0').attr('lay-filter', 'demo1').attr('lay-submit', '');//将按钮弄成能提交的
                //赋值
                var addressList_id = $(num).parent().parent().attr("id"); //编辑地址ID
                var Consignee = $('#' + addressList_id + ' .addressleft .User-name').text(); //收货人
                var city = $('#' + addressList_id + ' .addressleft .address-details span:eq(0)').text(); //市
                console.log(city,'99999')
                var area = $('#' + addressList_id + ' .addressleft .address-details span:eq(1)').text(); //省
                var county = $('#' + addressList_id + ' .addressleft .address-details span:eq(2)').text(); //区/县
                var desc_address = $('#' + addressList_id + ' .addressleft .address-details span:eq(3)').text(); //详细地址
                var phone = $('#' + addressList_id + ' .addressleft .phone').text()
                $('#New_address').find('#desc_address').val(desc_address); //区
                $('#New_address').find('#name').val(Consignee);
                $('#New_address').find('#sjld .layui-input-inline:eq(1) .layui-form-select .layui-select-title input').val(area); //省份
                $('#New_address').find('#sjld .layui-input-inline:eq(2) .layui-form-select .layui-select-title input').val(county); //省份
                // $('#New_address').find('#sjld .custom-layerb_R .layui-input-inline:eq(0) .layui-select-title input').val(city); //省份
                $('#New_address').find('#tell').val(phone); //手机号
            },
            yes: function (index, layero) {
                form.on('submit(demo1)', function (data) {
                //收货人
                // console.log(Consignee+cmbProvince+cityid+desc_address+tell)
                var addressList_id = $(num).parent().parent().attr("id"); //编辑地址ID
                var Consignee = $('#New_address').find('#name').val();
                var cmbProvince = $('#New_address').find('#sjld .layui-input-inline:eq(0) .layui-select-title input').val(); //省份
                var cmbCity = $('#New_address').find('#sjld .layui-input-inline:eq(1) .layui-select-title input').val(); //县
                var cmbArea = $('#New_address').find('#sjld .layui-input-inline:eq(2) .layui-select-title input').val(); //区/县
                var desc_address = $('#New_address').find('#desc_address').val(); //详细地址
                var fixed_number = $('#New_address').find('#fixed_number').val()//固定电话
                var zip_code = $('#New_address').find('#zip_code').val()//固定电话
                var tell = $('#New_address').find('#tell').val(); //手机号
                $.ajax({
                    type: "POST",
                    url: '/editAddressApi',
                    data: {
                        id: addressList_id,
                        consignee: Consignee, //收货人
                        city: cmbProvince, //城市
                        area: cmbCity, //地区
                        county: cmbArea, //县
                        desc_address: desc_address, //详细地址
                        fixed_number: fixed_number,
                        zip_code: zip_code, //邮政编码
                        tell: tell, //手机号
                    },
                    success: function (data) {
                        if (data.bol == true) {
                            if (data.bol == true) {
                                layui.use('layer', function () {
                                    layui.use('layer', function () {
                                        layer.msg('编辑成功', {
                                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            $("#New_address").css("display","none");
                                        });
                                    })
                                })
                            }
                            $('#' + addressList_id + ' .addressleft .User-name').text(Consignee) //收货人修改
                            $('#' + addressList_id + ' .addressleft .phone').text(tell); //手机号
                            $('#' + addressList_id + ' .address-details span:eq(0)').text(cmbProvince) //
                            $('#' + addressList_id + ' .address-details span:eq(1)').text(cmbCity) //
                            $('#' + addressList_id + ' .address-details span:eq(2)').text(cmbArea) //
                            $('#' + addressList_id + ' .address-details span:eq(3)').text(desc_address) //详细地址
                        }

                        // location.href = './order.html';
                    },
                    
                    error: function () {
                        console.log("错我");
                    }
                })
                $("#New_address")[0].reset();
                layui.form.render();
                //按钮【按钮一】的回调
                layer.close(index); //如果设定了yes回调，需进行手工关闭
            })
            },
            cancel: function(index, layero){
                $("#New_address").css("display","none");
            },
            end: function () {
                $("#New_address").css("display","none");
            }
        })

    });
}
//存默认地址ID
function setCookie(name, value) {
    // var Days = 1;
    var exp = new Date();
    exp.setTime(exp.getTime() + 120 * 60 * 1000);
    // console.log(exp.getTime() + 20 * 60 * 1000);
    // exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();

}
setCookie("dz",addressList_id);
//设置默认地址
//在线客服
function Default(Default) {
    console.log(Default)
    var addressList_id = $(Default).parent().parent().attr("id"); //默认地址id
    console.log(addressList_id)
    var url = '/setAddressApi?id=' + addressList_id + '';
    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            if (data.bol == true) {
                layui.use('layer', function () {
                    layui.use('layer', function () {
                        layer.msg('设置成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                        });
                    })
                })
                $('#' + addressList_id + ' .addressleft ').append('<span class="default_address">默认地址</span>');
                // Default
                $(Default).hide();
                $('#' + addressList_id).siblings().find('.addressleft  .default_address').remove();
                $('#' + addressList_id).siblings().find('.addressright .default').show();
            }
            setCookie("dz",addressList_id);
        },
        error: function () {
            console.log("出错了");
        }
    })
}




