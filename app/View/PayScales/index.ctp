<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Pay Scales</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Pay Scale</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				
				<?php $i=1;foreach ($payscales as $payscale): ?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo ucfirst(h($payscale['PayScale']['pay_scale'])); ?></td>
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit', $payscale['PayScale']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>