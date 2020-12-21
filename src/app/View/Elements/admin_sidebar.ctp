
<div id="sidebar" class="sidebar                  responsive">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>


	<ul class="nav nav-list" style="top: 0px;">
		<li class="">
			<a href="/Mngaccount/view">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> 网站信息 </span>
			</a>
			<b class="arrow"></b>
		</li>


		<?php if ($name == 'mngcompany' || ($name == 'mngaccount' && $action =='recharge')) :?>
				<li class="active open">
		<?php else:?>
				<li class="sub">
		<?php endif;?>
					<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-pencil-square-o"></i>
						<span class="menu-text"> 文章管理 </span>

						<b class="arrow fa fa-angle-down"></b>
					</a>

					<b class="arrow"></b>
					<ul class="submenu">

						<?php if (($name == 'mngcompany' && ($action == 'showlist' || $action=='edit' || $action == 'info' || $action = 'delall')) || ($name == 'mngaccount' && $action =='recharge')) :?>
								<li class="active">
						<?php else:?>
								<li class="">
						<?php endif;?>
							<a href="/Article/articlelist">
								<i class="menu-icon fa fa-caret-right"></i>
								文章列表
							</a>
							<a href="/Article/tuijian">
								<i class="menu-icon fa fa-caret-right"></i>
								推荐列表
							</a>
							<a href="/Article/adlist">
								<i class="menu-icon fa fa-caret-right"></i>
								广告列表
							</a>
							<a href="/Article/category">
								<i class="menu-icon fa fa-caret-right"></i>
								文章分类
							</a>
							<a href="/Article/productlist">
								<i class="menu-icon fa fa-caret-right"></i>
								官荣评分
							</a>
							<a href="/Article/gruserlist">
								<i class="menu-icon fa fa-caret-right"></i>
								官荣人员
							</a>

							<b class="arrow"></b>
						</li>

						

					</ul>
				</li>
			<li class="">
				<a href="/Person/personasklist">
					<i class="menu-icon fa fa-users"></i>
					<span class="menu-text"> 招聘列表 </span>
				</a>
				<b class="arrow"></b>
			</li>





<!--<?php if ($name == 'mngretailer') :?>-->
		<!--<li class="active open">-->
<!--<?php else:?>-->
		<!--<li class="sub">-->
