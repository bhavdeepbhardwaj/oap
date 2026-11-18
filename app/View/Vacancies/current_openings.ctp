<?php //pr($approvedVacancies);
//pr($alreadyApplied); ?>
<div class="row">
<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Vacancies</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Name</th>
						<th>Post's Name</th>
						<th>Organization Name</th>
						<th>Method of Recruitment</th>
						<th>Closing Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$page = $this->request->params['paging']['Vacancy']['page'];
				$limit = $this->request->params['paging']['Vacancy']['limit'];
				$i = ($page-1) * $limit;
				if(!empty($approvedVacancies)){
				foreach ($approvedVacancies as $approvedVacancy):
				$i++;
				?>
				
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo h($approvedVacancy['Notice']['advt_number']); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Notice']['advt_name'])); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Post']['post_name'])); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Organization']['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Vacancy']['recruitment_method'])); ?></td>
						<td><?php echo h(date('d-M-Y',strtotime($approvedVacancy['Notice']['closing_date']))); ?></td>
						<td>
						<?php
						if(!in_array($approvedVacancy['Vacancy']['id'],$alreadyApplied))
						{
                          if($userInfos['InformationUser']['current_status']=='registered')
						    {
							  echo $this->Html->link('Apply',array('controller'=>'users','action'=>'basic_info'),array('class'=>'btn btn-primary btn-xs btn-info'));     						  
							}
						  else if($userInfos['InformationUser']['current_status']=='step1_bi')
                            {
							  echo $this->Html->link('Apply',array('controller'=>'users','action'=>'contact_details'),array('class'=>'btn btn-primary btn-xs btn-info')); 
							} 						  
						  else if($userInfos['InformationUser']['current_status']=='step2_cond')
                            {
							  echo $this->Html->link('Apply',array('controller'=>'user_qualifications','action'=>'add'),array('class'=>'btn btn-primary btn-xs btn-info')); 
							}
						  else if($userInfos['InformationUser']['current_status']=='step3_qd')
                            {
							  echo $this->Html->link('Apply',array('controller'=>'users','action'=>'current_service_details'),array('class'=>'btn btn-primary btn-xs btn-info')); 
							}
						  else if($userInfos['InformationUser']['current_status']=='step4_csd')
                            {
							  echo $this->Html->link('Apply',array('controller'=>'user_employment_details','action'=>'add'),array('class'=>'btn btn-primary btn-xs btn-info')); 
							}
                          else if($userInfos['InformationUser']['current_status']=='step5_expd')
                            {
							  echo $this->Html->link('Apply',array('controller'=>'users','action'=>'doc_upload_part1'),array('class'=>'btn btn-primary btn-xs btn-info')); 
							}
                          else if($userInfos['InformationUser']['current_status']=='step6_pic')
                            {
							  if($approvedVacancy['Post']['post_name']=='Chairman' || $approvedVacancy['Post']['post_name']=='Dy. Chairman') 
                                {						  
						         echo $this->Html->link('Apply',array('controller'=>'service_and_batch_infos','action'=>'info',$approvedVacancy['Vacancy']['id']),array('class'=>'btn btn-primary btn-xs btn-info'));     						  
						        }
	                          else
						       {
                       	        echo $this->Html->link('Apply',array('controller'=>'users','action'=>'other_info',$approvedVacancy['Vacancy']['id']),array('class'=>'btn btn-primary btn-xs btn-info'));     						  	
						       }
							} 
                        }	
                        else 
                          {
						  ?>
						  <button data-toggle="tooltip" data-placement="left" title="You have already applied for this vacancy" class="btn btn-xs btn-info" onclick="javascript:alert('You have already applied for this vacancy')">Apply</button>
						  
						  <?php
						  }						
						  
						  /*if($approvedVacancy['Post']['post_name']=='Chairman' || $approvedVacancy['Post']['post_name']=='Dy. Chairman') 
                            {						  
						      echo $this->Html->link('Apply',array('controller'=>'service_and_batch_infos','action'=>'info',$approvedVacancy['Vacancy']['id']),array('class'=>'btn btn-primary btn-xs btn-info'));     						  
						    }
	                      else
						    {
                       	   echo $this->Html->link('Apply',array('controller'=>'users','action'=>'other_info',$approvedVacancy['Vacancy']['id']),array('class'=>'btn btn-primary btn-xs btn-info'));     						  	
						    }*/
						?>	
						</td>
					</tr>
				<?php endforeach; }
					else{
					
					echo '<tr><td colspan="10">No Records Available.</td></tr>';
					}?>
				</table>
				<?php if($this->params['paging']['Vacancy']['pageCount'] > 1){ ?>
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