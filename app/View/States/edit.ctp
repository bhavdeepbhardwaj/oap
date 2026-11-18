<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit State Name'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('State', array('role' => "form",'class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<div class="box-body">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group <?php echo $this->Form->isFieldError('state_name') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">State Name</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('state_name', array('placeholder'=>'Name Of State', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,40),'class'=>"form-control", "maxlength"=>20,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'StateStateName')))); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-primary">Edit State Name</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>