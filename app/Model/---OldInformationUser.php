<?php
App::uses('AppModel','Model');

class InformationUser extends AppModel
{
	
	/*public $validate=array(
	'period_of_appoint_dt' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date',
            'allowEmpty' => true
        ),
	'dt_appoint_date' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date',
            'allowEmpty' => true
        ),	
		);*/
	
public $virtualFields = array(
                              'birth_state' => 'select state_name from states where id=InformationUser.s_o_b',
							  'o_state_name'=> 'select state_name from states where id=InformationUser.o_state_id',
							  'o_city_name' => 'select city_name from cities where id=InformationUser.o_city_id',
							  'r_state_name' => 'select state_name from states where id=InformationUser.r_state_id',
                              'r_city_name' => 'select city_name from cities where id=InformationUser.r_city_id',
							  'r_city_name' => 'select city_name from cities where id=InformationUser.r_city_id',
							  'name_o_p_orgn_text' => 'select organization_name from organizations where id=InformationUser.name_o_p_orgn',
							  'current_organization_text' => 'select organization_name from organizations where id=InformationUser.current_organization',
							  'disability_name'           => 'select type_of_disability from disabilities where id=InformationUser.disability_id'
							 );
 public $belongsTo = array(
                           'User'=> array(
						                  'className'=>'User',
										  'foreignKey' =>'user_id',
										  'conditions' =>'',
										  'fields'=>'',
										  'order'=>'',
										  ),
						   'State'=> array(
										'className' => 'State',
										'foreignKey' => 's_o_b',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           ),
							'OState'=> array(
										'className' => 'State',
										'foreignKey' => 'o_state_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									         ),											 
						   'OCity'=> array(
										'className' => 'City',
										'foreignKey' => 'o_city_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									         ),
                            'RState'=> array(
										'className' => 'State',
										'foreignKey' => 'r_state_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									         ),											 
						   'RCity'=> array(
										'className' => 'City',
										'foreignKey' => 'r_city_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									        ),											   
                         'Nationality'=> array(
										'className' => 'Nationality',
										'foreignKey' => 'nationality_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           ),
						 'Disability'=> array(
										'className' => 'Disability',
										'foreignKey' => 'disability_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           )					   
				           );
						   
						   
   //For converting date format before save
	
	public function beforeSave($options = array()) {
		if(!empty($this->data['InformationUser']['dt_appoint_date']))
		{
			 $this->data['InformationUser']['dt_appoint_date'] = $this->dateFormatBeforeSave(
																								$this->data['InformationUser']['dt_appoint_date']
																							);
		}
         
		if(!empty($this->data['InformationUser']['d_o_i_appoint'])) 
		{
		  $this->data['InformationUser']['d_o_i_appoint'] = $this->dateFormatBeforeSave(
                                                                                        $this->data['InformationUser']['d_o_i_appoint']
                                                                                       );	
		}
		
		if(!empty($this->data['InformationUser']['d_o_r']))
		   {
			  $this->data['InformationUser']['d_o_r'] = $this->dateFormatBeforeSave(
																					$this->data['InformationUser']['d_o_r']
																					);
		   }
      
        if(!empty($this->data['InformationUser']['strt_dt_of_pay']))
		 {
		   $this->data['InformationUser']['strt_dt_of_pay'] = $this->dateFormatBeforeSave(
                                                                                          $this->data['InformationUser']['strt_dt_of_pay']
                                                                                          );	
		 }			
		if(!empty($this->data['InformationUser']['cont_reg_appoint_date']))
		  {
			$this->data['InformationUser']['cont_reg_appoint_date'] = $this->dateFormatBeforeSave(
                                                                                                  $this->data['InformationUser']['cont_reg_appoint_date']
                                                                                                 );   
		  }
       
        if(!empty($this->data['InformationUser']['d_o_b'])) 
		 {
		   $this->data['InformationUser']['d_o_b'] = $this->dateFormatBeforeSave(
																				$this->data['InformationUser']['d_o_b']
																			    );	
	     }			
       
        	   
		
    
    return true;
}

public function dateFormatBeforeSave($dateString) {
	
    //return date('Y-m-d', strtotime($dateString));
	return date_format(date_create($dateString),'Y-m-d');
}	

	public $validate = array( 
								'community'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Category.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('General', 'SC','ST','OBC','PWD','Others')),
																		 'message' => 'Please select valid Category.'
																		)
											),
								'd_o_b' => array(
														'notEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Date of birth is required.'
														),
														'date' => array(
															'rule' => array('date','dmy'),
															'message' => 'Enter a valid date.'
														)
													),
								's_o_b' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'State of birth is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'State id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'State id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'State id is out of range.'
													)
													
												),	
								'p_o_b' => array(
														'notEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Place of birth is required.',
															'allowEmpty' => false
														),
														'between' => array(
																'rule' => array('between', 2, 30),
																'message' => 'Place of birth must be between 2 to 30 characters.'
														),
														
													   'pattern'=>array(
														 'rule'      => '/^[a-zA-Z ]+$/',
														 'message'   => 'Place of bitrh should contain only alphabet and space.'
													  )
													),		
								'nationality_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Nationality is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Nationality id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Nationality id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Nationality id is out of range.'
													)
													
												),	
								'marital_status'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Marital Status.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Single', 'Married')),
																		 'message' => 'Please select valid Marital Status.'
																		)
											),
								'physically_challenged'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select whether Physically Challenged.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('No','Yes')),
																		 'message' => 'Please select valid option.'
																		)
											),
								'disability_id' => array(
						                            'chkifPhysicallyChallenged'=>array(
													                             'rule'=>array('chkifPhysicallyChallenged'),
																				 'message'=>'Please select type of disability.'
																				),
													'nonEmpty' => array(
														                'rule' => array('notEmpty'),
														                
														                'allowEmpty' => true
													                   ),
			                                        'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Disability id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Disability id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Disability id is out of range.'
													)
                                              ),
								'other_disability'=> array(
						                            'chkifDisabilityOthers'=>array(
													                             'rule'=>array('chkifDisabilityOthers'),
																				 'message'=>'Please enter other disability.'
																				),
													'nonEmpty' => array(
														                'rule' => array('notEmpty'),
														                'message' => 'Please enter other disability.',
														                'allowEmpty' => true
													                   ),
			
													'between' => array(
														               'rule' => array('between', 3, 300),
														               'required' => true,
														               'message' => 'Other Disability must be between 3 to 300 characters.'
													                  ),
													'pattern'=>array (
													                  'rule'      => '/^[a-zA-Z\s\n,-]+$/',
													                  'message'   => 'Please enter alphabets only. Special characters(, and - ), space is allowed.'
													                 ),
            
                                              ),
								'gender'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select gender.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Male','Female')),
																		 'message' => 'Please select valid option.'
																		)
											),
								 'o_address' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Address is required.',
															'allowEmpty' => false
														),
														 'alphabetnum' => array(
																				'rule'    => '/^[A-Za-z0-9-\s\n,]*$/',
																				'message' => 'Only Alphanumeric Characters and Special Characters  , and - are allowed.'
																			),
                                                   	     'between' => array(
																	'rule' => array('between', 3, 255),
																	'required' => true,
																	'message' => 'Official Address must be between 3 to 255 characters.'
																),																		
														
													),
								'o_state_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Official State Id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Official State id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Official State id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Official State id is out of range.'
													)
													
												),
								'o_city_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Official City Id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Official City id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Official City id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Official City id is out of range.'
													)
													
												),
								'o_pincode'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Official Pin Code is required.',
																				'allowEmpty' => false
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Official Pin Code should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Official Pin Code must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999999),
															    			'message' => 'Official Pin Code is out of range.'
													                      ),
														'minLength'=>array(
														                   'rule'=>array('minLength',6),
															    		   'message' => 'Official Pin Code Number not less than 8 digits.'
														                  ),				  
														'maxLength'=>array(
																			'rule' => array('maxLength', 6),
																			'message'=>'Official Pin Code not more than 6 digits.'
																		  )				  
													),
								'o_std_code'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Official Std Code is required.',
																				'allowEmpty' => false
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Official Std Code should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Official Std Code must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',9999),
															    			'message' => 'Official Std Code is out of range.'
													                      ),
														'minLength'=>array(
														                   'rule'=>array('minLength',3),
															    		   'message' => 'Official Std Code not less than 3 digits.'
														                  ),				  
														'maxLength'=>array(
																			'rule' => array('maxLength', 4),
																			'message'=>'Official Std Code not more than 4 digits.'
																		  )				  
													),
								'o_landline_num'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Official Landline Number is required.',
																				'allowEmpty' => false
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Official Landline Number should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Official Landline Number must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',9999999999),
															    			'message' => 'Official Landline Number is out of range.'
													                      ),
														'minLength'=>array(
														                   'rule'=>array('minLength',7),
															    		   'message' => 'Official Landline Number not less than 7 digits.'
														                  ),				  
														'maxLength'=>array(
																			'rule' => array('maxLength', 10),
																			'message'=>'Official Landline Number not more than 10 digits.'
																		  )				  
													),					
								'r_address' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Address is required.',
															'allowEmpty' => false
														),
														'between' => array(
																	'rule' => array('between', 3, 255),
																	'required' => true,
																	'message' => 'Residential Address must be between 3 to 255 characters.'
																),
														 'alphabetnum' => array(
																				'rule'    => '/^[A-Za-z0-9-\s\n,]*$/',
																				'message' => 'Only Alphanumeric Characters and Special Characters  , and - are allowed.'
																			),          
														
													),
								'r_state_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Residential State Id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Residential State id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Residential State id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Residential State id is out of range.'
													)
													
												),
								'r_city_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Residential City Id is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Residential City id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Residential City id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Residential City id is out of range.'
													)
													
												),
								'r_pincode'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Residential Pin Code is required.',
																				'allowEmpty' => false
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Residential Pin Code should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Residential Pin Code must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',999999),
															    			'message' => 'Residential Pin Code is out of range.'
													                      ),
														'minLength'=>array(
														                   'rule'=>array('minLength',6),
															    		   'message' => 'Residential Pin Code not less than 6 digits.'
														                  ),				  
														'maxLength'=>array(
																			'rule' => array('maxLength', 6),
																			'message'=>'Residential Pin Code not more than 6 digits.'
																		  )				  
													),
								'r_std_code'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Residential Std Code is required.',
																				'allowEmpty' => false
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Residential Std Code should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Residential Std Code must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',9999),
															    			'message' => 'Residential Std Code is out of range.'
													                      ),
														'minLength'=>array(
														                   'rule'=>array('minLength',3),
															    		   'message' => 'Residential Std Code not less than 3 digits.'
														                  ),				  
														'maxLength'=>array(
																			'rule' => array('maxLength', 4),
																			'message'=>'Residential Std Code not more than 4 digits.'
																		  )				  
													),
								'r_landline_num'	=>	array(
														
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Residential Landline Number is required.',
																				'allowEmpty' => false
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Residential Landline Number should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>=', 0),
																			'message' => 'Residential Landline Number must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',9999999999),
															    			'message' => 'Residential Landline Number is out of range.'
													                      ),
														'minLength'=>array(
														                   'rule'=>array('minLength',7),
															    		   'message' => 'Residential Landline Number not less than 7 digits.'
														                  ),				  
														'maxLength'=>array(
																			'rule' => array('maxLength', 10),
																			'message'=>'Residential Landline Number not more than 10 digits.'
																		  )				  
													),
								'r_mobile_number' => array(
														 'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Residential Mobile number is required.',
															'allowEmpty' => false
														),
														'numeric'=>array(
															'rule' => 'numeric',
															'allowEmpty' => false, //validate only if not empty
															'message'=>'Residential Mobile number should be numeric.'
															),
														'minLength'=>array(
															'rule' => array('minLength', 10),
															'allowEmpty' => false, //validate only if not empty
															'message'=>'Residential Mobile Number should be of 10 digits.'
														),
														'maxLength'=>array(
															'rule' => array('maxLength', 10),
															'allowEmpty' => false, //validate only if not empty
															'message'=>'Residential Mobile Number should be of 10 digits.'
														),
														'minValue'=>array(
															'rule'=>array('comparison', '>', 0),
															'message' => 'Residential Mobile Number must  be greater than 0.'
														),	
													),
								'd_o_i_appoint' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Date Of Initial Appointment is required.'
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),		
								'present_emp_type'=>array(
															'nonEmpty' => array(
																'rule' => array('notEmpty'),
																'message' => 'Please select type of present employment.',
																'allowEmpty' => false
															),
															
															'allowedChoice' => array(
																					 'rule' => array('inList', array('Ad-hoc','Deputation','Temporary','Transfer','Permanent')),
																					 'message' => 'Please select valid option.'
																					)
														),
								'dt_appoint_date'=>array(
								                         'chkifDTAppointdtempty'=>array(
																						 'rule'=>array('chkifDTAppointdtempty'),
																						 'message'=>'Please enter Initial Appointment Date(Deputation/Transfer Basis)'
																						),
														  'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'allowEmpty' => true
																	),
														  'date'=>array(
														               'rule'=>array('date','dmy'),
																	   'message'=>'Enter a valid date'
																	   )						
								                        ),
								'period_of_appoint_dt'	=>	array(
														'chkifDTAppointPeriodempty'=>array(
																						 'rule'=>array('chkifDTAppointPeriodempty'),
																						 'message'=>'Please enter Appointment Period(Deputation/Transfer Basis)'
																					   ),
														'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'allowEmpty' => true
																	),							   
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Appointment Period(Deputation/Transfer Basis) should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Appointment Period(Deputation/Transfer Basis) must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',99),
															    			'message' => 'Appointment Period(Deputation/Transfer Basis) is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 2),
																			'message'=>'Appointment Period(Deputation/Transfer Basis) not more than 2 digits.'
																		  )				  
													),
								'name_o_p_orgn' => array(
								                    'chkifDTParentOrgnempty'=>array(
																						 'rule'=>array('chkifDTParentOrgnempty'),
																						 'message'=>'Please select parent organization(Deputation/Transfer Basis)'
																					   ),
													'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'allowEmpty' => true
																	),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Parent Organization id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Parent Organization id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Parent Organization id is out of range.'
													)
													
												),
					'other_parent_organization'=> array(
						                            'chkifDTParentOrgnothers'=>array(
													                             'rule'=>array('chkifDTParentOrgnothers'),
																				 'message'=>'Please enter name of parent organization.'
																				),
													'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'allowEmpty' => true
																	),
													'between' => array(
														               'rule' => array('between', 3, 60),
														               'required' => true,
														               'message' => 'Name Of Parent Organization must be between 3 to 60 characters.'
													                  ),
													'pattern'=>array (
													                  'rule'      => '/^[a-zA-Z\s]+$/',
													                  'message'   => 'Only alphabets and space is allowed'
													                 ),
            
                                              ),				
								'current_organization' => array(
								                    'chkifDTCurrentOrgnempty'=>array(
																					 'rule'=>array('chkifDTCurrentOrgnempty'),
																					 'message'=>'Please select current organization(Deputation/Transfer Basis)'
																				   ),
													'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'allowEmpty' => true
																	),							   
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Current Organization should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Current Organization id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Current Organization id is out of range.'
													)
													
												),
								'other_current_organization'=> array(
						                            'chkifDTCurrentOrgnothers'=>array(
													                             'rule'=>array('chkifDTCurrentOrgnothers'),
																				 'message'=>'Please enter name of current organization(Others).'
																				),
													'nonEmpty' => array(
																		'rule' => array('notEmpty'),
																		'allowEmpty' => true
																	),							
													'between' => array(
														               'rule' => array('between', 3, 60),
														               'required' => true,
														               'message' => 'Name Of Current Organization must be between 3 to 60 characters.'
													                  ),
													'pattern'=>array (
													                  'rule'      => '/^[a-zA-Z\s]+$/',
													                  'message'   => 'Only alphabets and space is allowed'
													                 ),
            
                                              ),				
								'nature_of_present_emp' => array(
																'nonEmpty' => array(
																	'rule' => array('notEmpty'),
																	'message' => 'Nature Of Present Employment is required.',
																	'allowEmpty' => false
																),
																'maxLength' => array(
																	'rule' => array('maxLength',255),
																	'message' => 'Nature Of Present Employment must be of 255 characters maximum.'
																),
																'between' => array(
																			   'rule' => array('between', 3, 255),
																			   'required' => true,
																			   'message' => 'Nature Of Present Employment must be between 3 to 255 characters.'
																			  ),
																 'alphabetnum' => array(
																						'rule'    => '/^[A-Za-z0-9-\s\n,]*$/',
																						'message' => 'Only Alphanumeric Characters and Special Characters  , and - are allowed.'
																					),          
																
															),
								'working_under'=>array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please select Working Under.',
															'allowEmpty' => false
														),
														
														'allowedChoice' => array(
																				 'rule' => array('inList', array('Central Government','State Government','Autonomous Organizations','Government Undertakings','Private Organization')),
																				 'message' => 'Please select valid option.'
																				)
													),		
								'd_o_r' => array(
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Date Of Retirement is required.'
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),	
								'strt_dt_of_pay' => array(
								                /*'chkdtFrmWhichInThisPay'=>array(
													                             'rule'=>array('chkdtFrmWhichInThisPay'),
																				 'message'=>'Date from which in this Pay is required.'
																				),*/
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													//'message' => 'Date from which in this Pay is required.',
													'allowEmpty' => true
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),	
								'cont_reg_appoint_date' => array(
								                'chkContRegAppointDate'=>array(
													                             'rule'=>array('chkContRegAppointDate'),
																				 'message'=>'Continuous Regular Appointment Date is required.'
																				),
												'notEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Continuous Regular Appointment Date is required.',
													'allowEmpty' => true
												),
												'date' => array(
													'rule' => array('date','dmy'),
													'message' => 'Enter a valid date.'
												),
												
											),	
								'present_post' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Present Post is required.',
															'allowEmpty' => false
														),
														'maxLength' => array(
															'rule' => array('maxLength',100),
															'message' => 'Present Post must be of 100 characters maximum.'
														),
														'between' => array(
														               'rule' => array('between', 3, 100),
														               'required' => true,
														               'message' => 'Present Post must be between 3 to 100 characters.'
													                  ),
														 'alphabetnum' => array(
																				'rule'    => '/^[A-Za-z\s]*$/',
																				'message' => 'Only Alphabets and space are allowed.'
																			),          
														
													),
								'present_scale_pay' => array(
								                            'chkForPresentScalePay'=>array(
													                             'rule'=>array('chkForPresentScalePay'),
																				 'message'=>'Please enter Present Scale Pay.'
																				),
															'nonEmpty' => array(
																'rule' => array('notEmpty'),
																'message' => 'Present Scale Pay is required.',
																'allowEmpty' => true
															),
															'pattern'=>array(
															 'rule'      => '/^[1-9][0-9]{3,6}[-]{1}[1-9][0-9]{3,6}/',
															 'message'   => 'Only digits(0-9) and "-" are allowed.'
															),
															
														),
								'present_grade_pay'	=>	array(
														/*'chkForPresentGradePay'=>array(
													                             'rule'=>array('chkForPresentGradePay'),
																				 'message'=>'Please enter Present Grade Pay.'
																				),*/
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				//'message' => 'Present Grade Pay is required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Present Grade Pay should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Present Grade Pay must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',99999),
															    			'message' => 'Present Grade Pay is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 5),
																			'message'=>'Present Grade Pay not more than 5 digits.'
																		  )				  
													),
						'consolidated_emoluments'	=>	array(
														'chkForConsolidatedEmoluments'=>array(
													                                          'rule'=>array('chkForConsolidatedEmoluments'),
																				              'message'=>'Please enter consolidated emoluments.'
																				             ),
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				//'message' => 'Present Grade Pay is required.',
																				'allowEmpty' => true
																			),	
														'numeric' => array(
																			'rule' => array('numeric'),
																			'message' => 'Consolidated Emolument should be numeric.'
													                       ),
														'minValue'=>array(
																			'rule'=>array('comparison', '>', 0),
																			'message' => 'Consolidated Emolument must be greater than 0.'
														                  ),
													    'maxValue'=>array(
																		    'rule'=>array('comparison', '<=',99999999),
															    			'message' => 'Consolidated Emolument is out of range.'
													                      ),
														'maxLength'=>array(
																			'rule' => array('maxLength', 8),
																			'message'=>'Consolidated Emolument not more than 8 digits.'
																		  )				  
													),					
								'belong_to_ci'=>array(
								                        'chkForBelongToCI'=>array(
																				  'rule'=>array('chkForBelongToCI'),
																				  'message'=>'Please select Whether Belong To CDA/IDA.'
																				 ),
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please select Whether Belong To CDA/IDA.',
															'allowEmpty' => true
														),
														
														'allowedChoice' => array(
																				 'rule' => array('inList', array('CDA','IDA')),
																				 'message' => 'Please select valid option.'
																				)
													),						
								'statement' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Declaration is required.',
															'allowEmpty' => false
														),
														'maxLength' => array(
															'rule' => array('maxLength',255),
															'message' => 'Declaration must be of 255 characters maximum.'
														),
														'between' => array(
														               'rule' => array('between', 3, 255),
														               'required' => true,
														               'message' => 'Statement must be between 3 to 255 characters.'
													                  ),
														 'alphabetnum' => array(
																				'rule'    => '/^[A-Za-z0-9-\s\n,.]*$/',
																				'message' => 'Only Alphanumeric Characters and Special Characters  , - and . are allowed.'
																			),          
														
													),	
								'additional_info' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Additional Information is required.',
															'allowEmpty' => true
														),
														'maxLength' => array(
															'rule' => array('maxLength',255),
															'message' => 'Additional Information must be of 255 characters maximum.'
														),
														'between' => array(
														               'rule' => array('between', 3, 255),
														               'required' => true,
														               'message' => 'Additional Information must be between 3 to 255 characters.'
													                  ),
														 'alphabetnum' => array(
																				'rule'    => '/^[A-Za-z0-9-\s\n,.]*$/',
																				'message' => 'Only Alphanumeric Characters and Special Characters  , - and . are allowed.'
																			),          
														
													),	
								'caste_pdf' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Cate Certificate is required.',
															'allowEmpty' => true
														),
														'maxLength' => array(
															'rule' => array('maxLength',255),
															'message' => 'caste certificate file name should not exceed 255 characters.'
														),
														        
														
													),
							'uf_f_name' => array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'Father\'s first name is required.',
									'allowEmpty' => false
								),
								'between' => array(
									'rule' => array('between', 1, 30),
									'message' => 'User first name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
							'uf_m_name' => array(
								'between' => array(
									'rule' => array('between', 1, 30),
									'allowEmpty' => true,
									'message' => 'Father\'s middle name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
			
							'uf_l_name' => array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'Father\'s last name is required',
									'allowEmpty' => false
								),
								'between' => array(
									'rule' => array('between', 1, 30),
									'message' => 'Father\'s last name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
							'um_f_name' => array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'Mother\'s first name is required.',
									'allowEmpty' => false
								),
								'between' => array(
									'rule' => array('between', 1, 30),
									'message' => 'Mother\'s first name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
							'um_m_name' => array(
								'between' => array(
									'rule' => array('between', 1, 30),
									'allowEmpty' => true,
									'message' => 'Mother\'s middle name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
			
							'um_l_name' => array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'Mother\'s last name is required',
									'allowEmpty' => false
								),
								'between' => array(
									'rule' => array('between', 1, 30),
									'message' => 'Mother\'s last name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
							'gender'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Gender.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Male', 'Female')),
																		 'message' => 'Please select valid Gender.'
																		)
											),					
							);	


	//For Checking if Physically challenged
	public function chkifPhysicallyChallenged($disabilityType)
	{
	 $physicallyChallenged = $this->data['InformationUser']['physically_challenged'];
	 if($physicallyChallenged=='Yes')
	 {
		  if($disabilityType['disability_id']=='')
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
	   //For checking Other Disability
	public function chkifDisabilityOthers($otherDisability)
	{
	 $physicallyChallenged = $this->data['InformationUser']['physically_challenged'];
	 if($physicallyChallenged=='Yes')
	    {	 
			 $typeOfDisabilityId = $this->data['InformationUser']['disability_id'];
			 
			 $this->Disability->Behaviors->load('containable');
			 $typeOfDisability = $this->Disability->find('first',array('conditions'=>array(
																						'Disability.id'=>$typeOfDisabilityId
																					   ),
																	'fields'=>array('type_of_disability'),				   
																	'contain'=>false
																	)
													  );									  
			 if($typeOfDisability['Disability']['type_of_disability']=='Others')
			 {
				  if($otherDisability['other_disability']=='')
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
	  return true;
   }
	
	//For Checking Deputation/Transfer Appointment Date
	public function chkifDTAppointdtempty($dtAppointDate)
	{
	 
	 $presentEmpType = $this->data['InformationUser']['present_emp_type'];
	 	 
	 if($presentEmpType=='Deputation' || $presentEmpType=='Transfer')
	 { 
		  if($dtAppointDate['dt_appoint_date']=='')
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
	
	//For Checking Deputation/Transfer Appointment Period
	public function chkifDTAppointPeriodempty($appointPeriod)
	{
	 
	 $presentEmpType = $this->data['InformationUser']['present_emp_type'];
	 						  
	 if($presentEmpType=='Deputation' || $presentEmpType=='Transfer')
	 {
		  if($appointPeriod['period_of_appoint_dt']=='')
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
	
	//For Checking Deputation/Transfer Parent Organization
	public function chkifDTParentOrgnempty($parentOrgn)
	{
	 
	 $presentEmpType = $this->data['InformationUser']['present_emp_type'];
	 						  
	 if($presentEmpType=='Deputation' || $presentEmpType=='Transfer')
	 {
		  if($parentOrgn['name_o_p_orgn']=='')
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
	
	//For Checking Deputation/Transfer Parent Organization is Others
	public function chkifDTParentOrgnothers($otherOrgn)
	{
	 $presentEmpType = $this->data['InformationUser']['present_emp_type'];					  
	 $parentOrgn     = $this->User->Organization->find('first',array(
																		'conditions'=>array(
																							'id'=>$this->data['InformationUser']['name_o_p_orgn']
																							),
																		'recursive'=>-1,					
																		'fields'=>array('organization_name')
																	)
														);					
	 if($presentEmpType=='Deputation' || $presentEmpType=='Transfer')
	 { 
		  if($parentOrgn['Organization']['organization_name']=='Others')
		  {
			if($otherOrgn['other_parent_organization']=='')
			{	
			  return false;  
			}
			else
			  { 
				return true;  
			  }
		  }
		  else
		  { 
			return true;  
		  }		  
	 }
	   
       return true;
	}
	
	//For Checking Deputation/Transfer Current Organization
	public function chkifDTCurrentOrgnempty($currentOrgn)
	{
	 
	 $presentEmpType = $this->data['InformationUser']['present_emp_type'];
	 						  
	 if($presentEmpType=='Deputation' || $presentEmpType=='Transfer')
	 {
		  if($currentOrgn['current_organization']=='')
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
	
	//For Checking Deputation/Transfer Parent Organization is Others
	public function chkifDTCurrentOrgnothers($otherOrgn)
	{
	 $presentEmpType = $this->data['InformationUser']['present_emp_type'];
	 $currentOrgn    = $this->User->Organization->find('first',array(
																		'conditions'=>array(
																							'id'=>$this->data['InformationUser']['current_organization']
																							),
																		'recursive'=>-1,					
																		'fields'=>array('organization_name')
																	)
														);					  
	 if($presentEmpType=='Deputation' || $presentEmpType=='Transfer')
	 { 
		  if($currentOrgn['Organization']['organization_name']=='Others')
		  {
			if($otherOrgn['other_current_organization']=='')
			{	
			  return false;  
			}
			else
			  { 
				return true;  
			  }
		  }
		  else
		  { 
			return true;  
		  }		  
	 }
	   
       return true;
	}
	
	
	   //For Checking if Working Under Pvt Orgn
	public function chkForPresentScalePay($presentScaleOfPay)
	{
	 $workingUnder = $this->data['InformationUser']['working_under'];
	 						  
	 if($workingUnder!='Private Organization')
	 {
		  if($presentScaleOfPay['present_scale_pay']=='')
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
	
	   //For Checking if Working Under Pvt Orgn
	public function chkForConsolidatedEmoluments($consolidatedEmoluments)
	{
	 $workingUnder = $this->data['InformationUser']['working_under'];
	 						  
	 if($workingUnder=='Private Organization')
	 {
		  if($consolidatedEmoluments['consolidated_emoluments']=='')
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
	
	
	
	   //For Checking if Working Under Pvt Orgn
	public function chkForPresentGradePay($presentGradePay)
	{
	 $workingUnder = $this->data['InformationUser']['working_under'];
	 						  
	 if($workingUnder!='Private Organization')
	 {
		  if($presentGradePay['present_grade_pay']=='')
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
	
	   //For Checking if Working Under Pvt Orgn
	public function chkdtFrmWhichInThisPay($dtFrmWhichInThisPay)
	{
	 $workingUnder = $this->data['InformationUser']['working_under'];
	 						  
	 if($workingUnder!='Private Organization')
	 {
		  if($dtFrmWhichInThisPay['strt_dt_of_pay']=='')
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
	
	   //For Checking if Working Under Pvt Orgn
	public function chkContRegAppointDate($contRegAppointDate)
	{
	 $workingUnder = $this->data['InformationUser']['working_under'];						  
	 if($workingUnder!='Private Organization')
	 {
		  if($contRegAppointDate['cont_reg_appoint_date']=='')
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
	
	   //For Checking if Working Under Pvt Orgn
	public function chkForBelongToCI($belongToCI)
	{
	 $workingUnder = $this->data['InformationUser']['working_under'];
	 						  
	 if($workingUnder!='Private Organization')
	 {
		  if($belongToCI['belong_to_ci']=='')
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
