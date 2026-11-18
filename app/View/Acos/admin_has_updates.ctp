<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Synchronize Controllers and Actions'); ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="callout callout-warning">
                                <?php echo __d('acl', '<p>Some controllers have been modified, resulting in actions that are not referenced as ACO in the database or ACO records that are obsolete</p>');?>
                            </div>
                            <div class="row">
                                    <div class="col-md-12">
					<div class="alert alert-info alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4><i class="icon fa fa-info"></i> Alert!</h4>
                                                <?php
					
                                                echo __d('acl', 'Please be aware that this message will appear only once. But you can always rebuild the ACOs by going to the ACO tab.');
					
                                                ?>
                                          </div>
					
                                    </div>	
				</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
					
					echo '<h3>' . __d('acl', 'Missing ACOs') . '</h3>';
					if(count($missing_aco_nodes) > 0)
					{
						
					
						echo '<p>';
						echo $this->Html->nestedList($missing_aco_nodes,array('class'=>'todo-list'));
						echo '</p>';
					}
                                        else
                                        {
                                            
                                     ?>
                                            <div class="callout callout-success">There is no missing Aco node.</div>
                                    <?php
                                        }
                                    ?>    
                                </div>
                                <div class="col-md-6">
                                    <?php
					
					echo '<h3>' . __d('acl', 'Obsolete ACOs') . '</h3>';
					if(count($nodes_to_prune) > 0)
					{
						
						
						echo '<p>';
						echo $this->Html->nestedList($nodes_to_prune,array('class'=>'todo-list'));
						echo '</p>';
					}
                                        else
                                        {
                                    ?>
                                            <div class="callout callout-success">There is no Aco node to obsolete.</div>
                                    <?php
                                        }
                                    ?>    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right"> <a href="<?php echo $this->Html->url(array('controller'=>'acos','action'=>'synchronize','run'));?>" class="btn btn-info">Synchronize Acos Now</a></div>
                                   
                                </div>
                            </div>
				
			</div>
		</div>
	</div>
</div>

