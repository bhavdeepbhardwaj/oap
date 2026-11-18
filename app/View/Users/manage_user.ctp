<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Users Management</h3>
			</div><!-- /.box-header -->
			
			<div class="box-body">
			 <!-- For Organisation -->
				<div class="row">
					
				    <div class="col-md-4"> 
						<div class="form-group">
						<div>
								<label class="text-light-blue">Organization<label><span class="asterisk text-red">* </span>
						</div>
						<?php echo $this->Form->input('organization_id', array('empty' => '--Select Organization--','label'=>false,'class'=>"form-control")); ?>
						</div>
					</div>
				</div>
              </div>				
				
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>User Id</th>
						<th>Department</th>
						<th>User Role</th>
						<th>Mobile Number</th>
						<th>Created On</th>
						<th>Last Modified</th>
						<th>Last Login</th>
						<th>Status</th>
						<th>Delete</th>
						<th>Edit</th>
						<th>Reset Password</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($users as $user): ?>
					<tr>
						<td width="6%"><?php echo $i;?>
						<td width="80%"><?php echo ucfirst(h($user['User']['email'])); ?></td>
						<td width="10%">
							<?php echo $this->Html->link(false, array('action' => 'edit', $group['User']['id']), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>