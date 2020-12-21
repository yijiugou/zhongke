
<div class="page-header">
<h1>
账户日志一览
</h1>
</div>

<?php
	// prs($product);
	echo $this->Session->flash(); 
?>

<div  class="row" >
	<div class="form-group col-xs-12 col-sm-12 ">
		<label class=" control-label no-padding-right col-sm-5" for="form-field-1"><h4><?php htmlsp($info['company_shortname'])?> 当前余额：<b class="red"><?php echo $info['company_account'];?></b> 元</h4></label>
		

	</div>

	
	
</div>

<form class="" id="validation-form" method="post">
<div  class="row" >
	<div class="form-group col-xs-12 col-sm-12 ">
		<label class=" control-label no-padding-right col-sm-12" for="form-field-1">充值金额： <input type="text" class="num_input_m input_account" name="input_account"    value="" > 元

			&nbsp;&nbsp;&nbsp;
		<button class="btn btn-success btn-next no-border btn-sm" data-last="Finish">充值</button>
		</label>
		



		
	</div>

	
	
</div>

</form>


<div class="row">
	<div class="col-xs-12">

	<div style="margin: 30px 0 10px 0;">账户日志一览：</div>
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

  </div>

