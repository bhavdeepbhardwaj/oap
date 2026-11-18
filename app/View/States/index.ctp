<div class="row">
	<div class="col-xs-12">
		<div class="box">
		  
			<div class="box-header">
				<h3 class="box-title">States</h3>
		
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>State Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($states as $state): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($state['State']['state_name'])); ?></td>
						
							<td><?php echo $this->Html->link(false, array('action' => 'edit', $state['State']['id']), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit')); ?>Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
				</tbody>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>