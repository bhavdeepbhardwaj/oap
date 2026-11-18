<?php
//pr($vacancyeDs);

//pr($userId);
?>
<div class="row">
    <div class="col-md-12">
	<?php echo $this->Session->flash(); ?>
	   <div class="box box-primary">
	      <div class="box-header">
				<h3 class="box-title">Essentials & Desirables</h3>
		  </div><!-- /.box-header -->
		  <?php echo $this->Form->create('User', array('role' => "form",'class' =>'jquery-validation')); ?>
		                  <!--For Essentials-->
		   <div class="box-body table-responsive">
		      <table class="table table-bordered table-striped table-hover">			  
			      <thead>
				    <tr>
					  <th>S.No.</th>
					  <th width="60%">Essentials</th>
					  <th width="40%">Enter Your Comments</th>
					</tr> 
				  </thead>
			  
		      <tbody>
			      <?php $i=0; foreach($vacancyeDs['Essential'] as $vacancyeD): ?>
				    <tr>
                       <td><?php echo $i+1;?> </td>
					   <td><?php echo ucfirst(h($vacancyeD['essential']));?> </td>
					   <td>
					     <?php //echo h($vacancyeDs['VacanciesEssential']['id']); ?>
							<div class="form-group <?php echo $this->Form->isFieldError('UsersVacanciesEssential.'.$vacancyeD['VacanciesEssential']['id'].'.essential_comments') ? 'has-error' : '' ?>">
								<?php echo $this->Form->input('UsersVacanciesEssential.'.$vacancyeD['VacanciesEssential']['id'].'.essential_comments',array('type'=>'textarea','placeholder'=>'Write Your Comments....','label'=>false,'class'=>'form-control','rows'=>1,'pattern'=>'^[a-zA-Z0-9\n\s,-_()]+$','maxlength'=>500,'rangeLength'=>array(3,500),'required'=>true,'id'=>'UsersVacanciesEssential'.$vacancyeD['VacanciesEssential']['id'].'EssentialComments','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UsersVacanciesEssential'.$vacancyeD['VacanciesEssential']['id'].'EssentialComments')))); ?>
							</div>	
					   </td>
					</tr>
                  <?php $i++;endforeach; ?>					
		       </tbody> 
			</table> 
		   </div>
	                      <!--For Desirables-->
		    <?php if(!empty($vacancyeDs['Desirable']))
			   {
			?>
			<div class="box-body table-responsive">
		      <table class="table table-bordered table-striped table-hover">			  
			      <thead>
				    <tr>
					  <th>S.No.</th>
					  <th width="60%">Desirables</th>
					  <th width="40%">Enter Your Comments</th>
					</tr> 
				  </thead>
			  
		      <tbody>
			      <?php $i=0; foreach($vacancyeDs['Desirable'] as $vacancyeD): ?>
				    <tr>
                       <td><?php echo $i+1;?> </td>
					   <td><?php echo ucfirst(h($vacancyeD['desirable']));?> </td>
					   <td>
						<div class="form-group <?php echo $this->Form->isFieldError('UsersVacanciesDesirable.'.$vacancyeD['VacanciesDesirable']['id'].'.desirable_comments') ? 'has-error' : '' ?>">
					     <?php echo $this->Form->input('UsersVacanciesDesirable.'.$vacancyeD['VacanciesDesirable']['id'].'.desirable_comments',array('type'=>'textarea','placeholder'=>'Write Your Comments....','label'=>false,'class'=>'form-control','rows'=>1,'pattern'=>'^[a-zA-Z0-9\n\s,-_()]+$','maxlength'=>500,'rangeLength'=>array(3,500),'id'=>'UsersVacanciesDesirable'.$vacancyeD['VacanciesDesirable']['id'].'DesirableComments','error'=>array('attributes'=>array('class'=>'text-red','wrap'=>'span','for'=>'UsersVacanciesDesirable'.$vacancyeD['VacanciesDesirable']['id'].'DesirableComments')))); ?>
						</div>
					   </td>
					</tr>
                  <?php $i++;endforeach; ?>					
		       </tbody> 
			</table> 
		   </div>
           <?php
             }
            ?>			 
	        <div class="box-footer text-center">
				<button type="submit" class="btn btn-primary">Save & Next</button>
		    </div>     
	   </div>
			<?php echo $this->Form->end(); ?>
	</div>
</div>