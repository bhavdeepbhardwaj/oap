<?php //pr ($activeApplications); exit; ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">My Active Applications</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr style="background-color:rgb(179,223,248)">
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Applied for Post</th>
						<th>Applied On</th>
						<th>Status</th>
						<th>Remarks</th>
						<th width="12%"><center>Application View</center></th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$page = $this->request->params['paging']['UserAppliedVacancy']['page'];
				$limit = $this->request->params['paging']['UserAppliedVacancy']['limit'];
				$i = ($page-1) * $limit;
				if(!empty($activeApplications)){
				foreach ($activeApplications as $activeApplication):
				$i++;
				?>
				
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo h($activeApplication['Vacancy']['Notice']['advt_number']); ?></td>
						<td><?php echo ucfirst(h($activeApplication['Vacancy']['Post']['post_name'])); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($activeApplication['UserAppliedVacancy']['applied_on']))); ?></td>
						<td class="text-green"><?php echo ucfirst(h($activeApplication['UserAppliedVacancy']['status'])); ?></td>
						<?php if($activeApplication['UserAppliedVacancy']['status']=='Submitted') 
						 {
						?>
						<td>Application Successfully Submitted</td>
						<?php
						 }
						 else
						  {
						?> 
						<td><?php echo ucfirst(h($activeApplication['UserAppliedVacancy']['remarks'])); ?></td>
						<?php
						 }
						?> 
						<td>
							<?php echo $this->Html->link('View', array('action' => 'application_view', $activeApplication['UserAppliedVacancy']['id']), array( 'class'=>'btn btn-block btn-success btn-xs','target'=>'_blank')); ?>						
						</td>
					</tr>
				<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['UserAppliedVacancy']['pageCount'] > 1){ ?>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							<div class="paging_bootstrap">
								<ul class="pagination">
									<?php
									echo $this->Paginator->first("First", array('escape' => false, 'tag' => 'li'),  '<a href="#">First</a>', array('class' => 'first disabled', 'escape' => false, 'tag' => 'li'));
									echo $this->Paginator->prev("&larr; Previous", array('escape' => false, 'tag' => 'li'), '<a href="#">&larr; Previous</a>', array('class' => 'prev disabled', 'escape' => false, 'tag' => 'li'));

									echo '&nbsp;' . $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active','currentTag'=>'a href="#"'));
									echo $this->Paginator->next("Next &rarr;", array('escape' => false, 'tag' => 'li'), '<a href="#">Next &rarr;</a>', array('class' => 'next disabled', 'escape' => false, 'tag' => 'li'));
									echo $this->Paginator->last("Last", array('escape' => false, 'tag' => 'li'), '<a href="#">Last</a>', array('class' => 'last disabled', 'escape' => false, 'tag' => 'li'));
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>  
