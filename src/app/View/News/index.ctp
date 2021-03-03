<section class="newsTab transYT50 target dly_1 action" id="news">
    <a href="javascript:;" class="nt active">新闻资讯</a>
    <!--<a href="javascript:;" class="nt">行业新闻</a>-->
</section>
<section class="newscont">
    <div class="w1200 newsbox">
        <div class="newsfrist clearfix transYT50 target dly_3 action">

        </div>
        <div class="newsbox2 transYT50 target dly_4 action">
            <div class="newslist clearfix">
                <ul>

                    <li>
                        <a href="news_detail.aspx?t=10&amp;ContentID=127&amp;page=1">
                            <h5 class="nltxt1 eT">2021年爱斯特（成都）生物制药股份有限公司新春年会</h5>
                            <span class="nldate">2021年01月30日</span>
                            <p class="nltxt2">
                                2021年1月30日，在这全民抗疫期间，爱斯特（成都）生物制药股份有限公司2021新春年会采用线上与线下结合新方式，在四川?温江总部隆重拉开帷幕，围绕“抢抓新机遇，增创新优势，再创新辉煌”的年会主题，公司董事长郭鹏先生与各部门与分子公司代表共计42人齐聚一堂，总结不平凡的2020年并展望未来。
                            </p>
                        </a>
                    </li>

                    <li>
                        <a href="news_detail.aspx?t=10&amp;ContentID=126&amp;page=1">
                            <h5 class="nltxt1 eT">爱斯特（成都）生物制药股份有限公司生物制药项目（二期）环境影响后评价第一次公示</h5>
                            <span class="nldate">2020年10月13日</span>
                            <p class="nltxt2"></p>
                        </a>
                    </li>

                    <li>
                        <a href="news_detail.aspx?t=10&amp;ContentID=125&amp;page=1">
                            <h5 class="nltxt1 eT">聚点滴之俭，添光盘之彩</h5>
                            <span class="nldate">2020年09月30日</span>
                            <p class="nltxt2">为深入贯彻落实习近平总书记“坚决制止餐饮浪费行为，切实培养节约习惯，在全社会营造浪费可耻、节约为荣的氛围”重要指示精神，2020年9月7
                                -30日爱斯特（成都）生物制药股份有限公司工会委员会联合党委、行政部与企划部开展了光盘行动活动，树文明节俭之风，立光盘行动之本，爱斯特人在行动。</p>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- 分页 -->
            <div class="pageList">

                <!-- AspNetPager 7.3.2  Copyright:2003-2010 Webdiyer (www.webdiyer.com) -->
                <div id="ctl00_ContentPlaceHolder1_Pager">
                    <a class="plsx" disabled="disabled" style="margin-right:5px;"><i class="iconfont"></i></a><a
                        class="plnum active" href="javascript:void(0);">1</a><a href="/news.aspx?t=10&amp;page=2#news"
                        style="margin-right:5px;" class="plnum">2</a><a href="/news.aspx?t=10&amp;page=3#news"
                        style="margin-right:5px;" class="plnum">3</a><a class="morebtn plnum"
                        href="/news.aspx?t=10&amp;page=4#news" style="margin-right:5px;">...</a><a class="plsx"
                        href="/news.aspx?t=10&amp;page=2#news" style="margin-right:5px;"><i class="iconfont"></i></a>
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