<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Add Cadre'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Form->create('Cadre', array('role' => 'form','class' => 'jquery-validation')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('cadre_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Cadre</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('cadre_name', array('placeholder'=>'Cadre Name....', 'label'=>false,'class'=>'form-control','required'=>true,'alphabetspace'=>true,'maxlength'=>100,'rangeLength'=>array(3,100),'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'CadreCadreName')))); ?>
						</div>
					</div>			
							
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>