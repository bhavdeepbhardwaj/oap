<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Vacancies</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Name</th>
						<th>Pay Scale</th>
						<th>Opening Date</th>
						<th>Closing Date</th>
						<th>Year Of Recruitment</th>
						<th>Applicable To</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($viewApplicables as $viewApplicable): ?>
					<tr>
						<td><?php echo $i;?>
						<td><?php echo ucfirst(h($viewApplicable['Notice']['advt_number'])); ?></td>
						<td><?php echo ucfirst(h($viewApplicable['Notice']['advt_name'])); ?></td>
						<td><?php echo ucfirst(h($viewApplicable['PayScale']['pay_scale'])); ?></td>
						<td><?php echo ucfirst(h($viewApplicable['Notice']['opening_date'])); ?></td>
						<td><?php echo ucfirst(h($viewApplicable['Notice']['closing_date'])); ?></td>
						<td width="7%"><?php echo ucfirst(h($viewApplicable['Notice']['year_of_recruitment'])); ?></td>
						<td><?php echo ucfirst(h($viewApplicable['Vacancy']['applicable_to'])); ?></td>
						<td>
							<?php echo $this->Html->link(false, array('action' => 'change_applicable_to', $viewApplicable['Vacancy']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Change')); ?> Change							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>