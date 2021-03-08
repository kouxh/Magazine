$(function () {
    // 购买的文章
    $.ajax({
        type: "GET",
        url: "/myArticleApi",
        success: function (data) {
            var src = "";
            if (data.data.length == 0) {
                $('.article_box').html(`<p class="no_article">您还没有购买过文章哦！</p>`)
            } else {
                $.each(data.data, function (k, v) {
                    layui.use(['laypage', 'layer'], function () {
                        var laypage = layui.laypage,
                            layer = layui.layer;
                        //调用分页
                        laypage.render({
                            elem: 'pagge',
                            limit: 6,
                            count: data.data.length,
                            layout: ['prev', 'page', 'next', 'skip', 'count'],
                            theme: '#d82a39',
                            jump: function (obj) {
                                document.getElementById('article_data').innerHTML = function () {
                                    var arr = [],
                                        thisData = data.data.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                                    layui.each(thisData, function (index, item) {
                                        var article = "";
                                        article += `<li class="item_article">
                                           <a href="${item.url}" class="article_left" >
                                               <h4>${item.title}</h4>
                                           </a>
                                           <div class="article_right">${item.crea_at}</div>
                                       </li>`


                                        arr.push(article);
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
})