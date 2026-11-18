<?php
App::uses('AppController','Controller');

class EducationQualificationsController extends AppController
 {
    public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

    public function index()
    {
		
		//Default Conditions
		$conditions=array();
		$order=array('EducationQualification.id' => 'asc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $qualifications = $this->Paginator->paginate('EducationQualification',array(),array('EducationQualification.id'));
	 
	 		
		
      $this->set('qualifications',$qualifications);		
    
    }

    public function add()
    {
     if($this->request->is('post'))
	   {
		 $this->request->data['EducationQualification']['created_by_user_id'] =$this->Session->read('Auth.User.id');
		 $this->request->data['EducationQualification']['created_by_orgn_id'] =$this->Session->read('Auth.User.organization_id');
	     $this->EducationQualification->create();
	       if($this->EducationQualification->save($this->request->data))
	       {
             echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Educational Qualification has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));	
             return $this->redirect(array('action' => 'index'));			 
		   }
		  else
		   {
		    echo $this->Session->setFlash('Sorry unable to add Educational Qualification,Please try again later....','default',array('class'=>'alert alert-danger'));
	       }	  
	   }
    }
	
	public function edit($id=null)
    {
     if (!$this->EducationQualification->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Education Qualification'));
		  }
		if ($this->request->is(array('post','put'))) 
		  {
			$this->request->data['EducationQualification']['modified_by_user_id'] =$this->Session->read('Auth.User.id');
		 $this->request->data['EducationQualification']['modified_by_orgn_id'] =$this->Session->read('Auth.User.organization_id');  
			if ($this->EducationQualification->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Educational Qualification has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit Educational Qualification , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('EducationQualification.' . $this->EducationQualification->primaryKey => $id));
			$this->request->data = $this->EducationQualification->find('first', $options);
		   }
    }
	
	
	
	
	
	public function delete()
    {
     
    }
	



 }
