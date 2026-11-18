<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	<?php echo $this->Html->meta(array('http-equiv'=>'refresh' , 'content' => '1740'));?>
    <title>Online Application Portal For Major Ports</title>

    <!-- Bootstrap -->
    
	<?php echo $this->HTML->css('bootstrap/css/bootstrap.min'); ?>
  
    <?php echo $this->HTML->css('font-awesome.min'); ?>   
	<!-- Ionicons -->
    
    <?php echo $this->HTML->css('ionicons.min'); ?>
	
    <?php echo $this->HTML->css('dist/css/AdminLTE.min');  ?>
	
	<?php echo $this->Html->css('/js/plugins/datepicker/datepicker3'); ?>
	
	<?php echo $this->Html->script(array('plugins/jQuery/jQuery-2.1.3.min',
	                                     '/css/bootstrap/js/bootstrap.min',
										 'plugins/encode/md5',
										 'plugins/datepicker/bootstrap-datepicker',
										 //'plugins/fastclick/fastclick.min',
										 'plugins/JqueryValidation/js/jquery.validate',
										'plugins/JqueryValidation/js/additional-methods',
										'plugins/JqueryValidation/js/jquery.metadata',
										'plugins/rsa/rsa.min'
	                                     )
								   ); ?>
	<script>
	$(function(){
	$.validator.addMethod("alphabetspace", function(value, element) {
					return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
					}, "Please enter alphabets and space only.");
					
	$.validator.addMethod("alphabet", function(value, element) {
					return this.optional(element) || /^[a-zA-Z]+$/.test(value);
					}, "Please enter alphabets only. Space is not allowed.");				
	
	})
	</script>	
    
	<?php echo $this->Html->css('dist/css/animate'); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	<style>
	.nav li a{
			color:#fff;
			border-top: 1px solid yellow;
			margin-left:4px;
			font-weight:bold
		}
	.nav li a:hover{
			color:#000;
			font-weight:bold
		
		}	
	.navbar
	{
		margin-bottom:0px;
	}


            h2, .h2 {
                /*font-size: 48px;*/
                font-weight: 300;
                letter-spacing: 2.4px;
                line-height: 1;
            }
            h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
                font-family: "Raleway",Helvetica,Arial,sans-serif;
                font-weight: 300;
               /* margin: 0;*/
            }
            .p__mod {
                font-size: 18px;
                letter-spacing: 0.9px;
                line-height: 30px;
            }
            h2 + p {
                margin-top: 34px;
            }

            .bg-head-blue
            {
                     background-color: #31c1e4;
                border-radius: 50%;
                height: 103px;
                line-height: 103px;
                margin: 6px 22px 10px 0;
                text-align: center;
                width: 103px;

            }
            .bg-head-orange
            {
                     background-color: #F7902F;
                border-radius: 50%;
                height: 103px;
                line-height: 103px;
                margin: 6px 22px 10px 0;
                text-align: center;
                width: 103px;

            }	
            .font-white
            {
                    color:#fff !important;
                    font-size: 70px !important;
            }
            blockquote {
            border:0px;
            }
@media (min-width: 881px) {
  .button-strip{
  background-color:#009ABF;margin-top:138px
  }
  
}			
@media (max-width: 880px) {
  .button-strip{
  background-color:#009ABF;margin-top:158px
  }
  
}
@media (max-width: 767px) {
  .button-strip{
  background-color:#009ABF;margin-top:137px
  }
  
}
@media (max-width: 489px) {
  .button-strip{
  background-color:#009ABF;margin-top:157px
  }
 }
