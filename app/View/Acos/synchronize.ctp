<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Synchronize Controllers and Actions'); ?></h3>
				
			</div>
			<?php
			if(isset($missing_aco_nodes) || isset($nodes_to_prune))
			{
			?>
			<div class="box-body">
				<div class="row">
					<?php
					if(count($missing_aco_nodes)>0 || count($nodes_to_prune) > 0)
					{
						$has_aco_to_sync = false;
					?>
					<div class="col-xs-6">			
						
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>Missing Acos</th>
								  
									</tr>
								</thead>
								<tbody>
									<?php
									
									if(count($missing_aco_nodes) > 0)
									{
										$serialIndex=1;
										foreach($missing_aco_nodes as $missing_aco_node)
										{
											echo '<tr>';
											echo '<td>'.$serialIndex.'</td>';
											echo '<td>'.$missing_aco_node.'</td>';
											echo '</tr>';
											$serialIndex++;
										}
											
									
										$has_aco_to_sync = true;
									}	
									else
									{
										echo '<tr><td>There is no missing aco to synchronize.</td></tr>';
									}
									?>
								</tbody>
							</table>
							
									
					</div>
					<div class="col-xs-6">			
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S.NO</th>
										<th> 	Obsolete ACO nodes</th>
								  
									</tr>
								</thead>
								<tbody>
									<?php
									
									if(count($nodes_to_prune) > 0)
									{
										$serialIndex=1;
										foreach($nodes_to_prune as $node_to_prune)
										{
											echo '<tr>';
											echo '<td>'.$serialIndex.'</td>';
											echo '<td>'.$node_to_prune.'</td>';
											echo '</tr>';
											$serialIndex++;
										}
											
									
										$has_aco_to_sync = true;
									}
									else
									{
										echo '<tr><td>There is no obsolete aco node.</td></tr>';
									}									
									?>
								</tbody>
							</table>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			<?php
			}
			?>
			<div class="box-footer clearfix">
				<?php
				if(isset($has_aco_to_sync) && $has_aco_to_sync)
				{
					echo '<div class="col-md-8"><div class="alert alert-info">';
					echo __d('acl', 'Clicking the link will not change or remove permissions for existing actions ACOs.');
					echo '</div></div>';
					echo '<div class="col-md-2">';
					echo $this->Html->link('Synchronize', '/acos/synchronize/run', array('escape' => false,'class'=>"btn btn-primary pull-right"));
					echo '</div>';
				
				}
				else
				{
                                ?>    
                                    <div class="row">	
                                        <div class="col-md-12">
                                            <div class="alert alert-info">
                                                <?php echo __d('acl', 'Acos have been synchronized.');?>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row">	
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <a href="<?php echo $this->Html->url(array('controller'=>'dashboard','action'=>'index'));?>" class="btn bg-purple btn-flat">Go to Dashboard</a>
                                            </div>
                                        </div>
                                    </div> 
                                        
                                <?php        
				}
				?>
			</div>
		</div>	
	</div>
</div>			