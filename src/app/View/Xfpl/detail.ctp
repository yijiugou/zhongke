<link rel="stylesheet" href="/css/yjkg/index.detail.css" />
<!--[if lte IE 9]>
<link rel="stylesheet" href="/css/yjkg/ie.index.detail.css" />
<![endif]-->
<script src="/js/jquery_qrcode/jquery.qrcode.min.js"></script>
<script src="/js/swiper/js/swiper.min.js"></script>
<div class="news_mian_banner">
    <img src="/img/yjkg/Group7.jpg" style="width: 100%;">
</div>
<div class="contentwrap detail">
    <div class="news_title">
        <div class="news_mark_left">
            <div class="line"></div>
        </div>
        <div class="news_mark">新闻资讯</div>
        <div class="news_mark_right">
            <div class="line"></div>
        </div>
    </div>

    <div class="conbwra">

        <div class="conbwra-left">

            <div class="art-con">
            <nav class="navation"> 首页 > <?php echo $cates[$info['class']]['class_name']; ?> > 正文</nav>
            <div style="display:none">
                <img src="<?php echo $info['pic_01'];?>" alt="<?php echo $info['title'] ?>"> 
            </div>
            <div class="title"><?php echo $info['title'] ?></div>
            <div class="sec_title">
                <div class="author a-fino">作者：<?php echo $info['author'] ?></div>
                <div class="fsource a-fino">来源：<?php echo $info['from'] ?></div>
                <div class="updated a-fino">发布时间：<?php echo $info['pubdate'] ?></div>
            </div>
            <?php if(count($info['body'])==1){ ?>
            <div class="content"><?php echo $info['body'][0];?></div>
            <?php }else{ ?>
            <?php foreach($info['body'] as $k=>$body){ ?>
            <?php if($k==0){?>
            <div class="content"><?php echo $body;?></div>
            <?php } ?>
            <div class="content" style="display: none;"><?php echo $body;?></div>
            <?php } ?>
            <div class='nav' data-pagesum="<?php echo count($info['body']);?>"></div>
            <!--<div class='nav' data-pagesum="30">daohang</div>-->
            <?php }?>
            </div>


            <div class="artback">
                <span style="display: inline-block;margin-right: 24px;">分享到</span>
                <span><a class="backa" href="javascript:void(0);" onclick="shareTo('wechat')" title=""><img src="/upload/icon/wx.png" alt=""></a></span>
                <span><a class="backa" href="javascript:void(0);" onclick="shareTo('qzone')" title=""><img src="/upload/icon/qq.png" alt=""></a></span>
                <span><a class="backa" href="javascript:void(0);" onclick="shareTo('sina')" title=""><img src="/upload/icon/wb.png" alt=""></a></span>
            </div>



            <div id="comment-area" class="article-detail-comment" style="display:none">
              <div class="comment-meta">
                <div class="comment-number">
                  <span class="number"><?php echo $comment_count; ?></span>&nbsp;条评论
                </div>
              </div>
              <div class="main-input-area">
                <div class="avatar"></div>
                <div class="input-textarea">
                  <textarea placeholder="写下您的评论..."></textarea>
                  <div class="input-footer">
                    <button class="submit-btn" type="button">评论</button>
                  </div>
                </div>
              </div>
              <div class="comment-list">
                <ul></ul>
              </div>
              <?php if($comment_page_count>1){ ?>
              <div class="load-more-comment">
                <button type="button">查看更多评论</button>
              </div>
              <?php } ?>
            </div>


            <div class="linebo"></div>
            <div class="nextNews">
                <div>
                    <div class="nextMark">下一篇 : </div>
                    <div class="nextCont"><?php if(!empty($next['title'])) {?>
                        <a href="/Xfpl/detail?id=<?php echo $next['id'] ?>&tabID=<?php echo $tabID ?>" title="<?php echo $next['title'] ?>"><?php echo $next['title'] ?></a>
                        <?php }else{ ?>
                        暂无下一条数据
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <div class="nextMark">上一篇</div>
                    <div class="nextCont"><?php if(!empty($prev['title'])) {?>
                        <a href="/Xfpl/detail?id=<?php echo $prev['id'] ?>&tabID=<?php echo $tabID ?>" title="<?php echo $prev['title'] ?>"><?php echo $prev['title'] ?></a>
                        <?php }else{ ?>
                        暂无上一条数据
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="linebo"></div>


            <div class="x-title">

              <div class="txt"><label>推荐阅读</label></div>

              <div class="hlen"></div>

            </div>
            <div class="recomend-read"> 
                    <ul>
            <?php foreach($tui_read as $item){ ?>
                       <li class="tui_list_li ">
                          <a href="/Xfpl/detail?id=<?php echo $item['id'];?>&amp;tabID=1" target="_blank">
                              <div class="li_img">
                                  <img alt="<?php echo $item['title']; ?>" src="<?php echo $item['pic_01']; ?>">
                              </div>
                              <div class="li_txt">
                                  <?php echo $item['title']; ?>
                              </div>
                              
                              <div class="li_cnt">
                                  &nbsp;&nbsp;&nbsp;
                                  <?php echo $item['sub_title'];?>
                              </div>
                              <div class="li_cntt"><p>
                              <span>发布时间:<?php echo $item['pubdate'];?></span></p></div>
                          </a>
                          <div class="clr"></div>
                      </li>
            <?php } ?>                      
                    </ul>
                </div>



        </div>








    </div>
        <div class="conbwra-right">
            <?php  echo $this->element('pc_view_right');?>
        </div>


    <div class="ad"></div>
</div>
<div id="qrcode"></div>
<script>
    $('document').ready(function () {
        var count = $('.nav').data('pagesum');
        var pagenow = 1;
        page(pagenow,count);
    })
    function page(pagenow,pagecount){
        var end = pagecount;
        var navsize = 10;
        var step = 5;
        var start = 1;
        if (end>navsize){
            end = start+navsize-1;
            if (pagenow>=end){
                start = Math.ceil((pagenow-navsize)/step)*step+step;
                end = start+navsize-1;
            }
            if (end>=pagecount){
                end = pagecount;
                start = end-navsize+1;
                if (start<1){
                    start = 1;
                }
            }
        }
        var pages = new Array();
        if (start>=step){
            pages.push('<span class="clickable">1</span><span  class="slh">···</span>')
        }
        for (var i = start;i<=end;i++){
            if (i==pagenow){
                pages.push('<span>'+i+'</span>')
            } else{
                pages.push('<span class="clickable">'+i+'</span>')
            }
        }
        if (end<pagecount){
            pages.push('<span class="slh">···</span><span class="clickable">'+pagecount+'</span>')
        }
        $('.nav').html(pages.join(' '));
        $('.nav').find('.clickable').click(function () {
            $('.content').hide(200).eq(($(this).html()-1)).show(200);
            page($(this).html(),pagecount)
        })
    }
</script>
<style>

</style>
<script>
    function shareTo(stype){
        var ftit = '';
        var flink = '';
        var lk = '';
        //获取文章标题
        ftit = $('.title').text();
        //获取网页中内容的第一张图片
        flink = $('.content img').eq(0).attr('src');
        if(typeof flink == 'undefined'){
            flink='';
        }
        //当内容中没有图片时，设置分享图片为网站logo
        if(flink == ''){
            lk = window.location.protocol+'://'+window.location.host+'/upload/icon/logo.png';
        }
        //如果是上传的图片则进行绝对路径拼接
        if(flink.indexOf('/uploads/') != -1) {
            lk = window.location.protocol+'://'+window.location.host+flink;
        }
        //百度编辑器自带图片获取
        if(flink.indexOf('ueditor') != -1){
            lk = flink;
        }
        //qq空间接口的传参
        if(stype=='qzone'){
            window.open('https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content'));
        }
        //新浪微博接口的传参
        if(stype=='sina'){
            window.open('http://service.weibo.com/share/share.php?url='+document.location.href+'?sharesource=weibo&title='+ftit+'&pic='+lk+'&appkey=2706825840');
        }
        //qq好友接口的传参
        if(stype == 'qq'){
            window.open('http://connect.qq.com/widget/shareqq/index.html?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&summary='+document.querySelector('meta[name="description"]').getAttribute('content')+'&desc=php自学网，一个web开发交流的网站');
        }
        //生成二维码给微信扫描分享，php生成，也可以用jquery.qrcode.js插件实现二维码生成
        if(stype == 'wechat'){
            // window.open('http://zixuephp.net/inc/qrcode_img.php?url=http://zixuephp.net/article-1.html');
            wxshare(window.location.href)
        }
    }
    function wxshare(url){
        $('#qrcode').qrcode(url).show();
        // $('body').addClass('bgray')
        setTimeout(function () {
            $('body').bind("click",function(){
                $(this).removeClass('bgray').unbind('click');
                $('#qrcode').html('').hide();
            });
        },500)
    }
    var swiper = new Swiper('#sw1', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            // clickable: true,
        },
        navigation: {
            nextEl: '.nav.left',
            prevEl: '.nav.right',
        },
    });
