<div class="per-a-con">
    <form action="" method="post">
        <ul>
            <li class="pe">
                <span>职位:</span><input type="text" name="job_name" placeholder="输入职位名称" value="<?php if(isset($job['job_name'])){echo $job['job_name'];}?>">
                <input type="hidden" name="id" value="<?php if(isset($job['id'])){echo $job['id'];}?>">
            </li>
            <li class="pe">
                <span>状态:</span><div class="ststus"><label for="status1"><input type="radio" <?php if(isset($job['status'])&&$job['status']!=2){echo 'checked';}?> id="status1" name="status" value="1">发布</label><label for="status2"><input type="radio" <?php if(isset($job['status'])&&$job['status']==2){echo 'checked';}?> name="status" id="status2" value="2">取消</label></div>
            </li>
            <li class="pe">
                <span>类别:</span><select name="cls_id">
                    <option value="1" <?php if(isset($job['cls_id'])&&$job['cls_id']!=2){echo 'selected';}?>>社会招聘</option>
                    <option value="2" <?php if(isset($job['cls_id'])&&$job['cls_id']==2){echo 'selected';}?>>校园招聘</option>
                </select>
            </li>
            <li>
                <span>详情:</span><textarea name="job_content" id="textare" cols="200" rows="30"><?php if(isset($job['job_content'])){echo $job['job_content'];}?></textarea>
            </li>
        </ul>
        <input type="submit" class="bnt sub" value="提交">
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
//    editor.sync();
//    $('#textare')
</script>