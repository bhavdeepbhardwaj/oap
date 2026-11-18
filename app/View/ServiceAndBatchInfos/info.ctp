<?php $timestamp = time();?>
<script type="text/javascript">
	$(function() {
		$('#WriteUp1').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_write_up_pdf',
		'auto'             : true,
        'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						}, 
		'onUploadComplete': function(file,data){
						
									if(data.search('uploaded_ok_')!=-1)
									{
										var filename= data.split('_');
										filename=filename[2];
										$('#ServiceAndBatchInfoWriteUp1').val(filename);
										$('#file-uploaded1').show();
									}
									else
									{
										$('.fileinfo').html(' - '+data);
										$('.uploadifive-queue-item').addClass('error');
									}
												
						},
		'dnd'          : true,
		'fileSizeLimit' : '4 MB',	
		'fileType':'application/pdf',
		
		'multi':false,
		'simUploadLimit' : 1,	
		'removeCompleted' : true,
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_write_up_pdf',
		'onAddQueueItem' : function(file){
											$('#file-uploaded1').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#WriteUp1').uploadifive('cancel', file);
												break;
											}
										}
		
     });
	});
	             //For Write Up 2
	$(function() {
		$('#WriteUp2').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_write_up_pdf',
		'auto'             : true,
        'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						}, 
		'onUploadComplete': function(file,data){
						
									if(data.search('uploaded_ok_')!=-1)
									{
										var filename= data.split('_');
										filename=filename[2];
										$('#ServiceAndBatchInfoWriteUp2').val(filename);
										$('#file-uploaded2').show();
									}
									else
									{
										$('.fileinfo').html(' - '+data);
										$('.uploadifive-queue-item').addClass('error');
									}
												
						},
		'dnd'          : true,
		'fileSizeLimit' : '4 MB',	
		'fileType':'application/pdf',
		
		'multi':false,
		'simUploadLimit' : 1,	
		'removeCompleted' : true,
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_write_up_pdf',
		'onAddQueueItem' : function(file){
											$('#file-uploaded2').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#WriteUp2').uploadifive('cancel', file);
												break;
											}
										}
		
     });
	});
 	      //For Asking user to upload Pdf's
    $(function(){
	             $('#ServiceAndBatchInfoUploadWriteUps').change(function(){
				                                                           wantToUpload = $('#ServiceAndBatchInfoUploadWriteUps').val();
				                                                           if(wantToUpload=='No' || wantToUpload =='')
																		    {
																			 $('#optional-row').hide();
																			}
																			if(wantToUpload=='Yes')
																			 {
																			  $('#optional-row').show();
																			 }
																		  })
	             });
	$(function(){
		         $('#datepicker').datepicker({
	                    format: 'dd-mm-yyyy'
                 });
				 
				 $('#writeUp1').simplyCountable({
					counter    :'#counter1',
                    countType  :'words',
                    maxCount   :300,
					strictMax  :true,
                    countDirection : 'down' 
				 });
				 
				 $('#writeUp2').simplyCountable({
					counter    :'#counter2',
                    countType  :'words',
                    maxCount   :300,
					strictMax  :true,
                    countDirection : 'down' 
				 });
				  
				$('#ServiceAndBatchInfoCadreId').change(function(){
					 cadreName = $('#ServiceAndBatchInfoCadreId option:selected').html();
					 if(cadreName=='Others')
					 {
					  $('#other-cadre-name').show();
					 }
                     else
					 {
					  $('#other-cadre-name').hide();
                      $('#ServiceAndBatchInfoOtherCadreName').val('');					  
					 } 						 
				});  
	            
				$('#ServiceAndBatchInfoCadreId').trigger('change');
				
			    $('#ServiceAndBatchInfoInfoForm').submit(function(event){
				            
							cadreName = $('#ServiceAndBatchInfoCadreId option:selected').html();
							if(cadreName=='Others')
								 {
								  $('#ServiceAndBatchInfoOtherCadreName').rules("add", {
																		required: true,
																		alphabetspace:true	
						
																	});	
								 }
							
							wantToUploadPdf = $('#ServiceAndBatchInfoUploadWriteUps').val();
							if(wantToUploadPdf=='Yes')
							{   
								var writeUp1Val = $('#ServiceAndBatchInfoWriteUp1').val();
								if(writeUp1Val=='')
								  {  	
							       $('#WriteUp1Error').show();
								   return false;
								  }
								else
								 { 
									$('#WriteUp1Error').hide();
									writeUp2Val = $('#ServiceAndBatchInfoWriteUp2').val();
									if(writeUp2Val=='')
									{
									 $('#WriteUp2Error').show();
								     return false;	
									}
                                    else
									{
									  $('#WriteUp2Error').hide();
								      return true;	
									} 										
									return false;
								 }
						    }
							if(wantToUploadPdf=='No')
							 {
								return true;
							 }
                            return false;							 
						});
			}
             			
	);			 
