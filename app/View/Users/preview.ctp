<?php //pr($userInfo); ?>
<div class="row">
<section class="invoice">
      <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i>
				<?php echo ucfirst(h($userInfo['User']['f_name']." ".$userInfo['User']['m_name']." ".$userInfo['User']['l_name'])); ?>
                <small class="pull-right">Date: <?php $dt = new DateTime();
                                                      echo h($dt->format('d/m/Y'));
                                                ?>
				</small>
              </h2>
            </div><!-- /.col -->
      </div>
    
	 <div class="row">  
		 <div class="col-xs-12">
		        <p class="lead">Profile Info</p>
				  <div class="col-xs-5 table-responsive">
					<table class="table">
					  <tbody><tr>
						<th style="width:50%">Father's Name</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['uf_f_name'].' '.$userInfo['InformationUser']['uf_m_name'].' '.$userInfo['InformationUser']['uf_l_name']));?></td>
					  </tr>
					  <tr>
						<th>Mother's Name</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['um_f_name'].' '.$userInfo['InformationUser']['um_m_name'].' '.$userInfo['InformationUser']['um_l_name']));?></td>
					  </tr>
					  <tr>
						<th>Gender</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['gender'])); ?></td>
					  </tr>
					  <tr>
						<th>Category</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['community'])); ?></td>
					  </tr>
					  <!--tr>
						<th>Religion</th>
						<td><?php //echo ucfirst(h($userInfo['InformationUser']['religion'])); ?></td>
					  </tr-->
					  <tr>
						<th>Date of Birth</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['d_o_b'])); ?></td>
					  </tr>
					  <tr>
						<th>Place of Birth</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['State']['state_name'].' , '.$userInfo['InformationUser']['p_o_b'])); ?></td>
					  </tr>
					</tbody></table>
				  </div>	
				 <div class="col-xs-5 table-responsive"> 
					<table class="table">
					  <tbody>
					  <tr>
						<th style="width:50%">Nationality</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['Nationality']['nationality_name'])); ?></td>
					  </tr>
					  <tr>
						<th>Marital Status</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['marital_status'])); ?></td>
					  </tr>
					  <tr>
						<th>Physically Challenged</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['physically_challenged'])); ?></td>
					  </tr>
					  <?php 
					   if($userInfo['InformationUser']['physically_challenged']!='No')
					    {
					  ?>
					  <tr>
						<th>Type of Disability</th>
						<td><?php 
						   if($userInfo['InformationUser']['disability_name']!='Others')
						      echo ucfirst(h($userInfo['InformationUser']['disability_name'])); 
						   else
						      echo ucfirst(h($userInfo['InformationUser']['disability_name'].'('.$userInfo['InformationUser']['other_disability'].')'));
						  ?>
						
						</td>
					  </tr>
					  <?php
					   }
					  ?> 
					  <?php //if(!empty($userInfo['InformationUser']['hobbies']))
					  //{
                      ?> 						  
					  <!--tr>
						<th>Hobbies</th>
						<td><?php //echo ucfirst(h($userInfo['InformationUser']['hobbies'])); ?></td>
					  </tr-->
					  <?php
					  //}
					  ?>
					  <tr>
						<th>Email Id</th>
						<td><?php echo ($userInfo['User']['email']); ?></td>
					  </tr>
					</tbody></table>
				  </div>  
			<div class="col-xs-2 table-responsive">
						<table class="table">
					     <tbody>
					       <tr>
							<?php
							echo $this->Html->image('/users/download_self_profile_pic/', array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
							?>
                          </tr>	
                         </tbody></table>						  
			</div>		
      </div>
  </div>	
	<div class="row">
	  <div class="col-xs-6 ">
			    <p class="lead">Contact Details</p>
				 <div class="table-responsive">
					<table class="table table-bordered">
					  <tbody>
					  <tr>
						<th style="width:50%">Office Address</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['o_address']).' ,</br> '.h($userInfo['InformationUser']['OState']['state_name']).' , '.h($userInfo['InformationUser']['OCity']['city_name']).' , '.h($userInfo['InformationUser']['o_pincode'])); ?></td>
					  </tr>
					  <tr>
						<th>Landline Number</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['o_std_code'].'-'.$userInfo['InformationUser']['o_landline_num'])); ?></td>
					  </tr>
					  <tr>
						<th>Mobile Number</th>
						<td><?php echo ucfirst(h($userInfo['User']['mobile_number'])); ?></td>
					  </tr>
					</tbody></table>
				  </div>  
			</div>
			<div class="col-xs-6">
			    <p class="lead">&nbsp;</p>
				 <div class="table-responsive">
					<table class="table table-bordered">
					  <tbody>
					  <tr>
						<th>Residential Address</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['r_address']).', </br>'.h($userInfo['InformationUser']['RState']['state_name']).' , '.h($userInfo['InformationUser']['RCity']['city_name']).' , '.h($userInfo['InformationUser']['r_pincode'])); ?></td>
					  </tr>
					  <tr>
						<th>Landline Number</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['r_std_code'].'-'.$userInfo['InformationUser']['r_landline_num'])); ?></td>
					  </tr>
					  <tr>
						<th>Mobile Number</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['r_mobile_number'])); ?></td>
					  </tr>
					</tbody></table>
					</div>  
			</div>
		
	</div>
	
  <div class="row">
      <div class="col-xs-12">
			    <p class="lead">Educational Details</p>
				 <div class="table-responsive">
					<table class="table table-bordered table-striped">
                <thead>
                  <tr>
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
                  <?php $i=1;foreach ($userInfo['UserQualification'] as $education): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($education['EducationQualification']['education_qualification'])); ?></td>
						<td><?php echo ucfirst(h($education['university'])); ?></td>
						<td><?php echo ucfirst(h($education['y_o_p'])); ?></td>
						<td><?php echo ucfirst(h($education['class_type'])); ?></td>
						<td><center><?php echo ucfirst(h($education['perc_obtained'])); ?></center></td>
						<td><?php echo ucfirst(h($education['special_subject'])); ?></td>
						<td class="no-print"><center><?php echo $this->Html->link(false,'/user_qualifications/dwn_self_quali_doc/'.$education['id'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
					</tr>
				<?php $i++;endforeach; ?>
                </tbody>
              </table>
			   </div>
            </div>        
   </div>
   <div class="row">
     <div class="col-xs-12">
              <p class="lead">Current Service Details</p>
              <div class="table-responsive">
                <table class="table table-striped">
				   <thead>
                  <tr>
                    <th>Current Organization</th>
					<th>Date of Retirement</th>
                    <th>Present Post</th>
                    <th>Present Scale of Pay</th>
                    <th>Continuous Regular Appointment Date</th>
                  </tr>
                  </thead>
				  <tbody>
				   <tr>
				      <td>
					     <?php 
                            if($userInfo['InformationUser']['present_emp_type']=='Deputation' ||$userInfo['InformationUser']['present_emp_type']=='Transfer' )
                              {							
						        if($userInfo['InformationUser']['current_organization_text']!='Others')
								{
							     echo ucfirst(h($userInfo['InformationUser']['current_organization_text']));
							    }
								else
								{	
								 echo ucfirst(h($userInfo['InformationUser']['current_organization_text'].'('.$userInfo['InformationUser']['other_current_organization'].')'));	
								}
							  }
                            else
                             {
	                          echo ucfirst(h($userInfo['User']['organization_name']));  						 
							 }							
					     ?>
					  </td>
						<td><?php echo (h(date_format(date_create($userInfo['InformationUser']['d_o_r']),'d-m-Y')))?></td>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_post'])); ?></td>
						<td><?php 
						        if($userInfo['InformationUser']['present_scale_pay']!=null)
							     {
						           echo ucfirst(h($userInfo['InformationUser']['present_scale_pay']));
								 }
								 else
								 {
									echo h('NA'); 
								 }
							?>	 		 
						</td>
						<td><?php 
						       if($userInfo['InformationUser']['cont_reg_appoint_date']!=null)
							   {								   
						        echo (h(date('d/m/Y',strtotime($userInfo['InformationUser']['cont_reg_appoint_date'])))); 
							   }
							   else
								   echo h('NA');
							 ?>
						</td>
					</tr>
                </tbody>
				</table>
              </div>
            </div>
   </div>
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
						<th>Scale of Pay</th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Nature of Duties</th>
						<th class="no-print">Certificate</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach ($userInfo['UserEmploymentDetail'] as $service): ?>
					<tr>
						<td><?php echo h($i);?></td>
						<td><?php echo ucfirst(h($service['organization_name'])); ?></td>
						<td><?php echo ucfirst(h($service['post_held'])); ?></td>
						<td><?php echo ucfirst(h($service['scale_of_pay'])); ?></td>
						<td><?php echo h(date('d/m/Y',strtotime($service['from_date']))); ?></td>
						<td><?php echo h(date('d/m/Y',strtotime($service['to_date']))); ?></td>
						<td><?php echo ucfirst(h($service['nature_of_duties'])); ?></td>
					    <td class="no-print"><center><?php echo $this->Html->link(false,'/user_employment_details/dwn_self_emp_doc/'.$service['id'],array('target'=>'blank','fullbase'=>true,'class'=>'fa fa-download')); ?></center></td>
					</tr>
				<?php $i++;endforeach; ?>
                </tbody>
              </table>
			   </div>
            </div>        
   </div>
   
  <div class="row">
      <div class="col-xs-6">
        <p class="lead">Declaration</p>		  
    	  <p style="margin-top: 10px;" class="text-muted well well-sm no-shadow">
                I hereby declare that all the details furnished above are true to the best of my knowledge and belief.
          </p>
	  </div>
	  <div class="col-xs-2">
	   <?php
		//echo $this->Html->image('/uploads/userimages/'.$userInfo['User']['profilesignature'], array('alt' => 'Signature','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
	   ?>
		<?php
			echo $this->Html->image('/users/download_self_profile_sign/', array('alt' => 'Signature','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
			?>	   
	  </div>
  </div>

    <div class="row no-print">
            <div class="col-xs-12">
              <button class="btn btn-default pull-right" onclick='window.print()'><i class="fa fa-print"></i>Print</button>
           <!--button style="margin-right: 5px;" class="btn btn-primary btn-success pull-right" onclick="location.href='<?php //echo $this->Html->url(array('action'=>'preview_export_pdf'));?>'"><i class="fa fa-download"></i> Generate PDF</button-->
			</div>
			<div class="col-xs-12">
			   <h3><center><a href="<?php echo h($this->Html->url(array('controller'=>'vacancies','action'=>'current_openings')))?>">Click Here To Apply</a></center></h3>
			</div>
	</div>
   
</section>
</div>