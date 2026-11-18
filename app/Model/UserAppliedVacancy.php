<?php
App::uses('AppModel','Model');

class UserAppliedVacancy extends AppModel
{
 public $belongsTo = array(
                            'Vacancy'=> array(
							                  'className'=>'Vacancy',
                             				  'foreignKey'=>'vacancy_id',
                                              'conditions'=>'',
                                              'order'=>'',
                                              'fields'=>''											  
											  ),
							'User'=>    array(
							                  'className'=>'User',
											  'foreignKey'=>'user_id',
											  'conditions'=>'',
											  'order'=>'',
											  'fields'=>''
											  )				  
							);
public $hasOne=array(
						'LogInformationUser'=>array(
						                            'className'=>'LogInformationUser',
											        'foreignKey'=>'user_applied_vacancy_id',
						                            'dependent'=>true,
													
													),
						'LogServiceAndBatchInfo'=>array(
						                            'className'=>'LogServiceAndBatchInfo',
											        'foreignKey'=>'user_applied_vacancy_id', 
													'dependent'=>true,
													
													)							
					);	
public $hasMany=array(
						'LogUserQualification'=>array(
						                              'dependent'=>true,
													  
													  ),
						'LogUserEmploymentDetail'=>array(
						                                 'dependent'=>true,
													    ),
						);
public $validate = array(
				'id' => array(
					 'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'User Applied Vacancy id is required.',
						'allowEmpty' => false
					),
					'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'User Applied Vacancy id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'User Applied Vacancy id must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'User Applied Vacancy id is out of range.'
					)
				),
				'vacancy_id' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Vacancy Id is required.',
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
				'user_id' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'User Id is required.',
						'allowEmpty' => false
					),
					'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'User id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'User id must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'User id is out of range.'
					)
					
				),
				'status'=>array(
									'nonEmpty' => array(
										'rule' => array('notEmpty'),
										'message' => 'Please select Status.',
										'allowEmpty' => false
									),
									
									'allowedChoice' => array(
															 'rule' => array('inList', array('Submitted','Incomplete Documents','Call for Interview')),
															 'message' => 'Please select valid Status.'
															)
								),
				'remarks' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Remarks for Applicant are required.',
						'allowEmpty' => false
					),
					
					'between' => array(
						'rule' => array('between', 3, 500),
						'required' => true,
						'message' => 'Remarks must be between 3 to 500 characters.'
					),
					'pattern'=>array(
								 'rule'      => '/^[a-zA-Z0-9\s,-.]+$/',
								 'message'   => 'Please enter alphanumeric characters only. Special charters(, and - ), space is allowed.'
								),
					
				),
				'acr_pdf' => array(
							
								'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Please upload ACR certificate.',
														'allowEmpty' => false
													),
								'extension'=>array(
												  'rule' => array(
																  'extension',
																			  array('pdf')
																 ),
												  'message' => 'Please upload a valid ACR certificate.'	
								),
								'maxLength' => array(
													 'rule' => array('maxLength', 200),
													 'message' => 'ACR certificate must be 200 characters maximum.'
													),
								'unique'	=> array(
													 'rule'    => 'isUnique',
													 'message' => 'ACR certificate name should be Unique.'
													),
																												
							),
				'vigl_pdf' => array(
							
								'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Please upload Vigilance certificate.',
														'allowEmpty' => false
													),
								'extension'=>array(
												  'rule' => array(
																  'extension',
																			  array('pdf')
																 ),
												  'message' => 'Please upload a valid Vigilance certificate.'	
								),
								'maxLength' => array(
													 'rule' => array('maxLength', 200),
													 'message' => 'Vigilance certificate must be 200 characters maximum.'
													),
								'unique'	=> array(
													 'rule'    => 'isUnique',
													 'message' => 'Vigilance certificate name should be Unique.'
													),
																												
							),
				'cadre_pdf' => array(
							
								'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Please upload Cadre certificate.',
														'allowEmpty' => false
													),
								'extension'=>array(
												  'rule' => array(
																  'extension',
																			  array('pdf')
																 ),
												  'message' => 'Please upload a valid Cadre certificate.'	
								),
								'maxLength' => array(
													 'rule' => array('maxLength', 200),
													 'message' => 'Cadre certificate must be 200 characters maximum.'
													),
								'unique'	=> array(
													 'rule'    => 'isUnique',
													 'message' => 'Cadre certificate name should be Unique.'
													),
																												
							),
							'docs_uploaded_on' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Docs Uploading Time is required.'
													),
													'datetime' => array(
														'rule' => 'datetime',
														'message' => 'Enter a valid date and time.'
													)
												),
							
							'vigl_case_text' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Vigilance/Disciplinary case,if any is required to be entered.',
													'allowEmpty' => false
												),
												
												'between' => array(
													'rule' => array('between', 3, 200),
													'required' => true,
													'message' => 'Vigilance/Disciplinary case must be between 3 to 200 characters.'
												),
												'pattern'=>array(
															 'rule'      => '/^[a-zA-Z0-9\s,-._()]+$/',
															 'message'   => 'Please enter alphanumeric characters only. Special charters(,._() and - ), space is allowed.'
															),
												
											),
							'exp_feeder_grade' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Experience in feeder grade is required.',
													'allowEmpty' => false
												),
												'maxLength' => array(
																	'rule' => array('maxLength',500),
																	'message' => 'Experience in feeder grade must be of 500 characters maximum.'
																),
												'between' => array(
													'rule' => array('between', 3, 500),
													'required' => true,
													'message' => 'Experience in feeder grade must be between 3 to 500 characters.'
												),
												'pattern'=>array(
															 'rule'      => '/^[a-zA-Z0-9()\n\s._,-]+$/',
															 'message'   => 'Please enter alphanumeric characters only. Special charters(,._() and - ), space is allowed.'
															),
												
											),
							'acr_status' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'ACR/APAR status is required.',
													'allowEmpty' => false
												),
												
												'between' => array(
													'rule' => array('between', 3, 500),
													'required' => true,
													'message' => 'ACR/APAR status must be between 3 to 500 characters.'
												),
												'pattern'=>array(
															 'rule'      => '/^[a-zA-Z0-9\n\s,-._()]+$/',
															 'message'   => 'Please enter alphanumeric characters only. Special charters(,._() and - ), space is allowed.'
															),
												
											),
						'eligiblity_position'=>array(
									'nonEmpty' => array(
										'rule' => array('notEmpty'),
										'message' => 'Please select Eligiblity Position.',
										'allowEmpty' => false
									),
									
									'allowedChoice' => array(
															 'rule' => array('inList', array('Eligible','Not Eligible')),
															 'message' => 'Please select valid eligiblity position.'
															)
								),
						'remarks_by_officer' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Remarks are required.',
													'allowEmpty' => false
												),
												
												'between' => array(
													'rule' => array('between', 3, 600),
													'required' => true,
													'message' => 'Remarks must be between 3 to 600 characters.'
												),
												'pattern'=>array(
															 'rule'      => '/^[a-zA-Z0-9\s,-._()]+$/',
															 'message'   => 'Please enter alphanumeric characters only. Special charters(,._() and - ), space is allowed.'
															),
												
											),		
			'applicant_status_last_updated_by_user_id' => array(
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
		'applicant_last_status_updated_on' => array(
													'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'message' => 'Applicant Status Updation Time is required.'
													),
													'datetime' => array(
																		'rule' => 'datetime',
																		'message' => 'Enter a valid date and time.'
													                   )
												   )								
						
											
	);						
}
