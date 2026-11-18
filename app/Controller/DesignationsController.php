<?php
App::uses('AppController','Controller');

class DesignationsController extends AppController
 {
	 
	 
    public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

    public function index()
    {
		//Default Conditions
		$conditions=array();
		$order=array('Designation.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $designations = $this->Paginator->paginate('Designation',array(),array('Designation.id','Designation.designation_name'));
	 
	 		
		
      $this->set('designations',$designations);
    }

    public function add()
    {
     if($this->request->is('post'))
	  {
	   $this->request->data['Designation']['created_by_user_id'] = $this->Session->Read('Auth.User.id');	  
	   $this->Designation->create();
        if($this->Designation->save($this->request->data))
           {
             echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>New Designation has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		  	 return $this->redirect(array('action'=>'index'));	   
           }	
        else
           {
		     echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Unable to Add New Designation , Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));
           }		   
	  }
    }
	
	public function edit($id=null)
    {
     if (!$this->Designation->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Designation'));
		  }
		if ($this->request->is(array('post', 'put'))) 
		  {
			$this->request->data['Designation']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');  
			if ($this->Designation->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Designation has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry,unable to edit Designation , Please try again later....','default',array('class'=>'alert alert-danger'));
			      //return $this->redirect(array('action' => 'index'));
				 }
		  } 
		else 
		   {
			$options = array('conditions' => array('Designation.' . $this->Designation->primaryKey => $id));
			$this->request->data = $this->Designation->find('first', $options);
		   }
    }
	
	public function delete()
    {
     
    }
	



 }
