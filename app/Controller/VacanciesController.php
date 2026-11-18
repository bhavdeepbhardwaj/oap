<?php
App::uses('AppController','Controller');

class VacanciesController extends AppController
 {
    public function beforeFilter()    {
                                        parent::beforeFilter();
									    
									   }

    public $uses = array('Vacancy','InformationUser');
	public function index()
    {
	 $userOrgn = $this->Session->read('Auth.User.organization_id');	
	 $this->Vacancy->recursive=0;	
	 /*$vacancies = $this->Vacancy->find('all',array(
	                                               'conditions'=>array('Vacancy.created_by_orgn_id'=>$userOrgn)
												   ));*/
     $this->set(compact('vacancies'));
	 
		//Default Conditions
		$conditions=array();
		$conditions['Vacancy.created_by_orgn_id']=$userOrgn;
		$order=array('Vacancy.id' => 'desc');
		$recursive=0;
		$limit=2;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $vacancies = $this->Paginator->paginate('Vacancy',array(),array('Vacancy.id'));
	 
	 		
		
      $this->set('vacancies',$vacancies);	 
    }

    public function add()
    {
	 $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');		
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');	
     
	 if($this->request->is('post'))
	   { 
		 $data= array('Notice'=>array(
		                              'id'=> $this->request->data['Vacancy']['notice_id'],
					                  'vacancy_creation_status' =>'Created'
					                 )
					 );		   
	  				 
		 $this->request->data['Vacancy']['organization_id'] = $userOrgn;  
		 $this->request->data['Vacancy']['created_by_user_id'] = $this->Session->read('Auth.User.id');  
		 $this->request->data['Vacancy']['created_by_orgn_id'] = $userOrgn;  
		 $this->Vacancy->validator()->remove('reason_not_to_approve');
		 $this->Vacancy->create();
	       if($this->Vacancy->save($this->request->data))
	       {
			 if($this->Vacancy->Notice->save($data))
			 {				 
             echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Vacancy has been Successfully Drafted....','default',array('class'=>'alert alert-success alert-dismissable'));	 
			 return $this->redirect(array('action' => 'index'));			 
		     }
			 else
			 {
			  $this->Vacancy->delete(
			                         $this->Vacancy->getLastInsertId()  
								    ); 
              echo $this->Session->setFlash('Sorry unable to draft Vacancy ,Please try again later....','default',array('class'=>'alert alert-danger'));									
			  return $this->redirect(array('action' => 'index'));
			 }	 
		   }
		  else
		   {
		    echo $this->Session->setFlash('Sorry unable to draft Vacancy ,Please try again later....','default',array('class'=>'alert alert-danger'));
	       }	  
	   }
        
		   //Calling Drop Down Lists
		$notices     = $this->Vacancy->Notice->find('list',array('fields'=>array('id','selectOption'),
		                                                         'conditions'=>array(
																                     'Notice.created_by_orgn_id'     =>$userOrgn,
																					 'Notice.vacancy_creation_status'=>'Not Created'
																                    )
																 ));
		$posts       = $this->Vacancy->Post->find('list',array('fields'=>array('id','post_name')));
		$departments = $this->Vacancy->Department->find('list',array('fields'=>array('id','department_name')));
		$payScales   = $this->Vacancy->PayScale->find('list',array('fields'=>array('id','pay_scale')));
		$organizations = $this->Vacancy->Organization->find('list',array(
		                                                                 'conditions'=>array(
																		                     'organization_name !='=>'Others'
																		                    ),
																		 'fields'=>array('id','organization_name')
																		 )
															);
        $educationQualifications = $this->Vacancy->EducationQualification->find('list',array('fields'=>array('id','education_qualification')));
		$essentials   = $this->Vacancy->Essential->find('list',array('fields'=>array('id','essential')));
		$desirables   = $this->Vacancy->Desirable->find('list',array('fields'=>array('id','desirable')));
		$this->set(compact('organizations','notices','posts','departments','payScales','educationQualifications','essentials','desirables','userOrgnType','userOrgn'));		
    }
	
	public function edit($id=null)
    {
     if (!$this->Vacancy->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Vacancy'));
		  }
	    $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');		
	    $userOrgn     = $this->Session->read('Auth.User.organization_id');		  
		$vacancyOrgn  = $this->Vacancy->find('count',array(
		                                                   'conditions'=>array(
														                       'Vacancy.id'                =>$id,
														                       'Vacancy.created_by_orgn_id'=>$userOrgn
																			  )
														  )
		                                    );
		if(!$vacancyOrgn)
			{
			 throw new NotFoundException('You Cannot Edit this Vacancy');	
			}
		
		if ($this->request->is(array('post','put'))) 
		  { 
	        $this->request->data['Vacancy']['updated_by_user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Vacancy']['modified_on'] = $this->Vacancy->getDataSource()->expression('NOW()');			
			
			$this->Vacancy->validator()->remove('reason_not_to_approve');
			
			if ($this->Vacancy->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Vacancy has been Successfully edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to edit Vacancy , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  } 	
			$options = array('conditions' => array('Vacancy.' . $this->Vacancy->primaryKey => $id));
			$this->request->data = $this->Vacancy->find('first', $options);
				
			if($this->request->data['Vacancy']['active_upto']!=Null)
			$this->request->data['Vacancy']['active_upto']= date(('d-m-Y'),strtotime($this->request->data['Vacancy']['active_upto']));	
	
		            
		
       		//Calling Drop Down Lists		 
		
		$noticeVacancyId = $this->request->data['Vacancy']['notice_id'];
		$noticeIds       = $this->Vacancy->Notice->find('list',array('fields'=>array('id','advt_name'),
		                                                         'conditions'=>array(
																                     'Notice.id'=>$noticeVacancyId
																                    )
																 ));
																 
		$noticesNotCreated = $this->Vacancy->Notice->find('list',array('fields'=>array('id','advt_name'),
		                                                               'conditions'=>array(
																                           'Notice.created_by_orgn_id'     =>$userOrgn,
																			        	   'Notice.vacancy_creation_status'=>'Not Created',
																                           )
																 ));
		
		$notices     = array_replace($noticesNotCreated,$noticeIds);		
		$posts       = $this->Vacancy->Post->find('list',array('fields'=>array('id','post_name')));
		$departments = $this->Vacancy->Department->find('list',array('fields'=>array('id','department_name')));
		$payScales   = $this->Vacancy->PayScale->find('list',array('fields'=>array('id','pay_scale')));
		
        $organizations = $this->Vacancy->Organization->find('list',array(
		                                                                 'conditions'=>array(
																		                     'organization_name !='=>'Others'
																		                    ),
		                                                                 'fields'=>array('id','organization_name')));
        $educationQualifications = $this->Vacancy->EducationQualification->find('list',array('fields'=>array('id','education_qualification')));
		$essentials   = $this->Vacancy->Essential->find('list',array('fields'=>array('id','essential')));
		$desirables   = $this->Vacancy->Desirable->find('list',array('fields'=>array('id','desirable')));
		$this->set(compact('organizations','notices','posts','departments','payScales','educationQualifications','essentials','desirables','userOrgnType','userOrgn'));		
		
    }
	
	public function delete()
    {
     
    }
	
	public function waiting_for_approval()
	{
		$userOrgn = $this->Session->read('Auth.User.organization_id');
        $userRole = $this->Session->read();		
		/*$this->set('vacancies',$this->Vacancy->find('all',array(
		                                                        'conditions' => array('status'=>'Waiting Approval','Vacancy.created_by_orgn_id'=>$userOrgn),
																'recursive'  =>0
																)));*/
																
				//Default Conditions
		$conditions=array('status'=>'Waiting Approval','Vacancy.created_by_orgn_id'=>$userOrgn);
		$order=array('Vacancy.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit,
											'recursive'  =>0
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $vacancies = $this->Paginator->paginate('Vacancy',array(),array('Vacancy.id'));
	 
	 		
		
      $this->set('vacancies',$vacancies);														
	}
	
    public function view($id=null)
	{
		
		if(!$this->Vacancy->exists($id))
		{
			throw new NotFoundException(__('Vacancy not found.'));
		}	
		
		$vacancy = $this->Vacancy->find('first',array('conditions'=>array('Vacancy.id'=> $id)));	 
		 
		 $userOrgn = $this->Session->read('Auth.User.organization_id'); 
		 $userRole = $this->Session->read('Auth.User.Group.name');
		
		 $this->set(compact('vacancy','userRole'));
        if($vacancy['Vacancy']['created_by_orgn_id']!=$userOrgn)
		  {
			throw new NotFoundException('This Vacancy Does Not Belong To Your Organization');	 
		  }
		 
		 if($vacancy['Vacancy']['status']!='Waiting Approval')
		  {
			throw new NotFoundException('This Vacancy is Not Waiting for Approval');	 
		  }
		if ($this->request->is(array('post','put'))) 
		  {
			if ($this->Vacancy->save($this->request->data,true,array('status','reason_not_to_approve'))) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Vacancy Successfully Approved....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('controller'=>'dashboard','action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to approve vacancy , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  }
        else 
		   {
			$options = array('conditions' => array('Vacancy.' . $this->Vacancy->primaryKey => $id));
			$this->request->data = $this->Vacancy->find('first', $options);
		   }		  
   					
	}

    public function drafted_vacancies()
	{
		$userOrgn = $this->Session->read('Auth.User.organization_id'); 
		$this->set('draftedVacancies',$this->Vacancy->find('all',array('conditions'=>array('status'=>'drafted','Vacancy.created_by_orgn_id'=>$userOrgn))));
	}
	
    public function approved_vacancy()
	{   
	    $userOrgn = $this->Session->read('Auth.User.organization_id'); 
		//$this->set('vacanciesApproved',$this->Vacancy->find('all',array('conditions'=>array('status'=>'Approved','Vacancy.created_by_orgn_id'=>$userOrgn))));
				//Default Conditions
		$conditions=array('status'=>'Approved','Vacancy.created_by_orgn_id'=>$userOrgn);
		$order=array('Vacancy.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $vacanciesApproved = $this->Paginator->paginate('Vacancy',array(),array('Vacancy.id'));
	 
	 		
		
      $this->set('vacanciesApproved',$vacanciesApproved);
	}		

	public function approval_cancel()
	{
		$userOrgn = $this->Session->read('Auth.User.organization_id');
        $userRole = $this->Session->read('Auth.User.Group.name');
       // $vacanciesApproved = $this->Vacancy->find('all',array('conditions'=>array('status'=>'Approval Cancel','Vacancy.created_by_orgn_id'=>$userOrgn)));		
		//$this->set(compact('vacanciesApproved','userRole'));
		
		//Default Conditions
		$conditions=array('status'=>'Approval Cancel','Vacancy.created_by_orgn_id'=>$userOrgn);
		$order=array('Vacancy.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $vacanciesApproved = $this->Paginator->paginate('Vacancy',array(),array('Vacancy.id'));
	 
	 		
		
      $this->set(compact('vacanciesApproved','userRole'));
		
	}	

	    //For Forwarding To Approver
    public function view_drafted_vacancy($id=null)
	{
	  if(!$this->Vacancy->exists($id))
	  {
		throw new NotFoundException(__('Invalid Vacancy'));  
	  }
     
	    
	 $userOrgn = $this->Session->read('Auth.User.organization_id'); 
	 
	 //Fetching The Data	  
	 $vacancy = $this->Vacancy->find('first',array('conditions'=>array('Vacancy.id'=> $id)));	 
	 $this->set(compact('vacancy'));
      
	  if($vacancy['Vacancy']['created_by_orgn_id']!=$userOrgn)
	  {
	    throw new NotFoundException('Vacancy Does Not Belong to Your Organization');	 
	  }  
  
     if($vacancy['Vacancy']['status']!='Drafted')
	  {
	    throw new NotFoundException('Not Drafted Vacancy');	 
	  }
      
	 if($this->request->is(array('post','put')))
	   { 
		   $this->request->data['Vacancy']['status'] = 'Waiting Approval';
		   
		   if ($this->Vacancy->save($this->request->data,false,array('status'))) 
			    {	
				 $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Vacancy has been Successfully Forwarded for Approval....','default',array('class'=>'alert alert-success alert-dismissable'));	
				 return $this->redirect(array('controller'=>'dashboard','action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to Forward Vacancy for Approval , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		} 
		else 
		   {
			$options = array('conditions' => array('Vacancy.' . $this->Vacancy->primaryKey => $id));
			$this->request->data = $this->Vacancy->find('first', $options);
            $this->request->data['Vacancy']['active_upto']= date(('d-m-Y'),strtotime($this->request->data['Vacancy']['active_upto']));						
		   }
	}		   
	
	
    
	    //For ReApplying for Approval
	public function reapplying_for_approval($id=null)
     {
      if (!$this->Vacancy->exists($id)) 
	      {
			throw new NotFoundException(__('Invalid Vacancy'));
		  }
         
		$userOrgn = $this->Session->read('Auth.User.organization_id');        
        $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type'); 
		
			 $vacancyInfo = $this->Vacancy->find('count',array(
			                                                   'conditions'=>array(
															                       'Vacancy.id'=>$id,
																				   'Vacancy.status'=>'Approval Cancel',
																				   'Vacancy.created_by_orgn_id'=>$userOrgn
																				   )
															   
															  )
			                                    ); 
			 if(!$vacancyInfo)
			  {
				throw new NotFoundException('This Vacancy Does Not Belong to Your Organization or Vacancy Approval is not cancelled');  
			  } 
			 		  
		if ($this->request->is(array('post','put'))) 
		  { 
			 $this->request->data['Vacancy']['status']= 'Waiting Approval';
             $this->request->data['Vacancy']['reason_not_to_approve'] = '';			 
		
			if ($this->Vacancy->save($this->request->data)) 
			    {	
				 $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Vacancy has been Successfully Re-applied for Approval....','default',array('class'=>'alert alert-success alert-dismissable'));	
				 return $this->redirect(array('controller'=>'dashboard','action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to Reapply Vacancy for Approval , Please try again later....','default',array('class'=>'alert alert-danger'));
				  pr($this->Vacancy->invalidFields());
				 }
		  } 
		   $options = array('conditions' => array('Vacancy.' . $this->Vacancy->primaryKey => $id));
			$this->request->data = $this->Vacancy->find('first', $options);
			if($this->request->data['Vacancy']['active_upto']!=Null)
	        $this->request->data['Vacancy']['active_upto']= date(('d-m-Y'),strtotime($this->request->data['Vacancy']['active_upto']));        	
			
			 
			  
		            
					//Calling Drop Down Lists
				 
		$notices = $this->request->data['Notice']['advt_name'];		
		// $notices     = $this->Vacancy->Notice->find('list',array('fields'=>array('id','advt_name'),
		                                                         // 'conditions'=>array('Notice.created_by_orgn_id'=>$userOrgn,
																                    // 'Vacancy.id'               =>$id
																					// )
																 // ));
		$posts       = $this->Vacancy->Post->find('list',array('fields'=>array('id','post_name')));
		$departments = $this->Vacancy->Department->find('list',array('fields'=>array('id','department_name')));
		$payScales   = $this->Vacancy->PayScale->find('list',array('fields'=>array('id','pay_scale')));
		$educationQualifications  = $this->Vacancy->EducationQualification->find('list',array('fields'=>array('id','education_qualification')));
        $organizations = $this->Vacancy->Organization->find('list',array('fields'=>array('id','organization_name')));
		$essentials = $this->Vacancy->Essential->find('list',array('fields'=>array('id','essential')));
		$desirables = $this->Vacancy->Desirable->find('list',array('fields'=>array('id','desirable')));
		$this->set(compact('notices','posts','departments','payScales','educationQualifications','organizations','essentials','desirables','userOrgnType','userOrgn'));
		
     }
	
	   //Changing Applicable Organization
	   
    /*public function view_applicable_to()
	{
	  $this->set('viewApplicables',$this->Vacancy->find('all',array('conditions' => array('status' => 'Approved'))));	
    }*/
	      //Changing Method of Recruitment
	public function approved_vacancy_recruitment_method()
	{
	  $userOrgn = $this->Session->read('Auth.User.organization_id'); 	
	  $this->set('viewApplicables',$this->Vacancy->find('all',array('conditions' => array('status' => 'Approved','Vacancy.organization_id'=>$userOrgn))));	
    }
	
	public function change_recruitment_method($id=null)
	{
	  	if(!$this->Vacancy->exists($id))
		{
			throw new NotFoundException(__('Vacancy not found.'));
		}	
		//$this->Vacancy->recursive=-1;
		/*$this->Vacancy->Behaviors->load('Containable');
		pr($this->Vacancy->find(
														'first',
														array(
																'conditions'=>array(
																					'Vacancy.id'=>$id
																					),
																'fields'=>array('Vacancy.id'),					
																'contain'=>array(
																					
																					'Organization'=>array('id'),
																					'Post'
																				)					
																)
													));
		*/
		
		$userOrgn = $this->Session->read('Auth.User.organization_id'); 
		
		$vacancy = $this->Vacancy->find(
										 'first',
												 array(
														'conditions'=>array(
																			'Vacancy.id'=>$id,
																					//'Vacancy.status'=>'Approved'
																					)
																)
													);											
		
		if($vacancy['Vacancy']['organization_id']!=$userOrgn)
		{
		  throw new NotFoundException('Cannot Change Method of Recruitment For Vacancy That Does Not Belong To Your Organization');	
		}
		
		if($vacancy['Vacancy']['status']!='Approved')
		{
		  throw new NotFoundException('Cannot Change Method of Recruitment before approval of vacancy ');	
		}
		
		
		$this->set('vacancy',$vacancy);
		if ($this->request->is(array('post','put'))) 
		  {
			if ($this->Vacancy->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Method of Recruitment has been Changed Successfully....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('controller'=>'dashboard','action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to change Applicable To , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  }
        else 
		   {
			$options = array('conditions' => array('Vacancy.' . $this->Vacancy->primaryKey => $id));
			$this->request->data = $this->Vacancy->find('first', $options);
		   }
    }
	
	
	                  //For Changing Applicable To
	/*public function change_applicable_to($id=null)
	{
	  	if(!$this->Vacancy->exists($id))
		{
			throw new NotFoundException(__('Vacancy not found.'));
		}	
		//$this->Vacancy->recursive=-1;
		/*$this->Vacancy->Behaviors->load('Containable');
		pr($this->Vacancy->find(
														'first',
														array(
																'conditions'=>array(
																					'Vacancy.id'=>$id
																					),
																'fields'=>array('Vacancy.id'),					
																'contain'=>array(
																					
																					'Organization'=>array('id'),
																					'Post'
																				)					
																)
													));
		*/
		/*$this->set('vacancy',$this->Vacancy->find(
												  'first',
														array(
																'conditions'=>array(
																					'Vacancy.id'=>$id
																					)
																)
													)
					);
		if ($this->request->is(array('post','put'))) 
		  {
			if ($this->Vacancy->save($this->request->data)) 
			    {
				$this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Applicable To has been Changed Successfully....','default',array('class'=>'alert alert-success alert-dismissable'));	
				return $this->redirect(array('controller'=>'dashboard','action' => 'index'));
			    } 
			else {
				  $this->Session->setFlash('Sorry unable to change Applicable To , Please try again later....','default',array('class'=>'alert alert-danger'));
			     }
		  }
        else 
		   {
			$options = array('conditions' => array('Vacancy.' . $this->Vacancy->primaryKey => $id));
			$this->request->data = $this->Vacancy->find('first', $options);
		   }
    }*/
	
	    //For Forwarding To Approver
    public function view_approved_vacancy($id=null)
	{
	  if(!$this->Vacancy->exists($id))
	  {
		throw new NotFoundException(__('Invalid Vacancy'));  
	  }
     
	    
	 $userOrgn = $this->Session->read('Auth.User.organization_id'); 
	 
	 //Fetching The Data	  
	 $vacancy = $this->Vacancy->find('first',array('conditions'=>array('Vacancy.id'=> $id)));	 
	 $this->set(compact('vacancy'));
      
	  if($vacancy['Vacancy']['created_by_orgn_id']!=$userOrgn)
	  {
	    throw new NotFoundException('Vacancy Does Not Belong to Your Organization');	 
	  }  
  
     if($vacancy['Vacancy']['status']!='Approved')
	  {
	    throw new NotFoundException('Not Drafted Vacancy');	 
	  }
      	
	}
	
	
	
	public function view_vacancy($id=null)
	{
	  if(!$this->Vacancy->exists($id))
	  {
		throw new NotFoundException(__('Invalid Vacancy'));  
	  }
	  $currentDate = date('Y-m-d');
	 //Fetching The Data	
     $this->layout = 'register';	 
	 $this->set('vacancy',$this->Vacancy->find('first',array('conditions'=>array('Vacancy.id'=> $id,
	                                                                             'Vacancy.status'=>'Approved',
																				 'Notice.opening_date <=' => $currentDate,'Notice.closing_date >=' => $currentDate
																				))));	 
     
	}
	
	
	public function current_openings()
	{
	 $userInfos = $this->InformationUser->find('first',array('conditions'=>array(
	                                                                             'user_id'=>$this->Session->read('Auth.User.id')
																			    ),
																				'fields'=>array('id','current_status')				 
	                                                              )
												    );
	 
     $currentDate = date('Y-m-d');	 
	// $approvedVacancies = $this->Vacancy->find('all',array('conditions'=>array('status'=>'Approved','Notice.opening_date <=' => $currentDate,'Notice.closing_date >=' => $currentDate)));	
	 	
	 		//Default Conditions
		$conditions=array('status'=>'Approved','Notice.opening_date <=' => $currentDate,'Notice.closing_date >=' => $currentDate);
		$order=array('Vacancy.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $approvedVacancies = $this->Paginator->paginate('Vacancy',array(),array('Vacancy.id'));
	 
	 		
		
      
	 
	 
	 
	 
	 $alreadyApplied = $this->Vacancy->UserAppliedVacancy->find('list',array(
	                                                                          'conditions'=>array('UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id'),
																			                      
																			                     ),
																			  'fields'=>array('UserAppliedVacancy.vacancy_id')
																								 
																			  )
															    );
	 $this->set(compact('approvedVacancies','userInfos','alreadyApplied'));
	}
	
		
		
 }


