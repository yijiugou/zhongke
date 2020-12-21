<div class="art-con">
    <div class="nav">
        <!--<?php foreach($catelist as $cate){ ?>-->
        <!--<span ids="<?php echo $cate['class_id'];?>" class="parent_change <?php if($parent_id==$cate['class_id']){echo 'selected_nav';}?>"><?php echo $cate['class_name'];?></span>-->
        <!--<?php } ?>-->
        <span class="addarticle"><a href="/Article/addeditproduct">添加商品</a></span>
    </div>
    <div class="search">
        <span>商品名称:</span>
        <input type="text" id="names" value="<?php echo $name;?>">
        <button>搜索</button>
    </div>
    <div class="con">
        <ul>
            <li>
                <!--<span>ID号</span><span>文章名称</span><span>发布时间</span><span>浏览量</span><span>操作</span>-->
                <span>ID号</span><span>商品名称</span><span>图片</span><span>操作</span>

            </li>
            <?php foreach($list as $item){ ?>
            <li>
                <!--<span><?php echo $item['id'];?></span><span><?php echo $item['title'];?></span><span><?php echo $item['created'];?></span><span><?php echo $item['view_num'];?></span><span><span class="bnt"> <a-->
                <!--href="/Article/addeditarticle?id=<?php echo $item['id'];?>">修改</a></span><span class="bnt subdel">删除</span></span>-->
                <span><?php echo $item['id'];?></span><span><?php echo $item['name'];?></span><img style="height: 180px;" src="<?php echo $item['pic_01'];?>"><span><span class="bnt"> <a
                    href="/Article/addeditproduct?id=<?php echo $item['id'];?>">修改</a></span><span class="bnt subdel">删除</span></span>
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
            window.location.href='/Article/productlist?names='+$('#names').val();
        })
        // $('.parent_change').click(function () {
        //     window.location.href='/Article/articlelist?p_id='+$(this).attr('ids');
        // })
        $('.bnt.subdel').click(function () {
            var id= $(this).parent().parent().children('span').eq(0).html();
            var _this=this;
            $.post(
                '/Article/productdel',
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