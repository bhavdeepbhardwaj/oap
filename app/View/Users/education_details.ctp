<div class="row">
    <div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('User Education Details'); ?></h3><div class="asteriskLine text-red"> Fields marked with * are mandatory.</div>
			</div>
			                       <!-- Creating Form -->
			<?php echo $this->Session->flash(); ?>					   
			<?php echo $this->Form->create('UserQualification',array('role' => "form")); ?>	
			<div class="box-body">
				
				<div class="row">
				                                  
					                    <!--    <!-- Qualification Type -->  
					<!--div class="col-md-6">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Qualification Type</label><span class="asterisk">* </span><label>
							</div>
						 <?php //echo $this->Form->input('qualification_type', array('empty' => '--Select Type--','options'=>array('Regular'=>'Regular','Correspondence'=>'Correspondence','Diploma'=>'Diploma'),'label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div> -->
					
					                     <!-- Select Qualification -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('education_qualification_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Qualification</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->Form->input('education_qualification_id', array('empty' => '--Select Qualification--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
						</div>
					</div>
					
					<!--div class="col-md-4">
						<div class="form-group">
							<div>
								<label class="text-light-blue">Medium</label><span class="asterisk">* </span><label>
							</div>
						 <?php //echo $this->Form->input('language_id', array('empty' => '--Select Medium--','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div-->
					
				                  <!--University-->
						 <div class="col-md-6">
						     <div class="form-group <?php echo $this->Form->isFieldError('department_name') ? 'has-error' : '' ?>">
							    <div>
								   <label class="text-light-blue">University</label><span class="asterisk text-red">*</span>
							    </div>
						      <?php echo $this->Form->input('university', array('label'=>false,'placeholder'=>'Enter University Name','class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
						     </div>
					     </div>
						 
				   </div>
				   
				   <div class="row">
				   
				                     <!--Year Of Passing-->
						 <div class="col-md-6">
						     <div class="form-group <?php echo $this->Form->isFieldError('department_name') ? 'has-error' : '' ?>">
							    <div>
								   <label class="text-light-blue">Year Of Passing</label><span class="asterisk text-red">* </span>
							    </div>
						      <?php echo $this->Form->input('y_o_p', array('type'=>'date','dateFormat'=>'Y','minYear'=>1960,'maxYear'=>date('Y'),'empty' => '--Select Year--','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
						     </div>
					     </div>
						 
						            <!-- Select Class -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('department_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Class</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->Form->input('class_type', array('empty' => '--Select Class--','options'=>array('Distinction'=>'Distinction','First Class'=>'First Class','Second Class'=>'Second Class','Third Class'=>'Third Class'),'label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
						</div>
					</div>
					   
					             <!-- Percentage Obtained -->  
					<div class="col-md-6">
						<div class="form-group <?php echo $this->Form->isFieldError('department_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">% Obtained</label><span class="asterisk text-red">* </span>
							</div>
						 <?php echo $this->Form->input('perc_obtained', array('type'=>'text','placeholder' => '% Percentage','label'=>false,'digits'=>true,'maxlength'=>4,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
						</div>
					</div>
					
					                  <!--Special Subject-->					          
				  <div class="col-md-6">
					   <div class="form-group <?php echo $this->Form->isFieldError('department_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Special Subject</label><span class="asterisk text-red">* </span>
							</div>
								 <?php echo $this->Form->input('special_subject', array('placeholder' => 'Subject','label'=>false,'class'=>'form-control','required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartmentName')))); ?>
					   </div>
				   </div>
						 
						 
				   </div>
				   
			           <div class="row"> 
					   </div>					   
		   </div>	 
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
          			<?php echo $this->Form->end(); ?>
	        </div><!--Primary Box-->
	     </div><!--First Column-->	
               
                  <!--Help Menu-->
		<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-fw fa-question-circle"></i>
				<h3 class="box-title">Help</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<blockquote>
					<p>Qualification Type</p>
					<small>Here you have to select whether your qualification is "Regular" , "Correspondence" , "Diploma"</small>
				</blockquote>
				<blockquote>
					<p>Class</p>
					<small>Distinction : Percentage Equal to or Above 75%</small>
					<small>First Class : Percentage Equal to or Above 60%</small>
					<small>Second Class: Percentage Equal to or Above 45%</small>
					<small>Third Class : Percentage Equal to and Less than 45%</small>
				</blockquote>
			</div><!-- /.box-body -->
		</div>
	</div>		  
		 
	</div><!--First Row-->	 

                               <!--For Displaying Added Education Qualification-->
<div class="row">							   
    <div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Educational Qualifications'); ?></h3>
			</div>
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Qualification Type</th>
						<th>Qualification</th>
						<th>Year Of Passing</th>
						<th>Class</th>
						<th>% Obtained</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($educations as $education): ?>
					<tr>
						<td><?php //echo $i;?></td>
						<td><?php //echo ucfirst(h($state['']['state_name'])); ?></td>
						<td><?php //echo ucfirst(h($state['State']['state_name'])); ?></td>
						
							<td><?php //echo $this->Html->link(false, array('action' => 'edit', $state['State']['id']), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit')); ?>Edit							
						</td>
					</tr>
				<?php $i++;endforeach; ?>
				</tbody>
			</table>
		</div><!-- /.box-body -->					   
								   
        </div><!--Primary Box-->
    </div><!--First Column-->
</div><!--Second Row-->	

                       