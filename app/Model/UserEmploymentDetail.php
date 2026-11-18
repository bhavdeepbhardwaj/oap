<?php
App::uses('AppModel','Model');

class UserEmploymentDetail extends AppModel
{
 public $belongsTo = array(
                           'User'=> array(
						                  'className'=>'User',
										  'foreignKey' =>'user_id',
										  'conditions' =>'',
										  'fields'=>'',
										  'order'=>''
										  )
				           );	
						   
  public function beforeSave($options = array()) {
    if (!empty($this->data['UserEmploymentDetail']['from_date']) &&
        !empty($this->data['UserEmploymentDetail']['to_date'])
    ) {

        $this->data['UserEmploymentDetail']['from_date'] = $this->dateFormatBeforeSave(
            $this->data['UserEmploymentDetail']['from_date']
        );
        $this->data['UserEmploymentDetail']['to_date'] = $this->dateFormatBeforeSave(
            $this->data['UserEmploymentDetail']['to_date']
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
												'message' => 'User Employment Detail id is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'User Employment Detail id should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'User Employment Detail id must be greater than 0.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'User Employment Detail id is out of range.'
											),
											'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'User Employment Detail Id already exists.',
															'allowEmpty' => true
														),
										),
							'organization_name' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Organization name is required.',
															'allowEmpty' => false
														),
														
														'between' => array(
															'rule' => array('between', 3, 80),
															'required' => true,
															'message' => 'Organization Name must be between 3 to 80 characters.'
														),
														'pattern'=>array(
														 'rule'      => '/^[a-zA-Z\s]+$/',
														 'message'   => 'Please enter alphabets only. Space is allowed.'
														),
														
													),
							        'user_id' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'User id is required.',
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
							'post_held' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Post Name is required.',
														'allowEmpty' => false
													),
													
													'between' => array(
																	'rule' => array('between', 3, 80),
																	'required' => true,
																	'message' => 'Post Name must be between 3 to 80 characters.'
																),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z\s]+$/',
													 'message'   => 'Only alphabets and space are allowed.'
													),
													
												),
							'scale_of_pay' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Scale Of Pay is required.',
														'allowEmpty' => false
													),
													'pattern'=>array(
													 //'rule'      => '/^[1-9][0-9]{3,6}[-]{1}[1-9][0-9]{3,6}/',
													 'rule'      => '/^[0-9-]+$/',
													 'message'   => 'Only digits(0-9) and "-" are allowed.'
													),
													'maxLength'=>array(
													                   'rule' => array('maxLength', 20),
																	   'message' => 'Scale Of Pay Can not be more than 11 digits'
																	   )
													
												),						
							
			                'from_date' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'From Date is required.'
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),
							'to_date' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'To Date is required.'
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
											),	
							'nature_of_duties' => array(
													'between' => array(
														'rule' => array('between', 3, 200),
														'allowEmpty' => true,
														'message' => 'Nature of Duties must be between 3 to 200 characters.'
													),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z\s,-.]+$/',
													 'message'   => 'Only alphabets and space are allowed.Special Characters(. - ,) are only allowed'
													),
													
												),				
						    'exp_pdf' => array(
							
													'nonEmpty' => array(
																			'rule' => array('notEmpty'),
																			'message' => 'Please upload experience certificate.',
																			'allowEmpty' => false
																		),
													'extension'=>array(
																	  'rule' => array(
																					  'extension',
																								  array('pdf')
																					 ),
																	  'message' => 'Please upload a valid document.'	
													),
													'maxLength' => array(
																		 'rule' => array('maxLength', 200),
																		 'message' => 'Certificate filename must be 200 characters maximum.'
																		),
													'unique'	=> array(
																		 'rule'    => 'isUnique',
																		 'message' => 'Certificate file name should be Unique.'
																		),
																																	
												)			
										
								
							
		
 		);


						   
}