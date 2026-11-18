<?php
App::uses('AppController','Controller');

class NationalitiesController extends AppController
 {
 
     
 
    public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

    //public function index()
    //{
     //$this->set('nationalities',$this->Nationality->find('all', array(
	 //                                                    'order'=>array('id'=>'asc'), 
	//													 )
	//									    )
    //            );
    //}
	
	public function index()
	{
		$this->Nationality->recursive = -1; // Don’t load associations
		$this->paginate = array(
        'limit' => 100, // Adjust as needed
        'order' => array('Nationality.id' => 'asc')
		);
		$this->set('nationalities', $this->paginate('Nationality'));
	}

    public function add()
    {
     if($this->request->is('post'))
	   {
		 $this->request->data['Nationality']['created_by_user_id'] = $this->Session->Read('Auth.User.id');           	     
	     $this->Nationality->create();
	       if($this->Nationality->save($this->request->data))
	       {
             echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Nationality has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));	
             return $this->redirect(array('action' => 'index'));			 
		   }
		  else
		   {
		    echo $this->Session->setFlash('Sorry unable to add Nationality,Please try again later....','default',array('class'=>'alert alert-danger'));
	       }	  
	   }
    }
	
	public function edit($id=null)
    {
     if (!$this->Nationality->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Nationality'));
		  }
		if ($this->request->is(array('post','put'))) 
		  {
			$this->request->data['Nationality']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');  
			if ($this->Nationality->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Nationality has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit Nationality , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('Nationality.' . $this->Nationality->primaryKey => $id));
			$this->request->data = $this->Nationality->find('first', $options);
		   }
    }
	
	public function delete()
    {
     
    }
	



 }
