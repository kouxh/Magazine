var is_charge = "{{$data['content'] -> is_charge}}";
var zx_id=$('.sectionc').attr('id')
console.log(zx_id)
//会员 2 1登陆没有付费 //0没有登陆||免费  3是购买完成
if (is_charge == 2) {
    //会员，但是没有购买文章
    $('#ArtiCle_status .ArtiCle3').show();
    $('.Continue').click(function () {
        $('.sectionc .Article .clear').after('<?php echo $data['content']->charge_content;?>');
        $('#ArtiCle_status .ArtiCle3').hide();
    })
} else if (is_charge == 0) {
    //文章，免费
    $('#ArtiCle_status').hide();
} else if ("{{ $data['uid']}}" == 0) {
    console.log("{{ $data['uid']}}");
    $('#ArtiCle_status .ArtiCle1').show();//没有登陆或者注册

} else if (is_charge == 3) {
    console.log("购买完成");
    $('#ArtiCle_status .ArtiCle3').show();
    $('.Continue').click(function () {
        $('.sectionc .Article .clear').after('<?php echo $data['content']->charge_content; ?>');
        $('#ArtiCle_status .ArtiCle3').hide();
    })
} else {
    $('#ArtiCle_status .ArtiCle2').show();
    // 如果等于1为付费 文章
    $("#purchase").click(function () {
        //console.log("222222")
        // 选中状态 如：扫码  积分
        var moDe = $('.bINput input:checked').attr('id');
        //console.log(moDe)
        var wenZurl = '/newCreaOrderApi?aid=' + {{$data['content'] -> id}} +'&&mode=' + moDe; //购买单篇文章
        //console.log(wenZurl+"wenZurl")
        //
        console.log(moDe)
        if (moDe == undefined) {
            layui.use('layer', function () {
                layui.use('layer', function () {
                    layer.msg("请选择购买方式！", {
                        // skin: 'demo-class',
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    }, function (data) {
                        // location.href = './index.html';
                        // console.log(data.article.charge_content)
                    });
                })
            })
        } else {
            // 购买文章
            $.ajax({
                type: "POST",
                url: '/newCreaOrderApi',
                data:{
                    aid:zx_id,
                    mode:moDe,
                },
                success: function (data) {
                    console.log(222)
                    console.log(data)
                    // if (data.bol == true) {
                    //     //购买成功
                    //     layui.use('layer', function () {
                    //         layui.use('layer', function () {
                    //             layer.msg(data.msg, {
                    //                 // skin: 'demo-class',
                    //                 time: 1000 //1秒关闭（如果不配置，默认是3秒）
                    //             }, function (datau) {
                    //                 console.log(data)
                    //                 console.log(data.data);
                    //
                    //                 $('#ArtiCle_status .ArtiCle2').hide();
                    //                 $('#ArtiCle_status .ArtiCle3').show();
                    //                 $('.Continue').click(function () {
                    //                     $('.sectionc .Article .clear').after(data.data);
                    //                     $('#ArtiCle_status .ArtiCle3').hide();
                    //                 })
                    //                 // $('.sectionc .Article .clear').after(datas.data);
                    //                 // location.href = './index.html';
                    //                 // console.log(data.article.charge_content)
                    //             });
                    //         })
                    //     })
                    // } else {
                    //     //购买失败
                    //     layui.use('layer', function () {
                    //         layui.use('layer', function () {
                    //             layer.msg(data.msg, {
                    //                 // skin: 'demo-class',
                    //                 time: 1000 //1秒关闭（如果不配置，默认是3秒）
                    //             }, function (data) {
                    //                 // location.href = './index.html';
                    //                 // console.log(data.article.charge_content)
                    //             });
                    //         })
                    //     })
                    // }


                    //var dh = data.data.order_num; //单号
                    // var urlll = "/creaCode?orderNum=" + dh;
                    //var urlll = '/GenerateCodeApi?orderNum=' + dh + '';
                    // var nuurl='/GenerateCodeApi?orderNum='+dh+'';
// axios.get(nuurl, {
//                     axios.get('/GenerateCodeApi?orderNum='+dh+'', {
//                         responseType: "arraybuffer",
//
//                     }).then(res => {
//                         return 'data:image/png;base64,' + btoa(
//                             new Uint8Array(res.data)
//                                 .reduce((data, byte) => data + String.fromCharCode(byte), '')
//                         );
//                     })
//                         .then(data => {
//                              console.log(data);
//                             $("#test img").attr("src", data);
//                         })
//                         .catch(ex => {
//                             console.error(ex);
//                         });
//                         console.log(dh)
                    // 判断是钱还是积分购买
                    // if (moDe == 1) { //微信扫码支付
                    //     layui.use('layer', function (layero,index) {  //支付方式
                    //         var layer = layui.layer;
                    //         layer.open({
                    //             type: 2,
                    //             title: ['支付方式'],
                    //             maxmin: true,
                    //             shade: 0.8  ,
                    //             // shadeClose: true, //点击遮罩关闭层
                    //             area: ['800px', '370px'],
                    //             content: '/static/tips/wzZf.html',
                    //             btn: ['确认'],
                    //             success: function (layero, index) {
                    //                 $.ajax({
                    //                     type: "GET",
                    //                     url: urlll,
                    //                     success: function (data) {
                    //                         // console.log(data);
                    //                         // return false;
                    //                         var body = layer.getChildFrame('body', index);
                    //                         body.find('.jb img').attr("src", urlll);
                    //                         // 1.杂志 2单篇文章
                    //                         setTimeout(alertHello, 2000);
                    //                         var tt = setTimeout(alertHello, 2000);
                    //
                    //                         function alertHello() {
                    //                             $.ajax({
                    //                                 type: "GET",
                    //                                 url: "/refreshorder?orderNum=" + dh,
                    //                                 headers: {
                    //                                     "mode": 2
                    //                                 },
                    //                                 success: function (data) {
                    //                                     // console.log(data);
                    //                                     //
                    //                                     if (data.data == null) {
                    //                                         //继续定时请求
                    //                                         setTimeout(alertHello, 2000);
                    //                                     } //
                    //                                     else {
                    //                                         // 停止定时请求
                    //                                         // console.log("停止请求，付款成功")
                    //                                         clearTimeout(tt);
                    //                                         layer.closeAll('iframe'); //关闭所有的iframe层
                    //                                         layui.use('layer', function () {
                    //                                             layui.use('layer', function () {
                    //                                                 layer.msg("购买成功", {
                    //                                                     skin: 'demo-class',
                    //                                                     time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    //                                                 }, function (data) {
                    //                                                     // location.href = './index.html';
                    //                                                     // console.log(data.article.charge_content)
                    //                                                 });
                    //                                             })
                    //                                         })
                    //                                     }
                    //                                 }
                    //                             })
                    //
                    //                         }
                    //                     }
                    //                 })
                    //             }
                    //             ,yes: function () {
                    //             //确定
                    //             console.log("购买失败");
                    //             var url = "/refreshorder?orderNum=" + dh;
                    //             $.ajax({
                    //                 url: url,
                    //                 headers: {
                    //                     "mode": 2
                    //                 },
                    //                 cache: false,
                    //                 async: false,
                    //                 type: "GET",
                    //                 success: function (result) {
                    //                     console.log(result)
                    //                     f();
                    //                 }
                    //
                    //             });
                    //             return false //开启该代码可禁止点击该按钮关闭
                    //         }
                    //
                    //             , cancel: function () {
                    //                 //右上角关闭回调
                    //                 console.log("购买失败");
                    //                 var url = "/refreshorder?orderNum=" + dh;
                    //                 $.ajax({
                    //                     url: url,
                    //                     headers: {
                    //                         "mode": 2
                    //                     },
                    //                     cache: false,
                    //                     async: false,
                    //                     type: "GET",
                    //                     success: function (result) {
                    //                         console.log(result)
                    //                         f();
                    //                     }
                    //
                    //                 });
                    //                 return false //开启该代码可禁止点击该按钮关闭
                    //             }
                    //         });
                    //     });
                    //
                    // } else if (moDe == 2) {
                    //     //积分购买
                    //     var dd = data.msg
                    //     layui.use('layer', function () {
                    //         layui.use('layer', function () {
                    //             layer.msg(data.msg, {
                    //                 // skin: 'demo-class',
                    //                 time: 1000 //1秒关闭（如果不配置，默认是3秒）
                    //             }, function (datau) {
                    //                 console.log(data)
                    //                 console.log(data.data);
                    //
                    //                 $('#ArtiCle_status .ArtiCle2').hide();
                    //                 $('#ArtiCle_status .ArtiCle3').show();
                    //                 $('.Continue').click(function () {
                    //                     $('.sectionc .Article .clear').after(data.data);
                    //                     $('#ArtiCle_status .ArtiCle3').hide();
                    //                 })
                    //             });
                    //         })
                    //     })
                    //
                    // }


                },
                error: function (xhr, type, errorThrown) {
                    console.log("chuq")
                }

            })

        }
    })


}

