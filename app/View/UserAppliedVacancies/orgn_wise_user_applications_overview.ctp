<script>
  $(function(){
  
	  $('#UserAppliedVacancyYOR').change(function(){
	       
	      yearOfRecruitment = $('#UserAppliedVacancyYOR').val();
		  
		  $.post('<?php echo $this->webroot;?>'+'/user_applied_vacancies/vacanciesbyyearofrecruitment',{'y_o_r':yearOfRecruitment},function(response) {
                                                      $('#UserAppliedVacancyNoticeId').html( response );
                                                     }
				);
	  });
	  
	  //$('#UserAppliedVacancyYOR').trigger('change');
	  
  });
</script>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<!--h3 class="box-title">
				     Search 
				</h3-->
				 
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="well">
								
							<div class="row pad ">
								
								<div class="col-md-12">
			                 <!--For Reports->Drop Down for Selecting Orgn and Post -->
			                           <?php echo $this->Form->create('UserAppliedVacancy',array('role'=>'form','type'=>'get')); ?>
					                        <div class="row pad">
												   <div class="col-sm-2 pad">
														<div class="pull-right"><label class="text-light-blue">Filter Using: </label></div>
													</div> 
													   <div class="col-sm-2 pad">
														  <?php 
		
															 $selOrganization ='all';
															if(isset($this->request->query['organization_id']))
															 {
															  $selOrganization = $this->request->query['organization_id'];	
															 }	
														  ?>
														  <?php echo $this->Form->input('organization_id',array('options'=>array(array_replace(array('all'=>'All Organizations'),$organizations)),'label'=>false,'value'=>$selOrganization,'class'=>'form-control')); 
														   ?>
														   
													   </div>
														  <!--For Posts-->
													   <div class="col-sm-2 pad">
														  <?php 
															$selPost ='all';
															if(isset($this->request->query['post_id']))
															 {
															  $selPost = $this->request->query['post_id'];	
															 }	
														  ?>
														  <?php echo $this->Form->input('post_id',array('options'=>array(array_replace(array('all'=>'All Posts'),$posts)),'label'=>false,'value'=>$selPost,'class'=>'form-control')); 
														  ?>
													   </div>
													     <!--For Year-->
													   <div class="col-sm-2 pad">
														  <?php 
															$selYear ='all';
															if(isset($this->request->query['y_o_r']))
															 {
															  $selYear = $this->request->query['y_o_r'];	
					
															 }	
														  ?>
														  <?php
														   echo $this->Form->input('y_o_r',array('options'=>array(array_replace(array('all'=>'All Years'),$yOrs)),'label'=>false,'value'=>$selYear,'class'=>'form-control')); 
														  ?>
													   </div>
													     <!--For Vacancy-->
													   <div class="col-sm-2 pad">
														  <?php 
															$selVacancy ='all';
															if(isset($this->request->query['notice_id']))
															 {
															  $selVacancy = $this->request->query['notice_id'];	
															 }	
														  ?>
														  <?php
														   echo $this->Form->input('notice_id',array('options'=>array(array_replace(array('all'=>'All Vacancies'),$notices)),'label'=>false,'value'=>$selVacancy,'class'=>'form-control')); 
														  ?>
													   </div>
													   <div class="col-sm-2 pad">
															<button type="submit" class="btn btn-info">Search</button>
													   </div>
					                        </div> 
						                   <?php echo $this->Form->end(); ?>
			                    </div>
																																												
							</div>
							
					    </div>
						
					</div>
				</div>
			
		</div><!-- /.box-body -->
	</div>
  </div>
</div>

    
	
	
	<!-- For Displaying Applicants -->
	

