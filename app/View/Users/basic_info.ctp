<div class="row">
   <div class="col-md-12">
     <?php echo $this->Session->flash(); ?>	
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('User Personal Information'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
			<?php echo $this->Form->create('User',array('role' => "form",'class'=>'jquery-validation')); ?>	
			<?php echo $this->Form->input('User.id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('InformationUser.id',array('type'=>'hidden')); ?>
			<div class="box-body">
				
				<div class="row">
				                    <!--User Salutation-->
				    <div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('u_name_title') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Salutation</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('u_name_title', array('empty'=>'--Select--','options'=>array('Mr.'=>'Mr.','Ms.'=>'Ms.','Mrs.'=>'Mrs.','Dr.'=>'Dr.'),'maxlength'=>4,'label'=>false,'class'=>'form-control ','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserUNameTitle')))); ?>
						</div>
					</div>
				                                  
					                       <!-- For User First Name -->  
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('f_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">User First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserFName')))); ?>
						</div>
					</div>
					                       <!-- For User Middle Name -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('m_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">User Middle Name</label>
							</div>
						 <?php echo $this->JqueryValidation->input('m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserMName')))); ?>
						</div>
					</div>
					
					                        <!-- For User Last Name -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('l_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">User Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserLName')))); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
				                                  
					                       <!-- For Father's First Name -->  
					<div class="col-md-4"><?php echo $this->Form->isFieldError('InformationUser.uf_f_name') ? 'has-error' : '' ?>
						<div class="form-group ">
							<div>
								<label class="text-light-blue">Father's First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->Form->input('InformationUser.uf_f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserUfFName')))); ?>
						</div>
					</div>
					                       <!-- For Father's Middle Name -->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.uf_m_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Father's Middle Name</label>
							</div>
						 <?php echo $this->Form->input('InformationUser.uf_m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserUfMName')))); ?>
						</div>
					</div>
					
					                        <!-- For Father's Last Name -->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.uf_l_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Father's Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.uf_l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserUfLName')))); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
				                                  
					                       <!-- For Mother's First Name -->  
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.um_f_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Mother's First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->Form->input('InformationUser.um_f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserUmFName')))); ?>
						</div>
					</div>
					                       <!-- For Mother's Middle Name -->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.um_m_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Mother's Middle Name</label>
							</div>
						 <?php echo $this->Form->input('InformationUser.um_m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserUmMName')))); ?>
						</div>
					</div>
					
					                        <!-- For Mother's Last Name -->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.um_l_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Mother's Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('InformationUser.um_l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserUmLName')))); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
					                       <!--Gender -->
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.gender') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Gender</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.gender',array('options'=>array('Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender'),'type'=>'select','empty' => '--Select Gender--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserGender')))); ?>
						</div>
					</div>
					                       <!--Community -->
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.community') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Category</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.community',array('options'=>array('General'=>'General','SC'=>'SC','ST'=>'ST','OBC'=>'OBC','Others'=>'Others'),'empty' => '--Select Community--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserCommunity')))); ?>
						</div>
 					</div>
					                 <!--Religion-->
					<!--div class="col-md-4">
					 <?php //if($religion==Null || empty($religion)) 
					  //{
					 ?>
						<div class="form-group has-error">
					<?php  
					  //}
					  //else
					  //{
					?>	
					<div class="form-group">
					<?php //} ?>
						<div>
							<label class="text-light-blue">Religion</label><span class="asterisk text-red">* </span>
						</div>
						<?php //echo $this->Form->input('InformationUser.religion',array('options'=>array('Buddhism'=>'Buddhism','Christian'=>'Christian','Hinduism'=>'Hinduism','Jainism'=>'Jainism','Muslim'=>'Muslim','Sikh'=>'Sikh'),'empty' => '--Select Religion--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
 					</div!-->
					
					
				</div>	
				             
				<div class="row">
				
					                        <!--Select Date Of Birth -->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.d_o_b') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Date of Birth</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.d_o_b', array('placeholder'=>'Date of Birth','type'=>'text','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserDOB')))); ?>
						</div>
					</div>
				                         <!--Select State Of Birth-->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.s_o_b') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">State of Birth</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.s_o_b', array('type'=>'select','empty' => '--Select State of Birth--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserSOB')))); ?>
						</div>
					</div>	
					                  
									   <!--Enter Place Of Birth -->                
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.p_o_b') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Place of Birth</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.p_o_b', array('placeholder'=>'Place of Birth','label'=>false,'alphabetspace'=>true,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserPOB')))); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
				                    <!--Select Nationality -->
                     <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.nationality_id') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Nationality</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.nationality_id', array('empty' => '--Select Nationality--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserNationalityId')))); ?>
						</div>
					</div>
                                   <!--Marital Status-->
				   <div class="col-md-4">
				        <?php if($maritalStatus==Null || empty($maritalStatus)) 
					      {
					    ?>
						<div class="form-group has-error">
					  <?php  
					      }
					    else
					     {
					   ?>	
					     <div class="form-group <?php echo $this->Form->isFieldError('InformationUser.marital_status') ? 'has-error' : '' ?>">
					   <?php 
					     } 
					   ?>
							<div>
								<label class="text-light-blue">Marital Status</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('InformationUser.marital_status', array('type'=>'select','empty' => '--Select Status--','options'=>array('Single'=>'Single','Married'=>'Married'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserMaritalStatus')))); ?>
							</div>
				    </div>
					                <!--Are You Physically Challenged-->
					<div class="col-md-4">
							<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.physically_challenged') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Are you Physically Challenged</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('InformationUser.physically_challenged', array('type'=>'select','options'=>array('No'=>'No','Yes'=>'Yes'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserPhysicallyChallenged')))); ?>
							</div>
					</div>
					
				</div>
				
				
				
			  <div class="row">
			  
			            <script>
                                //To display back-end error message for Type Of Disability on front-end  						
									$(function(){
									OtherFieldTypeOfDisability	=	<?php 
																		if($this->Form->isFieldError('disability_id'))
																			echo 'true'; 
																		else 
																			echo 'false'; 
																	?>;
																	
									if(OtherFieldTypeOfDisability)
									{
										$('#InformationUserPhysicallyChallenged').trigger('change');	
									}
									OtherFieldOtherTypeOfDisability	=	<?php 
																		if($this->Form->isFieldError('other_disability'))
																			echo 'true'; 
																		else 
																			echo 'false'; 
																	?>;							
									if(OtherFieldTypeOfDisability)
									{
										$('#InformationUserPhysicallyChallenged').trigger('change');	
									}
									
									});		
						</script> 
			        	          <!--Type Of Disability-->
				        <div class="col-md-6" id="optionalList" style="display:none">
							<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.disability_id') ? 'has-error' : '' ?>">
							  <div>
								  <label class="text-light-blue">Type of Disability</label><span class="asterisk text-red">*</span>
							  </div>
							     <?php echo $this->Form->input('InformationUser.disability_id', array('empty'=>'--Select Disability--','label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserDisabilityId')))); ?>
						    </div>
					     </div> 
						 
						 
						 <div class="col-md-6" id="optionalOthers" style="display:none">
							<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.other_disability') ? 'has-error' : '' ?>">
							  <div>
								  <label class="text-light-blue">Other Disability</label><span class="asterisk text-red">*</span>
							  </div>
							     <?php echo $this->Form->input('InformationUser.other_disability', array('type'=>'textarea','placeholder'=>'Enter Your Disability','label'=>false,'class'=>'form-control','rangeLength'=>array(3,300),'maxlimit'=>300,'escape'=>true,'pattern'=>'^[a-zA-Z\n\s,-]+$','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
						    </div>
					     </div>
                                  <!--Hobbies-->						 
                    <!--div class="col-md-6">
					<?php //if($hobbies==Null || empty($hobbies)) 
					    //{
					 ?>
						<div class="form-group has-warning">
					<?php  
					  //}
					  //else
					  //{
					?>	
					<div class="form-group">
					<?php //} 
					?>
							<div>
								<label class="text-light-blue">Hobbies</label>
							</div>
							<?php //echo $this->Form->textArea('InformationUser.hobbies', array('placeholder'=>'Enter Your Hobbies','label'=>false,'class'=>'form-control','maxlimit'=>300)); ?>
							</div>
					</div>					    					
              </div-->			  
			</div>
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Save & Next</button>
				</div>
          			<?php echo $this->Form->end(); ?>
	        </div><!--Primary Box-->
	    </div><!--First Column-->	
  </div>		
<script>
  $(function(){
   
        //For Physically Challenged
		  $('#InformationUserPhysicallyChallenged').change(function(){
		                                                               physicallyChallenged=$(this).val();
																	   if(physicallyChallenged=='Yes')
																	    {
																	     $('#optionalList').show();
																		 $('#optionalOthers').hide();
																		 $('#InformationUserDisabilityId').rules("add", {
																															required: function(element){
																																							physically_chalenged = $('#InformationUserPhysicallyChallenged option:selected').html();
																																							if(physically_chalenged==='Yes')
																																							return true;
																																						},
																															
																														
																												}); 
																		  $('#InformationUserDisabilityId').change(function(){
																		                    disabilityType = $('#InformationUserDisabilityId option:selected').html();
																		                    if(disabilityType=='Others')
																							 {
																							   $('#optionalOthers').show();
																							   $('#InformationUserOtherDisability').rules("add", {
																															required: function(element){
																																							disablilityType = $('#InformationUserDisabilityId option:selected').html();
																																							if(disablilityType==='Others')
																																							return true;
																																						},
																															alphanumeric: true,
																														
																												});
																							 }
																							else
                             																 {
																							  $('#optionalOthers').hide();
																							  $('#InformationUserOtherDisability').val('');
																							  $('#InformationUserOtherDisability').rules("remove");
																							 }						
																		  });
																		  
																		  //if('InformationUserDisabilityId')
																	    } 
																		if(physicallyChallenged=='No')
																		 {	
																		  $('#InformationUserDisabilityId').val('');
																		  $('#optionalList').hide();
																		  $('#optionalOthers').hide();
																		  $('#InformationUserOtherDisability').val('');
																		  $('#InformationUserDisabilityId').rules("remove");
																		 } 
		                                                             }
														  );
														  
	        $('#InformationUserPhysicallyChallenged').trigger('change');
			$('#InformationUserDisabilityId').trigger('change');
			$('#InformationUserDOB').datepicker({
			               format: 'dd-mm-yyyy'
			});

   })
</script>

                       