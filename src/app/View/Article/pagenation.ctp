<div class="page-con">
    <?php foreach($pages as $page){?>
        <?php if(isset($page['pagenow'])){ ?>
            <a href="<?php echo $uri,'&p=',$page['pagenow'];?>"><div><?php echo $page['content'];?></div></a>
        <?php }else{ ?>
            <div <?php if($page['content']!='···'){echo 'style="background-color: #EEE;"';}else{echo 'style="border:none;color:#000;"';}?>><?php echo $page['content'];?></div>
        <?php }?>
    <?php }?>
</div>