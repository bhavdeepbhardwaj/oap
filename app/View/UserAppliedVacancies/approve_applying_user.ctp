<script>
  $(function(){  
      

	  function getpostsByType(postId)
	   {
	    $.post('<?php echo $this->webroot;?>'+'user_applied_vacancies/service_list_add',{'id':postId},
		function(response){
		$('#UserAppliedVacancyNoticeId').html(response);
			});									   
	   }
	  
	  $('#UserAppliedVacancyPostId').change(function(){
	                    postId = $(this).val();
						getpostsByType(postId);
		});
	 
       //   $("#UserAppliedVacancyPostId").val($("#UserAppliedVacancyPostId option:first").val())  
	});
</script>
<?php //pr($nodalOfficer); ?>
<?php //pr($applicants); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Approve following Applicants & Upload their Documents</h3>
			</div><!-- /.box-header -->
			
			<div class="row  pad">
			   <div class="col-md-12">
			            <!--For Reports->Drop Down for Selecting Orgn and Post -->
			        <?php echo $this->Form->create('UserAppliedVacancy',array('role'=>'form','type'=>'get')); ?>
					  <div class="row pad">
					       <div class="col-sm-2 col-sm-offset-1 pad">
                                <div class="pull-right"><label class="text-light-blue">Filter Using: </label></div>
                            </div> 
						   <div class="col-sm-2">
						      <?php 
							   
								 $selOrganization = $this->Session->read('Auth.User.organization_id');
								 if(isset($this->request->query['organization_id']))
								 {
								  $selOrganization = $this->request->query['organization_id'];	
								 }
								 echo $this->Form->input('organization_id',array('options'=>array(array_replace(array('all'=>'All Organizations'),$organizations)),'label'=>false,'value'=>$selOrganization,'class'=>'form-control','disabled'=>true)); 
							  ?>
						   </div>
						   
						   <div class="col-sm-2">
						      <?php 
							    $selOrganization ='all';
								if(isset($this->request->query['post_id']))
								 {
								  $selOrganization = $this->request->query['post_id'];	
								 }	
							  ?>
							  <?php echo $this->Form->input('post_id',array('options'=>array(array_replace(array('all'=>'All Post'),$posts)), 'selected'=>'All Post','label'=>false,'value'=>$selOrganization,'class'=>'form-control')); 
							  ?>
						   </div>
						   
						      <!--For Posts-->
						   <div class="col-sm-2">
							  <?php if(isset($notices)) { echo $this->Form->input('notice_id', array('options'=>array(array_replace(array('all'=>'Advertisement No'),$notices)),'label'=>false,'class'=>"form-control",'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span'))));
							  }
							  else
							  {
							  echo $this->Form->input('notice_id', array('options'=>array(array_replace(array('all'=>'Advertisement No'))),'label'=>false,'class'=>"form-control",'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span'))));
							  
							  }
								?>

						   </div>
						   <div class="col-sm-2">
                                <button type="submit" class="btn btn-info">Search</button>
                           </div>
					  </div> 
						  <?php echo $this->Form->end(); ?>
			    </div>
			</div>
			
			<div class="box-body table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Name</th>
						<th>Present Designation</th>
						<th>Present Organization</th>
						<th>Email Id</th>
						<th>Applied For Post</th>
						<th>Advertisement No</th>
						<th>Service Left</th>
						<th>Applied On</th>
						<th width="17%">Actions</th>
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
						<td><?php echo h(date('d/m/Y',strtotime($applicant['UserAppliedVacancy']['applied_on'])))?> </td>
						<td>
							<?php echo $this->Html->link('View Profile', array('action' => 'submitted_application_for_approval', $applicant['UserAppliedVacancy']['id']), array('target'=>'_blank','class'=>'btn btn-primary btn-xs btn-info')); ?>
                            <?php 
                              if($applicant['UserAppliedVacancy']['acr_pdf']!='None' && $applicant['UserAppliedVacancy']['vigl_pdf']!='None' && $applicant['UserAppliedVacancy']['cadre_pdf']!='None')
							   {
                              ?>								   
							   <button data-toggle="tooltip" data-placement="left" title="You have already uploaded documents for this applicant" class="btn btn-xs btn-success" onclick="javascript:alert('You have already uploaded documents for this applicant')">Docs Uploaded</button>
	                         <?php					      
  							  }
							   else
							   {
								echo $this->Html->link('Upload Docs', array('action' => 'upload_acrs', $applicant['UserAppliedVacancy']['id']), array( 'class'=>'btn btn-primary btn-xs btn-warning')); 						   
							   }
                            ?>							   
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
</div>