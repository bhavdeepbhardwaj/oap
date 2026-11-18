<script>
    $(function(){
        $('#UserLoginForm').submit(function(event){
            EmployeeCode=$('#UserEmail').val();
            EmployeePassword=$('#EmployeePassword').val();
            $('#UserPassword').val(CryptoJS.MD5('p$bALN^nhfDRR'+$('#UserPassword').val()));
        
            
        });
        
        
    })
</script>
        <script type="text/javascript">

            $(document).ready(function(){

				
				$(".forgot-password-model").click(function(){
					$("#loginModal").modal('hide');
                    $("#forgotPasswordModal").modal('show');
                    $('#forgotPasswordModelBody').html('Loading..');
					$.get(
                              '<?php echo $this->webroot;?>users/forgot_password',
                            
                            function(response){
                                                
                                                 $('#forgotPasswordModelBody').html(response);
                                                 
                                        }
                              );
                });

            });

        </script>
<!--div class="box box-primary"-->
						
		     <!--div class="login-box"-->
			 
                  <div class="login-box-body">
	                 <?php
	                 echo $this->Form->create('User',array('action'=>'login','autocomplete'=>"off"));
	                 ?>
                  <!--h3><p class="login-box-msg">Sign in to start your session</p></h3-->
                         <!-- Flash Message -->
				  <div class="row">		 
	                <?php  echo $this->session->flash('msg'); ?>
                  </div>    
					  <div class="row">   
						 <div class="form-group has-feedback"> 
		                    <?php 
		                     echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'Username','required'=>true,'autocomplete'=>'off'));  
		                    ?>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                         </div>
					  </div>
     			<div class="row">		  
				  <div class="form-group has-feedback">
						  <?php 
						  echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'Password','required'=>true,'autocomplete'=>'off'));
						  ?>
						  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
		        </div> 
		      
		               <!-- For Captcha -->
              <div class="row">		 
				 <div class="form-group">
						<div class="col-md-11" style="padding-left:0px">
							<?php
								echo $this->Html->image(array('controller' => 'users', 'action' => 'get_captcha/'.time()),array('id' => 'captcha_image','class'=>'img-responsive'));
							?>	
						</div>
						<div class="col-md-1" style="padding:2% 0">
							<?php
							echo $this->Html->link('<i class="fa fa-fw fa-refresh"></i>', 'javascript:void(0);',array('id' => 'reload','escape' => false,'title'=>'Reload Captcha'));
							?>		
						</div>			
						<div style="clear:both"></div>	
				  </div>
		 </div>
        <div class="row">		 
		  <div style="clear:both"></div>			  
		</div>
        <div class="row">		
		  <div class="form-group">
			
				<?php 
				//uncomment after security audit
				echo $this->Form->input('captcha',array('label'=>false, 'placeholder'=>'Enter Captcha Code', 'class'=>'form-control','required'=>false,'autocomplete'=>'off'));
				?>    
			
		  </div>
        </div> 		  
        <div class="row">
                        <div class="col-md-24">
                             <button type="submit" class="btn btn-info btn-block">Sign In</button>
                        </div><!-- /.col -->
        </div>
		            <div class="row">
					    <!--div class="col-md-5">    
                             <div class="checkbox icheck">
                                <label>
                                  <input type="checkbox"> Remember Me
                                </label>
                             </div>                        
                        <!--/div--><!-- /.col -->
						
						<div class="col-md-6">
						   <div class="checkbox">
                           <a href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'user_registration'));?>">Create an account</a>						
						   </div>
						</div>
						
						<div class="col-md-6">
						   <div class="checkbox">
                           <a href="#" class="forgot-password-model">Forgot Password ?</a>						
						   </div>
						</div>  

                    </div>						
		                  <?php
                            echo $this->Form->end();
		                  ?>
						  
               </div><!-- /.login-box-body -->
            <!--/div><!-- /.login-box -->
<!--/div-->

<script type="text/javascript">
$(document).ready(function(){
	
	 $('#reload').click(function() {
          var captcha = $("#captcha_image");
           captcha.attr('src', captcha.attr('src')+'?'+Math.random());
		   $('#UserCaptcha').val('');
          return false;
      });
	  
      
      $('#UserLoginForm').submit(function(){
          
         $('#loginModelBody').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>'); 
       $.post(
                  '<?php echo $this->webroot;?>users/login',
                    
                        $(this).serialize()
                    ,
                    function(response)
                    {
                        if(response=='refresh')
						
                            //location.reload();
							window.location.href='<?php echo $this->webroot;?>dashboard';
                        else
                        $('#loginModelBody').html(response);
                    }
          );
          return false;
          
      });
	
});
</script>
