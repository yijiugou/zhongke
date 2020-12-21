<div class="out_w t">
    <div class="con">
        <div class="left-con">

            <div>
                <div class="content">
                    <ul>
            <?php if(count($list)){ ?>
            <?php foreach($list as $art){ ?>
                        <li class="yn_list_li ">
                            <a href="/Xfpl/detail?id=<?php echo $art['id'];?>&amp;tabID=1" target="_blank" title="<?php echo $art['title'];?>">
                                <div class="li_img">
                                    <img alt="<?php echo $art['title'];?>" src="<?php echo $art['pic_01'];?>">
                                </div>
                                <div class="li_txt">
                                    <?php echo $art['title'];?>
                                </div>

                                <div class="li_cnt">&nbsp;&nbsp;&nbsp; <?php echo $art['sub_title'];?>..</div>
                                <div class="li_cntt"><p><span>来源：<?php echo $art['from'];?></span><span>发布时间:<?php echo $art['pubdate'];?></span></p></div>
                            </a>
                            <div class="clr"></div>

                        </li>
            <?php } ?>
            <?php }else{ ?>
                <div class="nodata">
                    <div class="nodata_center">
                        <div class="nc_img"><img src="/img/yjkg/zx2.png"></div>
                        <div class="nc_text">暂无数据</div>
                    </div>
                </div>
            <?php }?>
                        
                    </ul>
                </div>
            </div>
            
            <div class="moreNews"><?php echo $pagenation;?></div>

        </div>

        <?php  echo $this->element('pc_view_right');?>
    </div>
 


    <div class="clr"></div>
</div>
