<div class="row">
	<div class="col-xs-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit Pay Scale'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('PayScale', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-11">
						<div class="form-group <?php echo $this->Form->isFieldError('pay_scale') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Post Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('pay_scale', array('placeholder'=>'eg. 9000-12000', 'label'=>false,'class'=>'form-control','pattern'=>'^[1-9][0-9]{3,6}[-]{1}[1-9][0-9]{3,6}','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'PayScalePayScale')))); ?>
						</div>
					</div>			
				</div>
				
           </div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Edit Pay Scale</button>
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
					<p>Pay Scale</p>
					<small>Here we edit those Pay Scales that we have already created.</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>	
