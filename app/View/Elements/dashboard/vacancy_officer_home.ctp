<?php
$d=$this->requestAction('dashboard/vacancy_officer_home');
@extract($d);
?>
<div class="row">
<div class="col-xs-12">
<?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
		  <div class="box-header">
				<h3 class="box-title">Applications Overview</h3>
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
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/new_applications',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
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
						<h3><?php echo h($underConsideration) ?></h3>
						 <h4>Incomplete Documents</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-file-text"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/under_consideration',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
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
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/call_for_interview',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
				 </div><!-- ./col -->	 
            </div>			
			   
			 </div>
         </div>
</div>		 
</div>



