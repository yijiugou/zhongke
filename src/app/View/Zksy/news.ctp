

    
    <div id="particles-js" class="particles-js">
    </div>
    <!-- 内容 -->

    <!-- 新闻tab -->
    <section class="newsTab transYT50 target dly_1" id="news">
        <a href="javascript:;" class="nt active">新闻资讯</a>
        <!--<a href="javascript:;" class="nt">行业新闻</a>-->
    </section>
    <section class="newscont">
        <div class="w1200 newsbox">
            <div class="newsfrist clearfix transYT50 target dly_3">
                
            </div>
            <div class="newsbox2 transYT50 target dly_4">
                <div class="newslist clearfix">
                    <ul>
                            
                                <li>
                                    <a href="javascript:;">
                                        <h5 class="nltxt1 eT">聚点滴之俭，添光盘之彩</h5>
                                        <span class="nldate">2020年09月30日</span>
                                        <p class="nltxt2">为深入贯彻落实习近平总书记“坚决制止餐饮浪费行为，切实培养节约习惯，在全社会营造浪费可耻、节约为荣的氛围”重要指示精神，2020年9月7 -30日爱斯特（成都）生物制药股份有限公司工会委员会联合党委、行政部与企划部开展了光盘行动活动，树文明节俭之风，立光盘行动之本，爱斯特人在行动。</p>
                                    </a>
                                </li>
                            
                                <li>
                                    <a href="javascript:;">
                                        <h5 class="nltxt1 eT">光盘行动</h5>
                                        <span class="nldate">2020年09月09日</span>
                                        <p class="nltxt2">为了响应习近平总书记最近提出的“坚决制止餐饮浪费行为，切实培养节约习惯”，在爱斯特工会、党支部、行政部与企划部的策划和组织下，开展了“ 光盘行动”计划，通过21天节惯养成法引导全体员工养成节约粮食的好节惯，唤醒爱斯特家人们内心对粮食的珍惜。活动开始就受到全体职工的积极响应和支持。</p>
                                    </a>
                                </li>
                            
                    </ul>
                </div>
                <!-- 分页 -->
                <div class="pageList">
                    
<!-- AspNetPager 7.3.2  Copyright:2003-2010 Webdiyer (www.webdiyer.com) -->
<div id="ctl00_ContentPlaceHolder1_Pager">
<a class="plsx" disabled="disabled" style="margin-right:5px;"></a><span style="margin-right:5px;font-weight:Bold;color:red;">1</span><a href="javascript:;" style="margin-right:5px;">2</a><a href="javascript:;" style="margin-right:5px;">3</a><a class="morebtn" href="javascript:;" style="margin-right:5px;">...</a><a class="plsx" href="javascript:;" style="margin-right:5px;"></a>
</div>
<!-- AspNetPager 7.3.2  Copyright:2003-2010 Webdiyer (www.webdiyer.com) -->


                </div>
                <script>
                    //页码操作
                    $(".plsx:first").html("<i class=\"iconfont\">&#xe680;</i>");
                    $(".plsx:last").html("<i class=\"iconfont\">&#xe681;</i>");
                    $('.pageList a').addClass('plnum');
                    $('.plsx').removeClass('plnum');
                    var content = $('.pageList span').html();
                    var news = '<a class="plnum active" href="javascript:void(0);">' + content + '</a>';
                    $('.pageList span').after(news);
                    $('.pageList span').remove();
                </script>
            </div>
        </div>
    </section>
