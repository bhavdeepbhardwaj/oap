<?php
App::uses('AppController','Controller');

class NoticesController extends AppController
 {
 
     
 
    public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Security->unlockedFields = array('Notice.advt_pdf');
		//$this->Auth->allow();
	}

    public function index()
    {
	 $userOrgn = $this->Session->read('Auth.User.organization_id');
      
    /* $this->set('notices',$this->Notice->find('all', array(
	                                                     'order'=>array('id'=>'asc'), 
														 'conditions'=>array('created_by_orgn_id'=>$userOrgn)
														 )
										    )
                );*/
				
		//Default Conditions
		$conditions=array('created_by_orgn_id'=>$userOrgn);
		$order=array('Notice.id' => 'asc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $notices = $this->Paginator->paginate('Notice',array(),array('Notice.id'));
	 
	 		
		
      $this->set('notices',$notices);				
				
				
				
    }

    public function add()
    {
     if($this->request->is('post'))
	   {//pr($this->request->data); exit;
         $this->request->data['Notice']['created_by_user_id'] = $this->Session->read('Auth.User.id');
		 $this->request->data['Notice']['created_by_orgn_id'] = $this->Session->read('Auth.User.organization_id');
		 //$this->request->data['Notice']['year_of_recruitment']=$this->request->data['Notice']['year_of_recruitment']['year'];
		 $this->Notice->create();
	       if($this->Notice->save($this->request->data))
	       {
             echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Notice has been Successfully Created....','default',array('class'=>'alert alert-success alert-dismissable'));	
             return $this->redirect(array('action' => 'index'));			 
		   }
		  else
		   {
		    echo $this->Session->setFlash('Sorry unable to create Notice ,Please try again later....','default',array('class'=>'alert alert-danger'));
	       }	  
	   }
    }
	
	public function edit($id=null)
    {
		if (!$this->Notice->exists($id)) 
		{
			throw new NotFoundException(__('Invalid Notice'));
		}
		$userOrgn = $this->Session->read('Auth.User.organization_id');	

		$options = array('conditions' => array('Notice.' . $this->Notice->primaryKey => $id));
		$Notice = $this->Notice->find('first', $options);
		if($Notice['Notice']['created_by_orgn_id']!=$userOrgn)
		{
			throw new NotFoundException('Notice Does not belong to your organization....');	
		}
		
		if ($this->request->is(array('post','put'))) 
		{   
			$this->request->data['Notice']['updated_by_user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Notice']['modified_on'] = $this->Notice->getDataSource()->expression('NOW()');			
		    //$this->request->data['Notice']['year_of_recruitment'] = $this->request->data['Notice']['year_of_recruitment']['year']; 
			//pr($this->request->data); exit;
			if ($this->Notice->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Notice has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else { 
				  $this->Session->setFlash('Sorry unable to edit Notice , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		} 
			
			$this->request->data = $Notice;
			
            $openingDate = date(('d-m-Y'),strtotime($this->request->data['Notice']['opening_date']));
            $closingDate = date(('d-m-Y'),strtotime($this->request->data['Notice']['closing_date']));			
			$this->request->data['Notice']['opening_date']= $openingDate;
			$this->request->data['Notice']['closing_date']= $closingDate;
            $this->request->data['Notice']['year_of_recruitment'] =array('year'=>$this->request->data['Notice']['year_of_recruitment']);				
		    $notice = $this->request->data['Notice']['id'];
			$this->set(compact('notice','openingDate','closingDate'));
		   
    }
	
	public function delete()
    {
     
    }
	
	public function view()
    {
     $currentDate = date('Y-m-d');	
	 $this->set('notices',$this->Notice->find('all',array(
	                                                       'conditions'=>array('Notice.closing_date >=' => $currentDate) 
														  )));
    }
	
	
	public function dwnld_adv_at_view($id=null)
	{
		if(!$this->Notice->exists($id))
		{
			throw new NotFoundException(__('Invalid Notice'));
		}
		
		$currentDate = date('Y-m-d');
		$advertisementPDF=$this->Notice->find('first',array(
	                                                       'conditions'=>array(
																				'Notice.id'=>$id,
																				'Notice.closing_date >=' => $currentDate
																				),
															'fields'=>array('advt_pdf')					
														  )
												);
												
		if(array_key_exists('Notice', $advertisementPDF))
		{
			$file=$advertisementPDF['Notice']['advt_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/advertisements/'.$file);
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
	}

	public function download_advertisement($id=null)
	{
		if(!$this->request->is('post'))
		{
			//throw new MethodNotAllowedException();
		}
		if(!$this->Notice->exists($id))
		{
			throw new NotFoundException(__('Invalid Notice'));
		}
		
		$userOrgn = $this->Session->read('Auth.User.organization_id');
		$conditions=array(
							'created_by_orgn_id'=>$userOrgn,
							'id'=>$id	
						);
						
		$advertisementPDF=$this->Notice->find('first',array('conditions'=>$conditions));
		if(array_key_exists('Notice', $advertisementPDF))
		{
			$file=$advertisementPDF['Notice']['advt_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/advertisements/'.$file);
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}				
		
		
	}
	


 }
