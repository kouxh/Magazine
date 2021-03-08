var ID=1;
$(function () {
    ly();
    $(".tab_title li").click(function (index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab_box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("default").siblings().removeClass("default");
        ID = $(this).addClass("default").attr("id");
        ly();
    })

function ly(){
    $.ajax({
        type: "GET",
        url: '/myCommentApi?type='+ID+'',
        success: function (data) {
            // console.log(data.data.data)
            $.each(data.data, function (k, v) {
                var html = '';
                layui.use(['laypage', 'layer'], function () {
                    var laypage = layui.laypage,
                        layer = layui.layer;
                    //调用分页
                    laypage.render({
                        elem: 'pagge',
                        limit: 6,
                        count: data.data.data.length,
                        layout: ['prev', 'page', 'next', 'skip', 'count'],
                        theme: '#d82a39',
                        jump: function (obj) {
                            //模拟渲染
                            document.getElementById('biuuu_city_list').innerHTML = function () {
                                var arr = [],
                                    thisData = data.data.data.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function (index, item) {
                                    var html="";
                                    html += '<tr id="' + item.com_id + '">\n' +
                                        '                                    <td>\n' +
                                        '                                        <p>' + item.com_crea_at + '</p>\n' +
                                        '                                    </td>\n' +
                                        '                                    <td>' + item.cl_title + '</td>\n' +
                                        '                                    <td><p>' + item.com_comment + '</p>\n' +
                                        '                                    </td>\n' +
                                        '<td>'+item.com_status+'</td>\n' +
                                        '                                    <td>\n' +
                                        '                                        <p class="delete"  onclick="Delete(this)">删除</p>\n' +
                                        '                                        <p class="reply" >回复</p>\n' +
                                        '                                    </td>\n' +
                                        '                                </tr>'

                                    arr.push(html);
                                });
                                return arr.join('');
                            }();
                        }
                    });
                })
                // $("#stay_word .clear").before(html);
            })


        }
    })
}
})

//    删除
function Delete(e) {
    console.log(e,'99999')
    var addressList_id = $(e).parent().parent().attr("id"); //删除留言回复
    $.ajax({
        type: "GET",
        url: '/delCommentApi?type='+ID+'&com_id=' + addressList_id + '',
        success: function (data) {
            // console.log(data)
            if (data.bol==true){
                $('#' + addressList_id).remove();
                layui.use('layer', function() {
                    layui.use('layer', function() {
                        layer.msg('删除成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function() {
                            // location.href = '/';
                        });
                    })
                })
            }

        }
    })

}