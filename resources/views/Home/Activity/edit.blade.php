<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理会记研究</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../../layui/css/font.css">
    <link rel="stylesheet" href="../../layui/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../layui/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="../../layui/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <input type="hidden" value="{{ $data -> id }}" name="id">
            <label for="username" class="layui-form-label">
                标题
            </label>
            <div class="layui-input-inline" style="width: 300px;">
                <input type="text" id="username" name="title" required="" lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> title }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">开始时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" id="start_at" name="start_at" placeholder="1949-01-01" lay-verify="required" value="{{ $data -> start_at }}">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">* 如果有结束时间请按:2019-01-01格式填写</span>
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label">结束时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" id="end_at" name="end_at" placeholder="1949-01-01" lay-verify="required" value="{{ $data -> end_at }}">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">* 如果是当天请勿填写结束时间</span>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                限制人数
            </label>
            <div class="layui-input-inline">
                <input type="text" id="limit_num" name="limit_num" placeholder="如：0，不可是非数字" required="" lay-verify="num"
                       autocomplete="off" class="layui-input" value="{{ $data -> limit_num }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 如果为0则为无限制</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">活动分类</label>
            <div class="layui-input-block">
                @if($data -> address == '线上')
                    <div class="divv" style="display: inherit;width: 100px;float: left;"><input type="radio" name="address" value="线上" title="线上" checked="" id="address" checked></div>
                    <div class="divTrue"  style="display: inherit;width: 100px;float: left;"><input type="radio" name="address" value="线下" title="线下" id="address"></div>
                @else
                    <div class="divv" style="display: inherit;width: 100px;float: left;"><input type="radio" name="address" value="线上" title="线上" checked="" id="address" ></div>
                    <div class="divTrue"  style="display: inherit;width: 100px;float: left;"><input type="radio" name="address" value="线下" title="线下" id="address" checked></div>
                @endif
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                详细地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc_address" name="desc_address" required=""
                       autocomplete="off" class="layui-input" placeholder="如：北京市海淀区领航科技大厦" value="{{ $data -> desc_address }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">* 线下活动必须填写</span>
            </div>
        </div>

        @if($data -> ticket == '1')
            <div class="layui-form-item">
                <label class="layui-form-label">票种</label>
                <div class="layui-input-block">

                    <div class="divv" style="display: inherit;width: 100px;float: left;"><input type="radio" name="ticket" value="0" title="免费" checked="" id="ticket"></div>
                    <div class="divTrue"  style="display: inherit;width: 100px;float: left;"><input type="radio" name="ticket" value="1" title="收费" id="ticket"></div>

                </div>
            </div>

            <div class="layui-form-item" style="display: none" id="price">
                <label for="username" class="layui-form-label">
                    价钱
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="price" name="price" placeholder="如：0.00" lay-verify="num"
                           autocomplete="off" class="layui-input" value="{{ $data -> price }}">
                </div>
            </div>
        @else
            <div class="layui-form-item">
                <label class="layui-form-label">票种</label>
                <div class="layui-input-block">

                    <div class="divv" style="display: inherit;width: 100px;float: left;"><input type="radio" name="ticket" value="0" title="免费"  id="ticket"></div>
                    <div class="divTrue"  style="display: inherit;width: 100px;float: left;"><input type="radio" name="ticket" value="1" title="收费" checked="" id="ticket"></div>

                </div>
            </div>

            <div class="layui-form-item" id="price">
                <label for="username" class="layui-form-label">
                    价钱
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="price" name="price" placeholder="如：0.00" lay-verify="num"
                           autocomplete="off" class="layui-input" value="{{ $data -> price }}">
                </div>
            </div>
        @endif

        <div class="layui-form-item">
            <label class="layui-form-label">维度选择</label>
            <div class="layui-input-inline">
                <select name="hy">
                    @if(empty($data -> hy))
                        <option value="0">行业</option>
                    @endif
                    <option value="0">行业</option>
                    @foreach($data -> hang as $key => $val)
                        @if($data -> hy == $val -> id)
                        <option value="{{$val -> id}}" selected>{{$val -> title}}</option>
                        @else
                            <option value="{{$val -> id}}" >{{$val -> title}}</option>
                        @endif
                     @endforeach
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="zy">
                    @if(empty($data -> zy))
                        <option value="0">业务/兴趣</option>
                    @endif
                    <option value="0">业务/兴趣</option>
                    @foreach($data -> xing as $key => $val)
                        @if($data -> zy == $val -> id)
                            <option value="{{$val -> id}}" selected>{{$val -> title}}</option>
                        @else
                            <option value="{{$val -> id}}" >{{$val -> title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="qt">
                    @if(empty($data -> qt))
                        <option value="0">群体/职业</option>
                    @endif
                    <option value="0">群体/职业</option>
                    @foreach($data -> zhi as $key => $val)
                        @if($data -> qt == $val -> id)
                            <option value="{{$val -> id}}" selected>{{$val -> title}}</option>
                        @else
                            <option value="{{$val -> id}}" >{{$val -> title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                城市
            </label>
            <div class="layui-input-inline">
                <input type="text" id="host" name="city"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{ $data -> city }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                报名地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="host" name="sign_address"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{ $data -> sign_address }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <div style="display:none" id = 'activity'>
                <label for="username" class="layui-form-label" >
                    类型
                </label>
                <div class="layui-input-inline">
                    <select name="type" >
                        @if($data -> type == 1)
                            <option value="1" selected>主办</option>
                            <option value="2">协办</option>
                            <option value="3">其他</option>
                        @elseif($data -> type == 2)
                            <option value="1" >主办</option>
                            <option value="2" selected>协办</option>
                            <option value="3">其他</option>
                        @else
                            <option value="1" >主办</option>
                            <option value="2" >协办</option>
                            <option value="3" selected>其他</option>
                        @endif
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                主办方
            </label>
            <div class="layui-input-inline">
                <input type="text" id="host" name="host"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{ $data -> host }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">主办方介绍</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" style="width: 65%" name="sponsor_desc">{{ $data -> sponsor_desc }}</textarea>
            </div>
        </div>

        <div class="layui-form-item" >
            <label for="username" class="layui-form-label">
                协办方
            </label>
            <div class="layui-input-inline">
                <input type="text" id="co-sponsor" name="co_sponsor"  lay-verify="required"
                       autocomplete="off" class="layui-input" value="{{ $data -> co_sponsor }}">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                图片
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="test3"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="img" id="img" value="{{ $data -> img }}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                线上二维码
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="uppercode"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="uppercode" id="uppercode1" value="{{ $data -> uppercode }}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                议程
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="agenda"><i class="layui-icon"></i>上传文件</button>

            </div>
            <div>
                <input type="hidden" name="agenda" id="agenda" value="{{ $data -> agenda }}">

            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">嘉宾</label>
            <div class="layui-input-block">

                @foreach($data -> rw as $v)
                    <input type="checkbox" name="guest" lay-skin="primary" value="{{ $v -> id }}" title="{{ $v -> name }}">
                @endforeach

            </div>
        </div>

        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                活动详情描述
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="describe" name="describe" style="display: none;"  lay-verify="describe" >{{ $data -> describe }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                注意事项
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="careful" name="careful" style="display: none;"  lay-verify="careful" >{{ $data -> careful }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                联系人
            </label>
            <div style="margin-left:110px;width: 60%">
                <textarea  class="layui-textarea" id="contacts" name="contacts" style="display: none;"  lay-verify="contacts" >{{ $data -> contacts }}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label"></label>
            <button  type="button" class="layui-btn" lay-filter="add" lay-submit="">编辑</button>
        </div>
    </form>
</div>

<script>
    index = '';
    layui.use(['form','layer','layedit','laydate'], function(){
        var $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;

        //给CheckBox赋值
        $(document).ready(function () {

            var unitType = [];
            unitType = "{{ $data -> guest }}" .split(",");
            for (var j = 0; j < unitType.length; j++) {
                var unitTypeCheckbox = $("input:checkbox[name='guest']");
                for (var i = 0; i < unitTypeCheckbox.length; i++) {
                    if (unitTypeCheckbox[i].value == unitType[j]) {
                        unitTypeCheckbox[i].checked = true;
                    }
                }
            }
            form.render();
        });


        //显示金钱
        $(".divTrue").click(function () {
            $('#price').show();
        })

        //隐藏金钱
        $(".divv").click(function () {
            $('#price').hide();
        })

        //日期时间选择器
        laydate.render({
            elem: '#start_at'
            ,type: 'datetime'
        });
        //日期时间选择器
        laydate.render({
            elem: '#end_at'
            ,type: 'datetime'
        });

        //插入图片
        layedit.set({
            uploadImage: {
                url: '/uploadImg' //接口url
                ,type: 'post' //默认post
            }
        });

        indexs1 = layedit.build('careful' ,{
            height: 260 //设置编辑器高度
            ,tool:[
                'strong' //加粗
                ,'italic' //斜体
                ,'underline' //下划线
                ,'del' //删除线
                ,'|' //分割线
                ,'left' //左对齐
                ,'center' //居中对齐
                ,'right' //右对齐
                ,'|' //分割线
                ,'link' //超链接
                ,'unlink' //清除链接
                ,'image' //插入图片
            ]
        });
        indexs2 = layedit.build('contacts' ,{
            height: 260 //设置编辑器高度
            ,tool:[
                'strong' //加粗
                ,'italic' //斜体
                ,'underline' //下划线
                ,'del' //删除线
                ,'|' //分割线
                ,'left' //左对齐
                ,'center' //居中对齐
                ,'right' //右对齐
                ,'|' //分割线
                ,'link' //超链接
                ,'unlink' //清除链接
                ,'image' //插入图片
            ]
        });

        //建立编辑器
        indexs3 = layedit.build('describe' ,{
            height: 260 //设置编辑器高度
            ,tool:[
                'strong' //加粗
                ,'italic' //斜体
                ,'underline' //下划线
                ,'del' //删除线
                ,'|' //分割线
                ,'left' //左对齐
                ,'center' //居中对齐
                ,'right' //右对齐
                ,'|' //分割线
                ,'link' //超链接
                ,'unlink' //清除链接
                ,'image' //插入图片
            ]
        });

        //自定义验证规则
        form.verify({
            describe: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,describe: function(value){
                layedit.sync(indexs3);
            }
        });

        //自定义验证规则
        form.verify({
            careful: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,careful: function(value){
                layedit.sync(indexs1);
            }
        });

        //自定义验证规则
        form.verify({
            contacts: function(value){
                //console.log(value.length);
                if(value.length < 5){
                    return '内容至少得5个字符啊';
                }
            }
            ,contacts: function(value){
                layedit.sync(indexs2);
            }
        });

        //监听提交
        form.on('submit(add)', function(data){

            //获取checkbox[name='like']的值
            var arr = new Array();
            $("input:checkbox[name='guest']:checked").each(function(i){
                arr[i] = $(this).val();
            });
            data.field.guest = arr.join(",");//将数组合并成字符串

            console.log(data);
            // return false;
            $.ajax({
                url:'/home/artivity/DoEdit',
                type: 'post',
                dataType:'json',
                data:{data:data.field},
                success:function(res){

                    if(res.err_code === 10000){
                        layer.alert('修改成功' , function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                    }else{
                        layer.alert('修改失败' , function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        });
                    }
                }
            })
        });
    });

</script>

<script>
    //普通文件上传
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        //指定允许上传的文件类型
        upload.render({
            elem: '#test3'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $('#img').val(res.data.src)
                    $('#test3').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#test3').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")

                }
            }
        });

        upload.render({
            elem: '#uppercode'
            ,url: '/uploadImg'
            ,accept: 'file' //普通文件
            ,headers:{'type' : 'full'}
            ,done: function(res){
                //console.log(res)
                if(res.code == 0){

                    $('#uppercode1').val(res.data.src)
                    $('#uppercode').after("<i class=\"layui-icon layui-icon-ok\" style=\"margin-left: 30px;color:green ;\" id=\"duigou\"></i>")

                }else{

                    $('#uppercode').after("<i class=\"layui-icon layui-icon-close\" style=\"margin-left: 30px;color:red ;\" id=\"duigou\"></i>")
                    $('#duigou').after("<span style='color:red;display: block'>"+res.msg+"</span>")

                }
            }
        });

    })
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>