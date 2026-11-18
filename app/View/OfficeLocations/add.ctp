<script type="text/javascript">
 $(function(){
   $('#OfficeLocationCityId').prop('disabled',true);
   $('#OfficeLocationStateId').change(function(){
                                stateid = $('#OfficeLocationStateId').val();
								if(stateid=='')
								 {
								  $('#OfficeLocationCityId').html('<option>Select City</option>');
								  $('#OfficeLocationCityId').prop('disabled',true);
								  return false;
								 }
								 $.post('<?php echo $this->webroot;?>'+'office_locations/citiesbystateid',{'id':stateid},function(response){
								        
										$('#OfficeLocationCityId').prop('disabled',false);
										$('#OfficeLocationCityId').html(response);
								  });
								 
								 
								
    							
   });
   

 })
</script>
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Assign Office Locations & Departments to Organizations'); ?></h3><div class="asteriskLine text-red"> Field marked with * are mandatory.</div>
			</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Form->create('OfficeLocation', array('role' => "form",'class' => 'jquery-validation')); ?>
			
			<div class="box-body">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group <?php echo $this->Form->isFieldError('organization_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Select Organization</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('organization_id', array('empty'=>'--Select Organization--','label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OfficeLocationOrganizationId')))); ?>
						</div>
					</div>			
				</div>
				
				                            <!--Department Name -->
               <div class="row">
			      <div class="col-md-5">
					        	<div class="form-group <?php echo $this->Form->isFieldError('Department.Department') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Select Department</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('Department.Department', array('type'=>'select','multiple'=>true,'label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'DepartmentDepartment')))); ?>
						</div>
					  </div>	
			   </div>
				
				
				
			 <div class ="row" >
			 
			                          <!-- Location Name -->
				   <div class="col-md-7">
						<div class="form-group <?php echo $this->Form->isFieldError('location_name') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Location Name</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('location_name', array('placeholder'=>'Organization Location Name', 'label'=>false,'alphabetspace'=>true,'class'=>'form-control','rangeLength'=>array(3,90),'maxlength'=>90,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OfficeLocationLocationName')))); ?>
						</div>
					</div>		
			 </div>
				
				                    <!-- For Location Address -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group <?php echo $this->Form->isFieldError('location_address') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">Location Address</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('location_address', array('type' => 'textarea', 'escape' => true,'placeholder'=>'Organization Location Address', 'pattern'=>'^[a-zA-Z0-9\n\s,-.]+$','rows'=>3,'label'=>false,'class'=>'form-control', 'maxlength'=>255,'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OfficeLocationLocationAddress')))); ?>
						</div>
					</div>			
									
			 </div>
				
				
				                        <!-- For State -->
										
				<div class="row">
					<div class="col-md-5">
						<div class="form-group <?php echo $this->Form->isFieldError('state_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">State</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('state_id', array('empty'=>'--Select State--', 'label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OfficeLocationStateId')))); ?>
						</div>
					</div>			
					
                                        <!-- For City -->
										
					<div class="col-md-5">
						<div class="form-group <?php echo $this->Form->isFieldError('city_id') ? 'has-error' : '' ?>">
							<div>
								<label class="text-light-blue">City</label><span class="asterisk text-red">* </span>
							</div>
							<?php echo $this->JqueryValidation->input('city_id', array('empty'=>'--Select City--', 'label'=>false,'class'=>"form-control",'required'=>true,'error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'OfficeLocationCityId')))); ?>
						</div>
								
							
				     </div> 
					
				</div>		
                                             
				
			</div>
			<div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Assign Locations & Departments</button>
			</div><br/>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	
</div>