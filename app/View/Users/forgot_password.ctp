<div class="login-box-body">
	 <?php
	 echo $this->Form->create('User',array('action'=>'forgot_password','autocomplete'=>"off"));
	 ?>
                 
	<div class="row">		 
	<?php  echo $this->session->flash(); ?>
	</div>    
	<div class="row">   
	 <div class="form-group has-feedback"> 
		<?php 
		 echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'Username',"maxlength"=>20,'required'=>true,'autocomplete'=>'off'));  
		?>
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	 </div>
	</div>
	<div class="row">		  
	  <div class="form-group has-feedback">
			  <?php 
			  echo $this->Form->input('mobile_number',array('label'=>false,'class'=>'form-control','placeholder'=>'Mobile Number',"maxlength"=>10,"minlength"=>10,'required'=>true,'autocomplete'=>'off'));
			  ?>
			  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	  </div>
	</div> 
		      
		              
	<div class="row">		 
		<div class="form-group">
			<div class="col-md-11" style="padding-left:0px">
				<?php
					echo $this->Html->image(array('controller' => 'users', 'action' => 'get_captcha/'.time()),array('id' => 'captcha_image_forgot_pwd','class'=>'img-responsive'));
				?>	
			</div>
			<div class="col-md-1" style="padding:2% 0">
				<?php
				echo $this->Html->link('<i class="fa fa-fw fa-refresh"></i>', 'javascript:void(0);',array('id' =>'reload2','escape' => false,'title'=>'Reload Captcha'));
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
			
			echo $this->Form->input('captcha',array('label'=>false, 'placeholder'=>'Enter Captcha Code','id'=>'forgot_pwd_captcha','class'=>'form-control','required'=>true,'autocomplete'=>'off','maxlength'=>7));
			?>    
		
	  </div>
	</div> 		  
	<div class="row">
					<div class="col-md-24">
						 <button type="submit" class="btn btn-info btn-block">Submit</button>
					</div>
	</div>
	<div class="row">
	   
		
		<div class="col-md-6">
		   <div class="checkbox">
		   &nbsp;					
		   </div>
		</div>
		
		<div class="col-md-6">
		   <div class="checkbox">
		   &nbsp;					
		   </div>
		</div>  

	</div>						
	<?php
	echo $this->Form->end();
	?>
						  
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	 
	 $('#reload2').click(function() {
          var captchaForgotPwd = $("#captcha_image_forgot_pwd");
		   captchaForgotPwd.attr('src', captchaForgotPwd.attr('src')+'?'+Math.random());
		   $('#forgot_pwd_captcha').val('');
          return false;
      });
	 
	 
	 //$('#reload').click(function() {
	     //alert('Hi');
          //var captcha = $("#captcha_image");
           //captcha.attr('src', captcha.attr('src')+'?'+Math.random());
		  // $('#UserCaptcha').val('');
        //  return false;
      //});
	  
      
      $('#UserForgotPasswordForm').submit(function(){
          
         $('#forgotPasswordModelBody').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>'); 
       $.post(
                  '<?php echo $this->webroot;?>users/forgot_password',
                    
                        $(this).serialize()
                    ,
                    function(response)
                    {	
                        /*if(response=='refresh')
						
                            //location.reload();
							window.location.href='<?php echo $this->webroot;?>dashboard';
                        else*/
                        $('#forgotPasswordModelBody').html(response);
                    }
          );
          return false;
          
      });
	
});
</script>
