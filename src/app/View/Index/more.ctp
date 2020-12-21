
<?php foreach($list as $item){ ?>
    <li class="yn_list_li ">
        <a href="/Xfpl/detail?id=<?php echo $item['id'];?>&tabID=1" target="_blank">
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


