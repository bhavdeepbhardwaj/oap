<?php 
App::uses('AppController','Controller');

class PostsController extends AppController
{
   public function beforeFilter()
     {
        parent::beforeFilter();
		
     }	 
	 
	public function index()
     {
	  
	  		//Default Conditions
		$conditions=array();
		$order=array('Post.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $posts = $this->Paginator->paginate('Post',array(),array('Post.id'));
	 
	 		
		
      $this->set('posts',$posts);
     }
 
    public function add()
     {
	   if($this->request->is('post'))
	     {
		  $this->request->data['Post']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
          $this->request->data['Post']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	   	 
		  $this->Post->create();
            if($this->Post->save($this->request->data))
               {
                 echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Post has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
                 return $this->redirect(array('action' => 'index'));
               }
            else
              {
			  echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,Unable to add post....','default',array('class'=>'alert alert-danger alert-dismissable'));
              }			  
		}	  
     }
 
    public function edit($id=null)
     {
	  if (!$this->Post->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Post'));
		  }
		if ($this->request->is(array('post','put'))) 
		  {
			$this->request->data['Post']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
            $this->request->data['Post']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	     
			if ($this->Post->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Post has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry , Unable to edit....','default',array('class'=>'alert alert-danger alert-dismissable'));	
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		   }
     } 
	 
	public function delete()
     {
	 
     }	 
   
}