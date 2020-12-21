var __global__ = {};
__global__.uri = window.location.href;
__global__.origin = window.location.origin;
__global__.pathname = window.location.pathname;
(function(global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() : global.mroute = factory()
})(this, (function() {
	function route() {
		this.params = {};
	}

	function del(params) {
		var arr = [];
		$.each(params, function(index, val) {
			arr.push(index.concat('=').concat(val));
		});
		return arr.join('&');
	};
	route.prototype.go = function() {
		this.params = del(arguments[0]);
		window.location.href = __global__.origin.concat(__global__.pathname).concat('?').concat(this.params);
	};
	return new route();
}))
// $(function() {
// 	var oldSel = $(".bgLei.active").attr('data-sel');
// 	var timer = null;
// 	$(".menu_item").mouseenter(function(event) {
// 		var _this = this;
// 		timer = setTimeout(function() {
// 			if($(".menu_item" + oldSel).hasClass('active') && $(_this).attr('data-sel') != oldSel) {
// 				$(".menu_item" + oldSel).removeClass('active');
// 			}
// 			if($(_this).hasClass('hasmore')) {
// 				$(_this).children('.menu_secord').css('right', (_this.offsetLeft - $(_this).parent('.wrap_menu').width() + $(_this).width()) + 'px');
// 			}
// 			if($(_this).attr('data-uri') == '/Person/index') {
// 				$(_this).find('.ms_wrap').css('flex-wrap', 'wrap').parent().animate({
// 					height: '160px'
// 				}, 100, function() {
// 					$(_this).addClass('active');
// 				});
// 			} else {
// 				$(_this).children('.menu_secord').animate({
// 					height: '50px'
// 				}, 100, function() {
// 					$(_this).addClass('active');
// 				});
// 			}
// 			if($(_this).children('.menu_choi').children('.wrapChoi').children('.bgLei').height() != 92) {
// 				$('.bgLei').animate({
// 					height: '0px'
// 				}, 100);
// 			}
// 			$(_this).children('.menu_choi').children('.wrapChoi').children('.bgLei').animate({
// 				height: '92px'
// 			}, 100);
// 		}, 200);
// 	}).mouseleave(function(event) {
// 		clearTimeout(timer);
// 		var _this = this;
// 		$(_this).children('.menu_secord').animate({
// 			height: '0px'
// 		}, 200, function() {
// 			if($(_this).attr('data-sel') != oldSel) {
// 				$(_this).removeClass('active');
// 			}
// 		});
// 	});
// 	$(".wrap_menu").mouseleave(function(event) {
// 		if($('.bgLei' + oldSel).height() != 92) {
// 			$('.bgLei').animate({
// 				height: '0px'
// 			}, 100);
// 			$('.bgLei' + oldSel).animate({
// 				height: '92px'
// 			}, 100, function() {
// 				$(".menu_item" + oldSel).addClass('active');
// 			});
// 		}
// 	});
//
// 	$(".menu_item").on('click', function(event) {
// 		event.preventDefault();
// 		var uri = $(this).attr('data-uri');
// 		if($(event.target).attr('href') != '#tab' && $(event.target).attr('href') != undefined) {
// 			uri = $(event.target).attr('href');
// 		}
// 		location.href = uri;
// 	});
// })

function iSnull(str) {
	if(str === null || str === undefined || str === '')
		return true;
	return false;
}

function subTime(str, b, e) {
	if(str === null || str === undefined || str === '')
		return null;
	return str.substring(b, e);
}

