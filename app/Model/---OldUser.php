<?php
App::uses('AppModel','Model');
App::uses('AuthComponent','Component/Controller');

class User extends AppModel
{
  
  public $actsAs = array('Acl' => array('type' => 'requester'));
  public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }
  
  //For Making The password Hashed
  public function beforeSave($options = array()) {
												  if(isset($this->data['User']['password']))
												    {  
												     $this->data['User']['password'] = AuthComponent::password(
                                                                                                            $this->data['User']['password']
                                                                                                            );
                                                      return true;
												    }
                                                 }
												 
			//	ACL Behaviour
public $virtualFields = array(
                            'userName' => 'CONCAT(User.f_name, " " , User.m_name, " ", User.l_name)',
							'organization_name'=> 'select organization_name from organizations where id=User.organization_id',   
							 );		     
public $validate = array(
                          
							'id' => array(
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
							'o_state_id' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'State id is required.',
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
							'o_city_id' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'City id is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'City id should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'City id must be greater than 0.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'City id is out of range.'
											)
										),	
										
							'o_pin_code' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Pin code is required.',
													'allowEmpty' => false
												),
												'numeric'=>array(
													'rule' => 'numeric',
													'allowEmpty' => true, //validate only if not empty
													'message'=>'Pin code should be numeric.'),
													
												'maxLength' => array(
													'rule' => array('maxLength',6),
													'message' => 'Pin code must be of 6 digits maximum.'
												),
												'minValue'=>array(
													'rule'=>array('comparison', '>', 0),
													'message' => 'Pin code must be greater than 0.'
												),
												'maxValue'=>array(
													'rule'=>array('comparison', '<=', 4294967295),
													'message' => 'Pin code is out of range.'
												)       
												
											),	
							'o_std_code' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Std code is required.',
														'allowEmpty' => false
													),
													'numeric'=>array(
														'rule' => 'numeric',
														'allowEmpty' => true, //validate only if not empty
														'message'=>'Std code should be numeric.'
													),
													'maxLength'=>array(
														'rule' => array('maxLength', 3),
														'allowEmpty' => true, //validate only if not empty
														'message'=>'Std code should be minimum of 3 digits.'
													),
													'maxLength'=>array(
														'rule' => array('maxLength', 5),
														'allowEmpty' => true, //validate only if not empty
														'message'=>'Std code should be maximum of 5 digits.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Std code must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Std code is out of range.'
													) 
												),	
							'o_landline_num' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'land line number is required.',
															'allowEmpty' => false
														),
														'numeric'=>array(
															'rule' => 'numeric',
															'allowEmpty' => true, //validate only if not empty
															'message'=>'land line number should be numeric.'
														),
														'maxLength'=>array(
															'rule' => array('maxLength',10),
															'allowEmpty' => true, //validate only if not empty
															'message'=>'land line number should be maximum of 10 digits.'
														),
														'minValue'=>array(
															'rule'=>array('comparison', '>', 0),
															'message' => 'land line number must be greater than 0.'
														) 
														
													),	
							'r_state_id' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'State id is required.',
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
							'r_city_id' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'City id is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'City id should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'City id must be greater than 0.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'City id is out of range.'
											)
										),	
										
							'r_pin_code' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Pin code is required.',
													'allowEmpty' => false
												),
												'numeric'=>array(
													'rule' => 'numeric',
													'allowEmpty' => true, //validate only if not empty
													'message'=>'Pin code should be numeric.'),
													
												'maxLength' => array(
													'rule' => array('maxLength',6),
													'message' => 'Pin code must be of 6 digits maximum.'
												),
												'minValue'=>array(
													'rule'=>array('comparison', '>', 0),
													'message' => 'Pin code must be greater than 0.'
												),
												'maxValue'=>array(
													'rule'=>array('comparison', '<=', 4294967295),
													'message' => 'Pin code is out of range.'
												)       
												
											),	
							'r_std_code' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Std code is required.',
														'allowEmpty' => false
													),
													'numeric'=>array(
														'rule' => 'numeric',
														'allowEmpty' => true, //validate only if not empty
														'message'=>'Std code should be numeric.'
													),
													'minLength'=>array(
														'rule' => array('minLength', 3),
														'allowEmpty' => true, //validate only if not empty
														'message'=>'Std code should be minimum of 3 digits.'
													),
													'maxLength'=>array(
														'rule' => array('maxLength', 5),
														'allowEmpty' => true, //validate only if not empty
														'message'=>'Std code should be maximum of 5 digits.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Std code must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Std code is out of range.'
													) 
												),	
							'r_landline_num' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'land line number is required.',
															'allowEmpty' => false
														),
														'numeric'=>array(
															'rule' => 'numeric',
															'allowEmpty' => true, //validate only if not empty
															'message'=>'land line number should be numeric.'
														),
														'maxLength'=>array(
															'rule' => array('maxLength',10),
															'allowEmpty' => true, //validate only if not empty
															'message'=>'land line number should be maximum of 10 digits.'
														),
														'minValue'=>array(
															'rule'=>array('comparison', '>', 0),
															'message' => 'land line number must be greater than 0.'
														) 
														
													),

													
							'u_name_title'=>array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Please select Salutation.',
													'allowEmpty' => false
												),
												
												'allowedChoice' => array(
																		 'rule' => array('inList', array('Mr.', 'Ms.', 'Mrs.','Dr.')),
																		 'message' => 'Please select valid Salutation.'
																		)
											),
							'f_name' => array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'User first name is required.',
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
							'm_name' => array(
								'between' => array(
									'rule' => array('between', 1, 30),
									'allowEmpty' => true,
									'message' => 'User middle name must be between 1 to 30 characters.'
								),
								'pattern'=>array(
								 'rule'      => '/^[a-zA-Z]+$/',
								 'message'   => 'Only alphabets allowed. Space is not allowed.'
								),
								
							),
			
							'l_name' => array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'User last name is required',
									'allowEmpty' => false
								),
								'between' => array(
									'rule' => array('between', 1, 30),
									'message' => 'User last name must be between 1 to 30 characters.'
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
							'email' => array(
												'unique' => array(
													'rule'    => 'isUnique',
													'message' => 'This email is already in use.',
													'allowEmpty' => false
												),
												'between' => array(
													'rule' => array('between', 6, 30),
													'message' => 'Email must be between 6 to 30 characters.'
												),
												   'email' => array(
																		'rule'    => array('email',false),
																		'message' => 'Please supply a valid email address'
																		  )                   
											),		

							'username' => array(
														'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Username is required.',
															'allowEmpty' => false
														),
														'unique' => array(
															'rule' => 'isUnique',
															'message' => 'This username is already registered.'
														),
														'pattern' => array(
															'rule'      => '/^[a-zA-Z0-9._]+$/',
															'message' => 'Username can contain only letters, numbers,dots and underscores.'
														),
														'between' => array(
																			'rule' => array('between', 5, 15),
																			'message' => 'Username must be between 5 to 15 characters.'
																		),
														'maxLength'=>array(
															'rule' => array('maxLength', 15),
															'message'=>'Username should be of 15 digits maximum.'
														)
													),	
							'mobile_number' => array(
														 'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Mobile number is required.',
															'allowEmpty' => false
														),
														'numeric'=>array(
															'rule' => 'numeric',
															'allowEmpty' => false, //validate only if not empty
															'message'=>'Mobile number should be numeric.'
															),
														'minLength'=>array(
															'rule' => array('minLength', 10),
															'allowEmpty' => false, //validate only if not empty
															'message'=>'Mobile Number should be of 10 digits.'
														),
														'maxLength'=>array(
															'rule' => array('maxLength', 10),
															'allowEmpty' => false, //validate only if not empty
															'message'=>'Mobile Number should be of 10 digits.'
														),
														'minValue'=>array(
															'rule'=>array('comparison', '>', 0),
															'message' => 'Mobile Number must  be greater than 0.'
														),
														'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'This mobile number is already registered.',
															'allowEmpty' => true
														),
														
													),	
							'organization_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Organization is required.',
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
												
							'other_orgn'	=>	array(
														
														'chkifothers' => array(
																					'rule'    => array('chkifothers'),
																					'message' => 'Please enter name of organization.'
																				),	
														'nonEmpty' => array(
																				'rule' => array('notEmpty'),
																				'message' => 'Organization is required.',
																				'allowEmpty' => true
																			),	
														'between' => array(
																			'rule' => array('between', 3, 60),
																			'message' => 'Organization name must be between 3 to 60 characters.'
																		),
														'pattern'=>array(
														 'rule'      => '/^[a-zA-Z\s]+$/',
														 'message'   => 'Only alphabets allowed. Space is allowed.'
														            ),					
													),
                                    'office_location_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Office Location is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Office Location id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Office Location id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Office Location id is out of range.'
													),
													
													
												),
									'department_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Department is required.',
														'allowEmpty' => false
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
									'designation_id' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Designation is required.',
														'allowEmpty' => false
													),
													'numeric' => array(
														'rule' => array('numeric'),
														'message' => 'Designation id should be numeric.'
													),
													'minValue'=>array(
														'rule'=>array('comparison', '>', 0),
														'message' => 'Designation id must be greater than 0.'
													),
													'maxValue'=>array(
														'rule'=>array('comparison', '<=', 4294967295),
														'message' => 'Designation id is out of range.'
													),
													
													
												),	
									'profile_pic' => array(
															'extension'=>array(
																              'rule' => array(
																                              'extension',
																                                          array('gif', 'jpeg', 'png', 'jpg')
																                             ),
																              'message' => 'Please enter a valid photo.'	
															),
															'maxLength' => array(
																                 'rule' => array('maxLength', 200),
																                 'message' => 'Profile Photo must be 200 characters maximum.'
															                    ),
															'unique'	=> array(
															                     'rule'    => 'isUnique',
																				 'message' => 'Profile Pic should be Unique.'
															                    ),
                                                            'allowEmpty'=> true																				
														),
														
			        'password' => array(
                            'required' => array(
                                                    'rule' => array('notEmpty'),
                                                    'message' => 'A password is required.'
                                                ),
                            'minLength' => array(
                                                    'rule' => array('minLength', '8'), 
                                                    'message' => 'Password must have a minimum of 8 characters.'
                                                ),
                            'maxLength' => array(
                                                    'rule' => array('maxLength', '16'), 
                                                    'message' => 'Password must have a maximum of 16 characters.'
                                                ),
                            'passwordPolicy'=>array(
                                                       'rule'=>"/^(?=.{8,})(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!'()*,-.:;<=>?\\[\]_`{|}~@#$%^&+=\/]).*$/",
                                                       'message'=>'Password must contain: 1.Atleast one uppercase letter(A-Z). 2. Atleast one lowercase letter(a-z). 3. Atleast one number(0-9). 4. Atleast one special character.'
                                                   )                    
                            ),
         
							'password_confirm' => array(
								'required' => array(
									'rule' => array('notEmpty'),
									'message' => 'Please confirm your password.'
								),
								 'equaltofield' => array(
									'rule' => array('equaltofield','password'),
									'message' => 'Both passwords must match.'
								)
							),
							'current_password'=>array(
								'mustNotEmpty'=>array(
									'rule' => 'notEmpty',
									'message'=> 'Please enter current password',
									'last'=>true),
								'mustMatch'=>array(
									'rule' => array('verifyCurrentPass'),
									'message' => 'Please enter correct current password'),
							),
						   
							/*'role' => array(
								'valid' => array(
									'rule' => array('inList', array('king', 'queen', 'bishop', 'rook', 'knight', 'pawn')),
									'message' => 'Please enter a valid role',
									'allowEmpty' => false
								)
							),*/
							 
							 
							'password_update' => array(
								 'required' => array(
									'rule' => array('notEmpty'),
									'message' => 'A password is required.'
								),
								'minLength' => array(
									'rule' => array('minLength', '6'), 
									'message' => 'Password must have a minimum of 6 characters.'
								)
							),
							'password_confirm_update' => array(
								 'required' => array(
									'rule' => array('notEmpty'),
									'message' => 'Please confirm your password.'
								),
								 'equaltofield' => array(
									'rule' => array('equaltofield','password_update'),
									'message' => 'Both passwords must match.'
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
	
	public function chkifothers($org)
	{
		$Organization=$this->Organization->find('first',array(
																'conditions'=>array(
																					'id'=>$this->data['User']['organization_id']
																					),
																'fields'=>array('organization_name')
															)
												);
		
		if($Organization['Organization']['organization_name']=='Others')
		{
			if($org['other_orgn']=='')
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
	
	
	/**
	 * Used to match current password
	 *
	 * @access public
	 * @return boolean
	 */
	public function verifyCurrentPass() {
		$userId = AuthComponent::user('id');
		$user = $this->findById($userId, 'password');
		$currentPassword = AuthComponent::password($this->data['User']['current_password']);
		return ($user['User']['password']===$currentPassword);
	}
	
	
	public function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }
	
           //For telling him about the associations(that it contains foreign keys of various tables)
	public $belongsTo = array(
								'Group'=> array(
										'className' => 'Group',
										'foreignKey' => 'group_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           ),
								'Organization'=> array(
										'className' => 'Organization',
										'foreignKey' => 'organization_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           ),
								'OfficeLocation'=> array(
										'className' => 'OfficeLocation',
										'foreignKey' => 'office_location_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           ),
								'Department'=> array(
										'className' => 'Department',
										'foreignKey' => 'department_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
									           ),
								'Designation'=> array(
										'className' => 'Designation',
										'foreignKey' => 'designation_id',
										'conditions' => '',
										'fields' => '',
										'order' => ''
                                	           )												   
							);  
							
							
	public $hasOne = array(
	                        'InformationUser'=>array(
							                         'className'=>'InformationUser',
													 'foreignKey'=>'user_id',
													 'unique' => true,
													 'dependent' => true,
												     'conditions' =>'',
													 'fields' => '',
													 'order' => '',
													 'limit' => '',
													 'offset' => '',
													 'exclusive' => '',
													 'finderQuery' => '',
													 'counterQuery' => ''
													 ),
							'ServiceAndBatchInfo'=>array(
							                         'className'=>'ServiceAndBatchInfo',
													 'foreignKey'=>'user_id',
													 'unique' => true,
													 'dependent' => true,
												     'conditions' =>'',
													 'fields' => '',
													 'order' => '',
													 'limit' => '',
													 'offset' => '',
													 'exclusive' => '',
													 'finderQuery' => '',
													 'counterQuery' => ''
													 )						 
						  );
    
	public $hasMany = array(						  
							 'UserEmploymentDetail'=>array(
							                         'className'=>'UserEmploymentDetail',
													 'foreignKey'=>'user_id',
													 'dependent' => false,
												     'conditions' => '',
													 'fields' => '',
													 'order' => '',
													 'limit' => '',
													 'offset' => '',
													 'exclusive' => '',
													 'finderQuery' => '',
													 'counterQuery' => ''
													 ),
                             'UserQualification'=>array(
							                         'className'=>'UserQualification',
													 'foreignKey'=>'user_id',
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
						   );

public $hasAndBelongsToMany	= array(
                     'VacanciesEssential'  =>array(
											    'className'=>'VacanciesEssential',
											    'joinTable' => 'users_vacancies_essentials',
												'foreignKey' => 'user_id',
												'associationForeignKey'=>'vacancies_essential_id',
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
			         'VacanciesDesirable'  =>array(
											    'className'=>'VacanciesDesirable',
											    'joinTable' => 'users_vacancies_desirables',
												'foreignKey' => 'user_id',
												'associationForeignKey'=>'vacancies_desirable_id',
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
						   
						   
					
												 
}												 