<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo sprintf(__("Edit %s permissions"), $aroAlias); ?></h3>
			</div><!-- /.box-header -->
			<?php echo $this->Form->create('mypermission', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('aco_id', array('type' => 'hidden','value'=>$action['Aco']['id'])); ?>			
			<div class="box-body table-responsive">
			
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>Action</th>
							<?php foreach ($aros as $aro): ?>
							<?php $aro = array_shift($aro); ?>
							<th><?php echo h($aro[$aroDisplayField]); ?></th>
							
							<?php endforeach; ?>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<b><?php echo h($Controller['Aco']['alias']);?></b>
			
							</td>
							
							
						</tr>
						<tr>
							<td>
								<?php echo h($action['Aco']['alias']);?>
			
							</td>
							<?php
							foreach ($aros as $aro):
							$aro = array_shift($aro);//pr($action['Aro']);exit;
							?>
							<td>
								<?php
								$entryFound=false;
								foreach($action['Aro'] as $currAro)
								{
									
									
									if($aro['id']==$currAro['foreign_key'])
									{
										//echo $aro['id'];
										$allowed= $currAro['Permission']['_create'];
										if($allowed== -1)
										$allowed=0;
										//$icon = $this->Html->image(($allowed ? 'test-pass-icon.png' : 'test-fail-icon.png'));
										echo $this->Form->input('mypermission.Aro.'.$aro['id'], array(
																			'options' => array('1'=>'Allowed','0'=>'Not Allowed'),
																			
																			'selected'=>$allowed,
																			'label'=>false
																		));
										$entryFound=true;
										break;
									}
								}
								//echo $icon
								if($entryFound==false)
								{
									echo $this->Form->input('mypermission.Aro.'.$aro['id'], array(
																			'options' => array('1'=>'Allowed','0'=>'Not Allowed'),
																			
																			'selected'=>0,
																			'label'=>false
																		));
								}
								?>
			
							</td>
							<?php
							endforeach;
							?>
						</tr>						
					</tbody>
				</table>	
			
			</div>
			<div class="box-footer clearfix">
				<button type="button" class="btn btn-primary"  onclick="location.href='<?php echo $this->request->referer();?>';">Go Back to User Role Permissions</button>
				<button type="submit" class="btn btn-primary pull-right">Update Permissions</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>	