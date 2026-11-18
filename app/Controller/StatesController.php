<?php
App::uses('AppController','Controller');

class StatesController extends AppController
 {
 
     
 
    public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

    public function index()
    {
     $this->set('states',$this->State->find('all', array(
	                                                     'order'=>array('id'=>'asc'), 
														 )
										    )
                );
    }

    public function add()
    {
     if($this->request->is('post'))
	   {
		 $this->request->data['State']['created_by_user_id'] = $this->Session->read('Auth.User.id');  
	     $this->State->create();
	       if($this->State->save($this->request->data))
	       {
             echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>State has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));	
             return $this->redirect(array('action' => 'index'));			 
		   }
		  else
		   {
		    echo $this->Session->setFlash('Sorry unable to add State,Please try again later....','default',array('class'=>'alert alert-danger'));
	       }	  
	   }
    }
	
	public function edit($id=null)
    {
     if (!$this->State->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid State'));
		  }
		if ($this->request->is(array('post','put'))) 
		  {
			$this->request->data['State']['modified_by_user_id'] = $this->Session->read('Auth.User.id');  
			if ($this->State->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>State has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit State , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
			$this->request->data = $this->State->find('first', $options);
		   }
    }
	
	public function delete()
    {
     
    }
	



 }
