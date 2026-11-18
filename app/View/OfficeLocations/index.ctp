<?php //pr($officelocations);?>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Office Locations</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Organization Name</th>
						<th>Office Location Name</th>
						<th>Office Location Address</th>
						<th>Departments Assigned</th>
						<th>State Name</th>
                        <th>City Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
			
				<?php $i=1;foreach ($officelocations as $officelocation):?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo ucfirst(h($officelocation['Organization']['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($officelocation['OfficeLocation']['location_name'])); ?></td>
						<td><?php echo ucfirst(h($officelocation['OfficeLocation']['location_address'])); ?></td>
						<td>
						  <?php foreach($officelocation['Department'] as $department):
						      
							  echo h($department['department_name'].' , ');
							  
							 endforeach;						 
							?>					  
						</td>
						<td><?php echo ucfirst(h($officelocation['State']['state_name'])); ?></td>
						<td><?php echo ucfirst(h($officelocation['City']['city_name'])); ?></td>
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit', $officelocation['OfficeLocation']['id']), array('class'=>'fa fa-fw fa-edit','title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>