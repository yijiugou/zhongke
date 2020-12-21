<div class="social-con">
    <ul>
        <?php foreach($jobs as $k=>$job){ ?>
            <li class="<?php if($k==0){echo 'current';} ?>">
                <div class="p"><div class="dot"></div><?php echo $job['job_name'];?><img src="<?php if($k==0){echo '/img/yjkg/17.png';}else{echo '/img/yjkg/16.png';} ?>" alt="" class="dire"></div>
                <div class="job-con">
                    <div class="job-detail">
                        <?php echo $job['job_content'];?>
                    </div>
                    <!--<button job-id="<?php echo $job['id'];?>" class="job-bnt">投递简历</button>-->
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<script>
    //点击查看工作
    $('.social-con li .p').click(function(){
        $('.social-con li').removeClass('current').find('.job-con').hide().prev().find('img').attr('src','/img/yjkg/16.png');
        $(this).parent().find('.job-con').slideDown('slow').prev().find('img').attr('src','/img/yjkg/17.png').parent().parent().addClass('current');
    })
    //投简历
    $('.job-bnt').click(function(){
        alert('功能未开放')
    })
</script>