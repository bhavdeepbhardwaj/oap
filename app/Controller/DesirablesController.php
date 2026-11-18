<?php
App::uses('AppController','Controller');

class DesirablesController extends AppController
{
	public function beforeFilter(){
                                    parent::beforeFilter();
								
								  }
    
	public function index()
	{
	 	
	 
		//Default Conditions
		$conditions=array();
		$order=array('Desirable.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $desirables = $this->Paginator->paginate('Desirable',array(),array('Desirable.id'));
	 
	 		
		
      $this->set('desirables',$desirables);	 
	}
    public function add()
	{
	 if($this->request->is('post'))
	 {
	   $this->request->data['Desirable']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       $this->request->data['Desirable']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	 
	   $this->Desirable->create();
          if($this->Desirable->save($this->request->data))
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>New Desirable has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));
		  }
          else
		  {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to add Desirable,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));  
		  }			  
	 }		 
	}
	public function edit($id=null)
	{
	 if(!$this->Desirable->exists($id))
	 {
	   throw new NotFoundException('Invalid Desirable');	 
	 }
     if($this->request->is(array('post','put')))
	   {
		$this->Desirable->id = $options;
		$this->request->data['Desirable']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
        $this->request->data['Desirable']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	            
           if($this->Desirable->save($this->request->data))
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Desirable Name has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));
		    return $this->redirect(array('action'=>'index'));   
		   }
           else
		   {
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to edit Desirable Name,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));   
		    return $this->redirect(array('action'=>'index'));
		   }			   
	   }
	   $options = $this->Desirable->find('first',array('conditions'=>array('Desirable.id'=>$id)));	   
       $this->request->data= $options;
     	 
	}

}