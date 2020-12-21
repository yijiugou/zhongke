<?php  echo $this->element('pc_view_header');?>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default">
	<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	</script>

	<div class="navbar-container" id="navbar-container">


    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
        <span class="sr-only">Toggle sidebar</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>
    </button>
		<div class="navbar-header pull-left">
			<!-- #section:basics/navbar.layout.brand -->
			<a href="#" class="navbar-brand">
				<small>
					消费评论后台管理
				</small>
			</a>
		</div>

          <!--  ########## 用户登录管理 ################ -->
          <?php  echo $this->element('navbar_dropdown');?>

	</div>
</div>

<div class="main-container" id="main-container">
     <script type="text/javascript">
     	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
     </script>

     <!--  ########## 菜单导航 ############# -->
     <?php  echo $this->element('admin_sidebar');?>


     

     <div class="main-content">
     	

          <!--  ########## 站内导航 ############# -->
          <?php  echo $this->element('breadcrumbs');?>


     	<div class="page-content">

     		<div class="page-content-area">
     			<div class="row">
     				<div class="col-xs-12">

                         
     					<!-- 内容 -->
                              <?php echo $this->fetch('content'); ?>
     			
                <?php 

                if (!class_exists('ConnectionManager') || Configure::read('debug') < 2) {
                }  else {
                    echo $this->element('sql_dump');
                }
                ?>
     				</div>
     			</div>
     		</div>
     	</div>

     </div>


     <!--  ########## 底部信息 ############# -->
     <?php  echo $this->element('pc_view_footer'); ?>


</div>
 </body>  
</html>  