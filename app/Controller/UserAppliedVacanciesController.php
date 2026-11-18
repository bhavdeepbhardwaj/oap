<?php
App::uses('AppController','Controller');
class UserAppliedVacanciesController extends AppController
{
 public $uses = array('Organization','Post','UserAppliedVacancy','Notice');
  public function beforeFilter()
     {
        parent::beforeFilter();
		
		$this->Security->unlockedFields = array('acr_pdf','vigl_pdf','cadre_pdf');
		
		//$this->Auth->allow();
		            //For Member(Applicant)
		if($this->action == 'my_active_application_dp_for_pdf' && $this->request->pass[1]=='active') {
			
			$this->Auth->allow('my_active_application_dp_for_pdf');
        }
		
		if($this->action == 'my_active_application_sign_for_pdf' && $this->request->pass[1]=='active') {
			
			$this->Auth->allow('my_active_application_sign_for_pdf');
        }
		
		                 //For Admin(Nodal Officer)
		if($this->action == 'approve_applying_user_dp_for_pdf' && $this->request->pass[1]=='approval') {
			
			$this->Auth->allow('approve_applying_user_dp_for_pdf');
        }
		
		if($this->action == 'approve_applying_user_sign_for_pdf' && $this->request->pass[1]=='approval') {
			
			$this->Auth->allow('approve_applying_user_sign_for_pdf');
        }
		                   
						   //For Verifying Officer
		if($this->action == 'submitted_application_dp_for_pdf' && $this->request->pass[1]=='verifying_officer') {
			
			$this->Auth->allow('submitted_application_dp_for_pdf');
        }
		
		if($this->action == 'submitted_application_sign_for_pdf' && $this->request->pass[1]=='verifying_officer') {
			
			$this->Auth->allow('submitted_application_sign_for_pdf');
        }
		
						   //For Monitoring Officer
		if($this->action == 'submitted_application_dp_for_pdf_for_monitoring_officer' && $this->request->pass[1]=='verifying_officer') {
			
			$this->Auth->allow('submitted_application_dp_for_pdf_for_monitoring_officer');
        }
		
		if($this->action == 'submitted_application_sign_for_pdf_for_monitoring_officer' && $this->request->pass[1]=='verifying_officer') {
			
			$this->Auth->allow('submitted_application_sign_for_pdf_for_monitoring_officer');
        }
		
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
																										//'religion',
																										'd_o_b',
																										'birth_state',
																										'p_o_b',
																										'marital_status',
																										//'hobbies',
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
																										'disability_name',
																										'other_disability',
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
																										'consolidated_emoluments',
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
																										                'ServiceAndBatchInfo.user_id','service_name','batch','cadre_name','other_cadre_name','doj_grp_a','exp_prt_ship','write_up1_data','write_up2_data','write_up_1','write_up_2'
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
      $this->UserAppliedVacancy->validator()->remove('remarks');
	  $this->UserAppliedVacancy->validator()->remove('vigl_case_text');
	  $this->UserAppliedVacancy->validator()->remove('exp_feeder_grade');
	  $this->UserAppliedVacancy->validator()->remove('acr_status');
	  $this->UserAppliedVacancy->validator()->remove('remarks_by_officer');
	  
	  $this->UserAppliedVacancy->create();
        if($this->UserAppliedVacancy->saveAll($this->request->data, array('deep' => true)))
		{
		 echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Successfully Applied for the job....','default',array('class'=>'alert alert-success alert-dismissable'));	
		 return $this->redirect(array('controller'=>'dashboard','action'=>'index'));
		}
        else
		{
		  //pr($this->UserAppliedVacancy->invalidFields()); 	
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
		
	   $posts = $this->Post->find('list',array('fields'=>'post_name',
												'order'=>array('post_name'=>'ASC')
											   )
								 );	 							 
	  
	  
	  }		 
	 
	 if((isset($this->request->query['post_id']) && $userOrgnType!='MOS' )){	
		
		$userOrgn     = $this->Session->read('Auth.User.organization_id');
		$notId =	$this->request->query['post_id'];
			
			$vacancyid = $this->UserAppliedVacancy->Vacancy->find('all',array('conditions'=>array('Vacancy.organization_id'=>$userOrgn,
			'Vacancy.post_id'=>$notId
			),
	                                           'fields'=>array('notice_id')
											   )
								 );
			
			//pr($vacancyid);
			$vacanynoticeId = Hash::extract($vacancyid,'{n}.Vacancy.notice_id');
			
			$notices = $this->Notice->find('list',array('conditions'=>array('Notice.id'=>$vacanynoticeId,
			'Notice.created_by_orgn_id'=>$userOrgn
			),
	                                           'fields'=>array('id','advt_number'),
											  )
											   
								 );
			
		}
	 
	 
	 
	 $filteredOrganization = null;
     $filteredPost = null;
      
     $conditions = array();
     
     if(isset($this->request->query['organization_id']) && $this->Organization->exists($this->request->query['organization_id'])) 	 
	 {
	   $conditions['Vacancy.organization_id'] = $this->request->query['organization_id']; 
		$conditions['Vacancy.post_id'] = $this->request->query['post_id'];
	 }
	 else if(isset($this->request->query['notice_id']) && $this->Notice->exists($this->request->query['notice_id'])) 	 
	 {
	   $conditions['Vacancy.post_id'] = $this->request->query['post_id']; $conditions['Vacancy.notice_id'] = $this->request->query['notice_id'];	 
	 }
	 else {
	if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditions['Vacancy.post_id'] = $this->request->query['post_id'];
	 }
	}
	 
