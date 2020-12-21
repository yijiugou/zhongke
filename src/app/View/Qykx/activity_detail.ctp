<link rel="stylesheet" href="/js/page/Page.css" />
<link rel="stylesheet" href="/css/yjkg/news.css" />
<!--[if lte IE 9]>
<link rel="stylesheet" href="/css/yjkg/ie.news.css" />
<![endif]-->
<script src="/js/swiper/js/swiper.min.js"></script>
<div class="news_main">
    <div class="detail-con">
        <div class="gr-con">
            <div class="head_con">
                <img src="<?php echo $data['grdata']['gr_head_pic'];?>" alt="">
            </div>
            <h3 class="gr-score">G•R官荣评分：<?php echo $data['score'];?></h3>
            <div class="honer-con"><img src="/img/yjkg/honer.png" alt=""></div>
            <p class="intro-title">G•R酒评：</p>
            <div class="intro-content">
                <?php echo $data['score_desc'];?>
            </div>

            <p class="gr-name">评分责任人：<?php echo $data['grdata']['gr_name'];?></p>
            <?php foreach($data['grdata']['gr_attr'] as $attr){ ?>
                <p class="gr-attr"> <?php echo $attr;?></p>
            <?php }?>
            <!--<p class="gr-attr">国家级品酒师</p>-->
            <!--<p class="gr-attr">白酒技术工程师</p>-->
        </div>
        <style>
            .detail-con{
                width: 1200px;
                margin: 37px auto 0;
            }
            .detail-con > div{
                width: 400px;
                box-sizing: border-box;
                float: left;
                height: 600px;
            }
            .head_con{
                width: 71px;
                height: 71px;
                border-radius: 71px;
                margin: 58px auto 0;
                overflow: hidden;
            }
            .gr-score{
                width: 300px;
                height: 20px;
                font-family: PingFang-SC-Bold;
                font-size: 20px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 20px;
                letter-spacing: 4px;
                color: #c9aa5f;
                margin: 31px auto 0;
                text-align: center;
            }
            .honer-con{
                width: 360px;
                margin: 12px auto 0;
            }
            .honer-con img{
                width: 100%;
            }
            .intro-title{
                width: 300px;
                height: 16px;
                font-family: PingFang-SC-Medium;
                font-size: 17px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 20px;
                letter-spacing: 3px;
                color: #6d6d6d;
                text-align: center;
                margin: 45px auto 0;
            }
            .intro-content{
                width: 340px;
                max-height: 100px;
                font-family: PingFang-SC-Medium;
                font-size: 15px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 26px;
                letter-spacing: 0px;
                color: #9b9b9b;
                margin: 13px auto 0;
                text-align: center;
            }
            .gr-name{
                width: 300px;
                font-family: PingFang-SC-Medium;
                font-size: 17px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 26px;
                letter-spacing: 0px;
                color: #6d6d6d;
                margin: 65px auto 12px;
                text-align: center;
            }
            .gr-attr{
                max-width: 300px;
                font-family: PingFang-SC-Medium;
                font-size: 15px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 26px;
                letter-spacing: 0px;
                color: #9b9b9b;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
                margin: 0 auto;
                text-align: center;
            }
            .pro-img-con{
                padding:96px 73px 111px 79px;
                background-color: #eeeeee;
            }
            .pro-img-con img{
                width: 100%;
            }
            .intro-con{padding: 60px 21px 0;background-color: #332f2e;}
            .intro-con h1{
                max-width: 300px;
                font-family: PingFang-SC-Medium;
                font-size: 30px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 30px;
                letter-spacing: 1px;
                color: #cdb46a;
                text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;
                padding-left: 5px;
            }
            hr{
                width: 100%;
                margin-top: 30px;
                /*height: 1px;*/
                /*background-color: #4f4f4f;*/
                border: 0.5px solid #4f4f4f;
            }
            .intro-con p{
                max-width: 300px;
                height: 16px;
                font-family: PingFang-SC-Light;
                font-size: 16px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 16px;
                letter-spacing: 0px;
                color: #a2843a;
                padding-left: 9px;
                margin-top: 30px;
            }
            .intro-swiper-con{
                padding-left: 9px;
                height: 260px;
                width: 340px;
                margin-top: 18px;
                overflow: hidden;

                font-family: PingFang-SC-ExtraLight;
                font-size: 14px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 24px;
                letter-spacing: 0px;
                color: #f4f4f4;
                overflow: auto;
            }
            .intro-con .nav{
                width: 32px;
                height: 33px;
                border: solid 1px #979797;
                text-align: center;
                line-height: 31px;
                margin: 39px 0px 0 17px;
                display: inline-block;
                color: #979797;
                cursor: pointer;
            }
            ::-webkit-scrollbar
            {
                width: 2px;
                height: 2px;
                background-color: #332f2e;
            }

            ::-webkit-scrollbar-track
            {
                -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.3);
                border-radius: 4px;
                background-color: #332f2e;
            }
            ::-webkit-scrollbar-thumb
            {
                border-radius: 4px;
                -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,.3);
                background-color: #A8A8A8;
            }
        </style>
        <div class="pro-img-con">
            <img src="<?php echo $data['pic_02'];?>" alt="" style="width: 100%;">
        </div>
        <div class="intro-con">
            <h1><?php echo $data['name'];?></h1>
            <hr>
            <p class="intro-tip">玖久说酒：</p>
            <!--<div class="swiper-container intro-swiper-con" id="sw1">-->
                <!--<div class="swiper-wrapper">-->
                    <!--<?php foreach($data['intro'] as $intro){ ?>-->
                        <!--<div class="swiper-slide"><?php echo $intro;?></div>-->
                    <!--<?php }?>-->
                    <!--&lt;!&ndash;<div class="swiper-slide">郎酒，一个拥有百年历史的中国白酒知名品牌，是我国名酒园中的一株新秀。郎酒始于1903年，产自川黔交界有“中国美酒河”之称的赤水河畔。从“絮志酒厂”、“惠川糟房”到“集义糟房”的“回沙郎酒”开始，已有100年悠久历史。1979年评为全国优质酒；1984年在第四届全国名酒评比中，郎酒以“酱香浓郁，醇厚净爽，幽雅细腻，回甜味长”的独特香型和风味而闻名全国，首次荣获全国名酒的桂冠，并获金奖；1985年参加亚太博览会展出。四川名酒有郎酒、泸州老窖、五粮液、剑南春、全兴、沱牌等。通常被誉为四川“六朵金花”。</div>&ndash;&gt;-->
                    <!--&lt;!&ndash;<div class="swiper-slide">郎酒，一个拥有百年历史的中国白酒知名品牌，是我国名酒园中的一株新秀。郎酒始于1903年，产自川黔交界有“中国美酒河”之称的赤水河畔。从“絮志酒厂”、“惠川糟房”到“集义糟房”的“回沙郎酒”开始，已有100年悠久历史。1979年评为全国优质酒；1984年在第四届全国名酒评比中，郎酒以“酱香浓郁，醇厚净爽，幽雅细腻，回甜味长”的独特香型和风味而闻名全国，首次荣获全国名酒的桂冠，并获金奖；1985年参加亚太博览会展出。四川名酒有郎酒、泸州老窖、五粮液、剑南春、全兴、沱牌等。通常被誉为四川“六朵金花”。</div>&ndash;&gt;-->
                <!--</div>-->
            <!--</div>-->
            <div class="intro-swiper-con">
                <?php echo implode('',$data['intro']);?>
            </div>
            <hr>
            <span class="nav left" data-id="<?php echo $prev;?>"><</span>
            <span class="nav right" data-id="<?php echo $next;?>">></span>
        </div>
        <p style="clear: both;"></p>
    </div>
    <script>
        var swiper = new Swiper('#sw1', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: '.nav.left',
                prevEl: '.nav.right',
            },
        });
        $('.nav').click(function () {
            var id = $(this).data('id');
            if (!id){
                return false;
            }else{
                window.location.href = window.location.protocol+'//'+window.location.hostname+window.location.pathname+'?id='+id;
            }
        })
    </script>
</div>