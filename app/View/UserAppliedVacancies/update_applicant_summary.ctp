<?php //pr($userAppliedVacancies); ?>
<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Update Applicant Summary'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('UserAppliedVacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('currentStatus',array('type'=>'hidden','value'=>$currentStatus)); ?>
			<div class="box-body">
			    <div class="row">
				  <div class="col-md-offset-3 col-md-6">
						<div class="form-group">
							<div>
							<center><label class="text-light-blue">Present Organization</label><span class="asterisk text-red">*</span></center>
							</div>
							<?php 
						  if($userAppliedVacancies['LogInformationUser']['present_emp_type']=='Deputation' ||$userAppliedVacancies['LogInformationUser']['present_emp_type']=='Transfer' )
                            {
                              if($userAppliedVacancies['LogInformationUser']['current_organization_text']!='Others') 								
						          echo $this->Form->input('LogInformationUser.current_organization_text',array('label'=>false,'class'=>'form-control text-center','value'=>$userAppliedVacancies['LogInformationUser']['current_organization_text'],'disabled'=>'disabled'));
							  else
								  echo $this->Form->input('LogInformationUser.other_current_organization',array('label'=>false,'class'=>'form-control text-center','value'=>$userAppliedVacancies['LogInformationUser']['other_current_organization'],'disabled'=>'disabled'));
								//echo ucfirst(h($userAppliedVacancies['LogInformationUser']['current_organization_text'].'('.$userAppliedVacancies['LogInformationUser']['other_current_organization'].')'));  
						    }
                          else
						  {
							if($userAppliedVacancies['LogInformationUser']['organization_name']!='Others')  
						       echo $this->Form->input('LogInformationUser.organization_name',array('label'=>false,'class'=>'form-control text-center','value'=>$userAppliedVacancies['LogInformationUser']['organization_name'],'disabled'=>'disabled'));
						      // echo ucfirst(h($userAppliedVacancies['LogInformationUser']['organization_name']),array('label'=>false,'class'=>'form-control','disabled'=>'disabled'));
                            else
							   echo $this->Form->input('LogInformationUser.other_orgn_name',array('label'=>false,'class'=>'form-control text-center','value'=>$userAppliedVacancies['LogInformationUser']['other_orgn_name'],'disabled'=>'disabled'));	
                               //echo ucfirst(h($userAppliedVacancies['LogInformationUser']['organization_name'].'('.$userAppliedVacancies['LogInformationUser']['other_orgn_name'].')'));  							
						  }
						?>
						</div>
					</div>
				</div>
				<div class="row">
				  <div class="col-md-4">
						<div class="form-group">
							<div>
							  	<label class="text-light-blue">Name</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('User.userName', array('label'=>false,'class'=>'form-control','value'=>$userAppliedVacancies['User']['userName'],'disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Present Designation</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('LogInformationUser.present_post', array('label'=>false,'class'=>'form-control','value'=>$userAppliedVacancies['LogInformationUser']['present_post'],'disabled'=>'disabled')); ?>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant's Email Id</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('User.email', array('label'=>false,'class'=>'form-control','disabled'=>'disabled','value'=>$userAppliedVacancies['User']['email'])); ?>
						</div>
					</div>
				</div>
				<div class="row">
				   
				   <div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('vigl_case_text') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Vigilance/Disciplinary case,if any</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->JqueryValidation->input('vigl_case_text', array('placeholder'=>'Vigilance/Disciplinary case,if any.....','label'=>false,'rows'=>4,'class'=>'form-control','rangeLength'=>array(3,500),'maxlength'=>500,'pattern'=>'^[a-zA-Z0-9\n\s,-_()]+$','escape'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyViglCaseText')))); ?>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('exp_feeder_grade') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Experience in Feeder Grade</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('exp_feeder_grade', array('placeholder'=>'Experience in Feeder Grade', 'label'=>false,'rows'=>4,'pattern'=>'^[a-zA-Z0-9\n\s,-_()]+$','rangeLength'=>array(3,1000),'class'=>'form-control', 'maxlength'=>1000,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyExpFeederGrade')))); ?>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group <?php echo $this->Form->isFieldError('acr_status') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">ACR/APAR</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('acr_status', array('placeholder'=>'ACR/APAR', 'label'=>false,'rows'=>4,'pattern'=>'^[a-zA-Z0-9\n\s,-_()]+$','rangeLength'=>array(3,500),'class'=>'form-control', 'maxlength'=>500,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyACRStatus')))); ?>
						</div>
					</div>
				   	
                </div>				
				<div class="row">
                
				<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('eligiblity_position') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Eligiblity Position</label><span class="asterisk text-red">* </span>
							</div>
							<?php 
							   
							      echo $this->JqueryValidation->input('eligiblity_position', array('empty'=>'--Select Eligiblity Position--','options'=>array('Eligible'=>'Eligible','Not Eligible'=>'Not Eligible'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyEligiblityPosition')))); 
							    
							?>
						</div>
					</div>
				
				<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Remarks</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->JqueryValidation->input('remarks_by_officer', array('placeholder'=>'Remarks.....','label'=>false,'rows'=>4,'class'=>'form-control','rangeLength'=>array(3,500),'maxlength'=>500,'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','escape'=>true,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UserAppliedVacancyRemarksByOfficer')))); ?>
						</div>
					</div>					
				</div>
				
           </div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Update Applicant Summary</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>	
