
<?php if(count($list)){ ?>
    <?php foreach($list as $comment){ ?>
      <div class="comment-item">
        <div class="avatar"></div>
        <div class="comment-detail">
          <div class="user-info"><a class="name" target="_blank" rel="noopener noreferrer">
            <?php echo substr($comment['ukcode'],-6); ?>
          </a><span class="create-time"><?php echo time_tran2($comment['pub_time']); ?></span></div>
          <p class="content">
              <?php $comment['content'] = stripcslashes($comment['content']); ?>
              <?php $comment['content'] = htmlspecialchars_decode($comment['content']); ?>
              <?php echo $comment['content']; ?>
          </p>
          <div class="footer"><span reply="<?php echo $comment['id']; ?>" class="reply-btn">回复</span>
              <?php if($comment['reply_num']){ ?>
              <span reply="<?php echo $comment['id']; ?>" class="reply-num"
                >&nbsp;⋅&nbsp;<?php echo $comment['reply_num']; ?>条回复<i
                  class="bui-icon icon-arrow_down"
                ></i></span>
                <?php } ?>
            <!--
            <span class="digg" title="点赞">0&nbsp;<i class="bui-icon icon-thumbsup_line">赞</i></span>
          -->
          </div>
        <div class="comment-reply-list" style="display: none;"><div></div></div></div>
      </div>
      <?php } ?>
<?php } ?>