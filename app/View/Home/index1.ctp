  <?php //pr($notices); exit; ?>
  <div class="row">
	      <!-- Displaying Advertisements -->
	  <div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Openings Arriving Soon....</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Title</th>
						<th>Opening Date</th>
						<th>Closing Date</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($notices as $notice): ?>
					<tr>
						<td><?php echo $i;?>
						<td><?php echo ucfirst(h($notice['Notice']['advt_number'])); ?></td>
						<td><?php echo ucfirst(h($notice['Notice']['advt_name'])); ?></td>
						<td><?php echo date('d-M-Y',strtotime($notice['Notice']['opening_date'])); ?></td>
						<td><?php echo date('d-M-Y',strtotime($notice['Notice']['closing_date'])); ?></td>
					<td><center>
					<?php echo $this->Html->link(false,'/uploads/advertisements/'.$notice['Notice']['advt_pdf'],array('target' => '_blank','fullBase' => true,'class'=>'fa fa-download')); ?>
					</center></td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
	

                              	<!-- Code for Sign In Form-->
							
			<!--div class="row"-->
		<div class="col-md-4 pull-right">
		    <div class="box box-primary">
						<?php
							  //echo $this->Form->create('User',array('action'=>'login'));
					    ?>
		     <!--div class="login-box"-->
                  <div class="login-box-body">
	                 <?php
	                 echo $this->Form->create('User',array('action'=>'login'));
	                 ?>
                  <h3><p class="login-box-msg">Sign in to start your session</p></h3>
                         <!-- Flash Message -->
	                <?php  echo $this->session->flash(); ?>
                         <div class="form-group has-feedback"> 
		                    <?php 
		                     echo $this->Form->input('email',array('label'=>false,'class'=>'form-control','placeholder'=>'Email Id','required'=>true));  
		                    ?>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                         </div>
          <div class="form-group has-feedback">
		          <?php 
		          echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'Password','required'=>true));
		          ?>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
              <div class="row">
                        <div class="col-md-12">
                             <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
              </div>
		  
                     <a href="#"><center>I forgot my password</center></a>
		               <center><?php echo $this->Html->link('Register Here',array('controller'=>'users','action'=>'user_registration')); ?></center>
		                  <?php
                            echo $this->Form->end();
		                  ?>
               </div><!-- /.login-box-body -->
            <!--/div><!-- /.login-box -->
			</div>
		</div>
	</div>
			
			
		              <!-- For Applying Vacancies-->
 <div class="row">			  
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Current Openings</h3>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			<table id="example1" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Advertisement Number</th>
						<th>Advertisement Title</th>
						<th>Post Name</th>
						<th>Method Of Recruitment</th>
						<th>Closing Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;foreach ($vacancies as $vacancy): ?>
					<tr>
						<td><?php echo $i;?>
						<td><?php echo ucfirst(h($vacancy['Notice']['advt_number'])); ?></td>
					    <td><?php echo $this->Html->link($vacancy['Notice']['advt_name'],array('controller'=>'vacancies','action'=>'view_vacancy',$vacancy['Vacancy']['id']),array('target'=>'_blank'));?></td>
						<td><?php echo ucfirst(h($vacancy['Post']['post_name'])); ?></td>
						<td><?php echo ucfirst(h($vacancy['Vacancy']['recruitment_method'])); ?></td>
						<td><?php echo date('d-M-Y',strtotime($vacancy['Notice']['closing_date'])); ?></td>
					    <td><button type="submit" class="btn btn-primary btn-xs">Apply</button></td>
					</tr>
				<?php $i++;endforeach; ?>
			</table>
		</div><!-- /.box-body -->
		</div>
	</div>
  </div>			