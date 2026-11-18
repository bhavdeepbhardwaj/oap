<div class="row">
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Organization'); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('Organization', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Organization Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('organization_name', array('placeholder'=>'Name of Organization', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,50),'class'=>'form-control', 'maxlength'=>50,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OrganizationOrganizationName')))); ?>
						</div>
					</div>			
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_type') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Organization Type</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('organization_type', array('empty'=>'--Select Type of Organization--', 'options'=>array('MOS'=>'MOS','Non-MOS'=>'Non-MOS'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OrganizationOrganizationType')))); ?>
						</div>
					</div>		
				</div>				
			</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit Organization</button>
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
					<p>Edit Organization Name</p>
					<small>Here we edit those Organizations that we have added under Ministry Of Shipping.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
	
</div>9