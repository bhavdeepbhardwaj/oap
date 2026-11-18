<?php //pr($applicantDesignations); exit; ?>
<?php //pr($informationUsers); exit; ?>
<div class="row">
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Update Status Of Applicant'); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('UserAppliedVacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<div class="box-body">
			    <div class="row">
				  <div class="col-md-12">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant Current Organization</label><span class="asterisk">*</span>
							</div>
							<?php echo $this->Form->input('currentOrganization',array('label'=>false,'value'=>$applicants['InformationUser']['current_organization'],'class'=>'form-control','required'=>true,'disabled'=>'disabled')); ?>
						</div>
					</div>
				</div>
				<div class="row">
				  <div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant Name</label><span class="asterisk">*</span>
							</div>
							<?php echo $this->Form->input('User.userName', array('label'=>false,'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant Designation</label><span class="asterisk">*</span>
							</div>
							<?php echo $this->Form->input('presentPost', array('label'=>false,'value'=>$applicants['InformationUser']['present_post'],'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
				</div>
				<div class="row">
				   <div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Applicant Email Id</label><span class="asterisk">*</span>
							</div>
							<?php echo $this->Form->input('User.email', array('label'=>false,'class'=>'form-control','disabled'=>'disabled')); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Status</label><span class="asterisk">* </span>
							</div>
							<?php echo $this->Form->input('status', array('empty'=>'--Select Status--','options'=>array('Under Consideration'=>'Under Consideration','Accepted'=>'Accepted','Call for Interview'=>'Call for Interview','Rejected'=>'Rejected'),'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>	
                </div>				
				<div class="row">
                <div class="col-md-12">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Comments</label><span class="asterisk text-red">*</span>
							</div>
							<?php echo $this->Form->input('comments', array('placeholder'=>'Write Comments/Remarks for Applicant.....','label'=>false,'rows'=>4,'class'=>'form-control','required'=>true)); ?>
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
					<small>Here Selected Status will be displayed to user.</small>
				</blockquote>
				<blockquote>
					<p>Comments</p>
					<small>Here you can write Comments/Remarks for applicant with respect to status.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>	
