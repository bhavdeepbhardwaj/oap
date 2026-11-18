<div class="row">
	<div class="col-xs-6">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Enter Organization Name'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div><div class="asteriskLine text-bold text-green">Once your Organization Name will be saved,you will be logged out automatically and after that you can login again to continue</div>
			</div>
			
			<?php echo $this->Form->create('InformationUser',array('role' => "form",'url'=>array('controller'=>'users','action'=>'update_organization_name'),'class'=>'jquery-validation')); ?>	
			<?php //echo $this->Form->input('InformationUser.id',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group<?php echo $this->Form->isFieldError('other_orgn_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Organization Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->Form->input('other_orgn_name', array('placeholder'=>'Enter Organization Name','label'=>false,'class'=>'form-control','maxlength'=>60,'rangeLength'=>array(3,60),'alphabetspace'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'InformationUserOtherOrgn')))); ?>
						</div>
					</div> 
				</div>
					
                			
				
				
			</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Save</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>