<?php
App::uses('AppController','Controller');
class UserAppliedVacanciesController extends AppController
{
 public $uses = array('Organization','Post','UserAppliedVacancy');
  public function beforeFilter()
     {
        parent::beforeFilter();
		
     }	 
  	 
 public function apply_for_vacancy()
  { 
   
	                  //For Log Information User
	$this->UserAppliedVacancy->User->InformationUser->Behaviors->load('Containable');
    $this->UserAppliedVacancy->User->InformationUser->virtualFields['organization_name']=$this->UserAppliedVacancy->User->virtualFields['organization_name'];
	$logUserInfo = $this->UserAppliedVacancy->User->InformationUser->find('first',array('conditions'=>array(
	                                                                                                       'user_id'=>$this->Session->read('Auth.User.id')
																										   ),
																						'fields'=>array(
																						                'user_id',
																										'uf_f_name',
																										'uf_m_name',
																										'uf_l_name',
																										'um_f_name',
																										'um_m_name',
																										'um_l_name',
																										'gender',
																										'community',
																										'religion',
																										'd_o_b',
																										'birth_state',
																										'p_o_b',
																										'marital_status',
																										'hobbies',
																										'o_address',
																										'o_state_name',
																										'o_city_name',
																										'o_pincode',
																										'o_std_code',
																										'o_landline_num',
																										'r_address',
																										'r_state_name',
																										'r_city_name',
																										'r_pincode',
																										'r_mobile_number',
																										'r_std_code',
																										'r_landline_num',
																										'physically_challenged',
																										'type_of_disability',
																										'working_under',
				
																										'other_orgn_name',
																										'd_o_i_appoint',
																										'present_emp_type',
																										'dt_appoint_date',
																										'period_of_appoint_dt',
																										'name_o_p_orgn_text',
																										'other_parent_organization',
																										'nature_of_present_emp',
																										'current_organization_text',
																										'other_current_organization',
																										'd_o_r',
																										'present_post',
																										'present_scale_pay',
																										'present_grade_pay',
																										'strt_dt_of_pay',
																										'cont_reg_appoint_date',
																										'belong_to_ci',
																										'statement',
																										'additional_info',
																										'vigilance_pdf',
																										'caste_pdf',
																										'organization_name'
																										),
                                                                            																										
																						'contain'=>array(
																						                 'User'=>array(
																										               'fields'=>array(
																													                  'u_name_title','f_name','m_name','l_name','profilepic','profilesignature','mobile_number'
																													                  )
								  
																													  ),
																										 'Nationality' => array(
																										                        'fields'=>array('nationality_name')
																										                       )		  
																										)				   
																						)
																		 ); 

	//pr($logUserInfo); exit;
	unset($logUserInfo['Nationality']['id']);
	unset($logUserInfo['User']['id']);
    $logUserInfo['User'] = array_merge($logUserInfo['User'],$logUserInfo['Nationality']);	
	//pr($logUserInfo['User']); exit;
	
	
	$logUserInfo['InformationUser'] = array_merge($logUserInfo['InformationUser'],$logUserInfo['User']);
	
	unset($logUserInfo['User'],$logUserInfo['Nationality']);
	//pr($logUserInfo); exit;
	                 
					  //For LogServiceAndBatchInfo
	$this->UserAppliedVacancy->User->ServiceAndBatchInfo->Behaviors->load('Containable');
	$logServiceAndBatchInfos = $this->UserAppliedVacancy->User->ServiceAndBatchInfo->find('first',array('conditions'=>array(
	                                                                                                                        'user_id'=>$this->Session->read('Auth.User.id')
	                                                                                                                        ),
																										'fields'=>array(
																										                'ServiceAndBatchInfo.user_id','service','batch','cadre','belong_to_service','doj_grp_a','srvc_rndr_grp_a','exp_prt_ship','write_up1_data','write_up2_data','write_up_1','write_up_2'
																										                ),					
																										'contain'=>false					
																									    )
																						  );
	//pr($logServiceAndBatchInfos); exit;	
	
	                  //For LogUserEducationalDetails
	$this->UserAppliedVacancy->User->UserQualification->Behaviors->load('Containable');
	$logUserEducationDetail = $this->UserAppliedVacancy->User->UserQualification->find('all',array('conditions'=>array(
	                                                                                                                    'user_id'=>$this->Session->read('Auth.User.id')
	                                                                                                                    ),
																									'fields'=>array(
																									                 'UserQualification.user_id','education_qualification_name','university','y_o_p','class_type','perc_obtained','special_subject','edu_pdf'
																													), 					
																									 'contain'=>false					
																									    )
																					  );	
   
	$logUserEducationDetails = Set::classicExtract($logUserEducationDetail, '{n}.UserQualification');
	//pr($logUserEducationDetails); exit;           
					//For LogUserEmploymentDetails
	$this->UserAppliedVacancy->User->UserEmploymentDetail->Behaviors->load('Containable');
	$logUserEmploymentDetail = $this->UserAppliedVacancy->User->UserEmploymentDetail->find('all',array('conditions'=>array(
	                                                                                                                        'user_id'=>$this->Session->read('Auth.User.id')
	                                                                                                                        ),
																										'fields'=>array(
																										                'UserEmploymentDetail.user_id','organization_name','post_held','scale_of_pay','from_date','to_date','nature_of_duties','exp_pdf'
																													   ),					
																										'contain'=>false					
																									    )
																						  );
	$logUserEmploymentDetails = Set::classicExtract($logUserEmploymentDetail, '{n}.UserEmploymentDetail');																					  
	//pr($logUserEmploymentDetails); exit;
	
	//For Finding Vacancy is for which post
	$this->UserAppliedVacancy->Vacancy->Behaviors->load('Containable');
	$vacancyForPost = $this->UserAppliedVacancy->Vacancy->find('first',array(
	                                                                         'conditions'=>array(
																			                      'Vacancy.id' => $this->request->data['UserAppliedVacancy']['vacancy_id']
																			                     ),
																			  'fields'=>array('id'),					 
																			  'contain' =>array(
																			                    'Post'=>array('post_name')
																							   )					 
																			)
															   );
	
	if($vacancyForPost['Post']['post_name'] =='Chairman' || $vacancyForPost['Post']['post_name'] == 'Dy. Chairman')
	   {
	    $data = array
		         (
	              'LogInformationUser'=> $logUserInfo['InformationUser'],
				  'LogServiceAndBatchInfo' => $logServiceAndBatchInfos['ServiceAndBatchInfo'],
				  'LogUserQualification' => $logUserEducationDetails,
				  'LogUserEmploymentDetail' => $logUserEmploymentDetails
				  ); 
	   }
	 else
	  {		 
		$data = array(
					  'LogInformationUser'=> $logUserInfo['InformationUser'],
					  'LogUserQualification' => $logUserEducationDetails,
					  'LogUserEmploymentDetail' => $logUserEmploymentDetails
					  ); 
      }
	  
	$this->request->data=array_merge($data,$this->request->data);
	if($this->request->is('post'))
	{ 
	  $this->UserAppliedVacancy->create();
        if($this->UserAppliedVacancy->saveAll($this->request->data, array('deep' => true)))
		{
		 echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Successfully Applied for the job....','default',array('class'=>'alert alert-success alert-dismissable'));	
		 return $this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}
        else
		{
		  echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,Unable to apply for the job....','default',array('class'=>'alert alert-danger alert-dismissable'));
          return $this->redirect(array('controller'=>'dashboard','action'=>'index'));		  
		}			
	}		
  }
  
    
    
