<script type="text/javascript">
 $(function(){
    
	// For Office State and City
   $('#InformationUserOCityId').prop('disabled',true);
     
	firstexecutionOState = true;	
   $('#InformationUserOStateId').change(function(){
                                stateid = $('#InformationUserOStateId').val();
								if(stateid=='')
								 {
								  $('#InformationUserOCityId').html('<option>Select City</option>');
								  $('#InformationUserOCityId').prop('disabled',true);
								  return false;
								 }
								 $.post('<?php echo $this->webroot;?>'+'users/citiesbystateid',{'id':stateid},function(response){
								        
										$('#InformationUserOCityId').prop('disabled',false);
										$('#InformationUserOCityId').html(response);
								        <?php if(isset($oCityId)) {?>		
											if(firstexecutionOState)
											{
											   selectedCity = <?php echo h($oCityId); ?>;
											   $('#InformationUserOCityId').val(selectedCity); 
											   firstexecutionOState=false;
											}
										   <?php }?>
								  
								  });
								 
								 
								
    							
   });
   
   $('#InformationUserOStateId').trigger('change');
   
     // For Residence State and City
   $('#InformationUserRCityId').prop('disabled',true);
    
   
   firstexecutionRState = true;
   $('#InformationUserRStateId').change(function(){
                                stateid = $('#InformationUserRStateId').val();
								if(stateid=='')
								 {
								  $('#InformationUserRCityId').html('<option>Select City</option>');
								  $('#InformationUserRCityId').prop('disabled',true);
								  return false;
								 }
								 $.post('<?php echo $this->webroot;?>'+'users/citiesbystateid',{'id':stateid},function(response){
								        
										$('#InformationUserRCityId').prop('disabled',false);
										$('#InformationUserRCityId').html(response);
								        <?php if(isset($rCityId)) {?>		
											if(firstexecutionRState)
											{
											   selectedCity = <?php echo h($rCityId); ?>;
											   $('#InformationUserRCityId').val(selectedCity); 
											   firstexecutionRState=false;
											}
										   <?php }?>
								  
								  });
								 
								 
								
    							
   });
 
 $('#InformationUserRStateId').trigger('change');
 })
</script>
<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Contact Details'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('User', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('User.id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('InformationUser.id',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group<?php echo $this->Form->isFieldError('InformationUser.o_address') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Official Address</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('InformationUser.o_address', array('placeholder'=>'Enter Permanent Address', 'label'=>false,'class'=>'form-control','type'=>'textarea','rows'=>4,'maxlength'=>255,'rangeLength'=>array(3,255),'required'=>true,'pattern'=>'^[A-Za-z0-9/-\s\n,]*$','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOAddress')))); ?>
						</div>
					</div>
					                        <!-- Official For State -->
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.o_state_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">State</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.o_state_id', array('empty'=>'--Select State-- ', 'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOStateId')))); ?>
						</div>
					</div>	
                             
                               <!-- Official For City -->
							   
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.o_city_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">City</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.o_city_id', array('empty'=>'--Select City--', 'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOCityId')))); ?>
						</div>
					</div>
					
					            <!-- Official Pin Code -->    
                  <div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.o_pincode') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Pin Code</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.o_pincode', array('placeholder'=>'Pin Code','label'=>false,'digits'=>true,'minlength'=>6,'maxlength'=>6,'class'=>'form-control','required'=>true,'data-mask'=>"", 'data-inputmask'=>"'mask': ['99-99-99']",'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOPincode')))); ?>
						</div>
					</div>
					
               					       <!-- For User Mobile Number -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('User.mobile_number') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Mobile Number</label><span class="asterisk text-red">* </span>
							</div>
                               <div class="input-group">
							     <div class="input-group-addon">
                                   <i class="fa fa-phone"></i>	
                                 </div>								 
					        	<?php echo $this->JqueryValidation->input('User.mobile_number', array('label'=>false,'placeholder'=>'Mobile Number','digits'=>true,'maxlength'=>10,'minlength'=>10,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserMobileNumber')))); ?>
						       </div>
						</div>
					</div>

					
					             <!--Official Land Line Number-->
					<div class="col-md-1">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.o_std_code') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">STD</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.o_std_code', array('placeholder'=>'Code','label'=>false,'digits'=>true,'class'=>'form-control','required'=>true,'minlength'=>3,'maxlength'=>5,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOStdCode')))); ?>
						</div>
					</div>
					             
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.o_landline_num') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Telephone Number</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.o_landline_num', array('placeholder'=>'Number','label'=>false,'digits'=>true,'class'=>'form-control','required'=>true,'minlength'=>7,'maxlength'=>10,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOLandlineNum')))); ?>
						</div>
					</div>
					
							
				</div>
					
                         <!--Residential Address-->
				<div class="row">
					<div class="col-md-5">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_address') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Residential Address</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('InformationUser.r_address', array('placeholder'=>'Enter Residential Address', 'label'=>false,'class'=>'form-control','type'=>'textarea','rows'=>4,'required'=>true,'maxlength'=>255,'rangeLength'=>array(3,255),'pattern'=>'^[A-Za-z0-9/-\s\n,]*$','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRAddress')))); ?>
						</div>
					</div>
					                        <!--Residential For State -->
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_state_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">State</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.r_state_id', array('empty'=>'-- Select State -- ', 'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRStateId')))); ?>
						</div>
					</div>	
                             
                               <!--Residential For City -->
							   
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_city_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">City</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.r_city_id', array('empty'=>'-- Select City --', 'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRCityId')))); ?>
						</div>
					</div>
					
					            <!-- Residential Pin Code -->    
                  <div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_pincode') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Pin Code</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.r_pincode', array('placeholder'=>'Pin Code','label'=>false,'digits'=>true,'minlength'=>6,'maxlength'=>6,'class'=>'form-control','data-mask'=>"", 'data-inputmask'=>"'mask': ['99-99-99']",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRPincode')))); ?>
						</div>
					</div>
					
					            <!-- For User Residential Mobile Number -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_mobile_number') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Mobile Number</label><span class="asterisk text-red">* </span>
							</div>
                               <div class="input-group">
							     <div class="input-group-addon">
                                   <i class="fa fa-phone"></i>	
                                 </div>								 
					        	<?php echo $this->Form->input('InformationUser.r_mobile_number', array('label'=>false,'placeholder'=>'Mobile Number','digits'=>true,'maxlength'=>10,'minlength'=>10,'class'=>'form-control','data-mask'=>"", 'data-inputmask'=>"'mask': ['999-999-9999[x99999]']",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRMobileNumber')))); ?>
						       </div>
						</div>
					</div>
					
					             <!--Residential Land Line Number-->
					<div class="col-md-1">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_std_code') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">STD</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.r_std_code', array('placeholder'=>'Code','label'=>false,'digits'=>true,'class'=>'form-control','required'=>true,'minlength'=>3,'maxlength'=>5,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRStdCode')))); ?>
						</div>
					</div>
					             
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.r_landline_num') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Telephone Number</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.r_landline_num', array('placeholder'=>'Number','label'=>false,'digits'=>true,'minlength'=>7,'maxlength'=>10,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserRLandlineNum')))); ?>
						</div>
					</div>
					
							
				</div>			
				
				
			</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Save & Next</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>