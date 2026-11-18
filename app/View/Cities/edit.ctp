<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit City '); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('City', array('role' => "form",'class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<div class="box-body">
					<div class="row">
					               <!-- Select State -->
								   
					<div class="col-md-6">
							<div class="form-group <?php echo $this->Form->isFieldError('state_id') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">State Name</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('state_id', array('empty'=>'-- Select State --','label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'CityStateId')))); ?>
							</div>
					</div>
					
	                              <!--Edit City -->				
						<div class="col-md-6">
							<div class="form-group <?php echo $this->Form->isFieldError('city_name') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">City Name</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('city_name', array('placeholder'=>'Name Of City', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,20),'class'=>"form-control", "maxlength"=>20,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'CityCityName')))); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit City</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>