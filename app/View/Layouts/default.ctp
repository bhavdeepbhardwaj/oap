<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Online Application Portal| Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
	<?php echo $this->HTML->css('bootstrap/css/bootstrap.min'); ?>
    
    <!-- Font Awesome Icons -->
   
	 <?php echo $this->HTML->css('font-awesome.min'); ?>   
	<!-- Ionicons -->
   
    <?php echo $this->HTML->css('ionicons.min'); ?>
	<!-- Theme style -->
	<?php echo $this->HTML->css('dist/css/AdminLTE.min');  ?>
    
	
    
	<?php echo $this->HTML->css('dist/css/skins/skin-blue.min'); ?>
	<?php echo $this->Html->css('/js/plugins/datepicker/datepicker3'); ?>
	<?php echo $this->HTML->css('/js/plugins/uploadifive/uploadifive'); ?>
	
	<?php 		echo $this->Html->script(array(
	                                    'plugins/jQuery/jQuery.min',
	                                    //'plugins/jQuery/jQuery-2.1.3.min', 
										'plugins/jQueryUI/jquery-ui-1.10.3.min',
										'plugins/encode/md5',
										'plugins/JqueryValidation/js/jquery.validate',
										'plugins/JqueryValidation/js/additional-methods',
										'plugins/JqueryValidation/js/jquery.metadata',
										'plugins/datepicker/bootstrap-datepicker',
										'plugins/simple-jQueryCharactersWordsCounterSimplyCountable/jquery.simplyCountable',
						                'plugins/jquery-word-count/jquery.wordcount',
										'plugins/rsa/rsa.min'
										));
	?>
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->
	
    
    <!-- Bootstrap 3.3.2 JS -->
	
	<?php echo $this->HTML->script('/css/bootstrap/js/bootstrap.min'); ?>
    <?php echo $this->HTML->script('plugins/uploadifive/jquery.uploadifive.min'); ?>
		 
		 
		    <!-- Open After Auditing-->
		 
		 <script>
    window.clientIp = <?php echo json_encode($this->request->clientIp()); ?>;
</script>	
	
  </head>

  <body class="skin-blue">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo"><b>Ministry of Shipping</b></a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              

              <!-- Notifications Menu -->
              
              <!-- Tasks Menu -->
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
				  
				  <?php 
				  
				  echo $this->Html->image('/users/download_self_profile_pic', array('alt' => 'Profile Photo','fullBase' => true,'class'=>'user-image'),'/',array('escapeTitle' => false));
				  ?>
				  
                  
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->Session->read('Auth.User.f_name').' '.$this->Session->read('Auth.User.l_name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
				   
                  <?php 
				  
				  echo $this->Html->image('/users/download_self_profile_pic', array('alt' => 'Profile Photo','fullBase' => true,'class'=>'img-circle'),'/',array('escapeTitle' => false));
				  ?>				   
                    <p>
					  <?php echo $this->Session->read('Auth.User.f_name').' '.$this->Session->read('Auth.User.m_name').' '.$this->Session->read('Auth.User.l_name'); ?>
					  <small>Member since <?php echo date('M . Y',strtotime($this->Session->read('Auth.User.created_on'))); ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php echo $this->HTML->link('Profile',array('controller'=>'users','action'=>'profile'),array('class'=>'btn btn-default btn-flat','fullBase' => true)); ?>  
                    </div>
                    <div class="pull-right">
                      <!--a href="#" class="btn btn-default btn-flat">Sign out</a-->
					  <?php echo $this->Form->postlink('Sign Out',array('controller'=>'users','action'=>'logout'),array('class'=>'btn btn-default btn-flat','fullBase' => true)); ?> 
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
	  
	  <?php echo $this->element('sidebar'); ?>
	  
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
        
			<!--small><?php //echo $this->Session->flash('edu_qualification'); ?></small-->
            <center><small>On-line Application Portal</small></center>
          </h1>          
        </section>

        <!-- Main content -->
        <section class="content">
		 <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch('content'); ?>
		 
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
	  <?php echo $this->element('sql_dump'); ?>
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          
        </div>
        <!-- Default to the left --> 
        <center><strong>Copyright &copy; <?php echo date('Y')?> <a href="http://shipmin.nic.in/" target="_blank">Ministry of Shipping , Govt. of India</a></strong></center>
      </footer>

    </div><!-- ./wrapper -->


	
	    <!-- InputMask -->
		<?php echo $this->HTML->script('plugins/input-mask/jquery.inputmask'); ?>
		<?php echo $this->HTML->script('plugins/input-mask/jquery.inputmask.date.extensions'); ?>
		<?php echo $this->HTML->script('plugins/input-mask/jquery.inputmask.extensions.js'); ?>
    
	
	
    
	<?php echo $this->HTML->script('/css/dist/js/app.min'); ?>
	
    <?php echo $this->Html->script('custom-app'); ?>
    
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>