<div class="row">
	<div class="col-xs-12">
	    <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Add New State'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Form->create('State', array('role' => "form",'class' => 'jquery-validation')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group <?php echo $this->Form->isFieldError('state_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">State Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('state_name', array('placeholder'=>'Name Of State', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,40),'class'=>"form-control", "maxlength"=>40,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'StateStateName')))); ?>
						</div>
					</div>			
							
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Add State</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>