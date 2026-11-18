<?php
App::uses('AppController','Controller');

class CadresController extends AppController
{
	public function beforeFilter(){
                                    parent::beforeFilter();
									
								  }
    
	public function index()
	{
	 	
	 
		//Default Conditions
		$conditions=array();
		$order=array('Cadre.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $cadres = $this->Paginator->paginate('Cadre',array(),array('Cadre.id'));
	 
	 		
		
      $this->set('cadres',$cadres);	 
	}
    public function add()
	{
	 if($this->request->is('post'))
	 {
	   $this->request->data['Cadre']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       //$this->request->data['Cadre']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	 
	   $this->Cadre->create();
          if($this->Cadre->save($this->request->data))
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Cadre has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));
		  }
          else
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to add cadre,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));  
		  }			  
	 }		 
	}
	public function edit($id=null)
	{
	 if(!$this->Cadre->exists($id))
	 {
	   throw new NotFoundException('Invalid Cadre');	 
	 }
     if($this->request->is(array('post','put')))
	   {
		$this->Cadre->id = $options;
		$this->request->data['Cadre']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
        //$this->request->data['Cadre']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	            
           if($this->Cadre->save($this->request->data))
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Cadre has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));   
		   }
           else
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to edit cadre,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));   
		    return $this->redirect(array('action'=>'index'));
		   }			   
	   }
	   $options = $this->Cadre->find('first',array('conditions'=>array('Cadre.id'=>$id)));	   
       $this->request->data= $options;
     	 
	}

}