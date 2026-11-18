<div class="row">
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit System Role'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('Group', array('role' => "form",'class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group <?php echo $this->Form->isFieldError('name') ? 'has-error' : '' ?>">
								<div>
									<label class="text-light-blue">Role Name</label><span class="asterisk text-red">* </span>
								</div>
								<?php echo $this->JqueryValidation->input('name', array('placeholder'=>'System Role', 'label'=>false,'alphabetspace'=>true,'rangeLength'=>array(3,20),'class'=>'form-control', 'maxlength'=>20,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'GroupName')))); ?>
							</div>
						</div>
					</div>
					
					<!-- Select Level -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('level') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Level</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('level', array('empty'=>'--Select Level --','label'=>false,'class'=>'form-control','required'=>true,'type'=>'select','options' =>$levelOptions,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'GroupLevel')))); ?>
						</div>
					</div>			
							
				</div>
				
				                               <!-- Select Dependency -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('dependency') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Dependency</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('dependency', array('empty'=>'--Select Dependency --','label'=>false,'class'=>'form-control','type'=>'select','options' => array('organization'=>'Organization','none' => 'None'),'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'GroupDependency')))); ?>
						</div>
					</div>			
							
				</div>
				
			</div>
				<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit System Role</button>
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
					<p>Role Name</p>
					<small>Roles records are the set of the roles that are used under Ministry Of Shipping (NIC).</small>
				</blockquote>
				<blockquote>
					<p>Level</p>
					<small>At what level you want to create roles .</small>
				</blockquote>
				<blockquote>
					<p>Dependency</p>
					<small>Here role will be made Dependent or Independent of Organization .</small>
				</blockquote>
			</div>
		</div>
	</div>
</div>