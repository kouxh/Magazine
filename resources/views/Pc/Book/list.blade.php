<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $data['column']['title']}}</title>
    <meta name="description" content="{{ $data['column']['describe']}}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <!-- 公共css -->
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/picss/pic.css">
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/Magazine.css" /> -->
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <link rel="stylesheet" href="/static/css/More_books.css">
</head>
 @include('Pc.layout.header')
<body>
<div class="wapper">
    <div class="Home-section2">
        <img src="http://html.chinamas.cn/upload/2019/12/02/15752676378682.jpg" alt="" class="pc">
        <img src="http://html.chinamas.cn/upload/2019/12/02/15752676419354.jpg" alt="" class="yd">
        <a class="Home-section2-bg" href="https://weidian.com/?userid=1204480026">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="bread_navigation">
            <ul class="Navigation">
                <a href="/" title="shouye">首页<span>></span></a>
                <a href="/rw">人物<span>></span></a>
                <a href="/sj">书籍<span>></span></a>
            </ul>
            <ul class="tab_title">
                <li>书籍分类:</li>
                <a href="#" class="change" onclick="getBookId(0)" id="0"><span>全部</span></a>
            @foreach($data['zy'] as $v)
                    <a href="#" onclick="getBookId({{ $v -> id }})" id="{{ $v -> id }}"><span>{{ $v -> title }}</span></a>
                @endforeach
{{--                <a href="#" class="change">成本管理<span>|</span></a>--}}
{{--                <a href="#">预算管理<span>|</span></a>--}}
{{--                <a href="#">管理会计<span>|</span></a>--}}
            </ul>
        </div>
        <div class="main tab_ment">
            <div class="div">
                @foreach($data['list'] as $v )
                    <a href="/sj/{{ $v -> id }}" class="M_a">
                        <dl>
                            <dt><img src="{{ $v -> book_img }}" alt=""></dt>
                            <dd>{{ $v -> book_name }}</dd>
                        </dl>
                    </a>
                @endforeach
                <div class="clear"></div>
            </div>

        </div>
    </section>
    <div class="clear"></div>
</div>
</body>
 @include('Pc.layout.footer')
</html>
{{--<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>--}}
<script type="text/javascript">

    function getBookId(id){
        $.ajax({
            url:'/bookType',
            data:{type:id},
            type:'get',
            dataType:'json',success:function (data) {
                kong="";
                var html = '';
                $.each(data.data, function(k, v) {
                    // console.log(v)
                    $('.main .div '). html(kong);
                        html += '<a href="/sj/'+v.id+'" class="M_a" class="v.id">\n' +
                            '<dl>\n' +
                            '<dt><img src="' + v.book_img + '" alt=""></dt>\n' +
                            '<dd>' +v.book_name + '</dd>\n' +
                            '</dl>\n' +
                            '</a>';
                    // $('#'+id+'').addClass("change").siblings().removeClass("change");
                    // $("#"+v.id+"").addClass("change").siblings().removeClass("change");
                })
                $('.main .div ').append(html);

            //    prepend
            },
            error:function () {
                console.log(0);
            }
        })
    }

    $().ready(function() {
        $(".bread_navigation .tab_title a").click(function(index) {
            //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
            var _index = $(this).index();
            //让内容框的第 _index 个显示出来，其他的被隐藏
            // $(".main>.div").eq(_index).show().siblings().hide();
            //改变选中时候的选项框的样式，移除其他几个选项的样式
            $(this).addClass("change").siblings().removeClass("change");
        });

    });
</script>