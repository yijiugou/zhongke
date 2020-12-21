<link rel="stylesheet" href="/js/page/Page.css" />
<link rel="stylesheet" href="/css/yjkg/news.css" />
<!--[if lte IE 9]>
<link rel="stylesheet" href="/css/yjkg/ie.news.css" />
<![endif]-->
<div class="news_main">
    <div class="news_mian_banner">
        <img src="/upload/icon/banner_1.jpg">
    </div>
    <div class="news_title">
        <div class="news_mark_left">
            <div class="line"></div>
        </div>
        <div class="news_mark">新闻资讯</div>
        <div class="news_mark_right">
            <div class="line"></div>
        </div>
    </div>

    <div class="gr-con">
        <ul>
            <style>
                .news_mian_banner{
                    margin: 0 auto;
                    width: 1200px;
                }
                .gr-con{
                    padding-top: 40px;
                    width: 1200px;
                    margin: 0 auto;
                }
                .gr-con li{
                    float: left;
                    width: 300px;
                    height: 353px;
                    border: 1px solid #eeeeee;
                    border-right: none;
                    margin-bottom: 37px;
                    box-sizing: border-box;
                }
                .gr-con li.last{
                    border-right:1px solid #eeeeee;
                }
                .gr-con .gr-item-con{
                    width: 600px;
                }
                .gr-item-con .item-list-con{
                    background-color: #fff;
                    height: 350px;
                    width: 298px;
                    float: left;
                }
                .gr-item-con .item-list-con .list-img-con {
                    width: 100%;
                    padding: 35px 35px 0;
                    box-sizing: border-box;
                    height: 270px;
                }
                .gr-item-con .item-list-con .list-img-con img{
                    width: 100%;
                    height: 100%;
                }
                .gr-item-con .item-list-con .item-name{
                    display: block;
                    margin: 40px auto 0px;
                    font-size: 18px;
                    font-weight: normal;
                    font-stretch: normal;
                    line-height: 18px;
                    letter-spacing: 0px;
                    color: #4b4b4b;
                    max-width: 240px;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    overflow: hidden;
                    text-align: center;
                }
                .gr-item-con .item-detail-con{
                    float: left;
                    display: none;
                    /*position: absolute;*/
                    /*right: 0;*/
                    /*top: 0;*/
                    width: 299px;
                    height: 352px;
                    padding-left: 16px;
                    box-sizing: border-box;
                }
                .gr-item-con .item-detail-con h3{
                    width: 240px;
                    font-size: 18px;
                    font-weight: normal;
                    font-stretch: normal;
                    line-height: 18px;
                    letter-spacing: 0px;
                    color: #414141;
                    margin: 60px 0 25px;
                }
                .gr-item-con .item-detail-con p{
                    width: 240px;
                    font-size: 15px;
                    font-weight: normal;
                    font-stretch: normal;
                    line-height: 16px;
                    letter-spacing: 0px;
                    color: #6a6a6a;
                    margin-bottom: 14px;
                    /*margin-top: 20px;*/
                }
                .gr-item-con:hover .item-detail-con{
                    display: block;
                    background-color: #f6f6f6;
                    border: solid 2px #a32126;
                    border-left: none;
                }
                .gr-item-con:hover .item-list-con{
                    background-color: #f6f6f6;
                    border: solid 2px #a32126;
                    border-right: none;
                    height: 348px;
                }
                .gr-item-con:hover .item-list-con .list-img-con{
                    padding: 45px 20px 0;
                    height: 300px;
                }
                .gr-item-con:hover .item-list-con .item-name{
                    display: none;
                }
                .hn{
                    opacity: 0;
                    filter:Alpha(opacity=0)
                }
            </style>
            <?php $count = count($lists);foreach($lists as $k=>$list){?>
                <?php if(($k%4 == 3)||($count-1==$k)){ ?>
                <a href="/xfpl/activity_detail?id=<?php echo $list['id'];?>"><li class="last">
                <?php }else{ ?>
                <a href="/xfpl/activity_detail?id=<?php echo $list['id'];?>"><li>
                <?php } ?>
                    <div class="gr-item-con">
                        <div class="item-list-con">
                            <div class="list-img-con">
                                <img src="<?php echo $list['pic_01'];?>" alt="">
                            </div>
                            <span class="item-name">
                                <?php echo $list['name'];?>
                            </span>
                        </div>
                        <div class="item-detail-con">
                            <h3><?php echo $list['name'];?></h3>
                            <?php foreach($list['attr'] as $attr){ ?>
                            <p><?php echo $attr;?></p>
                            <?php }?>
                        </div>
                    </div>
                </li>
            </a>
            <?php } ?>
        </ul>
        <div style="clear: both;"></div>
    </div>
</div>
<script>
    $('.item-list-con').mouseover(function () {
        if($(this).parent().parent().parent().next().offset()!=undefined){
            if ($(this).parent().parent().parent().next().offset().top == $(this).parent().parent().parent().offset().top){
                $(this).parent().parent().parent().next().find('li').addClass('hn');
            }
        }
    }).mouseleave(function () {
        if($(this).parent().parent().parent().next().offset()!=undefined) {
            if ($(this).parent().parent().parent().next().offset().top == $(this).parent().parent().parent().offset().top) {
                $(this).parent().parent().parent().next().find('li').removeClass('hn');
            }
        }
    })
</script>