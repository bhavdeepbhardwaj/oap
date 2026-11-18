<style>
table, th, td {
   // border: 1px solid black;
}

table.type1 th, td {
    padding: 10px;
}
table.texttable th, td
{
	width:50%;
}
</style>
<table class="type1" style="width:100%; border-bottom:1px solid; margin-bottom:5px; padding-bottom:5px">
	<tr>
		<td>
			<h2>Application Id : <?php echo ucfirst(h($applyingUser['Vacancy']['Notice']['advt_number'])); ?></h2>
		</td>
		<td align="right">
			<small>
				<b>Applied On : </b>
					<?php 
                            echo h(date('d/m/Y',strtotime($applyingUser['UserAppliedVacancy']['applied_on'])));
                    ?>
			</small>
		</td>
	</tr>
</table>

<table  class="type1" style="width:100%; border-bottom:1px; margin-bottom:5px; padding-bottom:5px">
	<tr>
			<td colspan="2">
				<center><h4>Applied For : </h4></center>
			</td>
	</tr>		
	<tr>
		 <?php if(!empty($applyingUser['Vacancy']['Department']['department_name']))
			  {
				$varWidth=33;
			  }
			  else
			  {
				$varWidth=50;
			  }
			  
             ?>
		<td style="background-color:#00a65a;" width="<?php echo $varWidth;?>%">
			<table width="100%">
				<tr>
					<th width="20%" align="left">Post : </th>
					<td width="80%" align="left"><?php echo ucfirst(h($applyingUser['Vacancy']['Post']['post_name']));?></td>
				</tr>
			</table>
		</td>
		<td style="background-color:#f39c12;" width="<?php echo $varWidth;?>%">
			<table width="100%">
				<tr>
					<th align="left" width="40%">Organization :</th>
					<td width="60%" align="left"><?php echo (h($applyingUser['Vacancy']['Organization']['organization_name']));?></td>
				</tr>
			</table>
		 
		 </td>
		 <?php if(!empty($applyingUser['Vacancy']['Department']['department_name']))
			  {
             ?>	
		<td style="background-color:#00a65a;" width="<?php echo $varWidth+1;?>%">
			<table width="100%">
				<tr>
					<th align="left">Department :</th>
					<td width="60%" align="left"><?php echo (h($applyingUser['Vacancy']['Department']['department_name']));?></td>
		
				</tr>
			</table>
		</td>	
		<?php
              }
             ?>	
	</tr>
</table>

