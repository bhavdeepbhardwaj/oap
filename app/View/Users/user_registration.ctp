<script>
$(function(){
$('#registration').parent().remove();

$('#datepicker').datepicker({
	        format: 'dd-mm-yyyy'
  });
  
OtherFieldError	=	<?php 
					if($this->Form->isFieldError('InformationUser.other_orgn') )
						echo 'true'; 
					else 
					echo 'false'; ?>;
if(OtherFieldError)
{
	$('#col-other-org').show();	
} 


userOrgn = $('#UserOrganizationId option:selected').html();
if(userOrgn==='Others')
 {
   $('#col-other-org').show();
 }  

$('#UserOrganizationId').change(function(){
           
    userOrgn = $('#UserOrganizationId option:selected').html();
	if(userOrgn==='Others')
	 {
       $('#col-other-org').show();	  
		$('#UserOtherOrgn').rules("add", {
										required: function(element){
																		userOrgn = $('#UserOrganizationId option:selected').html();
																		if(userOrgn==='Others')
																		return true;
																	},
										minlength: 3,
										alphabetspace:true	
									});
	 }
	 else
	 {
		$("#UserOtherOrgn").rules( "remove" );
		$('#UserOtherOrgn').val('');
		$('#col-other-org').hide();
	 }

});    
	
 

/*
$('#UserOtherOrgn').keyup(function(){

				
					$('#UserOtherOrgn').removeClass('.form-error');
					$('#UserOtherOrgn').removeAttr('aria-required');
					$('#UserOtherOrgn').closest('.form-group').removeClass('has-error');
					
					$('span[for=UserOtherOrgn]').remove();
				
				
				if($(this).val()=='' )
				{
					$('#UserOtherOrgn').addClass('.form-error');
					$('#UserOtherOrgn').attr('aria-required',true);
					$('#UserOtherOrgn').closest('.form-group').addClass('has-error');
					$('<span class="text"  for="UserOtherOrgn">This field is required.</span>').appendTo($('#UserOtherOrgn').closest('.form-group'));
					$('span[for=UserOtherOrgn]').css('color','#dd4b39');
				}
});							

$('#UserOrganizationId').change(function(){
											$('#UserOrganizationId').removeClass('.form-error');
											$('#UserOrganizationId').removeAttr('aria-required');
											$('#UserOrganizationId').closest('.form-group').removeClass('has-error');
											
											$('span[for=UserOrganizationId]').remove();
										
										
										if($(this).val()=='' )
										{
											$('#UserOrganizationId').addClass('.form-error');
											$('#UserOrganizationId').attr('aria-required',true);
											$('#UserOrganizationId').closest('.form-group').addClass('has-error');
											$('<span class="text"  for="UserOrganizationId">This field is required.</span>').appendTo($('#UserOrganizationId').closest('.form-group'));
											$('span[for=UserOrganizationId]').css('color','#dd4b39');
										}
								});*/
			


 
 $('#reload').click(function() {
          var captcha = $("#captcha_image");
           captcha.attr('src', captcha.attr('src')+'?'+Math.random());
		   $('#UserCaptcha').val('');
          return false;
      });
				
})
</script>
<div class="wrapper">
<div class="container">
<section class="content">
<div class="row">            				
                         <!-- For Registration Page-->						 
	 <div class="col-md-12">
	    <?php echo $this->Session->flash('msg'); ?>
	<?php if($register) {?>
 	<div class="box box-primary" style="background-color:#ffff">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('User Registration'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->					   
			<?php echo $this->Form->create('User',array('role' => "form",'class' => 'jquery-validation','autocomplete'=>'off')); ?>
			
			<div class="box-body">
				
				<div class="row">
				       			      <!-- For User Salutation -->  
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
						 <?php echo $this->JqueryValidation->input('f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>array(1,30),'maxlength'=>30,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserFName')))); ?>
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
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.uf_f_name') ? 'has-error' : '' ?>">
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
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.gender') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Gender</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.gender',array('options'=>array('Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender'),'type'=>'select','empty' => '--Select Gender--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserGender')))); ?>
						</div>
					</div>
					                       <!--Category-->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.community') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Category</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.community',array('options'=>array('General'=>'General','SC'=>'SC','ST'=>'ST','OBC'=>'OBC','PWD'=>'PWD','Others'=>'Others'),'empty' => '--Select Category--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserCommunity')))); ?>
						</div>
 					</div>
					                   <!--Religion-->
					<!--div class="col-md-4">
						<div class="form-group">
						<div>
							<label class="text-light-blue">Religion<label><span class="asterisk">* </span><label>
						</div>
						<?php //echo $this->Form->input('InformationUser.religion',array('options'=>array('Buddhism'=>'Buddhism','Christian'=>'Christian','Hinduism'=>'Hinduism','Jainism'=>'Jainism','Muslim'=>'Muslim','Sikh'=>'Sikh'),'empty' => '--Select Religion--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
 					</div-->
					                  <!--Select Date Of Birth -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.d_o_b') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Date of Birth</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.d_o_b', array('id'=>'datepicker','placeholder'=>'Date of Birth','type'=>'text','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'datepicker')))); ?>
						</div>
					</div>           
					
									<!--Select State Of Birth-->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.s_o_b') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">State of Birth</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.s_o_b', array('type'=>'select','empty' => '--Select State of Birth--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserSOB')))); ?>
						</div>
					</div>	
					
					
				</div>	
				             
			                  
				<div class="row">
				                <!--Place of Birth -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.p_o_b') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Place of Birth</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.p_o_b', array('placeholder'=>'Place of Birth','label'=>false,'class'=>'form-control','required'=>true,'alphabetspace'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserPOB')))); ?>
						</div>
					</div>                
                                 								
                                              <!--Email Address-->					
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('email') ? 'has-error' : '' ?>">
						    <div>
								<label class="text-light-blue">Email Id</label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-envelope"></i>
							        </div>	
							      <?php echo $this->JqueryValidation->input('email',array('placeholder'=>'Email Address','class'=>'form-control','label' => false,'maxlength'=>50,'email'=>true,'required'=>true,'autocomplete'=>'off','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmail')))); ?>
                               </div>
							</div>						
							
						</div>
					<div class="col-md-3">	
						<div class="form-group <?php echo $this->Form->isFieldError('username') ? 'has-error' : '' ?>">
						    <div>
								<label class="text-light-blue">Username</label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-user"></i>
							        </div>	
							      <?php echo $this->JqueryValidation->input('username',array('placeholder'=>'Username','class'=>'form-control','label' => false,'required'=>true,'rangeLength'=>array(5,15),'maxlength'=>15,'autocomplete'=>'off','pattern'=>'^[a-zA-Z0-9._]+$','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserUsername')))); ?>
                               </div>
						</div>
                    </div>
						                     <!-- Password-->
					<!--div class="col-md-3">	
						<div class="form-group">
						    <div>
								<label class="text-light-blue">Password</label><span class="asterisk text-red">* </span>
						    </div>
						      <div class="input-group">
							       <div class="input-group-addon">
						               <i class="fa fa-lock"></i>
							        </div>	
							      <?php //echo $this->JqueryValidation->input('password',array('placeholder'=>'Password','class'=>'form-control','label' => false,'required'=>true,'autocomplete'=>'off')); ?>
                               </div>
						</div>
                    </div>						
                                             
					<div class="col-md-3">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Confirm Password</label><span class="asterisk text-red">* </span>
							</div>
							 <div class="input-group">
                               <div class="input-group-addon">
                                 <i class="fa fa-hand-o-right"></i>
							    </div>							   			
							     <?php //echo $this->JqueryValidation->input('retype_password', array('placeholder'=>'Retype Password','label'=>false,'class'=>'form-control','required'=>true)); ?>
					          </div>
						</div>
					</div-->						
						
					
                </div>					
                                

				<div class="row">	
						           <!--Select Nationality -->
							<div class="col-md-3">
								<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.nationality_id') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Nationality</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->Form->input('InformationUser.nationality_id', array('empty' => '--Select Nationality--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserNationalityId')))); ?>
								</div>
							</div>
			
					                      <!-- Mobile Number -->
					<div class="col-md-3">
						<div class="form-group <?php echo $this->Form->isFieldError('mobile_number') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Mobile Number</label><span class="asterisk text-red">* </span>
							</div>
							 <div class="input-group">
                               <div class="input-group-addon">
                                 <i class="fa fa-phone"></i>
							    </div>							   			
							     <?php echo $this->JqueryValidation->input('mobile_number', array('placeholder'=>'Mobile Number','label'=>false,'maxlength'=>10,'minlength'=>10,'digits'=>true,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserMobileNumber')))); ?>
					          </div>
						</div>
					</div>
					
					              <!--Select Organization -->
                    <div class="col-md-3" id="col-organization-id">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_id') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Select Your Organization</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->JqueryValidation->input('organization_id', array('empty' => '-- Select--','label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserOrganizationId')))); ?>
						</div>
					</div>

						       <!--Other Organization -->
                    <div class="col-md-3" style="display:none" id="col-other-org">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.other_orgn_name') ? 'has-error' : '' ?>">
						<div>
							<label class="text-light-blue">Other Organization</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('InformationUser.other_orgn_name', array('placeholder'=>'Enter Organization Name','label'=>false,'class'=>'form-control','maxlength'=>60,'rangeLength'=>array(3,60),'alphabetspace'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserOtherOrgn')))); ?>
						</div>
					</div>
                    
				</div>
				
				                       
			<div class="row" id="optional-row" style="display:none">
    
					
			
			
			
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
									
				<div class="row">		
				                    
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
                    
			    </div>
				         <!-- For Captcha -->
              <div class="row">	
				<div class="col-md-12">	
					 <div class="row pad">
							<div class="form-group">
								<div class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4" >
									<span style="float:left">
									<?php
										echo $this->Html->image(array('controller' => 'users', 'action' => 'get_captcha/'.time()),array('id' => 'captcha_image','class'=>'img-responsive'));
									?>	
									</span>
									<span style="padding:1% 0;float:left">
									<?php
									echo $this->Html->link('<i class="fa fa-fw fa-refresh"></i>', 'javascript:void(0);',array('id' => 'reload','escape' => false,'title'=>'Reload Captcha'));
									?>	
									</span>
								</div>
										
							</div>	
					  </div>
				  </div>
		     </div>
			 <div class="row">		 
		         <div style="clear:both"></div>			  
		     </div>
			 <div class="row">	
			  <div class="col-md-offset-4 col-md-3">
	    	    <div class="form-group <?php echo $this->Form->isFieldError('captcha') ? 'has-error' : '' ?>">
				  <?php 
				    //uncomment after security audit
				    echo $this->Form->input('captcha',array('label'=>false, 'placeholder'=>'Enter Captcha Code', 'class'=>'form-control','maxlength'=>7,'required'=>true,'autocomplete'=>'off'));
				  ?>    
		        </div>
			   </div>	
             </div> 		  
				
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
	<?php } ?>	
	</div><!--First Column-->		
		        
				
</div>
</section>
</div>
</div>


                       