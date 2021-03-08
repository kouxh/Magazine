//个人中心首页
function setcookie(name, value, seconds) {
    seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。
    var expires = "";
    if (seconds != 0 ) {      //设置cookie生存时间
        var date = new Date();
        date.setTime(date.getTime()+(seconds*1000));
        expires = "; expires="+date.toGMTString();
    }
    document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值
}
var pl_src=$('.member_one  dl dt img').attr('src');
console.log(pl_src)
setcookie('pl_src',pl_src);

$(function () {
    $('.znx').click(function () {
        if($("#noticeId").text()==0){
            return false;
        }else{
            layui.use(['form', 'layedit', 'laydate'], function () {
                var form = layui.form
                    , layer = layui.layer
                    , layedit = layui.layedit
                    , laydate = layui.laydate;
                // 订单
                var layer = layui.layer;
                layer.open({
                    type: 1,
                    title: ['通知', 'background: #000;text-align: center; color:#fff'],
                    maxmin: true,
                    shadeClose: true, //点击遮罩关闭层
                    area: ['800px', '530px'],
                    content: $('#noticeBox'),
                    btn: ['确认', '取消'],
                    success: function (layero, index) {
                        $.ajax({
                            type: "GET",
                            url: '/StationEmailApi',
                            success: function (data) {
                                var src = "";
                                console.log(data.data);
                                $.each(data.data, function (k, v) {
                                    console.log(v.em_crea_at)
                                    src += '<li class="layui-timeline-item">\n' +
                                        '            <i class="layui-icon layui-timeline-axis"></i>\n' +
                                        '            <div class="layui-timeline-content layui-text">\n' +
                                        '                <h3 class="layui-timeline-title">' + v.em_crea_at + '</h3>\n' +
                                        '                <p>' + v.em_message + '</p>\n' +
                                        '            </div>\n' +
                                        '        </li>'
    
                                })
                                $('#noticeBox .layui-timeline').html(src);
                            }
                        })
    
                    },
                    yes: function (index, layero) {
                        $("#noticeId").text("0");
                        layer.close(index);
                        // window.location.reload();
                        
                    }
                })
            })
        }
    })
    //我的关注
    $('.mAinLD_main span').click(function () {
        var id=$(this).attr("id")
        // console.log($(this).attr("id"));
        $.ajax({
            type: "GET",
            url: '/MyFollowApi?id='+id+'',
            success: function (data) {
                var src=''
                $.each(data.data, function (k, v) {
                    console.log(v.em_crea_at)
                    src += '<li><a href="/'+v.english+'/list/'+v.id+'">'+v.title+'</a></li>'

                })
                $('.mAinR ul ').html(src)
            }
        })
    })
})