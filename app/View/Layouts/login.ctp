<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
	<?php
	echo $this->HTML->css('bootstrap/css/bootstrap.min');
	?>
   
    <!-- Font Awesome Icons -->
    <!--link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /-->
    <!-- Theme style -->
	<?php
	echo $this->HTML->css('dist/css/AdminLTE.min');
	?>
  
    <!-- iCheck -->
	<!--For Remember Me check box -->
	<?php
	echo $this->HTML->css('/js/plugins/iCheck/square/blue');
	?>
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <?php 
	
	echo $this->fetch('content');
	?>

    <!-- jQuery 2.1.3 -->
	<?php
	echo $this->HTML->script('plugins/jQuery/jQuery.min');
	//echo $this->HTML->script('plugins/jQuery/jQuery-2.1.3.min');
	?>
    <script src="../../plugins/jQuery/jQuery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
	<?php
	echo $this->HTML->script('/css/bootstrap/js/bootstrap.min');
	?>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
	<?php
	echo $this->HTML->script('plugins/iCheck/icheck.min');
	?>
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>