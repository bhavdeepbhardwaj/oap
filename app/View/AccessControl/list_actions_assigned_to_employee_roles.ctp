<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo sprintf(__("%s permissions"), $aroAlias); ?></h3>
			</div><!-- /.box-header -->
			
			<div class="box-body table-responsive">
				
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>Action</th>
							<?php foreach ($aros as $aro): ?>
							<?php $aro = array_shift($aro); ?>
							<th><?php echo h($aro[$aroDisplayField]); ?></th>
							
							<?php endforeach; ?>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$page = $this->request->params['paging']['Aco']['page'];
					$limit = $this->request->params['paging']['Aco']['limit'];
					$i = ($page-1) * $limit;
					if(!empty($allControllers)){
					foreach ($acos as $controller): $i++;
					//pr($controller); exit;?>
						<tr>
							<td>
								<b><?php echo h($controller['Aco']['alias']);?></b>
			
							</td>
							
							
						</tr>
						<?php
						foreach($controller['children'] as $action):
						?>
						<tr>
							<td>
								<?php echo h($action['Aco']['alias']);?>
			
							</td>
							<?php
							foreach ($aros as $aro):
							$aro = array_shift($aro);
							?>
							<td>
								<?php
								$entryFound=false;
								foreach($action['Aro'] as $currAro)
								{
									//pr($currAro);
									if($aro['id']==$currAro['foreign_key'])
									{
										$allowed= $currAro['Permission']['_create'];
										if($allowed== -1)
										$allowed=0;
										$icon = $this->Html->image(($allowed ? 'test-pass-icon.png' : 'test-fail-icon.png'));
										$entryFound=true;
										break;
									}
								}
							
								
								if($entryFound==false)
								{
									echo $this->Html->image('test-fail-icon.png');
								}
								else{
								echo $icon;
								}
								?>
			
							</td>
							<?php
							endforeach;
							?>
							<td>
							<?php 
							echo $this->Html->link(false, array('action' => 'update_action_access_for_employee_role', $action['Aco']['id'],$page), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit'));
							
							?>
							</td>
						</tr>						
						<?php endforeach;
						?>
					<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['Aco']['pageCount'] > 1){ ?>
				<div class="row">
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
			</div><!-- /.box-body -->
		</div>
	</div>
</div>

