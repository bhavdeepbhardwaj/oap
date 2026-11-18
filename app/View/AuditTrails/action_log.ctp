<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Audit Trail - Login/Logout Log'); ?></h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
                            <?php echo $this->Session->flash('success'); ?>
                            <?php echo $this->Session->flash(); ?>
			<table id="example1" class="table table-bordered table-striped table-responsive">
				<thead >
					<tr>
						<th>S.No.</th>
						<th>Email</th>
                        <th>Process ID</th>
						<th>Action Requested</th>
						<th>Full URL</th>
						<th>Referrer URL</th>
						<th>Requested On(d/m/y) (hh:mm:ss)</th>
						<th>Requested Data Detail</th>
						
					</tr>
				</thead>
		
				<tbody>
				<?php 
				$page = $this->request->params['paging']['ActionLog']['page'];
				$limit = $this->request->params['paging']['ActionLog']['limit'];
				$i = ($page-1) * $limit;
				if(!empty($actionlogs)){
				foreach ($actionlogs as $log):
				$i++;
				?>
				<tr>
					<td><?php echo h($i);?></td>
					<td>
                                            <?php echo h($log['ActionLog']['username']);?>
					</td>
                                  
                                        <td><?php echo h($log['ActionLog']['process_id']); ?></td>
                                        <td><?php echo h($log['ActionLog']['action_requested']); ?></td>
                                        <td><?php echo h($log['ActionLog']['full_url']); ?></td>
                                        <td><?php echo h($log['ActionLog']['refferer_url']); ?></td>
					<td><?php //echo h(date('d/m/y',strtotime($log['ActionLog']['requested_on'])));
					echo h($log['ActionLog']['requested_on']);
					?></td>
					
                                        <td><?php echo 'Encoded serialized Data'; ?></td>
				</tr>
				<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['ActionLog']['pageCount'] > 1){ ?>
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
				</tbody>
			</table>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>
