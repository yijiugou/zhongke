<link rel="stylesheet" href="/css/yjkg/nproduct.css" />
<div class="ser-con">
    <image class="banner" src="<?php echo $banner; ?>"></image>
    <div class="con-main">
        <div class="title">
            <hr><span>产品服务</span><hr>
        </div>

        <div class="con-main1">
            <ul class="con-left">
                <?php foreach($list as $k=>$value){ ?>
                <?php if($k==0){ ?>
                <li>
                    <div class="list-title selected first">
                        <div class="circle" cur="<?php echo $k;?>"><?php echo $k+1;?></div>
                    </div>
                </li>
                <?php }else{ ?>
                <li>
                    <div class="list-title">
                        <div class="circle" cur="<?php echo $k;?>"><?php echo $k+1;?></div>
                    </div>
                </li>
                <?php } ?>
                <?php } ?>
            </ul>
            <div class="con-center">
                白酒产业链 —
                <p>Liquor</p>
                <p>Industry chain</p>
            </div>
            <div class="con-right">
                <div class="list-con-container">
                    <?php foreach($list as $key=>$item){ ?>
                        <div class="con-right-list <?php if($key==0){echo 'current';}?>">
                            <h3><?php echo $item['title']; ?></h3>
                            <div class="content"><?php echo $item['content']; ?></div>
                            <div class="img-con">
                                <?php foreach($item['image'] as $kk=> $img){ ?>
                                <image class="c<?php echo $kk;?>" src="<?php echo $img; ?>"></image>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="clear: both"></div>
<script>
    $('.circle').click(function(){
        var current=$(this).attr('cur');
        $('.current').fadeOut(500,function () {
            $('.current').removeClass('current');
            $('.con-right-list').eq(current).fadeIn(200).addClass('current');
        });
        $('.circle').parent().removeClass('selected');
        $(this).parent().addClass('selected');
    })
</script>