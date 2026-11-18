<?php

$cakeDescription = __d('cake_dev', 'Error: OAP: On-line Application Portal');


?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		
        </title>

       
	<?php
		echo $this->Html->meta('icon');
             
		echo $this->Html->css(array(
									'bootstrap/css/bootstrap.min',
									'font-awesome.min',
									'ionicons.min',
									'dist/css/AdminLTE.min',
									'dist/css/skins/skin-blue.min',
																	
									));
		
		echo $this->Html->script(array('jquery.min',
										'jquery-ui.min',
										'jquery.PrintArea.js_4',
										'plugins/bootstrap/bootstrap.min',
										
										
										));

		
	?>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
                 
				 
				 <!--Open After Auditing-->

				 
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
        
		
</head>
<body class="skin-blue">


	<!--header starts here-->
			<?php echo $this->element("header");?>
	<!--header ends here-->
	<div class="wrapper row-offcanvas row-offcanvas-left">
		

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
				<?php echo $this->element("content_header");?>
			<!-- /.Content Header -->
			<!-- Main content -->
			<section class="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch("content");?>
			</section>
			<!-- /.content -->
		</aside>
		<!-- /.right-side -->
	</div><!-- ./wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
	  <?php echo $this->element('sql_dump'); ?>
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          
        </div>
        <!-- Default to the left --> 
        <center><strong>Copyright &copy; <?php echo date('Y')?> <a href="http://shipmin.nic.in/" target="_blank">Ministry Of Shipping , Govt. of India</a></strong></center>
      </footer>
</body>
</html>
