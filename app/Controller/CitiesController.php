<?php
App::uses('AppController','Controller');

class CitiesController extends AppController
 {
    public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

    public function index()
    {
     $this->set('cities',$this->City->find('all'));
    }

    public function add()
    {
     if($this->request->is('post'))
	  {
		$this->request->data['City']['created_by_user_id'] = $this->Session->read('Auth.User.id');    
	    $this->City->create();
		 if($this->City->save($this->request->data))
		  {
		    echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>City has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
			return $this->redirect(array('action'=>'index'));
		  }
		 else
		   {
		    echo $this->Session->setFlash('Sorry unable to add City,Please try again later....','default',array('class'=>'alert alert-danger'));
	       } 
		  
	  }
	       //Calling States table Data
		   $states = $this->City->State->find('list', array( 'fields'=>array('id','state_name'),
                                                            'order' => 'id'));
														
            $this->set(compact('states'));		   
	  
    }
	
	public function edit($id=null)
    {
     if (!$this->City->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid City'));
		  }
		if ($this->request->is(array('post', 'put'))) 
		  {
			$this->request->data['City']['modified_by_user_id'] = $this->Session->read('Auth.User.id');      
			if ($this->City->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>City has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit city , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
			$this->request->data = $this->City->find('first', $options);
		   }
		  
		$states = $this->City->State->find('list',array('fields'=>'state_name'));
        $this->set(compact('states'));		
    }
	
	public function delete()
    {
     
    }
	



 }
