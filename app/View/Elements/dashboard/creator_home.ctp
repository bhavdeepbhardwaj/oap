<?php
$d=$this->requestAction('dashboard/creator_home');
@extract($d);
?>
<div class="row">
<div class="col-xs-12">
   <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
		  <div class="box-header">
				<h3 class="box-title">Vacancies Overview</h3>
			</div><!-- /.box-header -->
			   <div class="box-body">
				 <div class="row">
				 
				 <div class="col-lg-3 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
						<h3><?php echo h($drafted) ?></h3>
						 <h4>Anticipated</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-envelope-o"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/drafted_vacancies',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
					</div><!-- ./col -->
				 
				 
					<div class="col-lg-3 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						<h3><?php echo h($waitingApproval) ?></h3>
						 <h4>Approval Awaited</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-tachometer"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/waiting_for_approval',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
					</div><!-- ./col -->
     		   
			   
			    
				   <div class="col-lg-3 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						<h3><?php echo h($approved) ?></h3>
						 <h4>Approved</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-thumbs-o-up"></i>
						</div>
					   <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/approved_vacancy',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
     		   
			   
			 
				   <div class="col-md-3 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
						<h3><?php echo h($approvalCancel) ?></h3>
						 <h4>Approval Cancelled</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-ban"></i>
						</div>
					   <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/approval_cancel',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
     		   </div>
			   
			 </div>
         </div>
</div>		 
</div>	



