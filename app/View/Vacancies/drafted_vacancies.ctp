<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Anticipated Vacancies</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<!--th>Reference Number</th-->
						<th>Advertisement Title</th>
						<th>Post's Name</th>
					    <th>Opening Date</th>
						<th>Closing Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($draftedVacancies as $draftedVacancy): ?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo h($draftedVacancy['Notice']['advt_number']); ?></td>
						<!--td><?php //echo ($draftedVacancy['Notice']['reference_number']); ?></td-->
						<td><?php echo ucfirst(h($draftedVacancy['Notice']['advt_name'])); ?></td>
						<td><?php echo ucfirst(h($draftedVacancy['Post']['post_name'])); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($draftedVacancy['Notice']['opening_date']))); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($draftedVacancy['Notice']['closing_date']))); ?></td>
						<td>
							<?php echo $this->Html->link(false,array('action' => 'view_drafted_vacancy', $draftedVacancy['Vacancy']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'View')); ?> View							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>