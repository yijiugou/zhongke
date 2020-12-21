var test = null;
(function(rrj){



	var $_GET = (function() {
		var url = window.document.location.href.toString();
		var u = url.split("?");
		if (typeof(u[1]) == "string") {
			u = u[1].split("&");
			var get = {};
			for (var i in u) {
			var j = u[i].split("=");
			get[j[0]] = j[1];
		}
			return get;
		} else {
			return {};
		}
	})();

	var sellLiandong = {
		init : function() {
			var _this = this;


			this.product_id = $('#product_id');

			this.product_id.on('change', function(){
				//$("#remark_info").val("");
				$('#group').removeClass('has-error');
				$('.help-block').remove();
			});
		}
	}
	var productLiandong = {
		init : function() {
			var _this = this;


			this.pro_name = $('#product_name');
			this.remake = $('#remark_info');

			this.pro_name.on('change', function(){

				_this.pro_val = _this.pro_name.val();
				if (_this.pro_val != "") {
					_this.changeVal();
				} else {
					_this.initRemake();
				}
			});
		},
		changeVal : function(){

			var _this = this;
			this.initRemake();
			var data ={'pro_id':this.pro_val};
			$.get('/Ajaxapp/promakeinfo',data, function(res) {
		
				if (res.code == 1) {

					var a = res.data;
					for(var x=0;x < res.data.length;x++) {
						var row = res.data[x];
					
						_this.remake.append('<option value="'+row.id+'">'+row.name+'</option>');
					}
				}
			}, 'json').fail(function() {
			}).always(function() {
			});
		},

		initRemake : function(){
			this.remake.html('<option value=""> --请选择-- </option>');
		}
	}


	function initRangeDate (){
		$('.date-picker').datepicker({
			dateFormat: 'yy-mm', 
			autoclose: true,
			todayHighlight: true,
			language: 'zh-CN',
			dateFormat: "yyyy-mm"
		})//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		$('.select_range').click(function(){
			var type = $(this).attr('t_type');
			var time = getDayRange(type);

			$('input[name=t_start]').val(time.start);
			$('input[name=t_end]').val(time.end);
		});
	}

	function getDayRange (type){
		var res = {};
		var end = getDateStr(0);
		if (type == 'day'){
			var start = getDateStr(0);
			
		} else if (type == 'week') {
			var start = getDateStr(-7);
		} else if (type == 'month') {
			var start = getDateStr(-30);
		}

		res.start = start;
		res.end = end;
		return res;
	}

	function jsDateSelect(){
		$('.date-picker').datepicker({language: 'zh-CN',autoclose:true});
		$('.select_range').click(function(){
			var type = $(this).attr('t_type');
			var time = getDayRange(type);
			$('input[name=t_start]').val(time.start);
			$('input[name=t_end]').val(time.end);
		});
	}

	rrj.fn.index_cooperate1 = {
		init : function (){
			
		}

	}

})(rrj);


$(function(){




	$('.nav_ul li').hover(function(){
		$('.nav_ul .active').removeClass('active');
		$(this).addClass("active");
	}, function(){
		$('.nav_ul .active').removeClass('active');
		$('.nav_ul [act_flg]').addClass('active');
	});

	var initFunction = name+"_"+action;
	if (typeof rrj.fn[initFunction] == 'object') {
		rrj.fn[initFunction].init();
	}	
})
