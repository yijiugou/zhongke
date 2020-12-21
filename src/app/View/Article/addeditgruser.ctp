<script src="/js/kindeditor/kindeditor-min.js"></script>
<script src="/js/kindeditor/lang/zh_CN.js"></script>
<script src="/js/datetimepicker/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="/js/datetimepicker/jquery.datetimepicker.css" />
<div class="arta-con">
    <form action="/Article/addeditgruser" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post" value="1">
        <input type="hidden" name="id" value="<?php echo isset($article)?$article['id']:'';?>">
        <ul>
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>名称:</span><input name="gr_name" type="text" value="<?php echo isset($article)?$article['gr_name']:'';?>">
                <span style="color: red;display: none;" class="tip"> 请填写官荣名称</span>
            </li>
            <!--<li class="mom">-->
            <!--<span><span style="color:red;margin: 0;">* </span>文章分类:</span>-->
            <!--<select name="class" class="category_select">-->
            <!--<?php foreach($category as $item){ ?>-->
            <!--<?php foreach($item['child'] as $it){ ?>-->

            <!--<option  value="<?php echo $it['class_id'];?>" <?php if(isset($article)){if($it['class_id']==$article['class']){echo 'selected';if($it['class_name']=='大事记'){$w=1;}}}?>><?php echo $item['class_name'].'&#45;&#45;'.$it['class_name'];?></option>-->
            <!--<?php } ?>-->
            <!--<?php } ?>-->
            <!--</select>-->
            <!--<span style="color: red;display: none;" class="tip"> 请选择文章分类</span>-->
            <!--&lt;!&ndash;<li class="mom <?php if(!isset($w)||$w!=1){echo 'none';}?>">&ndash;&gt;-->
            <!--<li class="mom">-->
            <!--<span><span style="color:red;margin: 0;">* </span>发布时间:</span>-->
            <!--<input type="text" name="pubdate" id="datetimepicker" value="<?php echo isset($article)?substr($article['pubdate'],0,10):date('Y-m-d');?>">-->
            <!--&lt;!&ndash;<select name="pubdate" class="pubdate_select">&ndash;&gt;-->
            <!--&lt;!&ndash;<option value="0">请选择</option>&ndash;&gt;-->
            <!--&lt;!&ndash;<?php foreach($pubdates as $t){ ?>&ndash;&gt;-->
            <!--&lt;!&ndash;<option value="<?php echo $t;?>"  <?php if(isset($article)&&substr($article['pubdate'],0,4)==$t){echo 'selected';} ?>><?php echo $t;?>年</option>&ndash;&gt;-->
            <!--&lt;!&ndash;<?php } ?>&ndash;&gt;-->
            <!--&lt;!&ndash;</select>&ndash;&gt;-->
            <!--<span style="color: red;display: none;" class="tip"> 请选择发布时间</span>-->
            <!--</li>-->
            <!--<li class="mom">-->
                <!--<span><span style="color:red;margin: 0;">* </span>G·R官荣评分:</span><input name="score" type="text"  value="<?php echo isset($article)?$article['score']:'';?>">-->
                <!--<span style="color: red;display: none;" class="tip"> 请填G·R官荣评分</span>-->
            <!--</li>-->
            <!--<li class="mom">-->
                <!--<span><span style="color:red;margin: 0;">* </span>G·R酒评:</span><textarea name="score_desc" type="text"  value="<?php echo isset($article)?$article['score_desc']:'';?>"><?php echo isset($article)?$article['score_desc']:'';?></textarea>-->
                <!--<span style="color: red;display: none;" class="tip"> 请填写文章来源</span>-->
            <!--</li>-->
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>头像(2M):</span><input name="pic_01" type="file"><input name="gr_head_pic" type="hidden"  value="<?php echo isset($article)?$article['gr_head_pic']:'';?>">
                <?php echo isset($article)?'<img src="'.$article['gr_head_pic'].'" alt="">':'';?>
            </li>
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>官荣属性(就是荣誉什么的):<span class="bnt" onclick="addattr(this)">添加属性</span></span>
                <div>
                    <?php if(count($article['gr_attr'])){ ?>
                    <?php foreach($article['gr_attr'] as $attr){ ?>
                    <input name="gr_attr[]" type="text"  value="<?php echo $attr; ?>">
                    <?php } ?>
                    <?php }else{ ?>
                    <input name="gr_attr[]" type="text"  value="">
                    <?php } ?>
                </div>
                <span style="color: red;display: none;" class="tip"> 请填酒属性</span>
            </li>
            <!--<li class="mom">-->
                <!--<span><span style="color:red;margin: 0;">* </span>其他评价:<span onclick="addintro(this)">添加评价</span></span>-->
                <!--<div>-->
                    <!--<?php if(count($article['intro'])){ ?>-->
                    <!--<?php foreach($article['intro'] as $intro){ ?>-->
                    <!--<textarea name="intro[]" type="text"  value="<?php echo $intro; ?>"><?php echo $intro; ?></textarea>-->
                    <!--<?php } ?>-->
                    <!--<?php }else{ ?>-->
                    <!--<textarea name="intro[]" type="text" ></textarea>-->
                    <!--<?php } ?>-->
                <!--</div>-->
                <!--<span style="color: red;display: none;" class="tip"> 请填酒评价</span>-->
            <!--</li>-->
            <!--<li class="mom">-->
            <!--<span>图片1(2M):</span><input name="pic_02" type="file"><input name="pic_02" type="hidden"  value="<?php echo isset($article)?$article['pic_02']:'';?>">-->
            <!--<?php echo isset($article)?'<img src="'.$article['pic_02'].'" alt="">':'';?>-->
            <!--</li>-->
            <!--<li class="mom">-->
            <!--<span>图片2(2M):</span><input name="pic_03" type="file"><input name="pic_03" type="hidden"  value="<?php echo isset($article)?$article['pic_03']:'';?>">-->
            <!--<?php echo isset($article)?'<img src="'.$article['pic_03'].'" alt="">':'';?>-->
            <!--</li>-->
            <!--<li class="mom">-->
            <!--<span>图片3(2M):</span><input name="pic_04" type="file"><input name="pic_04" type="hidden"  value="<?php echo isset($article)?$article['pic_04']:'';?>">-->
            <!--<?php echo isset($article)?'<img src="'.$article['pic_04'].'" alt="">':'';?>-->
            <!--</li>-->
            <!--<li class="mom">-->
            <!--<span><span style="color:red;margin: 0;">* </span>简述:</span><br><textarea name="sub_title" id="sub_title" cols="80"-->
            <!--rows="10"><?php echo isset($article)?$article['sub_title']:'';?></textarea>-->
            <!--<span style="color: red;display: none;" class="tip"> 请填写文章简介</span>-->
            <!--</li>-->
            <!--<li>-->
            <!--<textarea name="body" id="textare" cols="180" rows="120" value=""><?php echo isset($article)?$article['body']:'';?></textarea>-->
            <!--<span style="color: red;display: none;" class="tip"> 请填写文章内容</span>-->
            <!--</li>-->
        </ul>
        <input type="submit" class="bnt" value="提交">
    </form>

