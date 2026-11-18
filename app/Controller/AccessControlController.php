<?php
App::uses('AppController', 'Controller');
/**
 * Bills Controller

 */
class AccessControlController extends AppController {
	
	public $components=array('RequestHandler',
		'Paginator');
    
	public $uses=array('User','Group','Aco');

	public function list_roles_assigned_to_users()
	{
		//$this->Employee->recursive=1;
		$this->Paginator->settings=array(
											'fields'=>array('User.id','User.group_id','User.organization_id','User.email','User.f_name','User.l_name'),
											'order' => array('id' => 'desc'),
											'limit'=>10
										);
		$users = $this->Paginator->paginate('User');
		
		

		$Aro = $this->Group;
		
		$aros	=$Aro->find('all',array('recursive' => -1));		
		$this->set('aroAlias', $Aro->alias);
		$this->set('aroDisplayField', $Aro->displayField);		
		$this->set(compact('users','aros'));								
	}

	
	public function update_role_assigned_to_user($id=null)
	{
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid User'));
		}
		
	
		
		$this->User->Behaviors->load('Containable');
		
		
		$user=$this->User->find('first',array(
														'conditions'=>array('User.id'=>$id),
														'contain'=>array(
																			
																			'Group',
																			'Organization',
																			'Department',
																			'OfficeLocation',
																			'Designation',
																			//'State',
																			//'City'
																		
																		),
														/*'fields'=>array(
																			'User.id','User.email'
																			
																			
																			
																			)	*/			
													)
										);
	
		$roleLevel=$user['Group']['level'];
		
		if($this->Session->read('Auth.User.Group.level')>=$roleLevel)
		{
			throw new MethodNotAllowedException(__('You are not authorized to change role for this user.'));
		}	
		
		$permissionDependency=$this->Session->read('Auth.User.Group.dependency');
		$loggedInUserOrganization=$this->Session->read('Auth.User.organization_id');
	    
		
		if($permissionDependency=='organization' && $loggedInUserOrganization!=$user['User']['organization_id'])
		{
			throw new MethodNotAllowedException(__('You are not authorized to change role for this user. User does not belong to your organization'));
		}
		
		if($this->request->is(array('Post','Put')))
		{
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('User role has been updated.','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'list_roles_assigned_to_users'));
			} else {
				$this->Session->setFlash('User role could not be updated. Please, try again.','default',array('class' => 'alert alert-danger'));
			       }
				   
		}
		$this->request->data['User']['id'] = $id;
		$this->request->data['User']['group_id'] = $user['User']['group_id'];
		$groups = $this->User->Group->find('list',array('conditions'=>array(
		                                                                    'Group.level >='=>$this->Session->read('Auth.User.Group.level')),
																			'order' => 'id'
																		));
		
