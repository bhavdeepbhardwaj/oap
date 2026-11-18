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
												}
											   if(option=='No')
                                                 {
												  $('#num-posts').show();
												  $('#optional-row').hide();
												  $('#VacancyUrVacancyCount').val('');
												  $('#VacancyScVacancyCount').val('');
												  $('#VacancyStVacancyCount').val('');
												  $('#VacancyObcVacancyCount').val('');
												  $('#VacancyOthersVacancyCount').val('');
												 }
                                                if(option=='Yes')
                                                 {
                                                  $('#num-posts').hide();
												  $('#optional-row').show();
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
												}
												else
												{
												 $('#recruit-method').removeClass("col-md-2");
												 $('#recruit-method').addClass("col-md-4");
												 $('#age-limit').hide();
												}
											 });
			  $('#VacancyRecruitmentMethod').trigger('change');
              $('#VacancyActiveUpto').datepicker({
	                    format: 'dd-mm-yyyy',
						todayHighlight : true
                 });			  
			  	 
      
 
 
 })
</script>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Reapplying Cancelled Vacancy For Approval'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('Vacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden'));  ?>
			<div class="box-body">
			<div class = "row">
			                       <!--Select Organization-->
			         <div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Organization</label><span class="asterisk text-red">* </span>
							</div>
							<?php if($userOrgnType=='MOS')
                              {							
						       echo $this->Form->input('organization_id', array('empty'=>'--Select Organization--','label'=>false,'class'=>'form-control','required'=>true)); 
							  }
							  else
							  {
							   echo $this->Form->input('organization_id', array('value'=>$userOrgn,'label'=>false,'class'=>'form-control','required'=>true,'disabled'=>true));   
							  }
							?>
						</div>
					</div>
                                 
                                         <!--Select Department-->
							<div class="col-md-4">
								<div class="form-group">
									<div>
										<label class="text-light-blue">Department Name</label>
									</div>
									<?php echo $this->Form->input('department_id', array('empty'=>'--Select Department--','label'=>false,'class'=>'form-control')); ?>
								</div>
							</div>								 
			                            <!--Select Notice-->
			        <div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Vacancy</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('notice', array('value'=>$notices,'label'=>false,'class'=>'form-control','required'=>true,'disabled'=>true)); ?>
						</div>
					</div>
			</div>   
			 
			     
               <div class="row">
				            <!--Select Post-->
					<div class="col-md-2">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Post Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('post_id', array('empty'=>'--Select Post--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>     
                                <!--Classification-->
					<div class="col-md-2">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Classification</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('classification', array('placeholder'=>'Enter Classification','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>     
					            <!--Method Of Recruitment-->
					<div class="col-md-4" id="recruit-method">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Method Of Recruitment</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('recruitment_method', array('empty'=>'--Select Method--','options'=>array('All India Services'=>'All India Services(AIS)','Ports'=>'Ports','Both(AIS & Ports)'=>'Both(AIS & Ports)','Composite'=>'Composite','Deputation'=>'Deputation','Direct'=>'Direct'),'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>     
					
					               <!--Minimum Age Require -->
					   <div class="col-md-2" style="display:none" id="age-limit">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Minimum Age Required</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('age_limit', array('type'=>'text','placeholder'=>'Enter Minimum Age','digits'=>true,'maxlength'=>2,'digits'=>true,'label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					
					               <!--Probation Period -->
					   <div class="col-md-2">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Deputation Period</label>
							</div>
							<?php echo $this->Form->input('probation_period', array('type'=>'text','maxlength'=>2,'digits'=>true,'placeholder'=>'Enter Probation','label'=>false,'class'=>'form-control')); ?>
						</div>
					   </div>
					
					               <!--Select Pay Scale -->
					   <div class="col-md-2">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Pay Scale</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('pay_scale_id', array('empty'=>'--Select Pay Scale--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					  </div>
					   
                    </div>

              <div class="row">
                                         <!--Educational Qualification -->
					   <div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Minimum Educational Qualifications</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('EducationQualification.EducationQualification', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					   </div>
					   
					                     <!--Experience Details -->
					   <div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Experience Details</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->textArea('exp_details', array('placeholder'=>'Enter Experience Details','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					   </div>
					   
					                        <!--Other Details -->
					   <div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Other Details</label>
							</div>
							<?php echo $this->Form->textArea('other_details', array('placeholder'=>'Enter Other Details','label'=>false,'class'=>'form-control')); ?>
						</div>
					   </div>
					   
			    </div>
                <div class="row">
                                   <!--For Essential-->
						<div class="col-md-6">
							<div class="form-group">
								<div>
									<label class="text-light-blue">Select Essentials</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->Form->input('Essential.Essential', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>'form-control','required'=>true)); ?>
							</div>
					   </div>
                                               <!--For Desirable-->
						<div class="col-md-6">
							<div class="form-group">
								<div>
									<label class="text-light-blue">Select Desirables</label>
								</div>
								<?php echo $this->Form->input('Desirable.Desirable', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>'form-control')); ?>
							</div>
					   </div>					   
				</div>					
		        	
				<div class="row">	
					                     <!--Minimum Experience Required -->
					   <div class="col-md-4">
							<div class="form-group">
								<div>
									<label class="text-light-blue">Minimum Experience Required</label>
								</div>
								<?php echo $this->Form->input('exp_require', array('type'=>'text','placeholder'=>'Enter Experience Require in years','label'=>false,'digits'=>true,'maxlength'=>2,'class'=>'form-control')); ?>
							 </div>
					   </div>
					                      <!--Want posts category wise-->
					   <div class="col-md-4">
							<div class="form-group">
								<div>
									<label class="text-light-blue">Want to add Number of Posts Category Wise ?</label><span class="asterisk text-red"> *</span>
								</div>
								<?php echo $this->Form->input('post_category_wise', array('empty'=>'-- Select --','options'=>array('Yes'=>'Yes','No'=>'No'),'label'=>false,'class'=>'form-control','required'=>true)); ?>
							 </div>
					   </div>
					                      <!--Not Category Wise-->
					   <div class="col-md-4" id="num-posts" style="display:none">
							<div class="form-group">
								<div>
									<label class="text-light-blue">Enter Number of Posts</label><span class="asterisk text-red"> *</span>
								</div>
								<?php echo $this->Form->input('no_of_posts', array('type'=>'text','placeholder'=>'Enter Number of Posts....','label'=>false,'class'=>'form-control','digits'=>'true')); ?>
							 </div>
					   </div>
				</div>
                                <!--For Entering No. of Posts Category Wise-->				
            <div class="row" id="optional-row" style="display:none">   
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
								      <label class="text-light-blue">Enter Number of Posts Category Wise</label><span class="asterisk"></span>
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
                                <div class="form-group">
							       <div>
								 <center><label class="text-light-blue">UR</label></center>
							       </div>
							        <?php echo $this->Form->input('ur_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
						        </div>
                            </div>		

							                     <!--For SC-->
												 
                            <div class="col-md-1">
                                <div class="form-group">
							       <div>
								<center><label class="text-light-blue">SC</label></center>
							       </div>
							        <?php echo $this->Form->input('sc_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
						        </div>
                            </div>		
							
                                                 <!--For ST-->
												 
                            <div class="col-md-1">
                                <div class="form-group">
							       <div>
								   <center><label class="text-light-blue">ST</label></center>
							       </div>
							        <?php echo $this->Form->input('st_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
						        </div>
                            </div>									
							
							                <!--For OBC-->
												 
                            <div class="col-md-1">
                                <div class="form-group">
							       <div>
								   <center><label class="text-light-blue">OBC</label></center>
							       </div>
							        <?php echo $this->Form->input('obc_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
						        </div>
                            </div>		
							
							                 <!--For Others-->
												 
                            <div class="col-md-1">
                                <div class="form-group">
							       <div>
							      <center><label class="text-light-blue">Others</label></center>
							       </div>
							        <?php echo $this->Form->input('others_vacancy_count', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
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
						<div class="form-group">
							<div>
					   <center><label class="text-light-blue">Application will Remain Active upto</label></center>
							</div>
							   <div class="input-group">
								         <div class="input-group-addon">
									            <i class="fa fa-calendar"></i>
								         </div>
							         <?php echo $this->Form->input('active_upto', array('type'=>'text','placeholder'=>'dd-mm-yyyy','label'=>false,'class'=>'form-control')); ?>
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