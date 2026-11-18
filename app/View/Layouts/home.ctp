<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Online Application Portal</title>
    <meta name="description" content="">

    <!-- CSS FILES -->
    <!--link rel="stylesheet" href="home/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="home/css/style.css">
    <link rel="stylesheet" href="home/css/fractionslider.css"/>
    <link rel="stylesheet" href="css/style-fraction.css"/>
    <link rel="stylesheet" href="css/animate.css"/-->

    <?php //echo $this->HTML->css('/home/css/bootstrap.min'); 
    ?>


    <?php echo $this->HTML->css('bootstrap/css/bootstrap.min'); ?>
    <?php echo $this->HTML->css('font-awesome.min'); ?>
    <?php echo $this->HTML->css('ionicons.min'); ?>
    <?php echo $this->HTML->css('dist/css/AdminLTE.min');  ?>
    <?php echo $this->Html->css('/js/plugins/datepicker/datepicker3'); ?>

    <?php echo $this->HTML->css('/home/css/style'); ?>
    <?php echo $this->HTML->css('/home/css/fractionslider'); ?>
    <?php echo $this->HTML->css('/home/css/style-fraction'); ?>
    <?php echo $this->HTML->css('/home/css/animate'); ?>

    <?php echo $this->Html->script(
        array( //'/home/js/jquery-1.10.2.min',
            //'/home/js/bootstrap.min',
            'plugins/jQuery/jQuery.min',
            '/css/bootstrap/js/bootstrap.min',
            '/home/js/jquery.cookie',
            '/home/js/jquery.fractionslider',
            '/home/js/jquery.smartmenus.min',
            '/home/js/jquery.smartmenus.bootstrap.min',
            '/home/js/owl.carousel.min',
            '/home/js/swipe',
            '/home/js/jquery-scrolltofixed-min',
            '/home/js/jquery-hoverdirection.min',
            '/home/js/jflickrfeed',
            '/home/js/jquery.magnific-popup.min',
            '/home/js/main',
            'plugins/encode/md5',
            'plugins/datepicker/bootstrap-datepicker',
            'plugins/JqueryValidation/js/jquery.validate',
            'plugins/JqueryValidation/js/additional-methods',
            'plugins/JqueryValidation/js/jquery.metadata',
            'plugins/rsa/rsa.min'
        )
    ); ?>





    <script>
        window.clientIp = "<?php echo $this->request->clientIp(); ?>";
        window.shouldOpenLogin = <?php echo json_encode($this->Session->read('open_login')); ?>;
        window.webroot = "<?php echo $this->webroot; ?>";
    </script>

    <?php echo $this->HTML->css('homecss.css');  ?>

    <?php echo $this->Html->script('homejs.js'); ?>


</head>

