<?php 
App::uses('AppController','Controller');

class DashboardController extends AppController
{
      public function beforeFilter()
	  {
		parent::beforeFilter();
      } 	   
 public $uses = array('InformationUser','Vacancy','UserAppliedVacancy');  //For using Vacancy Model,Because it does not have its own model. 
 public function index()
 { 
      
 }
 public function approver_home()
 {
	$userOrgn = $this->Session->read('Auth.User.organization_id'); 
 
	$returnToElement=array();
	$returnToElement['waitingApproval']=$this->Vacancy->find('count',array('conditions'=>array('status'=>'Waiting Approval','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);
												
    $returnToElement['approved'] = $this->Vacancy->find('count',array('conditions'=>array('status'=>'Approved','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);
	
    $returnToElement['approvalCancel'] = $this->Vacancy->find('count',array('conditions'=>array('status'=>'Approval Cancel','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);	
    return $returnToElement;
 }

 public function creator_home()
 {
	$userOrgn = $this->Session->read('Auth.User.organization_id'); 
	
	$returnToElement=array();
	$returnToElement['drafted']=$this->Vacancy->find('count',array('conditions'=>array('status'=>'Drafted','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);
	
	$returnToElement['waitingApproval']=$this->Vacancy->find('count',array('conditions'=>array('status'=>'Waiting Approval','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);
	$returnToElement['approved']=$this->Vacancy->find('count',array('conditions'=>array('status'=>'Approved','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);
	$returnToElement['approvalCancel']=$this->Vacancy->find('count',array('conditions'=>array('status'=>'Approval Cancel','Vacancy.created_by_orgn_id'=>$userOrgn)
	                                                         )
												);
 
	
   	return $returnToElement;
 

 }
 
  function vacancy_applier_home()
   { 
    $returnToElement=array();
	// $returnToElement['userInfos'] = $this->InformationUser->find('first',array('conditions'=>array(
	                                                                                              // 'user_id'=>$this->Session->read('Auth.User.id')
																					             // ),
																				// 'fields'=>array('id','current_status')				 
	                                                              // )
												    // );
	$currentDate = date('Y-m-d');												
    $returnToElement['notices'] = $this->Vacancy->Notice->find('count',array(
	                                                                         'conditions'=>array('Notice.closing_date >=' => $currentDate) 
														                   )
															  );													
    $returnToElement['activeApplications'] = $this->UserAppliedVacancy->find('count',array('conditions'=>array(
																											   'UserAppliedVacancy.user_id'=>$this->Session->read('Auth.User.id')
	                                                                                                           )
																						   )
																			);
	$returnToElement['currentOpenings'] = $this->Vacancy->find('count',array('conditions'=>array('status'=>'Approved','Notice.opening_date <=' => $currentDate,'Notice.closing_date >=' => $currentDate)));																		
	return $returnToElement; 
   }
 
 public function vacancy_officer_home()
	{
	 $userOrgn = $this->Session->read('Auth.User.organization_id'); 
     
     $returnToElement=array();		
	 
	 $returnToElement['submittedApplications']=$this->UserAppliedVacancy->find('count',array('conditions'=>array('UserAppliedVacancy.status'=>'Submitted','Vacancy.created_by_orgn_id'=>$userOrgn)));
	 
	 //$returnToElement['acceptedApplications']=$this->UserAppliedVacancy->find('count',array('conditions'=>array('UserAppliedVacancy.status'=>'Accepted','Vacancy.created_by_orgn_id'=>$userOrgn)));
	 
	 //$returnToElement['rejectedApplications']=$this->UserAppliedVacancy->find('count',array('conditions'=>array('UserAppliedVacancy.status'=>'Not Eligible','Vacancy.created_by_orgn_id'=>$userOrgn)));
	 
     $returnToElement['underConsideration']=$this->UserAppliedVacancy->find('count',array('conditions'=>array('UserAppliedVacancy.status'=>'Incomplete Documents','Vacancy.created_by_orgn_id'=>$userOrgn)));

     $returnToElement['callForInterview']=$this->UserAppliedVacancy->find('count',array('conditions'=>array('UserAppliedVacancy.status'=>'Call for Interview','Vacancy.created_by_orgn_id'=>$userOrgn)));	 
     
	 return $returnToElement;	 
	}
}	