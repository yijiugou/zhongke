<div class="navbar-buttons navbar-header pull-right"  >
	<ul class="nav ace-nav ">
	
		<?php if(isset($isLogin) && $isLogin):?>
			
			<li class="black">欢迎您 ：
			<?php 
			if ($loginType == 'company') {
				echo $loginUser['company_shortname'];
				if (isset($userAuth) && $userAuth['user_type'] == 'company_user') {
					echo $userAuth['auth_name'].' '.$userAuth['user_name'];

				}

			}
			if ($loginType == 'retailer')
				echo $loginUser['retailer_shortname'];
			if ($loginType == 'admin')
				echo "管理员";

			?>&nbsp;&nbsp;&nbsp;</li>
			<li class="red"><a href="/login/logout"><i class="ace-icon fa fa-power-off"></i>安全退出</a></li>
		<?php endif;?>
		

		</li>
	</ul>
</div>
