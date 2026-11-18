<?php //pr($userAppliedVacancies); ?>
<?php $timestamp = time();?>
 <script type="text/javascript">
	
                        //Exp Certificates
	$(function() {
		$('#AcrCert').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_applicant_acrs',
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
										$('#UserAppliedVacancyAcrPdf').val(filename);
										$('#file-uploaded-exp').show();
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
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_applicant_acrs',
		'onAddQueueItem' : function(file){
											$('#file-uploaded-exp').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#AcrCert').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	
	$('#ViglCert').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_applicant_acrs',
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
										$('#UserAppliedVacancyViglPdf').val(filename);
										$('#file-uploaded-expVigl').show();
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
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_applicant_acrs',
		'onAddQueueItem' : function(file){
											$('#file-uploaded-expVigl').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#ViglCert').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	
	$('#CadreCert').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_applicant_acrs',
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
										$('#UserAppliedVacancyCadrePdf').val(filename);
										$('#file-uploaded-expCadre').show();
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
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_applicant_acrs',
		'onAddQueueItem' : function(file){
											$('#file-uploaded-expCadre').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#CadreCert').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	    $('#UserAppliedVacancyUploadAcrsForm').submit(function(event){
				      
					        //For ACR Certificate
							var AcrDocument=$('#UserAppliedVacancyAcrPdf').val();
					        
							if(AcrDocument=='None')
							{ 
								$('#AcrCertError').show();
								return false;
							}
							else
							{
								$('#AcrCertError').hide();
								
								//For Vigilance Certificate
								
								var ViglDocument=$('#UserAppliedVacancyViglPdf').val();
								if(ViglDocument=='None')
								{
								 $('#ViglCertError').show();
								 return false;	
								}
								else
								{
								   $('#ViglCertError').hide();
								   
								   //For Cadre Certificate
                                    var CadreDocument=$('#UserAppliedVacancyCadrePdf').val();
										if(CadreDocument=='None')
										{
										 $('#CadreCertError').show();
										 return false;	
										}
										else
										{
										 $('#CadreCertError').hide();	
										 return true;	
										}									 
								}	
								
								
								return false;
								
							}
							
							return false;
						});
	});
</script>	
<div class="row">
	<div class="col-md-6">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Upload Documents'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('UserAppliedVacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('acr_pdf',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('vigl_pdf',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('cadre_pdf',array('type'=>'hidden')); ?>
			<div class="box-body">
			    
				<div class="row">
				  <div class="col-md-12">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Name</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('User.userName', array('label'=>false,'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Present Designation</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('LogInformationUser.present_post', array('label'=>false,'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant Email Id</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('User.email', array('label'=>false,'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
				</div>
				<div class="row">
				                       <!--For Uploaing ACRs-->
					   <div class="col-md-6">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">ACR Certificate</label><span class="asterisk text-red">* </span><label>
									</div>
								<input id="AcrCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, less than 10 Mb)</span>
							      <div id="AcrCertError" class="text-red" style="display:none">Please Upload ACR Certificate</div>
								  <?php if($this->Form->isFieldError('acr_pdf')): ?>
							          <div id="AcrCertError" class="text-red" style="display:none">Please Upload ACR Certificate</div>
						          <?php endif; ?>
						   </div>
					   </div>
					   
					           <!--For Showing Success Of Uploading File-->	
						<div class="col-md-6" style="display:none" id="file-uploaded-exp">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded Acr.
						      </div>
					    </div>
				</div>
                <div class="row">				
					                    <!--For Uploaing Vigilance-->
					   <div class="col-md-6">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">Vigilance Certificate</label><span class="asterisk text-red">* </span><label>
									</div>
								<input id="ViglCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, less than 10 Mb)</span>
						       <div id="ViglCertError" class="text-red" style="display:none">Please Upload Vigilance Certificate</div>
							   <?php if($this->Form->isFieldError('vigl_pdf')): ?>
							          <div id="ViglCertError" class="text-red" style="display:none">Please Upload Vigilance Certificate</div>
						        <?php endif; ?>
						   </div>
					   </div>
					    
					
						<div class="col-md-6" style="display:none" id="file-uploaded-expVigl">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded Vigilance Cert.
						      </div>
					    </div>
				</div>
                <div class="row">				
					                  <!--For Uploaing Cadre-->
					   <div class="col-md-6">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">Cadre Certificate</label><span class="asterisk text-red">* </span><label>
									</div>
								<input id="CadreCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, less than 10 Mb)</span>
						       <div id="CadreCertError" class="text-red" style="display:none">Please Upload Cadre Certificate</div>
							   <?php if($this->Form->isFieldError('cadre_pdf')): ?>
							          <div id="CadreCertError" class="text-red" style="display:none"><center>Please Upload Cadre Certificate</center></div>
						       <?php endif; ?>
						   </div>
					   </div>
					   
					         <!--For Showing Success Of Uploading File-->	
						<div class="col-md-6" style="display:none" id="file-uploaded-expCadre">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded Cadre Certificate.
						      </div>
					    </div>	
				</div>
								
			</div>	
				
           </div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Upload Documents</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
	
</div>	
