<div class="row">
   <section class="invoice">
      <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i>
				Job Id : <?php echo ucfirst(h($vacancy['Notice']['advt_number'])); ?>
				<small class="pull-right">Date: <?php $dt = new DateTime();
                                                      echo $dt->format('d/m/Y');
                                                ?>
				</small>
				 </h2>
				  
                
             <?php if($appliedVacancy)
				  {
				?>
                <div class="alert alert-warning row margin">
                   <i class="icon fa fa-check"></i> You have Successfully Applied for this Job on : <?php echo date('d/m/y',strtotime($applyingDate['UserAppliedVacancy']['applied_on'])); ?>
                </div>
                <?php				
				  }
				?>
            </div><!-- /.col -->
      </div>
	  <div class="row margin">
          <div class="col-xs-12 bg-green">
            <p class="lead">Job Info</p>
                <div class="col-xs-4 table-responsive">
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th style="width:50%">Post Applied For</th>
						<td><?php echo ucfirst($vacancy['Post']['post_name']);?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
                <div class="col-xs-4 table-responsive">
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th style="width:50%">Organization</th>
						<td><?php echo ($vacancy['Organization']['organization_name']);?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
                <div class="col-xs-4 table-responsive">
					<table class="table no-border">
					  <tbody>
					  <tr>
						<th style="width:50%">Department</th>
						<td><?php echo ($vacancy['Department']['department_name']);?></td>
					  </tr>
					  </tbody>
                    </table>
                </div>
              </div>						
	  </div>
	  <div class="row">
	    <div class="col-xs-12">
          <center><p class="lead"><b>Bio Data Performa</b></p></center>
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
						<th>Official Address</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['pa_address'].' ,</br> '.$userInfo['InformationUser']['PaState']['state_name'].' , '.$userInfo['InformationUser']['PaCity']['city_name'].' ,</br> '.$userInfo['InformationUser']['pa_pincode'])); ?></td>
					  </tr>
					  <tr>
						<th>Residential Address</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['ca_address'].', </br>'.$userInfo['InformationUser']['CaState']['state_name'].' , '.$userInfo['InformationUser']['CaCity']['city_name'].' ,</br> '.$userInfo['InformationUser']['ca_pincode'])); ?></td>
					  </tr>
					  <tr>
						<th>Contact Number</th>
						<td>(O) <?php echo ucfirst(h($userInfo['InformationUser']['pa_std_code'].'-'.$userInfo['InformationUser']['pa_landline_num']. '  ,  ' .$userInfo['User']['mobile_number'])); ?></br>	   
					    (R) <?php echo ($userInfo['InformationUser']['ca_std_code'].'-'.$userInfo['InformationUser']['ca_landline_num'].' , '.$userInfo['InformationUser']['ca_mobile_number']); ?></td>
					  </tr>
					  <?php if($vacancy['Post']['post_name']=='Chairman' || $vacancy['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
						<th>Service</th>
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['service'])); ?></td>
					  </tr>
					  <tr>
						<th>Batch</th>
						<td><?php echo ($serviceInfo['ServiceAndBatchInfo']['batch']); ?></td>
					  </tr>
					  <?php
					    }
					   ?>	
					  <tr>
						<th>Date Of Birth</th>
						<td><?php echo (date('d/m/Y',strtotime($userInfo['InformationUser']['d_o_b']))); ?></td>
					  </tr>
					  <?php if($vacancy['Post']['post_name']!='Chairman' && $vacancy['Post']['post_name']!='Dy. Chairman')
					   {
					  ?>
					  <tr>
						<th>Date Of Initial Appointment</th>
						<td><?php echo date('d/m/Y',strtotime($userInfo['InformationUser']['d_o_i_appoint'])); ?></td>
					  </tr>
					  <?php
					    }
					  ?>	
					  <tr>
						<th>Date of Retirement</th>
						<td><?php echo (date('d/m/Y',strtotime($userInfo['InformationUser']['d_o_r']))); ?></td>
					  </tr>
					</tbody></table>
				  </div>	
				                  <!--Profile Pic-->
			<div class="col-xs-2 table-responsive pull-right">
						<table class="table">
					     <tbody>
					       <tr>
							<?php
							echo $this->Html->image('/uploads/userimages/'.$userInfo['User']['profilepic'], array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
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
			    <p class="lead">Educational Qualifications</p>
				 <div class="table-responsive">
					<table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Qualification</th>
					<th>University</th>
                    <th>Year Of Passing</th>
                    <th>Class</th>
                    <th>%Obtained</th>
					<th>Special Subject</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($userInfo['UserQualification'] as $education): ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo ucfirst(h($education['EducationQualification']['education_qualification'])); ?></td>
						<td><?php echo ucfirst(h($education['university'])); ?></td>
						<td><?php echo ucfirst(h($education['y_o_p'])); ?></td>
						<td><?php echo ucfirst(h($education['class_type'])); ?></td>
						<td><center><?php echo ucfirst(h($education['perc_obtained'])); ?></center></td>
						<td><?php echo ucfirst(h($education['special_subject'])); ?></td>
					</tr>
				<?php $i++;endforeach; ?>
                </tbody>
              </table>
			   </div>
            </div>        
        </div>
                <!--Statement-->
        <div class="row">
		   <div class="col-xs-12">
				  <div class="col-xs-12 table-responsive">
					<table class="table">
					  <tbody>
					  <!--tr>
						<th style="width:50%">Statement</th>
						<td><?php //echo ucfirst(h($userInfo['User']['f_name'].' '.$userInfo['User']['m_name'].' '.$userInfo['User']['l_name']));?></td>
					  </tr-->
					  <?php if($vacancy['Post']['post_name']=='Chairman' || $vacancy['Post']['post_name']=='Dy. Chairman' )
					   {
					  ?>
					  <tr>
						<th>Total Service Rendered In Group 'A' Post</th>
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['srvc_rndr_grp_a']));?></td>
					  </tr>
					  <tr>
						<th>Total Experience In Port & Shipping Sectors,if any</th>
						<td><?php echo ucfirst(($serviceInfo['ServiceAndBatchInfo']['exp_prt_ship'])); ?></td>
					  </tr>
					  <?php 
					   }
					  ?>
					  </tbody>
					</table>
				  </div>
            </div>   				  
        </div>	
                         <!--Employment Details-->
        <div class="row">
            <div class="col-xs-12">
			    <p class="lead">Employment Details/Experience Details</p>
				 <div class="table-responsive">
					<table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.No.</th>
						<th>Organization Name</th>
						<th>Posts Held</th>
						<th>Scale Of Pay</th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Nature Of Duties</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($userInfo['UserEmploymentDetail'] as $service): ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo ucfirst(h($service['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($service['post_held'])); ?></td>
						<td><?php echo ucfirst(h($service['scale_of_pay'])); ?></td>
						<td><?php echo ucfirst(h($service['from_date'])); ?></td>
						<td><?php echo ucfirst(h($service['to_date'])); ?></td>
						<td><?php echo ucfirst(h($service['nature_of_duties'])); ?></td>
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
						<th>Type Of Present Employment</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_emp_type']));?></td>
					  </tr>
					  <tr>
						<th>Date Of Initial Appointment(Deputation/Transfer)</th>
						<td><?php echo date('d/m/Y',strtotime($userInfo['InformationUser']['dt_appoint_date'])); ?></td>
					  </tr>
					  <tr>
						<th>Period of Appointment on Deputation/Transfer Basis</th>
						<td><?php echo date('d/m/Y',strtotime($userInfo['InformationUser']['period_of_appoint_dt'])); ?></td>
					  </tr>
					  <tr>
						<th>Name of Parent Office/Organization to which you belong</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['name_o_p_orgn'])); ?></td>
					  </tr>
					  <tr>
						<th>Working Under</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['working_under'])); ?></td>
					  </tr>
					  </tbody>
					</table>
				  </div>
            </div>   				  
        </div>
                             <!--Write Ups-->
        <?php if($vacancy['Post']['post_name']=='Chairman' || $vacancy['Post']['post_name']=='Dy. Chairman' )
		  {
		 ?>
		<div class="row">
		   <div class="col-xs-12">
		        <p class="lead">Write Ups</p>
				  <div class="col-xs-12 table-responsive">
					<table class="table table-bordered table-striped">
					  <tbody>
					  <tr>
						<th style="width:50%">Write-up on the professional experience and Core-Competence of the officer in handling the assignment applied for:</th>
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['write_up1_data']));?></td>
					  </tr>
					  <tr>
						<th>Write-up on how the applicant can full-fill and advance the mission and objectives of the organization that he seeks to join:</th>
						<td><?php echo ucfirst(h($serviceInfo['ServiceAndBatchInfo']['write_up2_data']));?></td>
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
					  <tr>
						<th style="width:50%">Scale of Pay</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_scale_pay']));?></td>
					  </tr>
					  <tr>
						<th>Grade of Pay</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_grade_pay']));?></td>
					  </tr>
					  <tr>
						<th>Date from which in this Pay</th>
						<td><?php echo date('d/m/Y',strtotime($userInfo['InformationUser']['strt_dt_of_pay'])); ?></td>
					  </tr>
					  <!--tr>
						<th></th>
						<td><?php //echo date('d/m/Y',strtotime($userInfo['InformationUser']['period_of_appoint_dt'])); ?></td>
					  </tr-->
					  <tr>
						<th>Community to which you belong</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['community'])); ?></td>
					  </tr>
					  </tbody>
					</table>
				  </div>
            </div>   				  
        </div>		
                      <!--Declaration-->
        	<div class="row margin">
			  <div class="col-xs-12">
				  <p class="lead">Declaration</p>		  
				      <p style="margin-top: 10px;" class="text-muted well well-sm no-shadow">
						   I hereby declare that all the details furnished above are true to the best of my knowledge and belief.In the event of selection to the post, I will not withdraw my candidature for the post and undertake to accept the posting
				      </p>
			  </div>
			</div>
            <div class="row margin">			
			  <div class="col-xs-2 pull-right">
			   <?php
				echo $this->Html->image('/uploads/userimages/'.$userInfo['User']['profilesignature'], array('alt' => 'Signature','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
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
						   echo $dt->format('d/m/Y');
						  }
                        else
                          {
						    echo date('d/m/y',strtotime($applyingDate['UserAppliedVacancy']['applied_on']));
						  }						
						?>
					  <p>			
				  </div> 
		   </div>
          
            <div class="row no-print">
                 <div class="col-xs-12">
                      <?php if(!$appliedVacancy) 
			            {
			           ?>	
						  <?php echo $this->Form->create('UserAppliedVacancy',array('role'=>'form','action'=>'apply_for_vacancy','class'=>'pull-right')); ?>
						  <?php echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id'))); ?>
						  <?php echo $this->Form->input('vacancy_id',array('type'=>'hidden','value'=>$vacancy['Vacancy']['id'])); ?>
						  <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Apply </button>
				          <?php echo $this->Form->end(); ?>
                     <?php
			          }
			         ?>				
				  <button class="btn btn-default" onclick='window.print()'><i class="fa fa-print"></i> Print</button>
				  <button style="margin-right: 5px;" class="btn btn-primary btn-success pull-right" onclick="location.href='<?php echo $this->Html->url(array('action'=>'applied_vacancy_export_pdf',$vacancy['Vacancy']['id']));?>'"><i class="fa fa-download"></i> Generate PDF</button>				
			   </div>
          </div>		  
   </section>
</div>