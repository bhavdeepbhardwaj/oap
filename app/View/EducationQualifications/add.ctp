<div class="row">
	<div class="col-xs-6">
		<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Add New Education Qualification'); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('EducationQualification', array('role' => "form",'class' => 'jquery-validation')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-11">
						<div class="form-group <?php echo $this->Form->isFieldError('education_qualification') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Educational Qualification</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('education_qualification', array('placeholder'=>'Name of Education Qualification', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,100),'class'=>'form-control', 'maxlength'=>100,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'EducationQualificationEducationQualification')))); ?>
						</div>
					</div>			
				</div>
				
           </div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Add Educational Qualification</button>
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
					<p>Educational Qualifications</p>
					<small>Here we add those Education Qualifications that are required at the time of Recruitment.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>	
