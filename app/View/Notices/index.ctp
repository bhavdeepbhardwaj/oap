<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Vacancy Circulars</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<!--th>Reference Number</th-->
						<th>Advertisement Title</th>
						<th>Opening Date</th>
						<th>Closing Date</th>
						<th>Year of Recruitment</th>
						<th>Advertisement</th>
						<th>Vacancy Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$page = $this->request->params['paging']['Notice']['page'];
				$limit = $this->request->params['paging']['Notice']['limit'];
				$i = ($page-1) * $limit;
				if(!empty($notices)){
				foreach ($notices as $notice):
				$i++;
				?>
				
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo h($notice['Notice']['advt_number']); ?></td>
						<!--td><?php //echo ($notice['Notice']['reference_number']); ?></td-->
						<td><?php echo ucfirst(h($notice['Notice']['advt_name'])); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($notice['Notice']['opening_date']))); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($notice['Notice']['closing_date']))); ?></td>
						<td><?php echo h($notice['Notice']['year_of_recruitment']); ?></td>
						<td>
						<center><?php echo $this->Html->link(false,'/notices/download_advertisement/'.$notice['Notice']['id'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?></center>
						</td>
						<td><?php echo h($notice['Notice']['vacancy_creation_status']); ?></td>
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit', $notice['Notice']['id']), array( 'class'=>'fa fa-edit','title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['Notice']['pageCount'] > 1){ ?>
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