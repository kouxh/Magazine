// 技术列表
$(function() {
    var zym = 'http://www.chinamas.cn';
    $.ajax({
        type: "GET",
        url: "http://www.ynresearch.net/articlelist",
        headers:{
            'CLASS':'technigue'
        },
        success: function(data) {
            $("meta[name='description']").attr('content',data.data.describe.describe);//简介
            // 技术主列表
            layui.use(['laypage', 'layer'], function() {
                var laypage = layui.laypage,
                    layer = layui.layer;
                //调用分页
                laypage.render({
                    elem: 'pagge',
                    limit: 6,
                    count: data.data.list.length,
                    layout: ['prev', 'page', 'next', 'skip', 'count'],
                    theme: '#d82a39',
                    jump: function(obj) {
                        //模拟渲染
                        var url = "./jswz.html?id="
                        document.getElementById('biuuu_city_list').innerHTML = function() {
                            var arr = [],
                                thisData = data.data.list.concat().splice(obj.curr * obj.limit - obj.limit, obj.limit);
                            layui.each(thisData, function(index, item) {
                                console.log(item)
                                var html = '';
                                html += '<a	class="wznr" href="' + url + '' + item.id + '" id="m_id' + item.id +
                                    '" ><dl><dt><img src='+zym+'' + item.img +
                                    ' alt=""></dt><dd><h3>' + item.title +
                                    '</h3><p>' + item.message +
                                    '</p><b><div class="b-sL">';
                                for (var c in item.keyword) {
                                    html += '<span>' + item.keyword[c].name + '</span>';
                                }
                                html += '</div><div class="b-sR"><span>' + item.author + '</span><span>' + item.crea_at +
                                    '</span ></div ></b ></dd></dl> </a >';
                                arr.push(html);
                            });
                            return arr.join('');
                        }();

                    }
                });
            })

            // 业界
            $.each(data.data.industry, function(k, v) {
                var industry = '';
                industry +=
                    '<li><a  id="industry' + v.id + '" >' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>';
                industry += '</div>';
                $('.bottomL1 .ul .clear').before(industry);
                $("#industry" + v.id + "").click(function() {
                    var ID = v.id;
                    var title = v.title;
                    var time = v.crea_at;
                    var message = v.message;
                    location.href = './yjwz.html?id=' + ID + '?' + 'time' + time;
                })
            })
            //观察 observation
            $.each(data.data.observation, function(k, v) {
                var observation = '';
                observation +=
                    '<li><a  id="observation' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>';
                observation += '</div>';
                $('.bottomL2 .ul .clear').before(observation);
                $("#observation" + v.id + "").click(function() {
                    var ID = v.id;
                    var title = v.title;
                    var time = v.crea_at;
                    var message = v.message;
                    location.href = './gcwz.html?id=' + ID + '?' + 'time' + time;
                })
            })

            // 案例 case
            $.each(data.data.research, function(k, v) {
                var research = '';
                research +=
                    '<li><a id="research' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
                research += '</div>';
                $('.bottomL3 .ul .clear').before(research);
                $("#research" + v.id + "").click(function() {
                    var ID = v.id;
                    location.href = './alwz.html?id=' + ID;
                })
            })
            // 活动 activity
            $.each(data.data.activity, function(k, v) {
                var activity = '';
                activity +=
                    '<li><a id="activity' + v.id + '" href='+v.img+'>' + v.title + '</a><b>作者：<span>' + v.author + '</span></b></li>'
                activity += '</div>';
                $('.bottomL4 .ul .clear').before(activity);

            })
            // 右边
            // 猜你喜欢
            var like = ""
            $.each(data.data.like, function(k, v) {
                var likeurl = './jswz.html?id='
                like +=
                    '<li><a href="' + likeurl + '' + v.id + '" id="like' + v.id + '">' + v.title +
                    '</a><b>作者：<span>' + v.author + '</span></b></li>';
                $('.sectionR_twoUL1  .ul ').html(like);
            })
            // 理论
            $.each(data.data.frontier, function(k, v) {
                var Frontier = '';
                Frontier += '<li><a id="Frontier' + v.id + '">' + v.title + '</a><b>作者：<span>' + v.author +
                    '</span></b></li>'
                // Frontier += '<a href="./theory.html" class="ckgd">查看更多</a> '
                $('.sectionR_twoUL2  .ul .ckgd ').before(Frontier);
                $("#Frontier" + v.id + "").click(function() {
                    var ID = v.id;
                    var title = v.title;
                    var time = v.crea_at;
                    var message = v.message;
                    location.href = './llwz.html?id=' + ID + '?' + 'time' + time;
                })
            })
            // 杂志
            $.each(data.data.magazine, function(k, v) {
                var magazine = '';
                magazine += '<h3><span class="D_Rbspan1">' + data.data.magazine.year + '</span>' + data.data.magazine.title +
                    '</h3><h4>邮发代码：80-841</h4><img src="' + zym + '' + data.data.magazine.cover_img +
                    '" alt=""><a href="./buy.html?mmid=' + data.data.magazine.m_id +
                    '" class="msyd">马上阅读</a><a href="./zz.html" class="ckgd">更多阅读</a>'
                $('.gc_bottomRD').html(magazine);

            })

        },
        error: function(xhr, type, errorThrown) {

        }
    });
})