<!--<?php endif;?>-->
			<!--<a href="" class="dropdown-toggle">-->
				<!--<i class="menu-icon fa fa-users"></i>-->
				<!--<span class="menu-text"> 零售商管理 </span>-->

				<!--<b class="arrow fa fa-angle-down"></b>-->
			<!--</a>-->

			<!--<b class="arrow"></b>-->

			<!--<ul class="submenu">-->

				<!--<?php if ($name == 'mngretailer' && ($action == 'index' || $action=='edit' || $action == 'info' || $action == 'delall')) :?>-->
						<!--<li class="active">-->
				<!--<?php else:?>-->
						<!--<li class="">-->
				<!--<?php endif;?>-->
					<!--<a href="/Mngretailer/index">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--零售商一览-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->
				<!---->

				<!--<?php if ($name == 'mngretailer' &&  $action == 'map') :?>-->
						<!--<li class="active">-->
				<!--<?php else:?>-->
						<!--<li class="">-->
				<!--<?php endif;?>-->
					<!--<a href="/Mngretailer/map">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--零售商分布地图-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->

			<!--</ul>-->
		<!--</li>-->

		<!--<?php if ($name == 'mngcustomer') :?>-->
				<!--<li class="active open">-->
		<!--<?php else:?>-->
				<!--<li class="sub">-->
		<!--<?php endif;?>-->
			<!--<a href="/mngcustomer" class="dropdown-toggle">-->
				<!--<i class="menu-icon fa fa-bookmark"></i>-->
				<!--<span class="menu-text"> 消费者管理 </span>-->

				<!--<b class="arrow fa fa-angle-down"></b>-->
			<!--</a>-->

			<!--<b class="arrow"></b>-->

			<!--<ul class="submenu">-->

			<!--<?php if ($name == 'mngcustomer' && $action == 'index') :?>-->
					<!--<li class="active">-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
				<!--<a href="/mngcustomer/index">-->
					<!--<i class="menu-icon fa fa-caret-right"></i>-->
					<!--消费者一览-->
				<!--</a>-->

				<!--<b class="arrow"></b>-->
			<!--</li>-->



				<!--<?php if ($name == 'mngcustomer' && $action == 'showlock') :?>-->
						<!--<li class="active">-->
				<!--<?php else:?>-->
						<!--<li class="">-->
				<!--<?php endif;?>-->
					<!--<a href="/mngcustomer/showlock">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--冻结消费者列表-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->
			<!--</ul>-->
		<!--</li>-->




		<!--<?php if ($name == 'mngprize') :?>-->
				<!--<li class="active open">	-->
		<!--<?php else:?>-->
				<!--<li class="sub">-->
		<!--<?php endif;?>-->
			<!--<a href="" class="dropdown-toggle">-->
				<!--<i class="menu-icon fa fa-bookmark"></i>-->
				<!--<span class="menu-text"> 红包管理 </span>-->

				<!--<b class="arrow fa fa-angle-down"></b>-->
			<!--</a>-->

			<!--<b class="arrow"></b>-->

			<!--<ul class="submenu">-->

			<!--<?php if ($name == 'mngprize' && ($action == 'index' || $action=='view' || $action == 'edit' || $action == 'seting' || $action == 'addbaofei')) :?>-->
					<!--<li class="active">					-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
				<!--<a href="/Mngprize/index">-->
					<!--<i class="menu-icon fa fa-caret-right"></i>-->
					<!--红包设置一览-->
				<!--</a>-->

				<!--<b class="arrow"></b>-->
			<!--</li>-->

			<!--<?php if ($name == 'mngprize' && $action == 'logs') :?>-->
					<!--<li class="active">-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
					<!--<a href="/Mngprize/logs">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--红包领取记录-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->

			<!--<?php if ($name == 'mngprize' && $action == 'customerlog') :?>-->
					<!--<li class="active">-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
					<!--<a href="/Mngprize/customerlog">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--消费者红包统计-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->


			<!--<?php if ($name == 'mngprize' && $action == 'blacklist') :?>-->
					<!--<li class="active">-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
					<!--<a href="/Mngprize/blackList">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--黑名单一览-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->

			<!--</ul>-->
		<!--</li>-->



		<!--<?php if ($name == 'mngsell') :?>-->
				<!--<li class="active open">-->
		<!--<?php else:?>-->
				<!--<li class="sub">-->
		<!--<?php endif;?>-->
			<!--<a href="/Mngsell" class="dropdown-toggle">-->
				<!--<i class="menu-icon fa fa-bullhorn"></i>-->
				<!--<span class="menu-text"> 销售返点管理 </span>-->

				<!--<b class="arrow fa fa-angle-down"></b>-->
			<!--</a>-->

			<!--<b class="arrow"></b>-->

			<!--<ul class="submenu">-->



			<!--<?php if ($name == 'mngsell' && $action == 'index') :?>-->
					<!--<li class="active">-->
			<!--<?php elseif($name == 'mngsell' && $action == 'view'):?>-->
					<!--<li class="active">-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
				<!--<a href="/Mngsell/index">-->
					<!--<i class="menu-icon fa fa-caret-right"></i>-->
					<!--销售返点规则一览-->
				<!--</a>-->

				<!--<b class="arrow"></b>-->
			<!--</li>-->


			<!--<?php if ($name == 'mngsell' && $action == 'logs') :?>-->
					<!--<li class="active">-->
			<!--<?php else:?>-->
					<!--<li class="">-->
			<!--<?php endif;?>-->
					<!--<a href="/Mngsell/logs">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--销售返点记录-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->

				<!--<?php if ($name == 'mngsell' && $action == 'retailerlog') :?>-->
						<!--<li class="active">-->
				<!--<?php else:?>-->
						<!--<li class="">-->
				<!--<?php endif;?>-->
					<!--<a href="/Mngsell/retailerlog">-->
						<!--<i class="menu-icon fa fa-caret-right"></i>-->
						<!--零售商返点统计-->
					<!--</a>-->

					<!--<b class="arrow"></b>-->
				<!--</li>-->

			<!--</ul>-->
		<!--</li>-->

<!--<?php if (0) :?>-->

		<!--<?php if ($name == 'ad') :?>-->
				<!--<li class="active">-->
		<!--<?php else:?>-->
				<!--<li class="sub">-->
		<!--<?php endif;?>-->
			<!--<a href="/ad" >-->
				<!--<i class="menu-icon fa fa-desktop"></i>-->
				<!--<span class="menu-text"> 图文广告管理 </span>-->
			<!--</a>-->

			<!--<b class="arrow"></b>-->

		<!--</li>-->

		<!--<?php endif;?>-->



	</ul><!-- /.nav-list -->

	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>