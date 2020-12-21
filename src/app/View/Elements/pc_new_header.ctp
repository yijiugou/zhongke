<!DOCTYPE html>  
<html>  
 <head>  
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0" />
 <meta name="keywords" content="消费评论|媒体|酒类" />
 <meta name="description" content="“消费评论”、“媒体”、 “酒类”">
 <meta name="baidu-site-verification" content="fIO8D0pF3G" />
 <title> <?php if (isset($action_name)) echo $action_name;?></title>
 <link rel="shortcut icon" type="image/ico" href="/faviconx.ico">
 <link rel="stylesheet" href="/js/swiper/css/swiper.css" />
 <link rel="stylesheet" href="/css/yjkg/public.css" />
 <!--[if lte IE 9]>
    <link rel="stylesheet" href="/css/yjkg/ie.public.css" />
 <![endif]--> 
 <link rel="stylesheet" href="/css/comm_new.css?v2" />
 <link rel="stylesheet" href="/css/media.css?v4" />
<?php
	echo $this->Html->script('/js/jquery-1.9.1.min.js');
?>
<script src="/js/yjkg/public.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var name='<?php echo $name;?>'; var action='<?php echo $action;?>';
        var device_type='<?php echo $device_type?>'
    </script>
 </head>
 <body style="background: #f7f7f7">

<div class="out_w top_bar t">
   <div class="w in_topbar">
       
       <div class="logo">
           <!--<a href="/"><img height="70px;" style="margin-top:5px;" src="/img/df/logo.jpg"></a>-->
           <a href="https://www.xiaofeipinglun.cn/" title="消费评论"><img src="/upload/icon/logo.png" alt="消费评论"></a>
       </div>

<div class="menu-button-box status-close">
    <span class="btn-open"><img src="/img/yjkg/icon-wap-toolbar-menu.png"></span>
    <span class="btn-close"><img src="/img/yjkg/icon_search_del.png"></span>
</div>
<script>
  function openNav(){
    $('.nav_ul').show();
  }
  function closeNav(){
    $('.nav_ul').hide();
  }
  $('.btn-open').click(function(){
    openNav()
    $('.menu-button-box').removeClass('status-close');
    $('.menu-button-box').addClass('status-open');
  })
  $('.btn-close').click(function(){
    closeNav()
    $('.menu-button-box').addClass('status-close');
    $('.menu-button-box').removeClass('status-open');
  })
</script>
       <div class="w ">
           <ul class="nav_ul">
            <?php $action = $name.'-'.$action; ?>
            <?php $act_cls='class="active"'; ?>
               <li act_flg="1" <?php if($action=='index-index'){ echo $act_cls;} ?>><a href="https://www.xiaofeipinglun.cn/">推&nbsp;&nbsp;荐</a></li>
               <li <?php if($action=='xfpl-jjgc'){ echo $act_cls;} ?>><a href="/Xfpl/jjgc" title="酒界观察">酒界观察</a></li>
               <li <?php if($action=='xfpl-qykx'){ echo $act_cls;} ?>><a href="/Xfpl/qykx" title="前沿快讯">前沿快讯</a></li>
               <li <?php if($action=='xfpl-xfxc'){ echo $act_cls;} ?>><a href="/Xfpl/xfxc" title="消费现场">消费现场</a></li>
               <li <?php if($action=='xfpl-jygd'){ echo $act_cls;} ?>><a href="/Xfpl/jygd" title="酒业观点">酒业观点</a></li>
               <li <?php if($action=='xfpl-jjhb'){ echo $act_cls;} ?>><a href="/Xfpl/jjhb" title="酒界黑榜">酒界黑榜</a></li>
               <li <?php if($action=='xfpl-jwqz'){ echo $act_cls;} ?>><a href="/Xfpl/jwqz" title="酒问千知">酒问千知</a></li>
               <li class="pc_hidden"><a href="https://www.ixigua.com/home/65836826919/?source=pgc_author_name&list_entrance=shortvideo" title="酒问千知">专题视频</a></li>
               
           </ul>
           <div class="clr"></div>
       </div>
       
   </div>
 </div>