<link rel="stylesheet" href="/css/yjkg/index.css" />
 <!--[if lte IE 9]>
    <link rel="stylesheet" href="/css/yjkg/ie.index.css" />
    <link rel="stylesheet" href="/js/swiper/css/swiper.js" />
 <![endif]-->
<script src="/js/swiper/js/swiper.min.js"></script>
<script src="/js/main_3.js"></script>

<div class="out_w t">
    <div class="con">
        <div class="left-con">
            <div>

                <div class="swiper-container" id="sw3" style="position:relative;">
                    <div class="swiper-wrapper">
                        <?php foreach($adlist as $item){ ?>
                        <div class="swiper-slide">
                            <div class="i-banner-item">
                                <div class="i-b-con">
                                <a href="<?php echo $item['link']; ?>" target="_blank" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
                                </div>
                                <a title="<?php echo $item['title']; ?>" href="<?php echo $item['link']; ?>" target="_blank"><img alt="<?php echo $item['title']; ?>" src="<?php echo $item['pic_01']; ?>" alt=""></a>
                                
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <script>
                    var swiper3 = new Swiper('#sw3', {
                        loop: true,
                        autoplay:true,
                        pagination: {
                            el: '#sw3 .swiper-pagination',
                            clickable: true,
                        },
                    });
                </script>

            </div>

            <div>
                <div class="content">
                    <ul>
                        <li class="yn_list_li " style="display:none">
                            <a href="/Xfpl/detail?id=4827&amp;tabID=1" target="_blank" title="天洋表决及管理权被夺，ST舍得要回归国有？身陷风波的ST舍得未来走向如何？">
                                <div class="li_img">
                                    <img alt="天洋表决及管理权被夺，ST舍得要回归国有？身陷风波的ST舍得未来走向如何？" src="/upload/2020-11-30/5fc4656623b9b.jpg">
                                </div>
                                <div class="li_txt">
                                    天洋表决及管理权被夺，ST舍得要回归国有？身陷风波的ST舍得未来走向如何？                                </div>
                                
                                <div class="li_cnt">&nbsp;&nbsp;&nbsp;
                                    '11月26日晚，ST舍得发布公告称，天洋控股持有的公司控股股东沱牌舍得集团70%股权对应的表决权和管理权等将由...                                </div>
                                <div class="li_cntt"><p><span>栏目：
                                酒界观察                                </span><span>发布时间:2020-11-28 11:16:14</span></p></div>
                            </a>
                            <div class="clr"></div>
                        </li>
                    <?php foreach($alllist as $item){ ?>
                        <li class="yn_list_li ">
                            <a href="/Xfpl/detail?id=<?php echo $item['id'];?>&tabID=1" target="_blank" title="<?php echo $item['title']; ?>">
                                <div class="li_img">
                                    <img alt="<?php echo $item['title']; ?>" src="<?php echo $item['pic_01'];?>">
                                </div>
                                <div class="li_txt">
                                    <?php echo $item['title']; ?>
                                </div>
                                
                                <div class="li_cnt">&nbsp;&nbsp;&nbsp;
                                    <?php if(mb_strlen($item['sub_title'])>60){ echo mb_substr($item['sub_title'],0,56).'...';}else{echo $item['sub_title'];}?>
                                </div>
                                <div class="li_cntt"><p><span>栏目：
                                <?php echo $cates[$item['class']]['class_name']; ?>
                                </span><span>发布时间:<?php echo $item['pubdate']; ?></span></p></div>
                            </a>
                            <div class="clr"></div>
                        </li>
                    <?php } ?>
                        
                    </ul>
                </div>
            </div>
<style>
/*加载更多模块*/
.loading-more { }
.loading-more a { display:block; background-color:#fefefd; border:1px solid #efefef; text-align:center; height:50px; line-height:50px; color:#898989;}

</style>
<!--加载更多模块-->
            <div class="loading-more f16 mt-31" cid="0" style="margin-top: 0px;"><a href="javascript:void(0)">加载更多</a></div>

        </div>

        <?php  echo $this->element('pc_view_right');?>
    </div>
 


    <div class="clr"></div>
</div>


<script>


(function($){
    var page = 2,status = true;

    $(".loading-more").bind("click",function(){
    var cid = $(this).attr("cid");
    if ($("div.loading-more a").text()=="加载中....") {
    console.log("加载中....");return false;
    }
    $("div.loading-more a").text("加载中....");
    console.log('加载中...');
    $.get("/Index/more", {p: page}, function(res) {
         $("div.loading-more a").text("加载更多");status = true;
         $(".yn_list_li").last().after(res);
            page++;
    });
});



$(window).scroll(function() {
    var _bottom = $(this).scrollTop() + $(window).height() - $("div.loading-more").offset().top;
    //当内容滚动到底部时加载新的内容
    //console.log("page:"+page);
    if ($(this).scrollTop() + $(window).height() + _bottom >= $(document).height() && $(this).scrollTop() > _bottom) {
        //当前要加载的页码
        if(page > 4) return ;
        if( status == true ){status = false;
        $(".loading-more").trigger("click");
        }

    }
});


//$(".loading-more").trigger("click");


})(jQuery);

        
/*]]>*/
</script>