</div>
<script type="text/javascript">
    //KindEditor脚本
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#textare', {
            cssData: 'body {font-family: "微软雅黑"; font-size: 14px}'
        });
    });
    $('#datetimepicker').datetimepicker({ format: 'Y-m-d', timepicker: false });
    $(".bnt").click(function () {
//         $('.tip').hide();
//         if($('input[name="title"]').val()==''){
//             $('input[name="title"]').next().show();
//             return false;
//         }
//         if($('input[name="author"]').val()==''){
//             $('input[name="author"]').next().show();
//             return false;
//         }
//         if($('input[name="from"]').val()==''){
//             $('input[name="from"]').next().show();
//             return false;
//         }
// //        if($('#sub_title').val()==''){
// //            $('#sub_title').next().show();
// //            return false;
// //        }
//         if($('select[name="class"]').val()==''){
//             $('select[name="class"]').next().show();
//             return false;
//         }
//         if(!$('#datetimepicker').parent().hasClass('none')){
//             if($('#datetimepicker').val()==''||$('#datetimepicker').val()==undefined){
//                 $('#datetimepicker').next().show();
//                 return false;
//             }
//         }
//        if(!$('select[name="pubdate"]').parent().hasClass('none')){
//            if($('select[name="pubdate"]').val()==0||$('select[name="pubdate"]').val()==undefined){
//                $('select[name="pubdate"]').next().show();
//                return false;
//            }
//        }
//         editor.sync();
//         if($('#textare').val()==''){
//             $('#textare').next().show();
//             return false;
//         }
        $(this).submit();
    })

    //大事记的时间选择框
    $('.category_select').change(function(){
        if($('.category_select option:selected').html()=='关于我们--大事记'){
            $('.pubdate_select').parent().removeClass('none');
            $('#datetimepicker').parent().removeClass('none');
        }else{
            $('#datetimepicker').parent().addClass('none');
        }
    })

    function addintro(o){
        var str = '<textarea name="intro[]" type="text" ></textarea>';
        $(o).parent().next().append(str);
    }
    function addattr(o){
        var str = '<input name="gr_attr[]" type="text"  value="">';
        $(o).parent().next().append(str);
    }
</script>