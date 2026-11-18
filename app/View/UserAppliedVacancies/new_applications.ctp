<script>
  $(function(){  
      
	  
	  function getpostsByType(postId)
	   {
	    $.post('<?php echo $this->webroot;?>'+'user_applied_vacancies/service_list_add',{'id':postId},
		function(response){
		$('#UserAppliedVacancyNoticeId ').html(response);
			});	
			
	   }
	  
	  $('#UserAppliedVacancyPostId').change(function(){
	                    postId = $(this).val();
						getpostsByType(postId);
		});
	  
	 // $("#UserAppliedVacancyPostId").val($("#UserAppliedVacancyPostId option:first").val())
          
	});
</script>	
<?php //pr($userOrgnType); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Applications Received</h3>
			</div><!-- /.box-header -->				
			<div class="box-body">
			
			<div class="row">
			   <div class="col-md-12">
			            <!--For Reports->Drop Down for Selecting Orgn and Post -->
			        <?php echo $this->Form->create('UserAppliedVacancy',array('role'=>'form','type'=>'get')); ?>
					  <div class="row pad">
					       <div class="col-sm-2 col-sm-offset-1 pad">
                                <div class="pull-right"><label class="text-light-blue">Filter Using: </label></div>
                            </div> 
						   <div class="col-sm-2 pad">
						      <?php 
							    if($userOrgnType=='MOS')
								{
							     $selOrganization ='all';
								if(isset($this->request->query['organization_id']))
								 {
								  $selOrganization = $this->request->query['organization_id'];	
								 }	
							  ?>
							  <?php echo $this->Form->input('organization_id',array('options'=>array(array_replace(array('all'=>'All Organizations'),$organizations)),'label'=>false,'value'=>$selOrganization,'class'=>'form-control')); 
							   ?>
							   <?php 
							    }
								else
								{
								 $selOrganization = $this->Session->read('Auth.User.organization_id');
								 if(isset($this->request->query['organization_id']))
								 {
								  $selOrganization = $this->request->query['organization_id'];	
								 }
								 echo $this->Form->input('organization_id',array('options'=>array(array_replace(array('all'=>'All Organizations'),$organizations)),'label'=>false,'value'=>$selOrganization,'class'=>'form-control','disabled'=>true)); 
								}	
							  ?>
						   </div>
						      <!--For Posts-->
						   <div class="col-sm-2 pad">
						      <?php 
							    $selOrganization ='all';
								if(isset($this->request->query['post_id']))
								 {
								  $selOrganization = $this->request->query['post_id'];	
								 }	
							  ?>
							  <?php echo $this->Form->input('post_id',array('options'=>array(array_replace(array('all'=>'All Posts'),$posts)),'label'=>false,'value'=>$selOrganization,'class'=>'form-control')); 
							  ?>
						   </div>
						   
						   <div class="col-sm-2 pad">
							  <?php if((isset($notices) && $userOrgnType!='MOS')) { echo $this->Form->input('notice_id', array('options'=>array(array_replace(array('all'=>'Advertisement No'),$notices)),'label'=>false,'class'=>"form-control",'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span'))));
							  }
							  else if((!isset($notices) && $userOrgnType!='MOS')){
								echo $this->Form->input('notice_id', array('options'=>array(array_replace(array('all'=>'Advertisement No'))),'label'=>false,'class'=>"form-control",'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span'))));
							  }
								?>
							  
						   </div>
						   
						   <div class="col-sm-2 pad">
                                <button type="submit" class="btn btn-info">Search</button>
                           </div>
					  </div> 
						  <?php echo $this->Form->end(); ?>
			    </div>
			</div> 		
            
            <div class="row">
            <div class="col-md-12">
             <div class="table-responsive"> 			
			<table class="table table-bordered table-striped">
				<thead class="bg-blue">
					<tr>
						<th rowspan="2">S.No.</th>
						<th rowspan="2">Name</th>
						<th rowspan="2">Present Designation</th>
						<th rowspan="2">Present Organization</th>
						<th rowspan="2">Email Id</th>
						<th rowspan="2">Applied For Post</th>
						<th rowspan="2">Advertisement No</th>
						<th rowspan="2">Service Left</th>
						<th rowspan="2">Applied On</th>
						<th colspan="3"><center>Certificates</center></th>
						<th rowspan="2">Actions</th>
					</tr>
					<tr>
					 <th>ACR</th>
					 <th>Vigilance</th>
					 <th>Cadre</th>
					</tr>
				</thead>
				<tbody>
				
				<?php $i=1;foreach ($applicants as $applicant): ?>
					<tr>
						<td><?php echo h($i);?>
						<td><?php echo h($applicant['LogInformationUser']['f_name'].' '.$applicant['LogInformationUser']['m_name'].' '.$applicant['LogInformationUser']['l_name']); ?></td>
                        <td><?php echo ucfirst(h($applicant['LogInformationUser']['present_post'])); ?></td>
					   <td>
					   <?php if($applicant['LogInformationUser']['present_emp_type']=='Deputation' ||$applicant['LogInformationUser']['present_emp_type']=='Transfer')
						 {
						  if($applicant['LogInformationUser']['current_organization_text']!='Others') 								
						          echo ucfirst(h($applicant['LogInformationUser']['current_organization_text']));
							  else
								echo ucfirst(h($applicant['LogInformationUser']['current_organization_text'].'('.$applicant['LogInformationUser']['other_current_organization'].')')); 
						 }
						 else
						 {
						    if($applicant['LogInformationUser']['organization_name']!='Others')  
						       echo ucfirst(h($applicant['LogInformationUser']['organization_name']));
                            else
                               echo ucfirst(h($applicant['LogInformationUser']['organization_name'].'('.$applicant['LogInformationUser']['other_orgn_name'].')'));  							
                         }						 
						 ?>
						 </td>
						<td><?php echo h($applicant['User']['email']); ?></td>
						<td><?php echo ucfirst(h($applicant['Vacancy']['Post']['post_name']));?></td>
						<td><?php echo h($applicant['Vacancy']['Notice']['advt_number']);?></td>
						<td>
						  <?php
                                $appClosingDate = new DateTime(date('Y-m-d',strtotime($applicant['Vacancy']['Notice']['closing_date']))); 
                                $retirementDate = new DateTime(date('Y-m-d',strtotime($applicant['LogInformationUser']['d_o_r'])));
								$interval       = $appClosingDate->diff($retirementDate); 	
								if(date('Y-m-d',strtotime($applicant['Vacancy']['Notice']['closing_date']))>=date('Y-m-d',strtotime($applicant['LogInformationUser']['d_o_r'])))
									echo h('Expired');
								else
								echo h($interval->format('%Y Years %M months and %d days'));	
						  ?>
						</td>
						<td><?php echo h(date('d/m/Y',strtotime($applicant['UserAppliedVacancy']['applied_on'])));?></td>
						<?php if($applicant['UserAppliedVacancy']['acr_pdf']!='None') 
						 {?>
						<td><center><?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_acrs/'.$applicant['UserAppliedVacancy']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
						<?php 
                          } 
						  else
                          {						  
						?>
						<td><center><?php echo h($applicant['UserAppliedVacancy']['acr_pdf']); ?></center></td>
						 <?php 
						 }
						?>
						           <!--For Vigilance Certificate-->
						<?php if($applicant['UserAppliedVacancy']['vigl_pdf']!='None') 
						 {?>
						<td><center><?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_vigls/'.$applicant['UserAppliedVacancy']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
						<?php 
                          } 
						  else
                          {						  
						?>
						<td><center><?php echo h($applicant['UserAppliedVacancy']['vigl_pdf']); ?></center></td>
						 <?php 
						 }
						?>
						   <!--For Cadre Certificate-->
	                    <?php if($applicant['UserAppliedVacancy']['cadre_pdf']!='None') 
						 {?>
						<td><center><?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_cadre_cert/'.$applicant['UserAppliedVacancy']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
						<?php 
                          } 
						  else
                          {						  
						?>
						<td><center><?php echo h($applicant['UserAppliedVacancy']['cadre_pdf']); ?></center></td>
						 <?php 
						 }
						?> 
						<td>
							<?php echo $this->Html->link('View Profile', array('action' => 'submitted_application', $applicant['UserAppliedVacancy']['id']), array('target'=>'_blank','fullbase'=>true,'class'=>'btn btn-xs btn-info')); ?>
                            <?php echo $this->Html->link('Update Status', array('action' => 'update_status', $applicant['UserAppliedVacancy']['id']), array( 'class'=>'btn btn-xs btn-warning')); ?>
                            <?php echo $this->Html->link('Update Applicant Summary', array('action' => 'update_applicant_summary', $applicant['UserAppliedVacancy']['id']), array( 'class'=>'btn btn-xs bg-olive')); ?>							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
			    </div>
			  </div>
			</div>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>