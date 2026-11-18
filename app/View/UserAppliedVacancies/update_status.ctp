<?php //pr($userAppliedVacancies); ?>
<div class="row">
	<div class="col-xs-6">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Update Status of Applicant'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('UserAppliedVacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('currentStatus',array('type'=>'hidden','value'=>$currentStatus)); ?>
			<div class="box-body">
			    <div class="row">
				  <div class="col-md-12">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Present Organization</label><span class="asterisk text-red">*</span>
							</div>
							<?php 
						  if($userAppliedVacancies['LogInformationUser']['present_emp_type']=='Deputation' ||$userAppliedVacancies['LogInformationUser']['present_emp_type']=='Transfer' )
                            {
                              if($userAppliedVacancies['LogInformationUser']['current_organization_text']!='Others') 								
						          echo $this->Form->input('LogInformationUser.current_organization_text',array('label'=>false,'class'=>'form-control','disabled'=>'disabled'));
							  else
								  echo $this->Form->input('LogInformationUser.other_current_organization',array('label'=>false,'class'=>'form-control','disabled'=>'disabled'));
								//echo ucfirst(h($userAppliedVacancies['LogInformationUser']['current_organization_text'].'('.$userAppliedVacancies['LogInformationUser']['other_current_organization'].')'));  
						    }
                          else
						  {
							if($userAppliedVacancies['LogInformationUser']['organization_name']!='Others')  
						       echo $this->Form->input('LogInformationUser.organization_name',array('label'=>false,'class'=>'form-control','disabled'=>'disabled'));
						      // echo ucfirst(h($userAppliedVacancies['LogInformationUser']['organization_name']),array('label'=>false,'class'=>'form-control','disabled'=>'disabled'));
                            else
							   echo $this->Form->input('LogInformationUser.other_orgn_name',array('label'=>false,'class'=>'form-control','disabled'=>'disabled'));	
                               //echo ucfirst(h($userAppliedVacancies['LogInformationUser']['organization_name'].'('.$userAppliedVacancies['LogInformationUser']['other_orgn_name'].')'));  							
						  }
						?>
						</div>
					</div>
				</div>
				<div class="row">
				  <div class="col-md-6">
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
				</div>
				<div class="row">
				   <div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant's Email Id</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('User.email', array('label'=>false,'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('status') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Status</label><span class="asterisk text-red">* </span>
							</div>
							<?php 
							   // if($userAppliedVacancies['UserAppliedVacancy']['status']=='Accepted')
							    // {
								 // echo $this->Form->input('status', array('empty'=>'--Select Status--','options'=>array('Incomplete Documents'=>'Incomplete Documents','Call for Interview'=>'Call for Interview'),'label'=>false,'class'=>'form-control','required'=>true)); 
								// }
								if($userAppliedVacancies['UserAppliedVacancy']['status']=='Incomplete Documents')
								 {
								  echo $this->JqueryValidation->input('status', array('empty'=>'--Select Status--','options'=>array('Call for Interview'=>'Call for Interview'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserFName'))));  
								 }
								 // else if($userAppliedVacancies['UserAppliedVacancy']['status']=='Not Eligible')
								 // {
								  // echo $this->Form->input('status', array('empty'=>'--Select Status--','options'=>array('Under Consideration'=>'Under Consideration','Accepted'=>'Accepted','Call for Interview'=>'Call for Interview'),'label'=>false,'class'=>'form-control','required'=>true)); 
								 // }
								 else if($userAppliedVacancies['UserAppliedVacancy']['status']=='Call for Interview')
								 {
								  echo $this->JqueryValidation->input('status', array('value'=>'Call for Interview','label'=>false,'class'=>'form-control','required'=>true,'disabled'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyStatus')))); 
								 }
								 else
								 {
							      echo $this->JqueryValidation->input('status', array('empty'=>'--Select Status--','options'=>array('Incomplete Documents'=>'Incomplete Documents','Call for Interview'=>'Call for Interview'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyStatus')))); 
							     }
							?>
						</div>
					</div>	
                </div>				
				<div class="row">
                <div class="col-md-12">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Remarks</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->JqueryValidation->input('remarks', array('placeholder'=>'Write Comments/Remarks for Applicant.....','label'=>false,'rows'=>4,'class'=>'form-control','rangeLength'=>array(3,500),'maxlength'=>500,'pattern'=>'^[a-zA-Z0-9\n\s.,-]+$','escape'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyRemarks')))); ?>
						</div>
					</div>					
				</div>
				
           </div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Update Status</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-fw fa-question-circle"></i>
				<h3 class="box-title">Help</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<blockquote>
					<p>Status</p>
					<small>Here selected Status will be displayed to user.</small>
				</blockquote>
				<blockquote>
					<p>Remarks</p>
					<small>Here you can write Comments/Remarks for applicant with respect to status.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>	
