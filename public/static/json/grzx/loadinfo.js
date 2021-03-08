//j基本信息
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
//兴趣标签
var arr = [];
var dds = [];
$.ajax({
    type: "GET",
    url: '/loadKeyword',
    beforeSend: function (request) {
    },
    success: function (e) {
        // console.log(e)
        var arr = [];
        $.each(e.data, function (k, v) {
            var h = '';
            h +=
                '<li class="c'+v.id+'"  onclick="increase(id)"   id=' + v.id + ' title=' + v.title +
                '><label for="setting-interest-' + v.id +
                '">' + v.title + '</label></li>';
            $('.sectionR_oneA_right ul .clear').before(h)
            $('.sectionR_oneA_left ul li').each(function(){
                var kid=parseFloat($(this).attr('id'));
                // console.log(kid)
                // $('.sectionR_oneA_right ul #'+kid+'').hide()
                $('.sectionR_oneA_right .c'+kid+'').hide();
            })
            // console.log('2')

        });

        var src = '';
        //$(".sectionR_oneA_right ul  li").click(function(name) {
        // return false;
        // if (!$(this).hasClass("on")) {
        // 	$(this).addClass("on");
        // 	var kid = parseFloat($(this).attr("id"));
        // 	var cc= parseFloat($(this).text());
        // 	var dd=$(this).text();

        // 	dds.push(dd);
        // 	console.log(dds)
        // console.log(arr)
        // } else {
        // 	$(this).removeClass('on');
        // 	var kid = parseFloat($(this).attr("id"));
        // 	console.log(kid)
        // 	var dd=$(this).text();
        // 	console.log(dd)
        // 	// var local = $.inArray(kid, json); //根据元素值查找下标，不存在返回-1
        // 	var cc = arr.splice($.inArray(kid, arr), 1)
        // 	var cdc = dds.splice($.inArray(dd, dds), 1)
        // 	console.log(cdc)
        //}


        // })

        // $('#wc').click(function() {
        // 	var kid = '';
        // 	var dd='';
        // 	src=''
        // 	for (i = 0; i < arr.length; i++) {
        // 		kid += arr[i] + ',';
        // 		console.log(dds[i]);
        // 		src+='<li class=""   id='+arr[i]+'><label for="setting-interest-s">'+dds[i]+'</label></li>';

        // 	}
        // 	$('.sectionR_oneA_left ul').html(src);
        // 	console.log(arr)
        // 	console.log(dds);
        // 	if (kid !== '') {

        // 	}
        // })


    }
});
// $('.sectionR_oneA_left ul li').click(function() {
// 			console.log("shangchu")
// 			$(this).remove();
//
// 				console.log(kid)
// 				var dd=$(this).text();
// 		})
function increase(id) {
    var src = '';
    // $this.attr('title')
    $('#' + id).addClass('selected');
    var id = $('#' + id).attr("id");
    var text = $('#' + id).text();
    $('#' + id).remove();
    src += '<li class=""  title=' + text + ' onclick="Delete(id)" id=' + id + '><label for="setting-interest-s">' + text + '</label></li>';
    var kid = parseFloat(id)
    arr.push(kid);
    $('.sectionR_oneA_left ul .clear').before(src);
}

//删除/
function Delete(his) {

    var src = '';
    var kid = parseFloat(his);
    var text = $('#' + his).attr("title");
    src += '<li class=""   onclick="increase(id)" title=' + text + '  id=' + kid + '><label for="setting-interest-s">' + text + '</label></li>';
    $('#' + his).remove();
    $('.sectionR_oneA_right ul .clear').before(src);
    arr.splice($.inArray(kid, arr), 1);
}

//完成
$('#wc').click(function () {
    var kid = '';
    var ullength = $('.sectionR_oneA_left ul li ').length;
    for (i = 0; i < arr.length; i++) {
        // var kid=parseFloat($(".sectionR_oneA_left ul li").attr("id"));
        console.log(kid)
        kid += arr[i] + ','
        // console.log(kid);
    }
    var cc = parseFloat(arr);
    // console.log(kid)
    $.ajax({
        type: "POST",
        url: '/UpKeywordApi',
        data:{
            keyword:kid
        },
        success: function (data) {
            if(data.bol==true){
                layui.use('layer', function() {
                    layer.msg('修改成功', {
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function() {


                    });
                })
            }
        }
    });

})

//获取，感兴趣标签的id
var cc=$('.sectionR_oneA_left ul li');
$('.sectionR_oneA_left ul li').each(function(){
     var kid=parseFloat($(this).attr('id'));
    $('.sectionR_oneA_right .c10').hide();
   var  hml=$('.sectionR_oneA_right ul').html();
    arr.push(kid);
      var id=$(this).attr('id');
})
