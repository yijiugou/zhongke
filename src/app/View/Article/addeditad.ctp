<script src="/js/kindeditor/kindeditor-min.js"></script>
<script src="/js/kindeditor/lang/zh_CN.js"></script>
<script src="/js/datetimepicker/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="/js/datetimepicker/jquery.datetimepicker.css" />
<div class="arta-con">
    <form action="/Article/addeditad" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post" value="1">
        <input type="hidden" name="id" value="<?php echo isset($article)?$article['id']:'';?>">
        <ul>
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>文章名称:</span><input name="title" type="text" value="<?php echo isset($article)?$article['title']:'';?>">
                <span style="color: red;display: none;" class="tip"> 请填写文章名称</span>
            </li>
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>链接地址:</span><input name="link" type="text" value="<?php echo isset($article)?$article['link']:'';?>">
                <span style="color: red;display: none;" class="tip"> 请填写链接地址</span>
            </li>
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>发布时间:</span>
                <input type="text" name="pubdate" id="datetimepicker" value="<?php echo isset($article)?substr($article['pubdate'],0,10):date('Y-m-d');?>">
                <!--<select name="pubdate" class="pubdate_select">-->
                    <!--<option value="0">请选择</option>-->
                    <!--<?php foreach($pubdates as $t){ ?>-->
                        <!--<option value="<?php echo $t;?>"  <?php if(isset($article)&&substr($article['pubdate'],0,4)==$t){echo 'selected';} ?>><?php echo $t;?>年</option>-->
                    <!--<?php } ?>-->
                <!--</select>-->
                <span style="color: red;display: none;" class="tip"> 请选择发布时间</span>
            </li>

            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>来源:</span><input name="from" type="text"  value="<?php echo isset($article)?$article['from']:'';?>">
                <span style="color: red;display: none;" class="tip"> 请填写文章来源</span>
            </li>
            <li class="mom">
                <span><span style="color:red;margin: 0;">* </span>封面图片(2M):</span><input name="pic_01" type="file"><input name="pic_01" type="hidden"  value="<?php echo isset($article)?$article['pic_01']:'';?>">
                <?php echo isset($article)?'<img src="'.$article['pic_01'].'" alt="">':'';?>
            </li>
            
        </ul>
        <input type="submit" class="bnt" value="提交">
    </form>

</div>
<script type="text/javascript">
    function addbody(o){
        var num = parseInt($(o).parent().parent().find('.texteare').eq($(o).parent().parent().find('.texteare').length-1).data('num'))+1;
        var str = '<li data-num='+num+' class="texteare"><span class="bnt" onclick="addbody(this)">新增内容分页'+num+'</span><span onclick="deletebody(this) "  class="bnt">删除该分页'+num+'</span><textarea name="body[]" id="textare'+num+'" cols="180" rows="80" value=""></textarea><span style="color: red;display: none;" class="tip"> 请填写文章内容</span></li>'
        $(o).parent().parent().append(str);
        var editor = ParentEdit.create('#textare'+num, {
            cssData: 'body {font-family: "微软雅黑"; font-size: 14px}'
        });
        editors.push(editor)
    }
    function deletebody(o){
        $(o).parent().remove();
    }
    //KindEditor脚本
    var editors = new Array();
    var ParentEdit = null;
    KindEditor.ready(function(K) {
        ParentEdit = K;
        editor = K.create('.texteare textarea', {
            cssData: 'body {font-family: "微软雅黑"; font-size: 14px}'
        });
        editors.push(editor)
    });
    $('#datetimepicker').datetimepicker({ format: 'Y-m-d', timepicker: false });
    $(".bnt").click(function () {
        $('.tip').hide();
        if($('input[name="title"]').val()==''){
            $('input[name="title"]').next().show();
            return false;
        }
        if($('input[name="author"]').val()==''){
            $('input[name="author"]').next().show();
            return false;
        }
        if($('input[name="from"]').val()==''){
            $('input[name="from"]').next().show();
            return false;
        }
//        if($('#sub_title').val()==''){
//            $('#sub_title').next().show();
//            return false;
//        }
        if($('select[name="class"]').val()==''){
            $('select[name="class"]').next().show();
            return false;
        }
        if(!$('#datetimepicker').parent().hasClass('none')){
            if($('#datetimepicker').val()==''||$('#datetimepicker').val()==undefined){
                $('#datetimepicker').next().show();
                return false;
            }
        }
//        if(!$('select[name="pubdate"]').parent().hasClass('none')){
//            if($('select[name="pubdate"]').val()==0||$('select[name="pubdate"]').val()==undefined){
//                $('select[name="pubdate"]').next().show();
//                return false;
//            }
//        }
        $(editors).each(function (res) {
            res.sync();
        })
        // editor.sync();
        // if($('#textare1').val()==''){
        //     $('#textare1').next().show();
        //     return false;
        // }
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
</script>
<style>
    .ke-edit,.ke-edit iframe{
        height: 700px!important;
    }
    .arta-con span.bnt{
        width: auto;
        display: inline-block;
        padding: 5px;
        background: #00a0d4;
        color: #FFFFFF;
        cursor: pointer;
        margin-bottom: 10px;
    }
    .ke-dialog-default.ke-dialog{
        top: 100px;
    }
</style>