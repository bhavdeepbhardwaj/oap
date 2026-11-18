<?php
$vacancies=$this->requestAction('dashboard/vacancy_applier_home');
@extract($vacancies);
?>
<?php //pr($activeApplications); ?>
<div class="row">
<div class="col-md-12">
   <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
		  <div class="box-header">
			   <h3 class="box-title">Applications & Vacancies Overview</h3>
			</div><!-- /.box-header -->
			   <div class="box-body">
				 <div class="row">
				 
				 <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
						<h3><?php echo h($activeApplications) ?></h3>
						 <h4>My Active Applications</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-envelope-o"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/user_applied_vacancies/my_active_applications',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
					</div><!-- ./col -->
				 
				 
					<div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						<h3><?php echo h($currentOpenings) ?></h3>
						 <h4>Vacancies</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-tachometer"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/current_openings',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
					</div><!-- ./col -->	

                    <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						<h3><?php echo h($notices) ?></h3>
						 <h4>Vacancy Circulars</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-files-o"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/notices/view',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
					</div><!-- ./col -->
 					
     		   </div>
			   
			 </div>
         </div>
</div>		 
</div>	



