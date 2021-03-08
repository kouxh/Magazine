<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="元年科技股份有限公司" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" type="text/css" href="/static/css/sjrz.css" />
    <link rel="stylesheet" type="text/css" href="/static/picss/pic.css" />
    <link rel="stylesheet" href="/static/picss/footer_header.css">
    <title>商家入住-管理会计研究</title>
</head>
<body>
@include('Pc.layout.header')
<div class="wapper">
    <div class="Home-section2">
        <img src="{{ $data['column']['Pc_advert'] }}" alt="" class="pc">
        <img src="{{ $data['column']['App_advert'] }}" alt="" class="yd">
        <a class="Home-section2-bg" href="{{ $data['column']['Pc_advert_url'] }}">
            <span class="gb"></span>
        </a>
    </div>
    <section>
        <div class="tab">
            <div class="tab-menu">
                <ul>
                    <li class="change">入驻须知</li>
                    <li>入驻流程</li>
                </ul>
            </div>
            <div class="tab-box">
                <div class="div">
                    <p class="p_two">一.入驻说明</p>
                    <p class="p_three">1.管理会计研究网目前只支持（国内）旗舰级供应商入驻，同一出版社主体只允许入驻一个旗舰店；</p>
                    <p class="p_three">2.准许出版社子公司申请入驻出版社名义的旗舰店/专营店，必须提供母公司出具的唯一授权函。</p>
                    <p class="p_two">二.入驻要求</p>
                    <p class="p_three">1、非出版社开设旗舰店的，注册资本不低于人民币100万元；</p>
                    <p class="p_three">2、开店公司依法成立3年及以上；</p>
                    <p class="p_three">3、需具备一般纳税人资格；</p>
                    <p class="p_three">4、若非出版社申请旗舰店，需提供商标注册证或申请日起已满半年的商标注册受理通知书；</p>
                    <p class="p_three">5、经营图书出版物，出版社旗舰店需提交《图书出版许可证》扫描件，非出版社旗舰店需提交《出版物经营许可证》扫描件；</p>
                    <p class="p_three">6、民营出版公司（非出版社）申请开通图书旗舰店，还需要额外提供年销售证明及出版图书证明（印刷证明，发行委托书，出版社合作协议）；</p>
                    <p class="p_three">7、非出版社开设旗舰店的，需提供10本及以上印有民营出版商注册商标或商标LOGO的书籍；</p>
                    <p class="p_three">8、若经营知识服务类目，根据业务形式，需提交如下相应的资质材料：（1）提供电信与信息服务业务经营许可证（ICP证或ICP备案号），（2）开店公司的《网络文化经营许可证》或《视听许可证》至少提供一份；</p>
                    <p class="p_three">9、所有提交资料需要加盖开店公司公章（鲜章）。</p>
                    <p class="p_three">3、需具备一般纳税人资格；</p>
                    <p class="p_two">一.入驻资质</p>
                    <table border="0" cellspacing="0" cellpadding="">
                        <tr class="tr_title">
                            <th>企业资质列表</th>
                            <th>详情 (复印件请加盖开店公司公章)</th>
                        </tr>
                        <tr>
                            <td>
                                <p>1.企业营业执照（副本）复印件</p>
                            </td>
                            <td>
                                <p>需确保未在企业经营异常名录中且所售商品在营业执照经营范围内</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2.法定代表人身份证正反面</p>
                            </td>
                            <td>
                                <p></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>3.店铺负责人身份证正反面复印件</p>
                            </td>
                            <td>
                                <p></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>4.一般纳税人资质</p>
                            </td>
                            <td>
                                <p>需具备一般纳税人资格</p>
                            </td>
                        </tr>
                        <tr class="tr_title">
                            <th>品牌资质列表</th>
                            <th>详情 (复印件请加盖开店公司公章)</th>
                        </tr>
                        <tr>
                            <td>
                                <p>1. 商标注册证或商标注册申请受理通知书</p>
                            </td>
                            <td>
                                <p>若办理过变更、转让、续展，请一并提供变更、转让、续展证明或受理通知书；</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>2.独占授权书</p>
                            </td>
                            <td>
                                <p>1、若由权利人授权开设旗舰店，需提供独占授权书（如果商标权人为自然人，则需同时提供其亲笔签名的身份证复印件）。</p>
                                <p>2、若商标权人为境内企业或个人，请下载中文版独占授权书。若商标权人为境外企业或个人，可选择下载中文版或英文版独占授权书。（如果商标权人为境内自然人，则需同时提供其亲笔签名的身份证复印件。如果商标权人为境外自然人，则需同时提供其亲笔签名的护照复印件）。</p>
                                <p class="p_four">独占授权书模板下载</p>
                            </td>
                        </tr>
                        <tr class="tr_title">
                            <th>行业资质列表</th>
                            <th>详情 (复印件请加盖开店公司公章)</th>
                        </tr>
                        <tr>
                            <td>
                                <p>1. 若经营图书出版物，出版社旗舰店需提供《图书出版许可证》，非出版社旗舰店需提供《出版物经营许可证》原件或者</p>
                                <p>2. 经营非进口出版物,非出版社开设店铺的商家，需提供至少2家及以上出版社直接授权。</p>
                                <p>3. 非出版社开设旗舰店的（卖场型旗舰店除外），需提供10本及以上印有民营出版商注册商标或商标LOGO的书籍</p>
                            </td>
                            <td>
                                <p class="p_four" style="text-align: center;">授权书模板下载</p>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="div">
                    <p class="p_one">欢迎进入管理会计研究商家入驻申请页面，整个入驻流程分为以下4个阶段，全部完成后即可上线店铺。</p>
                    <p class="p_two">阶段一：提交入驻资料</p>
                    <p class="p_three">1.填写品牌信息</p>
                    <p class="p_three">2.填写企业信息</p>
                    <p class="p_three">3.店铺命名</p>
                    <p class="p_three">4.提交审核</p>
                    <p class="p_two">阶段二：商家等待审核（约7个工作日）</p>
                    <p class="p_three">1.品牌评估</p>
                    <p class="p_three">2.资质初审</p>
                    <p class="p_three">3.资质复审</p>
                    <p class="p_two">阶段三：完善店铺信息</p>
                    <p class="p_three">1.激活商家账号</p>
                    <p class="p_three">2.完成开店任务</p>
                    <p class="p_three">3.缴纳保证金/年费</p>
                    <p class="p_two">阶段四：店铺上线</p>
                    <p class="p_three">1.发布商品</p>
                    <p class="p_one">请确保您符合以下基本入驻条件，逐条确认后即可申请入驻：</p>
                    <p class="p_one"><input type="checkbox"><label>提交的信息和证明文件的真实性。</label></p>
                    <p class="p_one"><input type="checkbox"><label>在管理会计研究网出售的商品符合国家质量标准，不侵犯他人知识产权。</label></p>
                    <p class="p_one"><input type="checkbox"><label>管理会计研究网有权对商户信息和证明文件进行不定时的抽查，以核实其真实性、合法性和效力状态，管理会计研究网有权就前述目的要求提交更多信息或证明文件。</label></p>
                    <p class="p_one last"><input type="button" name="" id="" value="立即入驻" class="Stationed" /></p>
                </div>
            </div>
        </div>


    </section>
</div>
@include('Pc.layout.footer')

</body>

</html>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery.1.7.2.min.js"></script>
<script src="js/index_pc.js" type="text/javascript" charset="utf-8"></script>
<script src="picJs/headeerGd.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="json/magazine.js"> </script>

<script type="text/javascript">
    $(".tab-menu li").click(function(index) {
        //通过 .index()方法获取元素下标，从0开始，赋值给某个变量
        var _index = $(this).index();
        //让内容框的第 _index 个显示出来，其他的被隐藏
        $(".tab-box>.div").eq(_index).show().siblings().hide();
        //改变选中时候的选项框的样式，移除其他几个选项的样式
        $(this).addClass("change").siblings().removeClass("change");
        // 		console.log("change2_"+_index)

    });
</script>
