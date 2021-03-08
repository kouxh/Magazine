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
                return '收货人姓名不  能大于25位';
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
    $('#Edit_address, #Edit_address1').on('click', function () {
        console.log('----------------------------------')
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);  // 关闭layer
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
                    var body = layer.getChildFrame('body', index);
                    // Consignee = body.find('#name').val();
                    //给编辑地址赋值
                    //收货赋值
                    var shr=$('#address span:eq(0)').html();//收货人
                    $('#New_address').find('#name').val(shr);
                    //详细地址赋值
                    var desc_address=$('#address span:eq(4)').html();//详细地址
                    $('#New_address').find('#desc_address').val(desc_address); //区
                    //手机号
                    var tell=$('#address span:eq(5)').html();//详细地址
                    $('#New_address').find('#tell').val(tell); //区
                },
                yes: function (index, layero) {
                    form.on('submit(demo1)', function (data) {
                        var id=$('#address').attr('class');
                        var body = layer.getChildFrame('body', index);
                        var Consignee = $('#New_address').find('#name').val();
                        var cmbProvince = $('#New_address').find('#sjld .layui-input-inline:eq(0) .layui-select-title input').val(); //省份
                        var cmbCity = $('#New_address').find('#sjld .layui-input-inline:eq(1) .layui-select-title input').val(); //县
                        var cmbArea = $('#New_address').find('#sjld .layui-input-inline:eq(2) .layui-select-title input').val(); //区/县
                        var desc_address = $('#New_address').find('#desc_address').val(); //详细地址
                        var fixed_number = $('#New_address').find('#fixed_number').val()//固定电话
                        var zip_code = $('#New_address').find('#zip_code').val()//固定电话
                        var tell = $('#New_address').find('#tell').val(); //手机号
                        console.log(Consignee + cmbProvince + cmbCity + cmbArea + desc_address + fixed_number + tell + zip_code)
                        $.ajax({
                            type: "POST",
                            url: '/editAddressApi',
                            data: {
                                id:id,
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
                                        layui.use('layer', function () {
                                            layer.msg('编辑成功', {
                                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                            }, function () {
                                                // location.href = '/';
                                            });
                                        })
                                    })
                                    var src="<span>"+Consignee+"</span><span>"+cmbProvince+"</span><span>"+cmbCity+"</span><span>"+cmbArea+"</span><span>"+desc_address+"</span><span>"+tell+"</span>"
                                    $('.Settlement_DR .remembertwo  #address').html(src);
                                    $('#section .dz  #address').html(src);
                                }
                            },
                            error: function () {
                            }
                        })
                    });
                    // layer.close(index);
                }
            })



    });
});