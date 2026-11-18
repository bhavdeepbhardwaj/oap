<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/AdminLTE-2.1.1/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="js/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <link href="js/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	.nav li a{
			color:#fff;
		
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

	</style>
        

        <script type="text/javascript">

            $(document).ready(function(){

                $(".login-model").click(function(){

                    $("#loginModal").modal('show');

                });

            });

        </script>


  </head>
  <body >
    	<header class="container-fluid navbar-fixed-top" style="background-color:#367fa9;margin-bottom:10%">
		<div class="row">
			<div class="col-md-1">
				<a href="#"><img class="img-responsive image-center" src="myimg/logo.png" style="padding:10px;height:80px"/></a>
			</div>
			<div class="col-md-11">
				<div class="row">
					<div class="col-md-6">
					<h3 style="color:#fff">
						Online Recrutement Portal
						
					</h3>
					</div>
					<div class="col-md-6">
					<h4  class="pull-right">&nbsp;<small style="color:#FFEBCD">Ministry of Shipping (Govt. of India)</small></h4>
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
							<li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">New Vacancies</a></li>
							<li><a href="#">How to Apply</a></li>
							<li><a href="#">Guidlines</a></li>
							<li class="dropdown">
							  <a data-toggle="dropdown" class="dropdown-toggle" href="#">FAQs <span class="caret">
								</span></a>
							  <ul role="menu" class="dropdown-menu">
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
									      
						    </div><!-- /.navbar-collapse -->
						  
						  
						</nav>
					</div>
				</div>
				
			</div>
		</div>
	</header>
	
        <section style="margin-top:107px">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="myimg/b001.png" alt="Chania">
                    </div>

                    <div class="item">
                      <img src="myimg/b002.jpg" alt="Chania">
                    </div>
                    <div class="item">
                      <img src="myimg/b003.jpg" alt="Chania">
                    </div>
                    <div class="item">
                      <img src="myimg/b004.jpg" alt="Chania">
                    </div>	   
                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
        </section>
	<section style="background-color:#009ABF">
	  <div class="container pad">
		<div class="row">
			<div class="col-md-12 col-md-offset-4">
				
			    	<button class="btn btn-info btn-lg btn-flat animated bounceInLeft" id="registration">New Registration</button>
				<button class="btn btn-info btn-lg btn-flat login-model animated bounceInUp" id="applicantlogin">Applicant Login</button>
				<button class="btn btn-warning btn-lg btn-flat login-model animated bounceInLeft" id="adminlogin">Admin Login</button>	
			</div>
		</div>
	  </div>
	</section>
	<main>
            <div class="container"> 
                <!-- Modal HTML -->

                <div id="loginModal" class="modal fade modal-info">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Confirmation</h4>

                            </div>

                            <div class="modal-body">

                                <p>Do you want to save changes you made to document before closing?</p>

                                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                <button type="button" class="btn btn-primary">Save changes</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
	<section class="">
	<div class="container text-center">
		<blockquote>
		<h2>Welcome to Online Recrutement Portal</h2>
		<footer>Ministry of shipping (Govt. of India)</footer>
		</blockquote>
		<p class="p__mod">
		  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy 

			text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
		 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
		 It was popularised in the 1960s with the release of Letraset
 		sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
		 including versions of Lorem Ipsum.
		</p>
		
		
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<section class="well animated bounceInRight">
					<div class="row">
						<div class="col-md-4 col-xs-4 ">
							<figure class="btn btn-app bg-head-orange">
					    			<i class="fa fa-bell font-white"></i>
					
					  		</figure>
						</div>
						<div class="col-md-8 col-xs-8">
							<h3>New Vacancies</h3>
						</div>
				
					</div>
					<div class="row">
						<div class="col-md-12">
				 			<ul class="todo-list clearfix">
							<li><i class="fa fa-bell text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bell text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bell text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bell text-yellow"></i> <span class="text">Chrome</span></li>
						      	</ul>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-4">
				<section class="well">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<figure class="btn btn-app bg-head-blue">
					    			<i class="fa fa-clock-o font-white"></i>
					
					  		</figure>
						</div>
						<div class="col-md-8 col-xs-8">
							<h3>Notices</h3>
						</div>
				
					</div>	
					<div class="row">
						<div class="col-md-12">
				 			<ul class="todo-list">
							<li><i class="fa fa-clock-o text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-clock-o text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-clock-o text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-clock-o text-yellow"></i> <span class="text">Chrome</span></li>
						      	</ul>
						</div>
					</div>
				</section>			
			</div>
			<div class="col-md-4">
					<section class="well">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<figure class="btn btn-app bg-head-blue">
					    			<i class="fa fa-bullhorn font-white"></i>
					
					  		</figure>
						</div>
						<div class="col-md-8 col-xs-8">
							<h3>News</h3>
						</div>
				
					</div>
					<div class="row">
						<div class="col-md-12">
				 			<ul class="todo-list">
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
							<li><i class="fa fa-bullhorn text-yellow"></i> <span class="text">Chrome</span></li>
						      	</ul>
						</div>
					</div>	
				</section>			
			</div>
		</div>
	</div>
	</section>
</main>
<footer class="footer bg-black">
<section class="bg-black container">
	<div class="row">
		<div class="col-md-6 pad">
			<div class="pull-left">
				Copyright&copy;2015 National Informatics Center
			</div>	
		</div>
		<div class="col-md-6 pad">
			<div class="pull-right">
				<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li><a href="#">About us</a></li>
				<li><a href="#">Privacy Policy</a></li>	
				</ul>
			</div>	
		</div>
	</div>
</section>




</footer>


    <script src="js/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="css/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
