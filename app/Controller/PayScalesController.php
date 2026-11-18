<?php
App::uses('AppController','Controller');

class PayScalesController extends AppController
{
 public function beforeFilter()
    {
	  parent::beforeFilter();
	 
	}
	
 public function index()
  {
    $payscales = $this->PayScale->find('all');
	$this->set(compact('payscales'));
  }

 public function add()
  {
   if($this->request->is('post'))
     {
	   $this->request->data['PayScale']['created_by_user_id'] = $this->Session->Read('Auth.User.id');
       $this->request->data['PayScale']['created_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	   	 
	   $this->PayScale->create();
	     if($this->PayScale->save($this->request->data))
		   {
		     echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Pay Scale has been Successfully added....','default',array('class'=>'alert alert-success alert-dismissable'));
			 return $this->redirect(array('action'=>'index'));
		   }
		  else
            {
			 echo $this->Session->setFlash('Sorry unable to add Pay Scale,Please try again later....','default',array('class'=>'alert alert-danger'));
            }
     }			
  }

 public function edit($id=null)
  {
   if (!$this->PayScale->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Pay Scale'));
		  }
		if ($this->request->is(array('post','put'))) 
		  { 
	        $this->request->data['PayScale']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');
            $this->request->data['PayScale']['modified_by_orgn_id'] = $this->Session->Read('Auth.User.organization_id');	           	   
			if ($this->PayScale->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Pay Scale has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit Pay Scale , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 
		else 
		   {
			$options = array('conditions' => array('PayScale.' . $this->PayScale->primaryKey => $id));
			$this->request->data = $this->PayScale->find('first', $options);
		   }
  }

 public function delete()
  {
  
  }  
}