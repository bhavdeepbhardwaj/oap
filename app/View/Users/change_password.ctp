<script>
    $(function(){
        $("#UserChangePasswordForm").submit(function(event){
            
			//For User Current Password 
			
			pubKey = $("#pubkey").val();
			rCP = $("#UserCurrentPassword").val();
			rNP = $("#password").val();
			r = $("#UserPasswordConfirm").val();
			
			if(pubKey!='' && rCP!='' && rNP!='' && r!='' && rNP==r)
			{
				aCP = forge.pki.publicKeyFromPem(pubKey);
				iCP = aCP.encrypt(rCP);
				sCP = forge.util.encode64(iCP);
				
                $("#UserCurrentPassword").val(sCP);
				 
				 
			 //For User New Password 
				
				aNP = forge.pki.publicKeyFromPem(pubKey),		
				iNP = aNP.encrypt(rNP),
				sNP = forge.util.encode64(iNP);
			    
				$("#password").val(sNP);
				
				$("#UserPasswordConfirm").val(sNP);
			
			}
        });
        
        
    })
</script>
<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Change Password'); ?></h3><div class="asteriskLine"> Fields marked with * are mandatory.</div>
			</div>
			<?php echo $this->Form->create('User', array('role' => "form",'class' => 'jquery-validation')); 
			      echo $this->Form->input('pubkey', array('id'=>'pubkey','type' => 'hidden','value'=>$publickey));
			?>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Current Password</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('current_password', array('placeholder' => 'Current Password','label'=>false,'type'=>'password','autocomplete'=>'off','class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group <?php echo $this->Form->isFieldError('password') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">New Password</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('password', array('placeholder' =>'New Password','label'=>false,'minlength'=>6,'class'=>'form-control','autocomplete'=>'off','id'=>'password','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'password')))); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Confirm Password</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('password_confirm', array('placeholder' => 'Confirm Password','type'=>'password','equalTo'=>'#password','autocomplete'=>'off','label'=>false, 'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				</div>
			</div>
			<?php echo $this->Form->input('id', array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id'))); ?>
			<div class="box-footer">
					<button type="submit" class="btn btn-primary">Change Password</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>	
	</div>
</div>
