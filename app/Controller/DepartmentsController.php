<?php
App::uses('AppController','Controller');

class DepartmentsController extends AppController
 {
    public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

    public function index()
    {
		//Default Conditions
		$conditions=array();
		$order=array('Department.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $departments = $this->Paginator->paginate('Department',array(),array('Department.id','Department.department_name'));
	 
	 		
		
      $this->set('departments',$departments);		
     
    }

    public function add()
    {
     if($this->request->is('post'))
	  {
	   $this->request->data['Department']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       $this->request->data['Department']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	   
	    $this->Department->create();
		 if($this->Department->save($this->request->data))
		  {
		   echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>New Department has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		   return $this->redirect(array('action'=>'index'));
		  }
		  else
		   {
		     echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Unable to Add New Department , Please try again later....','default',array('class'=>'alert alert-success alert-dismissable'));
		   }
	  }
    }
	
	public function edit($id=null)
    {
     if (!$this->Department->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Department'));
		  }
		if ($this->request->is(array('post', 'put'))) 
		  {
		    $this->request->data['Department']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
            $this->request->data['Department']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	   
			//pr($this->request->data); exit;
			if($this->Department->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Department has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit Department , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
			$this->request->data = $this->Department->find('first', $options);
		   }
    }
	
	public function delete()
    {
     
    }
	



 }
