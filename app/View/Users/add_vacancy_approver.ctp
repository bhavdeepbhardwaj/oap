<?php $timestamp = time();?>
 <script type="text/javascript">
	$(function() {
		$('#ProfilePic').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_profile_pic',
		'auto'             : true,
		'buttonText':'Upload Photo',
        'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						}, 
		'onUploadComplete': function(file,data){
						
									if(data.search('uploaded_ok_')!=-1)
									{
										var filename= data.split('_');
										filename=filename[2];
										$('#UserProfilepic').val(filename);
										$('#uploaded_pic_view_container').show();
										$('#uploaded_pic_view').html('<img style="width:100%" src="<?php echo $this->webroot;?>users/dwnl_new_upl_self_pic/'+filename+'"/>');
										$('.overlay').hide();
									
									}
									else
									{
										$('.fileinfo').html(' - '+data);
										$('.uploadifive-queue-item').addClass('error');
									}
												
						},
		'dnd'          : true,
		'fileSizeLimit' : '4 MB',	
		'fileType':'image/png|image/jpg|image/jpeg|image/gif',
		
		'multi':false,
		'simUploadLimit' : 1,	
		'removeCompleted' : true,
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_profile_pics',
		'onAddQueueItem' : function(file){
											$('#uploaded_pic_view_container').show();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'png':
												case 'jpg':
												case 'jpeg':
												case 'gif':
												
												break;
												default:
												alert('Error - File type not Supported (Supported file types: png, jpg, jpeg )');
												$('#ProfilePic').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	
	$('#UserOfficeLocationId').prop('disabled',true);
	$('#UserOrganizationId').change(function(){
		                        orgnId = $(this).val();
								if(orgnId=='')
								 {
								  $('#UserOfficeLocationId').prop('disabled',true);
								  $('#UserDepartmentId').prop('disabled',true);	 
								  $('#UserOfficeLocationId').html('<option>--Select Office Location--</option>');
								  $('#UserDepartmentId').html('<option>--Select Department--</option>');
								  return false;
								 }
							
                                $.post('<?php echo $this->webroot;?>'+'users/officelocationsbyorgnid',{'id':orgnId},function(response){
								        
										$('#UserOfficeLocationId').prop('disabled',false);
										$('#UserDepartmentId').prop('disabled',true);
										$('#UserDepartmentId').html('<option>--Select Department--</option>');
										$('#UserOfficeLocationId').html(response);
								  });								 
		
	});
		
	$('#UserOrganizationId').trigger('change');
	
	$('#UserDepartmentId').prop('disabled',true);
	$('#UserOfficeLocationId').change(function(){
                                                officeLocationId = $(this).val();
												
												if(officeLocationId=='')
												 {
												  $('#UserDepartmentId').html('<option>--Select Department--</option>');
												  $('#UserDepartmentId').prop('disabled',true);
												  return false;
												 }
											     
                                                 $.post('<?php echo $this->webroot;?>'+'users/departmentsbyofficelocationid',{'id':officeLocationId},function(response){        
														$('#UserDepartmentId').prop('disabled',false);
														$('#UserDepartmentId').html(response);
												  });
												 
                                     });
									 

	
	});	
</script>
<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>	
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Add Vacancy Approver'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
							   
			<?php echo $this->Form->create('User',array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('profilepic', array('type' => 'hidden')); ?>
			
			<div class="box-body">
				
			  <div class="row">
                 <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_id') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Organization</label><span class="asterisk text-red">* </span>
						</div>
						<?php
                           if($this->Session->read('Auth.User.Group.name')=='Super Admin')						
						     echo $this->JqueryValidation->input('organization_id', array('empty' => '--Select Organization--','label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserOrganizationId')))); 
						   else
						     echo $this->JqueryValidation->input('organization_id', array('value'=>$this->Session->read('Auth.User.organization_id'),'disabled'=>true,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserOrganizationId'))));    
						?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('office_location_id') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Office Location</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('office_location_id', array('empty' => '--Select Office Location--','label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserOfficeLocationId')))); ?>
						</div>
					</div>	
					              
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('department_id') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Department</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('department_id', array('empty' => '--Select Department--','label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserDepartmentId')))); ?>
						</div>
					</div>
			  </div>			  
				
				
              <div class="row">
				                         <!-- For User Title -->
				   <div class="col-xs-3">
						<div class="form-group <?php echo $this->Form->isFieldError('u_name_title') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Title</label><span class="asterisk text-red">* </span>
							</div>   
						          <?php echo $this->JqueryValidation->input('u_name_title', array('options'=>array('Mr.'=>'Mr.','Ms.'=>'Ms.','Mrs.'=>'Mrs.','Dr.'=>'Dr.'),'empty'=>'--Select Title--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserUNameTitle')))); ?>
						</div>
					</div>            
					
					                       <!-- For User First Name -->  
					<div class="col-xs-3">
						<div class="form-group <?php echo $this->Form->isFieldError('f_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>[1,30],'maxlength'=>30,'label'=>false,'class'=>'form-control','alphabet'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserFName')))); ?>
						</div>
					</div>
					                       <!-- For User Middle Name -->
					<div class="col-xs-3">
						<div class="form-group <?php echo $this->Form->isFieldError('m_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Middle Name</label>
							</div>
						 <?php echo $this->JqueryValidation->input('m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>[1,30],'maxlength'=>30,'label'=>false,'class'=>'form-control','alphabet'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserMName')))); ?>
						</div>
					</div>
					
					                        <!-- For User Last Name -->
					<div class="col-xs-3">
						<div class="form-group <?php echo $this->Form->isFieldError('l_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>[1,30],'maxlength'=>30,'class'=>'form-control','alphabet'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserLName')))); ?>
						</div>
					</div>
				</div>				


				
				<div class="row">
                                <!-- User Name-->
				<div class="col-md-4 <?php echo $this->Form->isFieldError('username') ? 'has-error' : '' ?>">	
						<div class="form-group">
						    <div>
								<label class="text-light-blue">Username</label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-user"></i>
							        </div>	
							      <?php echo $this->JqueryValidation->input('username',array('placeholder'=>'Username','class'=>'form-control','label' => false,'rangeLength'=>array(5,15),'maxlength'=>15,'pattern'=>'^[a-zA-Z0-9._]+$','required'=>true,'autocomplete'=>'off','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserUsername')))); ?>
                               </div>
						</div>
                </div>
					
				               <!-- For Designation -->				
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('designation_id') ? 'has-error' : '' ?>">
						<div>
					 <label class="text-light-blue">Designation</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('designation_id', array('empty' => '--Select Designation--','label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserDesignationId')))); ?>
						</div>
					</div>
	                                  <!-- For Email Id -->
	
					<div class="col-md-4 <?php echo $this->Form->isFieldError('email') ? 'has-error' : '' ?>">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Email Id</label><span class="asterisk text-red">* </span>
							</div>
							<div class="input-group">
							   <div class="input-group-addon">
						               <i class="fa fa-envelope"></i>
							    </div>	
						       <?php echo $this->JqueryValidation->input('email', array('placeholder'=>' Enter Email Id', 'maxlength'=>50,'rangeLength'=>[6,50],'email'=> true,'class'=>'form-control','label'=>false,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmail')))); ?> 
						    </div> 
						</div>
						
					</div>	
					
					
				</div>
				
				<div class="row">
				             
					
					                 <!-- For User Mobile Number -->
					<div class="col-md-4 <?php echo $this->Form->isFieldError('mobile_number') ? 'has-error' : '' ?>">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Mobile Number</label><span class="asterisk text-red">* </span>
							</div>
                               <div class="input-group">
							     <div class="input-group-addon">
                                   <i class="fa fa-phone"></i>	
                                 </div>								 
					        	<?php echo $this->JqueryValidation->input('mobile_number', array('label'=>false,'placeholder'=>'Enter Mobile Number','digits'=>true,'maxlength'=>10,'minlength'=>10,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserMobileNumber')))); ?>
						       </div>
						</div>
					</div>
					
				</div>
				
			    <div class="row">
					
					
				</div>
				
				                        <!-- Password -->
			<!--div class="row">
					<div class="col-md-4">
						<div class="form-group">
						    <div>
								<label class="text-light-blue">Password</label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-lock"></i>
							        </div>	
							      <?php //echo $this->Form->input('password', array('class' => 'form-control','placeholder'=>'Enter Password', 'label' => false,'required'=>true)); ?>
                               </div>
							</div>						
						</div>
					                      <!-- Conform Password -->
					<!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Confirm Password</label><span class="asterisk text-red">*</span>
							</div>
							 <div class="input-group">
                               <div class="input-group-addon">
                                 <i class="fa fa-hand-o-right"></i>
							    </div>							   			
							     <?php //echo $this->Form->input('retype_password', array('placeholder'=>'Retype Password','label'=>false,'class'=>'form-control','required'=>true)); ?>
					          </div>
						</div>
					</div>

		    </div-->
			
                                      
                                  <!-- Select Role -->				
				<!--div class="row">
					<div class="col-md-4">
						<div class="form-group">
						<div>
								<label class="text-light-blue">Role<label><span class="asterisk">* </span><label>
						</div>
						<?php //echo $this->Form->input('group_id', array('empty' => '--Select Role--','label'=>false,'class'=>"form-control",'required'=>true)); ?>
						</div>
					</div>
					
				</div-->

				                    <!-- For Address -->
									<!--
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Address<label><span class="asterisk">* </span><label>
							</div>
							<?php //echo $this->Form->textarea('address', array('placeholder'=>'Address',"maxlength"=>255,'class'=>"form-control",'label'=>false)); ?>	
						</div>
					</div>
					
				</div>
				
				                    <!-- For State -->
									<!--
				<div class="row">
					<div class="col-xs-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">State</label><span class="asterisk">* </span>
							</div>
						<?php //echo $this->Form->input('state_id', array('empty'=>'-- Select State -- ', 'label'=>false,'class'=>"form-control")); ?>
						</div>
					</div>
					           <!-- For City -->
							   <!--
					<div class="col-xs-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">City</label><span class="asterisk">* </span>
							</div>
						<?php //echo $this->Form->input('city_id', array('empty'=>'-- Select City --', 'label'=>false,'class'=>"form-control")); ?>
						</div>
					</div>				
				</div>
	
	                                  -->
			   
	                      <!-- For Profile Picture -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
						
							<div>
								<label class="text-light-blue">Profile Pic<label>
							</div>
							<input id="ProfilePic" type="file"  extension="png|jpeg|jpg|gif"/>
				
						</div>
						
					</div>
					            <!-- For Viewing Uploaded Pic -->
					<div class="col-md-2">
						<div class="form-group" id="uploaded_pic_view_container" style="display:none">
							<div>
								<label class="text-light-blue">Profile Pic Preview<label>
							</div>
							<div id="uploaded_pic_view">
								<?php echo $this->Html->image('white.png', array('alt' => 'Loading image preview'));?>
								
							</div>
							<div class="overlay">
							  <i class="fa fa-refresh fa-spin"></i>
							</div>
						</div>
					</div>					
					
				</div>
			</div>
			<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Add New User</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>	
	</div>
</div>