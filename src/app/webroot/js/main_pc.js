(function($, window){

	var rrj = function(){
		return rrj.prototype.init();
	}
	rrj.fn = rrj.prototype = {
		constructor:rrj,
		init : function(){
			return this;
		}
	}
	rrj.fn.test = function(){
		return 'test';
	}
	rrj.prototype.init.fn = rrj.fn;
window.rrj = rrj;

})(jQuery, window);


function makeUp(data) {
	return new makeUp.prototype.init(data);
}



var ProvinceSelect = {
	/*使用方法
	* select id 设为 select_province / select_city /select_coutry
	*/
	
	//编辑初始化
	/*var province_init = {'pro_select':<?php echo $data['province_id']?>,'cit_select':<?php  echo $data['city_id']?>, 'cut_select':<?php echo $data['coutry_id']?>};*/
	
	pro_select : null,
	cit_select : null,
	cut_select : null,
	pro_loaded : 0,
	cit_loaded : 0,
	cut_loaded : 0,
	pro_val : null,
	cit_val : null,
	cut_val : null,
	valided : false,
	
	url_getPro : "http://" + location.host + "/Ajaxapp/initprovice",
	url_getCit : "http://" + location.host + "/Ajaxapp/initCity",
	url_editProvince : "http://" + location.host + "/Ajaxapp/editProvince",
	init:function(){
		var _this = this;
		if($('#select_province').length == 1
		&& $('#select_city').length == 1
		&& $('#select_coutry').length == 1
		) {
			this.pro_select = $('#select_province');
			this.cit_select = $('#select_city');
			this.cut_select = $('#select_coutry');
			

			if (typeof province_init == 'object') {
				this.edit_select();
			} else {
				var select = $('#select_province');
				var url = this.url_getPro;
				$.get(url, function(res) {
					if (res.code==1) {
						_this.pro_loaded = 1;
						test=res.res;
						var op = $('<option value="0">请选择</option>');
						select.append(op);
						$.each(test, function(i1, i2){
							var op = $('<option value="'+i1+'">'+i2+'</option>');
							select.append(op);
						});
					}
				}, 'json').fail(function() {
				}).always(function() {
				});
			}
		}
		
		$('#select_province').change(function(){
			_this.pro_change();
		});
		
		$('#select_city').change(function(){
			_this.cit_change();
		});

		$('#select_coutry').change(function(){
			_this.coutry_change();
		});

	},
	
	pro_change : function(){
		var _this = this;
		//consle.log(this.pro_select.val());
		this.pro_val = this.pro_select.val();
		this.cit_select.html("<option value='0'>-- --</option>");
		this.cut_select.html("<option value='0'>-- --</option>");
		
		if (this.pro_val > 0) {

			var url = this.url_getCit+"?c_id="+this.pro_val;
			$.get(url,function(res) {
				if (res.code==1) {
					_this.cit_loaded = 1;
					var op = $('<option value="0">请选择</option>');
					_this.cit_select.html("");
					_this.cit_select.append(op);
					$.each(res.res, function(i1, i2){
						var op = $('<option value="'+i1+'">'+i2+'</option>');
						_this.cit_select.append(op);
					});
				}
			}, 'json').fail(function() {
			}).always(function() {
			});
		}
	},
	
	cit_change : function(){
		var _this = this;
		this.cit_val = this.cit_select.val();
		this.cut_select.html("<option value='0'>-- --</option>");
		if (this.cit_val > 0) {
			var url = this.url_getCit+"?c_id="+this.cit_val;
			$.get(url,function(res) {
				if (res.code==1) {
					_this.cut_loaded = 1;
					var op = $('<option value="0">请选择</option>');
					_this.cut_select.html("");
					_this.cut_select.append(op);
					$.each(res.res, function(i1, i2){
						var op = $('<option value="'+i1+'">'+i2+'</option>');
						_this.cut_select.append(op);
					});
				}
			}, 'json').fail(function() {
			}).always(function() {
			});
		}
	},

	coutry_change : function(){
		this.cut_val = this.cut_select.val();
		if (this.valided) {
			this.valid();	
		}
		
	},

	valid : function(){
		console.log('valid');
		if (this.pro_val == 0 || this.cit_val == 0 || this.cut_val == 0) {
	
			this.cut_select.closest('.form-group').addClass('has-error');
			return false;
		} else {
			
			this.cut_select.closest('.form-group').removeClass('has-error');
			return true;
		}
	},

	edit_select : function(){
	
		if (province_init.pro_select.length ==0) province_init.pro_select =0;
		if (province_init.cit_select.length ==0) province_init.cit_select =0;
		if (province_init.cut_select.length ==0) province_init.cut_select =0;
	
		this.pro_val = province_init.pro_select;
		this.cit_val = province_init.cit_select;
		this.cut_val = province_init.cut_select;

		var _this = this;
		var url = this.url_editProvince+"?pro="+this.pro_val+"&cit="+this.cit_val+"&cut="+this.cut_val;
		$.get(url,function(res) {

			var __this = _this;
			if (res.code==1) {
				test = res;
				$.each(res.data, function(i1,i2){

					if(i2.length !=0) {
						var obj = null;
						if (i1 == 'pro') obj = __this.pro_select;
						if (i1 == 'cit') obj = __this.cit_select;
						if (i1 == 'cut') obj = __this.cut_select;
						
						obj.html('<option value="0">请选择</option>');
						$.each(i2, function(i11,i12){
							obj.append('<option value="'+i11+'">'+i12+'</option>');
						});
						

					}
				});
				
				__this.pro_select.val(__this.pro_val);
				__this.cit_select.val(__this.cit_val);
				__this.cut_select.val(__this.cut_val);

			}
		}, 'json').fail(function() {
		}).always(function() {
		});
	}
}


