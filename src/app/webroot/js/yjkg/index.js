var yjkg_timer = null;
var xlc = 0;
$(function (argument) {
	var myVideo = document.getElementById("video");
	$(".dopaly").on('click', function(event) {
		event.preventDefault();
        myVideo.play();
	});
	setTimeout(function () {	
		var w = $(this).width();
		// var parent = document.getElementsByClassName('yjkg-swiper')[0];
		$(".yjkg_wrapper,.yjkg-swiper-item,.yjkg-swiper-item img").width(w);
		$h = $(".yjkg-swiper-item img").height();
		$(".yjkg-swiper-item").height($h);
		var $items = $(".yjkg-swiper-item").length;
		$(".yjkg-swiper").width(w*$items);
		$(".yjkg_wrapper").height($h);
		if (yjkg_timer) {
			clearInterval(yjkg_timer);
		}else {
			(function (x, p,cb) {
				function move (a){
					console.log(a,1);
					if (a == undefined){
						// console.log(this.target[0]);
						a = $(this.target).data('id');
                        console.log(a);
                    }
					x = a;
                    if ($items == x) {
                        x = 0;
                    }
                    $(".yjkg-swiper").animate({left: -w*x + 'px'}, 1000);
                    if (typeof cb =='function'){
                        cb(x,move)
                    }
                    // var d = children[0].cloneNode(true);
                    // p.appendChild(d);
                    // p.removeChild(children[0]);

                    // $(".yjkg-swiper").animate({left: '0px'}, 0);
                    x++;
				}
				yjkg_timer = setInterval(function () {
					// var children = document.getElementsByClassName("yjkg-swiper-item");
					move(x);
				}, 3000);
			})(xlc, parent,kgcallback);
		}
	}, 500);
})

function dopause () {
	$(".dopaly").show();
}

function doplay () {
	$(".dopaly").hide();
}

$(window).resize(function(event) {
	var w = $(this).width();
	$(".yjkg_wrapper,.yjkg-swiper-item,.yjkg-swiper-item img").width(w);
	$h = $(".yjkg-swiper-item img").height();
	$(".yjkg-swiper-item").height($h);
	var $items = $(".yjkg-swiper-item").length;
	$(".yjkg-swiper").width(w*$items);
	$(".yjkg_wrapper").height($h);
	if (yjkg_timer) {
		clearInterval(yjkg_timer);
	}else {
		(function (x) {
			yjkg_timer = setInterval(function () {
				if ($items == x) {
					x = 0;
				}
				$(".yjkg-swiper").animate({left: -w*x + 'px'}, 1000);
                if (typeof cb =='function'){
                    cb(x)
                }
				x++;
			}, 3000);
		})(xlc,kgcallback);
	}
});