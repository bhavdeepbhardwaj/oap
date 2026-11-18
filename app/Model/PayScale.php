<?php
App::uses('AppModel','Model');

class PayScale extends AppModel
{
	public $displayField='pay_scale';
	
		public $validate = array(

							'id' => array(
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
											'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'Pay Scale Id already exists.',
															'allowEmpty' => true
														),
										),
							'pay_scale' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Payscale is required.',
														'allowEmpty' => false
													),
													'pattern'=>array(
													 'rule'      => '/^[1-9][0-9]{3,6}[-]{1}[1-9][0-9]{3,6}/',
													 'message'   => 'Only digits(0-9) and "-" are allowed.'
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
							'modified_on' => array(
									'nonEmpty' => array(
										'rule' => array('notEmpty'),
										'message' => 'Modification time is required.'
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
