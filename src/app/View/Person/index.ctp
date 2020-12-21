<link rel="stylesheet" href="/css/yjkg/rc.css" />
<div class="con">
    <img src="<?php echo $banner;?>" alt="" class="banner">
    <div class="titles">
        <hr><span>人才发展</span><hr>
    </div>
    <div class="nav">
        <span class="<?php if($id==0){echo 'selected';} ?>" sr="concept" num=0>人才理念</span>
        <span class="zj <?php if($id==1){echo 'selected';} ?>" sr="social" num=1>社会招聘</span>
        <span class="<?php if($id==2){echo 'selected';} ?>" sr="school" num=2>校园招聘</span>
    </div>
    <div class="nav-con">
        <?php echo $concept; ?>
    </div>
</div>

<script>
    var num=0
    var _data=[];  //防止切换重复发起请求
    //绑定点击换内容
    $('.nav span').click(function(){
        var sr=$(this).attr('sr');
        num = $(this).attr('num');
        if(!_data[num]){
            var url = '/Person/'+sr;
            $.ajax({
                type: "POST",
                url: url,
                data: {},
                success: rdCallback,
                dataType: 'json'
            });
        }else{
            changeNav(_data[num])
        }
    })
    //回调函数
    function rdCallback(res){
        if(res.status==1){
            changeNav(res.data);
            _data[num]=res.data;
        }else{
            console.log('出现错误');
        }
    }
    function changeNav(data){
        $('.nav-con').html(data);
        $('.nav span').removeClass('selected').eq(num).addClass('selected');
    }
</script>