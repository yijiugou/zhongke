<div class="art-con">
    <div class="nav">
        <?php foreach($catelist as $cate){ ?>
            <span id="<?php echo $cate['class']['class_id'];?>" onclick="goto(<?php echo $cate['class']['class_id'];?>)"><?php echo $cate['class']['class_name'];?></span>
        <?php } ?>
        <span class="addarticle"><a href="/Article/addeditarticle">添加文章</a></span>
    </div>
    <div class="search">
        <span>文章名称:</span>
        <input type="text" id="names" value="<?php echo $title;?>">
        <!--<select name="cates" id="cates">-->
            <!--<?php foreach($catelist as $cates){ ?>-->
                <!--<?php foreach($cates['child'] as $cate){ ?>-->
                    <!--<?php if($cate['parent_id']==$parent_id){ ?>-->
                        <!--<?php $str=$cate_id==$cate['class_id']?'selected':''; ?>-->
                        <!--<?php echo'<option value="'.$cate['class_id'].'" '.$str.'>'.$cate['class_name'].'</option>';?>-->
                    <!--<?php }?>-->
                <!--<?php }?>-->
            <!--<?php }?>-->
        <!--</select>-->
        <button>搜索</button>
    </div>
    <div class="con">
        <ul>
            <li>
                <!--<span>ID号</span><span>文章名称</span><span>发布时间</span><span>浏览量</span><span>操作</span>-->
                <span>ID号</span><span>文章名称</span><span>发布时间</span><span>操作</span>

            </li>
            <?php foreach($list as $item){ ?>
                <li>
                    <!--<span><?php echo $item['id'];?></span><span><?php echo $item['title'];?></span><span><?php echo $item['created'];?></span><span><?php echo $item['view_num'];?></span><span><span class="bnt"> <a-->
                        <!--href="/Article/addeditarticle?id=<?php echo $item['id'];?>">修改</a></span><span class="bnt subdel">删除</span></span>-->
                    <span><?php echo $item['id'];?></span><span><?php echo $item['title'];?></span><span><?php echo $item['created'];?></span><span><span class="bnt"> <a
                        href="/Article/addeditarticle?id=<?php echo $item['id'];?>">修改</a></span><span class="bnt subdel">删除</span></span>
                </li>
            <?php } ?>
        </ul>
        <!--//分页-->
        <?php echo $pagenation;?>
    </div>
    <style>

    </style>
    <script>
        function goto(i){
            window.location.href='/Article/articlelist?class_id='+i;
            return false;
        }
        $('button').click(function () {
            console.log($("#names").val(),$("select").val());
            // window.location.href='/Article/articlelist?p_id='+$('.selected_nav').attr('ids')+'&title='+$("#names").val()+'&class_id='+$("select").val();
            window.location.href='/Article/articlelist?p_id='+$('.selected_nav').attr('ids')+'&title='+$("#names").val()+'&class_id='+$("select").val();
        })
        $('.parent_change').click(function () {
            window.location.href='/Article/articlelist?p_id='+$(this).attr('ids');
        })
        $('.bnt.subdel').click(function () {
            var id= $(this).parent().parent().children('span').eq(0).html();
            var _this=this;
            $.post(
                '/Article/del',
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
</div>