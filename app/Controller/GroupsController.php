<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {


             //Security Purpose-These statements will tell auth component to allow public access to all actions
			 public function beforeFilter() {
                                             parent::beforeFilter();
								         
								            }


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}
	


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid group'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() 
	{
		$this->Group->Behaviors->load('Containable');
	
		if ($this->request->is('post')) {

			$groups=$this->Group->find('all',array(
													'contain'=>false
												   ));
			$RoleLevels=array();
			$MinimumRole=1; //Minimum level has Highest access role
			
			foreach($groups as $group)
			{
				$RoleLevels[]=$group['Group']['level'];
			}
			if(count($RoleLevels))
			{
				$MinimumRole=min($RoleLevels);
				
			}
			if($MinimumRole<1)
			{
				$MinimumRole=1;
			}
			
			
			
			if(isset($this->request->data['Group']['level']) && $this->request->data['Group']['level']=='above_all')
			{
				$this->Group->updateAll(array(
														'Group.level'=>'Group.level+1'
													)
													
											);
				$this->request->data['Group']['level'] = $MinimumRole;							
			}
			else
			{
				$this->Group->updateAll(array(
														'Group.level'=>'Group.level+1'
													),
												array('Group.level >='=>$this->request->data['Group']['level'])	
													
											);
										
			}
			
			
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash('The user role has been saved.','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user role could not be saved. Please, try again.','default',array('class' => 'alert alert-danger '));
			}
		}
		
		$groups=$this->Group->find('all',array(
																'order'=>'level',
																'contain'=>false
															));
		
		$levelOptions=array('above_all'=>'Above all');
		foreach($groups as $group)
		{
			$levelOptions[$group['Group']['level']+1]='Below '.$group['Group']['name'];
			
		}
		$this->set(compact('levelOptions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	
	public function edit($id = null) {
		if (!$this->Group->exists($id)) {
			throw new NotFoundException(__('Invalid employee role'));
		}
		$employeeRoles=$this->Group->find('all',array(
													'order'=>'level',
													'contain'=>false
												));
															
		if ($this->request->is(array('post', 'put'))) 
		{
		
		    $roleLevels = array();
			foreach($employeeRoles as $employeeRole)
			{
			 $roleLevels[] = $employeeRole['Group']['level'];	
			}
			
			
			//For Counting RoleLevels
			if(count($roleLevels))
			{
			 $minimumLevel  = min($roleLevels);			 
			}	
			
			if(isset($this->request->data['Group']['level']) && $this->request->data['Group']['level']=='above_all')
			{
			 $this->Group->updateAll(array(
										  'Group.level'=>'Group.level+1'
										  )
								   );
			 $this->request->data['Group']['level'] = $minimumLevel;							   
			 							   
			}
			else
			{
			 //pr($this->request->data);exit;	
			 $this->Group->updateAll(array(
											  'Group.level'=>'Group.level+1'
											 ),
											array('Group.level >='=>$this->request->data['Group']['level'])	 
			                               );	
			}	
		
			
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash('The employee role has been saved.','default',array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The employee role could not be saved. Please, try again.','default',array('class' => 'alert alert-danger '));
			}
		}
		
		
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id),'recursive'=>-1);
			$this->request->data = $this->Group->find('first', $options);
			
			$levelOptions=array('above_all'=>'Above all');
			foreach($employeeRoles as $employeeRole)
			{   
				if($employeeRole['Group']['level']!=$this->request->data['Group']['level'])
				{
					$levelOptions[$employeeRole['Group']['level']+1]='Below '.$employeeRole['Group']['name'];
				}	
				
			}
			
		
		$this->set(compact('levelOptions'));
	}
	
	
	
	
	
	
	
	
	
	
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('The group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	

 	   
}
