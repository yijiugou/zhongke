<link rel="stylesheet" href="/js/page/Page.css" />
<link rel="stylesheet" href="/css/yjkg/news.css" />
 <!--[if lte IE 9]>
    <link rel="stylesheet" href="/css/yjkg/ie.news.css" />
 <![endif]--> 
<div class="news_main">
	<div class="news_mian_banner">
		<img src="/img/yjkg/Group7.jpg">
	</div>
	<div class="news_title">
		<div class="news_mark_left">
			<div class="line"></div>
		</div>
		<div class="news_mark">新闻资讯</div>
		<div class="news_mark_right">
			<div class="line"></div>
		</div>
	</div>
	<div class="news_tab">
		<div class="news_tab_item"><span class="tabc <?php if($id=='2') echo 'active'; ?>" data-id="2">公司动态</span></div>
		<div class="news_tab_item"><span class="tabc <?php if($id=='1') echo 'active'; ?>" data-id="1">行业资讯</span></div>
		<!--<div class="news_tab_item"><span class="tabc <?php if($id=='0') echo 'active'; ?>" data-id="0">通知公告</span></div>-->
		<div class="news_tab_item"><span class="tabc <?php if($id=='0') echo 'active'; ?>" data-id="0">媒体报道</span></div>
	</div>
	<div class="news_dsj news_dsj2 active">
		<div class="news_dsj_con">
		</div>
	</div>
	<input type="hidden" name="cate_id" id="cate_id" value="<?php echo $id ?>">
	<div class="moreNews"><span class="jaxGetMore"><img src="/img/yjkg/more.png" /></span></div>
	<div class="nodata" style="display: none;">
		<div class="nodata_center">
			<div class="nc_img"><img src="/img/yjkg/zx2.png"></div>
			<div class="nc_text">暂无数据</div>
		</div>
	</div>
</div>
<script src="/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<script src="/js/yjkg/news.js" type="text/javascript" charset="utf-8"></script>