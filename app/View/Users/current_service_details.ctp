<?php //pr($nameOPOrgn);?>
<div class="row">
   <div class="col-md-12">
   <?php echo $this->Session->flash(); ?>		
       <div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Service Related Details'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
            						   
			<?php echo $this->Form->create('InformationUser',array('role' => "form",'url'=>array('controller'=>'users','action'=>'current_service_details'),'class'=>'jquery-validation')); ?>	
			<?php echo $this->Form->input('InformationUser.id',array('type'=>'hidden')); ?>
			<div class="box-body">
				
				<div class="row">
				  
                                        <!-- Date of Initial Appointment -->  
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.d_o_i_appoint') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Date of Initial Appointment</label><span class="asterisk text-red">* </span>
							</div>
			     			<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>	
						        <?php echo $this->JqueryValidation->input('InformationUser.d_o_i_appoint',array('type'=>'text','placeholder'=>'dd-mm-yyyy','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserDOIAppoint')))); ?>
						    </div>
						</div>
					</div>
				  
				                       <!-- Present Employment Type -->  
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.present_emp_type') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Present Employment Type</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.present_emp_type', array('empty'=>'--Select--','options'=>array('Ad-hoc'=>'Ad-hoc','Deputation'=>'Deputation','Temporary'=>'Temporary','Transfer'=>'Transfer','Permanent'=>'Permanent'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserPresentEmpType')))); ?>
						</div>
					</div>
					
					                       <!-- Date of Initial Appointment -->  
					<div class="col-md-4" id="doi" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.dt_appoint_date'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldError)
									{
										$('#InformationUserPresentEmpType').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.dt_appoint_date') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Initial Appointment Date(Deputation/Transfer Basis)</label><span class="asterisk text-red">* </span>
							</div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>	
						           <?php echo $this->JqueryValidation->input('InformationUser.dt_appoint_date', array('type'=>'text','placeholder'=>'dd-mm-yyyy','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserDtAppointDate')))); ?>
						    </div> 
						</div>
					</div>
					
					                       <!-- Period Of Appointment -->  
					<div class="col-md-4" id="poi" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.period_of_appoint_dt'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldError)
									{
										$('#InformationUserPresentEmpType').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.period_of_appoint_dt') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Appointment Period(Deputation/Transfer Basis)</label><span class="asterisk text-red">* </span>
							</div>
							<!--div class="input-group">
								<!--div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div-->	
						          <?php echo $this->JqueryValidation->input('InformationUser.period_of_appoint_dt', array('placeholder'=>'Enter Your Appointment Period....','label'=>false,'class'=>'form-control','maxlength'=>2,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserPeriodOfAppointDt')))); ?>
						    <!--/div-->
						</div>
					</div>
					
                                           <!-- Name Of Parent Organization -->  
					<div class="col-md-4" id="parentorgn" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.name_o_p_orgn'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldError)
									{
										$('#InformationUserPresentEmpType').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.name_o_p_orgn') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Parent Organization</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.name_o_p_orgn', array('type'=>'select','empty'=>'--Select--','options'=>$nameOPOrgn,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserNameOPOrgn')))); ?>
						</div>
					</div>

				                           <!-- Other Parent Organization -->  
					<div class="col-md-2" id="other-parent-orgn" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.other_parent_organization'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldError)
									{
										$('#InformationUserPresentEmpType').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.other_parent_organization') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Others</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.other_parent_organization', array('placeholder'=>'Parent Organization Name','label'=>false,'class'=>'form-control','required'=>true,'maxlength'=>60,'rangeLength'=>array(3,60),'alphabetspace'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOtherParentOrganization')))); ?>
						</div>
					</div>
					
					                       <!-- Current Organization -->  
					<div class="col-md-4" id="currentorgn" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.current_organization'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldError)
									{
										$('#InformationUserPresentEmpType').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.current_organization') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Present Organization</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.current_organization', array('type'=>'select','empty'=>'--Select--','options'=>$currentOrganization,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserCurrentOrganization')))); ?>
						</div>
					</div>
					
					                       <!-- Other Organization -->  
					<div class="col-md-2" id="other-current-orgn" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.other_current_organization'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldError)
									{
										$('#InformationUserPresentEmpType').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.other_current_organization') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Others</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.other_current_organization', array('placeholder'=>'Present Organization Name','label'=>false,'class'=>'form-control','required'=>true,'maxlength'=>60,'rangeLength'=>array(3,60),'alphabetspace'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOtherCurrentOrganization')))); ?>
						</div>
					</div>
					
					
					                      <!-- Nature Of Present Employment-->  
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.nature_of_present_emp') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Nature of Present Employment</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.nature_of_present_emp', array('placeholder'=>'Nature Of Present Employment....','label'=>false,'class'=>'form-control','rows'=>3,'escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s,-]+$','maxlength'=>255,'rangeLength'=>array(3,255),'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserNatureOfPresentEmp')))); ?>
						</div>
					</div>
					
					                   <!-- Working Under -->  
					<div class="col-md-4" id ="working-under">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.working_under') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Working Under</label><span class="asterisk text-red">*</span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.working_under', array('empty'=>'--Select--','options'=>array('Central Government'=>'Central Government','State Government'=>'State Government','Autonomous Organizations'=>'Autonomous Organizations','Government Undertakings'=>'Government Undertakings','Private Organization'=>'Private Organization'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserWorkingUnder')))); ?>
						</div>
					</div>
					                               
					               <!-- Current Age -->  
					<!-- <div class="col-md-">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Current Age</label><span class="asterisk">* </span><label>
							</div>
						 <?php //echo $this->Form->input('d_o_b', array('label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div> -->
					
					             <!-- Date Of Retirement -->  
					<div class="col-md-4" id="d-o-r">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.d_o_r') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Date of Retirement</label><span class="asterisk text-red">* </span>
							</div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
						          <?php 
								  echo $this->JqueryValidation->input('InformationUser.d_o_r', array('placeholder'=>'dd-mm-yyyy','type'=>'text','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserDOR')))); ?>
						    </div>  
						</div>
					</div>
					
					                     <!-- Present Post -->  
					<div class="col-md-4" id="present-post">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.present_post') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Present Post</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.present_post', array('placeholder'=>'Present Post','label'=>false,'class'=>'form-control','alphabetspace'=>true,'maxlength'=>100,'rangeLength'=>array(3,100),'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserPresentPost')))); ?>
						</div>
					</div>
					
					           <!-- Present Scale Pay -->  
					<div class="col-md-4" id="present-scale-pay">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.present_scale_pay') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Present Scale of Pay</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.present_scale_pay', array('placeholder'=>'Present Scale of Pay', 'label'=>false,'pattern'=>'^[0-9-]+$','maxlength'=>22,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserPresentScalePay')))); ?>
						</div>
					</div>
					
					                       <!-- Consolidated Emoluments for Pvt. Organization -->  
					<div class="col-md-3" id="consolidated-emoluments" style="display:none">
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('InformationUser.consolidated_emoluments'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;
									if(OtherFieldError)
									{
										$('#InformationUserWorkingUnder').trigger('change');	
									}					
									
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.consolidated_emoluments') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Consolidated Emoluments(in Rs.)</label>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.consolidated_emoluments', array('placeholder'=>'Consolidated Emoluments','label'=>false,'class'=>'form-control','maxlength'=>8,'digits'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserConsolidatedEmoluments')))); ?>
						</div>
					</div>
					           <!-- Present Grade Pay -->  
					<div class="col-md-3" id="present-grade-pay">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.present_grade_pay') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Present Grade Pay</label>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.present_grade_pay', array('label'=>false,'class'=>'form-control','digits'=>true,'maxlength'=>5,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserPresentGradePay')))); ?>
						</div>
					</div>
					
					        <!-- Date from which in this Pay -->  
					<div class="col-md-3" id="strt-dt-of-pay">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.strt_dt_of_pay') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Date from which in this Pay</label>
							</div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>	
						           <?php echo $this->JqueryValidation->input('InformationUser.strt_dt_of_pay', array('type'=>'text','placeholder'=>'dd-mm-yyyy','label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserStrtDtOfPay')))); ?>
						    </div>
						</div>
					</div>
					
					          <!-- Continuous Regular Appointment Date -->  
					<div class="col-md-3" id="cont-reg-appoint-date">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.cont_reg_appoint_date') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Continuous Regular Appointment Date</label><span class="asterisk text-red">* </span>
							</div>
						   <div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>	
						        <?php echo $this->JqueryValidation->input('InformationUser.cont_reg_appoint_date', array('placeholder'=>'dd-mm-yyyy','type'=>'text','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserContRegAppointDate')))); ?>
						   </div>
						</div>
					</div>
					       <!--Whether Belong To CDA/IDA-->
					<div class="col-md-3" id="belong-to-ci">
						<div class="form-group <?php echo $this->Form->isFieldError('InformationUser.belong_to_ci') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Whether Belong To (CDA/IDA)</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('InformationUser.belong_to_ci', array('empty'=>'--Select--','options'=>array('CDA'=>'CDA','IDA'=>'IDA'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserBelongToCi')))); ?>
						</div>
					</div>	   
			
					
		   </div>	 
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Save & Next</button>
                    <button type="button" class="btn btn-primary" id="reset1"><i class="fa fa-refresh"></i> Reset </button>
				</div>
          			<?php echo $this->Form->end(); ?>	  
			</div><!--Primary Box-->
	     </div><!--First Column-->
    </div>	
 </div>
<script type="text/javascript">

$(function(){
  
  initialAppoint  =$('#InformationUserDOIAppoint').val();
  presentEmpType  =$('#InformationUserPresentEmpType').val();
  dtAppointDate   =$('#InformationUserDtAppointDate').val();
  periodOfAppoint =$('#InformationUserPeriodOfAppointDt').val();
  parentOrgn      =$('#InformationUserNameOPOrgn').val();
  parentOtherOrgn =$('#InformationUserOtherParentOrganization').val();
  presentOrgn     =$('#InformationUserCurrentOrganization').val();
  presentOtherOrgn=$('#InformationUserOtherCurrentOrganization').val();
  empNature       =$('#InformationUserNatureOfPresentEmp').val();
  workUnder       =$('#InformationUserWorkingUnder').val();
  dor             =$('#InformationUserDOR').val();
  presentPost     =$('#InformationUserPresentPost').val();
  presentScale    =$('#InformationUserPresentScalePay').val();
  presentGrade    =$('#InformationUserPresentGradePay').val();
  datePay         =$('#InformationUserStrtDtOfPay').val();
  contReg         =$('#InformationUserContRegAppointDate').val();
  belongToCi      =$('#InformationUserBelongToCi').val();
  consolidatedEmoluments = $('#InformationUserConsolidatedEmoluments').val();
  
    function resetAll(){ 
					
					 presentEmpType1=$('#InformationUserPresentEmpType').val();
					 
					  if(presentEmpType1==='Deputation' || presentEmpType1==='Transfer')
						{ 
						 $('#doi').show();
						 $('#poi').show();
						 $('#parentorgn').show();
						 $('#currentorgn').show();
			             $('#working-under').removeClass('col-md-3');
						 $('#working-under').addClass('col-md-4');
						 $('#d-o-r').removeClass('col-md-3');
						 $('#d-o-r').addClass('col-md-4');
						 $('#present-post').removeClass('col-md-3');
						 $('#present-post').addClass('col-md-4');
						 $('#present-scale-pay').removeClass('col-md-3');
						 $('#present-scale-pay').addClass('col-md-4');
						 $('#InformationUserDtAppointDate').rules("add", {
																		required: function(element){
																										presentEmpType = $('#InformationUserPresentEmpType').val();
																										if(presentEmpType==='Deputation' || presentEmpType==='Deputation')
																										return true;
																									},
																		
						
																	});
						$('#InformationUserPeriodOfAppointDt').rules("add", {
																		required: function(element){
																										presentEmpType = $('#InformationUserPresentEmpType').val();
																										if(presentEmpType==='Deputation' || presentEmpType==='Deputation')
																										return true;
																									},
																		maxlength: 2,
																	    digits:true	
						
																	});	
						$('#InformationUserNameOPOrgn').rules("add", {
																		required: function(element){
																										presentEmpType = $('#InformationUserPresentEmpType').val();
																										if(presentEmpType==='Deputation' || presentEmpType==='Deputation')
																										return true;
																									},
																		
						
																	});
						$('#InformationUserCurrentOrganization').rules("add", {
																		required: function(element){
																										presentEmpType = $('#InformationUserPresentEmpType').val();
																										if(presentEmpType==='Deputation' || presentEmpType==='Deputation')
																										return true;
																									},
																		
						
																	});

												
						
						} 
					   if(presentEmpType1=='Ad-hoc'|| presentEmpType1=='Temporary' || presentEmpType1=='Permanent' || presentEmpType1=='' )	
						 {
						  $('#doi').hide();
						  $('#poi').hide();
						  $('#parentorgn').hide();
						  $('#currentorgn').hide();
						  $('#InformationUserDtAppointDate').val('');
						  $('#InformationUserPeriodOfAppointDt').val('');
						  $('#InformationUserNameOPOrgn').val('');
						  $('#InformationUserCurrentOrganization').val('');
						  //Change Parent Orgn
                          $('#InformationUserNameOPOrgn').trigger('change');
						  //Change Current Orgn
                          $('#InformationUserCurrentOrganization').trigger('change');
						  //$('#InformationUserDtAppointDate').rules("remove");
    					  //$('#InformationUserPeriodOfAppointDt').rules("remove");
						  //$('#InformationUserNameOPOrgn').rules("remove");
						  //$('#InformationUserCurrentOrganization').rules("remove");
						  
						  $('#working-under').removeClass('col-md-4');
						  $('#working-under').addClass('col-md-3');
						  $('#d-o-r').removeClass('col-md-4');
						  $('#d-o-r').addClass('col-md-3');
						  $('#present-post').removeClass('col-md-4');
						  $('#present-post').addClass('col-md-3');
						  $('#present-scale-pay').removeClass('col-md-4');
						  $('#present-scale-pay').addClass('col-md-3');
						  
						 }
						 
					}
					
	function resetCall(){ 
	                       
							   $('#InformationUserDOIAppoint').val(initialAppoint);
							   
							   $('#InformationUserPresentEmpType').val(presentEmpType);
							   $('#InformationUserPresentEmpType').trigger('change');
							   $('#InformationUserDtAppointDate').val(dtAppointDate);
                               $('#InformationUserPeriodOfAppointDt').val(periodOfAppoint);
							   $('#InformationUserNameOPOrgn').val(parentOrgn);
							   $('#InformationUserNameOPOrgn').trigger('change');
							   $('#InformationUserOtherParentOrganization').val(parentOtherOrgn);
							   $('#InformationUserCurrentOrganization').val(presentOrgn);
							   $('#InformationUserCurrentOrganization').trigger('change');
							   $('#InformationUserOtherParentOrganization').val(presentOtherOrgn);
							   $('#InformationUserNatureOfPresentEmp').val(empNature);
                               $('#InformationUserWorkingUnder').val(workUnder);
                               $('#InformationUserDOR').val(dor);
                               $('#InformationUserPresentPost').val(presentPost);
							   $('#InformationUserPresentScalePay').val(presentScale);
							   $('#InformationUserPresentGradePay').val(presentGrade);
							   $('#InformationUserStrtDtOfPay').val(datePay);
							   $('#InformationUserContRegAppointDate').val(contReg);
							   $('#InformationUserBelongToCi').val(belongToCi);
							   $('#InformationUserConsolidatedEmoluments').val(consolidatedEmoluments);
							   $('#InformationUserWorkingUnder').trigger('change');
							  
						}	
						
												
  $('#InformationUserPresentEmpType').change(function(){
                                                        resetAll();
													   });
														
													
														
    //resetAll();
   $('#InformationUserPresentEmpType').trigger('change');
   
   
   
   $('#reset1').click(function(){
                                 //alert("ji");   
                                 resetCall();
								});	
   
   $('#InformationUserNameOPOrgn').change(function(){
														parentOrgnName = $('#InformationUserNameOPOrgn option:selected').html();
														//alert(parentOrgnName);
														 if(parentOrgnName=='Others')
														  {
														   $('#parentorgn').removeClass('col-md-4');
														   $('#parentorgn').addClass('col-md-2');
														   $('#other-parent-orgn').show();
														   
														  }
														  else
														  {
														   $('#parentorgn').removeClass('col-md-2');
														   $('#parentorgn').addClass('col-md-4');
														   $('#other-parent-orgn').hide();
														   $('#InformationUserOtherParentOrganization').val('');
														  }
													 });
													 
	$('#InformationUserNameOPOrgn').trigger('change');
	
	$('#InformationUserCurrentOrganization').change(function(){
	                                                             currentOrgnName = $('#InformationUserCurrentOrganization option:selected').html();
													 
																 if(currentOrgnName==='Others')
																  {
																   $('#currentorgn').removeClass('col-md-4');
																   $('#currentorgn').addClass('col-md-2');
																   $('#other-current-orgn').show();
																  }
																  else
																  {
																   $('#currentorgn').removeClass('col-md-2');
																   $('#currentorgn').addClass('col-md-4');
																   $('#other-current-orgn').hide();
																   $('#InformationUserOtherCurrentOrganization').val('');
																  }
																 });
	                                                          											 
    
   $('#InformationUserCurrentOrganization').trigger('change');  
	
   $('#InformationUserDOIAppoint').datepicker({
                                              format:'dd-mm-yyyy',
											  todayHighlight :true
											});	
											
	$('#InformationUserDtAppointDate').datepicker({
                                              format:'dd-mm-yyyy',
											  todayHighlight :true
											});	
    
    $('#InformationUserDOR').datepicker({
                                              format:'dd-mm-yyyy',
											  todayHighlight :true
											});	

    $('#InformationUserStrtDtOfPay').datepicker({
                                              format:'dd-mm-yyyy',
											  todayHighlight :true
											});	

    $('#InformationUserContRegAppointDate').datepicker({
                                              format:'dd-mm-yyyy',
											  todayHighlight :true
											});		
    
    $('#InformationUserWorkingUnder').change(function(){
		                                                currentOrgnName = $('#InformationUserWorkingUnder option:selected').html(); 
                                                        if(currentOrgnName==='Private Organization')
														 {
														  $('#consolidated-emoluments').show();
														  $('#InformationUserPresentScalePay').val('');
														  $('#InformationUserPresentGradePay').val('');
														  $('#InformationUserStrtDtOfPay').val('');
														  $('#InformationUserContRegAppointDate').val('');
														  $('#InformationUserBelongToCi').val('');
														  
														  $('#present-scale-pay').hide();
														  $('#present-grade-pay').hide(); 
                                                          $('#strt-dt-of-pay').hide();
														  $('#cont-reg-appoint-date').hide();
														  $('#belong-to-ci').hide();
														  
														 }
                                                         else
														 {
														   $('#InformationUserConsolidatedEmoluments').val('');
														   $('#consolidated-emoluments').hide();	
                                                           $('#present-scale-pay').show();
														   $('#present-grade-pay').show(); 
                                                           $('#strt-dt-of-pay').show();
														   $('#cont-reg-appoint-date').show();
														   $('#belong-to-ci').show();
                                                           
															/* $('#InformationUserPresentScalePay').rules("add", {
																													required: function(element){
																																					presentEmpType = $('#InformationUserPresentEmpType').val();
																																					if(presentEmpType==='Deputation' || presentEmpType==='Deputation')
																																					return true;
																																				},
																													
																	
																												}); */
														   
  														   
														 }															 
	});
    
	//firstworkUnderExecution = true;
    if(workUnder=='Private Organization')
	{
	  $('#InformationUserWorkingUnder').trigger('change');	
	}		
   											
});		
</script> 