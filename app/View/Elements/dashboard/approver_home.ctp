<?php
$d=$this->requestAction('dashboard/approver_home');
@extract($d);
?>
<div class="row">
<div class="col-xs-12">
    <?php echo $this->Session->flash(); ?>
		<div class="box box-primary">
		  <div class="box-header">
		<center><h3 class="box-title"><?php echo __('Welcome To On-line Recruitment System For Major Ports'); ?>
			</div>
			   <div class="box-body">
				 <div class="row">
					<div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						<h3><?php echo h($waitingApproval) ?></h3>
						 <h4>Vacancies Awaiting Approval</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-tachometer"></i>
						</div>
					  <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/waiting_for_approval',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a> 
					  </div>
					</div><!-- ./col -->
     		   
			   
			    
				   <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						<h3><?php echo h($approved) ?></h3>
						 <h4>Vacancies Approved</h4>
						</div>
						<div class="icon">
						  <i class="fa fa-thumbs-o-up"></i>
						</div>
					   <a class="small-box-footer" href="<?php echo h($this->Html->url('/vacancies/approved_vacancy',true)) ?>">More info<i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
     		   
			   
			 
				   <div class="col-lg-4 col-xs-12">
					  <!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
						<h3><?php echo h($approvalCancel) ?></h3>
						 <h4>Cancelled Vacancies</h4>
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



