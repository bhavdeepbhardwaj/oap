<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Vacancies</h3>
			</div><!-- /.box-header -->
			<div class="box-body table table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Title</th>
						<th>Post's Name</th>
						<th>Department's Name</th>
						<th>Pay Scale</th>
						<th>Opening Date</th>
						<th>Closing Date</th>
						<th>Method of Recruitment</th>
						<th>Year of Recruitment</th>
						<th>Application Remain Active Upto</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$page = $this->request->params['paging']['Vacancy']['page'];
				$limit = $this->request->params['paging']['Vacancy']['limit'];
				$i = ($page-1) * $limit;
				if(!empty($vacancies)){
				foreach ($vacancies as $vacancy):
				$i++;
				?>
				
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo h($vacancy['Notice']['advt_number']); ?></td>
						<td><?php echo ucfirst(h($vacancy['Notice']['advt_name'])); ?></td>
						<td><?php echo ucfirst(h($vacancy['Post']['post_name'])); ?></td>
						<td><?php echo ucfirst(h($vacancy['Department']['department_name'])); ?></td>
						<td><?php echo h($vacancy['PayScale']['pay_scale']); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($vacancy['Notice']['opening_date']))); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($vacancy['Notice']['closing_date']))); ?></td>
						<td><?php echo h($vacancy['Vacancy']['recruitment_method']); ?></td>
						<td><?php echo h($vacancy['Notice']['year_of_recruitment']); ?></td>
						<td><?php
                               if($vacancy['Vacancy']['active_upto']!=Null)						
						         echo h(date('d-M-Y',strtotime($vacancy['Vacancy']['active_upto'])));
						       else
							    echo h($vacancy['Vacancy']['active_upto']);
							  ?>
						</td>	  
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit', $vacancy['Vacancy']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>	
				</table>
				<?php if($this->params['paging']['Vacancy']['pageCount'] > 1){ ?>
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
				<?php } ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>