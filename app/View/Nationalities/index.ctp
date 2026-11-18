<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Nationalities</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Nationality</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				
				<?php $i=1;foreach ($nationalities as $nationality): ?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo ucfirst(h($nationality['Nationality']['nationality_name'])); ?></td>
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit', $nationality['Nationality']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>