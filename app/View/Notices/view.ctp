<div class="row">
        <!-- Displaying Advertisements -->
	  <div class="col-md-12">
		<div class="box box-success">
			<div class="box-header">
				<h2 class="box-title">Vacancy Circulars</h2>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Title</th>
						<th>Opening Date</th>
						<th>Closing Date</th>
						<th><center>View</center></th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($notices as $notice): ?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo ucfirst(h($notice['Notice']['advt_number'])); ?></td>
						<td><?php echo ucfirst(h($notice['Notice']['advt_name'])); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($notice['Notice']['opening_date']))); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($notice['Notice']['closing_date']))); ?></td>
					<td><center>
					<?php echo $this->Html->link(false,'/notices/dwnld_adv_at_view/'.$notice['Notice']['id'],array('target' => '_blank','fullBase' => true,'class'=>'fa fa-download')); ?>
					</center></td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>