function date(format, timestamp) {
	var jsdate;
	if(timestamp && typeof timestamp == 'object') {
		jsdate = timestamp;

	} else if(timestamp && typeof timestamp == 'string') {
		jsdate = new Date(timestamp.replace(/-/g, '/'));
	} else {
		jsdate = ((timestamp) ? new Date(timestamp * 1000) : new Date());
	}

	var pad = function(n, c) {
		if((n = n + "").length < c) {
			return new Array(++c - n.length).join("0") + n;
		} else {
			return n;
		}
	};
	var txt_weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	var txt_ordin = {
		1: "st",
		2: "nd",
		3: "rd",
		21: "st",
		22: "nd",
		23: "rd",
		31: "st"
	};
	var txt_months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var f = {
		// Day
		d: function() {
			return pad(f.j(), 2)
		},
		D: function() {
			return f.l().substr(0, 3)
		},
		j: function() {
			return jsdate.getDate()
		},
		l: function() {
			return txt_weekdays[f.w()]
		},
		N: function() {
			return f.w() + 1
		},
		S: function() {
			return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th'
		},
		w: function() {
			return jsdate.getDay()
		},
		z: function() {
			return(jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0
		},
		// Week
		W: function() {
			var a = f.z(),
				b = 364 + f.L() - a;
			var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;
			if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b) {
				return 1;
			} else {
				if(a <= 2 && nd >= 4 && a >= (6 - nd)) {
					nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
					return date("W", Math.round(nd2.getTime() / 1000));
				} else {
					return(1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
				}
			}
		},
		// Month
		F: function() {
			return txt_months[f.n()]
		},
		m: function() {
			return pad(f.n(), 2)
		},
		M: function() {
			return f.F().substr(0, 3)
		},
		n: function() {
			return jsdate.getMonth() + 1
		},
		t: function() {
			var n;
			if((n = jsdate.getMonth() + 1) == 2) {
				return 28 + f.L();
			} else {
				if(n & 1 && n < 8 || !(n & 1) && n > 7) {
					return 31;
				} else {
					return 30;
				}
			}
		},
		// Year
		L: function() {
			var y = f.Y();
			return(!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0
		},
		//o not supported yet
		Y: function() {
			return jsdate.getFullYear()
		},
		y: function() {
			return(jsdate.getFullYear() + "").slice(2)
		},
		// Time
		a: function() {
			return jsdate.getHours() > 11 ? "pm" : "am"
		},
		A: function() {
			return f.a().toUpperCase()
		},
		B: function() {
			// peter paul koch:
			var off = (jsdate.getTimezoneOffset() + 60) * 60;
			var theSeconds = (jsdate.getHours() * 3600) + (jsdate.getMinutes() * 60) + jsdate.getSeconds() + off;
			var beat = Math.floor(theSeconds / 86.4);
			if(beat > 1000) beat -= 1000;
			if(beat < 0) beat += 1000;
			if((String(beat)).length == 1) beat = "00" + beat;
			if((String(beat)).length == 2) beat = "0" + beat;
			return beat;
		},
		g: function() {
			return jsdate.getHours() % 12 || 12
		},
		G: function() {
			return jsdate.getHours()
		},
		h: function() {
			return pad(f.g(), 2)
		},
		H: function() {
			return pad(jsdate.getHours(), 2)
		},
		i: function() {
			return pad(jsdate.getMinutes(), 2)
		},
		s: function() {
			return pad(jsdate.getSeconds(), 2)
		},
		//u not supported yet
		// Timezone
		//e not supported yet
		//I not supported yet
		O: function() {
			var t = pad(Math.abs(jsdate.getTimezoneOffset() / 60 * 100), 4);
			if(jsdate.getTimezoneOffset() > 0) t = "-" + t;
			else t = "+" + t;
			return t;
		},
		P: function() {
			var O = f.O();
			return(O.substr(0, 3) + ":" + O.substr(3, 2))
		},
		//T not supported yet
		//Z not supported yet
		// Full Date/Time
		c: function() {
			return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P()
		},
		//r not supported yet
		U: function() {
			return Math.round(jsdate.getTime() / 1000)
		}
	};
	return format.replace(/[\\]?([a-zA-Z])/g, function(t, s) {
		if(t != s) {
			// escaped
			ret = s;
		} else if(f[s]) {
			// a date function exists
			ret = f[s]();
		} else {
			// nothing special
			ret = s;
		}
		return ret;
	});
}