<div class="concept-con">
    <div class="concept-title">
        <span class="sp-title">人才理念</span>
        <hr>
        <span class="title-con"><?php echo $title;?></span>
    </div>
    <div class="concept-list-con">
        <?php foreach($list as $k=>$item){ if($k>=4){break;}?>
            <div class="concept-list t<?php echo $k;?>">
                <p><?php echo $item['title'];?></p>
                <span><?php echo $item['content'];?></span>
            </div>
        <?php } ?>
    </div>
</div>