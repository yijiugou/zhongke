<div class="catea-con">
    <form action="/Article/addeditcategory" method="post">
        <ul>
            <li><span>分类类型:</span>
                <div class="parent">
                    <?php foreach($category as $cate){ ?>
                        <?php if($cate['class_id']==$parent_id){ ?>
                            <label for="parent1"><input type="radio" id="parent1" name="parent_id" checked value="<?php echo $cate['class_id'];?>"><span ><?php echo $cate['class_name']?></span></label>
                        <?php }else{?>
                            <label for="parent2"><input type="radio" id="parent2" name="parent_id" value="<?php echo $cate['class_id'];?>"><span ><?php echo $cate['class_name']?></span></label>
                        <?php }?>
                    <?php }?>
                </div>
                <span style="color: red;display: none;" class="tip"> 请选择分类</span>
            </li>
            <li>
                <span>分类名称:</span><input type="text" name="class_name" value="<?php if(isset($cate_item)){echo $cate_item['class_name'];}?>">
                <span style="color: red;display: none;" class="tip"> 请填写分类名称</span>
            </li>
        </ul>
        <input type="hidden" name="class" value="<?php if(isset($cate_item)){echo $cate_item['class_id'];}?>">
        <input type="hidden" name="post" value="1">
        <input type="submit" class="bnt" value="提交">
    </form>
</div>
    <script>
        $(".bnt").click(function () {
            $('.tip').hide();
            if($('input[name="parent_id"]:checked').val()==undefined){
                $('.parent').next().show();
                return false;
            }
            if($('input[name="class_name"]').val()==''){
                $('input[name="class_name"]').next().show();
                return false;
            }
            $(this).submit();
        })
    </script>