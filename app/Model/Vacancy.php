<?php
App::uses('AppModel','Model');

class Vacancy extends AppModel
{
 public $belongsTo = array(
                      'Notice' => array(
					                'className' => 'Notice',
									'foreignKey'=> 'notice_id',
									'conditions' => '',
						     		'fields' => '',
							    	'order' => ''
									   ),
                      'Post'  => array(
					                'className' => 'Post',
									'foreignKey'=> 'post_id',
									'conditions' => '',
						     		'fields' => '',
							    	'order' => ''
									   ), 		
                      'Organization'  => array(
					                'className' => 'Organization',
									'foreignKey'=> 'organization_id',
									'conditions' => '',
						     		'fields' => '',
							    	'order' => ''
									   ), 				
						'Department'  => array(
					                'className' => 'Department',
									'foreignKey'=> 'department_id',
									'conditions' => '',
						     		'fields' => '',
							    	'order' => ''
									   ), 					  
                        'PayScale'  => array(
					                'className' => 'PayScale',
									'foreignKey'=> 'pay_scale_id',
									'conditions' => '',
						     		'fields' => '',
							    	'order' => ''
									   ) 					
					);  
					
	public $hasAndBelongsToMany	= array(
			'EducationQualification'  =>array(
											    'className'=>'EducationQualification',
											    'joinTable' => 'education_qualifications_vacancies',
												'foreignKey' => 'vacancy_id',
												'associationForeignKey'=>'education_qualification_id',
												'unique'  => 'keepExisting',
												'dependent' => true,
												'conditions' => '',
												'fields' => '',
												'order' => '',
												'limit' => '',
												'offset' => '',
												'exclusive' => '',
												'finderQuery' => '',
												'counterQuery' => ''
														  ),
  			             'User'        =>array(
											    'className'=>'User',
											    'joinTable' => 'user_applied_vacancies',
												'foreignKey' => 'vacancy_id',
												'associationForeignKey'=>'user_id',
												'unique'  => 'keepExisting',
												'dependent' => true,
												'conditions' => '',
												'fields' => '',
												'order' => '',
												'limit' => '',
												'offset' => '',
												'exclusive' => '',
												'finderQuery' => '',
												'counterQuery' => ''
														  ),
						 'Essential'       =>array(
											    'className'=>'Essential',
											    'joinTable' => 'vacancies_essentials',
												'foreignKey' => 'vacancy_id',
												'associationForeignKey'=>'essential_id',
												'unique'  => 'keepExisting',
												'dependent' => true,
												'conditions' => '',
												'fields' => '',
												'order' => '',
												'limit' => '',
												'offset' => '',
												'exclusive' => '',
												'finderQuery' => '',
												'counterQuery' => ''
														  ),
                         'Desirable'       =>array(
											    'className'=>'Desirable',
											    'joinTable' => 'vacancies_desirables',
												'foreignKey' => 'vacancy_id',
												'associationForeignKey'=>'desirable_id',
												'unique'  => 'keepExisting',
												'dependent' => true,
												'conditions' => '',
												'fields' => '',
												'order' => '',
												'limit' => '',
												'offset' => '',
												'exclusive' => '',
												'finderQuery' => '',
												'counterQuery' => ''
														  )														  
														  
									);
									
									
	public $validate = array(

							'id' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'Vacancy id is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Vacancy id should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Vacancy id must be greater than 0.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Vacancy id is out of range.'
											)
										),
                            
                            'organization_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Organization id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Organization id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Organization id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Organization id is out of range.'
													),
													
													
												),
							'department_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Department id is required.',
														'allowEmpty' => true
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Department id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Department id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Department id is out of range.'
													),
													
													
												),
							'notice_id' => array(
											'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'Notice id is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Notice id should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Notice id must be greater than 0.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Notice id is out of range.'
											),
											'unique'=>array(
											               'rule'=>array('isUnique'),
														   'message'=>'Vacancy already created for this Notice'
											 )
											
											
										),					

                            'post_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Post id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Post id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Post id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Post id is out of range.'
													),
													
													
												),
							'classification' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Classification is required.',
															'allowEmpty' => false
														),
														
														'alphaNumericDashUnderscore' => array(
															'rule'    => array('alphaNumericDashUnderscore'),
															'message' => 'Classification can contain only letters, numbers and underscores.'
														),
														'maxLength'=>array(
															'rule' => array('maxLength', 10),
															'message'=>'Classification not more than 10 characters.'
														)
													),					
							
							'recruitment_method'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Recruitment Method.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('All India Services', 'Ports', 'Both(AIS & Ports)','AIS & CCS Group A Services','Composite','Deputation','Direct')),
																		 'message' => 'Please select valid Recruitment Method.'
																		)
											),
							'age_limit'	=>	array(
														
														'chkifDirect' => array(
																					'rule'    => array('chkifDirect'),
																					'message' => 'Please enter minimum age required.'
																				),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Minimum Age Limit is required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Minimum age required should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Minimum age required must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',80),
															    			'message' => 'Minimum age required is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 2),
																			'message'=>'Minimum Age not more than 2 digits.'
																		  )				  
													),				
							'pay_scale_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Pay Scale id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Pay Scale id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Pay Scale id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Pay Scale id is out of range.'
													),
													
													
												),
							'post_category_wise'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select whether u want to add posts category wise or not.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Yes', 'No')),
																		 'message' => 'Please select valid option.'
																		)
											),
											
							'no_of_posts'	=>	array(
														
														'chkifNumOfPosts' => array(
																					'rule'    => array('chkifNumOfPosts'),
																					'message' => 'Please enter number of posts.'
																				),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Number of Posts are required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Number of Posts should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Number of Posts must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999),
															    			'message' => 'Number of Posts is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 3),
																			'message'=>'No. of Posts not more than 3 digits.'
																		  )				  
													),

                        'ur_vacancy_count'	=>	array(
														
														'chkifUR' => array(
																				'rule'    => array('chkifUR'),
																				'message' => 'Please enter unreserved posts.'
																		   ),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Unreserved Posts are required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Unreserved Posts should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Unreserved Posts must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999),
															    			'message' => 'Unreserved Posts is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 3),
																			'message'=>'Unreserved Posts not more than 3 digits.'
																		  )				  
													),
							
						'sc_vacancy_count'	=>	array(
														
														'chkifSc' => array(
																				'rule'    => array('chkifSc'),
																				'message' => 'Please enter sc posts.'
																		   ),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Sc Posts are required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Sc Posts should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Sc Posts must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999),
															    			'message' => 'Sc Posts is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 3),
																			'message'=>'Sc Posts not more than 3 digits.'
																		  )				  
													),	
			        'st_vacancy_count'	=>	array(
														
														'chkifSt' => array(
																				'rule'    => array('chkifSt'),
																				'message' => 'Please enter St posts.'
																		   ),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'St Posts are required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'St Posts should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'St Posts must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999),
															    			'message' => 'St Posts is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 3),
																			'message'=>'St Posts not more than 3 digits.'
																		  )				  
													),
					'obc_vacancy_count'	=>	array(
														
														'chkifObc' => array(
																				'rule'    => array('chkifObc'),
																				'message' => 'Please enter OBC posts.'
																		   ),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'OBC Posts are required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'OBC Posts should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'OBC Posts must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999),
															    			'message' => 'OBC Posts is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 999),
																			'message'=>'OBC Posts not more than 3 digits.'
																		  )				  
													),								
 		            'others_vacancy_count'	=>	array(
														
														'chkifOthers' => array(
																				'rule'    => array('chkifOthers'),
																				'message' => 'Please enter others posts.'
																		   ),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Others Posts are required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Others Posts should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Others Posts must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999),
															    			'message' => 'Others Posts is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 3),
																			'message'=>'Others Posts not more than 3 digits.'
																		  )				  
													),
					'probation_period'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Deputation Period should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Deputation Period must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',99),
															    			'message' => 'Deputation Period is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 2),
																			'message'=>'Deputation Period not more than 2 digits.'
																		  )				  
													),								
					   'exp_require'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Minimum Experience Required for the post should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Minimum Experience Required for the post must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',99),
															    			'message' => 'Minimum Experience Required for the post is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 2),
																			'message'=>'Minimum Experience required not more than 2 digits.'
																		  )				  
													),	
                        'exp_details' => array(
													'nonEmpty' => array(
														                'rule' => array('notEmpty'),
														                'message' => 'Experience Details are required.',
														                'allowEmpty' => false
													                   ),
			
													'between' => array(
														               'rule' => array('between', 2, 2000),
														               'required' => true,
														               'message' => 'Experience Details must be between 2 to 2000 characters.'
													                  ),
													'pattern'=>array (
													                  'rule'      => '/^[a-zA-Z0-9\s\n,-.]+$/',
													                  'message'   => 'Please enter alphanumeric characters only. Special characters(, . and - ), space is allowed.'
													                 ),
            
                                              ), 
						'other_details' => array(
													'nonEmpty' => array(
														                'rule' => array('notEmpty'),
														                //'message' => 'Other Details are required.',
														                'allowEmpty' => true
													                   ),
			
													'between' => array(
														               'rule' => array('between', 2, 2000),
														               'required' => true,
														               'message' => 'Other Details must be between 2 to 2000 characters.'
													                  ),
													'pattern'=>array (
													                  'rule'      => '/^[a-zA-Z0-9\s\n,-.]+$/',
													                  'message'   => 'Please enter alphanumeric characters only. Special characters(, . and - ), space is allowed.'
													                 ),
            
                                              ), 
						'status' =>      array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select the status.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Drafted','Waiting Approval','Approved','Approval Cancel','Archived')),
																		 'message' => 'Please select valid option.'
																		)
											),
						'active_upto' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													//'message' => ' Active Upto is required.',
													'allowEmpty'=>true
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),
						'reason_not_to_approve' => array(
						                            'chkifApprovalCancel'=>array(
													                             'rule'=>array('chkifApprovalCancel'),
																				 'message'=>'Please enter reason not to approve.'
																				),
													'nonEmpty' => array(
														                'rule' => array('notEmpty'),
														                'message' => 'Reason Not to approve is required.',
														                'allowEmpty' => true
													                   ),
			
													'between' => array(
														               'rule' => array('between', 3, 300),
														               'required' => true,
														               'message' => 'Reason Not to approve must be between 3 to 100 characters.'
													                  ),
													'pattern'=>array (
													                  'rule'      => '/^[a-zA-Z\s\n.,-]+$/',
													                  'message'   => 'Please enter alphabets only. Special characters(, . and - ), space is allowed.'
													                 ),
            
                                              ),					
                        'created_on' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Created time is required.'
												),
												'datetime' => array(
													'rule' => 'datetime',
													'message' => 'Enter a valid date and time.'
												)
		                                    ),
						'created_by_user_id' => array(
							                          'nonEmpty' => array(
																		  'rule' => array('notEmpty'),
																		  'message' => 'Created By user id is required.',
																		  'allowEmpty' => false
													                     ),
													    'numeric' => array(
														                    'rule' => array('numeric'),
														                    'message' => 'Created by user id should be numeric.'
													                      ),
							                            'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Created by user id must be greater than 0.'
							                                             ),
														'maxValue'=>array(
															                 'rule'=>array('comparison', '<=', 4294967295),
															                 'message' => 'Created by user id is out of range.'
														)
		                                            ),
					    'created_by_orgn_id' => array(
							                          'nonEmpty' => array(
																		  'rule' => array('notEmpty'),
																		  'message' => 'Created By organization id is required.',
																		  'allowEmpty' => false
													                     ),
													    'numeric' => array(
														                    'rule' => array('numeric'),
														                    'message' => 'Created by organization id should be numeric.'
													                      ),
							                            'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Created by organization id must be greater than 0.'
							                                             ),
														'maxValue'=>array(
															                 'rule'=>array('comparison', '<=', 4294967295),
															                 'message' => 'Created by organization id is out of range.'
														)
		                                            ),
		
						'modified_by_user_id' => array(
							                           'numeric' => array(
																			'rule' => array('numeric'),
																			 'allowEmpty' => true,
																			'message' => 'Updated by user id should be numeric.'
																		),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Updated by user id must be greater than 0.'
														                 ),
														'maxValue'=>array(
																			'rule'=>array('comparison', '<=', 4294967295),
																			'message' => 'Updated by user id is out of range.'
														                 )
		                                              ),
						'modified_by_orgn_id' => array(
							                           'numeric' => array(
																			'rule' => array('numeric'),
																			'allowEmpty' => true,
																			'message' => 'Updated by organization id should be numeric.'
																		),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Updated by organization id must be greater than 0.'
														                 ),
														'maxValue'=>array(
																			'rule'=>array('comparison', '<=', 4294967295),
																			'message' => 'Updated by organization id is out of range.'
														                 )
		                                              )							  
		);	

	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
		
        $value = array_values($check);
        $value = $value[0];
		
 
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }	
    									
            //For converting date format before save
	
	public function beforeSave($options = array()) {
		if (!empty($this->data['Vacancy']['active_upto']))
		  {

			$this->data['Vacancy']['active_upto'] = $this->dateFormatBeforeSave(
				$this->data['Vacancy']['active_upto']
			);
			
		  }
		return true;
      }

	public function dateFormatBeforeSave($dateString) {
		return date('Y-m-d', strtotime($dateString));
}
  //For Method Of Recruitment Age Limit
    public function chkifDirect($ageLimit)
	{ 
	 $methodOfRecruitment =	$this->data['Vacancy']['recruitment_method'];
	 if($methodOfRecruitment=='Direct')
	 {
		  if($ageLimit['age_limit']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
	
	//For No.of Posts without categorizing them
	
    public function chkifNumOfPosts($numPost)
	{
	 $postCategoryWise = $this->data['Vacancy']['post_category_wise'];
	 if($postCategoryWise=='No')
	 {
		  if($numPost['no_of_posts']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
       //For No. of Posts Category Wise
	   //For UR
    public function chkifUR($ur)
	{
	 $postCategoryWise = $this->data['Vacancy']['post_category_wise'];
	 if($postCategoryWise=='Yes')
	 {
		  if($ur['ur_vacancy_count']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}

	   //For No. of Posts Category Wise
	   //For Sc
    public function chkifSc($sc)
	{
	 $postCategoryWise = $this->data['Vacancy']['post_category_wise'];
	 if($postCategoryWise=='Yes')
	 {
		  if($sc['sc_vacancy_count']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
	
	   //For No. of Posts Category Wise
	   //For St
    public function chkifSt($st)
	{
	 $postCategoryWise = $this->data['Vacancy']['post_category_wise'];
	 if($postCategoryWise=='Yes')
	 {
		  if($st['st_vacancy_count']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
	
	   //For No. of Posts Category Wise
	   //For OBC
    public function chkifObc($obc)
	{
	 $postCategoryWise = $this->data['Vacancy']['post_category_wise'];
	 if($postCategoryWise=='Yes')
	 {
		  if($obc['obc_vacancy_count']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
	
	   //For No. of Posts Category Wise
	   //For Others
    public function chkifOthers($others)
	{
	 $postCategoryWise = $this->data['Vacancy']['post_category_wise'];
	 if($postCategoryWise=='Yes')
	 {
		  if($others['others_vacancy_count']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
	
	public function chkifApprovalCancel($reasonNotToApprove)
	{
	 $status = $this->data['Vacancy']['status'];
	 if($status=='Approval Cancel')
	 {
		  if($reasonNotToApprove['reason_not_to_approve']=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}
		
}
