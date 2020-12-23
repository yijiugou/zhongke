jQuery(function() {
	var windowWidth = $(window).width();
	var max = jQuery(".banner .item").length;
	jQuery(".numble .end").html(max);
	var $banner = jQuery(".indexBanner"),
		$bannerItem = $banner.find(".ibitem");
	$bannerImg = jQuery(".indexBanner .ibitem .ipimg");
	$head_top = $(".header").height();

	function initBanner() {
		if(!isMobile) {
			$banner.css({
				height: win_height - $head_top
			});
			$bannerItem.css({
				height: win_height - $head_top
			});
//			pageInit.setImgMax($bannerImg, 1920, 900, win_width, win_height - $head_top);
		} else {
			$banner.css({
				height: "auto"
			});
			$bannerItem.css({
				height: "auto"
			});
			$bannerImg.attr("style", "").css({
				position: "relative"
			});
		}
	}
	initBanner();
	if(windowWidth > 1024) {
		$(".indexBanner ul li").hover(function() {
			$(this).removeClass('s-width').addClass("m-width").siblings().addClass('s-width');
		}, function() {
			$(".indexBanner ul li").removeClass("m-width s-width");
		});
	}
	jQuery(window).scroll(function() {
		// 右侧内容出现
		var windowTop = $(window).scrollTop();
		var ib_height = $(".indexBanner").height();
		if(windowWidth > 1024) {
			if(windowTop >= ib_height) {
				$(".fixedRight").fadeIn(800);
			} else {
				$(".fixedRight").fadeOut(800);
			}
		}
	});
	// 右侧内容出现
	var windowTop = $(window).scrollTop();
	var ib_height = $(".indexBanner").height();
	var windowWidth = $(window).width();
	if(windowWidth > 1024) {
		if(windowTop >= ib_height) {
			$(".fixedRight").fadeIn(800);
		} else {
			$(".fixedRight").fadeOut(800);
		}
	}
	// 点击下拉图标
	jQuery(".mouseBox").bind("click", function() {
		//	var topHeight = $(".header").outerHeight();
		var downHeight = $(".indexBanner").outerHeight();
		jQuery('html, body').stop().animate({
			scrollTop: downHeight
		}, 600, 'easeInOutExpo');
	});
	// 合作伙伴
	$(".ibmore").click(function() {
		$(".morePartner").fadeIn(300);
	});
	$(".mbclose").click(function() {
		$(".morePartner").fadeOut(300);
	});
});