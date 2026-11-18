<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Add New Essential'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory</div>
			</div>
			<?php echo $this->Form->create('Essential', array('role' => 'form','class' => 'jquery-validation')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('essential') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Essential Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('essential', array('placeholder'=>'Essential Name....', 'label'=>false,'class'=>'form-control','required'=>true,'rows'=>2,'pattern'=>'^[a-zA-Z\n\s,.]+$','rangeLength'=>array(3,255),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'EssentialEssential')))); ?>
						</div>
					</div>					
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Add Essential</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>