    public function new_applications()
	{
     $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');
	 $organizations = $this->Organization->find('list',array('fields'=>'organization_name'));
	 if($userOrgnType=='MOS')
	  {   
       $posts = $this->Post->find('list',array('fields'=>'post_name'));
	  }
     else
	  {
	   $this->UserAppliedVacancy->Vacancy->Behaviors->load('Containable');	  
	   $vacancyPosts =$this->UserAppliedVacancy->Vacancy->find('all',array('conditions'=>array(
	                                                                                          'Vacancy.created_by_orgn_id'=> $userOrgn
	                                                                                          ),
																	  'fields'=>'post_id',
                                                                      'contain'=>false																	  
														             )
												         );	  
	    
		$postsId = Hash::extract($vacancyPosts,'{n}.Vacancy.post_id');
		
	   $posts = $this->Post->find('list',array('conditions'=>array('id'=>$postsId),
	                                           'fields'=>'post_name'
											   )
								 );	 							 
	  }		 
	 $filteredOrganization = null;
     $filteredPost = null;
      
     $conditions = array();
     
     if(isset($this->request->query['organization_id']) && $this->Organization->exists($this->request->query['organization_id'])) 	 
	 {
	   $conditions['Vacancy.organization_id'] = $this->request->query['organization_id']; 	 
	 }
	 if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditions['Vacancy.post_id'] = $this->request->query['post_id']; 	 
	 }
	 $conditions['UserAppliedVacancy.status'] = 'Submitted';
	 
