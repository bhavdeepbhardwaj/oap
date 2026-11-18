<style type="text/css">

	.dl-horizontal dt{
		text-align: left;
		width: 145px;
	}
	.dl-horizontal dd {
		margin-left: 145px;
	}
</style>
<?php $timestamp = time();?>
 <script type="text/javascript">
	$(function() {
		$('#ProfilePicUser').uploadifive({
        'uploadScript' : '<?php echo $this->webroot;?>upload_files/upload_profile_pic',
		'auto'             : true,
		'buttonText':'Change Pic',
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
	
	$('#UserOfficeLocationId').prop('disabled',true);
	$('#UserOrganizationId').change(function(){
		                        orgnId = $(this).val();
								if(orgnId=='')
								 {
								  $('#UserOfficeLocationId').html('<option>Select Office Location</option>');
								  $('#UserOfficeLocationId').prop('disabled',true);
								  return false;
								 }
							
                                $.post('<?php echo $this->webroot;?>'+'/users/officelocationsbyorgnid',{'id':orgnId},function(response){
								        
										$('#UserOfficeLocationId').prop('disabled',false);
										$('#UserOfficeLocationId').html(response);
								  });								 
		
	});
	
	});	
</script>		

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<?php echo $this->Session->flash(); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-2">
						<div class="user-image" id="profilepiccontainer">
							<?php
							echo $this->Html->image('/users/download_self_profile_pic', array('alt' => 'User Image','fullBase' => true,'width'=>'100%'),array('escapeTitle' => false));
							?><br/>
							<br/>
						</div>	
							<div class="col-xs-12">
								<?php echo $this->Html->link('Change Password', array('controller' => 'users','action' => 'change_password'), array( 'style'=>array('color:#72afd2;'),'title'=>'Change Password','fullBase' => true)); ?>
							</div>
					</div>
					
					
					<div class="col-md-10">
						<div class="box-header">
							<h2 class="box-title text-light-blue">Profile Details</h3>
						</div><br/><!-- /.box-header -->
						<dl class="dl-horizontal">
							<div class="col-md-5">					
								<dt>User Name</dt>
								<dd><?php echo h($this->request->data['User']['u_name_title'].' '.$this->request->data['User']['f_name'].' '.$this->request->data['User']['l_name']);?></dd>
								<dt>Organization</dt>
								<dd><?php
                                    if($this->request->data['Group']['name']=='Member')
                                      {									
								       if($this->request->data['InformationUser']['present_emp_type']=='Deputation' || $this->request->data['InformationUser']['present_emp_type']=='Transfer')  
                                         {
                                           if($this->request->data['InformationUser']['current_organization_text']!='Others') 								
		    				                    echo ucfirst(h($this->request->data['InformationUser']['current_organization_text']));
							               else
								                echo ucfirst(h($this->request->data['InformationUser']['current_organization_text'].'('.$this->request->data['InformationUser']['other_current_organization'].')'));  
						                 }
                                       else
						                 {
							               if($this->request->data['User']['organization_name']!='Others')  
						                       echo ucfirst(h($this->request->data['User']['organization_name']));
                                           else
                                               echo ucfirst(h($this->request->data['User']['organization_name'].'('.$this->request->data['InformationUser']['other_orgn_name'].')'));  							
						                 }
									  }
									else 
                                      {
									   echo h($this->request->data['User']['organization_name']);
									  }									
								?>
								</dd>
								<dt>Designation</dt>
								<dd><?php 
								      if($this->request->data['Group']['name']!='Member')
									   {
								        echo h($this->request->data['Designation']['designation_name']); 
									   }
									   else
									   {
									    echo h($this->request->data['InformationUser']['present_post']);
									   }
									?>
								</dd>
								<?php 
								if($this->request->data['Group']['name']!='Member')
									{
								?>	   
								<dt>Office Location</dt>
								<dd><?php echo h($this->request->data['OfficeLocation']['location_name']); ?></dd>
								<?php
								}
								?>	
							</div>
							<div class="col-md-5">
							<?php if($this->request->data['Group']['name']=='Member' && !empty($this->request->data['InformationUser']['o_address'])){?>	
								<dt>Official Address</dt>
								<dd>  								
									<?php echo h($this->request->data['InformationUser']['o_address'].' , ');?><br/>
									<?php echo h($this->request->data['InformationUser']['o_state_name'].' , '.$this->request->data['InformationUser']['o_city_name']);?><br/>
									<?php echo h($this->request->data['InformationUser']['o_pincode']);  
									?><br/>
								  	
							    </dd>
								<dt>Residential Address</dt>
								<dd>							
									<?php echo h($this->request->data['InformationUser']['r_address'].' , ');?><br/>
									<?php echo h($this->request->data['InformationUser']['r_state_name'].' , '.$this->request->data['InformationUser']['r_city_name']);?><br/>
									<?php echo h($this->request->data['InformationUser']['r_pincode']); 
									?><br/>	
							    </dd>
								<?php } ?>
									<dt>Contact Details</dt>
									<dd>
									<i class="fa fa-fw fa-envelope-o"></i>
									<?php echo h($this->request->data['User']['email']); ?><br/>
									<i class="fa fa-fw fa-mobile-phone"></i>
									<?php echo h($this->request->data['User']['mobile_number']); ?><br/>
									<?php if(!empty($this->request->data['InformationUser']['r_std_code']) && !empty($this->request->data['InformationUser']['r_landline_number'])){?>
									<i class="fa fa-fw fa-phone"></i>
									<?php	echo h($this->request->data['InformationUser']['r_std_code'] . ' - ' .$this->request->data['InformationUser']['r_landline_number']); }
									
									?><br/>
									<?php if(!empty($this->request->data['User']['fax_number'])){?>
									<i class="fa fa-fw fa-print"></i>
									<?php echo h($this->request->data['User']['std_code'] . ' - ' .$this->request->data['User']['fax_number']); }?>
									
									</dd>
								</div>
							</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($this->request->data['Group']['name']!='Member'){?>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Profile'); ?></h3><div class="asteriskLine"> Fields marked with * are mandatory.</div>
			</div>
			<?php echo $this->Form->create('User', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<?php echo $this->Form->input('profilepic', array('type' => 'hidden')); ?>
			<div class="box-body">
				
				<div class="row">
					<div class="col-xs-3">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Title</label><span class="asterisk text-red">* </span>
							</div>   
						          <?php echo $this->Form->input('u_name_title', array('options'=>array('Mr.'=>'Mr.','Ms.'=>'Ms.','Mrs.'=>'Mrs.','Dr.'=>'Dr.'),'empty'=>'--Select Title--','label'=>false,'class'=>"form-control",'required'=>true)); ?>
						</div>
					</div>            
					
					                       <!-- For User First Name -->  
					<div class="col-xs-3">
						<div class="form-group">
							<div>
								<label class="text-light-blue">First Name</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->Form->input('f_name', array('placeholder'=>'First Name', 'alphabet'=>true,'rangeLength'=>[1,30],'maxlength'=>30,'label'=>false,'class'=>"form-control",'required'=>true)); ?>
						</div>
					</div>
					                       <!-- For User Middle Name -->
					<div class="col-xs-3">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Middle Name</label>
							</div>
						 <?php echo $this->Form->input('m_name', array('placeholder'=>'Middle Name', 'alphabet'=>true,'rangeLength'=>[1,30],'maxlength'=>30,'label'=>false,'class'=>"form-control")); ?>
						</div>
					</div>
					
					                        <!-- For User Last Name -->
					<div class="col-xs-3">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Last Name</label><span class="asterisk text-red">* </span>
							</div>
						<?php echo $this->Form->input('l_name', array('placeholder'=>'Last Name', 'label'=>false,'alphabet'=>true,'rangeLength'=>[1,30],'maxlength'=>30,'class'=>"form-control",'required'=>true)); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Mobile Number</label><span class="asterisk">* </span>
							</div>
						<?php echo $this->JqueryValidation->input('mobile_number', array('placeholder'=>'Mobile Number','type'=>'text','digits'=>true,"maxlength"=>10,"minlength"=>10,'class'=>"form-control",'label'=>false)); ?>
						</div>
					</div>
				               <!-- For Designation -->				
					<div class="col-xs-6">
						<div class="form-group">
						<div>
					 <label class="text-light-blue">Designation</label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('designation_id', array('empty' => '--Select Designation--','label'=>false,'class'=>"form-control",'required'=>true)); ?>
						</div>
					</div>
				</div>
				
				          <!-- For Profile Picture -->
				<div class="row">
					<div class="col-xs-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Profile Pic<label>
							</div>
							<input id="ProfilePicUser" type="file"  extension="png|jpeg|jpg|gif"/>
				
						</div>
						
					</div>
					            <!-- For Viewing Uploaded Pic -->
					<div class="col-xs-2">
						<div class="form-group" id="uploaded_pic_view_container" style="display:none">
							<div>
								<label class="text-light-blue">Profile Pic Preview<label>
							</div>
							<div id="uploaded_pic_view">
								<?php echo $this->Html->image('white.png', array('alt' => 'Loading image preview'));?>
								
							</div>
							<div class="overlay">
							  <i class="fa fa-refresh fa-spin"></i>
							</div>
						</div>
					</div>					
					
				</div>
				
				
			</div>
			<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Edit Profile</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>	
	</div>
</div>
<?php }?>