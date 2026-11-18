<?php
App::uses('AppController','Controller');

class ServicesController extends AppController
{
	public function beforeFilter(){
                                    parent::beforeFilter();
									
								  }
    
	public function index()
	{
	 	
	 
		//Default Conditions
		$conditions=array();
		$order=array('Service.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $services = $this->Paginator->paginate('Service',array(),array('Service.id'));
	 
	 		
		
      $this->set('services',$services);	 
	}
    public function add()
	{
	 if($this->request->is('post'))
	 {
	   $this->request->data['Service']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       //$this->request->data['Service']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	 
	   $this->Service->create();
          if($this->Service->save($this->request->data))
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Service has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));
		  }
          else
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to add service,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));  
		  }			  
	 }		 
	}
	public function edit($id=null)
	{
	 if(!$this->Service->exists($id))
	 {
	   throw new NotFoundException('Invalid Service');	 
	 }
     if($this->request->is(array('post','put')))
	   {
		$this->Service->id = $options;
		$this->request->data['Service']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
        //$this->request->data['Service']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	            
           if($this->Service->save($this->request->data))
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Service has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));   
		   }
           else
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to edit service,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));   
		    return $this->redirect(array('action'=>'index'));
		   }			   
	   }
	   $options = $this->Service->find('first',array('conditions'=>array('Service.id'=>$id)));	   
       $this->request->data= $options;
     	 
	}

}