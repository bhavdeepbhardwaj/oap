<?php
App::uses('AppController','Controller');

class EssentialsController extends AppController
{
	public function beforeFilter(){
                                    parent::beforeFilter();
									
								  }
    
	public function index()
	{
	 	
	 
		//Default Conditions
		$conditions=array();
		$order=array('Essential.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $essentials = $this->Paginator->paginate('Essential',array(),array('Essential.id'));
	 
	 		
		
      $this->set('essentials',$essentials);	 
	}
    public function add()
	{
	 if($this->request->is('post'))
	 {
	   $this->request->data['Essential']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       $this->request->data['Essential']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	   
	   $this->Essential->create();
          if($this->Essential->save($this->request->data))
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>New Essential has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));
		  }
          else
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,Unable to add Essential,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));  
		  }			  
	 }		 
	}
	public function edit($id=null)
	{
	 if(!$this->Essential->exists($id))
	 {
	   throw new NotFoundException('Invalid Essential');	 
	 }
     if($this->request->is(array('post','put')))
	   {
		//$this->Essential->id = $options;
		$this->request->data['Essential']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
        $this->request->data['Essential']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	            
		 if($this->Essential->save($this->request->data))
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Essential Name has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));   
		   }
           else
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to edit Essential Name,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));   
		    return $this->redirect(array('action'=>'index'));
		   }			   
	   }
	   $options = $this->Essential->find('first',array('conditions'=>array('Essential.id'=>$id)));	   
       $this->request->data= $options;
     	 
	}

}