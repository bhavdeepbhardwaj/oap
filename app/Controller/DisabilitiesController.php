<?php
App::uses('AppController','Controller');

class DisabilitiesController extends AppController
{
	public function beforeFilter(){
                                    parent::beforeFilter();
									
								  }
    
	public function index()
	{
	 	
	 
		//Default Conditions
		$conditions=array();
		$order=array('Disability.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $disabilities = $this->Paginator->paginate('Disability',array(),array('Disability.id'));
	 
	 		
		
      $this->set('disabilities',$disabilities);	 
	}
    public function add()
	{
	 if($this->request->is('post'))
	 {
	   $this->request->data['Disability']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       //$this->request->data['Disability']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	 
	   $this->Disability->create();
          if($this->Disability->save($this->request->data))
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Disability Name has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));
		  }
          else
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to add disability name,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));  
		  }			  
	 }		 
	}
	public function edit($id=null)
	{
	 if(!$this->Disability->exists($id))
	 {
	   throw new NotFoundException('Invalid Disability');	 
	 }
     if($this->request->is(array('post','put')))
	   {
		$this->Disability->id = $options;
		$this->request->data['Disability']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
        //$this->request->data['Disability']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	            
           if($this->Disability->save($this->request->data))
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Disability Name has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));   
		   }
           else
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to edit disability name,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));   
		    return $this->redirect(array('action'=>'index'));
		   }			   
	   }
	   $options = $this->Disability->find('first',array('conditions'=>array('Disability.id'=>$id)));	   
       $this->request->data= $options;
     	 
	}

}