<table class="type1" width="100%">
	<tr>
		<td colspan="2">
				<center><h4>Bio Data Proforma</h4></center>
			</td>
	</tr>
	<tr>
		<td width="80%">
		
				<table class="texttable">
					  
					  <tr>
						<th align="left">Name</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['f_name'].' '.$applyingUser['LogInformationUser']['m_name'].' '.$applyingUser['LogInformationUser']['l_name']));?></td>
					  </tr>
					  <tr>
						<th align="left">Designation</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['present_post']));?></td>
					  </tr>
					  <tr>
						<th align="left">Organization</th>
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
						<th align="left">Official Address</th>
						<td><?php echo ucfirst((h($applyingUser['LogInformationUser']['o_address']).' ,</br> '.h($applyingUser['LogInformationUser']['o_state_name']).' , '.h($applyingUser['LogInformationUser']['o_city_name']).' ,</br> '.h($applyingUser['LogInformationUser']['o_pincode']))); ?></td>
					  </tr>
					  <tr>
						<th align="left">Residential Address</th>
						<td><?php echo ucfirst((h($applyingUser['LogInformationUser']['r_address']).', </br>'.h($applyingUser['LogInformationUser']['r_state_name']).' , '.h($applyingUser['LogInformationUser']['r_city_name']).' ,</br> '.h($applyingUser['LogInformationUser']['r_pincode']))); ?></td>
					  </tr>
					  <tr>
						<th align="left">Contact Number</th>
						<td>(O) <?php echo ucfirst(h($applyingUser['LogInformationUser']['o_std_code'].'-'.$applyingUser['LogInformationUser']['o_landline_num']. '  ,  ' .$applyingUser['LogInformationUser']['mobile_number'])); ?></br>	   
					    (R) <?php echo h($applyingUser['LogInformationUser']['r_std_code'].'-'.$applyingUser['LogInformationUser']['r_landline_num'].' , '.$applyingUser['LogInformationUser']['r_mobile_number']); ?></td>
					  </tr>
					  <tr>
						<th align="left">Email Id</th>
						<td><i class="fa fa-envelope-o"></i>  <?php echo h($applyingUser['User']['email']);?></td>
					  </tr>
					  <?php if($applyingUser['Vacancy']['Post']['post_name']=='Chairman' || $applyingUser['Vacancy']['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
						<th align="left">Service , Batch & Cadre</th>
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
						<th align="left">Date Of Joining Group A Service</th>
						<td><?php echo h(date('d/m/Y',strtotime($applyingUser['LogServiceAndBatchInfo']['doj_grp_a']))); ?></td>
					  </tr>
					  <?php
					    }
					   ?>	
					  <tr>
						<th align="left">Date Of Birth</th>
						<td><?php echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['d_o_b']))); ?></td>
					  </tr>
					  <?php if($applyingUser['Vacancy']['Post']['post_name']!='Chairman' && $applyingUser['Vacancy']['Post']['post_name']!='Dy. Chairman')
					   {
					  ?>
					  <tr>
						<th align="left">Date Of Initial Appointment</th>
						<td><?php echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['d_o_i_appoint']))); ?></td>
					  </tr>
					  <?php
					    }
					  ?>	
					  <tr>
						<th align="left">Date of Retirement</th>
						<td><?php echo (h(date_format(date_create($applyingUser['LogInformationUser']['d_o_r']),'d-m-Y')))?></td>
					  </tr>
					</table>
		</td>
		<td width="20%" valign="top">
			<table class="table" style="border:1px solid #000">
			 <tbody>
			   <tr>
				<td>
					<?php
					 $dpImage = 'http://164.100.161.48/user_applied_vacancies/my_active_application_dp_for_pdf/'.$applyingUser['UserAppliedVacancy']['id'].'/active/'.$this->Session->read('Auth.User.id');
					//echo $this->Html->image('/user_applied_vacancies/my_active_application_dp_for_pdf/'.$applyingUser['UserAppliedVacancy']['id'].'/active/'.$this->Session->read('Auth.User.id'), array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
					?>
					<img src="<?php echo $dpImage;?>" alt="User Image" style="max-width:100px"> 
				</td>
			  </tr>	
			 </tbody>
			</table>
		</td>
	</tr>
</table>
<table class="type1">
    <tr>
		<td>
		    <h3>Educational Qualifications</h3>
		</td>
	</tr>
</table>	
<table style="width:100%; border:1px solid #f4f4f4;">
        <thead>
                  <tr style="background-color:#D9EDF7">
                    <th width="6%">S.No.</th>
                    <th width="20%">Qualification</th>
					<th width="17%">University</th>
                    <th width="14%">Year of Passing</th>
                    <th width="10%">Class</th>
                    <th width="10%">%</br>Obtained</th>
					<th width="23%">Special Subject</th>
					
                  </tr>
        </thead>
		<tbody>
                  <?php $i=1;foreach ($applyingUser['LogUserQualification'] as $education): ?>
					<tr>
						<td width="6%"><?php echo h($i);?></td>
						<td width="20%"><?php echo ucfirst(h($education['education_qualification_name'])); ?></td>
						<td width="17%"><?php echo ucfirst(h($education['university'])); ?></td>
						<td width="14%"><?php echo ucfirst(h($education['y_o_p'])); ?></td>
						<td width="10%"><?php echo ucfirst(h($education['class_type'])); ?></td>
						<td width="10%"><center><?php echo ucfirst(h($education['perc_obtained'])); ?></center></td>
						<td width="23%"><?php echo ucfirst(h($education['special_subject'])); ?></td>
					    
					</tr>
				<?php $i++;endforeach; ?>
        </tbody>
</table>
<table class="type1">
    <tr>
		<td>
		    <h3>Employment Details/Experience Details</h3>
		</td>
	</tr>
</table>
<table class="type1" style="width:100%; border:1px solid #f4f4f4;">
        <thead>
                  <tr style="background-color:#D9EDF7">
                        <th width="7%">S.No.</th>
						<th width="24%">Organization Name</th>
						<th width="16%">Posts Held</th>
						<th width="12%">Scale of Pay</th>
						<th width="10%">From Date</th>
						<th width="11%">To Date</th>
						<th width="20%">Nature of Duties</th>
					
                  </tr>
        </thead>
		<tbody>
                  <?php $i=1;foreach ($applyingUser['LogUserEmploymentDetail'] as $service): ?>
					<tr>
						<td width="7%"><?php echo h($i);?></td>
						<td width="24%"><?php echo ucfirst(h($service['organization_name'])); ?></td>
						<td width="16%"><?php echo ucfirst(h($service['post_held'])); ?></td>
						<td width="12%"><?php echo ucfirst(h($service['scale_of_pay'])); ?></td>
						<td width="10%"><?php echo ucfirst(h(date('d/m/Y',strtotime($service['from_date'])))); ?></td>
						<td width="11%"><?php echo ucfirst(h(date('d/m/Y',strtotime($service['to_date'])))); ?></td>
						<td width="20%"><?php echo ucfirst(h($service['nature_of_duties'])); ?></td>
					</tr>
				<?php $i++;endforeach; ?>
        </tbody>
