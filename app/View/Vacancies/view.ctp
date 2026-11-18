<script>
 $(function(){
 
     $('#VacancyStatus').change(function(){
	                                       approvalStatus = $('#VacancyStatus').val(); 
                                             if(approvalStatus=='' || approvalStatus=='Approved')
                                                {
												 $('#optional-col').hide();
												 $('#VacancyReasonNotToApprove').val('');
												 $('#VacancyReasonNotToApprove').rules("remove");
												}
                                             if(approvalStatus=='Approval Cancel')
                                                 {
												 $('#optional-col').show();
												 $('#VacancyReasonNotToApprove').val('');
												 $('#VacancyReasonNotToApprove').rules("add", {
																						required: function(element){
																														vacancyStatus = $('#VacancyStatus').val();
																														if(vacancyStatus==='Approval Cancel')
																														return true;
																													},
																						//alphabetspace: true,
																				});
												 } 											 
                        						   
	  
	  });
 
 
 })
</script>
<div class="row">
	<div class="col-xs-12">
	<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Vacancy Details</h3>
			</div><!-- /.box-header -->
			
			<?php echo $this->Form->create('Vacancy', array('role' => "form",'class' => 'jquery-validation')); ?>
			<?php echo $this->Form->input('id',array('type'=>'hidden')) ?>
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Advertisement Number</th>
						
						<td width="70%"><?php echo ucfirst(h($vacancy['Notice']['advt_number'])); ?></td>
						
					</tr>
                    <tr>					
						<th>Advertisement Title</th>
						
						<td><?php echo ucfirst(h($vacancy['Notice']['advt_name'])); ?></td>
						
					</tr>
					<tr>					
						<th>Organization Name</th>
						
						<td><?php echo ucfirst(h($vacancy['Organization']['organization_name'])); ?></td>
						
					</tr>
					<tr>
						<th>Post's Name</th>
						
						<td><?php echo ucfirst(h($vacancy['Post']['post_name'])); ?></td>
						
					</tr>				
					<?php if($vacancy['Department']['department_name']!=Null){?>					
					<tr>
						<th>Department's Name</th>
						
						<td><?php echo ucfirst(h($vacancy['Department']['department_name'])); ?></td>
						
					</tr>
					<?php }?>
					
	        </thead>
				<tbody>
		
			</table>
		  </div>	
			<?php
			   if($vacancy['Vacancy']['post_category_wise']=='Yes')
			     {
			 ?>
				<div class="box-header">
				<center><h6 class="box-title">Number of Posts Category Wise</h6></center>
				</div><!-- /.box-header -->
				
				<div class="box-body table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><center>UR</center></th>
							<th><center>SC</center></th>
							<th><center>ST</center></th>
							<th><center>OBC</center></th>
							<th><center>Others</center></th>
							<th><center>Total</center></th>
						</tr>
						<tr>
							<?php
							$totalVacancies=$vacancy['Vacancy']['ur_vacancy_count']+$vacancy['Vacancy']['sc_vacancy_count']+$vacancy['Vacancy']['st_vacancy_count']+$vacancy['Vacancy']['obc_vacancy_count']+$vacancy['Vacancy']['others_vacancy_count'];
							?>
							<td width="15%"><center><?php echo ucfirst(h($vacancy['Vacancy']['ur_vacancy_count'])); ?></center></td>
							<td width="15%"><center><?php echo ucfirst(h($vacancy['Vacancy']['sc_vacancy_count'])); ?></center></td>
							<td width="15%"><center><?php echo ucfirst(h($vacancy['Vacancy']['st_vacancy_count'])); ?></center></td>
							<td width="15%"><center><?php echo ucfirst(h($vacancy['Vacancy']['obc_vacancy_count'])); ?></center></td>
							<td width="15%"><center><?php echo ucfirst(h($vacancy['Vacancy']['others_vacancy_count'])); ?></center></td>
							<td><center><?php echo ucfirst(h($totalVacancies)); ?></center></td>
							
						</tr>
					   
				
						
				</thead>
					<tbody>
			
				</table>
			  
		      </div>
			<?php
              }
            ?>			  
		  <div class="box-header">
			<center><h6 class="box-title">Post's Description</h6></center>
			</div><!-- /.box-header -->
			
			<div class="box-body table-responsive">
			   <table class="table table-bordered table-striped">
				   <thead>
                <?php if($vacancy['Vacancy']['post_category_wise']=='No')
                  {
                ?>				  
				   <tr>					
						<th>Number of Posts</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['no_of_posts'])); ?></td>
						
					</tr>
			    <?php
                  }
                ?>								
					<tr>					
						<th>Classification</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['classification'])); ?></td>
						
					</tr>
					<tr>					
						<th>Method of Recruitment</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['recruitment_method'])); ?></td>
						
					</tr>
                    <tr>
						<th>Pay Scale</th>
						
						<td width="70%"><?php echo ucfirst(h($vacancy['PayScale']['pay_scale'])); ?></td>
						
					</tr>
                    <?php if($vacancy['Vacancy']['age_limit']!=Null){ ?>
                    <tr>					
						<th>Age Limit</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['age_limit'])); ?></td>
						
					</tr>
					<?php } ?>
					<tr>
						<th>Minimum Educational Qualification required</th>
						<?php foreach ($vacancy['EducationQualification'] as $education):
						   $allEdu[]= ucfirst($education['education_qualification']); 
						  endforeach; ?>
						 <td><?php echo h(implode(' , ',$allEdu)); ?></td> 
					</tr>				
					<?php if($vacancy['Vacancy']['exp_require']!=Null){?>					
					<tr>
						<th>Minimum Experience required for the Post</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['exp_require'])); ?></td>
						
					</tr>
                    <?php }?>
                    <tr>
						<th>Experience Details</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['exp_details'])); ?></td>
						
					</tr>
                    <tr>
					  <th>Essentials</th>
						  <?php foreach($vacancy['Essential'] as $essentials):
						     
                               $allEssential[] = ucfirst($essentials['essential']);
                            endforeach;							   
						  ?>
							<td>
							  <?php echo implode(' ,</br> ',h($allEssential)); ?> 
						    </td>	
                    </tr>
					<?php if(!empty($vacancy['Desirable']))
					 {
				     ?>
                    <tr>
					  <th>Desirables</th>
					    <?php foreach($vacancy['Desirable'] as $desirables):
						     
                               $allDesirable[] = ucfirst($desirables['desirable']);
                            endforeach;							   
						  ?>
							<td>
							  <?php echo implode(' ,</br> ',h($allDesirable)); ?> 
						    </td>	
                    </tr>
                   <?php
                     }
                   ?>					 
				    <?php if($vacancy['Vacancy']['other_details']!=Null){?>					
				     <tr>
						<th>Other Details</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['other_details'])); ?></td>
						
					</tr>
                    <?php } ?>
                    <?php if($vacancy['Vacancy']['probation_period']!=Null){?>					
					<th>Deputation Period</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['probation_period'])); ?></td>
						
					</tr>
					<?php } 
					if($userRole=='Vacancy Approver')
					 {
					?>
                    <tr>	
					<th>Action</th>
					<td>
					<div class="col-md-4">
					 <div class="form-group <?php echo $this->Form->isFieldError('status') ? 'has-error' : '' ?>">
					   <?php echo $this->JqueryValidation->input('status',array('options'=>array('Approved'=>'Approved','Approval Cancel'=>'Approval Cancel'),'empty'=>'--Select Status--','type'=>'select','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyStatus')))); ?>
					 </div> 
					</div>
					<!--div class="col-md-4">
					<?php //echo $this->Form->input('applicable_to',array('options'=>array('Organization'=>'Organization','All Organizations'=>'All Organizations','Public'=>'Public'),'empty'=>'--Select Applicable To--','type'=>'select','label'=>false,'class'=>'form-control','required'=>true)); ?>
					</div-->
					
					<script>
                                //To display back-end error message of Reason for Approval Cancel  						
									$(function(){
									OtherFieldReason	=	<?php 
															if($this->Form->isFieldError('reason_not_to_approve'))
																echo 'true'; 
															else 
																echo 'false'; 
														?>;							
									if(OtherFieldReason)
									{
										$('#VacancyStatus').trigger('change');	
									}
									});		
					</script>
					
					
					<div class="col-md-5 <?php echo $this->Form->isFieldError('reason_not_to_approve') ? 'has-error' : '' ?>" id="optional-col" style="display:none">
					<div class="form-group">
					<?php echo $this->JqueryValidation->input('reason_not_to_approve',array('label'=>false,'placeholder'=>'Cancellation Reason','class'=>'form-control','rangeLength'=>array(3,300),'maxlength'=>300,'rows'=>2,'pattern'=>'^[a-zA-Z\n\s,-.]+$','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'VacancyReasonNotToApprove')))); ?>
					</div>
					</div>
					</td>
					
					</tr>
					 <tr>	
					<th>&nbsp;</th>
					<td>
					<div class="col-md-4">
					        <button type="submit" class="btn btn-primary">Save Status</button>
			         </div>
					</td>					
					</tr>
					<?php echo $this->Form->end(); 
					 }
					 else
					 {
					 ?>
					<tr>	
					<th>&nbsp;</th>
					<td>
					<div class="col-md-4">
					       <?php echo $this->Html->link('Back',array('action'=>'waiting_for_approval'),array('class'=>'btn btn-primary')); ?> 
			         </div>
					</td>					
					</tr>
					<?php
					 }
					?>
                </thead>
				 <tbody>
		
			    </table>
		  
		       </div><!-- /.box-body -->
		    </div>
		</div>
	</div>		
	