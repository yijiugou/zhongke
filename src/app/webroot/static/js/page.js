var isMobile = false,
	mobile = false,
	win_width = 0,
	win_height = 0,
	navItem = 0,
	atH = 80,
	$menuBtn = jQuery('.menu-handler'),
	$menuOverlay = jQuery('.menu-overlay'),
	menuM = jQuery(".menuMoblie"),
	pageNavNum = 0,
	scrollNav = 0;
var windowWidth = $(window).width();

var pageInit = {
		init: function() {
			win_width = $(window).width();
			win_height = $(window).height();
			if(win_width <= 1024) {
				isMobile = true;
				atH = 54;
			} else if(win_width > 1024) {
				isMobile = false;
				atH = 86;
				menu.close();
			};
		},
		setImgMax: function(img, imgW, imgH, tW, tH) {
			var tWidth = tW || win_width;
			var tHeight = tH || win_height;
			var coe = imgH / imgW;
			var coe2 = tHeight / tWidth;
			if(coe < coe2) {
				var imgWidth = tHeight / coe;
				img.css({
					height: tHeight,
					width: imgWidth,
					left: -(imgWidth - tWidth) / 2,
					top: 0
				});
			} else {
				var imgHeight = tWidth * coe;
				img.css({
					height: imgHeight,
					width: tWidth,
					left: 0,
					top: -(imgHeight - tHeight) / 2
				});
			};
		},
		setScroll: function(anchorCur) {
			if(jQuery(anchorCur).length >= 1) {
				jQuery("html,body").animate({
					scrollTop: jQuery(anchorCur).offset().top - atH
				}, 0);
			}
		},
		setErmbox: function(obj, title) {
			obj.click(function() {
				var str = '<div class="ermsblack"><div class="ermSBox"><div class="img"><img src="' + obj.attr("data-img") + '"/></div><div class="t">' + title + '</div></div></div>';
				$("body").append(str);
				jQuery(".ermsblack").fadeIn();
				jQuery(".ermSBox").animate({
					marginTop: "-132"
				}, 400);
				$(".ermSBox .close").click(function() {
					$(".ermsblack").remove();
				});
				jQuery(".ermsblack").click(function() {
					$(".ermsblack").remove();
				});
				return false;
			})
		},
		setSplit: function(el) {
			var n = el;
			for(var e = 0, t = n.length; e < t; e++) {
				var a = n[e],
					r = a.textContent.trim();
				a.innerHTML = "";
				i(a, r)
			}

			function i(n, e) {
				for(var t in e) {
					var a = document.createElement("span");
					a.innerHTML = e[t] === " " ? "&nbsp;" : e[t];
					n.appendChild(a);
				}
			}
		},
		setTimeDelay: function(el, time, delay, reverse) {
			var _span = el;
			_span.each(function(i) {
				var _i = $(this).find('span');
				_i.each(function(j) {
					if(reverse) {
						j = _i.length - j - 1;
					}
					$(this).css({
						'animation-delay': delay + time * j + 'ms',
						'-webkit-animation-delay': delay + time * j + 'ms'
					})
				})
			})
		},
		showbox: function(htmlAddress) {
			$.ajax({
				url: htmlAddress,
				dataType: "html",
				success: function(data) {
					if(data == "" || data == null) {
						return;
					} else {
						if(jQuery(".sm-content").length >= 1) {
							jQuery('html').removeClass('sm-show');
							jQuery('.sm-content').remove();
						};
						$('.sm-modal .vertical-inner').append(data);
						$("html").addClass("sm-showb");
						setTimeout(function() {
							$("html").addClass("sm-show");
						}, 50);
						jQuery('.sm-close').bind('click', function(e) {
							jQuery('html').removeClass('sm-show');
							setTimeout(function() {
								$("html").removeClass("sm-showb");
								jQuery('.sm-content').remove();
							}, 400);
						});
						jQuery('.sm-modal .vertical-inner').bind('click', function(e) {
							if($(e.target).hasClass('vertical-inner')) {
								jQuery('html').removeClass('sm-show');
								setTimeout(function() {
									$("html").removeClass("sm-showb");
									jQuery('.sm-content').remove();
								}, 400);
							}
						});
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					jQuery('html').removeClass('sm-show');
					setTimeout(function() {
						$("html").removeClass("sm-showb");
						jQuery('.sm-content').remove();
					}, 400);
				}
			});
		},
		pbanner: function() {
			if(jQuery('.pbanner').length >= 1) {
				if(!isMobile) {
					jQuery('.pbanner').css("height", jQuery(".pbanner .load-img").height());
				} else {
					jQuery('.pbanner').css("height", "auto");
				}
			};
			jQuery('.pbanner-c .en,.pbanner-c .zh').each(function(i) {
				pageInit.setSplit(jQuery(this));
				pageInit.setTimeDelay($(this), 80, 350, false);
			});
		}
	},
	nav = {
		init: function() {}
	},
	menu = {
		init: function() {
			jQuery(".menu-handler").click(function() {
				if(navItem == 0) {
					jQuery(this).addClass("active");
					jQuery("html").addClass("menuOpen");
					navItem = 1;
				} else {
					jQuery(this).removeClass("active");
					jQuery("html").removeClass("menuOpen");
					navItem = 0;
				}
			});
			$(document).on("click", ".menuMoblie .nav-link", function(e) {
				var mnavcur = $(this);
				var mnavbox = $(this).parents("li");
				if(mnavbox.find(".subnav").length > 0) {
					if(mnavbox.hasClass("cur")) {
						mnavbox.find(".subnav").stop(false, false).slideUp();
						mnavbox.removeClass("cur");
					} else {
						jQuery(".menuMoblie li").removeClass("cur");
						jQuery(".subnav").stop(false, false).slideUp();
						mnavbox.find(".subnav").stop(false, false).slideDown();
						mnavbox.addClass("cur");
						e.preventDefault();
					}
				}
			});
			$(document).on("click", ".menuMoblie a", function(e) {
				var $this = jQuery(this);
				var hash = $this.attr("href").split("#")[1];
				if(hash && jQuery("#" + hash).length >= 1) {
					e.preventDefault();
					jQuery("html,body").animate({
						scrollTop: jQuery("#" + hash).offset().top - atH
					}, 0);
					menu.close();
				}
			});
			$(".pusher-black").click(function() {
				if(navItem == 1) {
					menu.close();
				};
			});
		},
		close: function() {
			$menuBtn.removeClass("active");
			jQuery("html").removeClass("menuOpen");
			navItem = 0;
		}
	},
	pbanner = {
		init: function() {
			if(jQuery(".load-img").length >= 1) {
				_PreLoadImg([
					jQuery(".load-img").attr("src")
				], function() {
					pageInit.pbanner();
				});
				jQuery(window).resize(function() {
					pageInit.pbanner();
				});
			}
		}
	},
	pageNav = {
		init: function() {
			jQuery(".page-nav-btn a").click(function(e) {
				var $this = jQuery(this);
				var hash = $this.attr("href").split("#")[1];
				if(hash && jQuery("#" + hash).length >= 1) {
					e.preventDefault();
					jQuery("html,body").animate({
						scrollTop: jQuery("#" + hash).offset().top - atH
					}, 800, 'easeInOutExpo');
				}
			});
			var $sec_nav = $('.page-nav-box');
			if($sec_nav.length) {
				var $sec_n = $sec_nav.find('.page-nav-btn'),
					$current_item = $sec_nav.find('.active').parent();
				if(isMobile && $current_item.length >= 1) {
					$sec_n.stop().animate({
						scrollLeft: $current_item.position().left
					});
				}
				$(window).resize(function() {
					if(isMobile && $current_item.length >= 1) {
						$sec_n.stop().animate({
							scrollLeft: $current_item.offset().left + $sec_n.scrollLeft()
						});
					}
				});
			}
		}
	};
jQuery(window).resize(function() {
	pageInit.init();
	pbanner.init();
	var sawidth = $(".sd-bottom-banner").width();
	$(".bottom-dw-bg ").width((win_width - sawidth) / 2);
});
pageInit.init();
$(document).ready(function() {
	nav.init();
	menu.init();
	pbanner.init();
	pageNav.init();
	pageInit.setErmbox(jQuery('.ermItem'), "扫描此二维码关注我们");
});
$(window).on('load', function() {
	var head_height = $(".header").height();
	var hash = location.href.split("#")[1];
	if(hash) {
		jQuery("html,body").animate({
			scrollTop: jQuery("#" + hash).offset().top - head_height
		}, 500);
	}
});

// 头部
var index_head = $(".yj-bot li.active").index();
var length_ = $(".yj-bot li.active").length;
$(".yj-bot li").hover(function() {
	$(this).find(".ej-list").stop().slideDown().parents('li').siblings().find(".ej-list").hide();
}, function() {
	if(length_ > 0) {
		$(".yj-bot li").removeClass('active').eq(index_head).addClass('active');
	} else {
		$(".yj-bot li").removeClass('active');
	}
	$(".ej-list").stop().slideUp();
});

// 内页tab定位
jQuery(function() {
	var indexs = $(".ipt-link a.active").index();
	var now = $(".ipt-link a").width() * indexs;
	$(".inside-pages-tab").animate({
		scrollLeft: now
	});

});
window.onload = function(){
	
}
jQuery(window).scroll(function() {
	var windowWidth = $(window).width();
	// 内页TAB固定
	if(windowWidth > 1200) {
		if(jQuery(".insidefixed").length > 0) {
			if($(window).scrollTop() > jQuery(".insidefixed").height()) {
				$('.insidefixed').addClass("fix-head");
				$(".header").slideUp();
			} else {
				$('.insidefixed').removeClass("fix-head");
				$(".header").slideDown();
			}
		}
	}
	// 显示回到顶部
	var windowTop = $(window).scrollTop();
	var icheight = $(".footerbg").offset().top - win_height + $(".footerbg").height() - 10;
	if(windowWidth > 1200) {
		if(windowTop >= icheight) {
			$(".updown").addClass("active");
		} else {
			$(".updown").removeClass("active");
		}
	}
});

// 底部微信二维码弹框
$(".fcwechat").click(function() {
	$(".ftb-tk").fadeIn(300);
});
$(".close-fbewm").click(function() {
	$(".ftb-tk").fadeOut(300);
});
// 头部搜索
$(".hsearch").click(function() {
	$(".searchBot").fadeIn(300);
});
$(".closesearch").click(function() {
	$(".searchBot").fadeOut(300);
});
// 点击底部回到顶部
$('.updown').click(function() {
	$('html,body').animate({
		scrollTop: '0px'
	}, 800);
});
// 底部select
$(".fs-select").click(function() {
	$(this).addClass("active").children(".fs-zk").slideToggle(300);
}).mouseleave(function() {
	$(this).removeClass("active");
	$(".fs-zk").removeClass("active").slideUp(300);
});
// 特色技术-设备
jQuery(".tqBanner").slick({
	slidesToShow: 3,
	slidesToScroll: 1,
	centerPadding: '0',
	arrows: true,
	speed: 500,
	dots: true,
	infinite: false,
	centerMode: false,
	autoplay: true,
	focusOnSelect: true,
	responsive: [{
			breakpoint: 1280,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
			}
		},
		{
			breakpoint: 640,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			}
		}
	]
});
// 设备设施
jQuery(".stBanner").slick({
	slidesToShow: 3,
	slidesToScroll: 1,
	centerPadding: '0',
	arrows: true,
	speed: 500,
	dots: true,
	infinite: false,
	centerMode: false,
	autoplay: true,
	focusOnSelect: true,
	responsive: [{
			breakpoint: 860,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
			}
		},
		{
			breakpoint: 640,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			}
		}
	]
});
// 底部select
$(".bfs-select").click(function() {
	$(".bfs-zk").slideToggle(300);
}).mouseleave(function() {
	$(".bfs-zk").slideUp(300);
});

// 底部微信二维码弹框
$(".gz-wechat").click(function() {
	$(".ftb-tk").fadeIn(300);
});
$(".close-fbewm").click(function() {
	$(".ftb-tk").fadeOut(300);
});