<?php
App::uses('AppModel','Model');

class Notice extends AppModel
{
	public $virtualFields = array(
									'selectOption' => 'CONCAT(Notice.advt_name, " (", Notice.advt_number,")")'
									);
   
    //For converting date format before save
	
	public function beforeSave($options = array()) {
    if (!empty($this->data['Notice']['opening_date']) &&
        !empty($this->data['Notice']['closing_date'])
    ) {

        $this->data['Notice']['opening_date'] = $this->dateFormatBeforeSave(
            $this->data['Notice']['opening_date']
        );
        $this->data['Notice']['closing_date'] = $this->dateFormatBeforeSave(
            $this->data['Notice']['closing_date']
        );
    }
    return true;
}

public function dateFormatBeforeSave($dateString) {
	
	
		return date('Y-m-d', strtotime($dateString));
		
	
}

     public $validate = array(

							'id' => array(
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
											'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'Notice Id already exists.',
															'allowEmpty' => true
														),
										),
							'advt_number' => array(
														 'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Advertisement number is required.',
															'allowEmpty' => false
														),
														'pattern'=>array(
																		 'rule'      => '/^[a-zA-Z0-9\/-]+$/',
																		 'message'   => 'Alphanumeric Characters and Special Character  "/,-" are only allowed.'
																		),
														'between' => array(
									                       'rule' => array('between', 3, 20),
									                       'allowEmpty' => true,
									                       'message' => 'Advertisement number must be between 3 to 20 characters.'
								                         ),
														
														'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'This advertisemnt number already exists.',
															'allowEmpty' => true
														),
														
													),
							'advt_name' => array(
													'between' => array(
														'rule' => array('between', 3, 80),
														'allowEmpty' => true,
														'message' => 'Advertisement name must be between 3 to 80 characters.'
													),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z\s]+$/',
													 'message'   => 'Only alphabets and space are allowed.'
													),
													
												),
			                'opening_date' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Vacancy Opening Date is required.'
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),
							'closing_date' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Vacancy Closing Date is required.'
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
											),				
							'year_of_recruitment'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Year Of Recruitment.',
													'allowEmpty' => false
												),
												'date' => array(
																 'rule' => array('date','y'),
																 'message' => 'Please select valid Year Of Recruitment.'
																)
												
											),
						    'advt_pdf' => array(
							
													'nonEmpty' => array(
																			'rule' => array('notEmpty'),
																			'message' => 'Please upload advertisement file.',
																			'allowEmpty' => false
																		),
													'extension'=>array(
																	  'rule' => array(
																					  'extension',
																								  array('pdf')
																					 ),
																	  'message' => 'Please upload a valid advertisement document.'	
													),
													'maxLength' => array(
																		 'rule' => array('maxLength', 200),
																		 'message' => 'Advertisement filename must be 200 characters maximum.'
																		),
													'unique'	=> array(
																		 'rule'    => 'isUnique',
																		 'message' => 'Advertisement file name should be Unique.'
																		),
																																	
												),					
			'vacancy_creation_status' => array(
												'nonEmpty' => array(
																	'rule' => array('notEmpty'),
																	'message' => 'Vacancy Creation Status is required.',
																	'allowEmpty' => false
																   ),
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Not Created', 'Created')),
																		 'message' => 'Select correct Vacancy Creation Status.'
																		)
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
    

}
