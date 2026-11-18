<script>
$(document).ready(function () {
    var url = window.location;
    // Will only work if string in href matches with location
    $('ul.sidebar-menu a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().addClass('active').parent().parent().addClass('active');
});
</script>

<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
         
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">

			<?php
			//echo $this->HTML->image('/css/dist/img/user2-160x160.jpg',array('class'=>'user-image'));
			echo $this->Html->image('/users/download_self_profile_pic', array('alt' => 'Profile Photo','fullBase' => true,'class'=>'user-image'),'/',array('escapeTitle' => false));
			?>
              <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /> -->
            </div>
            <div class="pull-left info">
              <p><?php echo $this->Session->read('Auth.User.f_name').' '.$this->Session->read('Auth.User.l_name'); ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle" style="color:rgb(53,172,25)"></i> online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form-->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
		   <?php
			if($this->Session->read('ACL1.Acos.synchronize'))
			{
			?> 
			<li class="treeview">
				<a href="javascript:;">
					<i class="fa fa-laptop"></i>
					<span>System Update</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo $this->Html->url('/acos/synchronize/',true); ?>"><i class="fa fa-angle-double-right"></i>Synchronize Controllers and Actions</a></li>

				</ul>
			</li>
          <?php
            }
           ?>
            <?php
			if($this->Session->read('ACL1.AccessControl.list_roles_assigned_to_users')|| $this->Session->read('ACL1.AccessControl.list_actions_assigned_to_employee_roles') || $this->Session->read('ACL1.AccessControl.list_team_employees_to_change_employee_level_access'))
			{
			?>         		   
			<li class="treeview">
				<a href="#">
					<i class="fa fa-laptop"></i>
					<span>Access Control</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				<?php
			      if($this->Session->read('ACL1.AccessControl.list_roles_assigned_to_users'))
			     {
			    ?>
					<li><a href="<?php echo $this->Html->url('/access_control/list_roles_assigned_to_users',true); ?>"><i class="fa fa-angle-double-right"></i>Change User Roles</a></li>
				<?php
				 }
				?>
				<?php
				if($this->Session->read('ACL1.AccessControl.list_actions_assigned_to_employee_roles'))
				{
				?>	
					<li><a href="<?php echo $this->Html->url('/access_control/list_actions_assigned_to_employee_roles',true); ?>"><i class="fa fa-angle-double-right"></i>Change Role Permissions</a></li>
				<?php
				 }
				?>
				<?php
				if($this->Session->read('ACL1.AccessControl.list_team_employees_to_change_employee_level_access'))
				{
				?>	
					<li><a href="<?php echo $this->Html->url('/access_control/list_team_employees_to_change_employee_level_access',true); ?>"><i class="fa fa-angle-double-right"></i>Change User Permissions</a></li>
				<?php
				 }
				?> 
				</ul>
			</li>
			<?php
			 }
			?> 
			
		<?php
		if($this->Session->read('ACL1.Groups.index') || $this->Session->read('ACL1.Groups.add'))
		{
		?>			
          <li class="treeview">
		      <a href="#">
		      <i class="fa fa-laptop"></i>
              <span>Manage Roles</span> 
			  <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			  <?php
				if($this->Session->read('ACL1.Groups.add'))
				{
				?>
                <li><a href="<?php echo $this->HTML->url('/groups/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Roles</a></li>
                <?php
				}
				?>
				<?php
				if($this->Session->read('ACL1.Groups.index'))
				{
				?>
				<li><a href="<?php echo $this->HTML->url('/groups',true) ?>"><i class="fa fa-angle-double-right"></i>View Roles</a></li>
				<?php
				}
				?>
			  </ul>
            </li>
        <?php
		  }
		?>
		
		<?php
		if($this->Session->read('ACL1.AuditTrails.login_log') || $this->Session->read('ACL1.AuditTrails.action_log'))
		{
		?>			
          <li class="treeview">
		      <a href="#">
		      <i class="fa fa-laptop"></i>
              <span>Audit Trails</span> 
			  <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			  <?php
				if($this->Session->read('ACL1.AuditTrails.login_log'))
				{
				?>
                <li><a href="<?php echo $this->HTML->url('/audit_trails/login_log',true) ?>"><i class="fa fa-angle-double-right"></i>Login Logs</a></li>
                <?php
				}
				?>
				<?php
				if($this->Session->read('ACL1.AuditTrails.action_log'))
				{
				?>
				<li><a href="<?php echo $this->HTML->url('/audit_trails/action_log',true) ?>"><i class="fa fa-angle-double-right"></i>Action Logs</a></li>
				<?php
				}
				?>
			  </ul>
            </li>
        <?php
		  }
		?>

                            <!--Pages-->
        <?php
		if($this->Session->read('ACL1.Pages.index') || $this->Session->read('ACL1.Pages.add'))
		{
		?>			
          <li class="treeview">
		      <a href="#">
		      <i class="fa fa-laptop"></i>
              <span>Pages</span> 
			  <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			  <?php
				if($this->Session->read('ACL1.Pages.index'))
				{
				?>
                <li><a href="<?php echo $this->HTML->url('/pages/index',true) ?>"><i class="fa fa-angle-double-right"></i>View</a></li>
                <?php
				}
				?>
				<?php
				if($this->Session->read('ACL1.Pages.add'))
				{
				?>
				<li><a href="<?php echo $this->HTML->url('/pages/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add</a></li>
				<?php
				}
				?>
			  </ul>
            </li>
        <?php
		  }
		?>							

		
		
		
                                    <!-- DashBoard-->
			<?php if($this->Session->read('ACL1.Dashboard.index'))					
              { 
			 ?>			 
			<li class="treeview">
              <a href="<?php echo $this->HTML->url('/dashboard/index',true) ?>">
			  <i class="fa fa-dashboard"></i>
			  <span>DashBoard</span></a>
		  </li>
           <?php
              }
             ?>	
			 
			                       <!-- Manage Notices-->
								   
			<?php if($this->Session->read('ACL1.Notices.index') || $this->Session->read('ACL1.Notices.add'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Vacancy Circulars</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <?php
				if($this->Session->read('ACL1.Notices.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/notices/add',true) ?>"><i class="fa fa-angle-double-right"></i>Create Circular</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Notices.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/notices',true) ?>"><i class="fa fa-angle-double-right"></i>View Created Circulars</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
			                       
         								   <!-- Manage Vacancies-->
										   
			<?php if($this->Session->read('ACL1.Vacancies.index') || $this->Session->read('ACL1.Vacancies.add'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Vacancies</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			  <?php
				if($this->Session->read('ACL1.Vacancies.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/vacancies/add',true) ?>"><i class="fa fa-angle-double-right"></i>Create Vacancy</a></li>
                <?php
				 }
				?>
				<?php
				if($this->Session->read('ACL1.Vacancies.index'))
				 {
				?>
				<li><a href="<?php echo $this->HTML->url('/vacancies',true) ?>"><i class="fa fa-angle-double-right"></i>View Created Vacancies</a></li>
                <?php
				 }
				?>
			  </ul>
            </li>
			<?php
              }
             ?>
			                    
								   <!-- Manage Essentials-->
								   
			<?php if($this->Session->read('ACL1.Essentials.index') || $this->Session->read('ACL1.Essentials.add'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Essentials</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <?php
				if($this->Session->read('ACL1.Essentials.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/essentials/add',true) ?>"><i class="fa fa-angle-double-right"></i>Create Essential</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Essentials.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/essentials',true) ?>"><i class="fa fa-angle-double-right"></i>View Created Essentials</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
			                    
								   <!-- Manage Desirables-->
								   
			<?php if($this->Session->read('ACL1.Desirables.index') || $this->Session->read('ACL1.Desirables.add'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Desirables</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <?php
				if($this->Session->read('ACL1.Desirables.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/desirables/add',true) ?>"><i class="fa fa-angle-double-right"></i>Create Desirable</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Desirables.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/desirables',true) ?>"><i class="fa fa-angle-double-right"></i>View Created Desirables</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
			  
			                    
			 
                                   <!-- Manage Vacancy Officer-->
			             			 
			<?php if($this->Session->read('ACL1.UserAppliedVacancies.new_applications') || $this->Session->read('ACL1.UserAppliedVacancies.accepted_applications') || $this->Session->read('ACL1.UserAppliedVacancies.rejected_applications')||$this->Session->read('ACL1.UserAppliedVacancies.under_consideration')||$this->Session->read('ACL1.UserAppliedVacancies.call_for_interview')||$this->Session->read('ACL1.UserAppliedVacancies.approve_applying_user') || $this->Session->read('ACL1.UserAppliedVacancies.orgn_wise_user_applications_overview'))					
                { 
			  ?>          
			                   
     							   <!--For New Applications-->
				<?php if($this->Session->read('ACL1.UserAppliedVacancies.new_applications'))
                    {
                   ?>
					<li class="treeview">
					  <a href="<?php echo $this->HTML->url('/user_applied_vacancies/new_applications',true) ?>"><i class="fa fa-laptop"></i><span>Applications Received</span></a>
					</li>
				<?php
				   }
				?>
								   <!--For Accepted Applications-->
				<?php //if($this->Session->read('ACL1.UserAppliedVacancies.accepted_applications'))
                    //{
                   ?>
					<!--li class="treeview">
					  <a href="<?php //echo $this->HTML->url('/user_applied_vacancies/accepted_applications',true) ?>"><i class="fa fa-laptop"></i><span>Accepted Applications</span></a>
					</li-->
				<?php
				   //}
				 ?>
				 				   <!--For Rejected Applications-->
				<?php //if($this->Session->read('ACL1.UserAppliedVacancies.rejected_applications'))
                  // {
                 ?>
					<!--li class="treeview">
					  <a href="<?php //echo $this->HTML->url('/user_applied_vacancies/rejected_applications',true) ?>"><i class="fa fa-laptop"></i><span>Not Eligible</span></a>
					</li-->
				<?php
				  //}
				?>
				
				                     <!--For Under Consideration-->
				<?php if($this->Session->read('ACL1.UserAppliedVacancies.under_consideration'))
                    {
                   ?>
					<li class="treeview">
					  <a href="<?php echo $this->HTML->url('/user_applied_vacancies/under_consideration',true) ?>"><i class="fa fa-laptop"></i><span>Incomplete Documents</span></a>
					</li>
				<?php
				   }
				?>
				                     <!--For Call for Interview-->
				<?php if($this->Session->read('ACL1.UserAppliedVacancies.call_for_interview'))
                    {
                   ?>
					<li class="treeview">
					  <a href="<?php echo $this->HTML->url('/user_applied_vacancies/call_for_interview',true) ?>"><i class="fa fa-laptop"></i><span>Call for Interview</span></a>
					</li>
				<?php
				   }
				?>
								   <!--For Admin Approving Applicants-->
				<?php if($this->Session->read('ACL1.UserAppliedVacancies.approve_applying_user'))
                    {
                   ?>
					<li class="treeview">
					  <a href="<?php echo $this->HTML->url('/user_applied_vacancies/approve_applying_user',true) ?>"><i class="fa fa-laptop"></i><span>Approve Applicants</span></a>
					</li>
				<?php
				   }
				 ?>
				 
				               <!--For  Monitoring Applications-->
				<?php 
				  if($this->Session->read('ACL1.UserAppliedVacancies.orgn_wise_user_applications_overview'))
                    {
					
					 $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
					 if($userOrgnType=='MOS')
					  {   
					   
                   ?>
					<li class="treeview">
					  <a href="<?php echo $this->HTML->url('/user_applied_vacancies/orgn_wise_user_applications_overview',true) ?>"><i class="fa fa-laptop"></i><span>Monitor Applications</span></a>
					</li>
				<?php
				     }
				   }
				 ?>
				   				   <!--For Uploading Acrs-->
				<?php //if($this->Session->read('ACL1.UserAppliedVacancies.accepted_applications'))
                    //{
                   ?>
					<!-- <li class="treeview">
					  <a href="<?php //echo $this->HTML->url('/user_applied_vacancies/accepted_applications',true) ?>"><i class="fa fa-laptop"></i><span>Accepted Applications</span></a>
					</li> -->
				<?php
				   //}
				 ?> 
				
		    <?php
			  }
			 ?>   			 
				
                                    <!-- Organization-->				
			<?php if($this->Session->read('ACL1.Organizations.index') || $this->Session->read('ACL1.Orgaznizations.add') || $this->Session->read('ACL1.OfficeLocations.index') || $this->Session->read('ACL1.OfficeLocations.add'))					
              { 
			 ?> 								
		    <li class="treeview">
                 <a href="#">
		         <i class="fa fa-laptop"></i>			 
                 <span>Manage Organizations</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <?php
				if($this->Session->read('ACL1.Organizations.add'))
				{
				?>
                <li><a href="<?php echo $this->HTML->url('/organizations/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Organization</a></li>
                <?php
				}
				?>
				<?php
				if($this->Session->read('ACL1.Organizations.index'))
				{
				?>
				<li><a href="<?php echo $this->HTML->url('/organizations',true) ?>"><i class="fa fa-angle-double-right"></i>View Organizations</a></li>
				<?php
				}
				?>
				<?php
				if($this->Session->read('ACL1.OfficeLocations.add'))
				{
				?>
				<li><a href="<?php echo $this->HTML->url('/office_locations/add',true) ?>"><i class="fa fa-angle-double-right"></i>Assign Locations & Departments</a></li>
				<?php
				}
				?>
				<?php
				if($this->Session->read('ACL1.OfficeLocations.index'))
				{
				?>
				<li><a href="<?php echo $this->HTML->url('/office_locations',true) ?>"><i class="fa fa-angle-double-right"></i>View Assigned Locations & Departments</a></li>
              <?php
				}
				?>
			  </ul>
            </li>
			<?php
              }
             ?>

			 
                                     <!-- Manage Departments-->
			
			<?php if($this->Session->read('ACL1.Departments.index') || $this->Session->read('ACL1.Departments.add'))					
                { 
			  ?>
				<li class="treeview">
				  <a href="#"><i class="fa fa-laptop"></i><span>Manage Departments</span><i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<?php if($this->Session->read('ACL1.Departments.add'))
                     {
                    ?>					 
					<li><a href="<?php echo $this->HTML->url('/departments/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Department</a></li>
					<?php
					 }
					?>
                    <?php
					if($this->Session->read('ACL1.Departments.index'))
					{
					?> 					
					<li><a href="<?php echo $this->HTML->url('/departments',true) ?>"><i class="fa fa-angle-double-right"></i>View Departments</a></li>
                    <?php
					}
					?>				  
				  </ul>
				</li>
		    <?php
			  }
			 ?>			 
			
			                            <!--Manage Designations-->
			
			<?php if($this->Session->read('ACL1.Designations.index') || $this->Session->read('ACL1.Designations.add'))					
              { 
			 ?>
				<li class="treeview">
				  <a href="#"><i class="fa fa-laptop"></i><span>Manage Designations</span><i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<?php
					if($this->Session->read('ACL1.Designations.add'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/designations/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Designation</a></li>
					<?php
					}
					?>
					<?php
					if($this->Session->read('ACL1.Designations.index'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/designations',true) ?>"><i class="fa fa-angle-double-right"></i>View Designations</a></li>
                    <?php
					}
					?>				  
				  </ul>
				</li>
             <?php
                }
              ?>				
			                  <!--Manage States-->
							  
			<?php if($this->Session->read('ACL1.States.index') || $this->Session->read('ACL1.States.add'))					
              { 
			 ?>
				<li class="treeview">
				  <a href="#"><i class="fa fa-laptop"></i><span>Manage States</span><i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
				   <?php
					if($this->Session->read('ACL1.States.add'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/states/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add State</a></li>
					<?php
					}
					?>
					<?php
					if($this->Session->read('ACL1.States.index'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/states',true) ?>"><i class="fa fa-angle-double-right"></i>View States</a></li>
				    <?php
					}
					?>
				  </ul>
				</li>
		      <?php
                }
               ?>		
                                    <!-- Manage Cities-->
								   
		    <?php if($this->Session->read('ACL1.Cities.index') || $this->Session->read('ACL1.Cities.add'))					
              { 
			 ?>	   
				<li class="treeview">
				  <a href="#"><i class="fa fa-laptop"></i><span>Manage Cities</span><i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
				   <?php
					if($this->Session->read('ACL1.Cities.add'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/cities/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add City</a></li>
					<?php
					 }
					?>
					<?php
					if($this->Session->read('ACL1.Cities.index'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/cities',true) ?>"><i class="fa fa-angle-double-right"></i>View Cities</a></li>
				    <?php
					}
					?>
				  </ul>
				</li>
		    <?php
              }
            ?>
			                 <!--Manage Users-->
			
			<?php if($this->Session->read('ACL1.Users.index') || $this->Session->read('ACL1.Users.add') || $this->Session->read('ACL1.Users.add_admin') || $this->Session->read('ACL1.Users.add_vacancy_creator') || $this->Session->read('ACL1.Users.add_vacancy_approver') || $this->Session->read('ACL1.Users.add_officer'))					
              { 
			 ?>
				<li class="treeview">
				  <a href="#"><i class="fa fa-laptop"></i><span>Manage Users</span><i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
				   <?php
					if($this->Session->read('ACL1.Users.add_admin'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/users/add_admin',true) ?>"><i class="fa fa-angle-double-right"></i>Add Admin</a></li>
					<?php
					 }
					?>
					<?php
					if($this->Session->read('ACL1.Users.add_vacancy_creator'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/users/add_vacancy_creator',true) ?>"><i class="fa fa-angle-double-right"></i>Add Vacancy Creator</a></li>
					<?php
					 }
					?>
					<?php
					if($this->Session->read('ACL1.Users.add_vacancy_approver'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/users/add_vacancy_approver',true) ?>"><i class="fa fa-angle-double-right"></i>Add Vacancy Approver</a></li>
					<?php
					 }
					?>
					<?php
					if($this->Session->read('ACL1.Users.add_officer'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/users/add_officer',true) ?>"><i class="fa fa-angle-double-right"></i>Add Officer</a></li>
					<?php
					 }
					?>
					<?php
					if($this->Session->read('ACL1.Users.index'))
					{
					?>
					<li><a href="<?php echo $this->HTML->url('/users',true) ?>"><i class="fa fa-angle-double-right"></i>View Users</a></li>
				    <?php
					 }
					?> 
				  </ul>
				</li>
			<?php
              }
             ?>			  
			    
                    				<!-- Manage Posts -->   
		   <?php if($this->Session->read('ACL1.Posts.index') || $this->Session->read('ACL1.Posts.add'))					
              { 
			 ?>	
				<li class="treeview">
				  <a href="#"><i class="fa fa-laptop"></i><span>Manage Posts</span><i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
				   <?php
					if($this->Session->read('ACL1.Posts.add'))
					{
				    ?>
					<li><a href="<?php echo $this->HTML->url('/posts/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Post</a></li>
					<?php
                      }
                    ?>
					<?php
					if($this->Session->read('ACL1.Posts.index'))
					{
				    ?>
					<li><a href="<?php echo $this->HTML->url('/posts',true) ?>"><i class="fa fa-angle-double-right"></i>View Posts</a></li>
				    <?php
					 }
					?> 
				  </ul>
				</li>
			<?php
              }
             ?>

                                 <!-- Manage Pay Scales-->
			<?php if($this->Session->read('ACL1.PayScales.index') || $this->Session->read('ACL1.PayScales.add'))					
              { 
			 ?>						 
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Pay Scales</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			   <?php
				if($this->Session->read('ACL1.PayScales.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/pay_scales/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Pay Scale</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.PayScales.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/pay_scales',true) ?>"><i class="fa fa-angle-double-right"></i>View Pay Scales</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
			 
			                      <!-- Manage Services-->
			<?php if($this->Session->read('ACL1.Services.index') || $this->Session->read('ACL1.Services.add'))					
              { 
			 ?>						 
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Services</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			   <?php
				if($this->Session->read('ACL1.Services.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/services/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Service</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Services.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/services',true) ?>"><i class="fa fa-angle-double-right"></i>View Services</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
			 
			                      <!-- Manage Cadres-->
			<?php if($this->Session->read('ACL1.Cadres.index') || $this->Session->read('ACL1.Cadres.add'))					
              { 
			 ?>						 
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Cadres</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			   <?php
				if($this->Session->read('ACL1.Cadres.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/cadres/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Cadre</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Cadres.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/cadres',true) ?>"><i class="fa fa-angle-double-right"></i>View Cadres</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?> 
			 
			 
			                      <!-- Manage Disabilities-->
			<?php if($this->Session->read('ACL1.Disabilities.index') || $this->Session->read('ACL1.Disabilities.add'))					
              { 
			 ?>						 
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Disabilities</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			   <?php
				if($this->Session->read('ACL1.Disabilities.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/disabilities/add',true) ?>"><i class="fa fa-angle-double-right"></i>Add Disabilities</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Disabilities.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/disabilities',true) ?>"><i class="fa fa-angle-double-right"></i>View Disabilities</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>  
			 
			
			 
			                        <!-- Vacancy Approver-->
			<?php if($this->Session->read('ACL1.Vacancies.view_applicable_to'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Approved Vacancy</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <!--li><a href="<?php //echo $this->HTML->url('/vacancies/waiting_for_approval',true) ?>"><i class="fa fa-angle-double-right"></i>Vacancy Waiting For Approval</a></li-->
               <?php if($this->Session->read('ACL1.Vacancies.view_applicable_to'))
				 {
				?> 
				<li><a href="<?php echo $this->HTML->url('/vacancies/approved_vacancy_recruitment_method',true) ?>"><i class="fa fa-angle-double-right"></i>View Recruitment Method</a></li>
              <?php
				 }
				?>
			  </ul>
            </li>
			<?php
              }
             ?>
			 
			                        <!-- Manage Nationalities-->
			<?php if($this->Session->read('ACL1.Nationalities.index') || $this->Session->read('ACL1.Nationalities.add'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Nationalities</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <?php
				if($this->Session->read('ACL1.Nationalities.add'))
				 {
				?>
                <li><a href="<?php echo $this->HTML->url('/nationalities/add',true) ?>">Add Nationality</a></li>
                <?php
				 }
				?>
                <?php
				if($this->Session->read('ACL1.Nationalities.index'))
				 {
				?>				
				<li><a href="<?php echo $this->HTML->url('/nationalities',true) ?>">View Nationalities</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
			 
         			                        <!-- Manage Qualifications-->
			<?php if($this->Session->read('ACL1.EducationQualifications.index') || $this->Session->read('ACL1.EducationQualifications.add'))					
              { 
			 ?>
			<li class="treeview">
              <a href="#"><i class="fa fa-laptop"></i><span>Manage Qualifications</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php
				if($this->Session->read('ACL1.EducationQualifications.add'))
				 {
				?>
				<li><a href="<?php echo $this->HTML->url('/education_qualifications/add',true) ?>">Add Education Qualification</a></li>
                <?php
				 }
				?>
				<?php
				if($this->Session->read('ACL1.EducationQualifications.index'))
				 {
				?>
				<li><a href="<?php echo $this->HTML->url('/education_qualifications',true) ?>">View Education Qualifications</a></li>
                <?php
				 }
				?> 
			  </ul>
            </li>
			<?php
              }
             ?>
      			                         <!-- Registered User --> 
		
		<?php if($this->Session->read('ACL1.Users.basic_info') || $this->Session->read('ACL1.Users.contact_details') || $this->Session->read('ACL1.UserQualifications.add') || $this->Session->read('ACL1.Users.current_service_details') || $this->Session->read('ACL1.UserEmploymentDetails.add') || $this->Session->read('ACL1.Users.doc_upload_part1') || $this->Session->read('ACL1.Users.preview') || $this->Session->read('ACL1.UserAppliedVacancies.my_active_applications') || $this->Session->read('ACL1.Vacancies.current_openings') || $this->Session->read('ACL1.Notices.view'))					
              { 
			 ?>
			 <?php
				if($this->Session->read('ACL1.UserAppliedVacancies.my_active_applications'))
				 {
				?>
			<li class="treeview">
				<a href="<?php echo $this->HTML->url('/user_applied_vacancies/my_active_applications',true) ?>">
					<i class="fa fa-laptop"></i>
					<span>My Active Applications</span>
				</a>
            </li>
			<?php
              }
             ?>
			<?php
			if($this->Session->read('ACL1.Vacancies.current_openings'))
			 {
			?> 
            <li class="treeview">
				<a href="<?php echo $this->HTML->url('/vacancies/current_openings',true) ?>">
					<i class="fa fa-laptop"></i>
					<span>Vacancies</span>
				</a>
            </li>
			 <?php
              }
             ?>
			<?php
			if($this->Session->read('ACL1.Notices.view'))
			 {
			?> 
            <li class="treeview">
				<a href="<?php echo $this->HTML->url('/notices/view',true) ?>">
					<i class="fa fa-laptop"></i>
					<span>Vacancy Circulars</span>
				</a>
            </li>			
			<?php
              }
             ?>    			
			<li class="treeview">
				<a href="#">
					<i class="fa fa-laptop"></i>
					<span>Personal Information</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				<?php
			       if($this->Session->read('ACL1.Users.basic_info'))
			         {
			    ?>
					<li><a href="<?php echo $this->Html->url('/users/basic_info',true); ?>"><i class="fa fa-angle-double-right"></i>Basic Information</a></li>
				<?php
                    }
                ?>	
				<?php
			       if($this->Session->read('ACL1.Users.contact_details'))
			         {
			    ?>
					<li><a href="<?php echo $this->Html->url('/users/contact_details',true); ?>"><i class="fa fa-angle-double-right"></i>Contact Details</a></li>
                <?php
                   }
                ?>
                <?php
			       if($this->Session->read('ACL1.UserQualifications.add'))
			         {
			    ?>				
					<li><a href="<?php echo $this->Html->url('/user_qualifications/add',true); ?>"><i class="fa fa-angle-double-right"></i>Educational Details</a></li>					
	            <?php
                   }
                ?>	
                <?php
			       if($this->Session->read('ACL1.Users.current_service_details'))
			         {
			    ?>				
     				<li><a href="<?php echo $this->Html->url('/users/current_service_details',true); ?>"><i class="fa fa-angle-double-right"></i>Current Service Details</a></li>
	            <?php
                   }
                ?>
				<?php
			       if($this->Session->read('ACL1.UserEmploymentDetails.add'))
			         {
			    ?>
    				<li><a href="<?php echo $this->Html->url('/user_employment_details/add',true); ?>"><i class="fa fa-angle-double-right"></i>Employment Details</a></li>				
 				<?php
                   }
                ?>
				<?php
			       if($this->Session->read('ACL1.Users.doc_upload_part1'))
			         {
			    ?>
     				<li><a href="<?php echo $this->Html->url('/users/doc_upload_part1',true); ?>"><i class="fa fa-angle-double-right"></i>Upload Pic & Signature</a></li>				
				<?php
                   }
                ?>
				<?php
			       if($this->Session->read('ACL1.Users.preview'))
			         {
			    ?>	
					<li><a href="<?php echo $this->Html->url('/users/preview',true); ?>"><i class="fa fa-angle-double-right"></i>Preview</a></li>
				<?php
                   }
                ?>
				</ul>
		  </li>
		   <?php
             }
            ?>
			
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>