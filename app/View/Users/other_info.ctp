<?php //pr($user); ?>
<?php $timestamp = time();?>
    <script type="text/javascript">
	
                       // Vigilance Certificates
	// $(function() {
		// $('#VigilanceCert').uploadifive({
        // 'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_doc_pdf',
		// 'auto'             : true,
		// 'buttonText'    : 'Upload File...',
        // 'formData'     : {
							// 'timestamp' : '<?php echo $timestamp;?>',
							// 'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						// }, 
		// 'onUploadComplete': function(file,data){
						
									// if(data.search('uploaded_ok_')!=-1)
									// {
										// var filename= data.split('_');
										// filename=filename[2];
										// $('#InformationUserVigilancePdf').val(filename);
										// $('#file-uploaded-vigilance').show();
									// }
									// else
									// {
										// $('.fileinfo').html(' - '+data);
										// $('.uploadifive-queue-item').addClass('error');
									// }
												
						// },
		// 'dnd'          : true,
		// 'fileSizeLimit' : '10 MB',	
		// 'fileType':'application/pdf',
		
		// 'multi':false,
		// 'simUploadLimit' : 1,	
		// 'removeCompleted' : true,
		
		// 'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_doc_pdf',
		// 'onAddQueueItem' : function(file){
											// $('#file-uploaded-vigilance').hide();
											// var fileName = file.name;
											// var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											// switch (ext) 
											// {
												// case 'pdf':
												
												// break;
												// default:
												// alert('Error - File type not Suppoerted (Supported file type: pdf )');
												// $('#VigilanceCert').uploadifive('cancel', file);
												// break;
											// }
										// }
		
    // });
	// });	
	
	                                 // Caste Certificates
	$(function() {
		$('#CasteCert').uploadifive({
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
										$('#InformationUserCastePdf').val(filename);
										$('#file-uploaded-caste').show();
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
											$('#file-uploaded-caste').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#CasteCert').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	<?php if($user['InformationUser']['community']!='General')
		  {
		?>
	$('#InformationUserOtherInfoForm').submit(function(event){
				
							var CasteDocument=$('#InformationUserCastePdf').val();
							
							if(CasteDocument=='')
							{
								$('#CasteCertError').show();
								return false;
							}
							else
							{
								$('#CasteCertError').hide();
								return true;
							}
							
							return false;
						});
	<?php
		  }
		 ?> 
	});	
</script>
<div class="row">
   <div class="col-md-12">
   <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Other Information'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
								   
			<?php echo $this->Form->create('InformationUser',array('role' => "form",'class' => 'jquery-validation')); ?>	
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php //echo $this->Form->input('vigilance_pdf',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('caste_pdf',array('type'=>'hidden')); ?>
			
			<div class="box-body">
				      <div class="row">
				                                  
					                       <!-- Statement-->  
							<div class="col-md-6">
								<div class="form-group <?php echo $this->Form->isFieldError('statement') ? 'has-error' : '' ?>">
									<div>
										<label class="text-light-blue">Declaration</label><span class="asterisk text-red">* </span>
									</div>
								 <?php echo $this->JqueryValidation->input('statement',array('placeholder'=>'Please State clearly whether in your light of entries made by you, you meet the requirements of the post','label'=>false,'rows'=>4,'class'=>'form-control','escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s-,.]+$','maxlength'=>255,'rangeLength'=>array(3,255),'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserStatement')))); ?>
								</div>
							</div>
                                           <!--Additional Information-->							
				            <div class="col-md-6">
								<div class="form-group <?php echo $this->Form->isFieldError('additional_info') ? 'has-error' : '' ?>">
									<div>
										<label class="text-light-blue">Additional Information</label>
									</div>
								 <?php echo $this->JqueryValidation->input('additional_info', array('placeholder'=>'Additional Information, if any, which you would like to mention in support of your suitability for the post','label'=>false,'rows'=>4,'class'=>'form-control','escape'=>true,'pattern'=>'^[a-zA-Z0-9\n\s-,.]+$','required'=>false,'maxlength'=>255,'rangeLength'=>array(3,255),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserAdditionalInfo')))); ?>
								</div>
							</div>   
					 </div>
					 
			        <!--div class="row">
                         <div class="col-xs-12">
						    <center><p class="lead">Certificates To be Uploaded</p></center>
						 </div>
					</div--> 	
                    
					 			
                              <!--Vigilance Certificate-->
                    <!--div class="row">
					   <?php //if($user['InformationUser']['vigilance_pdf']!=NULL || $user['InformationUser']['vigilance_pdf']!='')
					   // {
					   ?>	
				     	<div class="col-md-4">
								<div class="form-group">
									<div>
										<label class="text-light-blue"><label>
									</div>						
								<?php //echo $this->Html->link(' Click Here to View Already Uploaded Vigilance Certificate','/uploads/documents/'.$user['InformationUser']['vigilance_pdf'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?>
								</div>
				        </div>
						<?php
						  //}
						?>  
						
					   <div class="col-md-4">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">Vigilance Certificate</label><span class="asterisk">* </span><label>
									</div>
								<input id="VigilanceCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, less than 10 Mb)</span>
						   </div>
					   </div>
					   
					       <!--For Showing Success Of Uploading File-->	
						<!--div class="col-md-4" style="display:none" id="file-uploaded-vigilance">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded vigilance certificate.
						      </div>
					    </div>	
					   
					</div--> 							
                                   <!--Caste Certificate-->
                    <?php if($user['InformationUser']['community']!='General')
                      {
 			        ?>
					<div class="row">
					   <?php if($user['InformationUser']['caste_pdf']!=NULL || $user['InformationUser']['caste_pdf']!='')
					    {
					   ?>	
				     	<div class="col-md-4">
								<div class="form-group">
									<div>
										<label class="text-light-blue"><label>
									</div>						
								<?php echo $this->Html->link(' Click Here to View Already Uploaded Caste Certificate','/users/download_self_caste_pdf/'.$user['InformationUser']['id'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?>
								</div>
				        </div>
						<?php
						  }
						?>  
					   <div class="col-md-4">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">Caste Certificate</label><span class="asterisk text-red">* </span>
									</div>
								<input id="CasteCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, allowed less than 10 Mb)</span>
							   
								<?php if($this->Form->isFieldError('caste_pdf')): ?>
								<div id="CasteCertError" class="text-red" >Please Upload Caste Certificate (only pdf, allowed less than 10 Mb).</div>
								<?php else: ?>
								<div id="CasteCertError" class="text-red" style="display:none">Please Upload Caste Certificate (only pdf, allowed less than 10 Mb).</div>
								<?php endif; ?>
						   </div>
					   </div>
					   
					       <!--For Showing Success Of Uploading File-->	
						<div class="col-md-4" style="display:none" id="file-uploaded-caste">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded caste certificate.
						      </div>
					    </div>	
					   
					</div> 												
				   <?php 
				     }
				   ?>
				
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Save & Next</button>
				</div>
          			<?php echo $this->Form->end(); ?>
	        </div><!--Primary Box-->
	    </div><!--First Column-->	
  </div>		


                       