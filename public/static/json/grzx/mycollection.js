$(function () {
//    我的收藏
    $.ajax({
        type: "GET",
        url: "/myCollectionApi",
        success: function (data) {
             console.log(data.data)
            var src = "";
            // console.log(data.data.magazine)
            //杂志收藏
            if(data.data.magazine.length==0){
                // console.log("您展示没有收藏内容")
                $('.Collection_main').html('<p class="NO_sj">您展示没有收藏内容哦！</p>')
            }
            else{
                $.each(data.data.magazine, function (k, v) {
                    src += "<dl id='"+v.id+"' class='Magazine_list'>\n" +
                        "                                <dt><img src='" + v.cover_img + "' alt=\"\">\n" +
                        "                                    <p class=\"Invalid\">该商品已失效</p>\n" +
                        "                                    <p class=\"delete\" onclick=\"Delete(this)\">x</p>\n" +
                        "                                    <!-- 不同状态不同的提示文字，和背景色 -->\n" +
                        "                                </dt>\n" +
                        "                                <dd><a href='zz/"+v.m_id+"'>\n" +
                        "                                    <p class=\"\">《管理会计研究》 </p>\n" +
                        "                                    <p class=\"\"><span>" + v.year + "</span><span>" + v.title + "</span></p>\n" +
                        "                                    <p class=\"money\">¥<span>" + v.flat + "</span></p>\n" +
                        "                                </dd>\n" +
                        "                            </a></dl>"

                })
                $('.Collection_main').html(src)
            }

            //
            if(data.data.article.length==0){
                $('.Article').html('<p class="NO_sj">您展示没有收藏内容哦！</p>')
            }
            else {
                $.each(data.data.article, function (k, v) {
                    layui.use(['laypage', 'layer'], function () {
                        var laypage = layui.laypage,
                            layer = layui.layer;
                        //调用分页
                        laypage.render({
                            elem: 'pagge',
                            limit: 6,
                            count: data.data.article.length,
                            layout: ['prev', 'page', 'next', 'skip', 'count'],
                            theme: '#d82a39',
                            jump: function (obj) {
                                document.getElementById('biuuu_city_list').innerHTML = function () {
                                    var arr = [],
                                        thisData = data.data.article.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                    layui.each(thisData, function (index, item) {
                                        var article="";
                                        article+='<div id="'+item.id+'" class="articlelist">\n' +
                                            '                                <div class="information">\n' +
                                            '                                    <a  id="'+item.id+'"  href="'+item.wz_url+'"><dl>\n' +
                                            '                                        <dd>\n' +
                                            '                                            <h3>'+item.title+'</h3>\n' +
                                            '                                            <p>'+item.message+'</p>\n' +
                                            '                                            <b>\n' +
                                            '                                                <div class="b-sL">\n' +
                                            '                                                    <span>'+item.class+'</span>\n' +
                                            '                                                </div>\n' +
                                            '                                                <div class="b-sR">\n' +
                                            '                                                    <span>'+item.author+'</span>\n' +
                                            '                                                    <span>'+item.crea_at+'</span>\n' +
                                            '                                                </div>\n' +
                                            '                                            </b>\n' +
                                            '                                        </dd>\n' +
                                            '                                    </dl></a>\n' +
                                            '                                    <p><span><img src="/static/picImG/pc/grzx/06.png" alt=""><label>'+v.view+'</label></span><span><img src="/static/picImG/pc/grzx/05.png" alt=""><label>2</label></span><span><img src="/static/picImG/pc/grzx/04.png" alt=""><label>'+v.praise+'</label></span></p>\n' +
                                            '                                </div>\n' +
                                            '                                <div class="A_right">\n' +
                                            '                                    <p onclick="cancel(this)">取消收藏</p>\n' +
                                            '                                    <p></p>\n' +
                                            '                                </div>\n' +
                                            '                            </div>'

                                        arr.push(article);
                                    });

                                    return arr.join('');
                                }();
                            }
                        })
                    })
                })
            }



            // $('.Article .clear ').before(article)



            // magazine 杂志收藏
            // article 文章收藏
        }
    })
})
// delCollectionApi?id=2
    function  cancel(id) {
    var articlelist_id= $(id).parents('.articlelist').attr('id');
// console.log(articlelist_id)
    $.ajax({
        type: "GET",
        url: '/delCollectionApi?id='+articlelist_id+'',
        success: function (data) {
            // console.log(data);
            if(data.bol==true){
                layui.use('layer', function() {
                    layui.use('layer', function() {
                        layer.msg('取消收藏成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function() {
                        });
                    })
                })
                $('#'+articlelist_id).remove();
            }
        },
        error: function () {
            console.log("错了");
        }
    })
}
function  Delete(id) {
    // console.log(id)
    var Magazine_list_id= $(id).parents('.Magazine_list').attr('id');
    // console.log(Magazine_list_id)
    $.ajax({
        type: "GET",
        url: '/delCollectionApi?id='+Magazine_list_id+'',
        success: function (data) {
            // console.log(data);
            if(data.bol==true){
                layui.use('layer', function() {
                    layui.use('layer', function() {
                        layer.msg('取消收藏成功', {
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function() {
                        });
                    })
                })
                $('#'+Magazine_list_id).remove();
            }
        },
        error: function () {
            console.log("错了");
        }
    })
}
$(function() {
    console.log("d")
    // $($(".articlelist").get().reverse()).each(function(index,item){
    //     var text = $(item).text() + " + " + index;
    //     console.log("dd")
    //
    //     $(item).text(text);
    // });
});