<?php
$vacancies=$this->requestAction('dashboard/vacancy_applier_home');
@extract($vacancies);
?>
<?php //pr($userInfos); ?>
<div class="row">
<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Current Openings</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Name</th>
						<th>Post Name</th>
						<th>Applicable To</th>
						<th>Closing Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($approvedVacancies as $approvedVacancy): ?>
					<tr>
						<td><?php echo $i;?>
						<td><?php echo ($approvedVacancy['Notice']['advt_number']); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Notice']['advt_name'])); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Post']['post_name'])); ?></td>
						<td><?php echo ucfirst(h($approvedVacancy['Vacancy']['applicable_to'])); ?></td>
						<td><?php echo date('d-M-Y',strtotime($approvedVacancy['Notice']['closing_date'])); ?></td>
						<td>
						<?php
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
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>