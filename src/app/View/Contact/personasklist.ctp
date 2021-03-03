<script src="/js/kindeditor/kindeditor-min.js"></script>
<script src="/js/kindeditor/lang/zh_CN.js"></script>
<script src="/js/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="/js/kindeditor/themes/default/default.css" />
<div class="per-con">
    <div class="nav">
        <h3 class="<?php if($cls_id==1){echo 'selected';}?>"><a href="/Person/personasklist?cls_id=1" >社会招聘</a></h3>
        <h3 class="<?php if($cls_id==2){echo 'selected';}?>"><a href="/Person/personasklist?cls_id=2" >校园招聘</a></h3>
    </div>
    <div class="per-list">
        <ul>
            <li><span><a href="/Person/addeditperson">添加职位</a></span></li>
            <li>
                <span>序号</span><span>职位</span><span>已投</span><span>状态</span><span>发布时间</span><span>更新时间</span><span>操作</span>
            </li>
            <?php foreach($list as $job){ ?>
            <li>
                <?php if($job['status']==1){$status='已发布';}else{$status='已取消';}?>
            <?php echo "<span>".$job['id']."</span><span>".$job['job_name']."</span><span>".$job['num']."</span><span>".$status."</span><span>".$job['pub_time']."</span><span>".$job['update_time']."</span><span><a
                    href='/Person/addeditperson?id=".$job["id"]."'>编辑</a><a
                    href='javascript:void(0)' onclick='del(this)'>删除</a></span>";?>
            </li>
            <?php } ?>
        </ul>
        <?php echo $page; ?>
    </div>
</div>
<script>
    function del(o){
        var id= $(o).parent().parent().children('span').eq(0).html();
        var _this=o;
        $.post(
            '/Person/delJob',
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
    }
</script>