@media (max-width: 406px) {
  .button-strip{
  background-color:#009ABF;margin-top:183px
  }
 } 
 @media (max-width: 305px) {
  .button-strip{
  background-color:#009ABF;margin-top:210px
  }
 } 
 @media (max-width: 273px) {
  .button-strip{
  background-color:#009ABF;margin-top:230px
  }
 }  
 @media (max-width: 249px) {
  .button-strip{
  background-color:#009ABF;margin-top:245px
  }
 }  
 



	</style>
	    <script type = "text/javascript" >
           function burstCache()
             { 
               if (!navigator.onLine) 
                { 
                    document.body.innerHTML = 'Loading...';

                    window.location = 'ErrorPage.html';

                }

             }

           $(function(){
               
            <?php
			if($this->request->clientIp()!='::1')
			  {
                echo'burstCache();';
              }  
			?>
           })

       </script>
 	 <script>

	  $(document).ready(function() {

	   var docHeight = $(window).height();
	   var footerHeight = $('#footer').height();
	   var footerTop = $('#footer').position().top + footerHeight;

	   if (footerTop < docHeight) {
		$('#footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
	   }
	   $('#footer').addClass('bg-black');
	   $('#footer section').addClass('bg-black');
	  });
	</script>       

        <script type="text/javascript">

            $(document).ready(function(){

                $(".login-model").click(function(){

                    $("#loginModal").modal('show');
                    $('#loginModelBody').html('Loading..');
					$.get(
                              '<?php echo $this->webroot;?>users/login',
                            
                            function(response){
                                                
                                                 $('#loginModelBody').html(response);
                                                 
                                        }
                              );
                });
				
				<?php
					if($this->Session->read('open_login'))
					{
					?>
						
						$(".login-model").trigger('click');
						
					<?php	
						unset($_SESSION['open_login']);
					}
				?>
				
				$(".forgot-password-model").click(function(){

                    $("#forgotPasswordModal").modal('show');
                    $('#forgotPasswordModelBody').html('Loading..');
					$.get(
                              '<?php echo $this->webroot;?>users/forgot_password',
                            
                            function(response){
                                                
                                                 $('#forgot_passwordModelBody').html(response);
                                                 
                                        }
                              );
                });

            });

        </script>


  </head>
  <body>
    	<header class="container-fluid navbar-fixed-top" style="background-color:#367fa9;margin-bottom:10%">
		<div class="row">
			<div class="col-xs-3 col-sm-2 col-md-1">
				<div class=" col-sm-offset-0 col-md-offset-0">
					<a href="<?php echo $this->webroot;?>" ><img class="img-responsive image-center" src="<?php echo $this->webroot;?>/img/inlogo.png" style="padding-top:10px;height:100px"/>
					</a>
				</div>	
			</div>
			<div class="col-xs-9 col-sm-10 col-md-11">
				<div class="row nogutter">
					<div class="col-xs-12 col-sm-6 col-md-6 ">
						<h3 style="color:#fff">
							Online Application Portal For Major Ports
							
						</h3>
						<h4 class="" style="color:rgb(224,142,11)">Ministry of Shipping (Government of India)</h4>
						<!--<h4 class="" style="color:rgb(254,199,21)">Ministry of Shipping (Government of India)</h4>-->
					</div>
					<div class="hidden-xs col-xs-12 col-sm-6 col-md-6"><?php //echo date('d(D),M,Y')?>
						<h4  class="pull-right">&nbsp;<small style="color:#FFEBCD"><?php echo date('d-m-Y')?></small></h4>
					</div>	
				</div>
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-static-top">
        
						    <div class="navbar-header">
						     
	
						      <button data-target="#navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed"
							 type="button" aria-expanded="false">
							<i class="fa fa-bars"></i>
						      </button>
						    </div>

						    <!-- Collect the nav links, forms, and other content for toggling -->
						    <div id="navbar-collapse" class="navbar-collapse pull-right collapse"
							 aria-expanded="false" style="height: 1px;">
						      <ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo $this->webroot;?>">Home <span class="sr-only">(current)</span></a></li>
							<?php if(!($this->request->params['controller']=='users' && $this->request->params['action']=='reset_password')) {?>
							
							<li><a href="<?php echo $this->webroot;?>#drag">Current Openings</a></li>
							<li><a href="<?php echo $this->webroot;?>pages/view/how_to_apply">How to Apply</a></li>
							<li><a href="<?php echo $this->webroot;?>home/download_guidelines" target="_blank">Guidelines</a></li>
							<li><a href="<?php echo $this->webroot;?>pages/view/faq">FAQs</a></li>
							<li><a href="<?php echo $this->webroot;?>pages/view/contact_us">Contact us</a></li>
							<?php }?>
						      </ul>
									      
						    </div><!-- /.navbar-collapse -->
						  
						  
						</nav>
					</div>
				</div>
				
			</div>
		</div>
	</header>
	
   
	<section class="button-strip">
	  <div class="container pad">
		<?php if(!($this->request->params['controller']=='users' && $this->request->params['action']=='reset_password')) {?>							
		<div class="row">
			<div class="col-xs-12 col-xs-offset-4 col-sm-12 col-sm-offset-4 col-md-12 col-md-offset-5">
				
			<a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'user_registration'));?>">
			<button class="btn btn-info btn-lg btn-flat animated bounceInLeft" id="registration">Sign Up</button></a>
				<!--button class="btn btn-info btn-lg btn-flat login-model animated bounceInLeft" id="applicantlogin">Applicant Login</button-->
				<button class="btn btn-warning btn-lg btn-flat login-model animated bounceInRight" id="adminlogin">Sign In</button>	
			</div>
		</div>
		<?php } ?>
	  </div>
	</section>
	
	
	<main>
            <div class="container"> 
                <!-- Modal HTML -->

                <div id="loginModal" class="modal fade modal-info">

                    <div class="modal-dialog" style="max-width:350px;">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Sign In</h4>

                            </div>

                            <div class="modal-body box no-border" id="loginModelBody" style="background-color:#fff !important">

                                <p>Loading...</p>

                                

                            </div>

                        </div>

                    </div>

                </div>
				
                <div id="forgotPasswordModal" class="modal fade modal-info">

                    <div class="modal-dialog" style="max-width:350px;">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Forgot Password</h4>

                            </div>

                            <div class="modal-body box no-border" id="forgotPasswordModelBody" style="background-color:#fff !important">

                                <p>Loading...</p>

                                

                            </div>

                        </div>

                    </div>

                </div>				
				
				
				
            </div>
	<?php echo $this->fetch('content');?>
</main>
<footer class="footer " id="footer" >
<section class="container">
	<div class="row">
		<div class="col-md-6 pad">
			<div class="pull-left">
				Copyright&copy;<?php echo date('Y');?> Ministry of Shipping(Govt. of India)
			</div>	
		</div>
		<div class="col-md-6 pad">
			<div class="pull-right">
				<ul class="list-inline">
				<li><a href="<?php echo $this->webroot;?>">Home</a></li>
				<li><a href="<?php echo $this->webroot;?>pages/view/about_us">About Us</a></li>
				<li><a href="<?php echo $this->webroot;?>pages/view/privacy_policy">Privacy Policy</a></li>
				</ul>
				     <ul class="list-inline"><li><a href="http://www.nic.in" target='blank'>Design & Developed By: National Informatics Centre (NIC)</a></li></ul>
			</div>	
		</div>
	</div>
</section>



    <!--script src="js/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
    <script src="css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script-->

  </body>
</html>
