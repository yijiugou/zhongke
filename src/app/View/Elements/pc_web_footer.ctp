    <!-- 底部微信二维码弹框 -->
    <section class="ftb-tk">
        <div class="ftb-bot">
            <p class="fb-title clearfix">微信<i class="close-fbewm iconfont">&#xe608;</i></p>
            <div class="fb-pic">
                <img src="static/picture/wx.png">
            </div>
        </div>
    </section>
    <footer class="footerbg">
        <div class="updown"><i class="iconfont">&#xe60f;</i></div>
        <div class="footerWrap">
            <div class="fwleft clearfix">
                <div class="fritem">
                    <h5 class="fltitle">四川中科赛亚生物科技有限公司</h5>
                    <div class="flway">
                        <a href="javascript:;" target="_blank">地址 : 四川天府新区眉山市仁寿县视高街道天府云城A区3号楼1单元</a>
                        <a href="tel:+86-28-8266xxxx">电话：+86-28-8266xxxx</a>
                        <a href="javascript:void(0);">传真：+86-28-8266xxxx</a>
                        <a href="javascript:void(0);">邮编：611xxx</a>
                    </div>
                </div>
                <div class="fritem">
                    <h5 class="fltitle">营销中心</h5>
                    <div class="flway">
                        <a href="tel:+86-28-8266xxxx">电话：+86-28-8266xxxx</a>
                        <a href="mailto:xxx@xxxx.com">邮箱：xxx@xxx.com</a>
                    </div>
                </div>

                <div class="fritem">
                    <h5 class="fltitle">关联公司</h5>
                    <div class="bfs-select">
                        <p class="bfs-select-xs"></p>
                        <div class="bfs-zk">
                            <a href="javascript:;" target="_blank">四川中科赛亚生物科技有限公司</a>
                                
                        </div>
                    </div>
                    <div class="fi-gz" >
                        <span class="gz-txt">关注我们：</span>
                        <a href="javascript:void(0);" class="gz-c gz-wechat"><i class="iconfont">&#xe621;</i></a>
                        <a href="javascript:;" class="gz-c" target="_blank"><i class="iconfont">&#xe821;</i></a>
                        <a href="javascript:;" class="gz-c"><i class="iconfont">&#xe676;</i></a>
                        <a href="" class="gz-c" target="_blank"><i class="iconfont">&#xe696;</i></a>
                    </div>
                    <div class="flway">
                        <a href="javascript:;" target="_blank" style="font-size:14px"> </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- 底部 end -->

    
    <script src="static/js/plugin.js"></script>
    <script src="static/js/page.js"></script>
    <script src="static/js/index.js"></script>
    <script src="static/js/jquery.num.js"></script>
    <script type="text/javascript">
        jQuery(window).load(function () {
            //开始所有的计时器
            $('.ang').each(count);
        });
    </script>

    <div style="display: none">
        
    </div>
    <script>
        (function ($) {
            $.getUrlParam = function (name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if (r != null)
                    return unescape(r[2]);
                return null;
            }
        })(jQuery)
        if ($('.bfs-zk a').length > 0) {
            $('.bfs-select-xs').text($('.bfs-zk a').eq(0).text())
        } else { $('.bfs-select-xs').text("友情链接") }

        $("#searchs").keyup(function (event) {
            var keyvalue = event.which;
            var vakes = $(this).val();
            if (keyvalue == 13) {
                if (vakes == '') {
                    $(this).focus();
                    return;
                }
                window.location = 'search_result.aspx?keyword=' + encodeURIComponent(vakes);
            }
        });
        $("#submits").click(function () {
            var searchtxt = $("#searchs");
            if (searchtxt.val() == '') {
                searchtxt.focus();
                return;
            } else {
            /*
                window.location = 'search_result.aspx?keyword=' + encodeURIComponent(searchtxt.val());
               */
            }
        })
        $("#searchst").keyup(function (event) {
            var keyvalue = event.which;
            var vakes = $(this).val();
            if (keyvalue == 13) {
                if (vakes == '') {
                    $(this).focus();
                    return;
                }
                window.location = 'search_result.aspx?keyword=' + encodeURIComponent(vakes);
            }
        });
        $("#submitst").click(function () {
            var searchtxt = $("#searchst");
            if (searchtxt.val() == '') {
                searchtxt.focus();
                return;
            } else {
                window.location = 'search_result.aspx?keyword=' + encodeURIComponent(searchtxt.val());
            }
        })
        var IsChecked = $.getUrlParam("chanage");
        if (IsChecked != null) {
        } else {
            var sessionData = sessionStorage.getItem('data');
            console.log(sessionData)
            if (sessionData === null) {
                WebLocation();
                console.log(sessionData)
            }
        }
        sessionStorage.setItem('data', 1);//存一个值

        function WebLocation() {
            var nowurl = window.location.protocol + "//" + window.location.host;
            //判断浏览器的首选语言
            //var lang = (navigator.appName == "Netscape" ? navigator.language : navigator.userLanguage).toLowerCase();
            var lang = 'ERROR';
            console.log(lang)

        }
    </script>
</body>
</html>