</script>







<script>
//评论相关js
$(document).ready(function(){
    var art_id = <?php echo $info['id']; ?>;
    var total_p = <?php echo $comment_page_count; ?>;
    var p = 1;
    function loadComment(obj,art_id,p){
      $.get('/xfpl/commentlist?art_id='+art_id+'&p='+p,function(res){
        obj.append(res);
      })
    }
    var container = $('.comment-list ul');
    loadComment(container,art_id,p);
    $('.load-more-comment button').click(function(){
      p++;
      if(p==total_p){
        $(this).parent().html('');
      }
      loadComment(container,art_id,p);
    })

    $(document).on('click','.main-input-area textarea',function(){
        $(this).parent().addClass('expand')
    })
    $('.main-input-area button').click(function(){
        var content = $(this).parent().parent().find('textarea').val();
        
        $.post('/xfpl/comment',{content:content,art_id:art_id},function(res){
          alert('评论成功!');
        })
    })

    $(document).on('click','.comment-list button',function(){
        var content = $(this).parent().parent().find('textarea').val();
        
        $.post('/xfpl/reply',{content:content,art_id:art_id,reply_id:_reply_id},function(res){
          alert('回复成功!');
        })
    })
    
    $(document).on('click','.input-textarea textarea',function(){
        $(this).parent().addClass('expand')
    })

    var _list_textarea = 0;
    var _reply_id = 0;
    $(document).on('click','.reply-btn',function(){
        var reply_textarea =$(this).parent().parent().find('.comment-reply-list').find('.input-textarea').length;
        _reply_id = $(this).attr('reply');
        if(reply_textarea){
          $('.comment-list').find('.input-textarea').remove();
          _list_textarea = 0;
        }
        var len = $(this).parent().parent().find('.input-textarea').length;
        if(len<=0){          
          if(_list_textarea==1){
            $('.comment-list').find('.input-textarea').remove();
            _list_textarea = 0;
          }
          $(this).parent().append(''+
              '<div class="input-textarea">'+
              '<textarea placeholder="写下您的回复..."></textarea>'+
              '<div class="input-footer"><button class="submit-btn" type="button">回复</button></div>'+
              '</div>'
          )
          _list_textarea = 1;
        }
    })

    $(document).on('click','.reply-num',function(){
        _reply_id = $(this).attr('reply');
        if(_list_textarea==1){
          $('.comment-list').find('.input-textarea').remove();
          _list_textarea = 0;
        }
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).parent().parent().find('.comment-reply-list').hide();
        }else{
            $(this).addClass('active');
            var reply = $(this).parent().parent().find('.comment-reply-list').show();
            loadReply(reply,_reply_id);
        }
    })

    function loadReply(obj,reply_id){
      $.post('/xfpl/replylist',{reply_id:reply_id},function(res){
          obj.html(res);
      })
      
    }
})
</script>

<?php
  if(!isset($_SESSION['uniqid'])){
    $uniqid = md5(uniqid(microtime(true),true));
    $_SESSION['uniqid'] = $uniqid;
    //echo $uniqid;
  }
  
  foreach($_SERVER as $k=>$v){
    //echo $k.':'.$v.'<br/>';
  }
?>