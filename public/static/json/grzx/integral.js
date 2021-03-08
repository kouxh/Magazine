$(function () {
    $(".DetailedMain_top-right").click(function () {
            layui.use('layer', function() {
                layer.msg('努力搭建中...', {
                    time: 2000 //2秒关闭
                }, function() {
                  
                });
            })
    });
    var ID=1;
    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_subject>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
         ID = $(this).addClass("default").attr("id");
        console.log(ID)
        if (ID == 1) {
            console.log("详情")
            //默认
            var url = '/integralDescApi?mode=desc'
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    console.log(data)
                    $('.Total span').html(data.data.all.integral);

                    $.each(data.data, function (k, v) {
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            //调用分页
                            laypage.render({
                                elem: 'pagge',
                                limit: 6,
                                count: data.data.log.length,
                                layout: ['prev', 'page', 'next', 'skip', 'count'],
                                theme: '#d82a39',
                                jump: function (obj) {

                                    //模拟渲染
                                    document.getElementById('biuuu_city_list').innerHTML = function () {
                                        var arr = [],
                                            thisData = data.data.log.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                        layui.each(thisData, function (index, item) {
                                            var html = '';
                                            html +='<tr>\n' +
                                                '<td>\n' +
                                                '   <dl>\n' +
                                                '   <dt><img src="/static/picImG/pc/grzx/jf.png" alt=""></dt>\n' +
                                                '   <dd>\n' +
                                                '                                                    <p class="P_title3">'+item.content+'</p>\n' +
                                                '                                                    <p class="paragraph" style="display: none;"><span>积分</span>编号<label for="">1234556789</label></p>\n' +
                                                '                                                </dd>\n' +
                                                '                                            </dl>\n' +
                                                '                                        </td>\n' +
                                                '                                        <td>'+item.num+'</td>\n' +
                                                '                                        <td>'+item.care_time+'</td>\n' +
                                                '                                    </tr>'

                                            arr.push(html);

                                        });
                                        return arr.join('');
                                    }();
                                }
                            });
                        })
                    })
                },
                error: function () {
                    console.log("错我");
                }
            })
        } else if (ID == 2) {
            //为支出详情
            console.log("支出")
            var url = '/integralDescApi?mode=expenditure';
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    console.log(data.data.log)
                    $.each(data.data, function (k, v) {
                        if(v.length==0){
                            $('.Detailed_table2 ul').hide();
                            $('.Detailed_table2').html('<p class="NO_sj my_order">您还没有相关内容</p>');
                        }else{


                        var html = '';
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            //调用分页
                            laypage.render({
                                elem: 'pagge2',
                                limit: 6,
                                count: data.data.log.length,
                                layout: ['prev', 'page', 'next', 'skip', 'count'],
                                theme: '#d82a39',
                                jump: function (obj) {
                                    //模拟渲染
                                    document.getElementById('biuuu_city_list2').innerHTML = function () {
                                        var html="";
                                        var arr = [],
                                            thisData = data.data.log.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                        layui.each(thisData, function (index, item) {
                                            html +='<tr>\n' +
                                                '<td>\n' +
                                                '   <dl>\n' +
                                                '   <dt><img src="/static/picImG/pc/grzx/jf.png" alt=""></dt>\n' +
                                                '   <dd>\n' +
                                                '                                                    <p class="P_title3">'+item.content+'</p>\n' +
                                                '                                                    <p class="paragraph" style="display: none;"><span>积分</span>编号<label for="">1234556789</label></p>\n' +
                                                '                                                </dd>\n' +
                                                '                                            </dl>\n' +
                                                '                                        </td>\n' +
                                                '                                        <td>'+item.num+'</td>\n' +
                                                '                                        <td>'+item.care_time+'</td>\n' +
                                                '                                    </tr>'


                                        });
                                        arr.push(html);
                                        return arr.join('');
                                    }();
                                }
                            });
                        })
                        }
                    })
                },
                error: function () {
                    console.log("错我");
                }
            })

        }else if(ID ==3)
        {
            var url = '/integralDescApi?mode=income';
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $.each(data.data, function (k, v) {
                        if(v.length==0){
                            $('.Detailed_table ul').hide();
                            $('.Detailed_table').html('<p class="NO_sj my_order">您还没有相关内容</p>');
                        }else{
                            var html = '';
                            layui.use(['laypage', 'layer'], function () {
                                var laypage = layui.laypage,
                                    layer = layui.layer;
                                //调用分页
                                laypage.render({
                                    elem: 'pagge3',
                                    limit: 6,
                                    count: data.data.log.length,
                                    layout: ['prev', 'page', 'next', 'skip', 'count'],
                                    theme: '#d82a39',
                                    jump: function (obj) {
                                        //模拟渲染
                                        document.getElementById('biuuu_city_list3').innerHTML = function () {
                                            var arr = [],
                                                thisData = data.data.log.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                            layui.each(thisData, function (index, item) {
                                                var html="";
                                                html +='<tr>\n' +
                                                    '<td>\n' +
                                                    '   <dl>\n' +
                                                    '   <dt><img src="/static/picImG/pc/grzx/jf.png" alt=""></dt>\n' +
                                                    '   <dd>\n' +
                                                    '                                                    <p class="P_title3">'+item.content+'</p>\n' +
                                                    '                                                    <p class="paragraph" style="display: none;"><span>积分</span>编号<label for="">1234556789</label></p>\n' +
                                                    '                                                </dd>\n' +
                                                    '                                            </dl>\n' +
                                                    '                                        </td>\n' +
                                                    '                                        <td>'+item.num+'</td>\n' +
                                                    '                                        <td>'+item.care_time+'</td>\n' +
                                                    '                                    </tr>'

                                                arr.push(html);

                                            });
                                            return arr.join('');
                                        }();
                                    }
                                });
                            })
                        }


                    })
                },
                error: function () {
                    console.log("错我");
                }
            })
        }

    });
    $.ajax({
        type: "GET",
        url: '/integralDescApi?mode=desc',
        success: function (data) {
            console.log()
            $('.Total span').html(data.data.all.integral);
            $.each(data.data, function (k, v) {

                layui.use(['laypage', 'layer'], function () {
                    var laypage = layui.laypage,
                        layer = layui.layer;
                    //调用分页
                    laypage.render({
                        elem: 'pagge',
                        limit: 6,
                        count: data.data.log.length,
                        layout: ['prev', 'page', 'next', 'skip', 'count'],
                        theme: '#d82a39',
                        jump: function (obj) {
                            //模拟渲染
                            document.getElementById('biuuu_city_list').innerHTML = function () {
                                var arr = [],

                                    thisData = data.data.log.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function (index, item) {
                                    var html = '';
                                    html +='<tr>\n' +
                                        '<td>\n' +
                                        '   <dl>\n' +
                                        '   <dt><img src="/static/picImG/pc/grzx/jf.png" alt=""></dt>\n' +
                                        '   <dd>\n' +
                                        '                                                    <p class="P_title3">'+item.content+'</p>\n' +
                                        '                                                    <p class="paragraph" style="display: none;"><span>积分</span>编号<label for="">1234556789</label></p>\n' +
                                        '                                                </dd>\n' +
                                        '                                            </dl>\n' +
                                        '                                        </td>\n' +
                                        '                                        <td>'+item.num+'</td>\n' +
                                        '                                        <td>'+item.care_time+'</td>\n' +
                                        '                                    </tr>'

                                    arr.push(html);
                                });

                                return arr.join('');
                            }();
                        }
                    });
                })
            })
            
        },
        error: function () {
            console.log("错我");
        }
    })
})
function integral(Integral){


}