</table>
<table class="type1">
                     <tr>
						<th align="left" style="width:50%">Nature of Present Employment</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['nature_of_present_emp']));?></td>
					 </tr>
					  <tr>
						<th align="left">Type of Present Employment</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['present_emp_type']));?></td>
					  </tr>
					    <?php 
                            if($applyingUser['LogInformationUser']['present_emp_type']=='Deputation' ||$applyingUser['LogInformationUser']['present_emp_type']=='Transfer' )
                              {							
						?>
					  <tr>
						<th align="left">Date of Initial Appointment(Deputation/Transfer)</th>
						<td>
						<?php  if($applyingUser['LogInformationUser']['dt_appoint_date']!=	NULL)
						{
						  echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['dt_appoint_date'])));
                        } ?>
                        </td>						
					  </tr>
					  <tr>
						<th align="left">Period of Appointment on Deputation/Transfer Basis</th>
						<td>
						<?php if($applyingUser['LogInformationUser']['period_of_appoint_dt']!=NULL)
						 {
						  echo h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['period_of_appoint_dt'])));
						 } 
						 ?>
						</td>    					  
					  </tr>
					  <tr>
						<th align="left">Name of Parent Office/Organization to which you belong</th>
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
						<th align="left">Working Under</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['working_under'])); ?></td>
					  </tr>
					  <?php if($applyingUser['LogInformationUser']['working_under']!='Private Organization') {?>
					  <tr>
						<th align="left">Continuous Regular Appointment Date</th>
						<td><?php echo ucfirst(h(date('d/m/Y',strtotime($applyingUser['LogInformationUser']['cont_reg_appoint_date'])))); ?></td>
					  </tr>
					  <tr>
						<th align="left">Belongs To</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['belong_to_ci'])); ?></td>
					  </tr>
					  <?php }?>
					  <?php if($applyingUser['Vacancy']['Post']['post_name']=='Chairman' || $applyingUser['Vacancy']['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
					    <th align="left">Total Service Rendered in Group 'A' Post</th>
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
						<th align="left">Total Experience in Port & Shipping Sectors,if any</th>
						<td><?php echo ucfirst(h($applyingUser['LogServiceAndBatchInfo']['exp_prt_ship'])); ?></td>
					  </tr>
					  <?php 
					   }
					  ?>
</table>
<table>
 <tr>
    <td>
      <h3>Essentials and Desirables</h3>
   </td>
 </tr>
</table>
<table class="type1" style="width:100%; border:3px solid #f4f4f4;">
			      <thead>
				    <tr style="background-color:#D9EDF7">
					  <th width="6%">S.No.</th>
					  <th width="47%">Essentials</th>
					  <th width="47%">Your Comments</th>
					</tr> 
				  </thead>
			  
		    <tbody>
			  
			      <?php $i=1; foreach($userEss as $userVEss): ?>
				   <tr>	
                       <td width="6%"><center><?php echo $i;?></center></td>
					   <td width="47%">
					      <?php echo ucfirst(h($userVEss['VacanciesEssential']['essential_name']));?> 
					   </td>
					    <?php
						  foreach($userVEss['UsersVacanciesEssential'] as $userVessc): ?>
					      <?php if($userVessc['user_id']==$userId) 
						  {
					    ?> 
					   <td width="47%">
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
</br>
</br>
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
	  
<table class="type1" style="width:100%; border:3px solid #f4f4f4;">
			      <thead>
				    <tr style="background-color:#D9EDF7">
					  <th width="6%">S.No.</th>
					  <th width="47%">Desirables</th>
					  <th width="47%">Your Comments</th>
					</tr> 
				  </thead>
				  <tbody>
			      <?php $i=1; foreach($userDss as $Vdss): ?>
					 <tr>
                       <td width="6%"><center><?php echo $i;?></center></td>
					   <td width="47%"><?php echo ucfirst(h($Vdss['VacanciesDesirable']['desirable_name']));?> </td>
					   <td width="47%"> 
						<?php foreach($Vdss['UsersVacanciesDesirable'] as $userVdss ): 
						      if($userVdss['user_id']== $userId) 
					            {
						?>
								   
									 <?php echo h($userVdss['desirable_comments']); ?>
								   
						<?php  
						        }
						   endforeach; 
						?>
                        </td>						
					  </tr> 
                  <?php $i++; endforeach; ?>					
		       </tbody>
</table>	  
	  
<?php }?>

<br/>
           <!-- For write ups -->
<?php if($applyingUser['Vacancy']['Post']['post_name']=='Chairman' || $applyingUser['Vacancy']['Post']['post_name']=='Dy. Chairman' )
		  {
		 ?>	  
			<table class="type1" style="width:100%; border:3px solid #f4f4f4;">
				  <tr colspan="2">
					<td>
					  <h3>Write-ups</h3>
					</td>
				  </tr>
				  <tr>
					<th align="left" style="width:50%">Write-up on the professional experience and Core-Competence of the officer in handling the assignment applied for:</th>
					<td><?php echo ucfirst(h($applyingUser['LogServiceAndBatchInfo']['write_up1_data']));?></td>
				  </tr>
				  <tr>
						<th align="left" style="width:50%">Write-up on how the applicant can full-fill and advance the mission and objectives of the organization that he seeks to join:</th>
						<td><?php echo ucfirst(h($applyingUser['LogServiceAndBatchInfo']['write_up2_data']));?></td>
				  </tr>					   
	        </table>
<?php }?>			
<table class="type1">
                    <?php if($applyingUser['LogInformationUser']['working_under']!='Private Organization') {?>
					  <tr>
						<th align="left" style="width:50%">Scale of Pay</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['present_scale_pay']));?></td>
					  </tr>
					  <tr>
						<th align="left">Grade Pay</th>
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
						<th align="left">Date from which in this Pay</th>
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
					  <?php }?>
					  
					  							   <!-- For Private Orgn -->
						<?php if($applyingUser['LogInformationUser']['working_under']=='Private Organization') {?>
							  <tr>
								<th align="left" style="width:50%;">Consolidated Emoluments</th>
								<td><?php echo ucfirst(h('Rs. '.$applyingUser['LogInformationUser']['consolidated_emoluments']));?></td>
							  </tr>
						<?php } ?>
					  
					  <!--tr>
						<th></th>
						<td><?php //echo date('d/m/Y',strtotime($applyingUser['LogInformationUser']['period_of_appoint_dt'])); ?></td>
					  </tr-->
					  <tr>
						<th align="left">Category to which you belong</th>
						<td><?php 
						      echo ucfirst(h($applyingUser['LogInformationUser']['community'])); 
							?>
						</td>
					  </tr>
					  <tr>
					     <th align="left">State clearly whether in light of entries made by you above, you meet the requirements of the post</th>
					     <td><?php echo ucfirst(h($applyingUser['LogInformationUser']['statement'])); ?></td>
					  </tr>
					  <tr>
						<th align="left">Additional Information, if any, which you would like to mention in support of your suitability for the post</th>
						<td><?php echo ucfirst(h($applyingUser['LogInformationUser']['additional_info'])); ?></td>
					  </tr>