	 $conditions['Vacancy.created_by_orgn_id'] = $userOrgn;
	 // if($userOrgnType=='Non-MOS')
	 // {
	  // $conditions['Vacancy.created_by_orgn_id'] = $userOrgn; 	 
	 // }
	 // else
	 // {
	  // $conditions['Vacancy.created_by_orgn_id'] = $userOrgn;	 
	 // } 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $applicants = $this->UserAppliedVacancy->find('all',array('conditions'=>$conditions,
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('organization_id'),
																										   'Organization'=>array(
																										                         'fields'=>array('id','organization_name','organization_type')
																																),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('id','post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email')
																						               ),																										  
																		                  'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
																						  
																						 )					
	                                                                    )
															);
	 
	 
	 
     $this->set(compact('organizations','posts','applicants','userOrgnType'));

     
	 
	 
	 
	}
    public function submitted_application_dp($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }		  
	 
     $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id'),
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	
	if($userOrgnType=='Non-MOS')
	{
		if($applyingUser['Vacancy']['organization_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	}	
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilepic']!=NULL || $applyingUser['LogInformationUser']['profilepic']!='')
			$file=$applyingUser['LogInformationUser']['profilepic'];
		else
			$file='default.png';
		$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
		return $this->response;
	}
	else
	{
		throw new LogicException();
	}
}
    
    public function submitted_application($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }		  
	 
     $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  'Notice'=>array('fields'=>array('advt_number')),
																						              'Post'=>array('fields'=>array('post_name')),
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              'Department'=>array('fields'=>array('department_name'))
																								  ),
																					 'User'=>array (
																						              'fields'=>array('email','id')
																						           ),			  
																					 'LogInformationUser',
                                                                                     'LogServiceAndBatchInfo',
                                                                                     'LogUserQualification',
                                                                                     'LogUserEmploymentDetail'																					 
																					 )				   
																	)
												    );
	
	// if($userOrgnType=='Non-MOS')
	// {
		if($applyingUser['Vacancy']['created_by_orgn_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	//}
	$vacancyId = $applyingUser['UserAppliedVacancy']['vacancy_id'];
	$userId  =  $applyingUser['User']['id'];
	        //For Vacancies Essentials
	$this->UserAppliedVacancy->User->VacanciesEssential->unbindModel(array('hasAndBelongsToMany' => array('User')));
	  $this->UserAppliedVacancy->User->VacanciesEssential->bindModel(
        array('hasMany' => array(
                'UsersVacanciesEssential' => array(
                    'className' => 'UsersVacanciesEssential'
                )
            )
        )
    );
	
	 $userEss = $this->UserAppliedVacancy->User->VacanciesEssential->find('all',array(
	                                                                                    'conditions'=>array(
																						                   'vacancy_id'=>$vacancyId
																						                   ),
																									   
																					 )
																		  );
		   		//For Vacancy Desirables														  
	$this->UserAppliedVacancy->User->VacanciesDesirable->unbindModel(array('hasAndBelongsToMany' => array('User')));
	  $this->UserAppliedVacancy->User->VacanciesDesirable->bindModel(
        array('hasMany' => array(
                'UsersVacanciesDesirable' => array(
                    'className' => 'UsersVacanciesDesirable'
                )
            )
        )
    );
	 $userDss = $this->UserAppliedVacancy->User->VacanciesDesirable->find('all',array(
	                                                                                    'conditions'=>array(
																						                   'vacancy_id'=>$vacancyId
																						                   ),
																									   
																					 )
																		  );
													
													
													
	 /*$this->UserAppliedVacancy->Vacancy->Behaviors->load('Containable');														
	 $vacancy = $this->UserAppliedVacancy->Vacancy->find('first',array('conditions'=>array(
	                                                                                       'Vacancy.id'=>$applyingUser['UserAppliedVacancy']['vacancy_id']
																						  ),
																		'fields'=>array('id'),				  
																		'contain'=>array(
																		                 'Notice'=>array('fields'=>array('advt_number')),
																						 'Post'=>array('fields'=>array('post_name')),
																						 'Organization'=>array('fields'=>array('organization_name')),
																						 'Department'=>array('fields'=>array('department_name'))
																						)				  
	                                                                     )
												    );*/	
     /*$this->UserAppliedVacancy->recursive=2;
	 $userInfo = $this->UserAppliedVacancy->find('first',array('conditions'=>array('UserAppliedVacancy.id'=>$id)
	                                                                )
														);*/	
	$this->set(compact('applyingUser','userEss','userDss','userId','vacancyId'));																			 
	}
   
    public function update_status($id=null)
    {
	   	if(!$this->UserAppliedVacancy->exists($id))
	     {
		 throw new NotFoundException('Invalid Vacancy');  
	     }
	  	$userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	    $userOrgn     = $this->Session->read('Auth.User.organization_id');

		
	  if($this->request->is(array('post','put')))
	  { $cs=$this->request->data['UserAppliedVacancy']['currentStatus'];  
		if($this->UserAppliedVacancy->save($this->request->data))
		  { 
			echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Status has been Successfully updated....','default',array('class'=>'alert alert-success alert-dismissable'));
		      if($cs=='Submitted')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'new_applications'));  
			   }
              elseif($cs=='Accepted')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'accepted_applications'));    
			   }
              elseif($cs=='Rejected')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'rejected_applications'));    
			   }
               elseif($cs=='Call for Interview')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'call_for_interview'));    
			   }
               elseif($cs=='Under Consideration')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'under_consideration'));    
			   }
               else
			   {
				return $this->redirect(array('controller'=>'dashboard','action'=>'index'));   
			   }				    
		  }		 
		else
		{
		 echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Sorry,Unable to update Status....','default',array('class'=>'alert alert-danger alert-dismissable'));
		      if($cs=='Submitted')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'new_applications'));  
			   }
              elseif($cs=='Accepted')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'accepted_applications'));    
			   }
              elseif($cs=='Rejected')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'rejected_applications'));    
			   }
               elseif($cs=='Call for Interview')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'call_for_interview'));    
			   }
               elseif($cs=='Under Consideration')
			   {
				return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'under_consideration'));    
			   }
               else
			   {
				return $this->redirect(array('controller'=>'dashboard','action'=>'index'));   
			   }  
		}
	  }	
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  $userAppliedVacancies=$this->UserAppliedVacancy->find('first',array('conditions'=>array('UserAppliedVacancy.id'=>$id),
																			'contain'=>array(
																								'User'=>array(
																												'fields'=>array(
																																'email',
																																'userName'
																											                   ),
																											 ),
																								'Vacancy'=>array(
																								                 'fields'=>array('organization_id','created_by_orgn_id')
																								                ),			 
																								'LogInformationUser'=>array(
																															'fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r'),
																															)
																											
																                  			     
																							)
	                                                                      )
															);
		// if($userOrgnType=='Non-MOS')
	     // {
			if($userAppliedVacancies['Vacancy']['created_by_orgn_id']!=$userOrgn)
			{
			 throw new NotFoundException('You Cannot Update Status of this applicant');	
			} 
	     //}
		
		$this->request->data=$userAppliedVacancies;
		$currentStatus=$this->request->data['UserAppliedVacancy']['status'];
        $this->set(compact('currentStatus','userAppliedVacancies'));		
	   		  
	  } 

    public function accepted_applications()
	{
     $userOrgn = $this->Session->read('Auth.User.organization_id'); 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        'UserAppliedVacancy.status'=>'Accepted',
																							'Vacancy.created_by_orgn_id'=>$userOrgn
																							),
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('organization_id'),
																										   'Organization'=>array(
																										                         'fields'=>array('id','organization_name','organization_type')
																																),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('id','post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email')
																						               ),																										  
																		                  'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
															
																						  
																						 )					
	                                                                    )
															)
			    );
	}
    
    public function rejected_applications()
	{	
	 $userOrgn = $this->Session->read('Auth.User.organization_id'); 		
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        'UserAppliedVacancy.status'=>'Not Eligible',
																							'Vacancy.created_by_orgn_id'=>$userOrgn
																							),
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('organization_id'),
																										   'Organization'=>array(
																										                         'fields'=>array('id','organization_name','organization_type')
																																),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('id','post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email')
																						               ),																										  
																		                  'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
																						  
																						 )					
	                                                                    )
															)
			    );
	 
	 
	 
     $this->set(compact('organizations','posts','applicants'));
	}
	
	public function under_consideration()
	{
     $userOrgn = $this->Session->read('Auth.User.organization_id'); 		
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        'UserAppliedVacancy.status'=>'Under Consideration',
																							'Vacancy.created_by_orgn_id'=>$userOrgn
																							),
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('organization_id'),
																										   'Organization'=>array(
																										                         'fields'=>array('id','organization_name','organization_type')
																																),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('id','post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email')
																						               ),																										  
																		                  'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
																						  
																						 )					
	                                                                    )
															)
			    );
	}
	
	public function call_for_interview()
	{
     $userOrgn = $this->Session->read('Auth.User.organization_id'); 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        'UserAppliedVacancy.status'=>'Call for Interview',
																							'Vacancy.created_by_orgn_id'=>$userOrgn
																							),
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('organization_id'),
																										   'Organization'=>array(
																										                         'fields'=>array('id','organization_name','organization_type')
																																),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('id','post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email')
																						               ),																										  
																		                  'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
																						  
																						 )					
	                                                                    )
															)
			    );
	}
	
	          //Pdf Conversion
    public function applicant_profile_pdf($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundExcemption('Invalid Vacancy');  
	   }	

     // initializing mPDF
   $this->Mpdf->init();

    // setting filename of output pdf file
    $this->Mpdf->setFilename('AppliedVacancy.pdf');

    // setting output to I, D, F, S
    $this->Mpdf->setOutput('D');
	//$this->Mpdf->SetDisplayMode('fullpage');
    // you can call any mPDF method via component, for example:
    $this->Mpdf->SetWatermarkText("Draft");
	//$stylesheet = file_get_contents('../webroot/css/bootstrap/css/bootstrap.min.css');
	
	//$this->Mpdf->WriteHTML($stylesheet,1);

	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id'),
																									  'Notice'=>array('fields'=>array('advt_number')),
																						              'Post'=>array('fields'=>array('post_name')),
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              'Department'=>array('fields'=>array('department_name'))
																								  ),
																					 'User'=>array (
																						              'fields'=>array('email')
																						            ),			  
																					 'LogInformationUser',
                                                                                     'LogServiceAndBatchInfo',
                                                                                     'LogUserQualification',
                                                                                     'LogUserEmploymentDetail'																					 
																					 )				   
																	)
												    );
	 	
	$this->set(compact('applyingUser'));
          
	 $this->render('submitted_application'); 
	}	
	
	public function my_active_applications()
	{
	  $this->UserAppliedVacancy->Behaviors->load('Containable');   
	  /*$activeApplications = $this->UserAppliedVacancy->find('all',array(
																		'conditions'=>array(
																		                    'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																		                    ),
																		//'fields'=>array('UserAppliedVacancy.id','vacancy_id','applied_on','status','comments')					
																		'contain'=>array( 'Vacancy'=>array( 
																		                                    'fields'=>array('Vacancy.id'),
																						                    'Notice'=>array(
																											                'fields'=>array('id','advt_number')
																														    ),
																						                    'Post'=>array(
																											              'fields'=>array('id','post_name')
																														  )
																										   )
																					    )					
                                                						)
															);
		 $this->set(compact('activeApplications'));		*/
		
		
		$conditions=array(
							'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
							);
		$order=array('UserAppliedVacancy.id' => 'desc');
		$recursive=0;
		$limit=10;
		
		$this->Paginator->settings = 
                                    array(
                                            'conditions'=>$conditions,
                                            'order'=>$order,
                                            'limit'=>$limit,
											'contain'=>array( 'Vacancy'=>array( 
																				'fields'=>array('Vacancy.id'),
																				'Notice'=>array(
																								'fields'=>array('id','advt_number')
																								),
																				'Post'=>array(
																							  'fields'=>array('id','post_name')
																							  )
																			   )
															)
                                        );
		//You can use the 3rd parameter of PaginatorComponent::paginate() to restrict the columns that sorting will be done on                    
         $activeApplications = $this->Paginator->paginate('UserAppliedVacancy',array(),array('UserAppliedVacancy.id'));
	 
	 		
		
      $this->set('activeApplications',$activeApplications);			
	}
	
	public function my_active_application_dp($id=null)
	{
	  $this->UserAppliedVacancy->Behaviors->load('Containable');   
	  $activeApplication = $this->UserAppliedVacancy->find('first',array(
																		'conditions'=>array(
																							'UserAppliedVacancy.id'=>$id,
																		                    'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																		                    ),
																		'contain'=>array(
																	                 
																																										 
																					 'LogInformationUser'=>array('fields'=>array('profilepic')),
                                                                                     																				 
																					 )
                                                						)
															);
					
		if(!count($activeApplication))
		{
			throw new UnauthorizedException(__('Inavlid Application or You are not authorized to view/download this file.'));
		}	
		
		if(array_key_exists('LogInformationUser', $activeApplication))
		{
			if($activeApplication['LogInformationUser']['profilepic']!=NULL || $activeApplication['LogInformationUser']['profilepic']!='')
				$file=$activeApplication['LogInformationUser']['profilepic'];
			else
				$file='default.png';
			$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
			return $this->response;
		}
		else
		{
			throw new LogicException();
		}		

		
	}	
	
	
	public function application_view($id=null)
	{
	 if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
      
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id,
																					   'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id'),
																									  'Notice'=>array('fields'=>array('advt_number')),
																						              'Post'=>array('fields'=>array('post_name')),
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              'Department'=>array('fields'=>array('department_name'))
																								  ),
																					 'User'=>array (
																						              'fields'=>array('email')
																						            ),	
																																										 
																					 'LogInformationUser',
                                                                                     'LogServiceAndBatchInfo',
                                                                                     'LogUserQualification',
                                                                                     'LogUserEmploymentDetail'																					 
																					 )				   
																	)
												    );
	 if(!count($applyingUser))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
	   
    $vacancyId = $applyingUser['UserAppliedVacancy']['vacancy_id'];
	  
	        //For Vacancies Essentials
	$this->UserAppliedVacancy->User->VacanciesEssential->unbindModel(array('hasAndBelongsToMany' => array('User')));
	  $this->UserAppliedVacancy->User->VacanciesEssential->bindModel(
        array('hasMany' => array(
                'UsersVacanciesEssential' => array(
                    'className' => 'UsersVacanciesEssential'
                )
            )
        )
    );
	 $userEss = $this->UserAppliedVacancy->User->VacanciesEssential->find('all',array(
	                                                                                    'conditions'=>array(
																						                   'vacancy_id'=>$vacancyId
																						                   ),
																									   
																					 )
																		  );
				//For Vacancy Desirables														  
	$this->UserAppliedVacancy->User->VacanciesDesirable->unbindModel(array('hasAndBelongsToMany' => array('User')));
	  $this->UserAppliedVacancy->User->VacanciesDesirable->bindModel(
        array('hasMany' => array(
                'UsersVacanciesDesirable' => array(
                    'className' => 'UsersVacanciesDesirable'
                )
            )
        )
    );
	 $userDss = $this->UserAppliedVacancy->User->VacanciesDesirable->find('all',array(
	                                                                                    'conditions'=>array(
																						                   'vacancy_id'=>$vacancyId
																						                   ),
																									   
																					 )
																		  );
	
	$userId = $this->Session->read('Auth.User.id');
	
	//pr($userEss);																  
																		  
		
	$this->set(compact('applyingUser','userEss','userId','userDss'));																			 
	}

	