makeUp.fn = makeUp.prototype = {
	constructor: makeUp,
	data:{},
	btn:null,
	showDiv:null,
	init: function(data) {
	
		var _this = this;
		test = this;
		this.data = data;
		this.url = data.up_url;
		this.btn = $('#'+data.id).css({'height':'30xp;','position':' relative','overflow':' hidden','margin-right':' 4px','display':'inline-block','*display':'inline','padding':'4px 10px 4px','font-size':'14px','line-height':'18px','*line-height':'20px','color':'#fff','text-align':'center','vertical-align':'middle','cursor':'pointer','background-color':'#5bb75b','border':'1px solid #cccccc','border-color':'#e6e6e6 #e6e6e6 #bfbfbf','border-bottom-color':'#b3b3b3','-webkit-border-radius':'4px','-moz-border-radius':'4px','border-radius':'4px'});
		this.showDiv = $('#'+data.showDiv_id);
		this.in_btn = this.btn.find('input');
		this.title  = this.btn.find('span').html(this.data.title);
		this.in_btn.attr('name',this.data.action).css({'position':' absolute','top':' 0',' right':' 0','margin':' 0','border':' solid transparent','opacity':' 0','filter':'alpha(opacity=0)',' cursor':' pointer'});
		this.upid = 'my'+data.id;
		this.progress = $('<div class="progress"></div>');
		this.bar = $('<span class="bar"></span>');
		this.percent = $('<span class="percent">0%</span >');
		this.files = $('<div class="files"></div>');
		this.progress.append(this.bar);
		this.progress.append(this.percent);
		
		
		
		if (data.old_img.length >0) {
			this.makeDelBtn(data.old_img);
		} else {
			console.log('no');
		}
		
		//this.btn.after(this.progress);
		if (typeof this.data.file_id == "string") {
			$('#'+this.data.file_id).append(this.files);
		} else {
			this.btn.after(this.files);
		}
		
		this.btn.after('<input style="display:none;" type="file"><br/>');
		
		if (typeof this.data.param_id == 'string') {
			this.in_btn.wrap("<form id='"+this.upid+"' action='"+this.url+"?id="+this.data.param_id+"' method='post' enctype='multipart/form-data'></form>");
		} else {
			this.in_btn.wrap("<form id='"+this.upid+"' action='"+this.url+"' method='post' enctype='multipart/form-data'></form>");	
		}
		
		this.in_btn.change(function(){

		console.log('change');
		
			var __this = _this;
			$("#"+_this.upid).ajaxSubmit({
				dataType:  'json',
				beforeSend: function() {
					__this.showDiv.empty();
					__this.progress.show();
					var percentVal = '0%';
					//__this.bar.width(percentVal);
					//__this.percent.html(percentVal);
					__this.title.html(percentVal);
				},
				uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					//__this.bar.width(percentVal);
					//__this.percent.html(percentVal);
					__this.title.html(percentVal);
				},
				success: function(data) {
					console.log(data);
					__this.makeDelBtn(data);
				},
				error:function(xhr){
					__this.title.html("上传失败");
					__this.bar.width('0')
					__this.files.html(xhr.responseText);
				}
			});
		});
		
		

	
		return this;
	},
	
	makeDelBtn : function(data){
		console.log(data);
		if (typeof data == "string") {
			var o = {};
			o.pic = this.data.img_dir + data;
			o.size = 1;
			o.name = data;
			data = o;
		}
		
		var __this = this;
		__this.del = $("<span class='delimg' rel='"+data.pic+"'>删除</span>");
		__this.files.html("<b>"+data.name+"("+data.size+"k)</b>");
		__this.files.append(__this.del);
		var img = "/upload/"+data.pic;
		__this.showDiv.html("<img width='100%' src='"+img+"'>");
		__this.title.html(__this.data.title);
		test = __this;
		var ___this = __this;
		__this.del.click(function(){
			var pic = $(this).attr("rel");
			if (typeof __this.data.param_id == "string") {
				var del_url = __this.url+"?act=delimg"+"&id="+__this.data.param_id;
			} else {
				var del_url = __this.url+"?act=delimg";
			}
			$.post(del_url,{imagename:pic},function(msg){
				if(msg==1){
					//___this.title.html("删除成功.");
					___this.showDiv.empty();
					___this.progress.hide();
					__this.files.empty();
				}else{
					alert(msg);
				}
			});
		});
	}
}
makeUp.fn.init.prototype = makeUp.fn;

var DelBtn = {
	del_url : "http://" + location.host + "/Ajaxapp/",
	init : function(){
		var _this = this;

		if ($('.del_btn').length < 1) return ;
		
		$('body').on('click', '.del_btn', function(){

			if (confirm('确定要执行吗？')){
				
				var tr = $(this).parents('tr');
				if (tr.attr('data-mate') == undefined) {
					//var tr = $(this).parents('li');	
					return true;
				} else {
					var data = eval("("+tr.attr('data-mate')+")");
					var url = _this.del_url + data.type;
					$.get(url,data, function(res) {
						if (res.code ==1) {
							tr.hide();
							alert('删除成功');
						} else {
							alert('删除失败，请刷新重试');
						}
					}, 'json').fail(function() {
					}).always(function() {
					});
				}
			} else {
				return false;
			}
		});
	}
}


