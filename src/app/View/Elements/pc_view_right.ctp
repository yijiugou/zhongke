        
<style>
.list-title{
    text-align: left;
    font-size: 18px;
    font-weight: bold;
    padding-left: 10px;color:#171717
}
.bk30{
    border-left: 30px solid #ae1f24;
}
</style>
        <div class="right-con">
            <div style="padding-top: 10px;
    background: #e2e2e2;">
                <div class="list-title bk30" style="">
                    专题视频
                    <a target="_blank" href="https://www.ixigua.com/home/65836826919/?source=pgc_author_name&list_entrance=shortvideo" style="
    font-size: 16px;
    float: right;
    padding-right: 16px;
">全部视频</a>
                </div>
                <div class="content" style="padding:5px;">

            <?php foreach($tuijian as $item){ ?>
                    <div class="item">
                        <a href="<?php echo $item['link']; ?>" title=""><img alt="" src="<?php echo $item['pic_01'];?>"></a>
                        <div class="titblock">
                            <a href="<?php echo $item['link']; ?>" title="" class="t1"><?php echo $item['title'];?></a>
                        </div>
                        <div class="pub-info">
                            <span><?php echo $item['pubdate']; ?></span>
                            <span class="fr">栏目：<?php echo $item['from']; ?></span>
                        </div>
                    </div>
            <?php } ?>

                </div>
            </div>

        </div>

        <style>
            .right-con .item img {
                max-width: 100%;
            }
            .right-con .item{
                text-align:left;
            }
            .fr{
                float:right;
            }
            .t1{
                font-size:20px;
                color:#ae1f24;
                font-weight: bold;
            }
            .titblock{
                padding:8px 0;
            }
            .pub-info{

            }
        </style>