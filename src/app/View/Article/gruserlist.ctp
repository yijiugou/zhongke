<div class="art-con">
    <div class="nav">
        <span class="addarticle"><a href="/Article/addeditgruser">添加官荣人员</a></span>
    </div>
    <div class="search">
        <span>名称:</span>
        <input type="text" id="names" value="<?php echo $name;?>">
        <button>搜索</button>
    </div>
    <div class="con">
        <ul>
            <li>
                <!--<span>ID号</span><span>文章名称</span><span>发布时间</span><span>浏览量</span><span>操作</span>-->
                <span>ID号</span><span>名称</span><span>头像</span><span>操作</span>

            </li>
            <?php foreach($list as $item){ ?>
            <li>
                <!--<span><?php echo $item['id'];?></span><span><?php echo $item['title'];?></span><span><?php echo $item['created'];?></span><span><?php echo $item['view_num'];?></span><span><span class="bnt"> <a-->
                <!--href="/Article/addeditarticle?id=<?php echo $item['id'];?>">修改</a></span><span class="bnt subdel">删除</span></span>-->
                <span><?php echo $item['id'];?></span><span><?php echo $item['gr_name'];?></span><img  src="<?php echo $item['gr_head_pic'];?>"><span><span class="bnt"> <a
                    href="/Article/addeditgruser?id=<?php echo $item['id'];?>">修改</a></span><span class="bnt subdel">删除</span></span>
            </li>
            <?php } ?>
        </ul>
        <!--//分页-->
        <?php echo $pagenation;?>
    </div>
    <style>

    </style>
    <script>
        $('button').click(function () {
            console.log($("#names").val(),$("select").val());
            window.location.href='/Article/gruserlist?names='+$('#names').val();
        })
        // $('.parent_change').click(function () {
        //     window.location.href='/Article/articlelist?p_id='+$(this).attr('ids');
        // })
        $('.bnt.subdel').click(function () {
            var id= $(this).parent().parent().children('span').eq(0).html();
            var _this=this;
            $.post(
                '/Article/gruserdel',
                {'id':id},
                function(res){
                    if(res==1){
                        window.location.reload();
//                        $(_this).parent().parent().remove();
                    }else{
                        alert('删除失败');
                    }
                }
            )
        })
    </script>
    <style>
        .art-con .con li{
            height: auto;
        }
    </style>
</div>