<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Post's Names</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Post's Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$page = $this->request->params['paging']['Post']['page'];
				$limit = $this->request->params['paging']['Post']['limit'];
				$i = ($page-1) * $limit;
				if(!empty($posts)){
				foreach ($posts as $post):
				$i++;
				?>
				
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo ucfirst(h($post['Post']['post_name'])); ?></td>
						<td>
							<?php echo $this->Html->link(false, array('action' => 'edit', $post['Post']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Edit')); ?> Edit							
						</td>
					</tr>
				<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['Post']['pageCount'] > 1){ ?>
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