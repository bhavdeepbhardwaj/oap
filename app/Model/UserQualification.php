<?php
App::uses('AppModel','Model');

class UserQualification extends AppModel
{
	 public $belongsTo = array(
							   'User'=> array(
											  'className'=>'User',
											  'foreignKey' =>'user_id',
											  'conditions' =>'',
											  'fields'=>'',
											  'order'=>''
											  ),
					'EducationQualification'=>array(
													'className'=>'EducationQualification',
													'foreignKey'=>'education_qualification_id',
													'conditions' =>'',
													'fields'=>'',
													'order'=>''
													)			  
							   );

	public $virtualFields =array(
								 'education_qualification_name' => 'select education_qualification from education_qualifications where id = UserQualification.education_qualification_id'
								);		

	public $validate = array(

								'id' => array(
												 'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'User Qualification id is required.',
													'allowEmpty' => false
												),
												'numeric' => array(
													'rule' => array('numeric'),
													'message' => 'User Qualification id should be numeric.'
												),
												'minValue'=>array(
													'rule'=>array('comparison', '>', 0),
													'message' => 'User Qualification id must be greater than 0.'
												),
												'maxValue'=>array(
													'rule'=>array('comparison', '<=', 4294967295),
													'message' => 'User Qualification id is out of range.'
												)
											),
								'education_qualification_id' => array(
												 'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Qualification id is required.',
													'allowEmpty' => false
												),
												'numeric' => array(
													'rule' => array('numeric'),
													'message' => 'Qualification id should be numeric.'
												),
												'minValue'=>array(
													'rule'=>array('comparison', '>', 0),
													'message' => 'Qualification id must be greater than 0.'
												),
												'maxValue'=>array(
													'rule'=>array('comparison', '<=', 4294967295),
													'message' => 'Qualification id is out of range.'
												)
											),	
								'university' => array(
													'between' => array(
														'rule' => array('between', 2, 80),
														'allowEmpty' => true,
														'message' => 'University name must be between 2 to 80 characters.'
													),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z\s]+$/',
													 'message'   => 'Only alphabets and space are allowed.'
													),
													
												),
								'year'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Year Of Passing.',
													'allowEmpty' => false
												),
												'unique' => array(
																	'rule'    => array('isUnique',array('user_id','education_qualification_id','other_qualification','y_o_p'),false),
																	'message' => 'This education qualification already exists.',
																 ),
												'date' => array(
																 'rule' => array('date','y'),
																 'message' => 'Please select valid Year Of Passing.'
																)
												
											),	
								'class_type' => array(
																		'nonEmpty' => array(
																							'rule' => array('notEmpty'),
																							'message' => 'Class is required.',
																							'allowEmpty' => false
																						   ),
																		'allowedChoice' => array(
																								 'rule' => array('inList', array('Distinction', 'First Class','Second Class','Third Class')),
																								 'message' => 'Select correct Class.'
																								)
																		),	
								'perc_obtained' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'Percentage is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Percentage should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>=', 33),
												'message' => 'Percentage must be greater or equal to 33.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 100),
												'message' => 'Percentage is out of range.'
											)
										),	
								'special_subject' => array(
													'between' => array(
														'rule' => array('between', 3, 80),
														'allowEmpty' => true,
														'message' => 'Subject name must be between 3 to 80 characters.'
													),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z\s]+$/',
													 'message'   => 'Only alphabets and space are allowed.'
													),
													
												),	
								'other_qualification'	=>	array(
														
														'chkifOthers' => array(
																					'rule'    => array('chkifOthers'),
																					'message' => 'Please enter qualification.'
																				),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Qualification is required.',
																				'allowEmpty' => true
																			),	
														'between' => array(
																			'rule' => array('between', 3, 200),
																			'message' => 'Qualification name must be between 3 to 200 characters.'
																		),
														'pattern'=>array(
														 'rule'      => '/^[a-zA-Z\s]+$/',
														 'message'   => 'Only alphabets allowed. Space is allowed.'
														            ),					
													),

								'edu_pdf' => array(
							
													'nonEmpty' => array(
																			'rule' => array('notEmpty'),
																			'message' => 'Please upload education certificate.',
																			'allowEmpty' => false
																		),
													'extension'=>array(
																	  'rule' => array(
																					  'extension',
																								  array('pdf')
																					 ),
																	  'message' => 'Please upload a valid education certificate.'	
													),
													'maxLength' => array(
																		 'rule' => array('maxLength', 200),
																		 'message' => 'Education certificate must be 200 characters maximum.'
																		),
													'unique'	=> array(
																		 'rule'    => 'isUnique',
																		 'message' => 'Education certificate name should be Unique.'
																		),
																																	
												),					
							);			

	   //For checking Other Qualification
	public function chkifOthers($otherQualification)
	{
	 $userQualification=$this->EducationQualification->find('first',array(
																			'conditions'=>array(
																								'id'=>$this->data['UserQualification']['education_qualification_id']
																								),
																			'fields'=>array('education_qualification')
																		)
															);
		
	 if($userQualification['EducationQualification']['education_qualification']=='Others')
	 {
		  if($otherQualification['other_qualification']=='')
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