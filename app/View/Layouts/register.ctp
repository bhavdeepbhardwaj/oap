<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
	<?php echo $this->Html->css('bootstrap/css/bootstrap.min'); ?>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
	<?php echo $this->Html->css('dist/css/AdminLTE.min'); ?>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <?php echo $this->Html->css('dist/css/skins/_all-skins.min'); ?>
	 <?php echo $this->Html->css('/js/plugins/datepicker/datepicker3'); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="../../https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="../../https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.3 -->
	<?php echo $this->Html->script('plugins/jQuery/jQuery.min'); ?>
    

	<?php 		echo $this->Html->script(array(
				'plugins/jQueryUI/jquery-ui-1.10.3.min',
				
				'plugins/JqueryValidation/js/jquery.validate',
				'plugins/JqueryValidation/js/additional-methods',
				'plugins/JqueryValidation/js/jquery.metadata',
				'plugins/datepicker/bootstrap-datepicker'
				));
	?>	
	
			    <!-- Open After Auditing-->
		 
		 <script type = "text/javascript" >
			function burstCache()
			{ 
				if (!navigator.onLine) 
				{ 
					document.body.innerHTML = 'Loading...';

					window.location = 'ErrorPage.html';

				}

		    }


	   </script> 
        <script type="text/javascript">
		<?php //echo $this->request->clientIp();exit;?>
            var idleTime = 0;
            $(document).ready(function () {
			<?php
			if($this->request->clientIp()!='::1')
			{
                echo'burstCache();';
            }  
			?>
                //Increment the idle time counter every minute.
                var idleInterval = setInterval(timerIncrement, 1000); // 1 sec

                //Zero the idle timer on mouse movement.
                $(this).mousemove(function (e) {
                    idleTime = 0;
                });
                $(this).keypress(function (e) {
                    idleTime = 0;
                });
            });

            function timerIncrement() {
                idleTime = idleTime + 1;
                if (idleTime > (60*30)) { // 20 minutes
                    window.location.reload();
                }
            }
    </script>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">
      
      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
          <div class="navbar-header">
            <a href="../../index2.html" class="navbar-brand"><b>Online Recruitment System</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
           
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              
              <small></small>
            </h1>
            <!--ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Dashboard</li>
            </ol-->
          </section>

          <!-- Main content -->
          <section class="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
			
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="pull-right hidden-xs">
            <b></b>
          </div>
          <center><strong>Copyright &copy;<a href="#"> Ministry Of Shipping , Govt. Of India</a></strong></center><span class="pull-right";>Designed & Developed By NIC</span>
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

									
     <!-- Bootstrap 3.3.2 JS -->
	<?php echo $this->Html->script('/css/bootstrap/js/bootstrap.min'); ?>
    <!-- FastClick -->
   <?php echo $this->Html->script('plugins/fastclick/fastclick.min'); ?>
     <!-- InputMask -->
		<?php echo $this->HTML->script('plugins/input-mask/jquery.inputmask'); ?>
		<?php echo $this->HTML->script('plugins/input-mask/jquery.inputmask.date.extensions'); ?>
		<?php echo $this->HTML->script('plugins/input-mask/jquery.inputmask.extensions.js'); ?>
    
    <!-- AdminLTE App -->
	<?php echo $this->Html->script('/css/dist/js/app.min'); ?>
	<script type="text/javascript">
      $(function () {
        
        
        $("[data-mask]").inputmask();
		});
		</script>
  </body>
</html>
