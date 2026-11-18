<div class="row">
   <div class="col-md-12">
	  <div class="box box-primary">
	     <div class="box-header">
				<h3 class="box-title"><?php echo __('Details Of Employment/Experience in Chronological Order'); ?></h3><div class="asteriskLine"> Fields marked with * are mandatory.</div>
		 </div>
		                   <!-- Creating Form -->
			<?php echo $this->Session->flash(); ?>					   
			<?php echo $this->Form->create('UserEmploymentDetails',array('role' => "form")); ?> 
			
	     <div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="2%">S.No.</th>
						<th width="20%">Name Of Organization</th>
						<th width="15%">Posts Held</th>
						<th width="13%">Scale of Pay</th>
						<th width="15%"><center>From</th>
						<th width="15%"><center>To</th>
						<th>Nature of Duties</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<tr>
				  <td></td>
				  <td>
				          <!-- Select Organization -->  
					<div class="col-md-20">
						<div class="form-group">
						 <?php echo $this->Form->input('organization_name', array('placeholder'=>'Enter Organization Name','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				  </td>
				    <td>
				                  <!-- Posts Held -->  
					<div class="col-md-20">
						<div class="form-group">
						 <?php echo $this->Form->input('posts_held',array('placeholder'=>'Enter Post Name','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				  </td>
                  <td>
				         <!-- Scale Of Pay -->  
					<div class="col-md-20">
						<div class="form-group">
						 <?php echo $this->Form->input('scale_of_pay',array('placeholder'=>'Enter Pay Scale','label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>
				  </td>
                  <td>
                           <!-- From Date-->  
					<div class="col-md-20">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
						        <?php echo $this->Form->input('from_date', array('label'=>false,'class'=>'form-control','required'=>true)); ?>
						    </div>
						</div>
					</div>				  
				  </td>
                  <td>
				                <!--To Date-->  
					<div class="col-md-20">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
						            <?php echo $this->Form->input('to_date', array('label'=>false,'class'=>'form-control','required'=>true)); ?>
						    </div>  
						</div>
					</div>
				  </td>
                  <td>
				                <!-- Nature Of Duties -->  
					<div class="col-md-20">
						<div class="form-group">
						 <?php echo $this->Form->input('nature_of_duties', array('label'=>false,'class'=>'form-control','required'=>true)); ?>
						</div>
					</div>	
				  </td>
                  <td>
				    <?php echo $this->Html->link(false, array('action' => 'edit'), array( 'class'=>"fa fa-fw fa-edit",'title'=>'Edit')); ?> Add							
				  </td>				  
				</tr>
			</table>
		</div><!-- /.box-body -->
	  </div>
	
	</div>
</div>