<?php //pr($applicants); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Applicant's Brief Details</h3>
			</div><!-- /.box-header -->				
			<div class="box-body">
			
            <div class="row">
            <div class="col-md-12">
             <div class="table-responsive"> 			
			<table class="table table-bordered table-striped">
				<thead class="bg-info">
					<tr>
						<th>S.No.</th>
						<th>Name of the Officer/Designation/Organization/Email Id</th>
						<th>i) Date of Birth</br>
							 ii) Date of Initial Appointment</br>
                            iii) Service Left							 
						</th>
						<th>Applied For Post</th>
						<th>Caste</th>
						<th><center>Educational Details</center></th>
						<th>Vigilance/Disciplinary Case,if any</th>
						<th>Experience in feeder grade</th>
					    <th>ACR/APAR</th>
						<th>Eligiblity Position</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
				
				<?php $i=1;foreach ($applicants as $applicant): ?>
					<tr>
						<td><center><?php echo h($i);?></center></td>
						<td>
						          <!--For Finding Present Post-->
						  <?php 
						   if($applicant['LogInformationUser']['present_emp_type']=='Deputation' ||$applicant['LogInformationUser']['present_emp_type']=='Transfer')
						     {
						      if($applicant['LogInformationUser']['current_organization_text']!='Others') 								
						             $applicantPresentOrgn = $applicant['LogInformationUser']['current_organization_text'];
							  else
								     $applicantPresentOrgn = ($applicant['LogInformationUser']['current_organization_text'].'('.$applicant['LogInformationUser']['other_current_organization'].')'); 
						     }
						     else
						     {
							   if($applicant['LogInformationUser']['organization_name']!='Others')  
						             $applicantPresentOrgn = $applicant['LogInformationUser']['organization_name'];
                               else
                                     $applicantPresentOrgn = ($applicant['LogInformationUser']['organization_name'].'('.$applicant['LogInformationUser']['other_orgn_name'].')');  							
                             }						 
						 ?>
						
						<?php echo (h($applicant['LogInformationUser']['f_name'].' '.$applicant['LogInformationUser']['m_name'].' '.$applicant['LogInformationUser']['l_name'].',').'<br/>'.h($applicant['LogInformationUser']['present_post']).'<br/>'.h($applicantPresentOrgn).'</br>'.h($applicant['User']['email'])); ?></td>
                        <td>
						  <?php 
						        $appClosingDate = new DateTime(date('Y-m-d',strtotime($applicant['Vacancy']['Notice']['closing_date']))); 
                                $retirementDate = new DateTime(date('Y-m-d',strtotime($applicant['LogInformationUser']['d_o_r'])));
								$interval       = $appClosingDate->diff($retirementDate);

                                if(date('Y-m-d',strtotime($applicant['Vacancy']['Notice']['closing_date']))>=date('Y-m-d',strtotime($applicant['LogInformationUser']['d_o_r'])))
                                    echo (h('i) '.(date('d/m/Y',strtotime($applicant['LogInformationUser']['d_o_b'])))).'</br>'.h('ii) '.date('d/m/Y',strtotime($applicant['LogInformationUser']['d_o_i_appoint']))).'</br>'.h('iii) '.'expired'));                             
                            	else					 
						            echo (h('i) '.(date('d/m/Y',strtotime($applicant['LogInformationUser']['d_o_b'])))).'</br>'.h('ii) '.date('d/m/Y',strtotime($applicant['LogInformationUser']['d_o_i_appoint']))).'</br>'.h('iii) '.$interval->format('%Y Years %M months and %d days'))); ?>
						</td>
					    <td>
					       <?php echo ucfirst(h($applicant['Vacancy']['Post']['post_name']));?>
						 </td>
						<td><?php echo h($applicant['LogInformationUser']['community']); ?></td>
						<td>
						   
						   <?php
                               $lastIndex = count($applicant['LogUserQualification']) - 1;						   
						       $i=0;foreach ($applicant['LogUserQualification'] as $education):
						         echo ucfirst(h($education['education_qualification_name']));
								   if($i<$lastIndex)
						            echo ' ,';
								?>
						   <?php $i++;endforeach; ?>
						</td>
						<td>
						  <?php
                             if(!empty($applicant['UserAppliedVacancy']['vigl_case_text']))						  
						       echo nl2br(h($applicant['UserAppliedVacancy']['vigl_case_text']));
                             else
                               echo 'NA';								 
						  ?> 
						</td>
						<td>
						  <?php
                             if(!empty($applicant['UserAppliedVacancy']['exp_feeder_grade']))						  
						       echo nl2br(h($applicant['UserAppliedVacancy']['exp_feeder_grade']));
                             else
                               echo 'NA';								 
						  ?>  
						</td> 
						<td>
						   <?php
                             if(!empty($applicant['UserAppliedVacancy']['acr_status']))						  
						       echo nl2br(h($applicant['UserAppliedVacancy']['acr_status']));
                             else
                               echo 'NA';								 
						  ?>  
						</td>
						<td>
						   <?php
                             if(!empty($applicant['UserAppliedVacancy']['eligiblity_position']))						  
						       echo h($applicant['UserAppliedVacancy']['eligiblity_position']);
                             else
                               echo 'NA';								 
						  ?> 
						</td>
						<td>
						  <?php
                             if(!empty($applicant['UserAppliedVacancy']['remarks_by_officer']))						  
						       echo nl2br(h($applicant['UserAppliedVacancy']['remarks_by_officer']));
                             else
                               echo 'NA';								 
						  ?> 
						</td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
			    </div>
			  </div>
			</div>
			
			                <!-- Modal HTML -->
<div class="modal fade in" id="viewVacancy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vacancy Details</h4>
      </div>
      <div class="modal-body" id="viewVacancy">
      	Please wait...
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
			
			
			
		</div><!-- /.box-body -->
		</div>
	</div>
</div>

	
                