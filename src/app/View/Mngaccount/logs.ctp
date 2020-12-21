<div class="page-content-area">
<div class="row">
<div class="col-xs-12">

<div class="page-header">
<h1>
账户日志一览
</h1>
</div>


<form class="form-horizontal pc_search" id="validation-form" method="get">

	<div  class="row" >
		<div class="form-group col-xs-12 col-sm-4 ">
				<label class=" control-label no-padding-right col-sm-5" for="form-field-1">出入账选择：</label>
				<select id="inout_flg" name="inout_flg" class="select2 col-xs-12 col-sm-5" data-placeholder=" 请选择 ">
					<option value=""> --请选择-- </option>
					<option <?php if (isset($data['inout_flg']) && $data['inout_flg'] == 1) echo "selected";?> value="1">充值</option>
					<option <?php if (isset($data['inout_flg']) && $data['inout_flg'] == 0) echo "selected";?>  value="0">支出</option>
					
				</select>

		</div>

		
		
	</div>

	<div class="row">
		
		
		<div class="form-group col-xs-12 col-sm-4">
			    <label class=" control-label no-padding-right col-sm-5" for="form-field-1"> 开始时间：</label>


			    <div class="input-group col-sm-6">
			    	<input class="form-control date-picker" id="id-date-picker-1"  value='<?php if (isset($data['t_start'])) echo $data['t_start'];?>' name="t_start" type="text" data-date-format="yyyy-mm-dd">
			    	<span class="input-group-addon">
			    		<i class="fa fa-calendar bigger-110"></i>
			    	</span>
			    </div>
			
		
		</div>


			
		<div class="form-group col-xs-12 col-sm-4">
			    <label class=" control-label no-padding-right col-sm-5" for="form-field-1"> 结束时间：</label>


			    <div class="input-group col-sm-6">
			    	<input class="form-control date-picker" id="id-date-picker-1" name="t_end" value="<?php if (isset($data['t_end'])) echo $data['t_end'];?>" type="text" data-date-format="yyyy-mm-dd">
			    	<span class="input-group-addon">
			    		<i class="fa fa-calendar bigger-110"></i>
			    	</span>
			    </div>
			
		
		</div>

		<div class="form-group col-xs-12 col-sm-4" style="text-align: center;">
			<button type="button" class="btn btn-white btn-inverse btn-sm select_range day_select" t_type="day">今日</button>&nbsp;
			<button type="button" class="btn btn-white btn-inverse btn-sm select_range" t_type="week">最近7天</button>&nbsp;
			<button type="button" class="btn btn-white btn-inverse btn-sm select_range" t_type="month">最近30天</button>
		</div>
	</div>
	<div class="row">
		


		<div class="col-xs-12 col-sm-12" style="text-align: right;">
			
			<button class="btn btn-primary no-border btn-sm">
			<i class="ace-icon fa fa-search"></i>
			检&nbsp;&nbsp;&nbsp;索</button>
		</div>

	</div>
</form>




<br/>
<div class="row">
	<div class="col-xs-12">
		<table id="sample-table-2" class=" dataTable table table-striped table-bordered table-hover">
			<thead>


				<tr>
					<th class="center">
						ID
					</th>
					<th class="center ">时间</th>
					<th class="center ">产生类型</th>
					<th class="center" >金额</th>
				
					<th class="center " >对象</th>

					<?php if (!isset($data['inout_flg']) || $data['inout_flg'] == "") :?>
					<th class="center ">余额</th>
					<?php endif;?>
				</tr>
			</thead>

			<tbody>
			

			<?php 

            if(empty($logs)){
				echo "<td colspan='7'><center>暂无数据！</center></td>";
			}else{

				foreach($logs as $row) :
				$v = $row['account_log'];
				$c = $row['customer_tbl'];
			?>
				<tr >
					<td class="center">
						<?php echo $v['id'];?>
					</td>
					<td class="center ">
						<?php echo $v['createtime'];?>
					</td>
					<td class="center ">
						<?php echo getAccountType($v['account_type']);?>
					</td>
					<td class="center">
						<?php if ($v['inout_flg']){echo "+";}else{echo "-";} echo $v['accunt_size'];?>元
					</td>
					
				

					<td class="center">
						<?php if ($v['account_type'] == 0){
								echo getPayway($v['pay_way']);
							} elseif ($v['account_type'] == 1) {
								echo htmlsp($c['customer_nickname']);
							}
						?>
					</td>
					<?php if (!isset($data['inout_flg']) || $data['inout_flg'] == "") :?>
					<td class="center"><?php echo $v['remain']?></td>
					<?php endif;?>
				</tr>


			<?php endforeach;
		}
			?>

			</tbody>
		</table>
	</div><!-- /.span -->
</div>

<br/>

<div class="col-xs-12 dataTables_paginate no-padding">
            <?php 
 
                echo getPageHtml($count,LIMIT);

            ?>
      </div>

  </div></div></div>
