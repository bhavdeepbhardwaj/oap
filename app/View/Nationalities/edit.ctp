<div class="row">
	<div class="col-xs-6">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Nationality'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('Nationality', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-11">
						<div class="form-group <?php echo $this->Form->isFieldError('nationality_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Nationality</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('nationality_name', array('placeholder'=>'Name of Nationality', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>[3,100],'class'=>'form-control', 'maxlength'=>100,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'NationalityNationalityName')))); ?>
						</div>
					</div>			
							
				</div>				
			</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit Nationality</button>
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
					<p>Edit Nationality</p>
					<small>Here we edit those Nationalities that are defined under Government of India.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
	
</div>