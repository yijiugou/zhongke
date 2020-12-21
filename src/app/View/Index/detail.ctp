<link rel="stylesheet" href="/css/yjkg/index.detail.css" />
 <!--[if lte IE 9]>
    <link rel="stylesheet" href="/css/yjkg/ie.index.detail.css" />
 <![endif]--> 
<div class="news_mian_banner">
	<img src="/img/yjkg/Group7.jpg" style="width: 100%;">
</div>
<div class="contentwrap">
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
		<div class="news_tab_item"><a href="/news/index?id=2"><span class="tab <?php if($tabID==2) echo 'active'; ?>">公司动态</span></a></div>
		<div class="news_tab_item"><a href="/news/index?id=1"><span class="tab <?php if($tabID==1) echo 'active'; ?>">行业资讯</span></a></div>
		<div class="news_tab_item"><a href="/news/index?id=0"><span class="tab <?php if($tabID==0) echo 'active'; ?>">通知公告</span></a></div>
	</div>
	<div class="conbwra">
		<div class="conbwra-left">
            <div style="display:none">
                <img src="<?php echo $info['pic_01'];?>" alt="<?php echo $info['title'] ?>"> 
            </div>
			<div class="title"><?php echo $info['title'] ?></div>
			<div class="sec_title">
				<div class="author a-fino">作者：<?php echo $info['author'] ?></div>
				<div class="fsource a-fino">来源：<?php echo $info['from'] ?></div>
				<div class="updated a-fino">发布时间：<?php echo $info['pubdate'] ?></div>
			</div>
			<div class="content"><?php echo $info['body'] ?></div>
			<div class="artback">
				<span><a class="backa" href="/news/index?id=<?php echo $tabID ?>" title="">返回</a></span>
			</div>
			<div class="linebo"></div>
			<div class="nextNews">
				<div class="nextMark">下一篇</div>
				<div class="nextCont"><?php if(!empty($next['title'])) {?>
					<a href="/index/detail?id=<?php echo $next['id'] ?>&tabID=<?php echo $tabID ?>" title=""><?php echo $next['title'] ?></a>
					<?php }else{ ?>
					暂无下一条数据
					<?php } ?>
				</div>
			</div>
			<div class="linebo"></div>
		</div>
		<div class="conbwra-right">
			<div class="conbwra-left-item">
				<img src="/img/yjkg/aa.png" />
			</div>
			<div class="conbwra-left-item">
				<img src="/img/yjkg/index_brand_2.png" />
			</div>

		</div>
	</div>
	<div class="ad"></div>
</div>