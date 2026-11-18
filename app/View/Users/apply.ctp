<div class="row">
   <section class="invoice">
      <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i>
				Application Id : <?php echo ucfirst(h($vacancy['Notice']['advt_number'])); ?>
				<small class="pull-right">Date: <?php $dt = new DateTime();
                                                      echo h($dt->format('d/m/Y'));
                                                ?>
				</small>
				 </h2>
				  
                
             <?php if($appliedVacancy)
				  {
				?>
                <div class="alert alert-warning row margin">
                   <i class="icon fa fa-check"></i> You have already applied for this job on : <?php echo h(date('d/m/y',strtotime($applyingDate['UserAppliedVacancy']['applied_on']))); ?>
                </div>
                <?php				
				  }
				?>
            </div><!-- /.col -->
      </div>
	  <?php 
	  if(!$appliedVacancy)
	  {
	?>
	  <div class="row margin">
          <div class="col-xs-12 ">
			<div class="col-xs-12"><span><center><h4>Applying For : </h4></center></span></div>
			<?php
               if(!empty($vacancy['Department']['department_name']))
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
						<td><?php echo ucfirst(h($vacancy['Post']['post_name']));?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
				
             <?php
               if(!empty($vacancy['Department']['department_name']))
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
						<td><?php echo (h($vacancy['Organization']['organization_name']));?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
			 <?php if(!empty($vacancy['Department']['department_name']))
			  {
             ?>				  
                <div class="col-xs-4 table-responsive bg-green">
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th>Department :</th>
						<td><?php echo (h( $vacancy['Department']['department_name']));?></td>
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
						<td><?php echo ucfirst(h($userInfo['User']['f_name'].' '.$userInfo['User']['m_name'].' '.$userInfo['User']['l_name']));?></td>
					  </tr>
					  <tr>
						<th>Designation</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_post']));?></td>
					  </tr>
					  <tr>
						<th>Organization</th>
						<td><?php 
						  if($userInfo['InformationUser']['present_emp_type']=='Deputation' ||$userInfo['InformationUser']['present_emp_type']=='Transfer' )
                            {
                              if($userInfo['InformationUser']['current_organization_text']!='Others') 								
						          echo ucfirst(h($userInfo['InformationUser']['current_organization_text']));
							  else
								echo ucfirst(h($userInfo['InformationUser']['current_organization_text'].'('.$userInfo['InformationUser']['other_current_organization'].')'));  
						    }
                          else
						  {
							if($userInfo['User']['organization_name']!='Others')  
						       echo ucfirst(h($userInfo['User']['organization_name']));
                            else
                               echo ucfirst(h($userInfo['InformationUser']['organization_name'].'('.$userInfo['InformationUser']['other_orgn_name'].')'));  							
						  }
						?>
                        </td>						
					  </tr>
					  <tr>
						<th>Official Address</th>
						<td><?php echo ucfirst((h($userInfo['InformationUser']['o_address']).' ,</br> '.h($userInfo['InformationUser']['OState']['state_name']).' , '.h($userInfo['InformationUser']['OCity']['city_name']).' ,</br> '.h($userInfo['InformationUser']['o_pincode']))); ?></td>
					  </tr>
					  <tr>
						<th>Residential Address</th>
						<td><?php echo ucfirst((h($userInfo['InformationUser']['r_address']).', </br>'.h($userInfo['InformationUser']['RState']['state_name']).' , '.h($userInfo['InformationUser']['RCity']['city_name']).' ,</br> '.h($userInfo['InformationUser']['r_pincode']))); ?></td>
					  </tr>
					  <tr>
						<th>Contact Number</th>
						<td>(O) <?php echo ucfirst(h($userInfo['InformationUser']['o_std_code'].'-'.$userInfo['InformationUser']['o_landline_num']. '  ,  ' .$userInfo['User']['mobile_number'])); ?></br>	   
					    (R) <?php echo (h($userInfo['InformationUser']['r_std_code'].'-'.$userInfo['InformationUser']['r_landline_num'].' , '.$userInfo['InformationUser']['r_mobile_number'])); ?></td>
					  </tr>
					  <tr>
						<th>Email Id</th>
						<td><i class="fa fa-envelope-o"></i>  <?php echo (h($userInfo['User']['email']));?></td>
					  </tr>
					  <?php if($vacancy['Post']['post_name']=='Chairman' || $vacancy['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
						<th>Service , Batch & Cadre</th>
						<td>
						   <?php
                                if($serviceInfo['ServiceAndBatchInfo']['cadre_name']=='Others')						   
						          echo (h($serviceInfo['ServiceAndBatchInfo']['service_name'].' , '.$serviceInfo['ServiceAndBatchInfo']['batch'].' , '.$serviceInfo['ServiceAndBatchInfo']['cadre_name'].'('.$serviceInfo['ServiceAndBatchInfo']['other_cadre_name'].')')); 
						        else
								  echo (h($serviceInfo['ServiceAndBatchInfo']['service_name'].' , '.$serviceInfo['ServiceAndBatchInfo']['batch'].' , '.$serviceInfo['ServiceAndBatchInfo']['cadre_name']));    
							?>
						 
						</td>
					  </tr>
					  <tr>
						<th>Date of Joining Group 'A' Service</th>
						<td><?php echo h(date('d/m/Y',strtotime($serviceInfo['ServiceAndBatchInfo']['doj_grp_a']))); ?></td>
					  </tr>
					  <?php
					    }
					   ?>	
					  <tr>
						<th>Date of Birth</th>
						<td><?php echo (h(date('d/m/Y',strtotime($userInfo['InformationUser']['d_o_b'])))); ?></td>
					  </tr>
					  <?php if($vacancy['Post']['post_name']!='Chairman' && $vacancy['Post']['post_name']!='Dy. Chairman')
					   {
					  ?>
					  <tr>
						<th>Date of Initial Appointment</th>
						<td><?php echo (h(date('d/m/Y',strtotime($userInfo['InformationUser']['d_o_i_appoint'])))); ?></td>
					  </tr>
					  <?php
					    }
					  ?>	
					  <tr>
						<th>Date of Retirement</th>
						<td><?php echo (h(date_format(date_create($userInfo['InformationUser']['d_o_r']),'d-m-Y')))?></td>
					  </tr>
					</tbody></table>
				  </div>	
				                  <!--Profile Pic-->
			<div class="col-xs-2 table-responsive pull-right">
						<table class="table">
					     <tbody>
					       <tr>
							<?php
							echo $this->Html->image('/users/download_self_profile_pic/', array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
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
					<th>Certificate</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($userInfo['UserQualification'] as $education): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($education['EducationQualification']['education_qualification'])); ?></td>
						<td><?php echo ucfirst(h($education['university'])); ?></td>
						<td><?php echo ucfirst(h($education['y_o_p'])); ?></td>
						<td><?php echo ucfirst(h($education['class_type'])); ?></td>
						<td><center><?php echo ucfirst(h($education['perc_obtained'])); ?></center></td>
						<td><?php echo ucfirst(h($education['special_subject'])); ?></td>
						<td class="no-print"><center><?php echo $this->Html->link(false,'/user_qualifications/dwn_self_quali_doc/'.$education['id'], array('target'=>'_blank','class'=>'fa fa-download')); ?></center></td>
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
						<th>Certificate</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($userInfo['UserEmploymentDetail'] as $service): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($service['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($service['post_held'])); ?></td>
						<td><?php echo ucfirst(h($service['scale_of_pay'])); ?></td>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($service['from_date'])))); ?></td>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($service['to_date'])))); ?></td>
						<td><?php echo ucfirst(h($service['nature_of_duties'])); ?></td>
					    <td class="no-print"><center><?php echo $this->Html->link(false,'/user_employment_details/dwn_self_emp_doc/'.$service['id'], array('target'=>'_blank','class'=>'fa fa-download')); ?></center></td>
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
						<td><?php echo ucfirst(h($userInfo['InformationUser']['nature_of_present_emp']));?></td>
					  </tr>
					  <tr>
						<th>Type of Present Employment</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_emp_type']));?></td>
					  </tr>
					    <?php 
                            if($userInfo['InformationUser']['present_emp_type']=='Deputation' ||$userInfo['InformationUser']['present_emp_type']=='Transfer' )
                              {							
						?>
					  <tr>
						<th>Date of Initial Appointment(Deputation/Transfer)</th>
						<td>
						<?php  if($userInfo['InformationUser']['dt_appoint_date']!=	NULL)
						{
						  echo h(date('d/m/Y',strtotime($userInfo['InformationUser']['dt_appoint_date'])));
                        } ?>
                        </td>						
					  </tr>
					  <tr>
						<th>Period of Appointment on Deputation/Transfer Basis</th>
						<td>
						<?php if($userInfo['InformationUser']['period_of_appoint_dt']!=NULL)
						 {
       					   echo h(date('d/m/Y',strtotime($userInfo['InformationUser']['period_of_appoint_dt'])));
						 } 
						 ?>
						</td>    					  
					  </tr>
					  <tr>
						<th>Name of Parent Office/Organization to which you belong</th>
						<td>
						  <?php
                            if($userInfo['InformationUser']['name_o_p_orgn_text']!='Others')  						  
						       echo ucfirst(h($userInfo['InformationUser']['name_o_p_orgn_text']));
						    else
							   echo ucfirst(h($userInfo['InformationUser']['name_o_p_orgn_text'].'('.$userInfo['InformationUser']['other_parent_organization'].')'));  
						  ?>	
						</td>
					  </tr>
					  <?php
					    }
					  ?>
					  <tr>
						<th>Working Under</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['working_under'])); ?></td>
					  </tr>
					  <?php if($userInfo['InformationUser']['working_under']!='Private Organization') {?>
					  <tr>
						<th>Continuous Regular Appointment Date</th>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($userInfo['InformationUser']['cont_reg_appoint_date'])))); ?></td>
					  </tr>
					  <tr>
						<th>Belongs To</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['belong_to_ci'])); ?></td>
					  </tr>
					  <?php }?>
					  <?php if($vacancy['Post']['post_name']=='Chairman' || $vacancy['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
					    <th>Total Service Rendered in Group 'A' Post</th>
						<td>
						   <?php
                                $appClosingDate = new DateTime(date('Y-m-d',strtotime($vacancy['Notice']['closing_date']))); 
                                $serviceRenderedGrpA = new DateTime(date('Y-m-d',strtotime($serviceInfo['ServiceAndBatchInfo']['doj_grp_a'])));
								$interval     = $appClosingDate->diff($serviceRenderedGrpA); 	
								if(date('Y-m-d',strtotime($vacancy['Notice']['closing_date']))<=date('Y-m-d',strtotime($serviceInfo['ServiceAndBatchInfo']['doj_grp_a'])))
									echo h('Not Allowed');
								else
								echo h($interval->format('%Y Years %M months and %d days'));	
						  ?>
						</td>
					  </tr>
					  <tr>
						<th>Total Experience in Port & Shipping Sectors,if any</th>
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['exp_prt_ship'])); ?></td>
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
			      <tr>
				    <?php $i=1; foreach($vacancy['Essential'] as $vEss): ?>
				    <td><center><?php echo h($i);?></center></td>
					<td><?php echo ucfirst(h($vEss['essential']));?> </td>
					<td>
					  <?php //pr($userInfo);
					  foreach($userInfo['VacanciesEssential'] as $uVess): ?>
					   <?php if($uVess['vacancy_id']== $vacancyId && $uVess['essential_name']==$vEss['essential']) 
					    { 
			              echo h($uVess['UsersVacanciesEssential']['essential_comments']); 
						}
						else
						{
					     echo h('');
						}
						endforeach;
						?>
					</td>
				  </tr>
				  <?php $i++; endforeach; ?>
			  </tbody>
		     
			  <!--tbody>
			      <?php //$i=1; foreach($userInfo['VacanciesEssential'] as $uVess): ?>
					   <?php //if($uVess['vacancy_id']== $vacancyId) 
					    //{ 
						?>
					 <tr>
                       <td><center><?php //echo h($i);?></center></td>
					   <td><?php //echo ucfirst(h($uVess['essential_name']));?> </td>
					   <td>
					     <?php //echo h($uVess['UsersVacanciesEssential']['essential_comments']); ?>
					   </td>
					  </tr> 
					   <?php
                         //$i++;					    
						//}
					   ?>
                  <?php //endforeach; ?>					
		       </tbody--> 
			</table> 
		   </div>	
         </div>
       </div>
     <?php  $showBlock = false; 
	     foreach($userInfo['VacanciesDesirable'] as $uVdss): 
	    
		 if($uVdss['vacancy_id']== $vacancyId) 
	       {
		    $showBlock = true;
		     break;
		   }	 
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
			      <tr>
				    <?php $i=1; foreach($vacancy['Desirable'] as $vDss): ?>
				    <td><center><?php echo h($i);?></center></td>
					<td><?php echo ucfirst(h($vDss['desirable']));?> </td>
					<td>
					  <?php foreach($userInfo['VacanciesDesirable'] as $uVdss): ?>
					   <?php if($uVdss['vacancy_id']== $vacancyId && $uVdss['desirable_name']==$vDss['desirable']) 
					    { 
			              echo h($uVdss['UsersVacanciesDesirable']['desirable_comments']); 
						}
						else
						{
					     echo h('');
						}
						endforeach;
						?>
					</td>
				  </tr>
				  <?php $i++; endforeach; ?>
			  </tbody>
		      
			  
			  <!--tbody>
			      <?php //$i=1; foreach($userInfo['VacanciesDesirable'] as $uVdss): ?>
					   <?php //if($uVdss['vacancy_id']== $vacancyId) 
					    //{
						?>
					 <tr>
                       <td><center><?php //echo h($i);?></center></td>
					   <td><?php //echo ucfirst(h($uVdss['desirable_name']));?> </td>
					   <td>
					     <?php //echo h($uVdss['UsersVacanciesDesirable']['desirable_comments']); ?>
					   </td>
					  </tr> 
					   <?php
					    //$i++;
						//}
					   ?>
                  <?php //endforeach; ?>					
		       </tbody--> 
			</table> 
		   </div>	
         </div>
       </div>	
		<?php
          }
        ?>		  
                              		<!--Write Ups-->
        <?php if($vacancy['Post']['post_name']=='Chairman' || $vacancy['Post']['post_name']=='Dy. Chairman' )
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
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['write_up1_data']));?></td>
					    <?php if(($serviceInfo['ServiceAndBatchInfo']['write_up_1']!=NULL) || !empty($serviceInfo['ServiceAndBatchInfo']['write_up_1']))  
						 {
						?>
						 <td><center>
						  <?php echo $this->Html->link(false,'/service_and_batch_infos/dwn_self_write_up_1/'.$serviceInfo['ServiceAndBatchInfo']['id'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?>
						 </center></td>
					    <?php
						 }
						?>
					  </tr>
					  <tr>
						<th>Write-up on how the applicant can full-fill and advance the mission and objectives of the organization that he seeks to join:</th>
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['write_up2_data']));?></td>
					    <?php if(($serviceInfo['ServiceAndBatchInfo']['write_up_2']!=NULL) || !empty($serviceInfo['ServiceAndBatchInfo']['write_up_2']))  
						 {
						?>
						 <td><center>
						  <?php echo $this->Html->link(false,'/service_and_batch_infos/dwn_self_write_up_2/'.$serviceInfo['ServiceAndBatchInfo']['id'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?>
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
				<?php if($userInfo['InformationUser']['working_under']!='Private Organization') {?>
					  <tr>
						<th style="width:50%">Scale of Pay</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_scale_pay']));?></td>
					  </tr>
					  <tr>
						<th>Grade Pay</th>
						<td>
						  <?php
						      if(($userInfo['InformationUser']['present_grade_pay'])==null)
						           echo h('NA');
							  else
                                echo ucfirst(h($userInfo['InformationUser']['present_grade_pay'])); 
						   ?>
					    </td>
					  </tr>
					  <tr>
						<th>Date from which in this Pay</th>
						<td>
						   <?php 
						        if($userInfo['InformationUser']['strt_dt_of_pay']!=null)
								 {
								  echo h(date('d/m/Y',strtotime($userInfo['InformationUser']['strt_dt_of_pay'])));
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
				<?php if($userInfo['InformationUser']['working_under']=='Private Organization') {?>
					  <tr>
						<th style="width:50%">Consolidated Emoluments</th>
						<td><?php echo ucfirst(h('Rs. '.$userInfo['InformationUser']['consolidated_emoluments']));?></td>
					  </tr>
				<?php } ?>
				
					  <!--tr>
						<th></th>
						<td><?php //echo date('d/m/Y',strtotime($userInfo['InformationUser']['period_of_appoint_dt'])); ?></td>
					  </tr-->
					  <tr>
						<th>Category to which you belong</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['community'])); ?></td>
						<?php 
						  if($userInfo['InformationUser']['community']!='General')
						    {
						?>
                        <td class="no-print">
                        <?php   						
						  echo $this->Html->link(false,'/users/download_self_caste_pdf/'.$userInfo['InformationUser']['id'],array('fullbase'=>true,'class'=>'fa fa-download')); 
						?>
						</td>
						<?php } ?>
					  </tr>
					  <tr>
					     <th>State clearly whether in light of entries made by you above, you meet the requirements of the post</th>
					     <td><?php echo ucfirst(h($userInfo['InformationUser']['statement'])); ?></td>
					  </tr>
					  <tr>
						<th>Additional Information, if any, which you would like to mention in support of your suitability for the post</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['additional_info'])); ?></td>
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
				echo $this->Html->image('/users/download_self_profile_sign/', array('alt' => 'Signature','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
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
					  <?php if(!$appliedVacancy)
					     {
					       $dt = new DateTime();
						   echo h($dt->format('d/m/Y'));
						  }
                        else
                          {
						    echo h(date('d/m/y',strtotime($applyingDate['UserAppliedVacancy']['applied_on'])));
						  }						
						?>
					  <p>			
				  </div> 
		   </div>
          
            <div class="row no-print">
                 <div class="col-xs-6">
                      <?php if(!$appliedVacancy) 
			            {
			           ?>	
						  <?php echo $this->Form->create('UserAppliedVacancy',array('role'=>'form','action'=>'apply_for_vacancy','class'=>'pull-right')); ?>
						  <?php echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id'))); ?>
						  <?php echo $this->Form->input('vacancy_id',array('type'=>'hidden','value'=>$vacancy['Vacancy']['id'])); ?>
						  <button class="btn btn-lg btn-flat btn-success" onclick="return confirm('Are you sure you want to Apply?')"><i class="fa fa-credit-card"></i> Apply </button>
				          <?php echo $this->Form->end(); ?>
                     <?php
			          }
			         ?>
                  </div>
                  <div class="col-md-12">				  
				    <button class="btn btn-default" onclick='window.print()'><i class="fa fa-print"></i> Print</button>
				    <!--button style="margin-right: 5px;" class="btn btn-primary btn-success pull-right" onclick="location.href='<?php //echo $this->Html->url(array('action'=>'applied_vacancy_export_pdf',$vacancy['Vacancy']['id']));?>'"><i class="fa fa-download"></i> Generate PDF</button-->				
			      </div>
          </div>
		<?php
		  }
		  ?>
		
   </section>
</div>