</script>
<div class="row">
    <div class="col-md-12">
	<?php echo $this->Session->flash(); ?>	
      <div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Service Details'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->				   
			<?php echo $this->Form->create('ServiceAndBatchInfo',array('role' => "form",'class'=>'jquery-validation')); ?>	
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('write_up_1', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('write_up_2', array('type' => 'hidden')); ?>
			<div class="box-body">
				
				<div class="row">
				                                  
					                       <!-- Service -->  
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('service_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Service</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('service_id', array('empty'=>'-- Select Service --','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'ServiceAndBatchInfoServiceId')))); ?>
						</div>
					</div>
					                        <!--Batch-->
					 <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('batch') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Batch</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('batch', array('type'=>'date','dateFormat'=>'Y','empty'=>'--Select Year--','maxYear'=>date('Y'),'minYear' => date('Y') - 60,'placeholder'=>'yyyy','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'ServiceAndBatchInfoBatchYear')))); ?>
						</div>
					 </div>
					 
					                        <!--Cadre-->
					 <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('cadre_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Cadre</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('cadre_id',array('empty'=>'Select Cadre','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'ServiceAndBatchInfoCadreId')))); ?>
						</div>
					 </div>
					
			    </div> 
				
				                           <!--Others Cadre-->
				<div class="row" style="display:none" id="other-cadre-name">
				     <div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('other_cadre_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Other Cadre Name</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('other_cadre_name',array('placeholder'=>'Enter Cadre Name','alphabetspace'=>true,'rangeLength'=>array(2,60),'maxlength'=>60,'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'ServiceAndBatchInfoOtherCadreName')))); ?>
						</div>
					 </div>
                </div>				
				
				<div class="row">
				                        <!--Belong To Which Service-->
					 <!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Belong To Which Service</label><span class="asterisk text-red">* </span>
							</div>
						 <?php //echo $this->Form->input('belong_to_service', array('placeholder'=>'Belong To Which Service','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					 </div-->
					 
					                      <!--Service Rendered-->
					 <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('doj_grp_a') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Date of Joining Group 'A' Services</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('doj_grp_a', array('type'=>'text','id'=>'datepicker','placeholder'=>'Date of Joining Group A Services','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'datepicker')))); ?>
						</div>
					 </div> 
				     
                                        <!--Service Rendered-->
					 <!--div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Total Service Rendered In Group A post</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php //echo $this->Form->input('srvc_rndr_grp_a', array('label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					 </div-->
					 
					             <!-- Experience in Port & Shipping Sectors -->  
					<div class="col-md-8">
						<div class="form-group <?php echo $this->Form->isFieldError('exp_prt_ship') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Experience in Port & Shipping Sectors</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('exp_prt_ship', array('type'=>'textarea','label'=>false,'class'=>'form-control','maxlength'=>400,'rangeLength'=>array(3,400),'escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'ServiceAndBatchInfoExpPrtShip')))); ?>
						</div>
					</div>
					 
					 
					 
				</div>
				
				<div class="row"">	  
					                 <!-- Statement -->  
					<!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">State Whether You Meet Requirements Of the Post</label><span class="asterisk">* </span><label>
							</div>
						 <?php //echo $this->Form->textarea('InformationUser.statement', array('label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div-->
			  </div>
            <div class="row">
                                <!-- Write Up 1 for Professional Experience-->
				   <div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('write_up1_data') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Write-up 1 ( Not exceeding 300 words)</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('write_up1_data', array('id'=>'writeUp1','type'=>'textarea','placeholder'=>'Write-up on the professional experience and Core-Competence of the officer in handling the assignment applied for.....','label'=>false,'class'=>'form-control','escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','rows'=>10,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'writeUp1')))); ?>
						  <div>
                            <label>Words Left :  </label><span class="text-red" id="counter1"> 10 </span>
						  </div>						 
						</div>
					</div>
					         <!-- Write Up 2-->
				   <div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('write_up2_data') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Write-up 2 ( Not exceeding 300 words)</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->JqueryValidation->input('write_up2_data', array('id'=>'writeUp2','type'=>'textarea','placeholder'=>'Write-up on how the applicant can full-fill and advance the mission and objectives of the organization that he seeks to join.....','label'=>false,'class'=>'form-control','escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','rows'=>10,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'writeUp2')))); ?>
						 <div>
                            <label>Words Left  :  </label><span class="text-red" id="counter2"> 300 </span>
						  </div>
						</div>
					</div>
			</div>	
			
			                <!--Asking for uploading Pdfs-->
			<div class="row">
			      <div class="col-md-4">
			          &nbsp;
			      </div> 
               <div class="col-md-4">
			           <script>
                                //To display back-end error message of other-qualification on front-end  						
									$(function(){
									OtherFieldError	=	<?php 
															if($this->Form->isFieldError('upload_write_ups'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									
									if(OtherFieldError)
									{
										$('#ServiceAndBatchInfoUploadWriteUps').trigger('change');	
									}
									});		
						</script>
						<div class="form-group <?php echo $this->Form->isFieldError('upload_write_ups') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Want to upload Pdf's for Write-ups</label><span class="asterisk text-red">*</span>
							</div>
						 <?php echo $this->JqueryValidation->input('upload_write_ups', array('empty'=>'-- Select --','options'=>array('No'=>'No','Yes'=>'Yes'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'ServiceAndBatchInfoUploadWriteUps')))); ?>
						</div>
				</div>
			</div>			
			
			
                                 <!--For Write-Ups Uploading-->
			<div class="row" id="optional-row" style="display:none">
			                  <!--For Write Up 1 Uploading-->
			  <div class="col-xs-6">
			     <div class="col-md-5">
						<div class="form-group">
							<div>
							  <label class="text-light-blue">Write Up 1</label><span class="text-red asterisk">*</span>
							</div>
						<input id="WriteUp1" type="file"  extension="pdf"/>
						<span class="text-red">(only pdf, allowed file size less than 4 Mb)</span>
						  <div id="WriteUp1Error" class="text-red" style="display:none"><center>Please Upload Write Up 1</center></div>
						    <?php if($this->Form->isFieldError('write_up_1')): ?>
							     <div id="WriteUp1Error" class="text-red" style="display:none"><center>Please Upload Write Up 1</center></div>
						    <?php endif; ?>
						</div>
				  </div>
					
				            <!--For Showing Success Of Uploading Pdf-->	
					<div class="col-md-7" style="display:none" id="file-uploaded1">
						   <br/>
						      <div class="pull-left alert alert-success">
						        <i class="fa fa-check"></i> Write up 1 Successfully Uploaded
						      </div>
					</div>
					
				</div>	
                                <!--For Write Up 2 Uploading-->
				<div class="col-md-6">				
					 <div class="col-md-5">
							<div class="form-group">
								<div>
								   <label class="text-light-blue">Write Up 2</label><span class="text-red asterisk">*</span>
								</div>
							<input id="WriteUp2" type="file"  extension="pdf"/>
							<span class="text-red">(only pdf, allowed file size less than 4 Mb)</span>
							<div id="WriteUp2Error" class="text-red" style="display:none"><center>Please Upload Write Up 2</center></div>
						    <?php if($this->Form->isFieldError('write_up_2')): ?>
							     <div id="WriteUp2Error" class="text-red" style="display:none"><center>Please Upload Write Up 2</center></div>
						    <?php endif; ?>
							</div>
					  </div>
					
								<!--For Showing Success Of Uploading Pdf-->	
						<div class="col-md-7" style="display:none" id="file-uploaded2">
							   <br/>
								  <div class="pull-left alert alert-success">
										 <i class="fa fa-check"></i> Write-up 2 Successfully Uploaded
								  </div>
						</div>					
				</div>		
			</div>		
			
			
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Save and Next</button>
				</div>
          			<?php echo $this->Form->end(); ?>
	        </div><!--Primary Box-->
	     </div><!--First Column-->
    </div>		 
</div>