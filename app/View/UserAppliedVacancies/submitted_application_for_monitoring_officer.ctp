<div class="row">
<section class="invoice">
      <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i>
				Application Id : <?php echo ucfirst(h($applyingUser['Vacancy']['Notice']['advt_number'])); ?>
				<small class="pull-right"><b>Applied On : </b><?php 
                                                      echo h(date('d/m/Y',strtotime($applyingUser['UserAppliedVacancy']['applied_on'])));
                                                ?>
				</small>
				 </h2>
            </div><!-- /.col -->
      </div>
      <div class="row margin">
          <div class="col-xs-12">
            <div class="col-xs-12"><span><center><h4>Applied For : </h4></center></span></div>
			<?php
               if(!empty($applyingUser['Vacancy']['Department']['department_name']))
			   {				   
			?>
                <div class="col-xs-4 table-responsive bg-green">
			   <?php } 
			   else
			   {  
			   ?>
			   <div class="col-xs-6 table-responsive bg-green">
               <?php
			   }
              ?> 			   
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th>Post : </th>
						<td><?php echo ucfirst(h($applyingUser['Vacancy']['Post']['post_name']));?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
				
             <?php
               if(!empty($applyingUser['Vacancy']['Department']['department_name']))
			   {				   
			 ?>
                <div class="col-xs-4 table-responsive bg-yellow">
			<?php } 
			   else
			   {  
			   ?>
			   <div class="col-xs-6 table-responsive bg-yellow">
               <?php
			   }
              ?>
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th>Organization :</th>
						<td><?php echo (h($applyingUser['Vacancy']['Organization']['organization_name']));?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
			 <?php if(!empty($applyingUser['Vacancy']['Department']['department_name']))
			  {
             ?>				  
                <div class="col-xs-4 table-responsive bg-green">
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th>Department :</th>
						<td><?php echo (h($applyingUser['Vacancy']['Department']['department_name']));?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
		     <?php
              }
             ?>			  
              </div>						
	  </div>
         <div class="row">
	          <div class="col-xs-12">
                 <center><p class="lead"><b>Bio Data Proforma</b></p></center>
		      </div>	
	     </div>
	  <!--Profile Info-->
	  <div class="row">  
		 <div class="col-xs-12">
				  <div class="col-xs-6 table-responsive">
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th style="width:50%">Name</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['f_name'].' '.$applyingUser['LogInformationUser']['m_name'].' '.$applyingUser['LogInformationUser']['l_name']));?></td>
					  </tr>
					  <tr>
						<th>Designation</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['present_post']));?></td>
					  </tr>
					  <tr>
						<th>Organization</th>
						<td><?php
						  if($applyingUser['LogInformationUser']['present_emp_type']=='Deputation' ||$applyingUser['LogInformationUser']['present_emp_type']=='Transfer' )
                            {
                              if($applyingUser['LogInformationUser']['current_organization_text']!='Others') 								
						          echo ucfirst(h($applyingUser['LogInformationUser']['current_organization_text']));
							  else
								echo ucfirst(h($applyingUser['LogInformationUser']['current_organization_text'].'('.$applyingUser['LogInformationUser']['other_current_organization'].')'));  
						    }
                          else
						  {
							if($applyingUser['LogInformationUser']['organization_name']!='Others')  
						       echo ucfirst(h($applyingUser['LogInformationUser']['organization_name']));
                            else
                               echo ucfirst(h($applyingUser['LogInformationUser']['organization_name'].'('.$applyingUser['LogInformationUser']['other_orgn_name'].')'));  							
						  }
						?>
                        </td>						
					  </tr>
					  <tr>
						<th>Official Address</th>
						<td><?php echo ucfirst((h($applyingUser['LogInformationUser']['o_address']).' ,</br> '.h($applyingUser['LogInformationUser']['o_state_name']).' , '.h($applyingUser['LogInformationUser']['o_city_name']).' ,</br> '.h($applyingUser['LogInformationUser']['o_pincode']))); ?></td>
					  </tr>
					  <tr>
						<th>Residential Address</th>
						<td><?php echo ucfirst((h($applyingUser['LogInformationUser']['r_address']).', </br>'.h($applyingUser['LogInformationUser']['r_state_name']).' , '.h($applyingUser['LogInformationUser']['r_city_name']).' ,</br> '.h($applyingUser['LogInformationUser']['r_pincode']))); ?></td>
					  </tr>
					  <tr>
						<th>Contact Number</th>
						<td>(O) <?php echo ucfirst(h($applyingUser['LogInformationUser']['o_std_code'].'-'.$applyingUser['LogInformationUser']['o_landline_num']. '  ,  ' .$applyingUser['LogInformationUser']['mobile_number'])); ?></br>	   
					    (R) <?php echo h($applyingUser['LogInformationUser']['r_std_code'].'-'.$applyingUser['LogInformationUser']['r_landline_num'].' , '.$applyingUser['LogInformationUser']['r_mobile_number']); ?></td>
					  </tr>
					  <tr>
						<th>Email Id</th>
						<td><i class="fa fa-envelope-o"></i>  <?php echo h($applyingUser['User']['email']);?></td>
					  </tr>
					  <?php if($applyingUser['Vacancy']['Post']['post_name']=='Chairman' || $applyingUser['Vacancy']['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
						<th>Service , Batch & Cadre</th>
						    <td>
							  <?php
                                if($applyingUser['LogServiceAndBatchInfo']['cadre_name']=='Others')						   
						          echo (h($applyingUser['LogServiceAndBatchInfo']['service_name'].' , '.$applyingUser['LogServiceAndBatchInfo']['batch'].' , '.$applyingUser['LogServiceAndBatchInfo']['cadre_name'].'('.$applyingUser['LogServiceAndBatchInfo']['other_cadre_name'].')')); 
						        else
								  echo (h($applyingUser['LogServiceAndBatchInfo']['service_name'].' , '.$applyingUser['LogServiceAndBatchInfo']['batch'].' , '.$applyingUser['LogServiceAndBatchInfo']['cadre_name']));    
							   ?>
							</td>
					  </tr>
					  <tr>
						<th>Date of Joining Group 'A' Service</th>
						<td><?php echo h(date('d/m/Y',strtotime($applyingUser['LogServiceAndBatchInfo']['doj_grp_a']))); ?></td>
					  </tr>
					  <?php
					    }
					   ?>	
					  <tr>
						<th>Date of Birth</th>
						<td><?php echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['d_o_b']))); ?></td>
					  </tr>
					  <?php if($applyingUser['Vacancy']['Post']['post_name']!='Chairman' && $applyingUser['Vacancy']['Post']['post_name']!='Dy. Chairman')
					   {
					  ?>
					  <tr>
						<th>Date of Initial Appointment</th>
						<td><?php echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['d_o_i_appoint']))); ?></td>
					  </tr>
					  <?php
					    }
					  ?>	
					  <tr>
						<th>Date of Retirement</th>
						<td>
						   <?php echo (h(date_format(date_create($applyingUser['LogInformationUser']['d_o_r']),'d-m-Y'))); ?>
						</td>
					  </tr>
					</tbody></table>
				  </div>	
				                  <!--Profile Pic-->
			<div class="col-xs-2 table-responsive pull-right">
						<table class="table">
					     <tbody>
					       <tr>
							<?php
							echo $this->Html->image('/user_applied_vacancies/submitted_application_dp_for_monitoring_officer/'.$applyingUser['UserAppliedVacancy']['id'], array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
							?>
                          </tr>	
                         </tbody>
						</table>						  
			</div>		
      </div>
  </div>	
	<!--Educational Details-->
            <div class="row">
      <div class="col-xs-12">
			    <p class="lead text-bold">Educational Qualifications</p>
				 <div class="table-responsive">
					<table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-info">
                    <th>S.No.</th>
                    <th>Qualification</th>
					<th>University</th>
                    <th>Year of Passing</th>
                    <th>Class</th>
                    <th>%Obtained</th>
					<th>Special Subject</th>
					<th class="no-print">Certificate</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($applyingUser['LogUserQualification'] as $education): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($education['education_qualification_name'])); ?></td>
						<td><?php echo ucfirst(h($education['university'])); ?></td>
						<td><?php echo ucfirst(h($education['y_o_p'])); ?></td>
						<td><?php echo ucfirst(h($education['class_type'])); ?></td>
						<td><center><?php echo ucfirst(h($education['perc_obtained'])); ?></center></td>
						<td><?php echo ucfirst(h($education['special_subject'])); ?></td>
					    <td class="no-print"><center><?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_quali_docs_by_monitoring_officer/'.$education['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
					</tr>
				<?php $i++;endforeach; ?>
                </tbody>
              </table>
			   </div>
            </div>        
        </div>
		
                              <!--Employment Details-->
        <div class="row">
            <div class="col-xs-12">
			    <p class="lead text-bold">Employment Details/Experience Details</p>
				 <div class="table-responsive">
					<table class="table table-bordered table-striped">
                <thead>
                  <tr class="bg-info">
                        <th>S.No.</th>
						<th>Organization Name</th>
						<th>Posts Held</th>
						<th>Scale of Pay</th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Nature of Duties</th>
						<th class="no-print">Certificate</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($applyingUser['LogUserEmploymentDetail'] as $service): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($service['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($service['post_held'])); ?></td>
						<td><?php echo ucfirst(h($service['scale_of_pay'])); ?></td>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($service['from_date'])))); ?></td>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($service['to_date'])))); ?></td>
						<td><?php echo ucfirst(h($service['nature_of_duties'])); ?></td>
					    <td class="no-print"><center><?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_exp_docs_by_monitoring_officer/'.$service['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
					</tr>
				<?php $i++;endforeach; ?>
                </tbody>
              </table>
			   </div>
            </div>        
        </div>
                                <!--Nature Of Employment-->
        <div class="row">
		   <div class="col-xs-12">
				  <div class="col-xs-12 table-responsive">
					<table class="table">
					  <tbody>
					  <tr>
						<th style="width:50%">Nature of Present Employment</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['nature_of_present_emp']));?></td>
					  </tr>
					  <tr>
						<th>Type of Present Employment</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['present_emp_type']));?></td>
					  </tr>
					    <?php 
                            if($applyingUser['LogInformationUser']['present_emp_type']=='Deputation' ||$applyingUser['LogInformationUser']['present_emp_type']=='Transfer' )
                              {							
						?>
					  <tr>
						<th>Date of Initial Appointment(Deputation/Transfer)</th>
						<td>
						<?php  if($applyingUser['LogInformationUser']['dt_appoint_date']!=	NULL)
						{
						  echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['dt_appoint_date'])));
                        } ?>
                        </td>						
					  </tr>
					  <tr>
						<th>Period of Appointment on Deputation/Transfer Basis</th>
						<td>
						<?php if($applyingUser['LogInformationUser']['period_of_appoint_dt']!=NULL)
						 {
						  echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['period_of_appoint_dt'])));
						 } 
						 ?>
						</td>    					  
					  </tr>
					  <tr>
						<th>Name of Parent Office/Organization to which you belong</th>
						<td>
						<?php
                            if($applyingUser['LogInformationUser']['name_o_p_orgn_text']!='Others')  						  
						       echo ucfirst(h($applyingUser['LogInformationUser']['name_o_p_orgn_text']));
						    else
							   echo ucfirst(h($applyingUser['LogInformationUser']['name_o_p_orgn_text'].'('.$applyingUser['LogInformationUser']['other_parent_organization'].')'));  
						  ?>
						</td>
					  </tr>
					  <?php
					    }
					  ?>	
					  <tr>
						<th>Working Under</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['working_under'])); ?></td>
					  </tr>
					  <?php if($applyingUser['LogInformationUser']['working_under']!='Private Organization') {?>
					  <tr>
						<th>Continuous Regular Appointment Date</th>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['cont_reg_appoint_date'])))); ?></td>
					  </tr>
					  <tr>
						<th>Belongs To</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['belong_to_ci'])); ?></td>
					  </tr>
					  <?php }?>
					  <?php if($applyingUser['Vacancy']['Post']['post_name']=='Chairman' || $applyingUser['Vacancy']['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
					    <th>Total Service Rendered in Group 'A' Post</th>
						<td>
						   <?php
                                $appClosingDate = new DateTime(date('Y-m-d',strtotime($applyingUser['Vacancy']['Notice']['closing_date']))); 
                                $serviceRenderedGrpA = new DateTime(date('Y-m-d',strtotime($applyingUser['LogServiceAndBatchInfo']['doj_grp_a'])));
								$interval     = $appClosingDate->diff($serviceRenderedGrpA); 	
								if(date('Y-m-d',strtotime($applyingUser['Vacancy']['Notice']['closing_date']))<=date('Y-m-d',strtotime($applyingUser['LogServiceAndBatchInfo']['doj_grp_a'])))
									echo h('Not Allowed');
								else
								echo h($interval->format('%Y Years %M months and %d days'));	
						  ?>
						</td>
					  </tr>
					  <tr>
						<th>Total Experience in Port & Shipping Sectors,if any</th>
						<td><?php echo ucfirst(h($applyingUser['LogServiceAndBatchInfo']['exp_prt_ship'])); ?></td>
					  </tr>
					  <?php 
					   }
					  ?>
					  </tbody>
					</table>
				  </div>
            </div>   				  
        </div>
			
				                    <!-- Essentials and Desirables-->
        <div class="row">
		   <div class="col-xs-12">
		        <p class="lead text-bold">Essentials and Desirables</p>
		    <div class="table-responsive">
		      <table class="table table-bordered table-striped table-hover">			  
			      <thead>
				    <tr>
					  <th>S.No.</th>
					  <th width="50%">Essentials</th>
					  <th width="50%">Your Comments</th>
					</tr> 
				  </thead>
			  
		      <tbody>
			      <?php $i=1; foreach($userEss as $userVEss): ?>
					 <tr>
                       <td><center><?php echo $i;?></center></td>
					   <td>
					      <?php echo ucfirst(h($userVEss['VacanciesEssential']['essential_name']));?> 
					   </td>
					    <?php
						  foreach($userVEss['UsersVacanciesEssential'] as $userVessc): ?>
					      <?php if($userVessc['user_id']==$userId) 
						  {
					    ?> 
					   <td>
					     <?php echo h($userVessc['essential_comments']); ?>
					   </td>
					   <?php 
						 }
					   ?>
					   <?php endforeach; ?>
					  </tr> 
                  <?php $i++; endforeach; ?>					
		       </tbody> 
			</table> 
		   </div>	
         </div>
       </div>
     <?php  $showBlock = false; 
		 foreach($userDss as $uVdss):
            foreach($uVdss['UsersVacanciesDesirable'] as $uVDss): 		 
		          if($uVDss['user_id']== $userId) 
	                {
					 $showBlock = true;
					 break;
				    }	 
		    endforeach;
		  endforeach;	
       if($showBlock)
	    {		   
	  ?>	   
	   <div class="row">
		   <div class="col-xs-12">
		<div class="table-responsive">
		      <table class="table table-bordered table-striped table-hover">			  
			      <thead>
				    <tr>
					  <th>S.No.</th>
					  <th width="50%">Desirables</th>
					  <th width="50%">Your Comments</th>
					</tr> 
				  </thead>
			  
		      <tbody>
			      <?php $i=1; foreach($userDss as $Vdss): ?>
					 <tr>
                       <td><center><?php echo $i;?></center></td>
					   <td><?php echo ucfirst(h($Vdss['VacanciesDesirable']['desirable_name']));?> </td>
					    <?php foreach($Vdss['UsersVacanciesDesirable'] as $userVdss ): 
						      if($userVdss['user_id']== $userId) 
					            {
						?>
								   <td>
									 <?php echo h($userVdss['desirable_comments']); ?>
								   </td>
						<?php  
						        }
						   endforeach; 
						?> 
					  </tr> 
                  <?php $i++; endforeach; ?>					
		       </tbody> 
			</table> 
		   </div>	
         </div>
       </div>	
		<?php
          }
        ?>		
		
		
                           <!--Write Ups-->
        <?php if($applyingUser['Vacancy']['Post']['post_name']=='Chairman' || $applyingUser['Vacancy']['Post']['post_name']=='Dy. Chairman' )
		  {
		 ?>
		<div class="row">
		   <div class="col-xs-12">
		        <p class="lead text-bold">Write-ups</p>
				  <div class="col-xs-12 table-responsive">
					<table class="table table-bordered table-striped">
					  <tbody>
					  <tr>
						<th style="width:50%">Write-up on the professional experience and Core-Competence of the officer in handling the assignment applied for:</th>
						<td><?php echo ucfirst(h($applyingUser['LogServiceAndBatchInfo']['write_up1_data']));?></td>
					    <?php if(($applyingUser['LogServiceAndBatchInfo']['write_up_1']!=NULL) || !empty($applyingUser['LogServiceAndBatchInfo']['write_up_1']))  
						 {
						?>
						 <td class="no-print"><center>
						  <?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_write_up_1_doc_by_monitoring_officer/'.$applyingUser['LogServiceAndBatchInfo']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?>
						 </center></td>
					    <?php
						 }
						?>
					  </tr>
					  <tr>
						<th>Write-up on how the applicant can full-fill and advance the mission and objectives of the organization that he seeks to join:</th>
						<td><?php echo ucfirst(h($applyingUser['LogServiceAndBatchInfo']['write_up2_data']));?></td>
					    <?php if(($applyingUser['LogServiceAndBatchInfo']['write_up_2']!=NULL) || !empty($applyingUser['LogServiceAndBatchInfo']['write_up_2']))  
						 {
						?>
						 <td class="no-print"><center>
						  <?php echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_write_up_2_doc_by_monitoring_officer/'.$applyingUser['LogServiceAndBatchInfo']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); ?>
						 </center></td>
					    <?php
						 }
						?> 	
					  </tr>
                     </tbody>
                    </table>
                  </div>
                </div>
        </div>
		<?php
		 }
		?> 
                            <!--Scale Of Pay-->
        <div class="row">
		   <div class="col-xs-12">
				  <div class="col-xs-12 table-responsive">
					<table class="table">
					  <tbody>
					  <?php if($applyingUser['LogInformationUser']['working_under']!='Private Organization') {?>
					  <tr>
						<th style="width:50%">Scale of Pay</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['present_scale_pay']));?></td>
					  </tr>
					  <tr>
						<th>Grade Pay</th>
						<td>
						   <?php
						      if(($applyingUser['LogInformationUser']['present_grade_pay'])==null)
						           echo h('NA');
							  else
                                echo ucfirst(h($applyingUser['LogInformationUser']['present_grade_pay'])); 
						   ?>
						</td>
					  </tr>
					  <tr>
						<th>Date from which in this Pay</th>
						<td>
						     <?php 
						        if($applyingUser['LogInformationUser']['strt_dt_of_pay']!=null)
								 {
								  echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['strt_dt_of_pay'])));
						         }
								 else
								   {
								     echo h('NA');
								   }
							?>
						</td>
					  </tr>
				<?php } ?>
                                             <!-- For Private Orgn -->
				<?php if($applyingUser['LogInformationUser']['working_under']=='Private Organization') {?>
					  <tr>
						<th style="width:50%">Consolidated Emoluments</th>
						<td><?php echo ucfirst(h('Rs. '.$applyingUser['LogInformationUser']['consolidated_emoluments']));?></td>
					  </tr>
				<?php } ?>
					  <!--tr>
						<th></th>
						<td><?php //echo date('d/m/Y',strtotime($applyingUser['LogInformationUser']['period_of_appoint_dt'])); ?></td>
					  </tr-->
					  <tr>
						<th>Category to which you belong</th>
						<td><?php 
						      echo ucfirst(h($applyingUser['LogInformationUser']['community'])); 
							?>
						</td>
						<?php 
						  if($applyingUser['LogInformationUser']['community']!='General')
						    {
						?>
                        <td class="no-print">
                        <?php   						
						  echo $this->Html->link(false,'/user_applied_vacancies/dwnld_applicants_caste_cert_by_monitoring_officer/'.$applyingUser['LogInformationUser']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); 
						?>
						</td>
							<?php
							}
							?>
					  </tr>
					  
					  <tr>
					     <th>State clearly whether in light of entries made by you above, you meet the requirements of the post</th>
					     <td><?php echo ucfirst(h($applyingUser['LogInformationUser']['statement'])); ?></td>
					  </tr>
					  <tr>
						<th>Additional Information, if any, which you would like to mention in support of your suitability for the post</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['additional_info'])); ?></td>
					  </tr>
					  </tbody>
					</table>
				  </div>
            </div>   				  
        </div>		
                      <!--Declaration-->
        	<div class="row margin">
			  <div class="col-xs-12">
				  <p class="lead text-bold">Declaration</p>		  
				      <p style="margin-top: 10px;" class="text-muted well well-sm no-shadow">
						   I hereby declare that all the details furnished above are true to the best of my knowledge and belief.In the event of selection to the post, I will not withdraw my candidature for the post and undertake to accept the posting
				      </p>
			  </div>
			</div>
            <div class="row margin">			
			  <div class="col-xs-2 pull-right">
			   <?php
				echo $this->Html->image('/user_applied_vacancies/submitted_application_sign_for_monitoring_officer/'.$applyingUser['UserAppliedVacancy']['id'], array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
			   ?>
			  </div>
           </div>
		   <div class="row">
		      <div class="col-xs-3 pull-right">
			      <p class="text-bold">Signature of the candidate</p>
			  </div> 
		   </div>
		   <div class="row">
              <div class="col-xs-9">
			     &nbsp;
              </div>			  
				  <div class="col-xs-3">
					  <p><b>Date: </b>
					  <?php echo h(date('d/m/Y',strtotime($applyingUser['UserAppliedVacancy']['applied_on'])));			
						?>
					  <p>			
				  </div> 
		   </div>
          
            <div class="row no-print">
                 <div class="col-xs-12">				
				  <button class="btn btn-default" onclick='window.print()'><i class="fa fa-print"></i> Print</button>
				  <button style="margin-right: 5px;" class="btn btn-primary btn-success pull-right" onclick="location.href='<?php echo $this->Html->url(array('action'=>'submitted_application_pdf_for_monitoring_officer',$applyingUser['UserAppliedVacancy']['id']));?>'"><i class="fa fa-download"></i> Generate PDF</button>				
			   </div>
          </div>
   
</section>
</div>