<div class="row">
<section class="invoice">
      <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i>
				<?php echo ucfirst(h($userInfo['User']['f_name']." ".$userInfo['User']['m_name']." ".$userInfo['User']['l_name'])); ?>
                <small class="pull-right">Date: <?php $dt = new DateTime();
                                                      echo $dt->format('d/m/Y');
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
					  <tr>
						<th>Religion</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['religion'])); ?></td>
					  </tr>
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
					  <tr>
						<th>Type Of Disability</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['type_of_disability'])); ?></td>
					  </tr>
					  <tr>
						<th>Hobbies</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['hobbies'])); ?></td>
					  </tr>
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
							echo $this->Html->image('/uploads/userimages/'.$userInfo['User']['profilepic'], array('alt' => 'User Image','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
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
						<th style="width:50%">Permanent Address</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['pa_address'].' ,</br> '.$userInfo['InformationUser']['PaState']['state_name'].' , '.$userInfo['InformationUser']['PaCity']['city_name'].' , '.$userInfo['InformationUser']['pa_pincode'])); ?></td>
					  </tr>
					  <tr>
						<th>LandLine Number</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['pa_std_code'].'-'.$userInfo['InformationUser']['pa_landline_num'])); ?></td>
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
						<th>Communication Address</th>
						<td><?php echo ucfirst(($userInfo['InformationUser']['ca_address'].', </br>'.$userInfo['InformationUser']['CaState']['state_name'].' , '.$userInfo['InformationUser']['CaCity']['city_name'].' , '.$userInfo['InformationUser']['ca_pincode'])); ?></td>
					  </tr>
					  <tr>
						<th>LandLine Number</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['ca_std_code'].'-'.$userInfo['InformationUser']['ca_landline_num'])); ?></td>
					  </tr>
					  <tr>
						<th>Mobile Number</th>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['ca_mobile_number'])); ?></td>
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
                    <th>Present Scale Pay</th>
                    <th>Continuous Regular Appointment Date</th>
                  </tr>
                  </thead>
				  <tbody>
				   <tr>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['current_organization'])); ?></td>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['d_o_r'])); ?></td>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_post'])); ?></td>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['present_scale_pay'])); ?></td>
						<td><?php echo ucfirst(h($userInfo['InformationUser']['cont_reg_appoint_date'])); ?></td>
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
   
  <div class="row">
      <div class="col-xs-6">
        <p class="lead">Declaration</p>		  
    	  <p style="margin-top: 10px;" class="text-muted well well-sm no-shadow">
                I hereby declare that all the details furnished above are true to the best of my knowledge and belief..
          </p>
	  </div>
	  <div class="col-xs-6">
	   <?php
		echo $this->Html->image('/uploads/userimages/'.$userInfo['User']['profilesignature'], array('alt' => 'Signature','fullBase' => true,'style'=>'max-width:100px'),array('escapeTitle' => false));
	   ?>
	  </div>
  </div>

    <div class="row no-print">
            <div class="col-xs-12">
              <button class="btn btn-default" onclick='window.print()'><i class="fa fa-print"></i>Print</button>
           <!--button style="margin-right: 5px;" class="btn btn-primary pull-right" onclick="location.href"><i class="fa fa-download"></i> Generate PDF</button-->
              <?php echo $this->Html->link('Generate Pdf',array('action'=>'index_export_pdf'),array('i class'=>'fa fa-download  btn btn-primary pull-right','class'=>'btn btn-primary pull-right','style'=>'margin-right :5px'));?>
			</div>
    </div>
   
</section>
</div>
