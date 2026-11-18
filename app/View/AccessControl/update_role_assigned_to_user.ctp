<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-xs-2">
						<div class="image">
							<?php
							//echo $this->Html->image('/img/userimages/'.$user['User']['user_image'], array('alt' => 'User Image','fullBase' => true),array('escapeTitle' => false));
							?><br/>
							<br/>
							<div class="text-center">
								<?php //echo $this->Html->link('Change Password', array('controller' => 'employees','action' => 'change_password'), array( 'style'=>array('color:#72afd2;'),'title'=>'Change Password','fullBase' => true)); ?>
							<br/>
								<?php //echo $this->Html->link('Change Profile Photo', array('controller' => 'employees','action' => 'change_profile_pic'), array( 'style'=>array('color:#72afd2;'),'title'=>'Change Profile Photo','fullBase' => true)); ?>
							</div>
						</div>
					</div>
					
					<div class="col-md-10">
						<div class="box-header">
							<h2 class="box-title text-light-blue">Profile Details</h2>
						</div><br/><!-- /.box-header -->
						<dl class="dl-horizontal">
							<div class="col-md-5">					
								<dt>User Name</dt>
								<dd><?php echo h($user['User']['u_name_title'].' '.$user['User']['f_name'].' '.$user['User']['l_name']);?></dd>
								<dt>User Id</dt>
								<dd><?php echo h($user['User']['email']); ?></dd>
								<dt>Organization</dt>
								<dd><?php echo h($user['Organization']['organization_name']); ?></dd>
								<dt>Department</dt>
								<dd><?php echo h($user['Department']['department_name']); ?></dd>
								<dt>Designation</dt>
								<dd><?php echo h($user['Designation']['designation_name']); ?></dd>
								<dt>Office Location Name</dt>
								<dd><?php echo h($user['OfficeLocation']['location_name']); ?></dd>
								<dt>User Mobile Number</dt>
								<dd><?php echo h($user['User']['mobile_number']); ?></dd>
							</div>
							<div class="col-md-5">
								<dt>Office  Location  Address</dt>
								<dd>	
									<?php //echo h($user['User']['address']);?><!--br/-->
									<?php echo h($user['OfficeLocation']['location_address']);?><br/>
									<?php echo h($user['OfficeLocation']['state_id'].' , '.$user['OfficeLocation']['city_id']);?><br/>
									</dd>
									<dt>Contact Details</dt>
									<dd>
									<i class="fa fa-fw fa-envelope-o"></i>
									<?php echo h($user['User']['email']); ?><br/>
									<i class="fa fa-fw fa-mobile-phone"></i>
									<?php echo h($user['User']['mobile_number']); ?><br/>
									<?php //if(!empty($user['Employee']['std_code']) && !empty($user['Employee']['landline_number'])  && !empty($user['Employee']['extension_number'])){?>
									<!-- <i class="fa fa-fw fa-phone"></i> -->
									
									<?php//	echo h($user['Employee']['std_code'] . ' - ' .$user['Employee']['landline_number'].' (Ext -'.$user['Employee']['extension_number'].')'); }
								//	else if(!empty($user['Employee']['std_code']) && !empty($user['Employee']['landline_number'])){
									//echo h($user['Employee']['std_code'] . ' - ' .$user['Employee']['landline_number']);
									
								//	}
									?><br/>
									<?php //if(!empty($user['Employee']['fax_number'])){?>
									<!--i class="fa fa-fw fa-print"></i-->
									<?php //echo h($user['Employee']['std_code'] . ' - ' .$user['Employee']['fax_number']); }?>
									
									</dd>
								</div>
							</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Edit User Role'); ?></h3>
				
			</div>
			<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('User', array('role' => 'form','class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">User Role</label><span class="asterisk">* </span>
							</div>
						<?php echo $this->Form->input('group_id', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Edit Role</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>	
	</div>
</div>