<script>
    $(function(){
	   
	   
        $('#UserResetPasswordForm').submit(function(event){
            $('#patternerror').hide();
			$('#notmatchederror').hide();
          var patteren=new RegExp('^(?=.{8,})(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!\'()*,-.:;<=>?\\_`{|}~@#$%^&+=\/]).*$');
		  if(!patteren.test($('#password').val()))
		  {
			
			$('#patternerror').html('Password must contain: 1.Atleast one uppercase letter(A-Z). 2. Atleast one lowercase letter(a-z). 3. Atleast one number(0-9). 4. Atleast one special character.');
			$('#patternerror').show();
			return false;
		  }
		  
		  $('#patternerror').hide();
		  if($('#password').val()!=$('#UserPasswordConfirm').val())
		  {
			$('#notmatchederror').html('Both passwords should match.');
			$('#notmatchederror').show();
			return false;
		  }
			
		$('#notmatchederror').hide();
          
		    pubKey = $("#pubkey").val();
			rNP = $("#password").val();
			r = $("#UserPasswordConfirm").val();
			
			captchaVal = $('#forgot_pwd_captcha').val();
			
		 if(captchaVal!='' && pubKey!='' && rNP!='' && r!='' && rNP==r)
			{	
			  aNP = forge.pki.publicKeyFromPem(pubKey),		
			  iNP = aNP.encrypt(rNP),
			  sNP = forge.util.encode64(iNP);
		  
				$("#password").val(sNP);
				
				$("#UserPasswordConfirm").val(sNP);
		    }
		  });
        
		
		$('#reload2').click(function() {
          var captchaForgotPwd = $("#captcha_image_forgot_pwd");
		   captchaForgotPwd.attr('src', captchaForgotPwd.attr('src')+'?'+Math.random());
		   $('#forgot_pwd_captcha').val('');
		   $("#password").val('');
		   $("#UserPasswordConfirm").val('');
          
		  return false;
      
	  });
		
		
        
    })
</script>

<section class="general-page">
    
    <div class="hold-transition login-page">
		<div class="row">
			<div class="col-xs-12">
				<div class="login-box" id="login-box">
					<div class="login-logo" >
						<b><?php echo __('Change Password'); ?></b>
										
					</div>
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Form->create('User', array('role' => "form",'class' => 'jquery-validation'));
					      echo $this->Form->input('pubkey', array('id'=>'pubkey','type' => 'hidden','value'=>$publickey));
			        ?>
					<div class="login-box-body">
						<div class="row pad"><div class="col-xs-12"><div class="asteriskLine"> Fields marked with * are mandatory.</div></div></div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<div>
										<label class="text-light-blue">New Password</label><span class="asterisk">* </span>
									</div>
									<?php echo $this->JqueryValidation->input('password', array('placeholder' => 'New Password','label'=>false,'minlength'=>8, 'class'=>"form-control",'autocomplete'=>'off','id'=>'password')); ?>
									<div class="error" id="patternerror" style="display:none"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<div>
										<label class="text-light-blue">Confirm Password</label><span class="asterisk">* </span>
									</div>
								<?php echo $this->JqueryValidation->input('password_confirm', array('placeholder' => 'Confirm Password','type'=>'password','equalTo'=>'#password','autocomplete'=>'off','label'=>false, 'class'=>"form-control")); ?>
								<div class="error" id="notmatchederror" style="display:none"></div>
								</div>
							</div>
						</div>
						<div class="row">
						 <div class="col-xs-12"> 
							<div class="form-group">
								<div class="col-xs-11" style="padding-left:0px">
									<?php
										echo $this->Html->image(array('controller' => 'users', 'action' => 'get_captcha/'.time()),array('id' => 'captcha_image_forgot_pwd','class'=>'img-responsive'));
									?>	
								</div>
								<div class="col-xs-1" style="padding:2% 0">
									<?php
									echo $this->Html->link('<i class="fa fa-fw fa-refresh"></i>', 'javascript:void(0);',array('id' =>'reload2','escape' => false,'title'=>'Reload Captcha'));
									?>		
								</div>			
								<div style="clear:both"></div>	
							</div>
						  </div>	
						</div>
						<div class="row">		 
						     <div style="clear:both"></div>			  
						</div>
						<div class="row">
                           <div class="col-xs-12">						
							  <div class="form-group">
								
									<?php 
									
									echo $this->Form->input('captcha',array('label'=>false, 'placeholder'=>'Enter Captcha Code','id'=>'forgot_pwd_captcha','class'=>'form-control','required'=>true,'autocomplete'=>'off','maxlength'=>7));
									?>    
								
							  </div>
							</div>  
						</div>
						<div class="footer">
							<button type="submit" class="btn bg-olive btn-block">Change Password</button>
						</div>
					</div>
					
					
					<?php echo $this->Form->end(); ?>
				</div>	
			</div>
		</div>
    </div>
</section>		