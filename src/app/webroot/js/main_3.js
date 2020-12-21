var test = null;

function strlen(s){
	if(!s){ return 0; }
	var length = s.replace(/[^\x00-\xff]/g,"*").length;	
	return length;
}
(function ($) {
    $.fn.KinSlideshow = function (settings) {

        settings = jQuery.extend({
            intervalTime: 5,
            moveSpeedTime: 400,
            moveStyle: "left",
            mouseEvent: "mouseclick",
            isHasTitleBar: true,
            titleBar: {titleBar_height: 40, titleBar_bgColor: "#000000", titleBar_alpha: 0.5},
            isHasTitleFont: true,
            titleFont: {TitleFont_size: 12, TitleFont_color: "#FFFFFF", TitleFont_family: "Verdana", TitleFont_weight: "bold"},
            isHasBtn: true,
            fiexdMovepx:0,
            btn: {
                btn_bgColor: "#666666",
                btn_bgHoverColor: "#CC0000",
                btn_fontColor: "#CCCCCC",
                btn_fontHoverColor: "#000000",
                btn_fontFamily: "Verdana",
                btn_borderColor: "#999999",
                btn_borderHoverColor: "#FF0000",
                btn_borderWidth: 1,
                btn_bgAlpha: 0.7
            }
        }, settings);
        var titleBar_Bak = {titleBar_height: 40, titleBar_bgColor: "#000000", titleBar_alpha: 0.5};
        var titleFont_Bak = {TitleFont_size: 12, TitleFont_color: "#FFFFFF", TitleFont_family: "Verdana", TitleFont_weight: "bold"};
        var btn_Bak = {
            btn_bgColor: "#666666",
            btn_bgHoverColor: "#CC0000",
            btn_fontColor: "#CCCCCC",
            btn_fontHoverColor: "#000000",
            btn_fontFamily: "Verdana",
            btn_borderColor: "#999999",
            btn_borderHoverColor: "#FF0000",
            btn_borderWidth: 1,
            btn_bgAlpha: 0.7
        };
        for (var key in titleBar_Bak) {
            if (settings.titleBar[key] == undefined) {
                settings.titleBar[key] = titleBar_Bak[key];
            }
        }
        for (var key in titleFont_Bak) {
            if (settings.titleFont[key] == undefined) {
                settings.titleFont[key] = titleFont_Bak[key];
            }
        }
        for (var key in btn_Bak) {
            if (settings.btn[key] == undefined) {
                settings.btn[key] = btn_Bak[key];
            }
        }

        var ksthis = this;
        var ksbs = $(ksthis).selector;
        var KSS_DateArray = new Array();
        var KSS_imgaeLength = 0;
        var KSS_Size = new Array();
        var KSS_changeFlag = 0;
        var KSS_IntervalTime = settings.intervalTime;
        var KSS_setInterval;
        var KSS_firstMoveFlag = true;
        var getTitleBar_Height;

        if (isNaN(KSS_IntervalTime) || KSS_IntervalTime <= 1) {
            KSS_IntervalTime = 5;
        }
        if (settings.moveSpeedTime > 500) {
            settings.moveSpeedTime = 500;
        } else if (settings.moveSpeedTime < 100) {
            settings.moveSpeedTime = 100;
        }

        function KSS_initialize() {
            $(ksthis).css({visibility: "hidden"});
            $(ksbs + " a img").css({border: 0});
            KSS_start();
            KSS_mousehover();
        }

        function KSS_start() {
            KSS_imgaeLength = $(ksbs + " a").length;
            KSS_Size.push($(ksbs + " a img").width());
            KSS_Size.push($(ksbs + " a img").height());

            $(ksbs + " a img").each(function () {
                KSS_DateArray.push($(this).attr("alt"));
            });
            $(ksbs + " a").wrapAll("<div id='KSS_content'></div>");
            $(ksbs).find("#KSS_content").clone().attr("id", "KSS_contentClone").appendTo(ksthis);
            KSS_setTitleBar();
            KSS_setTitleFont();
            KSS_setBtn();
            KSS_action();
            KSS_btnEvent(settings.mouseEvent);
            $(ksthis).css({visibility: "visible"});
        }

        function KSS_setTitleBar() {
            $(ksthis).css({width: KSS_Size[0], height: KSS_Size[1], overflow: "hidden", position: "relative"});
            $(ksthis).append("<div class='KSS_titleBar'></div>");
            getTitleBar_Height = settings.titleBar.titleBar_height;

            if (isNaN(getTitleBar_Height)) {
                getTitleBar_Height = 40;
            } else if (getTitleBar_Height < 25) {
                getTitleBar_Height = 25;
            }

            $(ksbs + " .KSS_titleBar").css({height: getTitleBar_Height, width: "100%", position: "absolute", bottom: 0, left: 0});
            if (settings.isHasTitleBar) {
                $(ksbs + " .KSS_titleBar").css({background: settings.titleBar.titleBar_bgColor, opacity: settings.titleBar.titleBar_alpha})
            }
        }

        function KSS_setTitleFont() {
            if (settings.isHasTitleFont) {
                $(ksthis).append("<div class='KSS_titleBox'><h2 class='title' style='margin:3px 0 0 6px;padding:0;'></h2></div>");
                $(ksbs + " .KSS_titleBox").css({height: getTitleBar_Height, width: "100%", position: "absolute", bottom: 0, left: 0});
                $(ksbs + " .KSS_titleBox h2").css({
                    fontSize: settings.titleFont.TitleFont_size,
                    color: settings.titleFont.TitleFont_color,
                    fontFamily: settings.titleFont.TitleFont_family,
                    fontWeight: settings.titleFont.TitleFont_weight
                });
                setTiltFontShow(0);
            }
        }

        function KSS_setBtn() {
            if (settings.btn.btn_borderWidth > 2) {
                settings.btn.btn_borderWidth = 2
            }
            if (settings.btn.btn_borderWidth < 0 || isNaN(settings.btn.btn_borderWidth)) {
                settings.btn.btn_borderWidth = 0
            }
            if (settings.isHasBtn && KSS_imgaeLength >= 2) {
                $(ksthis).append("<div class='KSS_btnBox' style='position:absolute;right:10px;bottom:5px; z-index:100'></div>");
                var KSS_btnList = "";
                for (i = 1; i <= KSS_imgaeLength; i++) {
                    KSS_btnList += "<li>" + i + "</li>";
                }
                KSS_btnList = "<ul id='btnlistID' style='margin:0;padding:0; overflow:hidden'>" + KSS_btnList + "</ul>";
                $(ksbs + " .KSS_btnBox").append(KSS_btnList);
                $(ksbs + " .KSS_btnBox #btnlistID li").css({
                    listStyle: "none",
                    float: "left",
                    width: 18,
                    height: 18,
                    borderWidth: settings.btn.btn_borderWidth,
                    borderColor: settings.btn.btn_borderColor,
                    borderStyle: "solid",
                    background: settings.btn.btn_bgColor,
                    textAlign: "center",
                    cursor: "pointer",
                    marginLeft: 3,
                    fontSize: 12,
                    fontFamily: settings.btn.btn_fontFamily,
                    lineHeight: "18px",
                    opacity: settings.btn.btn_bgAlpha,
                    color: settings.btn.btn_fontColor
                });
                $(ksbs + " #btnlistID li:eq(0)").css({background: settings.btn.btn_bgHoverColor, borderColor: settings.btn.btn_borderHoverColor, color: settings.btn.btn_fontHoverColor});
            }
        }

        function KSS_action() {
            switch (settings.moveStyle) {
                case "left":
                    KSS_moveLeft();
                    break;
                case "right":
                    KSS_moveRight();
                    break;
                case "up":
                    KSS_moveUp();
                    break;
                case "down":
                    KSS_moveDown();
                    break;
                default:
                    settings.moveStyle = "left";
                    KSS_moveLeft();
            }
        }

        function KSS_moveLeft() {
            $(ksbs + " div:lt(2)").wrapAll("<div id='KSS_moveBox'></div>");
            $(ksbs).find("#KSS_moveBox").css({width: KSS_Size[0], height: KSS_Size[1], overflow: "hidden", position: "relative"});
            $(ksbs).find("#KSS_content").css({float: "left"});
            $(ksbs).find("#KSS_contentClone").css({float: "left"});
            $(ksbs + " #KSS_moveBox div").wrapAll("<div id='KSS_XposBox'></div>");
            $(ksbs).find("#KSS_XposBox").css({float: "left", width: "2000%"});

            KSS_setInterval = setInterval(function () {
                KSS_move(settings.moveStyle)
            }, KSS_IntervalTime * 1000 + settings.moveSpeedTime);
        }

        function KSS_moveRight() {
            $(ksbs + " div:lt(2)").wrapAll("<div id='KSS_moveBox'></div>");
            $(ksbs).find("#KSS_moveBox").css({width: KSS_Size[0], height: KSS_Size[1], overflow: "hidden", position: "relative"});
            $(ksbs).find("#KSS_content").css({float: "left"});
            $(ksbs).find("#KSS_contentClone").css({float: "left"});
            $(ksbs + " #KSS_moveBox div").wrapAll("<div id='KSS_XposBox'></div>");
            $(ksbs).find("#KSS_XposBox").css({float: "left", width: "2000%"});
            $(ksbs).find("#KSS_contentClone").html("");
            $(ksbs + " #KSS_content a").wrap("<span></span>");
            $(ksbs + " #KSS_content a").each(function (i) {
                $(ksbs).find("#KSS_contentClone").prepend($(ksbs + " #KSS_content span:eq(" + i + ")").html());
            });

            $(ksbs).find("#KSS_content").html($(ksbs).find("#KSS_contentClone").html());
            var KSS_offsetLeft = (KSS_imgaeLength - 1) * KSS_Size[0];
            $(ksbs).find("#KSS_moveBox").scrollLeft(KSS_offsetLeft);
            KSS_setInterval = setInterval(function () {
                KSS_move(settings.moveStyle)
            }, KSS_IntervalTime * 1000 + settings.moveSpeedTime);
        }

        function KSS_moveUp() {
            $(ksbs + " div:lt(2)").wrapAll("<div id='KSS_moveBox'></div>");
            $(ksbs).find("#KSS_moveBox").css({width: KSS_Size[0], height: KSS_Size[1], overflow: "hidden", position: "relative"});
            $(ksbs).find("#KSS_moveBox").animate({scrollTop: 0}, 1);
            KSS_setInterval = setInterval(function () {
                KSS_move(settings.moveStyle)
            }, KSS_IntervalTime * 1000 + settings.moveSpeedTime);

        }

        function KSS_moveDown() {
            $(ksbs + " div:lt(2)").wrapAll("<div id='KSS_moveBox'></div>");
            $(ksbs).find("#KSS_moveBox").css({width: KSS_Size[0], height: KSS_Size[1], overflow: "hidden", position: "relative"});
            $(ksbs).find("#KSS_contentClone").html("");
            $(ksbs + " #KSS_content a").wrap("<span></span>");
            $(ksbs + " #KSS_content a").each(function (i) {
                $(ksbs).find("#KSS_contentClone").prepend($(ksbs + " #KSS_content span:eq(" + i + ")").html());
            });
            $(ksbs).find("#KSS_content").html($(ksbs).find("#KSS_contentClone").html());

            var KSS_offsetTop = (KSS_imgaeLength - 1) * KSS_Size[1];
            $(ksbs).find("#KSS_moveBox").animate({scrollTop: KSS_offsetTop}, 1);
            KSS_setInterval = setInterval(function () {
                KSS_move(settings.moveStyle)
            }, KSS_IntervalTime * 1000 + settings.moveSpeedTime);
        }

        function KSS_move(style) {
            switch (style) {
                case "left":
                    if (KSS_changeFlag >= KSS_imgaeLength) {
                        KSS_changeFlag = 0;
                        $(ksbs).find("#KSS_moveBox").scrollLeft(0);
                        $(ksbs).find("#KSS_moveBox").animate({scrollLeft: KSS_Size[0]}, settings.moveSpeedTime);
                    } else {
                        sp = (KSS_changeFlag + 1) * KSS_Size[0];
                        sp=sp+settings.fiexdMovepx*(KSS_changeFlag+1);
                        if ($(ksbs).find("#KSS_moveBox").is(':animated')) {
                            $(ksbs).find("#KSS_moveBox").stop();
                            $(ksbs).find("#KSS_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
                        } else {
                            $(ksbs).find("#KSS_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
                        }
                    }
                    setTiltFontShow(KSS_changeFlag + 1);
                    break;
                case "right":
                    var KSS_offsetLeft = (KSS_imgaeLength - 1) * KSS_Size[0];
                    if (KSS_changeFlag >= KSS_imgaeLength) {
                        KSS_changeFlag = 0;
                        $(ksbs).find("#KSS_moveBox").scrollLeft(KSS_offsetLeft + KSS_Size[0]);
                        $(ksbs).find("#KSS_moveBox").animate({scrollLeft: KSS_offsetLeft}, settings.moveSpeedTime);
                    } else {
                        if (KSS_firstMoveFlag) {
                            KSS_changeFlag++;
                            KSS_firstMoveFlag = false;
                        }
                        sp = KSS_offsetLeft - (KSS_changeFlag * KSS_Size[0]);
                        sp=sp-settings.fiexdMovepx*(KSS_imgaeLength-KSS_changeFlag);
                        if ($(ksbs).find("#KSS_moveBox").is(':animated')) {
                            $(ksbs).find("#KSS_moveBox").stop();
                            $(ksbs).find("#KSS_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
                        } else {
                            $(ksbs).find("#KSS_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
                        }
                    }
                    setTiltFontShow(KSS_changeFlag);
                    break;
                case "up":
                    if (KSS_changeFlag >= KSS_imgaeLength) {
                        KSS_changeFlag = 0;
                        $(ksbs).find("#KSS_moveBox").scrollTop(0);
                        $(ksbs).find("#KSS_moveBox").animate({scrollTop: KSS_Size[1]}, settings.moveSpeedTime);
                    } else {
                        sp = (KSS_changeFlag + 1) * KSS_Size[1];
                        if ($(ksbs).find("#KSS_moveBox").is(':animated')) {
                            $(ksbs).find("#KSS_moveBox").stop();
                            $(ksbs).find("#KSS_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
                        } else {
                            $(ksbs).find("#KSS_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
                        }
                    }
                    setTiltFontShow(KSS_changeFlag + 1);
                    break;
                case "down":
                    var KSS_offsetLeft = (KSS_imgaeLength - 1) * KSS_Size[1];
                    if (KSS_changeFlag >= KSS_imgaeLength) {
                        KSS_changeFlag = 0;
                        $(ksbs).find("#KSS_moveBox").scrollTop(KSS_offsetLeft + KSS_Size[1]);
                        $(ksbs).find("#KSS_moveBox").animate({scrollTop: KSS_offsetLeft}, settings.moveSpeedTime);
                    } else {
                        if (KSS_firstMoveFlag) {
                            KSS_changeFlag++;
                            KSS_firstMoveFlag = false;
                        }
                        sp = KSS_offsetLeft - (KSS_changeFlag * KSS_Size[1]);
                        if ($(ksbs).find("#KSS_moveBox").is(':animated')) {
                            $(ksbs).find("#KSS_moveBox").stop();
                            $(ksbs).find("#KSS_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
                        } else {
                            $(ksbs).find("#KSS_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
                        }
                    }
                    setTiltFontShow(KSS_changeFlag);
                    break;
            }

            KSS_changeFlag++;
            if (settings.moveCallBack!=undefined && typeof settings.moveCallBack=='function'){
                var num = KSS_changeFlag%KSS_imgaeLength;
            	settings.moveCallBack.call($(ksbs).find('#KSS_content a').eq(num)[0],num);
			}
        }

        function setTiltFontShow(index) {
            if (index == KSS_imgaeLength) {
                index = 0
            }
            if (settings.isHasTitleFont) {
                $(ksbs + " .KSS_titleBox h2.title").html(KSS_DateArray[index]);
            }
            $(ksbs + " #btnlistID li").each(function (i) {
                if (i == index) {
                    $(this).css({background: settings.btn.btn_bgHoverColor, borderColor: settings.btn.btn_borderHoverColor, color: settings.btn.btn_fontHoverColor});
                } else {
                    $(this).css({background: settings.btn.btn_bgColor, borderColor: settings.btn.btn_borderColor, color: settings.btn.btn_fontColor});
                }
            })
        }

        function KSS_btnEvent(Event) {
            switch (Event) {
                case "mouseover" :
                    KSS_btnMouseover();
                    break;
                case "mouseclick" :
                    KSS_btnMouseclick();
                    break;
                default :
                    KSS_btnMouseclick();
            }
        }

        function KSS_btnMouseover() {
            $(ksbs + " #btnlistID li").mouseover(function () {
                var curLiIndex = $(ksbs + " #btnlistID li").index($(this));
                switch (settings.moveStyle) {
                    case  "left" :
                        KSS_changeFlag = curLiIndex - 1;
                        break;
                    case  "right" :
                        if (KSS_firstMoveFlag) {
                            KSS_changeFlag = curLiIndex - 1;
                            break;
                        } else {
                            KSS_changeFlag = curLiIndex;
                            break;
                        }
                    case  "up" :
                        KSS_changeFlag = curLiIndex - 1;
                        break;
                    case  "down" :
                        if (KSS_firstMoveFlag) {
                            KSS_changeFlag = curLiIndex - 1;
                            break;
                        } else {
                            KSS_changeFlag = curLiIndex;
                            break;
                        }
                }
                KSS_move(settings.moveStyle);
                $(ksbs + " #btnlistID li").each(function (i) {
                    if (i == curLiIndex) {
                        $(this).css({background: settings.btn.btn_bgHoverColor, borderColor: settings.btn.btn_borderHoverColor, color: settings.btn.btn_fontHoverColor});
                    } else {
                        $(this).css({background: settings.btn.btn_bgColor, borderColor: settings.btn.btn_borderColor, color: settings.btn.btn_fontColor});
                    }
                })
            })

        }

        function KSS_btnMouseclick() {
            $(ksbs + " #btnlistID li").click(function () {
                var curLiIndex = $(ksbs + " #btnlistID li").index($(this));
                switch (settings.moveStyle) {
                    case  "left" :
                        KSS_changeFlag = curLiIndex - 1;
                        break;
                    case  "right" :
                        if (KSS_firstMoveFlag) {
                            KSS_changeFlag = curLiIndex - 1;
                            break;
                        } else {
                            KSS_changeFlag = curLiIndex;
                            break;
                        }
                    case  "up" :
                        KSS_changeFlag = curLiIndex - 1;
                        break;
                    case  "down" :
                        if (KSS_firstMoveFlag) {
                            KSS_changeFlag = curLiIndex - 1;
                            break;
                        } else {
                            KSS_changeFlag = curLiIndex;
                            break;
                        }

                }
                KSS_move(settings.moveStyle);
                $(ksbs + " #btnlistID li").each(function (i) {
                    if (i == curLiIndex) {
                        $(this).css({background: settings.btn.btn_bgHoverColor, borderColor: settings.btn.btn_borderHoverColor, color: settings.btn.btn_fontHoverColor});
                    } else {
                        $(this).css({background: settings.btn.btn_bgColor, borderColor: settings.btn.btn_borderColor, color: settings.btn.btn_fontColor});
                    }
                })
            })
        }

        function KSS_mousehover() {
            $(ksbs + " #btnlistID li").mouseover(function () {
                clearInterval(KSS_setInterval);
            });
            $(ksbs + " #btnlistID li").mouseout(function () {
                KSS_setInterval = setInterval(function () {
                    KSS_move(settings.moveStyle)
                }, KSS_IntervalTime * 1000 + settings.moveSpeedTime);
            })
        }

        return KSS_initialize();
    };
})(jQuery);
$(function(){



	if ($('.about_us').length>0){
	    $('.about_us .about_left').find('li').each(function(i){
	        var _i = i

	        $(this).click(function(){
	            $('.about_left .active').removeClass("active");
	            $(this).addClass("active");
	            console.log(i);
	            $('.about_right .in_content').hide();
	            $('.about_right .in_content').eq(_i).show();
	        });
	    });

	 }


	var is_move = 0;
	$('.index_04 .btn').click(function(){
		
		if (is_move != 0) return ;

		is_move = 1;
		var count = $('.index_back_04 .inner_img ul').find('li').length;
		var width = $('.index_back_04 .inner_img li').css('width');
		width=width.substring(0,width.length-2);


		var $ul = $('.index_back_04 .inner_img ul').css({'width':count*width});
		var ul_width = $ul.css('width');
		$('body').scrollTop($('body').scrollTop()+1);
		$('body').scrollTop($('body').scrollTop()-1);
		var left = $ul.css('left');
		left=left.substring(0,left.length-2);
		
			if ($(this).hasClass('btn_left')) {

				if (left>=0) {
					var new_left = -((count-1) * width);
				} else {
					var new_left = left - (width)*-1;
				}
				
			} else {
				if (left <= - ((count-1) * width)) {
					var new_left = 0;
				} else {
					var new_left = left*1-width;
				}
			}
		$ul.animate({'left': new_left}, 800,function(){
			is_move = 0;
		});
	});

	$('.index_04').hover(function(){
		$(this).find('.btn').css({'opacity':'0.5'});
	},function(){
		$(this).find('.btn').css({'opacity':'0.3'});
	});


});

(function (w) {
	var cbfuns = [];
	var lwin   = {};
	
	var checkData = {
		res : {},
		checkPrice : function(price) {
			if (this.checkEmpty(price)) {
				return false;
			}
			if ($.isNumeric(price) && price > 0) {
				return true;
			} else {
				return false;
			}
		},
		
		checkNum : function (num) {
			if (typeof num == 'undefined') return false;
			return $.isNumeric(num);
		},
		
		checkEmpty : function(str){
			
			if (typeof str =='undefined' || str.length<1) {
				return true;
			} else {
				return false;
			}
		},
		
		checkEmail : function (mail) {
			if (typeof mail == 'undefined') return false;
			if (this.checkEmpty(mail)) {
				return false;
			}
			
			if ($("#email").val().match(/^w+((-w+)|(.w+))*@[A-Za-z0-9]+((.|-)[A-Za-z0-9]+)*.[A-Za-z0-9]+$/)) {
				return true;
			} else {
				return false;
			}
		},
		
		
		checkTel : function (tel){

			if (typeof tel == 'undefined') return false;
			if (this.checkPrice(tel) && tel.length == 11) {
				return true;
			} else {
				return false;
			}
		}
		
		
	
	}
	
	function dialog(data) {
		console.log(data);
		return new dialog.prototype.init(data);
	}

	dialog.fn = dialog.prototype = {
		constructor: dialog,
		data:null,
		init: function(data) {
		
			if (typeof data == 'string') {
				this.data = eval("("+data+")");
			} else{
				this.data = data;
			}
			
			
			return this;
		},

		show: function(type) {
			var _this = this;
			
			lwin.mask = $('#rrj-mask');
			lwin.box = $('#offerdialog');
			
			lwin.form = $('#offerform');
			lwin.success = $('#offersuccess');
			
			this.subBtn = $("#doOfferButton");
			this.offerprice = $("#offerprice");
			this.offermobile = $('#offermobile');
			this.offerdescription = $("#offerdescription");
		
			this.offerprice.val("");
			this.offermobile.val('');
			this.offerdescription.val('');
			
			

			$('body').on('click', '.modal_close', function(e) {
				_this.closeWin();
			});
			
			
			$('body').on('click', '#doOfferButton', function(e) {
				lwin.subClick();
			});
			
			if (typeof this.data.type == "string") {
				if (this.data.type == 'offer') {
					lwin.title.html(this.data.title);
					lwin.form.html($('#xiaoyang_div').html());
					lwin.success.html($('#xiaoyang_success').html());
					lwin.subClick = this.subOffer;
					


				} else if (this.data.type == 'xiaoyang') {
					

					lwin.form.html($('#xiaoyang_div').html());
					lwin.success.html($('#xiaoyang_success').html());
					lwin.subClick = this.subXiaoYang;
					
					
				} else if (this.data.type == 'kanjia') {

					lwin.form.html($('#kanjia_div').html());
					lwin.success.html($('#kanjia_success').html());
					lwin.subClick = this.subKanJia;
				}

			}
			lwin.mask.show();
			lwin.box.show();			
		},
		
		closeWin : function(){
			
			test = lwin;
			
			lwin.form.show();
			lwin.success.hide();
			
			lwin.box.hide();
			lwin.mask.hide();
			
			this.data = {};
			this.subBtn.unbind();
		},
		
		subXiaoYang : function(){
			var data = {};
			data.name = $('#name').val();
			data.mobile = $('#mobile').val();
			

			
			$.get('/Ajaxapp/xiaoyang', data, function(res){
				if (res.code ==1) {
					
					lwin.form.hide();
					lwin.success.show();
				} else {
					alert("提交失败，请刷新重试");
				}
			}, "json");

		},
		
		subKanJia : function(){
			var data = {};
			data.name = $('#name').val();
			data.mobile = $('#mobile').val();
			
			$.get('/Ajaxapp/xiaoyang', data, function(res){
				if (res.code ==1) {
					
					lwin.form.hide();
					lwin.success.show();
				} else {
					alert("提交失败，请刷新重试");
				}
			}, "json");

		},
		
		subOffer: function(){

			var offer = _this.data;
			if (!checkData.checkPrice(_this.offerprice.val())) {
				alert("请输入正确的价格。");
				return false;
			}				
			if (!checkData.checkTel(_this.offermobile.val())) {
				alert('请输入正确的手机号码');
				return false;
			}
			if (strlen(_this.offerdescription.val())>100 ) {
				alert('备注信息请少于100个字。');
				return false;
			}
			
			offer.offer_price = _this.offerprice.val();
			offer.offer_tel   = _this.offermobile.val();
			offer.offer_comm  = _this.offerdescription.val();
			
			console.log(_this.data);
			var __this = _this;
			var url = "http://" + location.host + "/Ajaxapp/setOffer";
			$.get(url, offer, function(res){
				if (res.code == 1) {
					lwin.form.hide();
					lwin.success.show();
				} else {
					alert("提交失败。")
				}
			},"json");
				

			
		},
		
		addCallback: function(cbfun) {
			if(typeof cbfun != 'function') return;
			cbfuns.push(cbfun);
		}
	
	};
	
	var dataCheck = {
		res : {},
		url : "http://" + location.host + "/Ajaxapp/checkUserInfo",
		checkUserEmail : function (mail) {
			var r_num = Math.round(Math.random()*10000);
			var params = {'type':'usermail', 'mail':mail, 'r' : r_num};
			var _this = this;
			$.get(this.url, params, function(res){
				_this.res = res;
			}, "json");
		}
	}
	dialog.fn.init.prototype = dialog.fn;

	w.lwin   = lwin;
	w.dialog = dialog;
	w.checkData = checkData	
})(window);

var tologin = function (){
	var url = encodeURIComponent(window.location.href);
	return window.location.href='/login?bk=' + url;
}

var buyButton = {
	init : function(){
		$('body').on('click', ".offer_btn", function(){
			var data = ($(this).attr('data-mate'));
			new dialog(data).show();
		});
	}
}

var registerPage = {
	user_info : {},
	error_flg : 1,
	register_url : "http://" + location.host + "/Ajaxapp/register",
	resuccess_url : "http://" + location.host + "/register/success",
	init : function() {
	
		var _this = this;
		this.name = $('#name');
		this.mobile = $('#mobile');
		this.email = $('#email');
		this.password = $('#password');
		this.password_confirm = $('#password_confirm');
		this.sub_tbn = $(".sub_tbn")
		
		$('#addform input').focus(function(){
			if ($(this).next().length >0 && $(this).next().hasClass("has-error"))
			$(this).next().html("");
		});
		
		$('#addform .sub_tbn').click(function(){

			if (_this.checkName() && _this.checkTel() && _this.checkPwd() && _this.checkMail()) {
				var user = {};
				user.name = _this.name.val();
				user.mobile = _this.mobile.val();
				user.email  = _this.email.val();
				user.password = _this.password.val();
				user.sex = $('input:radio[name=sex]:checked').val();
				
				console.log(user);
				var __this = _this;
				$.get(_this.register_url, user, function(res){
					if (res.code == 1) {
						window.location.href = __this.resuccess_url + "?uid="+res.uid;
					} else{
						alert("注册失败，请刷新重试");
					}
				}, "json");

			}
		
			
			
		});
		
		this.name.on('blur', function(){
			_this.checkName();
		});
		
		this.mobile.on('blur', function(){
			_this.checkTel();
		});
		
		this.password_confirm.on('blur', function(){
			_this.checkPwd();
		});
		
		this.email.on('blur', function(){
			_this.checkMail();
		})
	},
	
	checkName : function(obj){
		var obj = this.name;
		obj.next().html("");
		var name = obj.val();
		if (name.length < 1) {
			obj.next().html("请输入注册人姓名！");
			return false;
		}else{
			return true;
		}
	},
	
	checkTel : function(obj){
		var obj = this.mobile;
		obj.next().html("");
		var tel = obj.val();
		if (!checkData.checkTel(tel)) {
			obj.next().html("请输入正确手机号码！");
			return false;
		} else {
			return true;
		}
	},
	
	checkMail : function(){
			var obj = this.email;
			obj.next().html("");
			this.sub_tbn.addClass("disabled");
			var _this = this;
			var mail = _this.email.val();
			if (mail.length > 0) {
				var url = "http://" + location.host + "/Ajaxapp/checkUserInfo";
				var r_num = Math.round(Math.random()*10000);
				var params = {'type':'usermail', 'mail':mail, 'r' : r_num};
				var __this = _this;
				$.get(url, params, function(res){
					if (res.code != 1) {
						obj.next().html(res.msg);
					} else {
						__this.sub_tbn.removeClass("disabled");
					}
				}, "json");
				return true;
			} else {
				obj.next().html("请输入邮箱地址！");
				return false;
			}
	},
	
	checkPwd : function(){
		this.password.next().html("");
		this.password_confirm.next().html("");
		var pwd1 = this.password.val();
		var pwd2 = this.password_confirm.val();

		if (pwd1.length < 1) {
			this.password.next().html("请输入密码！");
			return false;
		} else if (pwd1 != pwd2) {
			this.password_confirm.next().html("密码不一致！");
			return false;
		} else {
			return true;
		}
	}
}

var indexPage = {
	init : function(){


		if ($('#demo1').length > 0) {
			var speed=50;

			demo2.innerHTML=demo1.innerHTML;

			function Marquee(){
			   if($('#demo1').height() - demo.scrollTop<=0) {
			      demo.scrollTop-=demo1.offsetHeight
			   }
			   else{
			      demo.scrollTop++
			   }
			}
			var MyMar=setInterval(Marquee,speed)
			demo.onmouseover=function() {clearInterval(MyMar)}
			demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
		} 


		$("ul [product_click]").css({'cursor':'pointer'});
		$("ul [product_click]").on('click', function(){
			var id = $(this).attr("product_click");
			window.open('/Product/detail?id='+id);
		});
		
		$('#register_new').click(function()	{
			window.location.href='/register';
		});
		
		$('#btnLogin').click(function(){
			var name = $('#txtUserName').val();
			var pwd = $('#txtUserPwd').val();
			
			if (name.length > 0 && pwd.length > 0) {
				$.post("/login/index", {'mobile':name, 'password':pwd, 'from':'index'}, function(res){
						if (res.code == 1) {
							window.location.reload();
						} else {
							alert('请输入正确的手机号与密码');
						}
				}, "json");
			} else {
				$('#txtUserName').val("");
				alert('请输入正确的手机号与密码');
			}
		});
	}
}

jQuery.focus4 = function(obj){
	var speed=50;
	var index = 0;
	var demo=$(obj); 
	var ul=$(obj).find('ul');
	if (ul.find('li').length < 4) {return ;}
	
	if (demo.attr('param') != undefined) {
		var liW = demo.attr('param');
	} else {
		var imgW = ul.find('li').width();
		if (imgW < 1) return false;
		var ipadding = ul.find('li').css({'cursor':'pointer'}).css('padding-left');
		var ipadding=ipadding.substring(0,ipadding.length-2);
		var liW = imgW + ipadding*1;

	}

	ul.css({'width':liW* ul.find('li').length});
	
	var MyMar=setInterval(Marquee,speed);	
	demo.hover(function(){
		clearInterval(MyMar);
	},function(){
		MyMar=setInterval(Marquee,speed);
	});
	
	
	function Marquee(){ 
		index ++;

		if (index >= liW) {
			index =0;
			var li = ul.find('li').eq(0).remove();
			ul.append(li);
		}
		var nowLeft =  '-'+index + 'px';
		ul.css({ "left": nowLeft });
	}
}

jQuery.companySild = function(obj){
	var speed=50;
	var index = 0;
	var demo=$(obj); 
	var ul=$(obj).find('ul');
	
	if (demo.attr('param') != undefined) {
		var liW = demo.attr('param');
	} else {
		var imgW = ul.find('li').width();
		if (imgW < 1) return false;
		var ipadding = ul.find('li').css({'cursor':'pointer'}).css('padding-left');
		var ipadding=ipadding.substring(0,ipadding.length-2);
		var liW = imgW + ipadding*1;

	}

	ul.css({'width':liW* ul.find('li').length});
	
	var MyMar=setInterval(Marquee,speed);	
	demo.hover(function(){
		clearInterval(MyMar);
	},function(){
		MyMar=setInterval(Marquee,speed);
	});
	
	
	function Marquee(){ 
		index ++;

		if (index >= liW) {
			index =0;
			var li = ul.find('li').eq(0).remove();
			ul.append(li);
		}
		var nowLeft =  '-'+index + 'px';
		ul.css({ "left": nowLeft });
	}
}


jQuery.focus3 = function(slid){
	var contain = $(slid);
	test = contain;
	var item = contain.find('.category-item');
	var len = item.length/2;
	var index = 0;

	//上一页按钮
	$('.category-carousel').find('#c_prev').click(function () {
		index -= 1;
		if (index == -1) { index = len - 1; }
		showPics(index);
	});

	//下一页按钮
	$('.category-carousel').find('#c_next').click(function () {
		index += 1;
		if (index == len) { index = 0; }
		showPics(index);
	});
	
	var picTimer;

	$(".category-width").hover(function () {
		clearInterval(picTimer);
	}, function () {
		picTimer = setInterval(function () {
			index++;
			showPics(index);

			if (index == len) { index = 0; }
		}, 3000);
	}).trigger("mouseleave");

	function showPics(index) { //普通切换
		if (index == len) {var nowLeft = '0px'; index = 0} else {var nowLeft = -index * 870;}	
		contain.stop(true, false).animate({ "left": nowLeft }, 600); //通过animate()调整ul元素滚动到计算出的position
		$('.category-controls .category-page span').removeClass('active');
		$('.category-controls .category-page span').eq(index).addClass('active');
		
	}
	
	
}

jQuery.focus2 = function (slid) {
	
	var ul = $(slid).find('ul');
	var li = $(slid).find('ul li');
	var sWidth = $(slid).width(); //获取焦点图的宽度（显示面积）
	var sHeight = $(slid).find("img").eq(0).height();
	var len = $(slid).find("ul li").length; //获取焦点图个数
	var index = 0;

	//$(slid).height(sHeight).css({'overflow':'hidden'});
	li.css({'float':'left'}).show();
	
	ul.css({'width':sWidth * len, 'position':'absolute'})
	li.css({'position':'relative', 'width':sWidth});
	
			//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
	var btn = "<div style='display:none;' class='btnBg'></div><div class='btn' style='display:none;'>";
	for (var i = 0; i < len; i++) {
		var ii = i + 1;
		btn += "<span>" + ii + "</span>";
	}
	btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
	$(slid).append(btn);
	$(slid).find("div.btnBg").css("opacity", 0.5);

	//为小按钮添加鼠标滑入事件，以显示相应的内容
	$(slid + " div.btn span").css("opacity", 0.4).mouseenter(function () {
		index = $(slid + " .btn span").index(this);
		showPics(index);
	}).eq(0).trigger("mouseenter");		
	//上一页、下一页按钮透明度处理
	$(slid + " .preNext").css("opacity", 0).hover(function () {
		$(this).stop(true, false).animate({ "opacity": "0.5" }, 300);
	}, function () {
		$(this).stop(true, false).animate({ "opacity": "0.2" }, 300);
	});

	$(slid).hover(function () {
		$(slid + " .preNext").stop(true, false).animate({ "opacity": "0.2" }, 300);
	}, function () {
		$(slid + " .preNext").stop(true, false).animate({ "opacity": "0" }, 300);
	});

	//上一页按钮
	$(slid + " .pre").click(function () {
		index -= 1;
		if (index == -1) { index = len - 1; }
		showPics(index);
	});

	//下一页按钮
	$(slid + " .next").click(function () {
		index += 1;
		if (index == len) { index = 0; }
		showPics(index);
	});
	
	var picTimer;

	$(slid).find("img").each(function(i){
		$(this).attr('img_index', i);
		$(this).click(function(){
			index = $(this).attr('img_index');
			showPics(index);
			return false;
		});
	});

	
	//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
	$(slid).hover(function () {
		clearInterval(picTimer);
	}, function () {
		picTimer = setInterval(function () {
			showPics(index);
			index++;
			if (index == len) { index = 0; }
		}, 4000); //此4000代表自动播放的间隔，单位：毫秒
	}).trigger("mouseleave");

	function showPics(index) { //普通切换
		index++;
		if (index == len) {var nowLeft = '0px'; index = 0} else {var nowLeft = -index * sWidth;}
		
		$(slid + " ul").stop(true, false).animate({ "left": nowLeft }, 300); //通过animate()调整ul元素滚动到计算出的position
		$(slid + " .btn span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
		$(slid + " .btn span").stop(true, false).animate({ "opacity": "0.4" }, 300).eq(index).stop(true, false).animate({ "opacity": "1" }, 300); //为当前的按钮切换到选中的效果
	}
	

}

$(function(){
	
	if (typeof action == "string") {
		if (action == 'Buy_index') {
			buyButton.init();
			doAnonymity.init();
		}
		if (action == "register") {
			registerPage.init();
		}
		
		if (action == 'Index_index' || action =='Sale_index') {
			indexPage.init();
			buyButton.init();	

		}	
		if (action == 'Product_detail') {
			buyButton.init();
		}

		if (action == 'Register_findPasswd'){
			$("body").on('click', '#getcode_num', function(){
				$(this).attr("src",'/Ajaxapp/codeNum?' + Math.random());
			});

			$("body").on('click', '.login_btn', function(){

				
				var code_num = $('#phoneVer').val();
				$.post("/Ajaxapp/ckcode?act=num",{code:code_num},function(msg){
					if(msg==1){
						code_flg = 1;
						$('#findConfirm_form').submit();
					}else{
						alert("验证码错误！");
						$("#phoneVer").val("");
						code_flg = 0;
					}
				});
			});

		}

	}
	
	
});