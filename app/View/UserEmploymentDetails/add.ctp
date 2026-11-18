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
				<h3 class="box-title"><?php echo __('Add Details of Employment/Experience in Chronological Order'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
						   
			<?php echo $this->Form->create('UserEmploymentDetail',array('role' => "form",'class'=>'jquery-validation')); ?>	
			<?php echo $this->Form->input('exp_pdf',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
				                                  
					                       <!-- Select Organization -->  
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Name of Organization</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('organization_name', array('placeholder'=>'Enter Organization Name','label'=>false,'class'=>'form-control','required'=>true,'alphabetspace'=>true,'maxlength'=>80,'rangeLength'=>array(3,80),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailOrganizationName')))); ?>
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
						 <?php //echo $this->JqueryValidation->input('scale_of_pay',array('placeholder'=>'Eg. 9000-12000','label'=>false,'class'=>'form-control','required'=>true,'pattern'=>'^[1-9][0-9]{3,6}[-]{1}[1-9][0-9]{3,6}','maxlength'=>11,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailScaleOfPay')))); ?>
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
						        <?php echo $this->JqueryValidation->input('from_date', array('type'=>'text','label'=>false,'placeholder'=>'dd-mm-yyyy','class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailFromDate')))); ?>
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
						            <?php echo $this->JqueryValidation->input('to_date', array('type'=>'text','label'=>false,'placeholder'=>'dd-mm-yyyy','class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailToDate')))); ?>
						    </div>  
						</div>
					</div>
					
					          <!-- Nature Of Duties -->  
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('nature_of_duties') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Nature of duties</label><span class="asterisk text-red">* </span><label>
							</div>
						 <?php echo $this->JqueryValidation->input('nature_of_duties', array('label'=>false,'placeholder'=>'Nature of Duties....','pattern'=>'^[a-zA-Z\n\s.,-]+$','maxlength'=>200,'rangeLength'=>array(3,200),'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserEmploymentDetailNatureOfDuties')))); ?>
						</div>
					</div>
                                        <!--For Experience Document-->
					   <div class="col-md-6">
					      <div class="form-group ">
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
					
		   </div>	 
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Save Employment Detail</button>
				</div>
         			<?php echo $this->Form->end(); ?>
             	<?php if($empDetailExists) 
			      {
			    ?>				
				<center>
                   <a href="<?php echo $this->Html->url(array('controller'=>'user_employment_details','action'=>'next'));?>"><button type="button" class="btn btn-primary"><i class="fa fa-hand-o-right"></i> Next</button></a>
				</center>
                <?php
				  }
                ?>				  
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
					<p>Scale of Pay/Emoluments</p>
					<small>Scale of Pay Should be in Following Format : _____-_____</small>
					<small>Example : 15000-16300</small>
				    <p>Or</p>
					<small>Emoluments : _________</small>
					<small>Example : 150000</small>
				</blockquote>
				<blockquote>
					<p>Nature of Duties</p>
					<small>Duties performed under the job</small>
				</blockquote>
				
			</div><!-- /.box-body -->
		</div>
	</div>	
</div>	

                               <!--For Displaying Added Experiences-->
<div class="row">							   
    <div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Details Of Employment/Experiences'); ?></h3>
			</div>
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Organization Name</th>
						<th>Posts Held</th>
						<th>Scale of Pay//Emoluments</th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Nature of Duties</th>
						<th>Certificate</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($services as $service): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($service['UserEmploymentDetail']['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($service['UserEmploymentDetail']['post_held'])); ?></td>
						<td><?php echo h($service['UserEmploymentDetail']['scale_of_pay']); ?></td>
						<td><?php echo h(date('d-m-Y',strtotime($service['UserEmploymentDetail']['from_date']))); ?></td>
						<td><?php echo h(date('d-m-Y',strtotime($service['UserEmploymentDetail']['to_date']))); ?></td>
						<td><?php echo ucfirst(h($service['UserEmploymentDetail']['nature_of_duties'])); ?></td>
						<td>
						<center><?php echo $this->Html->link(false,'/user_employment_details/dwn_self_emp_doc/'.$service['UserEmploymentDetail']['id'], array('target'=>'_blank','class'=>'fa fa-download')); ?>							
						</center>
						</td>	
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit',$service['UserEmploymentDetail']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Edit')); ?>Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
				</tbody>
			</table>
		</div><!-- /.box-body -->					   
								   
        </div><!--Primary Box-->
    </div><!--First Column-->
</div><!--Second Row-->	

