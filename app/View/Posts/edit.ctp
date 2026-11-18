<div class="row">
	<div class="col-xs-6">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Post Name'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			
			<?php echo $this->Form->create('Post', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-11">
						<div class="form-group <?php echo $this->Form->isFieldError('post_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Post's Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('post_name', array('placeholder'=>'Name of Post', 'label'=>false,'alphabet'=>true,'rangeLength'=>array(3,100),'class'=>'form-control', 'maxlength'=>100,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'PostPostName')))); ?>
						</div>
					</div>			
				</div>
				
           </div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit Post Name</button>
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
					<p>Post's Name</p>
					<small>Here we edit those Posts that comes under Ministry Of Shipping.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>	
