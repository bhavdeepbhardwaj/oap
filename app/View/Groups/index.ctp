<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">System Roles</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>System Role</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($groups as $group): ?>
					<tr>
						<td width="6%"><?php echo h($i);?>
						<td width="80%"><?php echo ucfirst(h($group['Group']['name'])); ?></td>
						<td width="10%">
							<?php echo $this->Html->link(false, array('action' => 'edit', $group['Group']['id']), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>