<body class="home">
    <header id="header">
        <div id="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 top-info hidden-xs">
                        <span><i class="fa fa-phone"></i>Contact No: 23719008</span>
                        <span><i class="fa fa-mail fa-envelope"></i><a href="#">vacancy-ship[at]gov[dot]in</a></span>
                    </div>
                    <!--div class="col-sm-4 top-info">
                        <ul>
                                      
                            <li>Visitor No:<span> 1057362</span></li>
                                            
                            
                        </ul>
                    </div-->
                </div>
            </div>
        </div>
        <div id="logo-bar">
            <div class="container-fluid">



                <div class="row top_head_bg">
                    <!-- Logo start -->
                    <div class="col-lg-1 col-sm-1">
                        <div id="logo">
                            <h1 style="display: flex;">
                                <a href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>home/images/emblem_of_india.png" /></a>
                                <a style="padding-top: 10px;" href="https://amritmahotsav.nic.in/" target="_blank" rel="noopener noreferrer"> <img src="<?php echo $this->webroot; ?>home/images/logo-black.png" /></a>
                                <a style="padding-top: 10px; " href="https://www.g20.org/en/" target="_blank" rel="noopener noreferrer"> <img src="<?php echo $this->webroot; ?>home/images/g-20-logo.png" /></a>
                            </h1>
                        </div>
                    </div>
                    <!-- Navigation
    ================================================== -->
                    <div class="col-lg-8 col-sm-8">
                        <div class="top_header center-position">
                            <h1 style="padding-left: 206px;"><span>O</span>nline <span>A</span>pplication <span>P</span>ortal</h1>
                            <p style="padding-left: 206px;">Ministry of Ports, Shipping and Waterways (Government of India)</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3">
                        <h4 class="right-position bg1"><span><?php echo date('d M Y H:i:s'); ?> </span></h4>
                        <!--h4 class="right-position bg2"><span> Your IP Address : <?php //echo h($_SERVER['REMOTE_ADDR']); 
                                                                                    ?></span></h4-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-12 header_bg ">
                        <div class="navbar navbar-default navbar-static-top" role="navigation">
                            <!--  <div class="container">-->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="<?php echo $this->webroot; ?>"> <i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="<?php echo $this->webroot; ?>#drag"> <i class="fa  fa-user"> </i> Current Openings </a></li>
                                    <!--li ><a href="<?php //echo $this->webroot;
                                                        ?>pages/view/how_to_apply"><i class="fa  fa-lightbulb-o"> </i> How To Apply </a></li-->
                                    <li><a href="<?php echo $this->webroot; ?>home/download_guidelines" target="_blank" rel="noopener noreferrer"><i class="fa  fa-dashboard"> </i> Guidelines </a></li>
                                    <li><a href="<?php echo $this->webroot; ?>home/download_faqs" target="_blank" rel="noopener noreferrer"><i class="fa  fa-info-circle"> </i> FAQ's </a></li>
                                    <!--li ><a href="#"><i class="fa  fa-male"> </i> Recent Update</a>
                                   <ul class="dropdown-menu">
                                            <li><a href="#">Notice 1</a></li>
                                            <li><a href="#">Notice 2</a></li>
                                     </ul>
                                   </li-->
                                    <li><a href="<?php echo $this->webroot; ?>pages/view/contact_us"> <i class="fa fa-lg fa-phone"></i> Contact Us </a></li>

                                </ul>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>


        <!--Marquee Start-->

        <div class="main_mar_w ">
            <marquee>
                <span>For any issues/feedback/comments,Please mail at vacancy-ship[at]gov[dot]in</span>
            </marquee>
        </div>

        <!--Marquee end-->


    </header>
    <!--End Header-->

    <div class="popup" style="position: fixed; width: 100%; height: 100%;z-index: 9999991;">
        <div class="cnt223">
            <img src="<?php echo $this->webroot; ?>home/images/x.png" alt="quit" class="x" id="x" style=" background: #fff; color: #000; right: 15px; top: 32px; border-radius: 50%;
    cursor: pointer;  padding: 5px;   box-shadow: 0 0 10px 0 #000;   width: 30px;   height: 30px; " />

            <a href="https://amritmahotsav.nic.in" style="curser:pointer;" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo $this->webroot; ?>home/images/AzadiKaAmritMahotsav1.png" alt="Banner" class="natimg" style=" width: 100%;    border-radius: 8px;  box-shadow: rgb(173 173 173) 0px 2px 8px; min-height: 175px; " onclick="close1()">
            </a>
        </div>
    </div>

    <div id="overlay"></div>





    <?php if (($this->request->params['controller'] == 'home') && ($this->request->params['action'] == 'index')) { ?>
        <!--start wrapper-->
        <section class="wrapper">
            <!--Start Slider-->
            <div class="slider-wrapper">
                <div class="slider">
                    <div class="fs_loader"></div>

                    <div class="slide">
                        <img src="<?php echo $this->webroot; ?>home/images/small-banner-1.png" width="600" height="auto" data-position="10,80" data-in="right" data-0ut="bottom" data-delay="500" />
                        <p class="slide-2 " data-position="20,700" data-in="bottom" data-out="top" data-delay="2000">
                            Welcome to Online Application Portal </p>

                        <!--p class="slide-2b " data-position="80,700" data-in="left" data-out="right" data-delay="3000">
									 Maritime Transport is a critical infrastructure for the social and economic development of a country. </p>
									  <p class="slide-2b " data-position="120,700" data-in="left" data-out="right" data-delay="3000">
									  It influences the pace, structure and pattern of development.. </p>
									   <p class="slide-2b " data-position="160,700" data-in="left" data-out="right" data-delay="3000">
									   The Ministry of Shipping encompasses within its fold shipping and ports sectors. </p>
									   <p class="slide-2b " data-position="198,700" data-in="left" data-out="right" data-delay="3000">
									   It includes shipbuilding and ship-repair, major ports, national waterways, and inland water transport. </p-->

                    </div>
                </div>
            </div>
        </section>
        <!--End Slider-->
    <?php } ?>

    <!--start info service-->
    <section class="info_service">
        <div class="container-fluid">
            <div class="row sub_content">
                <div class="col-md-12 col-sm-12">
                    <?php if (($this->request->params['controller'] == 'home') && ($this->request->params['action'] == 'index')) { ?>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="serviceBox_2 green">
                                    <div class="service-icon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <div class="service-content">
                                        <h3>Sign In </h3>
                                        <!--p> sit amet, consec tetuer adipis elit, aliquam eget nibh etlibura.</p-->
                                        <div class="read">
                                            <a href="#" class="login-model">Click Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="serviceBox_2 purple">
                                    <div class="service-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="service-content">
                                        <h3>New Registration?</h3>
                                        <!--p> Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p-->
                                        <div class="read">
                                            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'user_registration')); ?>">Click Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="serviceBox_2 red">
                                    <div class="service-icon">
                                        <i class="fa fa-neuter"></i>
                                    </div>
                                    <div class="service-content">
                                        <h3>Instructions for filling Online </h3>
                                        <!--p> Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p-->
                                        <div class="read">
                                            <a href="<?php echo $this->webroot; ?>home/download_instructions" target="_blank" rel="noopener noreferrer">Click Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="serviceBox_2 blue">
                                    <div class="service-icon">
                                        <i class="fa fa-street-view"></i>
                                    </div>
                                    <div class="service-content">
                                        <h3>Guidelines</h3>
                                        <!--p> Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p-->
                                        <div class="read">
                                            <a href="<?php echo $this->webroot; ?>home/download_guidelines" target="_blank" rel="noopener noreferrer">Click Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php echo $this->fetch('content'); ?>

                </div>
            </div>

        </div>
    </section>
    <!--end info service-->


    <div class="clear blank_10"></div>

    <!--footer_bottom start-->
    <section class="footer_bottom" id="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <p class="copyright">@ Ministry of Ports, Shipping and Waterways</p>
                </div>

                <div class="col-sm-6 ">
                    <div class="footer_social">
                        <p class="copyright">Designed, developed and hosted by National Informatics Centre. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--footer_bottom end-->





    <!--script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
    <script type="text/javascript" src="js/jquery.cookie.js"></script> <!-- jQuery cookie -->
    <!--script src="js/jquery.fractionslider.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.smartmenus.min.js"></script>
    <script type="text/javascript" src="js/jquery.smartmenus.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/swipe.js"></script>
        <script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script>
    <script type="text/javascript" src="js/jquery-hoverdirection.min.js"></script>
    
       <script type="text/javascript" src="js/jflickrfeed.js"></script>
       <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script-->


    <main>
        <div class="container">
            <!-- Modal HTML -->

            <div id="loginModal" class="modal fade modal-info" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">

                <div class="modal-dialog" style="max-width:350px;">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                            <h4 class="modal-title" id="loginModalLabel">Sign In</h4>

                        </div>

                        <div class="modal-body box no-border" id="loginModelBody" style="background-color:#fff !important">

                            <p>Loading...</p>



                        </div>

                    </div>

                </div>

            </div>

            <div id="forgotPasswordModal" class="modal fade modal-info" abindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">

                <div class="modal-dialog" style="max-width:350px;">

                    <div class="modal-content">

                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                            <h4 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h4>

                        </div>

                        <div class="modal-body box no-border" id="forgotPasswordModelBody" style="background-color:#fff !important">

                            <p>Loading...</p>



                        </div>

                    </div>

                </div>

            </div>



        </div>

    </main>










</body>

</html>
<script type='text/javascript'>
    $(function() {

        var overlay = $('<div id="overlay"></div>');
        overlay.show();
        overlay.appendTo(document.body);
        $('.popup').show();




        $('.x').click(function() {
            $('.popup').hide();
            overlay.appendTo(document.body).remove();
            return false;
        });


    });

    function close1() {
        jQuery('.popup').hide();
        jQuery('#overlay').remove();
        return false;
    };
</script>

<script>
    $(document).ready(function() {

        $(document).on('click', '#loginModal .close', function() {

            $('#loginModal').modal('hide');

        });

        $(document).on('click', '#forgotPasswordModal .close', function() {

            $('#forgotPasswordModal').modal('hide');

        });

    });
</script>

<script>
    $('#loginModal').on('hidden.bs.modal', function() {

        $('body').removeClass('modal-open');

        $('.modal-backdrop').remove();

    });

    $('#forgotPasswordModal').on('hidden.bs.modal', function() {

        $('body').removeClass('modal-open');

        $('.modal-backdrop').remove();

    });
</script>