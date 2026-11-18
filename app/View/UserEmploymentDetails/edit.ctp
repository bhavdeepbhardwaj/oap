<?php $timestamp = time();?>
 <script type="text/javascript">
	
                        //Exp Certificates
	$(function() {
		$('#ExpCert').uploadifive({
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
										$('#UserEmploymentDetailExpPdf').val(filename);
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
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_doc_pdf',
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
												$('#ExpCert').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	$('#UserEmploymentDetailFromDate').datepicker({
		                                           format:'dd-mm-yyyy',
												   todayHighlight : true
	                                              });
	$('#UserEmploymentDetailToDate').datepicker({
		                                           format:'dd-mm-yyyy',
												   todayHighlight : true
	                                              });
	
	$('#UserEmploymentDetailAddForm').submit(function(event){
				
							var ExpDocument=$('#UserEmploymentDetailExpPdf').val();
							
							if(ExpDocument=='')
							{
								$('#ExpDocumentError').show();
								return false;
							}
							else
							{
								$('#ExpDocumentError').hide();
								return true;
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
				<h3 class="box-title"><?php echo __('Edit Details Of Employment/Experience in Chronological Order'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
							   
			<?php echo $this->Form->create('UserEmploymentDetail',array('role' => "form",'class'=>'jquery-validation')); ?>	
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('exp_pdf',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
				                                  
					                       <!-- Organization Name -->  
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Name of Organization</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('organization_name', array('placeholder'=>'Enter Organization Name','label'=>false,'class'=>'form-control','alphabetspace'=>true,'maxlength'=>80,'rangeLength'=>array(3,80),'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailOrganizationName')))); ?>
						</div>
					</div>
					
					                               
					                       <!-- Posts Held -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('post_held') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Post's held</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('post_held',array('placeholder'=>'Enter Post Name','label'=>false,'class'=>'form-control','required'=>true,'alphabetspace'=>true,'maxlength'=>80,'rangeLength'=>array(3,80),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailPostHeld')))); ?>
						</div>
					</div>
					
					             <!-- Scale Of Pay -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('scale_of_pay') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Scale of Pay/Emoluments</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('scale_of_pay',array('placeholder'=>'Pay Scale/Consolidated Emoluments','label'=>false,'class'=>'form-control','required'=>true,'pattern'=>'^[0-9-]+$','maxlength'=>22,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailScaleOfPay')))); ?>
						</div>
					</div>
					
					                     <!-- From Date-->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('from_date') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">From</label><span class="asterisk text-red">* </span><label>
							</div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
						        <?php echo $this->JqueryValidation->input('from_date', array('type'=>'text','label'=>false,'placeholder'=>'dd-mm-yyyy','class'=>'form-control','required'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailFromDate')))); ?>
						    </div>
						</div>
					</div>
					
					           <!--	To -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('to_date') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">To</label><span class="asterisk text-red">* </span><label>
							</div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
						            <?php echo $this->JqueryValidation->input('to_date', array('type'=>'text','label'=>false,'placeholder'=>'dd-mm-yyyy','class'=>'form-control','required'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailToDate')))); ?>
						    </div>  
						</div>
					</div>
					
					          <!-- Nature Of Duties -->  
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('nature_of_duties') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Nature of duties</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('nature_of_duties', array('label'=>false,'class'=>'form-control','required'=>true,'pattern'=>'^[a-zA-Z\s.,-]+$','maxlength'=>200,'rangeLength'=>array(3,200),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailNatureOfDuties')))); ?>
						</div>
					</div>
					
					                         <!--For Experience Document-->
					   <div class="col-md-6">
					      <div class="form-group">
									<div>
										<label class="text-light-blue">Experience Certificate</label><span class="asterisk text-red">* </span><label>
									</div>
								<input id="ExpCert" type="file"  extension="pdf"/>
						       <span class="text-red">(only pdf, less than 10 Mb)</span>
							   <div id="ExpDocumentError" class="text-red" style="display:none"><center>Please Upload Experience Certificate</center></div>
						    <?php if($this->Form->isFieldError('exp_pdf')): ?>
							<div id="ExpDocumentError" class="text-red" style="display:none"><center>Please Upload Experience Certificate</center></div>
							<?php endif; ?>
						   </div>
					   </div>
					   
					       <!--For Showing Success Of Uploading File-->	
						<div class="col-md-6" style="display:none" id="file-uploaded-exp">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded experience certificate.
						      </div>
					    </div>	
						
					<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue"><label>
							</div>						
					       <center><?php echo $this->Html->link(' Click Here to View Already Uploaded Certificate','/user_employment_details/dwn_self_emp_doc/'.$expCert,array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?></center>
						</div>
				    </div>
					
		   </div>	 
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Edit Employment Detail</button>
				</div>
          			<?php echo $this->Form->end(); ?>
	        </div>
	     </div><!--Primary Box-->
	</div>	 
	
	        <!--Help Menu-->
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-fw fa-question-circle"></i>
				<h3 class="box-title">Help</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<blockquote>
					<p>Post's Held</p>
					<small>Here you have to enter name of those designation that were assigned to you</small>
				</blockquote>
				<blockquote>
					<p>Scale of Pay</p>
					<small>Should be in Following Format : _____-_____</small>
					<small>Example : 15000-16300</small>
					<p>Or</p>
					<small>Emoluments : _________</small>
					<small>Example : 150000</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>	
</div>	