<?php //pr($vacancy); ?>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Change Recruitment Method</h3>
			</div><!-- /.box-header -->
			<?php echo $this->Session->flash(); ?>
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
						<th>Advertisement Name</th>
						
						<td><?php echo ucfirst(h($vacancy['Notice']['advt_name'])); ?></td>
						
					</tr>
					<tr>
						<th>Post's Name</th>
						
						<td><?php echo ucfirst(h($vacancy['Post']['post_name'])); ?></td>
						
					</tr>				
					<tr>
						<th>Department's Name</th>
						
						<td><?php echo ucfirst(h($vacancy['Department']['department_name'])); ?></td>
						
					</tr>
					
	        </thead>
				<tbody>
		
			</table>
		   </div>	
			
			<?php
			   if($vacancy['Vacancy']['post_category_wise']=='Yes')
			     {
			 ?>
				<div class="box-header">
				<center><h6 class="box-title">Number Of Posts Category Wise</h6></center>
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
						<th>Pay Scale</th>
						
						<td width="70%"><?php echo ucfirst(h($vacancy['PayScale']['pay_scale'])); ?></td>
						
					</tr>
                    <tr>					
						<th>Age Limit</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['age_limit'])); ?></td>
						
					</tr>
					<tr>
						<th>Educational Qualification</th>
                       <?php foreach($vacancy['EducationQualification'] as $educations): 						
						$allEdu[]=ucfirst($educations['education_qualification']);
					   endforeach; ?>
						<td><?php echo h(implode(', ',$allEdu)); ?></td>
					</tr>				
					<tr>
						<th>Experience Require</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['exp_require'])); ?></td>
						
					</tr>	
                    <tr>
						<th>Experience Details</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['exp_details'])); ?></td>
						
					</tr>						
				     <tr>
						<th>Other Details</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['other_details'])); ?></td>
						
					</tr>	
					<th>Probation Period</th>
						
						<td><?php echo ucfirst(h($vacancy['Vacancy']['probation_period'])); ?></td>
						
					</tr>
                   
                    <tr>	
					<th>Change Recruitment Method</th>
					<td>
					<div class="col-md-4">
					<?php echo $this->Form->input('recruitment_method',array('options'=>array('All India Services'=>'All India Services(AIS)','Ports'=>'Ports','Both(AIS & Ports)'=>'Both(AIS & Ports)','Composite'=>'Composite','Deputation'=>'Deputation','Direct'=>'Direct'),'empty'=>'--Select Status--','type'=>'select','label'=>false,'class'=>'form-control','required'=>true)); ?>
					</div>
					</td>
					
					</tr>
					 <tr>	
					<th>&nbsp;</th>
					<td>
					<div class="col-md-4">
					        <button type="submit" class="btn btn-primary">Allow </button>
			         </div>
					</td>					
					</tr>
					<?php echo $this->Form->end(); ?>
					
                </thead>
				 <tbody>
		
			    </table>
		  
		       </div><!-- /.box-body -->
		    </div>
		</div>
	</div>		
	