	 /*if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditions['Vacancy.post_id'] = $this->request->query['post_id']; 	 
	 } */
	
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
																										                   'fields'=>array('opening_date','closing_date','advt_number')
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
	 
	 
     $this->set(compact('organizations','posts','applicants','userOrgnType','notices')); 
	}
	
	
	
	public function service_list_add()
	{
	    
		if(!$this->request->is('ajax'))
		{	
			throw new MethodNotAllowedException('Method Not Allowed.');
		}
			 
			$userOrgn     = $this->Session->read('Auth.User.organization_id');
			
			$notId =	$this->request->data['id'];
			
			$vacancyid = $this->UserAppliedVacancy->Vacancy->find('all',array('conditions'=>array('Vacancy.organization_id'=>$userOrgn,
			'Vacancy.post_id'=>$notId
			),
	                                           'fields'=>array('notice_id')
											   )
								 );
			
			//pr($vacancyid);
			$vacanynoticeId = Hash::extract($vacancyid,'{n}.Vacancy.notice_id');
			
			$notices = $this->Notice->find('all',array('conditions'=>array('Notice.id'=>$vacanynoticeId,
			'Notice.created_by_orgn_id'=>$userOrgn
			),
	                                           'fields'=>array('Notice.id','Notice.advt_number'),
											  )
											   
								 );
		
		
		$this->set('notices',$notices);
		
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
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	
	/*if($userOrgnType=='Non-MOS')
	{
		if($applyingUser['Vacancy']['organization_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	}*/

    if($applyingUser['Vacancy']['created_by_orgn_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		}

   	
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilepic']!=NULL || $applyingUser['LogInformationUser']['profilepic']!='')
			$file=$applyingUser['LogInformationUser']['profilepic'];
		else
			$file='default.png';
		$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
		//pr($this->request);exit;
		return $this->response;
	}
	else
	{
		throw new LogicException();
	}
}

public function submitted_application_sign($id=null)
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
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	
	/*if($userOrgnType=='Non-MOS')
	{
		if($applyingUser['Vacancy']['organization_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	}*/

    if($applyingUser['Vacancy']['created_by_orgn_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		}
	
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilesignature']!=NULL || $applyingUser['LogInformationUser']['profilesignature']!='')
			$file=$applyingUser['LogInformationUser']['profilesignature'];
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
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
		
			if($userAppliedVacancies['Vacancy']['created_by_orgn_id']!=$userOrgn)
			{
			 throw new NotFoundException('You Cannot Update Status of this applicant');	
			} 
	     



	  
	  if($this->request->is(array('post','put')))
	  { $cs=$this->request->data['UserAppliedVacancy']['currentStatus']; 
         $this->UserAppliedVacancy->validator()->remove('vigl_case_text');
		 $this->UserAppliedVacancy->validator()->remove('exp_feeder_grade');
		 $this->UserAppliedVacancy->validator()->remove('acr_status');
		 $this->UserAppliedVacancy->validator()->remove('remarks_by_officer');
         
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
               elseif($cs=='Incomplete Documents')
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
				//return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'new_applications'));  
			   }
              elseif($cs=='Accepted')
			   {
				//return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'accepted_applications'));    
			   }
              elseif($cs=='Rejected')
			   {
				//return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'rejected_applications'));    
			   }
               elseif($cs=='Call for Interview')
			   {
				//return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'call_for_interview'));    
			   }
               elseif($cs=='Under Consideration')
			   {
				//return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'under_consideration'));    
			   }
               else
			   {
				//return $this->redirect(array('controller'=>'dashboard','action'=>'index'));   
			   }  
		}
	  }	
	  
	  
		
		$this->request->data=$userAppliedVacancies;
		$currentStatus=$this->request->data['UserAppliedVacancy']['status'];
        $this->set(compact('currentStatus','userAppliedVacancies'));		
	   		  
	}

     //Updation of Applicant Summary
	 
	 public function update_applicant_summary($id=null)
      {
	   	if(!$this->UserAppliedVacancy->exists($id))
	     {
		 throw new NotFoundException('Invalid Vacancy');  
	     }
	  	$userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	    $userOrgn     = $this->Session->read('Auth.User.organization_id');

	  
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
		
			if($userAppliedVacancies['Vacancy']['created_by_orgn_id']!=$userOrgn)
			{
			 throw new NotFoundException('You Cannot Update Status of this applicant');	
			} 
	    
	  if($this->request->is(array('post','put')))
	  { 
  
        $this->request->data['UserAppliedVacancy']['applicant_status_last_updated_by_user_id'] = $this->Session->read('Auth.User.id');
        $this->request->data['UserAppliedVacancy']['applicant_status_last_updated_on'] = $this->UserAppliedVacancy->getDataSource()->expression('NOW()');
		$this->UserAppliedVacancy->validator()->remove('remarks');
		$cs=$this->request->data['UserAppliedVacancy']['currentStatus'];  
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
               elseif($cs=='Incomplete Documents')
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
		 //pr($this->UserAppliedVacancy->invalidFields());	
		 echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Sorry,Unable to update Status....','default',array('class'=>'alert alert-danger alert-dismissable'));  
		 
		}
	  }	
	  else
	   { 
		$this->request->data=$userAppliedVacancies;		  
	   }
	   $currentStatus=$this->request->data['UserAppliedVacancy']['status'];
	   $this->set(compact('currentStatus','userAppliedVacancies'));  
	}

	

    // public function accepted_applications()
	// {
     // $userOrgn = $this->Session->read('Auth.User.organization_id'); 	 
	 // $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 // $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        // 'UserAppliedVacancy.status'=>'Accepted',
																							// 'Vacancy.created_by_orgn_id'=>$userOrgn
																							// ),
																		 // 'contain'=>array(
																		                  // 'Vacancy'=>array(
																						                   // 'fields'=>array('organization_id'),
																										   // 'Organization'=>array(
																										                         // 'fields'=>array('id','organization_name','organization_type')
																																// ),
																						                   // 'Notice'=>array(
																										                   // 'fields'=>array('opening_date','closing_date')
																														   // ),
																										   // 'Post'=>array(
																										                 // 'fields'=>array('id','post_name')
																														// )
																						                  // ),
                                                                                          // 'User'=>array(
																						                // 'fields'=>array('email')
																						               // ),																										  
																		                  // 'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
															
																						  
																						 // )					
	                                                                    // )
															// )
			    // );
	// }
    
    // public function rejected_applications()
	// {	
	 // $userOrgn = $this->Session->read('Auth.User.organization_id'); 		
	 // $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 // $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        // 'UserAppliedVacancy.status'=>'Not Eligible',
																							// 'Vacancy.created_by_orgn_id'=>$userOrgn
																							// ),
																		 // 'contain'=>array(
																		                  // 'Vacancy'=>array(
																						                   // 'fields'=>array('organization_id'),
																										   // 'Organization'=>array(
																										                         // 'fields'=>array('id','organization_name','organization_type')
																																// ),
																						                   // 'Notice'=>array(
																										                   // 'fields'=>array('opening_date','closing_date')
																														   // ),
																										   // 'Post'=>array(
																										                 // 'fields'=>array('id','post_name')
																														// )
																						                  // ),
                                                                                          // 'User'=>array(
																						                // 'fields'=>array('email')
																						               // ),																										  
																		                  // 'LogInformationUser'=>array('fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r')),
																						  
																						 // )					
	                                                                    // )
															// )
			    // );
	 
	 
	 
     // $this->set(compact('organizations','posts','applicants'));
	// }
	
	public function under_consideration()
	{
     $userOrgn = $this->Session->read('Auth.User.organization_id'); 		
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $this->set('applicants',$this->UserAppliedVacancy->find('all',array('conditions'=>array(
	                                                                                        'UserAppliedVacancy.status'=>'Incomplete Documents',
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
	
	          //Pdf Conversion for Member
    public function applicant_profile_pdf($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Vacancy');  
	   }	

          
	 
	$this->layout=false;
	
     // initializing mPDF
   $this->Mpdf->init();

    // setting filename of output pdf file
    $this->Mpdf->setFilename('Applicant Profile.pdf');

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
          
	 $this->render('applicant_application_pdf'); 
	}	
	
	
	//Applicant Profile PDF for Organization Nodal Officer
	
	public function submitted_applicant_approval_profile_pdf($id)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
     $userOrgn     = $this->Session->read('Auth.User.organization_id');	   
	 
	 $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	 $nodalOfficerOrgnId = $this->Session->read('Auth.User.organization_id');  
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               																									  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													);
	  //pr($logInfoUsers); 
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
	  
	   //pr($refinedResult); exit;
	  if(empty($refinedResult))
	  {
		throw new NotFoundException('Invalid....');  
	  } 
	  
	  $applicants = $refinedResult;
	  
	  //For Stopping the Admin from viewing other organization applications.
	 
	 if($applicants['UserAppliedVacancy']['id']!=$id)
	 {
		throw new NotFoundException('Invalid Application......'); 
	 } 
	 
	 $this->layout=false;
	
     // initializing mPDF
   $this->Mpdf->init();

    // setting filename of output pdf file
    $this->Mpdf->setFilename('Applicant Profile.pdf');

    // setting output to I, D, F, S
    $this->Mpdf->setOutput('D');
	//$this->Mpdf->SetDisplayMode('fullpage');
    // you can call any mPDF method via component, for example:
    $this->Mpdf->SetWatermarkText("Draft");
	//$stylesheet = file_get_contents('../webroot/css/bootstrap/css/bootstrap.min.css');
	
	//$this->Mpdf->WriteHTML($stylesheet,1);

	 
	 
	 
	 //For Displaying The Content.
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 															   
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','organization_id'),
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
													
																										
													
													
	 	
	$this->set(compact('applyingUser','userEss','userDss','vacancyId','userId','nodalOfficerOrgnId'));
    $this->render('submitted_application_for_approval_pdf');
 	
	}
	
     // Submitted Application Pdf for Application Verifying Officer
	 
    public function submitted_application_pdf($id)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }

    	 
	 $this->layout=false;
	
     // initializing mPDF
    $this->Mpdf->init();

    // setting filename of output pdf file
    $this->Mpdf->setFilename('Applicant Profile.pdf');

    // setting output to I, D, F, S
    $this->Mpdf->setOutput('D');
	//$this->Mpdf->SetDisplayMode('fullpage');
    // you can call any mPDF method via component, for example:
    $this->Mpdf->SetWatermarkText("Draft");
	//$stylesheet = file_get_contents('../webroot/css/bootstrap/css/bootstrap.min.css');
	
	//$this->Mpdf->WriteHTML($stylesheet,1);
	 
     $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
	
	
		if($applyingUser['Vacancy']['created_by_orgn_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	
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
							
	 $this->set(compact('applyingUser','userEss','userDss','userId','vacancyId','userOrgn'));																			 
	 $this->render('submitted_application_for_verification_pdf');
	 
	} 

	// Submitted Application DP Pdf for Application Verifying Officer
	
	public function submitted_application_dp_for_pdf($id,$applicationType,$officerOrgnId)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
       
       if(!$this->Organization->exists($officerOrgnId))
	   {
		 throw new NotFoundException('Invalid Organization');  
	   }
      
       if($applicationType!='verifying_officer')	  
	   {
		throw new MethodNotAllowedException('Invalid');    
	   }
	   
     //$userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $officerOrgnId ;
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	
	/*if($userOrgnType=='Non-MOS')
	{
		if($applyingUser['Vacancy']['organization_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	}*/


    if($applyingUser['Vacancy']['created_by_orgn_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		}
	
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilepic']!=NULL || $applyingUser['LogInformationUser']['profilepic']!='')
			$file=$applyingUser['LogInformationUser']['profilepic'];
		else
			$file='default.png';
		$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
		//pr($this->request);exit;
		return $this->response;
	}
	else
	{
		throw new LogicException();
	}
 }

 // Submitted Application Sign Pdf for Application Verifying Officer
 public function submitted_application_sign_for_pdf($id,$applicationType,$officerOrgnId)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }

     if(!$this->Organization->exists($officerOrgnId))
	   {
		 throw new NotFoundException('Invalid Organization');  
	   }
     if($applicationType!='verifying_officer')	  
	   {
		throw new MethodNotAllowedException('Invalid');    
	   }	   
	 
     //$userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $officerOrgnId;
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	
	/*if($userOrgnType=='Non-MOS')
	{
		if($applyingUser['Vacancy']['organization_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		} 
	}*/

   	if($applyingUser['Vacancy']['created_by_orgn_id']!=$userOrgn)
		{
		 throw new NotFoundException('Submitted Application Does Not Belong to your Organization');	
		}
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilesignature']!=NULL || $applyingUser['LogInformationUser']['profilesignature']!='')
			$file=$applyingUser['LogInformationUser']['profilesignature'];
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
	
	public function my_active_application_dp($id)
	{
	  //pr($this->request->pass); 

	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
	  
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
	
	                 //For PDF My Active Application DP
	public function my_active_application_dp_for_pdf($id,$applicantType,$applicantUserId)
	{
	  //pr($this->request->pass); 

	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
	   
	  if($applicantType!='active')
	  {
		throw new MethodNotAllowedException('Invalid');  
	  }

      if(!$this->UserAppliedVacancy->User->exists($applicantUserId))
	   {
		 throw new NotFoundException('Invalid User');  
	   }
	  
      /*$trailData=array();
                    $trailData['ActionLog']=array(
                                                    'username'=>1,
                                                    'ip_address'=>'192.168.1.1',

                                                //   'session_id'=>$this->Session->id(),
                                                    'action_requested'=>$this->request->params['action'],
                                                    'full_url'=>serialize($this->request),
                                              //      'process_id'=>posix_getpid(),
                                                     'process_id'=>getmypid(),
                                                     'refferer_url'=>$this->request->referer(),
                                                     //'data_sent_in_request'=>serialize($this->request)
                                                    );
                    $this->ActionLog->create();
                    $this->ActionLog->save($trailData);
      */
	    
	  if($this->request->params['pass'][1]=='active')
	   {
		$applicantUserId  = $this->request->params['pass'][2] ;
	   }
		   
	  
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');   
	  $activeApplication = $this->UserAppliedVacancy->find('first',array(
																		'conditions'=>array(
																							'UserAppliedVacancy.id'=>$id,
																		                    'UserAppliedVacancy.user_id'=>$applicantUserId
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
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
	
	// if downloading is done from applicant's profile
	public function dwnld_self_quali_docs($id=null)
	{
		if(!$this->UserAppliedVacancy->LogUserQualification->exists($id))
		{
			throw new NotFoundException(__('Invalid Educational Qualification'));
		}
		
		$educationalQualification=$this->UserAppliedVacancy->LogUserQualification->find('first',array(
																										'conditions'=>array( 
																																'LogUserQualification.id'=>$id,
																																'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																																
																															),
																										'fields'=>array('LogUserQualification.edu_pdf')					
																							)
																						);
		
		
		if(array_key_exists('LogUserQualification', $educationalQualification))
		{
			$file=$educationalQualification['LogUserQualification']['edu_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'qualification.pdf'));
			return $this->response;
			//pr($educationalQualification);
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
		
		
		
	}
	
	public function download_self_caste_pdf($id=null)
        {
            $this->UserAppliedVacancy->LogInformationUser->recursive=-1;
            $employeeInfo=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																			'conditions'=>array(
																								'LogInformationUser.id'=>$id,
																				
																								),
																			'fields'=>array('LogInformationUser.caste_pdf')
																			)
															);
            
            if(array_key_exists('LogInformationUser', $employeeInfo))
            {
                if($employeeInfo['LogInformationUser']['caste_pdf']!=NULL || $employeeInfo['LogInformationUser']['caste_pdf']!='')
                    $file=$employeeInfo['LogInformationUser']['caste_pdf'];
                
                $this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download'=>true,'name'=>'community_certificate.pdf'));
                return $this->response;
            }
            else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
        }
	



	// if downloading is done from applicant's profile
	public function dwnld_self_exp_docs($id=null)
	{
		if(!$this->UserAppliedVacancy->LogUserEmploymentDetail->exists($id))
		{
			throw new NotFoundException(__('Invalid Experience Detail'));
		}
		
		$expDetail=$this->UserAppliedVacancy->LogUserEmploymentDetail->find('first',array(
																										'conditions'=>array( 
																																'LogUserEmploymentDetail.id'=>$id,
																																'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																																
																															),
																										'fields'=>array('LogUserEmploymentDetail.exp_pdf')					
																							)
																						);
		
		
		if(array_key_exists('LogUserEmploymentDetail', $expDetail))
		{
			$file=$expDetail['LogUserEmploymentDetail']['exp_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'employemet_detail.pdf'));
			return $this->response;
			//pr($educationalQualification);
		}
		else
		{
			
			
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
		
		
		
	}
	
	// if downloading is done from applicant's profile
	public function dwnld_self_write_up_1($id=null)
	{
		if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
		$writeUP=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																										'conditions'=>array( 
																																'LogServiceAndBatchInfo.id'=>$id,
																																'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																																
																															),
																										'fields'=>array('LogServiceAndBatchInfo.write_up_1')					
																							)
																						);
		
		
		if(array_key_exists('LogServiceAndBatchInfo', $writeUP))
		{
			$file=$writeUP['LogServiceAndBatchInfo']['write_up_1'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_1.pdf'));
			return $this->response;
			
		}
		else
		{
			
			
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
	}

    // if downloading is done from applicant's profile
	public function dwnld_self_write_up_2($id=null)
	{
		if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
		$writeUP=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																										'conditions'=>array( 
																																'LogServiceAndBatchInfo.id'=>$id,
																																'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
																																
																															),
																										'fields'=>array('LogServiceAndBatchInfo.write_up_2')					
																							)
																						);
		
		
		if(array_key_exists('LogServiceAndBatchInfo', $writeUP))
		{
			$file=$writeUP['LogServiceAndBatchInfo']['write_up_2'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_2.pdf'));
			return $this->response;
			
		}
		else
		{
			
			
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
	}	
	
	
	//if downloading Qualification Docs done from officer module
	public function dwnld_applicants_quali_docs($id=null)
	{
		if(!$this->UserAppliedVacancy->LogUserQualification->exists($id))
		{
			throw new NotFoundException(__('Invalid User Qualification Detail'));
		}
		
		$this->UserAppliedVacancy->LogUserQualification->Behaviors->load('Containable');
		$applicantEduInfo=$this->UserAppliedVacancy->LogUserQualification->find('first',array(
																							'conditions'=>array( 
																												'LogUserQualification.id'=>$id,
																											   ),
																							'fields'=>array('id','user_applied_vacancy_id','edu_pdf'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		$vacancyCreatedByOrgn = $this->UserAppliedVacancy->Vacancy->find('count',array(
		                                                                               'conditions'=>array(
																					                       'Vacancy.id'=>$applicantEduInfo['UserAppliedVacancy']['vacancy_id'],
																										   'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																					                      )
																					  )
		                                                                );
		
        if(!$vacancyCreatedByOrgn)		
		{
		 throw new UnauthorizedException('You are not authorized to download this file');	
		}
		
		if(array_key_exists('LogUserQualification', $applicantEduInfo))
		{
			$file=$applicantEduInfo['LogUserQualification']['edu_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'qualification.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
   
	//if downloading Applicant Experience Docs done from officer module
	public function dwnld_applicants_exp_docs($id=null)
	{
		if(!$this->UserAppliedVacancy->LogUserEmploymentDetail->exists($id))
		{
			throw new NotFoundException(__('Invalid Employment Detail'));
		}
		
		$this->UserAppliedVacancy->LogUserEmploymentDetail->Behaviors->load('Containable');
		$applicantExpInfo=$this->UserAppliedVacancy->LogUserEmploymentDetail->find('first',array(
																							'conditions'=>array( 
																												'LogUserEmploymentDetail.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','exp_pdf'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		$vacancyCreatedByOrgn = $this->UserAppliedVacancy->Vacancy->find('count',array(
		                                                                               'conditions'=>array(
																					                       'Vacancy.id'=>$applicantExpInfo['UserAppliedVacancy']['vacancy_id'],
																										   'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																					                      )
																					  )
		                                                                );
		
        if(!$vacancyCreatedByOrgn)		
		{
		 throw new UnauthorizedException('You are not authorized to download this file');	
		}
		
		if(array_key_exists('LogUserEmploymentDetail', $applicantExpInfo))
		{
			$file=$applicantExpInfo['LogUserEmploymentDetail']['exp_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'experience.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	
	//if downloading Applicant write up 1 done from officer module
	public function dwnld_applicants_write_up_1_doc($id=null)
	{
		if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
		$this->UserAppliedVacancy->LogServiceAndBatchInfo->Behaviors->load('Containable');
		$applicantWriteUpInfo=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																							'conditions'=>array( 
																												'LogServiceAndBatchInfo.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','write_up_1'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		$vacancyCreatedByOrgn = $this->UserAppliedVacancy->Vacancy->find('count',array(
		                                                                               'conditions'=>array(
																					                       'Vacancy.id'=>$applicantWriteUpInfo['UserAppliedVacancy']['vacancy_id'],
																										   'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																					                      )
																					  )
		                                                                );
		
        if(!$vacancyCreatedByOrgn)		
		{
		 throw new UnauthorizedException('You are not authorized to download this file');	
		}
		
		if(array_key_exists('LogServiceAndBatchInfo', $applicantWriteUpInfo))
		{
			$file=$applicantWriteUpInfo['LogServiceAndBatchInfo']['write_up_1'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_1.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant write up 2 done from officer module
	public function dwnld_applicants_write_up_2_doc($id=null)
	{
		if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
		$this->UserAppliedVacancy->LogServiceAndBatchInfo->Behaviors->load('Containable');
		$applicantWriteUpInfo=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																							'conditions'=>array( 
																												'LogServiceAndBatchInfo.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','write_up_2'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		$vacancyCreatedByOrgn = $this->UserAppliedVacancy->Vacancy->find('count',array(
		                                                                               'conditions'=>array(
																					                       'Vacancy.id'=>$applicantWriteUpInfo['UserAppliedVacancy']['vacancy_id'],
																										   'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																					                      )
																					  )
		                                                                );
		
        if(!$vacancyCreatedByOrgn)		
		{
		 throw new UnauthorizedException('You are not authorized to download this file');	
		}
		
		if(array_key_exists('LogServiceAndBatchInfo', $applicantWriteUpInfo))
		{
			$file=$applicantWriteUpInfo['LogServiceAndBatchInfo']['write_up_2'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_2.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant Caste Certificate done from officer module
	public function dwnld_applicants_caste_cert($id=null)
	{
		if(!$this->UserAppliedVacancy->LogInformationUser->exists($id))
		{
			throw new NotFoundException(__('Invalid Caste Certificate'));
		}
		
		$this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
		$applicantCasteCert=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																							'conditions'=>array( 
																												'LogInformationUser.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','caste_pdf'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		$vacancyCreatedByOrgn = $this->UserAppliedVacancy->Vacancy->find('count',array(
		                                                                               'conditions'=>array(
																					                       'Vacancy.id'=>$applicantCasteCert['UserAppliedVacancy']['vacancy_id'],
																										   'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																					                      )
																					  )
		                                                                );
		
        if(!$vacancyCreatedByOrgn)		
		{
		 throw new UnauthorizedException('You are not authorized to download this file');	
		}
		
		if(array_key_exists('LogInformationUser', $applicantCasteCert))
		{
			$file=$applicantCasteCert['LogInformationUser']['caste_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'community_cert.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	
	//if downloading Applicant ACRs done from officer module
	public function dwnld_applicants_acrs($id=null)
	{
		if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid ACR'));
		}
		
		$this->UserAppliedVacancy->Behaviors->load('Containable');
		$applicantDocs=$this->UserAppliedVacancy->find('first',array(
																	'conditions'=>array( 
																						'UserAppliedVacancy.id'=>$id,
																						'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																						),
																	'fields'=>array('id','acr_pdf'),					
																	'contain'=>array(
																					 'Vacancy'=>array(
																									  'fields'=>array('id','created_by_orgn_id')
																									 ), 				 
																					)				
																						
																		)
													   );
		
		if(array_key_exists('UserAppliedVacancy', $applicantDocs))
		{
			$file=$applicantDocs['UserAppliedVacancy']['acr_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/applicant_acrs/'.$file,array('download' => true, 'name' => 'applicant_acr.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant Vigilance done from officer module
	public function dwnld_applicants_vigls($id=null)
	{
		if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid Vigilance Ceritificate'));
		}
		
		$this->UserAppliedVacancy->Behaviors->load('Containable');
		$applicantDocs=$this->UserAppliedVacancy->find('first',array(
																	'conditions'=>array( 
																						'UserAppliedVacancy.id'=>$id,
																						'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																						),
																	'fields'=>array('id','vigl_pdf'),					
																	'contain'=>array(
																					 'Vacancy'=>array(
																									  'fields'=>array('id','created_by_orgn_id')
																									 ), 				 
																					)				
																						
																		)
													   );
		
		if(array_key_exists('UserAppliedVacancy', $applicantDocs))
		{
			$file=$applicantDocs['UserAppliedVacancy']['vigl_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/applicant_acrs/'.$file,array('download' => true, 'name' => 'applicant_vigilance_certificate.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant Cadre Certificate done from officer module
	public function dwnld_applicants_cadre_cert($id=null)
	{
		if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid Cadre Certificate'));
		}
		
		$this->UserAppliedVacancy->Behaviors->load('Containable');
		$applicantDocs=$this->UserAppliedVacancy->find('first',array(
																	'conditions'=>array( 
																						'UserAppliedVacancy.id'=>$id,
																						'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																						),
																	'fields'=>array('id','cadre_pdf'),					
																	'contain'=>array(
																					 'Vacancy'=>array(
																									  'fields'=>array('id','created_by_orgn_id')
																									 ), 				 
																					)				
																						
																		)
													   );
	
		if(array_key_exists('UserAppliedVacancy', $applicantDocs))
		{
			$file=$applicantDocs['UserAppliedVacancy']['cadre_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/applicant_acrs/'.$file,array('download' => true, 'name' => 'applicant_cadre_certificate.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
// Note:- if updating Action "approve_applying_user", do not forget to update Action "approve_applying_user_dp_dp" and "approve_applying_user_quali_docs" accordingly
   public function approve_applying_user()
   {											   
	 /* $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('all',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Call for Interview','Incomplete Documents'),
																					 ),
																		 //'fields'=>array('id','vacancy_id'),			 
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
																						                'fields'=>array('email'),
																										//'Organization'=>array('fields'=>'organization_name')
																						               ),																										  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r'),
																						                             )
																						 )					
	                                                                    )
													);
	  
	    //For Filtering on the basis of Organization and Present Employment Type 
	  $refinedResult=array();
	  
	  foreach($logInfoUsers as $log)
	  {
		  if(($log['LogInformationUser']['present_emp_type']=='Deputation' ||$log['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			
				if($log['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult[]=$log;
		  }
		  if(!($log['LogInformationUser']['present_emp_type']=='Deputation' || $log['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($log['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult[]=$log;
			  }
		  }
	  }

	  $applicants = $refinedResult;
	  
	$this->set(compact('applicants'));  */
	
	  
	  
	  $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  
	  $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
	 //if($userOrgnType!='MOS')
	  //{   
       //throw new NotFoundException('Invalid....');
	  //}	
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');
	 $organizations = $this->Organization->find('list',array(
	                                                         'conditions'=>array('organization_name !='=>'Others'),
	                                                         'fields'    =>'organization_name'
															 )
												); 
												
     
	 $this->UserAppliedVacancy->Vacancy->Behaviors->load('Containable');	  
	   
	   
	   $vacancyPosts =$this->UserAppliedVacancy->Vacancy->find('all',array('conditions'=>array(
	                                                                                          'Vacancy.created_by_orgn_id'=> $userOrgn
	                                                                                          ),
																	  'fields'=>array('post_id'),
                                                                      'contain'=>false																	  
														             )
												         );	  
	    
		$postsId = Hash::extract($vacancyPosts,'{n}.Vacancy.post_id');
		
	   $posts = $this->Post->find('list',array('fields'=>'post_name',
												'order'=>array('post_name'=>'ASC')
											   )
								 );
								 
	  
	  	   if(isset($this->request->query['post_id']))
		   {	

		   $userOrgn     = $this->Session->read('Auth.User.organization_id');
			$notId =	$this->request->query['post_id'];
			$vacancyid = $this->UserAppliedVacancy->Vacancy->find('all',array('conditions'=>array('Vacancy.organization_id'=>$userOrgn,
			'Vacancy.post_id'=>$notId
			),
	                                           'fields'=>array('notice_id')
											   )
								 );
			
			//pr($vacancyid);
			$vacanynoticeId = Hash::extract($vacancyid,'{n}.Vacancy.notice_id');
			
			$notices = $this->Notice->find('list',array('conditions'=>array('Notice.id'=>$vacanynoticeId,
			'Notice.created_by_orgn_id'=>$userOrgn
			),
	                                           'fields'=>array('id','advt_number'),
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
	else if(isset($this->request->query['notice_id']) && $this->Notice->exists($this->request->query['notice_id'])) 	 
	 {
	   $conditions['Vacancy.post_id'] = $this->request->query['post_id']; $conditions['Vacancy.notice_id'] = $this->request->query['notice_id'];	 
	 }
	 else {
	if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditions['Vacancy.post_id'] = $this->request->query['post_id'];
		//$conditions['Vacancy.notice_id'] = 'all';	   
	 }
	 }
	 
	 $conditions['UserAppliedVacancy.status'] = array('Submitted','Call for Interview','Incomplete Documents');
	 
	 $conditions['Vacancy.created_by_orgn_id'] = $userOrgn;
	  
	//pr($conditions);
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('all',array('conditions'=>$conditions,
																		 //'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		                  'Vacancy'=>array(
																						                   'fields'=>array(),
																						                   'Notice'=>array(
																										                   'fields'=>array('opening_date','closing_date','advt_number')
																														   ),
																										   'Post'=>array(
																										                 'fields'=>array('post_name')
																														)
																						                  ),
                                                                                          'User'=>array(
																						                'fields'=>array('email'),
																										//'Organization'=>array('fields'=>'organization_name')
																						               ),																										  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('f_name','m_name','l_name','organization_name','present_emp_type','current_organization_text','other_current_organization','present_post','other_orgn_name','d_o_r'),
																						                             )
																						 )					
	                                                                    )
													);
	  
	    //For Filtering on the basis of Organization and Present Employment Type 
	  $refinedResult=array();
	  
	  foreach($logInfoUsers as $log)
	  {
		  if(($log['LogInformationUser']['present_emp_type']=='Deputation' ||$log['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			
				if($log['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult[]=$log;
		  }
		  if(!($log['LogInformationUser']['present_emp_type']=='Deputation' || $log['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($log['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult[]=$log;
			  }
		  }
	  }

	  $applicants = $refinedResult;
	  
	$this->set(compact('organizations','posts','applicants','userOrgnType','notices'));
	
	
   }

   //if downloading Applicant Qualification Certificate done from admin(nodal officer) module
   public function dwnld_approve_applying_user_quali_docs($id=null)
   {											   
	  $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  if(!$this->UserAppliedVacancy->LogUserQualification->exists($id))
		{
			throw new NotFoundException(__('Invalid User Qualification Detail'));
		}
		
	  $this->UserAppliedVacancy->LogUserQualification->Behaviors->load('Containable');	
	  $applicantEduInfo=$this->UserAppliedVacancy->LogUserQualification->find('first',array(
																							'conditions'=>array( 
																												'LogUserQualification.id'=>$id,
																												'UserAppliedVacancy.status'=>array('Submitted','Call for Interview','Incomplete Documents')
																											   ),
																							'fields'=>array('id','user_applied_vacancy_id','edu_pdf'),					
																							'contain'=>array
																							               (
																										    'UserAppliedVacancy'=>array
																											                          (
																																	   'fields'=>array('status')
																											                           )
																							                )				
																						    )
																			   );
	  if(empty($applicantEduInfo))
	  {
		throw new NotFoundException('Inavlid.......');  
	  } 
	  																		   
	  $this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
	  $applicantInfo=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																						'conditions'=>array( 
																											'LogInformationUser.user_applied_vacancy_id'=>$applicantEduInfo['LogUserQualification']['user_applied_vacancy_id'],
																										   ),
																						'fields'=>array('id','user_applied_vacancy_id','present_emp_type','current_organization_text','organization_name'),					
																						'contain'=>false				
																						)
																		);
	  
	  
	  
	  $userBelongToNodalOfficerOrgn = false;
	  
	  if(($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			if($applicantInfo['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			        $userBelongToNodalOfficerOrgn= true;    
		  }
		  
	  if(!($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($applicantInfo['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $userBelongToNodalOfficerOrgn= true;
			  }
		  }
		  
		if(!$userBelongToNodalOfficerOrgn)
		{
		 throw new UnauthorizedException('Applicant Does not belong to your organization'); 	
		}
		
       if(array_key_exists('LogUserQualification', $applicantEduInfo))
		{
			$file=$applicantEduInfo['LogUserQualification']['edu_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'qualification.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}

   }
   
   //if downloading Applicant Experience Certificate done from admin(nodal officer) module
   public function dwnld_approve_applying_user_exp_docs($id=null)
   {											   
	  $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  if(!$this->UserAppliedVacancy->LogUserEmploymentDetail->exists($id))
		{
			throw new NotFoundException(__('Invalid User Employment Detail'));
		}
		
	  $this->UserAppliedVacancy->LogUserEmploymentDetail->Behaviors->load('Containable');	
	  $applicantEmplInfo=$this->UserAppliedVacancy->LogUserEmploymentDetail->find('first',array(
																							'conditions'=>array( 
																												'LogUserEmploymentDetail.id'=>$id,
																												'UserAppliedVacancy.status'=>array('Submitted','Call for Interview','Incomplete Documents')
																											   ),
																							'fields'=>array('id','user_applied_vacancy_id','exp_pdf'),					
																							'contain'=>array
																							               (
																										    'UserAppliedVacancy'=>array
																											                          (
																																	   'fields'=>array('status')
																											                           )
																							                )				
																						    )
																			   );
	  if(empty($applicantEmplInfo))
	  {
		throw new NotFoundException('Inavlid.......');  
	  } 
	  																		   
	  $this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
	  $applicantInfo=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																						'conditions'=>array( 
																											'LogInformationUser.user_applied_vacancy_id'=>$applicantEmplInfo['LogUserEmploymentDetail']['user_applied_vacancy_id'],
																										   ),
																						'fields'=>array('id','user_applied_vacancy_id','present_emp_type','current_organization_text','organization_name'),					
																						'contain'=>false				
																						)
																		);
	  
	  
	  
	  $userBelongToNodalOfficerOrgn = false;
	  
	  if(($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			if($applicantInfo['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			        $userBelongToNodalOfficerOrgn= true;    
		  }
		  
	  if(!($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($applicantInfo['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $userBelongToNodalOfficerOrgn= true;
			  }
		  }
		  
		if(!$userBelongToNodalOfficerOrgn)
		{
		 throw new UnauthorizedException('Applicant Does not belong to your organization'); 	
		}
	
       if(array_key_exists('LogUserEmploymentDetail', $applicantEmplInfo))
		{
			$file=$applicantEmplInfo['LogUserEmploymentDetail']['exp_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'experience_certificate.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
   }
   
   //if downloading Applicant write up 1 done from admin(nodal officer) module
   public function dwnld_approve_applying_user_write_up_1($id=null)
   {											   
	  $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
	  $this->UserAppliedVacancy->LogServiceAndBatchInfo->Behaviors->load('Containable');	
	  $applicantWriteUpInfo=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																							'conditions'=>array( 
																												'LogServiceAndBatchInfo.id'=>$id,
																												'UserAppliedVacancy.status'=>array('Submitted','Call for Interview','Incomplete Documents')
																											   ),
																							'fields'=>array('id','user_applied_vacancy_id','write_up_1'),					
																							'contain'=>array
																							               (
																										    'UserAppliedVacancy'=>array
																											                          (
																																	   'fields'=>array('status')
																											                           )
																							                )				
																						    )
																			   );
	  if(empty($applicantWriteUpInfo))
	  {
		throw new NotFoundException('Inavlid.......');  
	  } 
	  																		   
	  $this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
	  $applicantInfo=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																						'conditions'=>array( 
																											'LogInformationUser.user_applied_vacancy_id'=>$applicantWriteUpInfo['LogServiceAndBatchInfo']['user_applied_vacancy_id'],
																										   ),
																						'fields'=>array('id','user_applied_vacancy_id','present_emp_type','current_organization_text','organization_name'),					
																						'contain'=>false				
																						)
																		);
	  
	  
	  
	  $userBelongToNodalOfficerOrgn = false;
	  
	  if(($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			if($applicantInfo['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			        $userBelongToNodalOfficerOrgn= true;    
		  }
		  
	  if(!($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($applicantInfo['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $userBelongToNodalOfficerOrgn= true;
			  }
		  }
		  
		if(!$userBelongToNodalOfficerOrgn)
		{
		 throw new UnauthorizedException('Applicant Does not belong to your organization'); 	
		}
	
       if(array_key_exists('LogServiceAndBatchInfo', $applicantWriteUpInfo))
		{
			$file=$applicantWriteUpInfo['LogServiceAndBatchInfo']['write_up_1'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_1.pdf'));
			return $this->response;
		}
		else
		{	
		   throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
   }
   
   //if downloading Applicant write up 2 done from admin(nodal officer) module
   public function dwnld_approve_applying_user_write_up_2($id=null)
   {											   
	  $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
	  $this->UserAppliedVacancy->LogServiceAndBatchInfo->Behaviors->load('Containable');	
	  $applicantWriteUpInfo=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																							'conditions'=>array( 
																												'LogServiceAndBatchInfo.id'=>$id,
																												'UserAppliedVacancy.status'=>array('Submitted','Call for Interview','Incomplete Documents')
																											   ),
																							'fields'=>array('id','user_applied_vacancy_id','write_up_2'),					
																							'contain'=>array
																							               (
																										    'UserAppliedVacancy'=>array
																											                          (
																																	   'fields'=>array('status')
																											                           )
																							                )				
																						    )
																			   );
	  if(empty($applicantWriteUpInfo))
	  {
		throw new NotFoundException('Inavlid.......');  
	  } 
	  																		   
	  $this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
	  $applicantInfo=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																						'conditions'=>array( 
																											'LogInformationUser.user_applied_vacancy_id'=>$applicantWriteUpInfo['LogServiceAndBatchInfo']['user_applied_vacancy_id'],
																										   ),
																						'fields'=>array('id','user_applied_vacancy_id','present_emp_type','current_organization_text','organization_name'),					
																						'contain'=>false				
																						)
																		);
	  
	  
	  
	  $userBelongToNodalOfficerOrgn = false;
	  
	  if(($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			if($applicantInfo['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			        $userBelongToNodalOfficerOrgn= true;    
		  }
		  
	  if(!($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($applicantInfo['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $userBelongToNodalOfficerOrgn= true;
			  }
		  }
		  
		if(!$userBelongToNodalOfficerOrgn)
		{
		 throw new UnauthorizedException('Applicant Does not belong to your organization'); 	
		}
	
       if(array_key_exists('LogServiceAndBatchInfo', $applicantWriteUpInfo))
		{
			$file=$applicantWriteUpInfo['LogServiceAndBatchInfo']['write_up_2'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_2.pdf'));
			return $this->response;
		}
		else
		{	
		   throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
   }
   
   //if downloading Applicant caste certificate done from admin(nodal officer) module
   public function dwnld_approve_applying_user_caste_cert($id=null)
   {											   
	  $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid Applicant'));
		}
		
	  												  																		   
	  $this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
	  $applicantInfo=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																						'conditions'=>array( 
																											'LogInformationUser.user_applied_vacancy_id'=>$id,
																										   ),
																						'fields'=>array('id','user_applied_vacancy_id','present_emp_type','current_organization_text','organization_name','community','caste_pdf'),					
																						'contain'=>false				
																						)
																		);
	  
	  $userBelongToNodalOfficerOrgn = false;
	  
	  if(($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			if($applicantInfo['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			        $userBelongToNodalOfficerOrgn= true;    
		  }
		  
	  if(!($applicantInfo['LogInformationUser']['present_emp_type']=='Deputation' || $applicantInfo['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($applicantInfo['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $userBelongToNodalOfficerOrgn= true;
			  }
		  }
		  
		if(!$userBelongToNodalOfficerOrgn)
		{
		 throw new UnauthorizedException('Applicant Does not belong to your organization'); 	
		}
	    if($applicantInfo['LogInformationUser']['community']=='General')
		{
		 throw new NotFoundException('Applicants Community is General');	
		}
		
		if(empty($applicantInfo['LogInformationUser']['caste_pdf']))
		{
		 throw new NotFoundException('Caste Certificate is not uploaded by applicant');	
		}
       if(array_key_exists('LogInformationUser', $applicantInfo))
		{
			$file=$applicantInfo['LogInformationUser']['caste_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'community_cert.pdf'));
			return $this->response;
		}
		else
		{	
		   throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
   }
   
   
   
   public function approve_applying_user_dp($id=null)
   {
	   if (!$this->UserAppliedVacancy->exists($id)) {
			throw new NotFoundException(__('Invalid Application'));
		} 
	$nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               	  																					  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('profilepic','organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													); 
		
        if(empty($logInfoUsers))
		{
         throw new NotFoundException('Invalid....');			
		}
		
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
		if(empty($refinedResult))
		{
		 throw new NotFoundException('Invalid....');	
		}		
       
	   $applicant = $refinedResult;
        if(array_key_exists('LogInformationUser', $applicant))
		{
			if($applicant['LogInformationUser']['profilepic']!=NULL || $applicant['LogInformationUser']['profilepic']!='')
				$file=$applicant['LogInformationUser']['profilepic'];
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
   
                        //For PDF
	public function approve_applying_user_dp_for_pdf($id=null,$applicantType=null,$approvingOfficerOrgnId=null)
     {
	   if (!$this->UserAppliedVacancy->exists($id)) {
			throw new NotFoundException(__('Invalid Application'));
		}

       
	  if($applicantType!='approval')
	  {
		throw new MethodNotAllowedException('Invalid');  
	  }

      $this->Organization->Behaviors->load('Containable');
	  $approvingOfficerOrgnName = $this->Organization->find(
														    'first',
														            array(
																		  'conditions'=>array(
																		                      'Organization.id'=>$approvingOfficerOrgnId
																							 ),
																		   'fields'    =>'organization_name',					 
																	       'contain'=>false
                                                                         )																		   
														   );  
	  
	  $nodalOfficerOrgn = $approvingOfficerOrgnName['Organization']['organization_name'];
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               	  																					  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('profilepic','organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													); 
		
        if(empty($logInfoUsers))
		{
         throw new NotFoundException('Invalid....');			
		}
		
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
		if(empty($refinedResult))
		{
		 throw new NotFoundException('Invalid....');	
		}		
       
	   $applicant = $refinedResult;
        if(array_key_exists('LogInformationUser', $applicant))
		{
			if($applicant['LogInformationUser']['profilepic']!=NULL || $applicant['LogInformationUser']['profilepic']!='')
				$file=$applicant['LogInformationUser']['profilepic'];
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
   
   
   
   
   
   
   
   
   public function apporve_applying_user_sign($id=null)
   {
	 
	if (!$this->UserAppliedVacancy->exists($id)) {
			throw new NotFoundException(__('Invalid Application'));
		} 
	$nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               	  																					  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('profilesignature','organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													); 
		
        if(empty($logInfoUsers))
		{
         throw new NotFoundException('Invalid....');			
		}
		
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
		if(empty($refinedResult))
		{
		 throw new NotFoundException('Invalid....');	
		}		
       
	
	   $applicant = $refinedResult;
        if(array_key_exists('LogInformationUser', $applicant))
		{
			if($applicant['LogInformationUser']['profilesignature']!=NULL || $applicant['LogInformationUser']['profilesignature']!='')
				$file=$applicant['LogInformationUser']['profilesignature'];
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
   
   
                           //For PDF 
				   
   public function approve_applying_user_sign_for_pdf($id=null,$applicantType=null,$approvingOfficerOrgnId=null)
   {
	 
	if (!$this->UserAppliedVacancy->exists($id)) {
			throw new NotFoundException(__('Invalid Application'));
		}

    if($applicantType!='approval')
	  {
		throw new MethodNotAllowedException('Invalid');  
	  }
	

      $this->Organization->Behaviors->load('Containable');
	  $approvingOfficerOrgnName = $this->Organization->find(
														    'first',
														            array(
																		  'conditions'=>array(
																		                      'Organization.id'=>$approvingOfficerOrgnId
																							 ),
																		   'fields'    =>'organization_name',					 
																	       'contain'=>false
                                                                         )																		   
														   );  
	  
	  $nodalOfficerOrgn = $approvingOfficerOrgnName['Organization']['organization_name'];
	
	  
	  $trailData=array();
                    $trailData['ActionLog']=array(
                                                    'username'=>1,
                                                    'ip_address'=>'192.168.1.1',

                                                //   'session_id'=>$this->Session->id(),
                                                    'action_requested'=>$this->request->params['action'],
                                                    'full_url'=>serialize($this->request),
                                              //      'process_id'=>posix_getpid(),
                                                     'process_id'=>getmypid(),
                                                     'refferer_url'=> $nodalOfficerOrgn,
													 //$this->request->params['pass'][1],
													 //$this->request->referer(),
                                                     //'data_sent_in_request'=>serialize($this->request)
                                                    );
                    $this->ActionLog->create();
                    $this->ActionLog->save($trailData);
	  
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               	  																					  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('profilesignature','organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													); 
		
        if(empty($logInfoUsers))
		{
         throw new NotFoundException('Invalid....');			
		}
		
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
		if(empty($refinedResult))
		{
		 throw new NotFoundException('Invalid....');	
		}		
       
	   $applicant = $refinedResult;
        if(array_key_exists('LogInformationUser', $applicant))
		{
			if($applicant['LogInformationUser']['profilesignature']!=NULL || $applicant['LogInformationUser']['profilesignature']!='')
				$file=$applicant['LogInformationUser']['profilesignature'];
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


    public function my_active_application_sign_for_pdf($id=null,$applicantType=null,$applicantUserId=null)
	{
	  //pr($this->request->pass); 

	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
	   
	  if($applicantType!='active')
	  {
		throw new MethodNotAllowedException('Invalid');  
	  }

      if(!$this->UserAppliedVacancy->User->exists($applicantUserId))
	   {
		 throw new NotFoundException('Invalid User');  
	   }
	    
	  if($this->request->params['pass'][1]=='active')
	   {
		$applicantUserId  = $this->request->params['pass'][2] ;
	   }
		   
	  
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');   
	  $activeApplication = $this->UserAppliedVacancy->find('first',array(
																		'conditions'=>array(
																							'UserAppliedVacancy.id'=>$id,
																		                    'UserAppliedVacancy.user_id'=>$applicantUserId
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
				$file='default.png';
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
	 
	 $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               																									  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													);
	  //pr($logInfoUsers); 
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
	  
	   //pr($refinedResult); exit;
	  if(empty($refinedResult))
	  {
		throw new NotFoundException('Invalid....');  
	  } 
	  
	  $applicants = $refinedResult;
	  
	  //For Stopping the Admin from viewing other organization applications.
	 
	 if($applicants['UserAppliedVacancy']['id']!=$id)
	 {
		throw new NotFoundException('Invalid Application......'); 
	 } 
	 
	 //For Displaying The Content.
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 															   
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','organization_id'),
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
													
																										
													
													
	 	
	$this->set(compact('applyingUser','userEss','userDss','vacancyId','userId'));																			 
	}   
    
   public function upload_acrs($id=null)
    {
	 if(!$this->UserAppliedVacancy->exists($id))
	     {
		 throw new NotFoundException('Invalid Vacancy');  
	     }
     
	 //For Checking whether the User belongs to admin organization
	   
	   $nodalOfficerOrgn = $this->Session->read('Auth.User.organization_name');
	  
	  $this->UserAppliedVacancy->Behaviors->load('Containable');
	  
	  $logInfoUsers = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
																					 'UserAppliedVacancy.status'=>array('Submitted','Incomplete Documents','Call for Interview'),
																					 'UserAppliedVacancy.id'=>$id
																					 ),
																		 'fields'=>array('id','vacancy_id'),			 
																		 'contain'=>array(																									  
																		               																									  
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array('organization_name','present_emp_type','current_organization_text','other_current_organization','other_orgn_name'),
																						                             )
																						 )					
	                                                                    )
													);
	  //pr($logInfoUsers); 
	    //For Filtering on the basis of Organization and Present Employment Type 
	  if(($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' ||$logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
				if($logInfoUsers['LogInformationUser']['current_organization_text']==$nodalOfficerOrgn)
			           $refinedResult =$logInfoUsers;
		  }
		  if(!($logInfoUsers['LogInformationUser']['present_emp_type']=='Deputation' || $logInfoUsers['LogInformationUser']['present_emp_type']=='Transfer') )
		  {
			  if($logInfoUsers['LogInformationUser']['organization_name']==$nodalOfficerOrgn)
			  {
				   $refinedResult =$logInfoUsers;
			  }
		  }
	  
	   //pr($refinedResult); exit;
	  if(empty($refinedResult))
	  {
		throw new NotFoundException('Invalid....');  
	  } 
	  
	  $applicants = $refinedResult;
	  
	  //For Stopping the Admin from uploading other organization applicants documents.
	 
	 if($applicants['UserAppliedVacancy']['id']!=$id)
	 {
		throw new NotFoundException('Invalid Application......'); 
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
	 
	 
     if($this->request->is(array('post','put')))
       {
		$this->UserAppliedVacancy->id = $id;
		$this->request->data['UserAppliedVacancy']['docs_uploaded_on'] = $this->UserAppliedVacancy->getDataSource()->expression('NOW()');
       
		 $this->UserAppliedVacancy->validator()->remove('remarks');
		 $this->UserAppliedVacancy->validator()->remove('docs_uploaded_on');
		 $this->UserAppliedVacancy->validator()->remove('vigl_case_text');
		 $this->UserAppliedVacancy->validator()->remove('exp_feeder_grade');
		 $this->UserAppliedVacancy->validator()->remove('acr_status');
		 $this->UserAppliedVacancy->validator()->remove('remarks_by_officer');
		 
		 
		 
		 if($this->UserAppliedVacancy->save($this->request->data))
		 {
		  echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Documents has been Successfully uploaded....','default',array('class'=>'alert alert-success alert-dismissable')); 
		  return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'approve_applying_user'));     	 
		 }
         else
		 {	
          //pr($this->UserAppliedVacancy->invalidFields());	 
		  echo $this->Session->Setflash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Sorry,Unable to upload Documents....','default',array('class'=>'alert alert-danger alert-dismissable'));
		  //return $this->redirect(array('controller'=>'user_applied_vacancies','action'=>'approve_applying_user'));     	 	 
		 }	 
	   }
	   
	   
	    												
		$this->request->data=$userAppliedVacancies;	   
    }

     //For Monitoring User Applications 
    public function orgn_wise_user_applications_overview()
	{	
	 $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
	 if($userOrgnType!='MOS')
	  {   
       throw new NotFoundException('Invalid....');
	  }	
		
	 $organizations = $this->Organization->find('list',array(
	                                                         'conditions'=>array('organization_name !='=>'Others'),
	                                                         'fields'    =>'organization_name'
															 )
												);   
     $posts = $this->Post->find('list',array('fields'=>'post_name'));
	  		 
	 $filteredOrganization = null;
     $filteredPost = null;
      
	         //For Counting Submitted Applications
			 
     $conditionsSubmittedApplications = array();
     
     if(isset($this->request->query['organization_id']) && $this->Organization->exists($this->request->query['organization_id'])) 	 
	 { 
	   $conditionsSubmittedApplications['Vacancy.organization_id'] = $this->request->query['organization_id']; 	 
	 }
	 if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditionsSubmittedApplications['Vacancy.post_id'] = $this->request->query['post_id']; 	 
	 }
	 
	 if(isset($this->request->query['y_o_r'])&& ($this->request->query['y_o_r']!='all')) 	 
	 { 
	   $conditionsSubmittedApplications['Notice.year_of_recruitment'] = $this->request->query['y_o_r']; 	 
	 }
	 if(isset($this->request->query['notice_id']) && $this->UserAppliedVacancy->Vacancy->Notice->exists($this->request->query['notice_id'])) 	 
	 {
	   $conditionsSubmittedApplications['Vacancy.notice_id'] = $this->request->query['notice_id']; 	 
	 }
	 
	 
	 $conditionsSubmittedApplications['UserAppliedVacancy.status'] = 'Submitted';
	  
	
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $submittedApplications = $this->UserAppliedVacancy->find('count',
																			array('contain'=>array(
																								
																								'Vacancy'=>array('Notice')
																							),
																			'conditions'=>$conditionsSubmittedApplications,				
	                                                                       'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)
																		   
																		   )
															 );
     
	                //For Counting Incomplete Documents 
	 
	 $conditionsIncompleteDocuments = array();
     
     if(isset($this->request->query['organization_id']) && $this->Organization->exists($this->request->query['organization_id'])) 	 
	 { 
	   $conditionsIncompleteDocuments['Vacancy.organization_id'] = $this->request->query['organization_id']; 	 
	 }
	 if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditionsIncompleteDocuments['Vacancy.post_id'] = $this->request->query['post_id']; 	 
	 }
	 
	 if(isset($this->request->query['y_o_r'])&& ($this->request->query['y_o_r']!='all')) 	 
	 { 
	   $conditionsIncompleteDocuments['Notice.year_of_recruitment'] = $this->request->query['y_o_r']; 	 
	 }
	 if(isset($this->request->query['notice_id']) && $this->UserAppliedVacancy->Vacancy->Notice->exists($this->request->query['notice_id'])) 	 
	 {
	   $conditionsIncompleteDocuments['Vacancy.notice_id'] = $this->request->query['notice_id']; 	 
	 }
	 
	 $conditionsIncompleteDocuments['UserAppliedVacancy.status'] = 'Incomplete Documents';
	  
	
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $incompleteDocuments = $this->UserAppliedVacancy->find('count',array(
	                                                                       'contain'=>array(
																								
																								'Vacancy'=>array('Notice')
																							),
	                                                                       'conditions'=>$conditionsIncompleteDocuments,
                                                                           'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)	 
	                                                                       )
															 );
	 
	         
	 
	               //For Counting Called for Interview Applications 
	 $conditionsCallForInterview = array();
     
     if(isset($this->request->query['organization_id']) && $this->Organization->exists($this->request->query['organization_id'])) 	 
	 { 
	   $conditionsCallForInterview['Vacancy.organization_id'] = $this->request->query['organization_id']; 	 
	 }
	 if(isset($this->request->query['post_id']) && $this->Post->exists($this->request->query['post_id'])) 	 
	 {
	   $conditionsCallForInterview['Vacancy.post_id'] = $this->request->query['post_id']; 	 
	 }
	 
	 if(isset($this->request->query['y_o_r'])&& ($this->request->query['y_o_r']!='all')) 	 
	 { 
	   $conditionsCallForInterview['Notice.year_of_recruitment'] = $this->request->query['y_o_r']; 	 
	 }
	 if(isset($this->request->query['notice_id']) && $this->UserAppliedVacancy->Vacancy->Notice->exists($this->request->query['notice_id'])) 	 
	 {
	   $conditionsCallForInterview['Vacancy.notice_id'] = $this->request->query['notice_id']; 	 
	 }
	 
	 $conditionsCallForInterview['UserAppliedVacancy.status'] = 'Call for Interview';
	  
	
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $callForInterview = $this->UserAppliedVacancy->find('count',array(
	                                                                   'contain'=>array(
																								
																								'Vacancy'=>array('Notice')
																						),
	                                                                   'conditions'=>$conditionsCallForInterview,
                                                                       'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)	 
	                                                                       )
														);
	 
	 
	 $notices     = $this->UserAppliedVacancy->Vacancy->Notice->find('list',array('fields'=>array('id','selectOption'),
		                                                         'conditions'=>array(
																                     'Notice.vacancy_creation_status'=>'Created'
																                    )
																 )
												);
	 $yOrs     = $this->UserAppliedVacancy->Vacancy->Notice->find('list',array('fields'=>array('year_of_recruitment','year_of_recruitment'),
																			   'conditions'=>array(
																								   'Notice.vacancy_creation_status'=>'Created'
																								  ),
																				'group' => 'year_of_recruitment'				  
																			   )
																 );											
	 
     $this->set(compact('organizations','posts','submittedApplications','incompleteDocuments','callForInterview','notices','yOrs')); 	
	}

	public function vacanciesbyyearofrecruitment()
	 {	  
	  $this->layout=false;
	  
	  $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
	  
	  if($this->request->is('post'))
	  {
		$y_o_r =  $this->request->data['y_o_r'];
		if($y_o_r!='all')
		{
         
		 $notices     = $this->UserAppliedVacancy->Vacancy->Notice->find('list',array('fields'=>array('id','selectOption'),
																					 'conditions'=>array(
																										 'Notice.vacancy_creation_status'=>'Created',
																										 'Notice.year_of_recruitment'=>$y_o_r
																										)
																                    )
												                       );
        }
         
		if($y_o_r=='all')
		{	
		 $notices     = $this->UserAppliedVacancy->Vacancy->Notice->find('list',array('fields'=>array('id','selectOption'),
																					 'conditions'=>array(
																										 'Notice.vacancy_creation_status'=>'Created',
																										 )
																                    )
												                       );
        } 
		
										
	  }
	  $this->set('notices',$notices);  
	 }
	 
	 //New Applications to be checked by Monitoring Officer
   public function new_orgn_wise_user_applications_for_monitoring($orgnId=null,$postId=null,$yORecruit=null,$noticeId=null)
	{
     
	 $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
	 if($userOrgnType!='MOS')
	  {   
       throw new NotFoundException('Invalid....');
	  }
	 
	 
	 $conditions = array();
     
     if(!empty($orgnId) && $this->Organization->exists($orgnId)) 	 
	 {
	   $conditions['Vacancy.organization_id'] = $orgnId; 	 
	 }
	 if(!empty($postId) && $this->Post->exists($postId)) 	 
	 {
	   $conditions['Vacancy.post_id'] = $postId; 	 
	 }
	 
	 if(!empty($yORecruit)&& ($yORecruit!='all')) 	 
	 { 
	   $conditions['Notice.year_of_recruitment'] = $yORecruit; 	 
	 }
	 if(!empty($noticeId) && $this->UserAppliedVacancy->Vacancy->Notice->exists($noticeId)) 	 
	 {
	   $conditions['Vacancy.notice_id'] = $noticeId; 	 
	 }
	 
	 
	 $conditions['UserAppliedVacancy.status'] = 'Submitted';
	  
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $applicants = $this->UserAppliedVacancy->find('all',array('conditions'=>$conditions,
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('id','organization_id'),
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
																						  
																						 ),
																		  'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)				 
																		 				 
	                                                                    )
															);
	 
	 
	 
     $this->set(compact('applicants')); 
	}
	
	//Under Consideration Applications to be checked by Monitoring Officer 
	
	public function under_consideration_orgn_wise_user_applications_for_monitoring($orgnId=null,$postId=null,$yORecruit=null,$noticeId=null)
	{
     
	 $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
	 if($userOrgnType!='MOS')
	  {   
       throw new NotFoundException('Invalid....');
	  }
	 
	 
	 $conditions = array();
     
     if(!empty($orgnId) && $this->Organization->exists($orgnId)) 	 
	 {
	   $conditions['Vacancy.organization_id'] = $orgnId; 	 
	 }
	 if(!empty($postId) && $this->Post->exists($postId)) 	 
	 {
	   $conditions['Vacancy.post_id'] = $postId; 	 
	 }
	 
	 if(!empty($yORecruit)&& ($yORecruit!='all')) 	 
	 { 
	   $conditions['Notice.year_of_recruitment'] = $yORecruit; 	 
	 }
	 if(!empty($noticeId) && $this->UserAppliedVacancy->Vacancy->Notice->exists($noticeId)) 	 
	 {
	   $conditions['Vacancy.notice_id'] = $noticeId; 	 
	 }
	 
	 
	 $conditions['UserAppliedVacancy.status'] = 'Incomplete Documents';
	  
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $applicants = $this->UserAppliedVacancy->find('all',array('conditions'=>$conditions,
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('id','organization_id'),
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
																						  
																						 ),
																		  'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)				 
																		 				 
	                                                                    )
															);
	 
	 
	 
     $this->set(compact('applicants')); 
	}
	
	//Applicants Call for Interview to be checked by Monitoring Officer
	public function called_for_interview_orgn_wise_user_applications_for_monitoring($orgnId=null,$postId=null,$yORecruit=null,$noticeId=null)
	{
     
	 $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
	 if($userOrgnType!='MOS')
	  {   
       throw new NotFoundException('Invalid....');
	  }
	 
	 
	 $conditions = array();
     
     if(!empty($orgnId) && $this->Organization->exists($orgnId)) 	 
	 {
	   $conditions['Vacancy.organization_id'] = $orgnId; 	 
	 }
	 if(!empty($postId) && $this->Post->exists($postId)) 	 
	 {
	   $conditions['Vacancy.post_id'] = $postId; 	 
	 }
	 
	 if(!empty($yORecruit)&& ($yORecruit!='all')) 	 
	 { 
	   $conditions['Notice.year_of_recruitment'] = $yORecruit; 	 
	 }
	 if(!empty($noticeId) && $this->UserAppliedVacancy->Vacancy->Notice->exists($noticeId)) 	 
	 {
	   $conditions['Vacancy.notice_id'] = $noticeId; 	 
	 }
	 
	 
	 $conditions['UserAppliedVacancy.status'] = 'Call for Interview';
	  
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $applicants = $this->UserAppliedVacancy->find('all',array('conditions'=>$conditions,
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('id','organization_id'),
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
																						  
																						 ),
																		  'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)				 
																		 				 
	                                                                    )
															);
	 
	 
	 
     $this->set(compact('applicants')); 
	}
	
	 //Applicants Summary to be viewed by Monitoring Officer
   public function view_applicants_summary($orgnId=null,$postId=null,$yORecruit=null,$noticeId=null)
	{
     
	 $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
	 if($userOrgnType!='MOS')
	  {   
       throw new NotFoundException('Invalid....');
	  }
	 
	 
	 $conditions = array();
     
     if(!empty($orgnId) && $this->Organization->exists($orgnId)) 	 
	 {
	   $conditions['Vacancy.organization_id'] = $orgnId; 	 
	 }
	 if(!empty($postId) && $this->Post->exists($postId)) 	 
	 {
	   $conditions['Vacancy.post_id'] = $postId; 	 
	 }
	 
	 if(!empty($yORecruit)&& ($yORecruit!='all')) 	 
	 { 
	   $conditions['Notice.year_of_recruitment'] = $yORecruit; 	 
	 }
	 if(!empty($noticeId) && $this->UserAppliedVacancy->Vacancy->Notice->exists($noticeId)) 	 
	 {
	   $conditions['Vacancy.notice_id'] = $noticeId; 	 
	 }
	 
	 
	 //$conditions['UserAppliedVacancy.status'] = 'Submitted';
	  
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 
	 $applicants = $this->UserAppliedVacancy->find('all',array('conditions'=>$conditions,
																		 'contain'=>array(
																		                  'Vacancy'=>array(
																						                   'fields'=>array('id','organization_id'),
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
																		                  'LogInformationUser'=>array(
																						                              'fields'=>array(
																													                  'f_name',
																																	  'm_name',
																																	  'l_name',
																																	  'organization_name',
																																	  'present_emp_type',
																																	  'current_organization_text',
																																	  'other_current_organization',
																																	  'present_post',
																																	  'other_orgn_name',
																																	  'd_o_r',
																																	  'd_o_b',
																																	  'd_o_i_appoint',
																																	  'community'
																																	  )
																														),
																							'LogUserQualification'=>array(
																							                              'fields'=>array('education_qualification_name')
																														 )							
																						  
																						 ),
																		  'recursive'=>-1,
																		   'joins'=>array(
																							
																							array(
																									'table'=>'notices',
																									'alias'=>'Notice',
																									'type'=>'LEFT',
																									'conditions'=>array(
																									'Notice.id=Vacancy.notice_id'
																														)
             
																									),		
																		   
																							)				 
																		 				 
	                                                                    )
															);
	 
	 
	 
     $this->set(compact('applicants')); 
	}

	
	
	//For Monitoring Officer
	public function view_applicant_applied_vacancy($id=null)
	{
	  $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		  
	  if(!$this->UserAppliedVacancy->Vacancy->exists($id))
	  {
		throw new NotFoundException(__('Invalid Vacancy'));  
	  }
	  
	  $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
	  
	  
	  
	  //$currentDate = date('Y-m-d');
	 //Fetching The Data	
     $this->autoLayout=false;	 
	 $this->set('vacancy',$this->UserAppliedVacancy->Vacancy->find('first',array(
	                                                                             'conditions'=>array(
																				                     'Vacancy.id'=> $id,
	                                                                                                 'Vacancy.status'=>'Approved',
																				                    )
																				)
																   )
				);	 
     
	}
	 
	//if downloading Applicant ACRs done from Monitoring officer module
	public function dwnld_applicants_acrs_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid ACR'));
		}
		
		$this->UserAppliedVacancy->Behaviors->load('Containable');
		$applicantDocs=$this->UserAppliedVacancy->find('first',array(
																	'conditions'=>array( 
																						'UserAppliedVacancy.id'=>$id,
																						//'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																						),
																	'fields'=>array('id','acr_pdf'),					
																	'contain'=>array(
																					 'Vacancy'=>array(
																									  'fields'=>array('id','created_by_orgn_id')
																									 ), 				 
																					)				
																						
																		)
													   );
		
		if(array_key_exists('UserAppliedVacancy', $applicantDocs))
		{
			$file=$applicantDocs['UserAppliedVacancy']['acr_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/applicant_acrs/'.$file,array('download' => true, 'name' => 'applicant_acr.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant Vigilance done from Monitoring officer module
	public function dwnld_applicants_vigls_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid Vigilance Ceritificate'));
		}
		
		$userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		
		$this->UserAppliedVacancy->Behaviors->load('Containable');
		$applicantDocs=$this->UserAppliedVacancy->find('first',array(
																	'conditions'=>array( 
																						'UserAppliedVacancy.id'=>$id,
																						//'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																						),
																	'fields'=>array('id','vigl_pdf'),					
																	'contain'=>array(
																					 'Vacancy'=>array(
																									  'fields'=>array('id','created_by_orgn_id')
																									 ), 				 
																					)				
																						
																		)
													   );
		
		if(array_key_exists('UserAppliedVacancy', $applicantDocs))
		{
			$file=$applicantDocs['UserAppliedVacancy']['vigl_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/applicant_acrs/'.$file,array('download' => true, 'name' => 'applicant_vigilance_certificate.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant Cadre Certificate done from Monitoring officer module
	public function dwnld_applicants_cadre_cert_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->exists($id))
		{
			throw new NotFoundException(__('Invalid Cadre Certificate'));
		}
		
		$userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		
		$this->UserAppliedVacancy->Behaviors->load('Containable');
		$applicantDocs=$this->UserAppliedVacancy->find('first',array(
																	'conditions'=>array( 
																						'UserAppliedVacancy.id'=>$id,
																						//'Vacancy.created_by_orgn_id'=>$this->Session->read('Auth.User.organization_id')
																						),
																	'fields'=>array('id','cadre_pdf'),					
																	'contain'=>array(
																					 'Vacancy'=>array(
																									  'fields'=>array('id','created_by_orgn_id')
																									 ), 				 
																					)				
																						
																		)
													   );
	
		if(array_key_exists('UserAppliedVacancy', $applicantDocs))
		{
			$file=$applicantDocs['UserAppliedVacancy']['cadre_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/applicant_acrs/'.$file,array('download' => true, 'name' => 'applicant_cadre_certificate.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Qualification Docs done from Monitoring officer module
	public function dwnld_applicants_quali_docs_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->LogUserQualification->exists($id))
		{
			throw new NotFoundException(__('Invalid User Qualification Detail'));
		}
		
		$userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		
		$this->UserAppliedVacancy->LogUserQualification->Behaviors->load('Containable');
		$applicantEduInfo=$this->UserAppliedVacancy->LogUserQualification->find('first',array(
																							'conditions'=>array( 
																												'LogUserQualification.id'=>$id,
																											   ),
																							'fields'=>array('id','user_applied_vacancy_id','edu_pdf'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		
		
		if(array_key_exists('LogUserQualification', $applicantEduInfo))
		{
			$file=$applicantEduInfo['LogUserQualification']['edu_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'qualification.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
   
	//if downloading Applicant Experience Docs done from Monitoring officer module
	public function dwnld_applicants_exp_docs_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->LogUserEmploymentDetail->exists($id))
		{
			throw new NotFoundException(__('Invalid Employment Detail'));
		}
		
		$userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		
		$this->UserAppliedVacancy->LogUserEmploymentDetail->Behaviors->load('Containable');
		$applicantExpInfo=$this->UserAppliedVacancy->LogUserEmploymentDetail->find('first',array(
																							'conditions'=>array( 
																												'LogUserEmploymentDetail.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','exp_pdf'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
	
		if(array_key_exists('LogUserEmploymentDetail', $applicantExpInfo))
		{
			$file=$applicantExpInfo['LogUserEmploymentDetail']['exp_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'experience.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	
	//if downloading Applicant write up 1 done from Monitoring officer module
	public function dwnld_applicants_write_up_1_doc_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		
		$userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		
		$this->UserAppliedVacancy->LogServiceAndBatchInfo->Behaviors->load('Containable');
		$applicantWriteUpInfo=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																							'conditions'=>array( 
																												'LogServiceAndBatchInfo.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','write_up_1'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		
		
		if(array_key_exists('LogServiceAndBatchInfo', $applicantWriteUpInfo))
		{
			$file=$applicantWriteUpInfo['LogServiceAndBatchInfo']['write_up_1'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_1.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant write up 2 done from Monitoring officer module
	public function dwnld_applicants_write_up_2_doc_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->LogServiceAndBatchInfo->exists($id))
		{
			throw new NotFoundException(__('Invalid Write Up'));
		}
		  
		  $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
			 if($userOrgnType!='MOS')
			  {   
			   throw new NotFoundException('Invalid....');
			  }
		  
		$this->UserAppliedVacancy->LogServiceAndBatchInfo->Behaviors->load('Containable');
		$applicantWriteUpInfo=$this->UserAppliedVacancy->LogServiceAndBatchInfo->find('first',array(
																							'conditions'=>array( 
																												'LogServiceAndBatchInfo.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','write_up_2'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		
		if(array_key_exists('LogServiceAndBatchInfo', $applicantWriteUpInfo))
		{
			$file=$applicantWriteUpInfo['LogServiceAndBatchInfo']['write_up_2'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download' => true, 'name' => 'write_up_2.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
	//if downloading Applicant Caste Certificate done from Monitoring officer module
	public function dwnld_applicants_caste_cert_by_monitoring_officer($id=null)
	{
		if(!$this->UserAppliedVacancy->LogInformationUser->exists($id))
		{
			throw new NotFoundException(__('Invalid Caste Certificate'));
		}
		
		$userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
		
		$this->UserAppliedVacancy->LogInformationUser->Behaviors->load('Containable');
		$applicantCasteCert=$this->UserAppliedVacancy->LogInformationUser->find('first',array(
																							'conditions'=>array( 
																												'LogInformationUser.id'=>$id,
																												),
																							'fields'=>array('id','user_applied_vacancy_id','caste_pdf'),					
																							'contain'=>array(
																											 'UserAppliedVacancy'=>array(
																															             'fields'=>array('id','vacancy_id')
																															            ), 				 
																											)				
																												
																								)
																			   );
		
		
		if(array_key_exists('LogInformationUser', $applicantCasteCert))
		{
			$file=$applicantCasteCert['LogInformationUser']['caste_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download' => true, 'name' => 'community_cert.pdf'));
			return $this->response;
		}
		else
		{	
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}	
	}
	
   public function submitted_application_for_monitoring_officer($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }		  
	  
      $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }	  
	 
	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
	
	public function submitted_application_dp_for_monitoring_officer($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }		  
	   
	   $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
		 if($userOrgnType!='MOS')
		  {   
		   throw new NotFoundException('Invalid....');
		  }
	 
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
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilepic']!=NULL || $applyingUser['LogInformationUser']['profilepic']!='')
			$file=$applyingUser['LogInformationUser']['profilepic'];
		else
			$file='default.png';
		$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
		//pr($this->request);exit;
		return $this->response;
	}
	else
	{
		throw new LogicException();
	}
}

public function submitted_application_sign_for_monitoring_officer($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }		  
     
        $userOrgnType  =  $this->Session->read('Auth.User.Organization.organization_type');	
			 if($userOrgnType!='MOS')
			  {   
			   throw new NotFoundException('Invalid....');
			  }	 
     
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
	
		
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilesignature']!=NULL || $applyingUser['LogInformationUser']['profilesignature']!='')
			$file=$applyingUser['LogInformationUser']['profilesignature'];
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

  // Submitted Application Pdf for Application Monitoring Officer
	 
    public function submitted_application_pdf_for_monitoring_officer($id=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }

    	 
	 $this->layout=false;
	
     // initializing mPDF
    $this->Mpdf->init();

    // setting filename of output pdf file
    $this->Mpdf->setFilename('Applicant Profile.pdf');

    // setting output to I, D, F, S
    $this->Mpdf->setOutput('D');
	//$this->Mpdf->SetDisplayMode('fullpage');
    // you can call any mPDF method via component, for example:
    $this->Mpdf->SetWatermarkText("Draft");
	//$stylesheet = file_get_contents('../webroot/css/bootstrap/css/bootstrap.min.css');
	
	//$this->Mpdf->WriteHTML($stylesheet,1);
	 
     $userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $this->Session->read('Auth.User.organization_id');
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  'Notice'=>array('fields'=>array('advt_number','closing_date')),
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
							
	 $this->set(compact('applyingUser','userEss','userDss','userId','vacancyId','userOrgn'));																			 
	 $this->render('submitted_application_for_verification_pdf_for_monitoring_officer');
	 
	} 

	// Submitted Application DP Pdf for Application Monitoring Officer
	
	public function submitted_application_dp_for_pdf_for_monitoring_officer($id=null,$applicationType=null,$officerOrgnId=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }
       
       if(!$this->Organization->exists($officerOrgnId))
	   {
		 throw new NotFoundException('Invalid Organization');  
	   }
      
       if($applicationType!='verifying_officer')	  
	   {
		throw new MethodNotAllowedException('Invalid');    
	   }
	   
     //$userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $officerOrgnId ;
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	

	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilepic']!=NULL || $applyingUser['LogInformationUser']['profilepic']!='')
			$file=$applyingUser['LogInformationUser']['profilepic'];
		else
			$file='default.png';
		$this->response->file(WWW_ROOT .'/uploads/userimages/'.$file);
		//pr($this->request);exit;
		return $this->response;
	}
	else
	{
		throw new LogicException();
	}
 }

 // Submitted Application Sign Pdf for Application Monitoring Officer
 public function submitted_application_sign_for_pdf_for_monitoring_officer($id=null,$applicationType=null,$officerOrgnId=null)
	{
	  if(!$this->UserAppliedVacancy->exists($id))
	   {
		 throw new NotFoundException('Invalid Application');  
	   }

     if(!$this->Organization->exists($officerOrgnId))
	   {
		 throw new NotFoundException('Invalid Organization');  
	   }
     if($applicationType!='verifying_officer')	  
	   {
		throw new MethodNotAllowedException('Invalid');    
	   }	   
	 
     //$userOrgnType = $this->Session->read('Auth.User.Organization.organization_type');													
	 $userOrgn     = $officerOrgnId;
 	 
	 $this->UserAppliedVacancy->Behaviors->load('Containable');
	 $applyingUser = $this->UserAppliedVacancy->find('first',array('conditions'=>array(
	                                                                                   'UserAppliedVacancy.id'=>$id
	                                                                                   ),
																	'contain'=>array(
																	                 'Vacancy'=>array(
																					                  'fields'=>array('id','created_by_orgn_id'),
																									  
																						              'Organization'=>array('fields'=>array('organization_name')),
																						              
																								  ),
																					 			  
																					 'LogInformationUser',
                                                                                     																					 
																					 )				   
																	)
												    );
	
	
	
	if(array_key_exists('LogInformationUser', $applyingUser))
	{
		if($applyingUser['LogInformationUser']['profilesignature']!=NULL || $applyingUser['LogInformationUser']['profilesignature']!='')
			$file=$applyingUser['LogInformationUser']['profilesignature'];
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

	
}