</table>
<table>
  <tr>
    <td><h3>Declaration</h3></td>
  </tr>
  <tr>
    <td style="background-color:#f5f5f5; border:1px solid #e3e3e3">
	   I hereby declare that all the details furnished above are true to the best of my knowledge and belief.In the event of selection to the post, I will not withdraw my candidature for the post and undertake to accept the posting
	</td>
  </tr>
  <tr>
    <td width="20%" align="right">
	  <?php
	      $signImage = 'http://164.100.161.48/user_applied_vacancies/my_active_application_sign_for_pdf/'.$applyingUser['UserAppliedVacancy']['id'].'/active/'.$this->Session->read('Auth.User.id');
		  //echo $this->Html->image('/user_applied_vacancies/my_active_application_sign_for_pdf/'.$applyingUser['UserAppliedVacancy']['id'].'/active/'.$this->Session->read('Auth.User.id'), array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
	    ?>
	  	<img src="<?php echo $signImage;?>" alt="User Image" style="max-width:100px"> 
	</td>
  </tr>
  <tr>
    <td width="30%" align="right">
	  <h4>Signature of the candidate</h4>
	</td>
  </tr>
  <tr>
    <td width="30%" align="right">
	  <h4><b>Date: </b><?php echo h(date('d/m/Y',strtotime($applyingUser['UserAppliedVacancy']['applied_on'])));?></h4>
	</td>
  </tr>
</table>
			