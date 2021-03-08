$(function () {
//    tijiao
    var id = "1";
    Submission();
    $(".tab_ment li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
        id = $('.change').attr("id");
        // console.log(id)
        Submission();
    });

    function Submission() {
        $.ajax({
            type: "GET",
            url: '/exaManuscriptApi?_class=' + id + '',
            success: function (data) {
                // console.log(data.data)
                if (data.data.length==0) {
                    // console.log("没有值");
                    $('#biuuu_city_list2').html('<p class="NO_sj">您还没有相关的稿件</p>');

                $('#paggetj').hide()
                } else {
                    $('#paggetj').show();
                    // console.log("you")
                    $.each(data.data, function (k, v) {
                        layui.use(['laypage', 'layer'], function () {
                            var laypage = layui.laypage,
                                layer = layui.layer;
                            //调用分页
                            laypage.render({
                                elem: 'paggetj',
                                limit: 6,
                                count: data.data.length,
                                layout: ['prev', 'page', 'next', 'skip', 'count'],
                                theme: '#d82a39',
                                jump: function (obj) {
                                    //模拟渲染
                                    document.getElementById('biuuu_city_list2').innerHTML = function () {
                                        var arr = [],
                                            thisData = data.data.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                        layui.each(thisData, function (index, item) {
                                            var html = "";
                                            html += '<tr>\n' +
                                                '<td><p>' + item.man_title + '</p>\n' +//稿件标题
                                                '</td><td>' + item.man_number + '</td>\n' +//编号
                                                '<td>' + item.man_crea_at + '</td>\n' +//日期
                                                '<td>' + item.man_column + '</td>\n' +//栏目
                                                '<td>' + item.man_status + '</td>\n' +//审核
                                                '<td>' + item.man_adopt + '</td>\n' +//采纳状态
                                                '<td><p>' + item.man_opinion + '</p></td>\n' +
                                                '<td>' + item.man_integral + '</td>\n' +
                                                '</tr>'
                                            arr.push(html);
                                        });
                                        return arr.join('');
                                    }();
                                }
                            })
                        })
                    })
                }
            }
        })
    }

})
