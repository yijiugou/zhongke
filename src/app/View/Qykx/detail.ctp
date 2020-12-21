<link rel="stylesheet" href="/css/yjkg/index.detail.css" />
<!--[if lte IE 9]>
<link rel="stylesheet" href="/css/yjkg/ie.index.detail.css" />
<![endif]-->
<script src="/js/jquery_qrcode/jquery.qrcode.min.js"></script>
<script src="/js/swiper/js/swiper.min.js"></script>
<div class="news_mian_banner">
    <img src="/img/yjkg/Group7.jpg" style="width: 100%;">
</div>
<div class="contentwrap">
    <div class="news_title">
        <div class="news_mark_left">
            <div class="line"></div>
        </div>
        <div class="news_mark">新闻资讯</div>
        <div class="news_mark_right">
            <div class="line"></div>
        </div>
    </div>

    <div class="conbwra">
        <div class="conbwra-left">
            
            <?php  echo $this->element('pc_view_right');?>

        </div>
        <div class="conbwra-right">
            <nav class="navation">您的位置：首页 > 观察消费 > 正文</nav>
            <div class="title"><?php echo $info['title'] ?></div>
            <div class="sec_title">
                <div class="author a-fino">作者：<?php echo $info['author'] ?></div>
                <div class="fsource a-fino">来源：<?php echo $info['from'] ?></div>
                <div class="updated a-fino">发布时间：<?php echo $info['pubdate'] ?></div>
            </div>
            <?php if(count($info['body'])==1){ ?>
            <div class="content"><?php echo $info['body'][0];?></div>
            <?php }else{ ?>
            <?php foreach($info['body'] as $k=>$body){ ?>
            <?php if($k==0){?>
            <div class="content"><?php echo $body;?></div>
            <?php } ?>
            <div class="content" style="display: none;"><?php echo $body;?></div>
            <?php } ?>
            <div class='nav' data-pagesum="<?php echo count($info['body']);?>"></div>
            <!--<div class='nav' data-pagesum="30">daohang</div>-->
            <?php }?>
        </div>
        <div class="artback">
            <span style="display: inline-block;margin-right: 24px;">分享到</span>
            <span><a class="backa" href="javascript:void(0);" onclick="shareTo('wechat')" title=""><img src="/upload/icon/wx.png" alt=""></a></span>
            <span><a class="backa" href="javascript:void(0);" onclick="shareTo('qzone')" title=""><img src="/upload/icon/qq.png" alt=""></a></span>
            <span><a class="backa" href="javascript:void(0);" onclick="shareTo('sina')" title=""><img src="/upload/icon/wb.png" alt=""></a></span>
        </div>
        <div class="linebo"></div>
        <div class="nextNews">
            <div>
                <div class="nextMark">下一篇 : </div>
                <div class="nextCont"><?php if(!empty($next['title'])) {?>
                    <a href="/Xfpl/detail?id=<?php echo $next['id'] ?>&tabID=<?php echo $tabID ?>" title=""><?php echo $next['title'] ?></a>
                    <?php }else{ ?>
                    暂无下一条数据
                    <?php } ?>
                </div>
            </div>
            <div>
                <div class="nextMark">上一篇</div>
                <div class="nextCont"><?php if(!empty($prev['title'])) {?>
                    <a href="/index/detail?id=<?php echo $prev['id'] ?>&tabID=<?php echo $tabID ?>" title=""><?php echo $prev['title'] ?></a>
                    <?php }else{ ?>
                    暂无上一条数据
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="linebo"></div>
    </div>
    <div class="ad"></div>
</div>
<div id="qrcode"></div>
<script>
    $('document').ready(function () {
        var count = $('.nav').data('pagesum');
        var pagenow = 1;
        page(pagenow,count);
    })
    function page(pagenow,pagecount){
        var end = pagecount;
        var navsize = 10;
        var step = 5;
        var start = 1;
        if (end>navsize){
            end = start+navsize-1;
            if (pagenow>=end){
                start = Math.ceil((pagenow-navsize)/step)*step+step;
                end = start+navsize-1;
            }
            if (end>=pagecount){
                end = pagecount;
                start = end-navsize+1;
                if (start<1){
                    start = 1;
                }
            }
        }
        var pages = new Array();
        if (start>=step){
            pages.push('<span class="clickable">1</span><span  class="slh">···</span>')
        }
        for (var i = start;i<=end;i++){
            if (i==pagenow){
                pages.push('<span>'+i+'</span>')
            } else{
                pages.push('<span class="clickable">'+i+'</span>')
            }
        }
        if (end<pagecount){
            pages.push('<span class="slh">···</span><span class="clickable">'+pagecount+'</span>')
        }
        $('.nav').html(pages.join(' '));
        $('.nav').find('.clickable').click(function () {
            $('.content').hide(200).eq(($(this).html()-1)).show(200);
            page($(this).html(),pagecount)
        })
    }
</script>
<style>
    .nav{
        text-align: center;
        margin: 49px 0 45px;
    }
    .nav span{
        font-size: 16px;
        font-weight: normal;
        padding: 0 10px;
        color: #b92e32;
    }
    .nav span.clickable{
        color:#757575;
        cursor: pointer;
    }
    .nav span.slh{
        color:#757575;
    }
    .nextNews{
        margin-left:70px ;
        display: table;
    }
    .nextNews > div{
        display: table-cell;
        width: 375px;
    }
    .conbwra-right{
        border: 0.5px solid #e5e5e5;
        /*padding-bottom:96px ;*/
    }
    .linebo {
        border: 0.5px solid #e5e5e5;
        width: 777px;
        margin-left: 32px ;
    }
    .nextMark{
        background-color: transparent;
        font-size: 14px;
        font-weight: normal;
        font-stretch: normal;
        line-height: 30px;
        letter-spacing: 0px;
        color: #313131;
        display: inline-block;
        overflow: hidden;
    }
    .nextCont{
        display: inline-block;
        max-width: 298px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .nextCont a:hover{
        color: #ac0000;
    }
    .artback{
        display: table;
        line-height: 35px;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        line-height: 35px;
        letter-spacing: 1px;
        color: #4e4e4e;
        padding: 16px 0 32px;
        margin-bottom: 0px;
        margin-left: 75px;
    }
    .artback>*{
        display: table-cell;
        vertical-align: middle;
    }
    a.backa{
        background: transparent;
        padding: 0px 7px;
    }
    .conbwra{
        margin-top: 17px;
        padding-bottom: 96px;
    }
    .news_mian_banner{
        display: none;
    }
    .navation{
        width: 1100px;
        height: 17px;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        line-height:16px;
        letter-spacing: 1px;
        color: #777676;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        margin:0 0 39px -12px;

    }
    .conbwra-right{
        width: 838px;
        border: none;
        border-right: 2px solid #eeeeee;
    }
    .title{
        margin: 0 auto;
        width: 654px;
        height: auto;
        text-align: center;
        font-size: 33px;
        font-weight: normal;
        font-stretch: normal;
        line-height: 55px;
        letter-spacing: 2px;
        color: #353535;
        white-space: pre-wrap;
    }
    .sec_title{
        font-weight: normal;
        font-stretch: normal;
        line-height: 55px;
        letter-spacing: 1px;
        padding-bottom: 4px;
        color: #a9a9a9;
        border-bottom: 1px solid #e5e5e5;
        width: 777px;
        margin:  0 auto;
        /*box-shadow: 0 1px #e5e5e5;*/
    }
    .content{
        margin:  0 auto;
        padding-top: 45px;
    }
    .conbwra-left{
        width: 340px;
        padding: 0 0 96px 20px;
        box-sizing: border-box;
    }
    .conbwra-left-item{
        width: 320px;
        margin-left: 0px;
    }
    .conbwra-left-item.title1{
        font-size: 25px;
        font-weight: normal;
        font-stretch: normal;
        line-height: 45px;
        letter-spacing: 0px;
        color: #313131;
        border-bottom: 2px solid #1b1b1b;
        margin-bottom: 22px;
    }
    .tj-intro{
        font-size: 18px;
        font-weight: normal;
        font-stretch: normal;
        line-height: 28px;
        letter-spacing: 0px;
        color: #1f1f1f;
        padding: 18px 0 11px;
        border-bottom: 1px solid #dcdcdc;
        margin-bottom: 46px;
    }
    #qrcode{
        display: none;
        position: fixed;
        buttom: 0px;
        left: 45%;
        top: 40%;
        background-color: rgba(0,0,0,0.5);
        height: 300px;
        width: 300px;
        padding: 22px;
        box-sizing: border-box;
    }
    .bgray{
        background-color: rgba(0,0,0,0.5);
    }
    .contentwrap img{
        max-width: 720px;
    }
    .swiper-pagination-bullet-active{
        background: #b92e32;
    }
</style>
<script>
    function shareTo(stype){
        var ftit = '';
        var flink = '';
        var lk = '';
        //获取文章标题
        ftit = $('.title').text();
        //获取网页中内容的第一张图片
        flink = $('.content img').eq(0).attr('src');
        if(typeof flink == 'undefined'){
            flink='';
        }
        //当内容中没有图片时，设置分享图片为网站logo
        if(flink == ''){
            lk = window.location.protocol+'://'+window.location.host+'/upload/icon/logo.png';
        }
        //如果是上传的图片则进行绝对路径拼接
        if(flink.indexOf('/uploads/') != -1) {
            lk = window.location.protocol+'://'+window.location.host+flink;
        }
        //百度编辑器自带图片获取
        if(flink.indexOf('ueditor') != -1){
            lk = flink;
        }
        //qq空间接口的传参
        if(stype=='qzone'){
            window.open('https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content'));
        }
        //新浪微博接口的传参
        if(stype=='sina'){
            window.open('http://service.weibo.com/share/share.php?url='+document.location.href+'?sharesource=weibo&title='+ftit+'&pic='+lk+'&appkey=2706825840');
        }
        //qq好友接口的传参
        if(stype == 'qq'){
            window.open('http://connect.qq.com/widget/shareqq/index.html?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content')+'&desc=php自学网，一个web开发交流的网站');
        }
        //生成二维码给微信扫描分享，php生成，也可以用jquery.qrcode.js插件实现二维码生成
        if(stype == 'wechat'){
            // window.open('http://zixuephp.net/inc/qrcode_img.php?url=http://zixuephp.net/article-1.html');
            wxshare(window.location.href)
        }
    }
    function wxshare(url){
        $('#qrcode').qrcode(url).show();
        // $('body').addClass('bgray')
        setTimeout(function () {
            $('body').bind("click",function(){
                $(this).removeClass('bgray').unbind('click');
                $('#qrcode').html('').hide();
            });
        },500)
    }
    var swiper = new Swiper('#sw1', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            // clickable: true,
        },
        navigation: {
            nextEl: '.nav.left',
            prevEl: '.nav.right',
        },
    });
</script>