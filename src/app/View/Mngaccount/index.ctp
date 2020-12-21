<div class="page-header">
	<h3>
		账户余额
	</h3>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-3" >
	<label class=" control-label no-padding-right col-sm-12" for="form-field-1"> <h4>当前账户余额：</h4></label>
		
	</div>
	<div class="col-xs-12 col-sm-9">
		<button class="btn btn-warning btn-lg"><?php echo $comInfo['company_account'];?> 元</button>
	</div>
</div>
<br/><br/>
<div class="row" style="display:none;">
	<div class="form-group">
	<div class="col-xs-12 col-sm-3" style="">
	<label class=" control-label no-padding-right col-sm-12" for="form-field-1"> <h4>充值金额：</h4></label>
		
	</div>
		<div class="col-xs-12 col-sm-9">
				<input type="text" id="form-field-1"   class="col-xs-3 col-sm-2">
		</div>
	</div>
</div>

<h3 class="header smaller lighter red" style="display:none;">充值方式</h3>





<div class="payment-list" id="" style="display:none;">
	<div class="list-cont">
	  
	  <ul id="payment-list">
	  	<li style="">
	      	<div value="weixin" class="payment-item  item-selected "><b></b><img width="130px" src="/img/wx.gif"></div>
	      </li>
	       <li style="cursor: pointer;">
	      	<div value="alipay" class="payment-item   "><b></b><img width="130px" src="/img/ali.gif"></div>
	      </li>
	        
	</ul>
	   <div class="clr"></div>
	</div>
</div>


<div class="row" style="display:none;">
<div class="wizard-actions">
	<!-- #section:plugins/fuelux.wizard.buttons -->


	<button  class="btn btn-success btn-next no-border btn-sm" data-last="Finish">
		充值
		<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
	</button>

	<!-- /section:plugins/fuelux.wizard.buttons -->
</div>
	</div>



