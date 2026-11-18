<?php //pr($vacancy); exit; ?>
<div class="row">
	<div class="col-md-12">
		<!--div class="box box-warning"-->
			<!--div class="box-header">
				<h3 class="box-title text-purple">Vacancy Details</h3>
			</div--><!-- /.box-header -->
			<?php echo $this->Session->flash(); ?>
			<div class="box-body table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Advertisement Number</th>
						
						<td width="70%"><?php echo ucfirst(h($vacancy['Notice']['advt_number'])); ?></td>
						
					</tr>
                    <tr>					
						<th>Advertisement Name</th>
						
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
				<!--tbody-->
		
			</table>
		   </div>
       		   	<?php
			   if($vacancy['Vacancy']['post_category_wise']=='Yes')
			     {
			 ?>
					<div class="box-header">
					<center><h6 class="box-title text-bold">Number Of Posts Category Wise</h6></center>
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
					  
				  </div><!-- /.box-body -->
		     <?php
			   }
			 ?>  
		  <div class="box-header">
			<center><h6 class="box-title text-bold">Post's Description</h6></center>
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
						<th>Method Of Recruitment</th>
						
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
						  $allEdu[] = ucfirst($education['education_qualification']);
						 endforeach;
						?>						
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
					<?php } ?>
										
                </thead>
				 <tbody>
		
			    </table>
		  
		       </div><!-- /.box-body -->
		    <!--/div--><!-- /.box-box-warning -->
		</div><!-- /.col-md-12 -->
	</div>		
	