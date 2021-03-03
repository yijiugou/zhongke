<div class="social-con">
    <!--<div class="school-con">-->
        <!--<h1>校园招聘</h1>-->
        <!--<div class="step">-->
            <!--<h2>一、我们是谁：</h2>-->
            <!--<p>重样的礼品+吃不完的下午茶、水果+年度体检+形式各样的体育活动+花样企业文化活动……重样的礼品+吃不完的下午茶、水果+年度体检+形式各样的体育活动+花样企业文化活动……重样的礼品+吃不完的下午茶、水果+年度体检+形式各样的体育活动+花样企业文化活动……重样的礼品+吃不完的下午茶、水果+年度体检+形式各样的体育活动+花样企业文化活动……重样的礼品+吃不完的下午茶、水果+年度体检+形式各样的体育活动+花样企业文化活动……</p>-->
        <!--</div>-->
        <!--<div class="step">-->
            <!--<h2>二、薪酬福利：</h2>-->
            <!--<p><strong>有竞争力的薪酬+免费一年员工宿舍+员工食堂+业绩激励</strong>+双通道晋升+五险一金+高温补贴+带薪假期+放飞的年度旅游+节假日不-->
                <!--重样的礼品+吃不完的下午茶、水果+年度体检+形式各样的体育活动+花样企业文化活动……</p>-->
        <!--</div>-->
        <!--<img src="<?php echo $image;?>" alt="">-->
    <!--</div>-->
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