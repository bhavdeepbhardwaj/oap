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
								<?php //echo $this->Html->link('Change Password', array('controller' => 'users','action' => 'change_password'), array( 'style'=>array('color:#72afd2;'),'title'=>'Change Password','fullBase' => true)); ?>
							<br/>
								<?php //echo $this->Html->link('Change Profile Photo', array('controller' => 'users','action' => 'change_profile_pic'), array( 'style'=>array('color:#72afd2;'),'title'=>'Change Profile Photo','fullBase' => true)); ?>
							</div>
						</div>
					</div>
					
					<div class="col-md-10">
						<div class="box-header">
							<h2 class="box-title text-light-blue">Profile Details</h3>
						</div><br/><!-- /.box-header -->
						<dl class="dl-horizontal">
							<div class="col-md-5">					
								<dt>User Name</dt>
								<dd><?php echo h($user['User']['u_name_title'].' '.$user['User']['f_name'].' '.$user['User']['l_name']);?></dd>
								<dt>User Email Id</dt>
								<dd><?php echo h($user['User']['email']); ?></dd>
								<dt>Organization Name</dt>
								<dd><?php echo h($user['Organization']['organization_name']); ?></dd>
								<dt>Department Name</dt>
								<dd><?php echo h($user['Department']['department_name']); ?></dd>
								<dt>Designation</dt>
								<dd><?php echo h($user['Designation']['designation_name']); ?></dd>
								<dt>Office Location Name</dt>
								<dd><?php echo h($user['OfficeLocation']['location_name']); ?></dd>
								<dt>User Mobile Number</dt>
								<dd><?php echo h($user['User']['mobile_number']); ?></dd>
								
							</div>
							<div class="col-md-5">
								<dt>Office Location Address</dt>
								<dd>	
									<?php //echo h($user['User']['address']);?><br/>
									<?php echo h($user['OfficeLocation']['location_address']);?><br/>
									<?php echo h($user['OfficeLocation']['state_id'].' , '.$user['OfficeLocation']['city_id']);?><br/>
									<?php //echo h($user['Country']['country'].' - '.$employee['User']['pin_code']);?><br/>
									</dd>
									<dt>Contact Details</dt>
									<dd>
									<i class="fa fa-fw fa-envelope-o"></i>
									<?php echo h($user['User']['email']); ?><br/>
									<i class="fa fa-fw fa-mobile-phone"></i>
									<?php echo h($user['User']['mobile_number']); ?><br/>
									<?php //if(!empty($employee['User']['std_code']) && !empty($employee['User']['landline_number'])  && !empty($employee['User']['extension_number'])){?>
									<!-- <i class="fa fa-fw fa-phone"></i> -->
									
									<?php	//echo h($employee['User']['std_code'] . ' - ' .$employee['User']['landline_number'].' (Ext -'.$employee['User']['extension_number'].')'); }
									//else if(!empty($employee['User']['std_code']) && !empty($employee['User']['landline_number'])){
									//echo h($employee['User']['std_code'] . ' - ' .$employee['User']['landline_number']);
									
									//}
									?><br/>
									<?php //if(!empty($employee['User']['fax_number'])){?>
									<!-- <i class="fa fa-fw fa-print"></i> -->
									<?php //echo h($employee['User']['std_code'] . ' - ' .$employee['User']['fax_number']); }?>
									
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
				<h3 class="box-title"><?php echo __('Edit User Level Permissions'); ?></h3>
				
			</div>
			
				<?php echo $this->Form->create('TeamEmployeePermissions', array('role' => "form",'class' => 'jquery-validation')); ?>
				<?php echo $this->Form->input('user_id', array('type' => 'hidden','value'=>$aro_id)); ?>
			<div class="box-body">
				<?php echo $this->Session->flash(); ?>
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>Action</th>
							<th>Denied/Allowed</th>
							<th>Edit Permission</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$page = $this->request->params['paging']['Aco']['page'];
					$limit = $this->request->params['paging']['Aco']['limit'];
					$i = ($page-1) * $limit;
					if(!empty($allControllers))
					{
						foreach ($acos as $controller)
						{
							//pr($controller);
						$i++;
					?>
						<tr>
							<td>
								<b><?php echo h($controller['Aco']['alias']);?></b>
			
							</td>
							
							
						</tr>
						<?php
						foreach($controller['children'] as $action)
						{
						?>
						<tr>
							<td>
								<?php echo h($action['Aco']['alias']);?>
			
							</td>
							
							<td>
								<?php
								//pr($action['Aro']);\
								//pr($employee);exit;
								$aroID=$user['User']['group_id'];
								$arosEmployeeID=$user['User']['id'];
								$allowed1=0;
								$allowed2=0;//pr($action['Aro']);exit;
								foreach($action['Aro'] as $currAro)
								
								{
									
									if($arosEmployeeID==$currAro['foreign_key'] && $currAro['model']=='User')
									{
										$allowed1= $currAro['Permission']['_create'];
										
									}
									if($aroID==$currAro['foreign_key'] && $currAro['model']=='EmployeeRole')
									{
										$allowed2= $currAro['Permission']['_create'];
										
									}									
								}
								//IF user based permission record is to inherit or not found, access will depend on employeerole
								if($allowed1==0)
								{
									$allowed1=$allowed2;
								}
								if($allowed1== -1)
										$allowed1=0;
										
								$icon = $this->Html->image(($allowed1 ? 'test-pass-icon.png' : 'test-fail-icon.png'));
								echo $icon;//exit;
							?>
							<td>
							
								<?php
										if(!$allowed1)
										{
											$newPermissionOptions=array('-1'=>'Keep existing permission','1'=>'Allowed');
										}
										else
										{
											$newPermissionOptions=array('-1'=>'Keep existing permission','0'=>'Not Allowed');
										}
										
										echo $this->Form->input('TeamEmployeePermissions.Aco.'.$action['Aco']['id'], array(
																			'options' => $newPermissionOptions,
																			
																			'selected'=>-1,
																			'label'=>false
																		));
									
								?>							
							</td>
						</tr>						
						
					<?php 
						
							}
						}
					}
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>					
					</tbody>
				</table>	
			</div>
			<div class="box-footer">
			<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							<button type="submit" class="btn btn-primary">Update Permissions</button>
						</div>
					</div>
			</div>		
				
				<?php if($this->params['paging']['Aco']['pageCount'] > 1){ ?>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							<div class="paging_bootstrap">
								<ul class="pagination">
									<?php
									echo $this->Paginator->first("First", array('escape' => false, 'tag' => 'li'),  '<a href="#">First</a>', array('class' => 'first disabled', 'escape' => false, 'tag' => 'li'));
									echo $this->Paginator->prev("&larr; Previous", array('escape' => false, 'tag' => 'li'), '<a href="#">&larr; Previous</a>', array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));

									echo '&nbsp;' . $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active','currentTag'=>'a href="#"'));
									echo $this->Paginator->next("Next &rarr;", array('escape' => false, 'tag' => 'li'), '<a href="#">Next &rarr;</a>', array('class' => 'next disabled', 'escape' => false, 'tag' => 'li'));
									echo $this->Paginator->last("Last", array('escape' => false, 'tag' => 'li'), '<a href="#">Last</a>', array('class' => 'last disabled', 'escape' => false, 'tag' => 'li'));
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>		
			</div>
			<?php echo $this->Form->end(); ?>
		</div>	
	</div>
</div>