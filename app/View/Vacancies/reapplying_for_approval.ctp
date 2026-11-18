<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Vacancy'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('Vacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden'));  ?>
			<div class="box-body">
			
			<div class = "row">
			                       <!--Select Organization-->
			         <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Organization</label><span class="asterisk text-red">* </span>
							</div>
							<?php if($userOrgnType=='MOS')
                              {							
						       echo $this->JqueryValidation->input('organization_id', array('empty'=>'--Select Organization--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyOrganizationId')))); 
							  }
							  else
							  {
							   echo $this->JqueryValidation->input('organization_id', array('value'=>$userOrgn,'label'=>false,'class'=>'form-control','required'=>true,'disabled'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyOrganizationId'))));   
							  }
							?>
						</div>
					</div>
                                 
                                         <!--Select Department-->
							<div class="col-md-4">
								<div class="form-group <?php echo $this->Form->isFieldError('department_id') ? 'has-error' : '' ?>">
									<div>
										<label class="text-light-blue">Department's Name</label>
									</div>
									<?php echo $this->JqueryValidation->input('department_id', array('empty'=>'--Select Department--','label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyDepartmentId')))); ?>
								</div>
							</div>								 
			                            <!--Select Notice-->
			        <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('notice_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Vacancy Circular</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('notice', array('value'=>$notices,'label'=>false,'class'=>'form-control','required'=>true,'disabled'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyNoticeId')))); ?>
						</div>
					</div>
			</div>   
			 
			     
               <div class="row">
				            <!--Select Post-->
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('post_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Post's Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('post_id', array('empty'=>'--Select Post--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyPostId')))); ?>
						</div>
					</div>     
                                <!--Classification-->
					<div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('classification') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Classification</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('classification', array('placeholder'=>'Enter Classification','label'=>false,'class'=>'form-control','alphanumeric'=>true,'maxlength'=>10,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyClassification')))); ?>
						</div>
					</div>     
					            <!--Method Of Recruitment-->
					<div class="col-md-4" id="recruit-method">
						<div class="form-group <?php echo $this->Form->isFieldError('recruitment_method') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Method of Recruitment</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('recruitment_method', array('empty'=>'--Select Method--','options'=>array('All India Services'=>'All India Services(AIS)','Ports'=>'Ports','Both(AIS & Ports)'=>'Both(AIS & Ports)','AIS & CCS Group A Services'=>'AIS & CCS Group A Services','Composite'=>'Composite','Deputation'=>'Deputation','Direct'=>'Direct'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyRecruitmentMethod')))); ?>
						</div>
					</div>     
					
					               <!--Minimum Age Require -->
					   <div class="col-md-2"  style="display:none" id="age-limit">
						
						<script>
                                //To display back-end error message of age-limit on front-end  						
									$(function(){
									OtherFieldAgeLimit	=	<?php 
															if($this->Form->isFieldError('age_limit'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldAgeLimit)
									{
										$('#VacancyRecruitmentMethod').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('age_limit') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Minimum Age Required</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->JqueryValidation->input('age_limit', array('type'=>'text','placeholder'=>'Enter Minimum Age','label'=>false,'maxlength'=>2,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyAgeLimit')))); ?>
						</div>
					</div>
					
					               <!--Deputation Period -->
					   <div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('probation_period') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Deputation Period</label>
							</div>
							<?php echo $this->JqueryValidation->input('probation_period', array('type'=>'text','maxlength'=>2,'digits'=>true,'placeholder'=>'Enter Period','label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyProbationPeriod')))); ?>
						</div>
					   </div>
					
					               <!--Select Pay Scale -->
					   <div class="col-md-2">
						<div class="form-group <?php echo $this->Form->isFieldError('pay_scale_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Pay Scale</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('pay_scale_id', array('empty'=>'--Select Pay Scale--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyPayScaleId')))); ?>
						</div>
					  </div>
					   
                    </div>

              <div class="row">
                                         <!--Educational Qualification -->
					   <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('EducationQualification.EducationQualification') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Minimum Educational Qualifications</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('EducationQualification.EducationQualification', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'EducationQualificationEducationQualification')))); ?>
						</div>
					   </div>
					   
					                     <!--Experience Details -->
					   <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('exp_details') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Experience Details</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->JqueryValidation->input('exp_details',array('placeholder'=>'Enter Experience Details','label'=>false,'type'=>'textArea','class'=>'form-control','escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','rangelength'=>array(2,2000),'maxlength'=>2000,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyExpDetails')))); ?>
						</div>
					   </div>
					   
					                        <!--Other Details -->
					   <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('other_details') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Other Details</label>
							</div>
							<?php echo $this->JqueryValidation->input('other_details', array('placeholder'=>'Enter Other Details','label'=>false,'type'=>'textArea','rangeLength'=>array(3,255),'maxlength'=>255,'escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','rangelength'=>array(2,2000),'maxlength'=>2000,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyOtherDetails')))); ?>
						</div>
					   </div>
					   
			    </div>
                <div class="row">
                                   <!--For Essential-->
						<div class="col-md-6">
							<div class="form-group <?php echo $this->Form->isFieldError('Essential.Essential') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Select Essentials</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('Essential.Essential', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'EssentialEssential')))); ?>
							</div>
					   </div>
                                               <!--For Desirable-->
						<div class="col-md-6">
							<div class="form-group <?php echo $this->Form->isFieldError('Desirable.Desirable') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Select Desirables</label>
								</div>
								<?php echo $this->JqueryValidation->input('Desirable.Desirable', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DesirableDesirable')))); ?>
							</div>
					   </div>				   
				</div>				
		        	
				<div class="row">	
					                     <!--Minimum Experience Required -->
					   <div class="col-md-4">
							<div class="form-group <?php echo $this->Form->isFieldError('exp_require') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Minimum Experience Required for the post</label>
								</div>
								<?php echo $this->JqueryValidation->input('exp_require', array('type'=>'text','placeholder'=>'Enter Experience Require in years','label'=>false,'digits'=>true,'maxlength'=>2,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyExpRequire')))); ?>
							 </div>
					   </div>
					                      <!--Want posts category wise-->
					   <div class="col-md-4">
					   <script>
					       //To display back-end error message of no. of posts on front-end
				        $(function(){
								OtherFieldNumOfPost   =<?php 
														if($this->Form->isFieldError('no_of_posts'))
															echo 'true'; 
														else 
															echo 'false'; 
													?>;
								//alert(OtherFieldNumOfPost);					
								if(OtherFieldNumOfPost)
								{  
									$('#VacancyPostCategoryWise').trigger('change');
									//alert('Hi');
									//$('#num-posts').show();	
								}
								
								//To display back-end error message of unreserved posts on front-end
								
								   OtherFieldUR  = <?php 
														if($this->Form->isFieldError('ur_vacancy_count'))
															echo 'true'; 
														else 
															echo 'false'; 
													?>;
								if(OtherFieldUR)
								{
								   $('#VacancyPostCategoryWise').trigger('change');
									//$('#optional-row').show();	
								}
								
								//To display back-end error message of sc posts on front-end
								
								   OtherFieldSc  = <?php 
														if($this->Form->isFieldError('sc_vacancy_count'))
															echo 'true'; 
														else 
															echo 'false'; 
													?>;
								if(OtherFieldSc)
								{
								    $('#VacancyPostCategoryWise').trigger('change');
									//$('#optional-row').show();	
								}
								
								//To display back-end error message of st posts on front-end
								
								   OtherFieldSt  = <?php 
														if($this->Form->isFieldError('st_vacancy_count'))
															echo 'true'; 
														else 
															echo 'false'; 
													?>;
								if(OtherFieldSt)
								{
								    $('#VacancyPostCategoryWise').trigger('change');
									//$('#optional-row').show();	
								}
								
								//To display back-end error message of obc posts on front-end
								
								   OtherFieldObc  = <?php 
														if($this->Form->isFieldError('obc_vacancy_count'))
															echo 'true'; 
														else 
															echo 'false'; 
													?>;
								if(OtherFieldObc)
								{
								    $('#VacancyPostCategoryWise').trigger('change');
									//$('#optional-row').show();	
								}
								
								//To display back-end error message of others posts on front-end
								
								   OtherFieldOthers  = <?php 
														if($this->Form->isFieldError('others_vacancy_count'))
															echo 'true'; 
														else 
															echo 'false'; 
													?>;
								if(OtherFieldOthers)
								{
									$('#VacancyPostCategoryWise').trigger('change');
									//$('#optional-row').show();	
								}
							});	
					   </script>
							<div class="form-group <?php echo $this->Form->isFieldError('post_category_wise') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Want to add Number of Posts Category Wise ?</label><span class="asterisk text-red"> *</span>
								</div>
								<?php echo $this->JqueryValidation->input('post_category_wise', array('empty'=>'-- Select --','options'=>array('Yes'=>'Yes','No'=>'No'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyPostCategoryWise')))); ?>
							 </div>
					   </div>
					                      <!--Not Category Wise -->
					   <div class="col-md-4" style="display:none" id="num-posts" >
							<div class="form-group <?php echo $this->Form->isFieldError('no_of_posts') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Enter Number of Posts</label><span class="asterisk text-red">*</span>
								</div>
								<?php echo $this->JqueryValidation->input('no_of_posts', array('type'=>'text','placeholder'=>'Enter Number of Posts....','maxlength'=>3,'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyNoOfPosts')))); ?>
							 </div>
					   </div>
				</div>
                                <!--For Entering No. of Posts Category Wise-->				
            <div class="row" style="display:none" id="optional-row" >   
				<div class="col-md-12">
						
						    <div class="col-md-4">
						           <div class="form-group">
							           <div>
								           &nbsp;
							            </div>   
						           </div>
					        </div>	
								
			                  <div class="col-md-4">
						           <div class="form-group">
							           <div>
								      <label class="text-light-blue">Enter Number of Posts Category Wise</label><span class="asterisk text-red"></span>
							            </div>   
						           </div>
					            </div>	
				</div>
				
				
                <div class="col-md-12">
					          
						    <div class="col-md-3">
						           <div class="form-group">
							           <div>
								           &nbsp;
							            </div>   
						           </div>
					        </div>


              							  <!--For Un Reserved-->
					      <div class="col-md-1">
                                <div class="form-group <?php echo $this->Form->isFieldError('ur_vacancy_count') ? 'has-error' : '' ?>">
							       <div>
								 <center><label class="text-light-blue">UR</label></center>
							       </div>
							        <?php echo $this->JqueryValidation->input('ur_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control','maxlength'=>3,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyUrVacancyCount')))); ?>
						        </div>
                            </div>		

							                     <!--For SC-->
												 
                            <div class="col-md-1">
                                <div class="form-group <?php echo $this->Form->isFieldError('sc_vacancy_count') ? 'has-error' : '' ?>">
							       <div>
								<center><label class="text-light-blue">SC</label></center>
							       </div>
							        <?php echo $this->JqueryValidation->input('sc_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control','maxlength'=>3,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyScVacancyCount')))); ?>
						        </div>
                            </div>		
							
                                                 <!--For ST-->
												 
                            <div class="col-md-1">
                                <div class="form-group <?php echo $this->Form->isFieldError('st_vacancy_count') ? 'has-error' : '' ?>">
							       <div>
								   <center><label class="text-light-blue">ST</label></center>
							       </div>
							        <?php echo $this->JqueryValidation->input('st_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control','maxlength'=>3,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyStVacancyCount')))); ?>
						        </div>
                            </div>									
							
							                <!--For OBC-->
												 
                            <div class="col-md-1">
                                <div class="form-group <?php echo $this->Form->isFieldError('obc_vacancy_count') ? 'has-error' : '' ?>">
							       <div>
								   <center><label class="text-light-blue">OBC</label></center>
							       </div>
							        <?php echo $this->JqueryValidation->input('obc_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control','maxlength'=>3,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyObcVacancyCount')))); ?>
						        </div>
                            </div>		
							
							                 <!--For Others-->
												 
                            <div class="col-md-1">
                                <div class="form-group <?php echo $this->Form->isFieldError('others_vacancy_count') ? 'has-error' : '' ?>">
							       <div>
							      <center><label class="text-light-blue">Others</label></center>
							       </div>
							        <?php echo $this->JqueryValidation->input('others_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control','maxlength'=>3,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyOthersVacancyCount')))); ?>
						        </div>
                            </div>		
							
					</div>	
              </div><!--For Optional Row-->						
         
                 <div class="row">
				       <div class="col-md-4">
					      <div class="form-group">
						      &nbsp;
						  </div>   
			           </div>
					                        <!--Application will Be Active Upto-->
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('active_upto') ? 'has-error' : '' ?>">
							<div>
					   <center><label class="text-light-blue">Application will Remain Active upto</label></center>
							</div>
							   <div class="input-group">
								         <div class="input-group-addon">
									            <i class="fa fa-calendar"></i>
								         </div>
							         <?php echo $this->JqueryValidation->input('active_upto', array('id'=>'datepicker','type'=>'text','placeholder'=>'dd-mm-yyyy','label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'datepicker')))); ?>
						       </div>
						</div>
					</div>   
					   
               </div> 				 
		</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Reapplying For Approval</button>
				<a href="<?php echo $this->request->here?>"><button type="button" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button></a>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>

<script>
 $(function(){
 
 
         $('#VacancyPostCategoryWise').change(function(){
		                        
								              option = $(this).val();
											  if(option=='')
											    {
												  $('#num-posts').hide();
												  $('#optional-row').hide();
												  $('#VacancyNoOfPosts').val('');
												  $('#VacancyUrVacancyCount').val('');
												  $('#VacancyScVacancyCount').val('');
												  $('#VacancyStVacancyCount').val('');
												  $('#VacancyObcVacancyCount').val('');
												  $('#VacancyOthersVacancyCount').val('');
												  $('#VacancyUrVacancyCount').rules("remove");
												  $('#VacancyScVacancyCount').rules("remove");
												  $('#VacancyStVacancyCount').rules("remove");
												  $('#VacancyObcVacancyCount').rules("remove");
												  $('#VacancyOthersVacancyCount').rules("remove");
												}
											   if(option=='No')
                                                 {
												 
												  $('#num-posts').show();
												$('#VacancyNoOfPosts').rules("add", {
																						required: function(element){
																														postCategoryWise = $('#VacancyPostCategoryWise').val();
																														if(postCategoryWise==='No')
																														return true;
																														else
																														return false;
																													},
																						maxlength: 3,
																						digits:true	
																				});
												$('#optional-row').hide();
												  $('#VacancyUrVacancyCount').val('');
												  $('#VacancyScVacancyCount').val('');
												  $('#VacancyStVacancyCount').val('');
												  $('#VacancyObcVacancyCount').val('');
												  $('#VacancyOthersVacancyCount').val('');
													$('#VacancyUrVacancyCount').rules("remove");
												  $('#VacancyScVacancyCount').rules("remove");
												  $('#VacancyStVacancyCount').rules("remove");
												  $('#VacancyObcVacancyCount').rules("remove");
												  $('#VacancyOthersVacancyCount').rules("remove");
												 }
                                                if(option=='Yes')
                                                 {
                                                  $('#num-posts').hide();
												  $('#VacancyNoOfPosts').rules("remove");
												  $('#optional-row').show();
												  $('#VacancyUrVacancyCount').rules("add", {
																					required: function(element){
																													postCategoryWise = $('#VacancyPostCategoryWise').val();
																													if(postCategoryWise==='Yes')
																													return true;
																												},
																					maxlength: 3,
																					digits:true	
																				});
												   $('#VacancyScVacancyCount').rules("add", {
																					required: function(element){
																													postCategoryWise = $('#VacancyPostCategoryWise').val();
																													if(postCategoryWise==='Yes')
																													return true;
																												},
																					maxlength: 3,
																					digits:true	
																				});
													$('#VacancyStVacancyCount').rules("add", {
																					required: function(element){
																													postCategoryWise = $('#VacancyPostCategoryWise').val();
																													if(postCategoryWise==='Yes')
																													return true;
																												},
																					maxlength: 3,
																					digits:true	
																				});
													$('#VacancyObcVacancyCount').rules("add", {
																					required: function(element){
																													postCategoryWise = $('#VacancyPostCategoryWise').val();
																													if(postCategoryWise==='Yes')
																													return true;
																												},
																					maxlength: 3,
																					digits:true	
																				});
													$('#VacancyOthersVacancyCount').rules("add", {
																					required: function(element){
																													postCategoryWise = $('#VacancyPostCategoryWise').val();
																													if(postCategoryWise==='Yes')
																													return true;
																												},
																					maxlength: 3,
																					digits:true	
																				});							
                                                  $('#VacancyNoOfPosts').val('');												  
												 }												
												
		                                     }
								  );
	 
	          $('#VacancyPostCategoryWise').trigger('change');	
			  $('#VacancyRecruitmentMethod').change(function(){
		                                       recruitMethod = $(this).val();
											   if(recruitMethod=='Direct')
											    {
												 $('#recruit-method').removeClass("col-md-4");
												 $('#recruit-method').addClass("col-md-2");
												 $('#age-limit').show();
												 $('#VacancyAgeLimit').rules("add", {
																					required: function(element){
																													recruitMethod = $('#recruit-method').val();
																													if(recruitMethod==='Direct')
																													return true;
																												},
																					maxlength: 2,
																					digits:true	
																				});
												}
												else
												{
												 $('#recruit-method').removeClass("col-md-2");
												 $('#recruit-method').addClass("col-md-4");
												 $('#VacancyAgeLimit').rules("remove");
												 $('#VacancyAgeLimit').val('');
												 $('#age-limit').hide();
												}
											 });
			  $('#VacancyRecruitmentMethod').trigger('change');							 
              $('#datepicker').datepicker({
	                    format: 'dd-mm-yyyy',
						todayHighlight : true
                 });			  
      
 
 
 })
</script>