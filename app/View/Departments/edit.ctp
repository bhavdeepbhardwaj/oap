<div class="row">
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Department Name'); ?></h3><div class="asteriskLine"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('Department', array('role' => "form",'class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group <?php echo $this->Form->isFieldError('department_name') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Department Name</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('department_name', array('placeholder'=>'Name Of Department', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,40),'class'=>"form-control", "maxlength"=>40,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit Department Name</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	                        <!-- Help -->
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-fw fa-question-circle"></i>
				<h3 class="box-title">Help</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<blockquote>
					<p>Department Name</p>
					<small>Here we will Edit those Departments that we have already added .</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>