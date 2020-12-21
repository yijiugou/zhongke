<div class="cate-con">
    <ul>
        <li><span class="addCate"><a href="/Article/addeditcategory">添加分类</a></span></li>
        <?php foreach($list as $item){ ?>
            <li>
                <div><span style="font-weight:bold;"><?php echo $item['class_name'];?></span></div>
            </li>
            <?php foreach($item['child'] as $it){ ?>
                <li>
                    <div><span><?php echo $it['class_id'];?></span><span><?php echo $it['class_name'];?></span><span class="bnt"><a
                            href="/Article/addeditcategory?class=<?php echo $it['class_id'];?>">修改</a></span><span class="bnt subdel">删除</span></div>
                </li>
            <?php } ?>
        <?php }?>
    </ul>
</div>
<script>
    $('.bnt.subdel').click(function () {
        var id= $(this).parent().children('span').eq(0).html();
        $.post(
            '/Article/delcate',
            {'id':id},
            function(res){
                if(res==1){
                    window.location.reload();
                }else{
                    alert('删除失败');
                }
            }
        )
    })
</script>