<div class="row">
	<div class="col-xs-12">
	  <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Designation'); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('Designation', array('role' => "form",'class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<div class="box-body">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group <?php echo $this->Form->isFieldError('designation_name') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Designation Name</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('designation_name', array('placeholder'=>'Designation', 'label'=>false,'pattern'=>'^[a-zA-Z\s.]+$','rangeLength'=>array(3,30),'class'=>"form-control", "maxlength"=>30,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DesignationDesignationName')))); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-primary">Edit Designation</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>