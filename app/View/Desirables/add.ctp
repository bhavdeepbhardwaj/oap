<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Add New Desirable'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Form->create('Desirable', array('role' => 'form','class' => 'jquery-validation')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('desirable') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Desirable Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('desirable', array('placeholder'=>'Desirable Name....', 'label'=>false,'class'=>'form-control','required'=>true,'rows'=>2,'pattern'=>'^[a-zA-Z\n\s,.]+$','rangeLength'=>array(3,255),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DesirableDesirable')))); ?>
						</div>
					</div>			
							
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Add Desirable</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>