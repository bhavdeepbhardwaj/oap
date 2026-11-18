<?php
App::uses('AppModel','Model');

class Service extends AppModel
{	
  public $hasMany = array(
		'ServiceAndBatchInfo' => array(
			'className' => 'ServiceAndBatchInfo',
			'foreignKey' => 'service_id',
			'dependent' => false,
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
							'service_name' => array(
													'between' => array(
														'rule' => array('between', 3, 100),
														'allowEmpty' => true,
														'message' => 'Service name must be between 3 to 100 characters.'
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
														)			
							);
}