<div class="row">
<div class="col-xs-12">
<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
		  <div class="box-header">
				<h3 class="box-title">Applications Overview</h3>
				<?php 
				   if(!empty($this->request->query['organization_id']) && !empty($this->request->query['post_id']) && !empty($this->request->query['y_o_r']) && !empty($this->request->query['notice_id']) ) 
						{
				         echo $this->Html->link('View Applicants Summary', array('action' => 'view_applicants_summary',$this->request->query['organization_id'],$this->request->query['post_id'],$this->request->query['y_o_r'],$this->request->query['notice_id']), array( 'class'=>'btn btn-xs bg-olive pull-right'));
		                }
				   else
                     {
					  echo $this->Html->link('View Applicants Summary', array('action' => 'view_applicants_summary'), array( 'class'=>'btn btn-xs bg-olive pull-right'));
					 }
                ?> 					 
		  </div><!-- /.box-header -->
			   <div class="box-body">
		   <div class="row">
				 
				 <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						<h3><?php echo h($submittedApplications) ?></h3>
						 <h4>Applications Received</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-envelope-o"></i>
						</div>
						<?php if(!empty($this->request->query['organization_id']) && !empty($this->request->query['post_id']) && !empty($this->request->query['y_o_r']) && !empty($this->request->query['notice_id']) ) 
						{
						?>
					       <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/new_orgn_wise_user_applications_for_monitoring/'.$this->request->query['organization_id'].'/'.$this->request->query['post_id'].'/'.$this->request->query['y_o_r'].'/'.$this->request->query['notice_id'],true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					    <?php 
						}else
						{
						?>
						  <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/new_orgn_wise_user_applications_for_monitoring',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
						<?php 
						}
						?>
					  </div>
				 </div><!-- ./col -->
						   
			    
				   <!--div class="col-lg-6 col-xs-12">
					  <!-- small box -->
					  <!--div class="small-box bg-green">
						<div class="inner">
						<h3><?php //echo h($acceptedApplications) ?></h3>
						 <h4>Accepted Applications</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-thumbs-o-up"></i>
						</div>
					   <a class="small-box-footer" href="<?php //echo h($this->Html->url('/user_applied_vacancies/accepted_applications',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div--><!-- ./col -->
     		   
			   
			 
				   <!--div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <!--div class="small-box bg-red">
						<div class="inner">
						<h3><?php //echo $rejectedApplications ?></h3>
						 <h4>Not Eligible Applications</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-ban"></i>
						</div>
					   <a class="small-box-footer" href="<?php //echo $this->Html->url('/user_applied_vacancies/rejected_applications',true) ?>">More info<i class="fa fa-arrow-circle-right"></i></a>
					  
					</div><!-- ./col -->
     		   <!--/div-->
			<!--div class="row"-->
			  
			  <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-orange">
						<div class="inner">
						<h3><?php echo h($incompleteDocuments) ?></h3>
						 <h4>Incomplete Documents</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-file-text"></i>
						</div>
						<?php if(!empty($this->request->query['organization_id']) && !empty($this->request->query['post_id']) && !empty($this->request->query['y_o_r']) && !empty($this->request->query['notice_id']) ) 
						{
						?>
					      <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/under_consideration_orgn_wise_user_applications_for_monitoring/'.$this->request->query['organization_id'].'/'.$this->request->query['post_id'].'/'.$this->request->query['y_o_r'].'/'.$this->request->query['notice_id'],true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					    <?php
						} else
						   {
						?>
						<a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/under_consideration_orgn_wise_user_applications_for_monitoring',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					    <?php
						}
						?>
					  </div>
			  </div><!-- ./col -->
			  
			  <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-blue">
						<div class="inner">
						<h3><?php echo h($callForInterview) ?></h3>
						 <h4>Call for Interview</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-user"></i>
						</div>
						<?php if(!empty($this->request->query['organization_id']) && !empty($this->request->query['post_id']) && !empty($this->request->query['y_o_r']) && !empty($this->request->query['notice_id']) ) 
						{
						?>
					      <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/called_for_interview_orgn_wise_user_applications_for_monitoring/'.$this->request->query['organization_id'].'/'.$this->request->query['post_id'].'/'.$this->request->query['y_o_r'].'/'.$this->request->query['notice_id'],true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					    <?php 
						} else
						{
						?>
						 <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/called_for_interview_orgn_wise_user_applications_for_monitoring',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
						<?php }?>
					  </div>
				 </div><!-- ./col -->	 
            </div>			
			   
			 </div>
         </div>
</div>		 
</div>



