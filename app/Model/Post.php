<?php
App::uses('AppModel','Model');

class Post extends AppModel
{
  public $validate = array(

							'id' => array(
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
											'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'Post Id already exists.',
															'allowEmpty' => true
														),
										),
							'post_name' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Post Name is required.',
														'allowEmpty' => false
													),
													'unique' => array(
																	'rule'    => 'isUnique',
																	'message' => 'This Post name already exists.',
																     ),
													'between' => array(
																	'rule' => array('between', 3, 100),
																	'required' => true,
																	'message' => 'Post Name must be between 3 to 100 characters.'
																),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z\s]+$/',
													 'message'   => 'Only alphabets and space are allowed.'
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