		$this->set(compact('user','groups'));
		
			
	}	
	
	//This action should be accessed by only superadmin and global admin
	public function list_actions_assigned_to_employee_roles()
	{
		$topAco = $this->Acl->Aco->find('first', array('conditions'=>array('parent_id'=>null), 'recursive' => -11));
	//	pr($topAco);
												
		$this->Paginator->settings = array(
											'conditions'=>array(
																'parent_id'=>$topAco['Aco']['id']
																),
											'order' => 'Aco.lft ASC',
											'recursive' => -1,
											'limit' => 5
										);
		$allControllers = $this->Paginator->paginate('Aco');
		$parentIds=array();
		$alllft=array();
		$allrght=array();
		foreach($allControllers as $controller)
		{
			//$parentIds[]=$controller['Aco']['id'];
			$alllft[]=$controller['Aco']['lft'];
			$allrght[]=$controller['Aco']['rght'];
		}
		
		//$parentIds[]=$topAco['Aco']['id'];	
													
		
		$acos = $this->Acl->Aco->find('threaded', array(
													'conditions'=>array(
														//'Aco.parent_id'=>$parentIds,
														'Aco.lft >= '=>min($alllft),
														'Aco.rght <= '=>max($allrght)
														
													
													),
													'order' => 'Aco.lft ASC',
													'recursive' => 1
													));		
		

		$Aro = $this->Group;
		//pr($this->Session->read('Auth.User.EmployeeRole.level'));
		
		$aros	=	$Aro->find('all',array(
											
											'recursive' => -1
											));
				
		$this->set('aroAlias', $Aro->alias);
		$this->set('aroDisplayField', $Aro->displayField);		
		$this->set(compact('allControllers','aros','acos'));
	}	
	
	//This action should be accessed by only superadmin and global admin
	public function update_action_access_for_employee_role($AcoID)
	{
		
		
		
		if (!$this->Acl->Aco->exists($AcoID)) {
					throw new NotFoundException(__('Invalid Aco'));
				}		
		
		if($this->request->is('post'))
		{
			
			
			$action= $this->Acl->Aco->find('first', array(
														  'conditions'=>array(
																	
														   'Aco.id'=>$this->request->data['mypermission']['aco_id'],
																
														  ),
																
														  'recursive' => 1
														));	
			$Controller = $this->Acl->Aco->find('first', array('conditions'=>array('id'=>$action['Aco']['parent_id']), 'recursive' => -1));				
			//pr($this->request->data);
			//pr($Controller);exit;
			foreach($this->request->data['mypermission']['Aro'] as $Aro=>$Aco)
			{
				
				$group = $this->Group;
				$group->id=$Aro;
				if($Aco)
				{
					
					if($this->Acl->allow($group,'controllers/'.$Controller['Aco']['alias'].'/'.$action['Aco']['alias']))
						$this->Session->setFlash('Permissions has been updated successfully.','default',array('class' => 'alert alert-success '));
					else
					{
						$this->Session->setFlash('An error occurred while trying to update permissions for a role.','default',array('class' => 'alert alert-danger '));
						break;
					}
				}
				else
				{
					
					if($this->Acl->deny($group,'controllers/'.$Controller['Aco']['alias'].'/'.$action['Aco']['alias']))
					$this->Session->setFlash('Permissions have been updated successfully.','default',array('class' => 'alert alert-success '));
					else
					{
						$this->Session->setFlash('An error occurred while trying to update permissions for a role.','default',array('class' => 'alert alert-danger '));
						break;
					}					
				}
			}
		}
		
		$action= $this->Acl->Aco->find('first', array(
															'conditions'=>array(
																
																'Aco.id'=>$AcoID,
															
															
															),
															
															'recursive' => 1
															));	
		$Controller = $this->Acl->Aco->find('first', array('conditions'=>array('id'=>$action['Aco']['parent_id']), 'recursive' => -1));													
		//pr($action);exit;
		/*$model = isset($this->request->params['named']['aro']) ? $this->request->params['named']['aro'] : null;
		if (!$model || !in_array($model, Configure::read('AclManager.aros'))) {
			$model = Configure::read('AclManager.aros');
			$model = $model[0];
		}*/

		$Aro = $this->Group;
		
		$aros	=	$Aro->find('all',array(
											
											'recursive' => -1
											));
				
		$this->set('aroAlias', $Aro->alias);
		$this->set('aroDisplayField', $Aro->displayField);	
		$this->set(compact('aros','action','Controller'));
		
	}	
	
	public function list_team_employees_to_change_employee_level_access()
	{
		$this->Paginator->settings=array(
											
											'order' => array('id' => 'desc'),
											'limit'=>20
										);
		$users = $this->Paginator->paginate('User');	
		$this->set(compact('users'));	
	}	
	
	public function update_employee_level_access($id=null)
	{
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid User'));
		}
		
		if($this->Session->read('Auth.User.id')==$id)
		{
			throw new MethodNotAllowedException(__('You are not authorized to change your own permissions.'));
		}	
		$this->User->Behaviors->load('Containable');
		
		//In containaible we write all the tables that belongs to user table, or fields that we want to display
		$user=$this->User->find('first',array(
														'conditions'=>array('User.id'=>$id),
														'contain'=>array(
														                    'Organization',
																			'Department',
																			'Designation',
																			'OfficeLocation',
																			'Group',
																			
																			//'City',
																			//'State',						
																		),
														'fields'=>array(
																			'User.email',
																			'User.u_name_title',
																			'User.f_name',
																			'User.f_name',
																			'User.l_name',
																			'User.profilepic',
																			'User.id',
																			'User.group_id',
																			'User.mobile_number',
		                        											//'User.organization_id',
																			'Organization.organization_name',
																			//'User.department_id',
																			'Department.department_name',
																			//'User.designation_id',
																			'Designation.designation_name',
																			//'User.residential_address',
																			//'EmployeeRole.level',
																			'OfficeLocation.location_name',
																			'OfficeLocation.location_address',
																			'OfficeLocation.state_id',
																			'OfficeLocation.city_id',
																			'Group.level'
																		)				
													)
										);
										//pr($user);exit;
		$roleLevel=$user['Group']['level'];
		
		if($this->Session->read('Auth.User.Group.level')>=$roleLevel)
		{
		  throw new MethodNotAllowedException(__('You are not authorized to change user level based access permissions for this user.'));
		}	
		
		$permissionDependency=$this->Session->read('Auth.User.Group.dependency');
		$loggedInUserOrganization=$this->Session->read('Auth.User.organization_id');
		
		
		if($permissionDependency=='organization' && $loggedInUserOrganization!=$user['Organization']['id'])
		{
			throw new MethodNotAllowedException(__('You are not authorized to change user level based access permissions for this user. Employee does not belong to your Organization'));
		}
		
		
		
		
		
		if($this->request->is('post'))
		{
			
			
			foreach($this->request->data['TeamEmployeePermissions']['Aco'] as $Aco=>$newPermission)
			{			
			
				if($newPermission!=-1)
				{				
					$action= $this->Acl->Aco->find('first', array(
																		'conditions'=>array(
																			
																			'Aco.id'=>$Aco,
																		
																		
																		),
																		
																		'recursive' => 1
																		));	
					$Controller = $this->Acl->Aco->find('first', array('conditions'=>array('id'=>$action['Aco']['parent_id']), 'recursive' => -1));				
				

					
					$user = $this->User;
					$user->id=$this->request->data['TeamEmployeePermissions']['user_id'];
					if($newPermission==1)
					{
						
						if($this->Acl->allow($user,'controllers/'.$Controller['Aco']['alias'].'/'.$action['Aco']['alias']))
							$this->Session->setFlash('Permissions has been updated successfully.','default',array('class' => 'alert alert-success '));
						else
						{
							$this->Session->setFlash('An error occurred while trying to update permissions for a role.','default',array('class' => 'alert alert-danger '));
							
						}
					}
					if($newPermission==0)
					{
						
						if($this->Acl->deny($user,'controllers/'.$Controller['Aco']['alias'].'/'.$action['Aco']['alias']))
						$this->Session->setFlash('Permissions has been updated successfully.','default',array('class' => 'alert alert-success '));
						else
						{
							$this->Session->setFlash('An error occurred while trying to update permissions for a role.','default',array('class' => 'alert alert-success '));
							
						}					
					}
				}
			}
		}		
		
		
		
		$topAco = $this->Acl->Aco->find('first', array('conditions'=>array('parent_id'=>null), 'recursive' => -1));
	//	pr($topAco);
			//pr($this->Session->read('AuthrizedControllerORAction'));exit;									
		$this->Paginator->settings = array(
											'conditions'=>array(
																'parent_id'=>$topAco['Aco']['id'],
																'Aco.id'=>$this->Session->read('AuthrizedControllerORAction'),	
																),
															
											'order' => 'Aco.lft ASC',
											'recursive' => -1,
											'limit' => 5
										);
		$allControllers = $this->Paginator->paginate('Aco');
		$parentIds=array();
		$alllft=array();
		$allrght=array();
		foreach($allControllers as $controller)
		{
			//$parentIds[]=$controller['Aco']['id'];
			$alllft[]=$controller['Aco']['lft'];
			$allrght[]=$controller['Aco']['rght'];
		}
		
		//$parentIds[]=$topAco['Aco']['id'];	
													
		// variale $this->Session->read('AuthrizedControllerORAction') is defined in login function, 
		// we are fetching here only those acos for which currently logged in user has access, he can only change permissions for only these acos for a selected user
		$acos = $this->Acl->Aco->find('threaded', array(
													'conditions'=>array(
														//'Aco.parent_id'=>$parentIds,
														'Aco.lft >= '=>min($alllft),
														'Aco.rght <= '=>max($allrght),
														'Aco.id'=>$this->Session->read('AuthrizedControllerORAction')
														
													
													),
													'order' => 'Aco.lft ASC',
													'recursive' => 1
													));		
		
		
		//pr($acos);exit;
		$Aro = $this->Group;
		//pr($this->Session->read('Auth.User.EmployeeRole.level'));
		
		$aros	=	$Aro->find('all',array(
											'conditions'=>array('level >='=>$this->Session->read('Auth.User.Group.level')),
											'recursive' => -1
											));
				
		$this->set('aroAlias', $Aro->alias);
		$this->set('aroDisplayField', $Aro->displayField);		
		$this->set(compact('allControllers','aros','acos'));		
		$aro_id=$id;
		
		$this->set(compact( 'user','aro_id'));		
		
		
	}	
	
	
	
}