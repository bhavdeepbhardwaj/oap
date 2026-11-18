<div class="row">			  
	<div class="col-md-12">
		<!--div class="box box-primary"-->
			<div class="box-header">
				<h3><center>Vacancies</center></h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Title</th>
						<th>Post's Name</th>
						<th>Method of Recruitment</th>
						<th>Closing Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($vacancies as $vacancy): ?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo ucfirst(h($vacancy['Notice']['advt_number'])); ?></td>
					    <!--td><?php //echo $this->Html->link(h($vacancy['Notice']['advt_name']),array('controller'=>'vacancies','action'=>'view_vacancy',$vacancy['Vacancy']['id']),array('target'=>'_blank'));?></td-->
						<td><?php echo ucfirst(h($vacancy['Notice']['advt_name']));?></td>
						<td><?php echo ucfirst(h($vacancy['Post']['post_name'])); ?></td>
						<td><?php echo ucfirst(h($vacancy['Vacancy']['recruitment_method'])); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($vacancy['Notice']['closing_date']))); ?></td>
					    <td><button type="submit" class="btn btn-info login-model btn-xs">Apply</button></td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		<!--/div-->
	</div>
  </div>			