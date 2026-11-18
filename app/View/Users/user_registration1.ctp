<script>
$(function(){
$('#UserBelongToMos').change(function(){
                                        belongToMininstry = $('#UserBelongToMos').val();
										  if(belongToMininstry=='Yes' || belongToMininstry=='')
										    {
											 $('#optional-row').hide();
						                     $('#UserBelongToPort').val('');
                                             $('#UserBelongToPort').trigger('change');											 
											}
										  if(belongToMininstry=='No')
                                            {
											 $('#optional-row').show();
											}										  
										}
							);
$('#UserBelongToPort').change(function(){
                                          belongToPort = $('#UserBelongToPort').val();
										    if(belongToPort == '')
											 {
											  $('#orgn').hide();
											  $('#others').hide();
											  $('#UserOrganizationId').val('');
											  $('#UserOtherOrgn').val('');
											 }
											if(belongToPort == 'Yes')  
											  {
											    $('#orgn').show();
												$('#others').hide();
												$('#UserOtherOrgn').val('');
											  }
											if(belongToPort == 'No')
                                              {
											    $('#UserOrganizationId').val('');
											    $('#orgn').hide(); 
											    $('#others').show();
											  }											
										  });
										  
$('#UserUserRegistration1Form').submit(function(){
                                                  belongsToMininstry = $('#UserBelongToMos').val();
                                                    if(belongsToMininstry=='No')
                                                      {
													    belongsToPort=$('#UserBelongToPort').val();
														  if(belongToPort=='')
														    {
															 $('#UserBelongToPort').addClass('form-error');
															 $('#UserBelongToPort').attr('aria-required',true);
															 $('#UserBelongToPort').closet('form-group').addClass('has-error');
															 return false;
															}
													  }													
												
												
												
												});										  

})
</script>
<div class="row">            				
                         <!-- For Registration Page-->						 
	 <div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('User Registration'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
			<?php echo $this->Session->flash(); ?>					   
			<?php echo $this->Form->create('User',array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php //echo $this->JqueryValidation->input('profilepic', array('type' => 'hidden')); ?>
			
			<div class="box-body">
				
				<div class="row">
				       			  
					                       <!-- For User First Name -->  
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">User First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					                       <!-- For User Middle Name -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">User Middle Name</label>
							</div>
						 <?php echo $this->JqueryValidation->input('m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					
					                        <!-- For User Last Name -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">User Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
				                                  
					                       <!-- For Father's First Name -->  
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Father's First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.uf_f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
					                       <!-- For Father's Middle Name -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Father's Middle Name</label>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.uf_m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					
					                        <!-- For Father's Last Name -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Father's Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('InformationUser.uf_l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
				                                  
					                       <!-- For Mother's First Name -->  
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Mother's First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.um_f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
					                       <!-- For Mother's Middle Name -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Mother's Middle Name</label>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.um_m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					
					                        <!-- For Mother's Last Name -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Mother's Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('InformationUser.um_l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>[2,30],'maxlength'=>30,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				</div>
				
				<div class="row">
					                       <!--Gender -->
					<div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Gender</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.gender',array('options'=>array('Male'=>'Male','Female'=>'Female'),'type'=>'select','empty' => '--Select Gender--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
					                       <!--Community -->
					<div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Community<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.community',array('options'=>array('UR'=>'UR','SC'=>'SC','ST'=>'ST','OBC'=>'OBC','Others'=>'Others'),'empty' => '--Select Community--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
 					</div>
					                   <!--Religion-->
					<div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Religion<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.religion',array('options'=>array('Christian'=>'Christian','Hinduism'=>'Hinduism','Jainism'=>'Jainism','Muslim'=>'Muslim','Sikh'=>'Sikh'),'empty' => '--Select Religion--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
 					</div>
					        
					
				</div>	
				             
				<div class="row">
				                      <!--Select Date Of Birth -->
					<div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Date Of Birth<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.d_o_b', array('placeholder'=>'Date Of Birth','type'=>'text','label'=>false,'class'=>'form-control','required'=>true,'data-mask'=>"" ,'data-inputmask'=>"'alias': 'yyyy/mm/dd'")); ?>
						</div>
					</div>        
         							<!--Select State Of Birth-->
					<div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">State where You were born<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.s_o_b', array('type'=>'select','empty' => '--Select State of Birth--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>	
					                  
									   <!--Select Place Of Birth -->                
					<div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Place Of Birth<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.p_o_b', array('placeholder'=>'Place of Birth','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
					</div>
										         
				<!--/div-->
				
				                  
				<div class="row">
					                 <!--Select Nationality -->
                    <div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Nationality<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.nationality_id', array('empty' => '--Select Nationality--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
                                              <!--Email Address-->					
					<div class="col-md-4">
						<div class="form-group">
						    <div>
								<label class="text-light-blue">Email Id<label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-envelope"></i>
							        </div>	
							      <?php echo $this->JqueryValidation->input('email',array('placeholder'=>'Email Address','class'=>'form-control','label' => false,'maxlength'=>200,'email'=>true,'required'=>true)); ?>
                               </div>
							</div>						
							
						</div>
						
					                      <!-- Mobile Number -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Mobile Number<label><span class="asterisk text-red">* </span>
							</div>
							 <div class="input-group">
                               <div class="input-group-addon">
                                 <i class="fa fa-phone"></i>
							    </div>							   			
							     <?php echo $this->JqueryValidation->input('mobile_number', array('placeholder'=>'Mobile Number','label'=>false,'maxlength'=>10,'digits'=>true,'class'=>'form-control','required'=>true)); ?>
					          </div>
						</div>
					</div>
                </div>					
                                

				<div class="row">	
					<div class="col-md-4">
						<div class="form-group">
						    <div>
								<label class="text-light-blue">Password<label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-lock"></i>
							        </div>	
							      <?php echo $this->JqueryValidation->input('password',array('placeholder'=>'Password','class'=>'form-control','label' => false,'required'=>true)); ?>
                               </div>
							</div>						
							
						</div>
						
					                      <!-- Conform Password -->
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Confirm Password<label><span class="asterisk text-red">* </span>
							</div>
							 <div class="input-group">
                               <div class="input-group-addon">
                                 <i class="fa fa-hand-o-right"></i>
							    </div>							   			
							     <?php echo $this->JqueryValidation->input('retype_password', array('placeholder'=>'Retype Password','label'=>false,'class'=>'form-control','required'=>true)); ?>
					          </div>
						</div>
					</div>
					                    <!--Belong To Ministry -->
                    <div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Whether Belong To Ministry of Shipping<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.belong_to_mos', array('empty' => '-- Select --','options'=>array('Yes'=>'Yes','No'=>'No'),'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
				</div>
				
				                       
			<div class="row" id="optional-row" style="display:none">

			                 <!--Belong To Ports -->
                    <div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Whether Belong To Ports<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.belong_to_port', array('empty' => '-- Select --','options'=>array('Yes'=>'Yes','No'=>'No'),'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					
					           <!--Select Ports -->
                    <div class="col-md-4" id="orgn" style="display:none">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Port to which you Belong<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('organization_id', array('empty' => '-- Select Port--','label'=>false,'class'=>'form-control',)); ?>
						</div>
					</div>
					    
						       <!--Other Organization -->
                    <div class="col-md-4" id="others" style="display:none">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Other Organization<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('InformationUser.other_orgn', array('placeholder'=>'Enter Organization Name','label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
			
			
			
                                        <!-- For User Address -->
					 <!--div class="col-md-8">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Address<label><span class="asterisk">* </span><label>
							</div>
							<?php //echo $this->JqueryValidation->textarea('address', array('placeholder'=>'Enter Contact Address','class'=>'form-control','label'=>false,'required'=>true)); ?>	
						</div>
					</div-->
					 
					                        <!-- For State -->
									
					<!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">State</label><span class="asterisk">* </span>
							</div>
						<?php //echo $this->JqueryValidation->input('state_id', array('empty'=>'-- Select State -- ', 'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div-->
		    </div>
									
				<!--div class="row">		
				                    
					           <!-- For City -->
							   
					<!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">City</label><span class="asterisk">* </span>
							</div>
						<?php //echo $this->JqueryValidation->input('city_id', array('empty'=>'-- Select City --', 'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div-->
					
					                <!-- Pin Code -->    
                    <!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Pin Code</label><span class="asterisk">* </span>
							</div>
						<?php //echo $this->JqueryValidation->input('pin_code', array('placeholder'=>'Pin Code','label'=>false,'digits'=>true,'class'=>'form-control','required'=>true,'data-mask'=>"", 'data-inputmask'=>"'mask': ['99-99-99']")); ?>
						</div>
					</div-->
					             
								   <!--Select Your Organization-->
					 <!-- class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Select Your Organization</label><span class="asterisk">* </span>
							</div>
						<?php //echo $this->JqueryValidation->input('organization_id', array('empty'=>'--Select Organization--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div-->
                    
			    <!--/div-->
				
	                      <!-- For Profile Picture -->
				<!--div class="row">
					<div class="col-md-4">
						<div class="form-group">
						
							<div>
								<label class="text-light-blue">Profile Pic<label>
							</div>
							<input id="ProfilePic" type="file"  extension="png|jpeg|jpg|gif"/>
				
						</div>
						
					</div>
					            <!-- For Viewing Uploaded Pic -->
					<!--div class="col-md-2">
						<div class="form-group" id="uploaded_pic_view_container" style="display:none">
							<div>
								<label class="text-light-blue">Profile Pic Preview<label>
							</div>
							<div id="uploaded_pic_view">
								<?php //echo $this->Html->image('ajax-loader.gif', array('alt' => 'Loading image preview'));?>
								
							</div>
							
						</div>
					</div-->					
					
				</div>
			<div class="box-footer text-center">
				<large><button type="submit" class="btn btn-primary btn-lg">Register  Me Here</button></large>
			</div>
			<?php echo $this->Form->end(); ?>
	     </div><!--Primary Box-->
	</div><!--First Column-->		
		        
				
</div>	