// NOte:- if updating Action "approve_applying_user", do not forget to update Action "approve_applying_user_dp_dp" accordingly
   public function approve_applying_user()
   {
	 $this->UserAppliedVacancy->User->Behaviors->load('Containable');
	 $nodalOfficer = $this->UserAppliedVacancy->User->find('first',array('conditions'=>array(
	                                                                                  'User.id'=>$this->Session->read('Auth.User.id')
	                                                                                 ),
																  'fields'=>array('id','organization_id'),					 
															       'contain'=>array(
																                  'Organization'=>array('fields'=>'organization_name')
																				 )					 
														        )
												   ); 
	 
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	  $applicants = $this->UserAppliedVacancy->find('all',array('conditions'=>array(
																					'UserAppliedVacancy.status'=>array('Submitted','Under Consideration','Accepted','Call for Interview'),
																					'LogInformationUser.organization_name' => $nodalOfficer['Organization']['organization_name']
																					),
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array(),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email','organization_id'),
																										'Organization'=>array('fields'=>'organization_name')
																						               ),																										  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r'),
																						                             )
																						 )					
	                                                                    )
															);
     
	 	//pr($applicants); exit;

	$this->set(compact('applicants','nodalOfficer'));  
   } 
   
   
   public function approve_applying_user_dp($id = null)
   {
	   
	   if (!$this->UserAppliedVacancy->User->exists($id)) {
			throw new NotFoundException(__('Invalid User'));
		}
		
		
	 $this->UserAppliedVacancy->User->Behaviors->load('Containable');
	 $nodalOfficer = $this->UserAppliedVacancy->User->find('first',array('conditions'=>array(
	                                                                                  'User.id'=>$this->Session->read('Auth.User.id')
	                                                                                 ),
																  'fields'=>array('id','organization_id'),					 
															       'contain'=>array(
																                  'Organization'=>array('fields'=>'organization_name')
																				 )					 
														        )
												   ); 
	 
	  //$this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	  $applicant = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					'UserAppliedVacancy.status'=>array('Submitted','Under Consideration','Accepted','Call for Interview'),
																					'LogInformationUser.organization_name' => $nodalOfficer['Organization']['organization_name'],
																					'UserAppliedVacancy.user_id'=>$id
																					),
																		 'contain'=>array(
																		                  
                                                                                          'User'=>array(
																						                'fields'=>array('profilepic'),
																										
																						               )																									  
																		                  
																						  
																						 )					
	                                                                    )
															);
     
		if(array_key_exists('User', $applicant))
		{
			if($applicant['User']['profilepic']!=NULL || $applicant['User']['profilepic']!='')
				$file=$applicant['User']['profilepic'];
			else
				$file='default.png';
			$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authorized to view/download this file.'));
		}	

	 
   }   
   
    public function my_active_application_sign($id=null)
	{
	  $this->UserAppliedVacancy->Behaviors->load('Containable');   
	  $activeApplication = $this->UserAppliedVacancy->find('first',array(
																		'conditions'=>array(
																							'UserAppliedVacancy.id'=>$id,
																		                    'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																		                    ),
																		'contain'=>array(
																	                 
																																										 
																					 'LogInformationUser'=>array('fields'=>array('profilesignature')),
                                                                                     																				 
																					 )
                                                						)
															);
					
		if(!count($activeApplication))
		{
			throw new UnauthorizedException(__('Inavlid Application or You are not authorized to view/download this file.'));
		}	
		
		if(array_key_exists('LogInformationUser', $activeApplication))
		{
			if($activeApplication['LogInformationUser']['profilesignature']!=NULL || $activeApplication['LogInformationUser']['profilesignature']!='')
				$file=$activeApplication['LogInformationUser']['profilesignature'];
			else
				$file='not-uploaded.jpg';
			$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
			return $this->response;
		}
		else
		{
			throw new LogicException();
		}		

		
	}   
   
   
   
   public function submitted_application_for_approval($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
     $userOrgn     = $this->Session->read('Auth.User.organization_id');	   
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 															   
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','organization_id'),
																									  'Notice'=>array('fields'=>array('advt_number')),
																						              'Post'=>array('fields'=>array('post_name')),
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              'Department'=>array('fields'=>array('department_name'))
																								  ),
																					 'User'=>array (
																						              'fields'=>array('email','id')
																						            ),			  
																					 'LogInformationUser',
                                                                                     'LogServiceAndBatchInfo',
                                                                                     'LogUserQualification',
                                                                                     'LogUserEmploymentDetail'																					 
																					 )				   
																	)
												    );
													
    $vacancyId = $applyingUser['UserAppliedVacancy']['vacancy_id'];
	$userId  =  $applyingUser['User']['id'];
	
	// if($userOrgn!=$applyingUser['Vacancy']['organization_id'])
	// {
	  // throw new NotFoundException('Invalid Application....');	
	// }	
	
	        //For Vacancies Essentials
	$this->UserAppliedVacancy->User->VacanciesEssential->unbindModel(array('hasAndBelongsToMany' => array('User')));
	  $this->UserAppliedVacancy->User->VacanciesEssential->bindModel(
        array('hasMany' => array(
                'UsersVacanciesEssential' => array(
                    'className' => 'UsersVacanciesEssential'
                )
            )
        )
    );
	
	 $userEss = $this->UserAppliedVacancy->User->VacanciesEssential->find('all',array(
	                                                                                    'conditions'=>array(
																						                   'vacancy_id'=>$vacancyId
																						                   ),
																									   
																					 )
																		  );
		   		//For Vacancy Desirables														  
	$this->UserAppliedVacancy->User->VacanciesDesirable->unbindModel(array('hasAndBelongsToMany' => array('User')));
	  $this->UserAppliedVacancy->User->VacanciesDesirable->bindModel(
        array('hasMany' => array(
                'UsersVacanciesDesirable' => array(
                    'className' => 'UsersVacanciesDesirable'
                )
            )
        )
    );
	 $userDss = $this->UserAppliedVacancy->User->VacanciesDesirable->find('all',array(
	                                                                                    'conditions'=>array(
																						                   'vacancy_id'=>$vacancyId
																						                   ),
																									   
																					 )
																		  );
													
																										
													
													
	 /*$this->UserAppliedVacancy->Vacancy->Behaviors->load('Containable');														
	 $vacancy = $this->UserAppliedVacancy->Vacancy->find('first',array('conditions'=>array(
	                                                                                       'Vacancy.id'=>$applyingUser['UserAppliedVacancy']['vacancy_id']
																						  ),
																		'fields'=>array('id'),				  
																		'contain'=>array(
																		                 'Notice'=>array('fields'=>array('advt_number')),
																						 'Post'=>array('fields'=>array('post_name')),
																						 'Organization'=>array('fields'=>array('organization_name')),
																						 'Department'=>array('fields'=>array('department_name'))
																						)				  
	                                                                     )
												    );*/	
     /*$this->UserAppliedVacancy->recursive=2;
	 $userInfo = $this->UserAppliedVacancy->find('first',array('conditions'=>array('UserAppliedVacancy.id'=>$id)
	                                                                )
														);*/	
	$this->set(compact('applyingUser','userEss','userDss','vacancyId','userId'));																			 
	}   
    
   public function upload_acrs($id=null)
    {
	 if(!$this->UserAppliedVacancy->exists($id))
	     {
		 throw new NotFoundException('Invalid Vacancy');  
	     }
     
     if($this->request->is(array('post','put')))
       {
		$this->UserAppliedVacancy->id = $id;
		$this->request->data['UserAppliedVacancy']['docs_uploaded_on'] = $this->UserAppliedVacancy->getDataSource()->expression('NOW()');
       
		 if($this->UserAppliedVacancy->save($this->request->data))
		 {
		  echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Documents has been Successfully uploaded....','default',array('class'=>'alert alert-success alert-dismissable')); 
		  return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'approve_applying_user'));     	 
		 }
         else
		 {
		  echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Sorry,Unable to upload Documents....','default',array('class'=>'alert alert-danger alert-dismissable'));
		  return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'approve_applying_user'));     	 	 
		 }	 
	   }
      $this->UserAppliedVacancy->Behaviors->load('Containable');
	  $userAppliedVacancies=$this->UserAppliedVacancy->find('first',array('conditions'=>array('UserAppliedVacancy.id'=>$id),
																			'contain'=>array(
																								'User'=>array(
																												'fields'=>array(
																																'email',
																																'userName'
																											                   ),
																											 ),
																								'LogInformationUser'=>array(
																															'fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')
																															)
																											
																                  			     
																							)
	                                                                      )
															);
        //If Documents Are Already uploaded															
		if(($userAppliedVacancies['UserAppliedVacancy']['acr_pdf']!='None') && ($userAppliedVacancies['UserAppliedVacancy']['vigl_pdf']!='None') && ($userAppliedVacancies['UserAppliedVacancy']['cadre_pdf']!='None'))													
		{
		 throw new NotFoundException('Documents Already Uploaded.....');	
		}
	    												
		$this->request->data=$userAppliedVacancies;	   
    }   
}