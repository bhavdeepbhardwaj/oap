<?php $timestamp = time();?>
<script type="text/javascript">
$(function() {
		$('#EduCert').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_doc_pdf',
		'auto'             : true,
		'buttonText'    : 'Upload File...',
        'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						}, 
		'onUploadComplete': function(file,data){
						
									if(data.search('uploaded_ok_')!=-1)
									{
										var filename= data.split('_');
										filename=filename[2];
										$('#UserQualificationEduPdf').val(filename);
										$('#file-uploaded-edu').show();
									}
									else
									{
										$('.fileinfo').html(' - '+data);
										$('.uploadifive-queue-item').addClass('error');
									}
												
						},
		'dnd'          : true,
		'fileSizeLimit' : '10 MB',	
		'fileType':'application/pdf',
		
		'multi':false,
		'simUploadLimit' : 1,	
		'removeCompleted' : true,
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_doc_pdf',
		'onAddQueueItem' : function(file){
											$('#file-uploaded-edu').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#EduCert').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	
	$('#UserQualificationEditForm').submit(function(event){
				
							var EduDocument=$('#UserQualificationEduPdf').val();
							
							if(EduDocument=='')
							{
								$('#EduDocumentError').show();
								return false;
							}
							else
							{
								$('#EduDocumentError').hide();
								return true;
							}
							
							return false;
						});
	
	
	
	
	$('#UserQualificationEducationQualificationId').change(function(){
		                            qualification = $('#UserQualificationEducationQualificationId option:selected').html();
									
									if(qualification==='Others')
									{ 
									 $('#others-qualification').show();
									 $('#UserQualificationUniversityText').val('');
									 $('#UserQualificationUniversity').removeClass("col-md-6");
                                     $('#UserQualificationUniversity').addClass("col-md-12");
									 $('#UserQualificationOtherQualification').rules("add", {
																					required: function(element){
																													qualification = $('#UserQualificationOtherQualification').val();
																													if(qualification==='Others')
																													return true;
																												},
																					
																					alphabetspace:true	
																				});
									}
                                    else
                                    {
									 $('#UserQualificationOtherQualification').val('');
									 $('#UserQualificationOtherQualification').val('');
									 $('#others-qualification').hide();	
									 $('#UserQualificationUniversity').removeClass("col-md-12");
									 $('#UserQualificationUniversity').addClass("col-md-6");
									 $('#UserQualificationOtherQualification').remove("rules");
									}										
	});
	$('#UserQualificationEducationQualificationId').trigger('change');
	});
</script>
<div class="row">
    <div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Education Details'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
			<?php echo $this->Session->flash(); ?>					   
			<?php echo $this->Form->create('UserQualification',array('role' => "form",'class'=>'jquery-validation')); ?>
            <?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
            <?php echo $this->Form->input('edu_pdf',array('type'=>'hidden')); ?>			
			<div class="box-body">
				
				<div class="row">
				                                  
					                    <!--    <!-- Qualification Type -->  
					<!--div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Qualification Type</label><span class="asterisk">* </span><label>
							</div>
						 <?php //echo $this->Form->input('qualification_type', array('empty' => '--Select Type--','options'=>array('Regular'=>'Regular','Correspondence'=>'Correspondence','Diploma'=>'Diploma'),'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div> -->
					
					                     <!-- Select Qualification -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('education_qualification_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Qualification</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('education_qualification_id', array('empty' => '--Select Qualification--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationEducationQualificationId')))); ?>
						</div>
					</div>
					
					<div class="col-md-6" style="display:none" id="others-qualification">
					  <script>
                                //To display back-end error message of other-qualification on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('other_qualification'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									
									if(OtherFieldError)
									{
										$('#UserQualificationEducationQualificationId').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('other_qualification') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Others</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('other_qualification', array('placeholder'=>'Other Qualification','alphabetspace'=>true,'maxlength'=>200,'rangeLength'=>array(3,200),'label'=>false,'class'=>'form-control','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationOtherQualification')))); ?>
						</div>
					</div>
					
				                  <!--University-->
						 <div class="col-md-6" id="UserQualificationUniversity">
						     <div class="form-group <?php echo $this->Form->isFieldError('university') ? 'has-error' : '' ?>">
							    <div>
								   <label class="text-light-blue">University</label><span class="asterisk text-red">*</span><label>
							    </div>
						      <?php echo $this->JqueryValidation->input('university', array('id'=>'UserQualificationUniverityText','label'=>false,'placeholder'=>'Enter University Name','class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationUniversityText')))); ?>
						     </div>
					     </div>
						 
				   </div>
				   
				   <div class="row">
				   
				                     <!--Year Of Passing-->
						 <div class="col-md-6">
						     <div class="form-group <?php echo $this->Form->isFieldError('y_o_p') ? 'has-error' : '' ?>">
							    <div>
								   <label class="text-light-blue">Year of Passing</label><span class="asterisk text-red">* </span><label>
							    </div>
						      <?php echo $this->JqueryValidation->input('y_o_p', array('type'=>'date','dateFormat'=>'Y','minYear'=>1960,'maxYear'=>date('Y'),'empty' => '--Select Year--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationYOPYear')))); ?>
						     </div>
					     </div>
						 
						            <!-- Select Class -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('class_type') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Class</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('class_type', array('empty' => '--Select Class--','options'=>array('Distinction'=>'Distinction','First Class'=>'First Class','Second Class'=>'Second Class','Third Class'=>'Third Class'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationClassType')))); ?>
						</div>
					</div>
					   
					             <!-- Percentage Obtained -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('perc_obtained') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">% Obtained</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('perc_obtained', array('type'=>'text','placeholder' => '% Percentage','label'=>false,'digits'=>true,'maxlength'=>5,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationPercObtained')))); ?>
						</div>
					</div>
					
					                  <!--Special Subject-->					          
				  <div class="col-md-6">
					   <div class="form-group <?php echo $this->Form->isFieldError('special_subject') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Special Subject</label><span class="asterisk text-red">* </span><label>
							</div>
								 <?php echo $this->JqueryValidation->input('special_subject', array('placeholder' => 'Subject','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserQualificationSpecialSubject')))); ?>
					   </div>
				   </div>
						 
						 
				   </div>
				   
			           <div class="row">
                                          <!--For Educational Document-->
					   <div class="col-md-6">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">Educational Certificate</label><span class="asterisk text-red">* </span><label>
									</div>
								<input id="EduCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, not more than 10 Mb)</span>
						       <div id="EduDocumentError" class="text-red" style="display:none"><center>Please Upload Educational Document</center></div>
									<?php if($this->Form->isFieldError('edu_pdf')): ?>
									<div id="EduDocumentError" class="text-red" style="display:none"><center>Please Upload Educational Document</center></div>
									<?php endif; ?>
						   </div>
					   </div>
					   
					       <!--For Showing Success Of Uploading File-->	
						<div class="col-md-6" style="display:none" id="file-uploaded-edu">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded educational certificate.
						      </div>
					    </div>	
						
						<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue"><label>
							</div>						
					    <center><?php echo $this->Html->link(' Click Here to View Already Uploaded Certificate','/user_qualifications/dwn_self_quali_doc/'.$education,array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?></center>
						</div>
				</div>
					   
			    </div> 						   
		   </div>	 
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Edit Qualification</button>
				</div>
          			<?php echo $this->Form->end(); ?>
				<!-- <div class="box-footer text-center"> -->
				<!-- <center><button type="submit" class="btn btn-primary">Skip to next Step</button></center> -->
				<!-- </div> -->
	        </div><!--Primary Box-->
	     </div><!--First Column-->	
               
                  <!--Help Menu-->
		<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-fw fa-question-circle"></i>
				<h3 class="box-title">Help</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<blockquote>
					<p>Qualification </p>
					<small>Here you have to select your qualification.</small>
				</blockquote>
				<blockquote>
					<p>University</p>
					<small>Enter the name of your University.</small>
				</blockquote>
				<blockquote>
					<p>Class</p>
					<small>Distinction : Percentage Equal to or Above 75%</small>
					<small>First Class : Percentage Equal to or Above 60%</small>
					<small>Second Class: Percentage Equal to or Above 45%</small>
					<small>Third Class : Percentage Equal to or Greater than 33% and Less than 45% </small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>		  
		 
	</div><!--First Row-->	 