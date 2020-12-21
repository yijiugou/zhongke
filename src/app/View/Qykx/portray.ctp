<link rel="stylesheet" href="/js/page/Page.css" />
<link rel="stylesheet" href="/css/yjkg/news.css" />
<!--[if lte IE 9]>
<link rel="stylesheet" href="/css/yjkg/ie.news.css" />
<![endif]-->
<div class="news_main">
    <div class="news_mian_banner">
        <img src="/img/yjkg/Group7.jpg">
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
    <!--<div class="news_tab">-->
    <!--<div class="news_tab_item"><span class="tabc <?php if($id=='2') echo 'active'; ?>" data-id="2">公司动态</span></div>-->
    <!--<div class="news_tab_item"><span class="tabc <?php if($id=='1') echo 'active'; ?>" data-id="1">行业资讯</span></div>-->
    <!--&lt;!&ndash;<div class="news_tab_item"><span class="tabc <?php if($id=='0') echo 'active'; ?>" data-id="0">通知公告</span></div>&ndash;&gt;-->
    <!--<div class="news_tab_item"><span class="tabc <?php if($id=='0') echo 'active'; ?>" data-id="0">媒体报道</span></div>-->
    <!--</div>-->
    <div class="news_dsj news_dsj2 active">
        <div class="news_dsj_con">
            <div class="con-left">
                <?php if(count($list)){ ?>
                <?php foreach($list as $art){ ?>
                <div class="qywh">
                    <div class="qywh_img">
                        <div class="nextCont">
                            <img src="<?php echo $art['pic_01'];?>">
                        </div>
                    </div>
                    <div class="qywh_text">
                        <div class="txtWrap">
                            <div class="time_zone">
                                <div class="titMall_time"><span><?php echo substr($art['pubdate'],8,2);?></span><br><p><?php echo substr($art['pubdate'],5  ,2);?></p></div>
                            </div>
                            <a href="/Xfpl/detail?id=<?php echo $art['id'];?>&amp;tabID=1">
                                <div class="con-content">
                                    <div class="titBig">
                                        <?php echo $art['title'];?>
                                    </div>
                                    <span class="text-from">来源:<?php echo $art['from'];?></span>
                                    <div class="titMall">
                                        <div class="titMall_con"><?php echo $art['sub_title'];?></div>
                                    </div>
                                    <img src="/upload/icon/cright.png" class="jt" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                    <style>
                        .con-left{
                            width: 810px;
                            float: left;
                        }
                        .con-right{
                            width: 320px;
                            float: left;
                            margin-left: 69px;
                        }
                        .qywh{
                            padding: 0px;
                            margin: 0;
                            margin-bottom: 60px;
                            background-color: #FFFFFF;
                        }
                        .time_zone{
                            width: 74px;
                            height: 68px;
                            text-align: center;
                            float: left;
                            margin-right: 40px;
                            display: table;
                            display: none;
                        }
                        .titMall_time{
                            height: auto;
                            margin: 0px;
                            border: 1px solid #1b1b1b;
                            font-size: 16px;
                            font-weight: normal;
                            font-stretch: normal;
                            line-height: 30px;
                            letter-spacing: 1px;
                            color: #373737;
                            height: 68px;
                            display: table-cell;
                            vertical-align: middle;
                            line-height: 20px;
                        }
                        .titMall_time p{
                            font-size: 20px;
                            color: #373737;
                        }
                        .con-content{
                            float: left;
                        }
                        .titBig {
                            font-size: 22px;
                            width: 460px;
                            font-stretch: normal;
                            line-height: 24px;
                            letter-spacing: 1px;
                            color: #2f2f2f;
                            font-weight: bold;
                            white-space: nowrap;
                            text-overflow: ellipsis;
                            overflow: hidden;
                            margin:50px 0px 14px 0px;
                        }
                        .text-from{
                            width: 460px;
                            height: 14px;
                            font-size: 14px;
                            font-weight: normal;
                            font-stretch: normal;
                            line-height: 14px;
                            letter-spacing: 1px;
                            color: #a9a9a9;
                            margin-bottom: 17px;
                            display: inline-block;
                        }
                        .titMall_con {
                            width: 460px;
                            font-size: 16px;
                            line-height: 24px;
                            text-overflow: ellipsis;
                            overflow: hidden;
                            height: 60px;
                            font-stretch: normal;
                            line-height: 30px;
                            letter-spacing: 0px;
                            color: #464646;
                            margin: 0;
                        }
                        img.jt {
                            width: 28px;
                            margin-top: 14px;
                            display: none;
                        }
                        .news_dsj{
                            margin-top: 68px;
                        }
                        .qywh_img, .nextCont{
                            height: 220px;
                            width: 300px;
                        }
                        .titMall{
                            /*height: 90px;*/
                            height: auto;
                        }
                        .qywh_text{margin: 0;width: 460px; margin-left: 49px; }
                        /*//分页*/
                        .page-con{
                            /*width: 1200px;*/
                            margin: 0 auto;
                            text-align: center;
                            display: table;
                            /*padding-bottom: 158px;*/
                        }
                        .page-con >*{
                            line-height: 45px;
                            text-align: center;
                            margin-right: 45px;
                            font-size: 16px;
                            font-weight: normal;
                            font-stretch: normal;
                            border: none;
                            display: table-cell;
                            background-color: transparent;
                            color: #757575;
                            min-width:34px ;
                        }
                        /*//分页*/
                        .news_mian_banner{
                            display: none;
                        }
                        .title1{
                            border-bottom: 2px solid #1b1b1b;
                            margin-bottom: 24px;
                        }
                        .title1 span{
                            font-size: 24px;
                            font-weight: normal;
                            font-stretch: normal;
                            line-height: 42px;
                            letter-spacing: 0px;
                            color: #313131;
                        }
                        .conbwra-left-item .tj-intro{
                            width: 322px;
                            height: 56px;
                            font-size: 18px;
                            font-weight: normal;
                            font-stretch: normal;
                            line-height: 28px;
                            letter-spacing: 0px;
                            color: #1f1f1f;
                            margin-top: 18px;
                            padding-bottom: 11px;
                            border-bottom: 1px solid #dcdcdc;
                        }
                    </style>
                </div>
                <?php } ?>
                <?php }else{ ?>
                <div class="nodata">
                    <div class="nodata_center">
                        <div class="nc_img"><img src="/img/yjkg/zx2.png"></div>
                        <div class="nc_text">暂无数据</div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="con-right">
                <div class="conbwra-left-item title1">
                    <span>相关推荐</span>
                </div>
                <div class="conbwra-left-item">
                    <img src="<?php echo $about['pic_01'];?>" />
                    <p class="tj-intro">
                        <?php if(mb_strlen($about['sub_title'])>36){ echo mb_substr($about['sub_title'],0,32).'...';}else{echo $about['sub_title'];}?>
                    </p>
                </div>
            </div>
            <div style="clear: both;"></div>

        </div>
    </div>
    <input type="hidden" name="cate_id" id="cate_id" value="<?php echo $id ?>">
    <div class="moreNews"><?php echo $pagenation;?></div>
</div>
<script src="/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<!--<script src="/js/yjkg/news.js" type="text/javascript" charset="utf-8"></script>-->
<style>
    .moreNews{display: block;background-color: transparent;}
    .news_mian_banner{width: 1200px;margin: 0 auto;}
</style>