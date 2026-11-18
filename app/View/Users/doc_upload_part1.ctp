<?php $timestamp = time();?>
 <script type="text/javascript">
	$(function() {
		$('#ProfilePicUser').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_profile_pic',
		'auto'             : true,
		'buttonText':'Upload',
        'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						}, 
		'onUploadComplete': function(file,data){
						
									if(data.search('uploaded_ok_')!=-1)
									{
										var filename= data.split('_');
										filename=filename[2];
										$('#UserProfilepic').val(filename);
										$('#uploaded_pic_view_container').show();
										$('#uploaded_pic_view').html('<img style="width:100%" src="<?php echo $this->webroot;?>users/dwnl_new_upl_self_pic/'+filename+'"/>');
										$('.overlay').hide();
									
									}
									else
									{
										$('.fileinfo').html(' - '+data);
										$('.uploadifive-queue-item').addClass('error');
									}
												
						},
		'dnd'          : true,
		'fileSizeLimit' : '4 MB',	
		'fileType':'image/png|image/jpg|image/jpeg|image/gif',
		
		'multi':false,
		'simUploadLimit' : 1,	
		'removeCompleted' : true,
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_profile_pics',
		'onAddQueueItem' : function(file){
											$('#uploaded_pic_view_container').show();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'png':
												case 'jpg':
												case 'jpeg':
												case 'gif':
												
												break;
												default:
												alert('Error - File type not Supported (Supported file types: png, jpg, jpeg )');
												$('#ProfilePicUser').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	});
                           //For Signature Uploading
	$(function() {
		$('#ProfileSignature').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_profile_sign',
		'auto'             : true,
		'buttonText':'Upload',
        'formData'     : {
							'timestamp' : '<?php echo $timestamp;?>',
							'token'     : '<?php echo md5('oOlnb%unique_saltui#876ghWWzxa' . $timestamp);?>'
						}, 
		'onUploadComplete': function(file,data){
						
									if(data.search('uploaded_ok_')!=-1)
									{
										var filename= data.split('_');
										filename=filename[2];
										$('#UserProfilesignature').val(filename);
										$('#uploaded_sign_view_container').show();
										$('#uploaded_sign_view').html('<img style="width:100%" src="<?php echo $this->webroot;?>users/dwnl_new_upl_self_sign/'+filename+'"/>');
										$('.overlay').hide();
									
									}
									else
									{
										$('.fileinfo').html(' - '+data);
										$('.uploadifive-queue-item').addClass('error');
									}
												
						},
		'dnd'          : true,
		'fileSizeLimit' : '4 MB',	
		'fileType':'image/png|image/jpg|image/jpeg|image/gif',
		
		'multi':false,
		'simUploadLimit' : 1,	
		'removeCompleted' : true,
		
		'checkScript'      : '<?php echo $this->webroot;?>upload_files/check_exists_profile_pics',
		'onAddQueueItem' : function(file){
											$('#uploaded_sign_view_container').show();
											var fileName = file.name;
											var ext = fileName.substring(fileName.lastIndexOf('.') + 1); // Extract EXT
											switch (ext) 
											{
												case 'png':
												case 'jpg':
												case 'jpeg':
												case 'gif':
												
												break;
												default:
												alert('Error - File type not Supported (Supported file types: png, jpg, jpeg )');
												$('#ProfileSignature').uploadifive('cancel', file);
												break;
											}
										}
		
    });
	
	$('#UserDocUploadPart1Form').submit(function(event){
				
							var UserProfilepic=$('#UserProfilepic').val();
							var UserProfilesignature=$('#UserProfilesignature').val();
							if(UserProfilepic=='')
							{
								$('#UserProfilepicError').show();
							
								return false;
							}
							else
							{
								$('#UserProfilepicError').hide();
								if(UserProfilesignature=='')
								{
									$('#UserProfilesignatureError').show();
									return false;
								}
								else
								{
									$('#UserProfilesignatureError').hide();
									
								}
								
								return true;
							}
							
							return false;
						});
	});	
</script>


<div class="row">
	<div class="col-md-7">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Profile Picture & Signature Upload'); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('User', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('profilepic', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('profilesignature', array('type' => 'hidden')); ?>
			<div class="box-body">
				          <!-- For Profile Picture -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Profile Picture<label>
							</div>
							<input id="ProfilePicUser" type="file"  extension="png|jpeg|jpg|gif"/>
							<span class="text-red">(only png, jpeg, gif files and not more than 10 Mb)</span>
							   <div id="UserProfilepicError" class="text-red" style="display:none"><center>Please Upload Profile Pic</center></div>
						    <?php if($this->Form->isFieldError('profilepic')): ?>
							<div id="UserProfilepicError" class="text-red" style="display:none"><center>Please Upload Profile Pic</center></div>
							<?php endif; ?>
						</div>
						
					</div>
					            <!-- For Viewing Uploaded Pic -->
					<div class="col-md-3">
						<div class="form-group" id="uploaded_pic_view_container" >
							<div>
								<label class="text-light-blue">Profile Picture Preview<label>
							</div>
							<div class="image" id="uploaded_pic_view">
								<?php 
								
								//echo $this->Html->image('white.png', array('alt' => 'Loading image preview'));
								?>
								<?php
									echo $this->Html->image('/users/download_self_profile_pic', array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
								?>
							</div>
							<!--div class="overlay">
							  <i class="fa fa-refresh fa-spin"></i>
							</div-->
						</div>
					</div>					
					
				</div>
				                   <!-- For Signature Uploading -->
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
						
							<div>
								<label class="text-light-blue">Signature<label>
							</div>
							<input id="ProfileSignature" type="file"  extension="png|jpeg|jpg|gif"/>
							<span class="text-red">(only png, jpeg, gif files and not more than 10 Mb)</span>
							   <div id="UserProfilesignatureError" class="text-red" style="display:none"><center>Please Upload Signature</center></div>
						    <?php if($this->Form->isFieldError('profilesignature')): ?>
							<div id="UserProfilesignatureError" class="text-red" style="display:none"><center>Please Upload Signature</center></div>
							<?php endif; ?>
						</div>
						
					</div>
					            <!-- For Viewing Uploaded Signature -->
					<div class="col-md-3">
						<div class="form-group" id="uploaded_sign_view_container" >
							<div>
								<label class="text-light-blue">Signature Preview<label>
							</div>
							<div id="uploaded_sign_view">
								<?php //echo $this->Html->image('white1.png', array('alt' => 'Loading image preview'));?>
								<?php
									echo $this->Html->image('/users/download_self_profile_sign', array('alt' => 'User Signature','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
								?>
							</div>
							<!--div class="overlay">
							  <i class="fa fa-refresh fa-spin"></i>
							</div-->
						</div>
					</div>					
					
				</div>
				
			</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Save & Next</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="col-md-5">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-fw fa-question-circle"></i>
				<h3 class="box-title">Instructions</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<blockquote>
					<p>Profile Picture</p>
					<small>Allowed File Extension - .png,.jpeg,.gif</small>
				    <small>Allowed File Size      -  Not more than 10Mb</small> 
				</blockquote>
				<blockquote>
					<p>Signature</p>
					<small>Allowed File Extension - .png,.jpeg,.gif</small>
				    <small>Allowed File Size      -  Not more than 10Mb</small>
				</blockquote>
				
			</div><!-- /.box-body -->
		</div>
	</div>
</div>