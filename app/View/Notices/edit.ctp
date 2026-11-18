<?php $timestamp = time();?>
 <script type="text/javascript">
	$(function() {
		$('#AdvtDocument').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_advt_pdf',
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
										$('#NoticeAdvtPdf').val(filename);
										$('#file-uploaded').show();
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
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_advt_pdf',
		'onAddQueueItem' : function(file){
											$('#file-uploaded').hide();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'pdf':
												
												break;
												default:
												alert('Error - File type not Suppoerted (Supported file type: pdf )');
												$('#AdvtDocument').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	// $('#NoticeOpeningDate').datepicker({format:'dd-mm-yyyy'});
	// $('#NoticeClosingDate').datepicker({
	                    // format: 'dd-mm-yyyy'
                 // });
				 
	//$('#NoticeClosingDate').prop('disabled',true);
	
	$('#datepickerClose').datepicker({
										format    : 'dd-mm-yyyy',
										startDate : '<?php echo h($openingDate); ?>',
										todayHighlight : true 
										});
	
	$('#noticeOpen').datepicker({format    : 'dd-mm-yyyy',
	                             startDate : '<?php echo h($openingDate); ?>',
								 todayHighlight  : true,
								}).on('changeDate',function(e){
									                           $('#datepickerClose').prop('disabled',false);
															   $('#datepickerClose').datepicker("remove");
																$('#datepickerClose').datepicker({
																										format    : 'dd-mm-yyyy',
																										startDate:$('#NoticeOpeningDate').datepicker('getDate')
 																									
																									 });
																 
															   
								                              }).on('clearDate',function(e){
																                            $('#datepickerClose').val(''), 
									                                                        $('#datepickerClose').prop('disabled',true);
								                                                           });			 
	});
</script>
<div class="row">
	<div class="col-xs-12">
	   <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Vacancy Circular'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('Notice', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('advt_pdf',array('type'=>'hidden')); ?>
			<div class="box-body">
			
			<div class = "row">
			                            <!--Advertisement Number-->
			        <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('advt_number') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Advertisement Number</label>
								<span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('advt_number', array('placeholder'=>'Enter Advertisement Number','label'=>false,'class'=>'form-control','maxlength'=>20,'pattern'=>'^[a-zA-Z0-9/-]+$','rangeLength'=>array(3,20),'reqired'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'NoticeAdvtNumber')))); ?>
						</div>
					</div>
					                      <!--Reference Number-->
					      
					<!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Reference Number</label><span class="asterisk">* </span>
							</div>
							<?php //echo $this->Form->input('reference_number', array('placeholder'=>'Enter Reference Number','label'=>false,'class'=>"form-control",'required'=>true)); ?>
						</div>
					</div-->
					
					                <!--Advertisement Title-->
					      
					<div class="col-md-8">
						<div class="form-group <?php echo $this->Form->isFieldError('advt_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Advertisement Title</label>
								<span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('advt_name', array('placeholder'=>'Enter Advertisement Title....','label'=>false,'class'=>'form-control','maxlength'=>80,'alphabetspace'=>true,'rangeLength'=>array(3,80),'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'NoticeAdvtName')))); ?>
						</div>
					</div>
			
			</div>
			
			
			<div class = "row">
			 <div class="col-md-4 tenurefrom <?php echo $this->Form->isFieldError('opening_date') ? 'has-error' : '' ?>">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Opening Date</label><span class="asterisk text-red">* </span>
							</div>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<?php echo $this->JqueryValidation->input('opening_date', array('id'=>'noticeOpen','placeholder'=>'dd-mm-yyyy','class'=>'form-control','type'=>'text','label'=>false,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'noticeOpen')))); ?>
							</div>
						</div>
					</div>
					
				   <div class="col-md-4 tenureto <?php echo $this->Form->isFieldError('closing_date') ? 'has-error' : '' ?>">
						<div class="form-group">
							    <div>
								    <label class="text-light-blue">Closing Date</label><span class="asterisk text-red">* </span>
							    </div>
							  <div class="input-group">
								   <div class="input-group-addon">
									     <i class="fa fa-calendar"></i>
								   </div>
								  <?php echo $this->JqueryValidation->input('closing_date', array('id'=>'datepickerClose','placeholder'=>'dd-mm-yyyy','class'=>'form-control','type'=>'text','label'=>false,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'datepickerClose')))); ?>
							   </div>
						</div>
				   </div>	
			 
			   <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('year_of_recruitment') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Year of Recruitment</label><span class="asterisk text-red">* </span>
							</div>
							<?php 
							   $years = range(date('Y')-1,date('Y')+1);
							   $years = array_combine($years,$years);
							echo $this->JqueryValidation->input('year_of_recruitment', array('options'=>$years,'empty'=>'--Select Year--','label'=>false,'class'=>'form-control','digits'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'NoticeYearOfRecruitment')))); ?>
						</div>
				</div>
			 
			 
			</div>
                           <!--Advertisement-->
            <div class="row">
                <div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue"><label>
							</div>						
					    <center>
							<?php echo $this->Html->link(' Click Here to View Already Uploaded Circular','/notices/download_advertisement/'.$notice,array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?>
							<?php  //echo $this->Form->postLink(' Click Here to View Already Uploaded Circular', array('action' => 'download_advertisement', $notice), array('title'=>'Click Here to View Already Uploaded Circular','target' => '_blank','fullbase'=>true, 'class'=>'fa fa-download')); ?> 
							</center>
						</div>
				</div>
                <div class="col-md-4">
						<div class="form-group">
							<div>
							<center><label class="text-light-blue">Advertisement Document<label></center>
							</div>
						<center><input id="AdvtDocument" type="file"  extension="pdf"/></center>
						<span class="text-red"><center>(only pdf, allowed file size less than 4 Mb)</center></span>
						</div>
				  </div>
					
				            <!--For Showing Success Of Uploading File-->	
						<div class="col-md-4" style="display:none" id="file-uploaded">
						   <br/>
						      <div class="pull-left alert alert-success">
						             <i class="fa fa-check"></i>
					    	     You have successfully uploaded advertisement document.
						      </div>
					    </div>				
			</div> 			
			
		</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit Created Notice</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>