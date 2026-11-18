<?php
App::uses('AclAppController','Controller');
/**
 *
 * @author   Nicolas Rod <nico@alaxos.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.alaxos.ch
 * 
 * @property AclReflectorComponent $AclReflector 
 */
class ArosController extends AclAppController
{

	var $name       = 'Aros';
	var $uses       = array('Aro','EmployeeRole','Employee');
	var $helpers    = array('Js' => array('Jquery'));
	
	var $paginate = array(
        'limit' => 5,
        //'order' => array('display_name' => 'asc')
		);
	
	function beforeFilter()
	{
	    $this->loadModel('EmployeeRole');
	    $this->loadModel('Employee');
	    
	    parent :: beforeFilter();
	}
    

	
	public function check($run = null)
	{
		//$user_model_name = Configure :: read('acl.aro.user.model');
		$user_model_name = 'Employee';
	    //$role_model_name = Configure :: read('acl.aro.role.model');exit;
	    $role_model_name = 'EmployeeRole';
	    
	    $user_display_field = $this->AclManager->set_display_name($user_model_name,'employee_first_name');
	    $role_display_field = $this->AclManager->set_display_name($role_model_name, 'employee_role');
	    
	    $this->set('user_display_field', $user_display_field);
	    $this->set('role_display_field', $role_display_field);
	    
		$roles = $this->EmployeeRole->find('all', array('order' => $role_display_field, 'contain' => false, 'recursive' => -1));
	 	
		$missing_aros = array('roles' => array(), 'users' => array());
	    
		foreach($roles as $role)
		{
			/*
			 * Check if ARO for role exist
			 */
			$aro = $this->Aro->find('first', array('conditions' => array('model' => $role_model_name, 'foreign_key' => $role[$role_model_name][$this->_get_role_primary_key_name()])));
			
			if($aro === false)
			{
				$missing_aros['roles'][] = $role;
			}
		}
		
		$users = $this->{$user_model_name}->find('all', array('order' => $user_display_field, 'contain' => false, 'recursive' => -1));
		foreach($users as $user)
		{
			/*
			 * Check if ARO for user exist
			 */
			$aro = $this->Aro->find('first', array('conditions' => array('model' => $user_model_name, 'foreign_key' => $user[$user_model_name][$this->_get_user_primary_key_name()])));
			
			if($aro === false)
			{
				$missing_aros['users'][] = $user;
			}
		}
		
		
		if(isset($run))
		{
			$this->set('run', true);
			
			/*
			 * Complete roles AROs
			 */
			if(count($missing_aros['roles']) > 0)
			{
				foreach($missing_aros['roles'] as $k => $role)
				{
					$this->Aro->create(array('parent_id' 		=> null,
												'model' 		=> $role_model_name,
												'foreign_key' 	=> $role[$role_model_name][$this->_get_role_primary_key_name()],
												'alias'			=> $role[$role_model_name][$role_display_field]));
					
					if($this->Aro->save())
					{
						unset($missing_aros['roles'][$k]);
					}
				}
			}
			
			/*
			 * Complete users AROs
			 */
			if(count($missing_aros['users']) > 0)
			{
				foreach($missing_aros['users'] as $k => $user)
				{
					/*
					 * Find ARO parent for user ARO
					 */
					$parent_id = $this->Aro->field('id', array('model' => $role_model_name, 'foreign_key' => $user[$user_model_name][$this->_get_role_foreign_key_name()]));
					
					if($parent_id !== false)
					{
						$this->Aro->create(array('parent_id' 		=> $parent_id,
													'model' 		=> $user_model_name,
													'foreign_key' 	=> $user[$user_model_name][$this->_get_user_primary_key_name()],
													'alias'			=> $user[$user_model_name][$user_display_field]));
						
						if($this->Aro->save())
						{
							unset($missing_aros['users'][$k]);
						}
					}
				}
			}
		}
		else
		{
			$this->set('run', false);
		}
		
		$this->set('missing_aros', $missing_aros);
		
	}
	
	
}
?>