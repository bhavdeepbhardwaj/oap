<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">User Records</h3>
			</div><!-- /.box-header -->
			
			<div class="box-body table-responsive">
				<div class="no-print">
				<?php echo $this->Form->create('User', array('role' => "form",'class' => 'jquery-validation','type'=>'get','action'=>'index'));?>
				<!--div class="row"-->
					<div class="col-xs-3">
						<div class="form-group">
							<?php echo $this->Form->input('email', array('empty'=>'-- Select Email Id -- ','label'=>false,'placeholder'=>'Email Id','required'=>false,'class'=>"form-control",'div' => false)); // empty creates blank option.?>
						</div>
					</div>
					<?php if($this->Session->read('Auth.User.Group.name')=='Super Admin') {?>
					<div class="col-xs-1">
						Or
					</div>
					<div class="col-xs-3">
						<div class="form-group">
							<?php //echo $this->Form->input('organization_id',array('empty'=>'-- Select Organization --','div' => false, 'label'=>false,'required'=>false,'placeholder'=>'First Name','class'=>"form-control"));?> 
							<?php 
								$selOrganization='all';
								if(isset($this->request->query['organization_id']))
								$selOrganization=$this->request->query['organization_id'];
							?>    
							<?php echo $this->Form->input('organization_id', array('type'=>'select', 'options' =>array(array_replace(array('all'=>'All Organizations'),$organizations)),'value'=>$selOrganization,'label'=>false,'class'=>"form-control")); ?>
						</div>
					</div>
					<?php }?>
					<div class="col-xs-5">
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Search</button>
							
						</div>
					</div>
				<!--/div-->
				<?php echo $this->Form->end();
				?>
				</div>
				<table  class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Name</th>
							<th>Email Id</th>
							<th>Mobile Number</th>
							<th>Organization</th>
							<th>Role Alloted</th>
			
							<?php if($this->Session->read('ACL1.Users.edit_user')){?>
							<th>Actions</th><?php }?>
						</tr>
					</thead>
					<tbody>
					<?php 
					$page = $this->request->params['paging']['User']['page'];
					$limit = $this->request->params['paging']['User']['limit'];
					$i = ($page-1) * $limit;
					if(!empty($users)){
					foreach ($users as $user): $i++;?>
						<tr><?php //pr($user);?>
							<td><?php echo $i;?></td>
							<td><?php echo h($user['User']['u_name_title'].' '.$user['User']['f_name'].' '.$user['User']['l_name']).'<br/><b>UserName:</b>'.h($user['User']['username']);?>
							
							</td>
							<td><?php echo h($user['User']['email']); ?></td>
							<td>
								<?php echo h($user['User']['mobile_number']); ?>
							</td>
							<td>
								<?php echo h($user['Organization']['organization_name']); ?>
							</td>
							<td>
								<?php echo h($user['Group']['name']);?>
							</td>
							<td>
							    <?php 
                                    if($user['Group']['level']>$this->Session->read('Auth.User.Group.level'))
                                      {									
								       echo $this->Html->link(false, array('action' => 'edit_user', $user['User']['id']), array( 'class'=>'fa fa-fw fa-edit','title'=>'Edit')); 
								      }
								    else{
                                         echo h('You are not authorised to edit details of this user');
									 }									
								?>							
						    </td>
						</tr>
					<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['User']['pageCount'] > 1){ ?>
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
			</div><!-- /.box-body -->
		</div>
	</div>
</div>