function f() {
    if( layer.open({
        type: 1
        ,title: false //不显示标题栏
        ,closeBtn: false
        ,area: '300px;'
        ,shade: 0.8
        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
        ,btn: ['是', '否']
        ,btnAlign: 'c'
        ,moveType: 1 //拖拽模式，0或者1
        ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">您还没有付款，本篇文章为付费文章，是否要继续支付</div>'
        ,success: function(layero,index){

        },
        btn2: function(index, layero){
            //do something
            // alert("23")
            layer.closeAll(); //如果设定了yes回调，需进行手工关闭
        }
    })){ //只有当点击confirm框的确定时，该层才会关闭
    }
    // return false;
    // layer.open({
    //     type: 1
    //     ,title: false //不显示标题栏
    //     ,closeBtn: false
    //     ,area: '300px;'
    //     ,shade: 0.8
    //     ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
    //     ,btn: ['火速围观', '残忍拒绝']
    //     ,btnAlign: 'c'
    //     ,moveType: 1 //拖拽模式，0或者1
    //     ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">你知道吗？亲！<br>layer ≠ layui<br><br>layer只是作为Layui的一个弹层模块，由于其用户基数较大，所以常常会有人以为layui是layerui<br><br>layer虽然已被 Layui 收编为内置的弹层模块，但仍然会作为一个独立组件全力维护、升级。<br><br>我们此后的征途是星辰大海 ^_^</div>'
    //     ,success: function(layero){
    //         var btn = layero.find('.layui-layer-btn');
    //         btn.find('.layui-layer-btn0').attr({
    //             href: 'http://www.layui.com/'
    //             ,target: '_blank'
    //         });
    //     }
    // });



    // layui.use('layer', function () {  //支付方式
    //     var layer = layui.layer;
    //     layer.open({
    //         type: 1,
    //         title: [''],
    //         maxmin: true,
    //         shadeClose: true, //点击遮罩关闭层
    //         area: ['400px', '270px'],
    //         content: '/static/tips/wzZf.html',
    //         btn: ['确认'],
    //         success: function (layero, index) {
    //
    //         }
    //
    //     })
    // })

}
Å
