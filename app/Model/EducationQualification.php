<?php
App::uses('AppModel','Model');

class EducationQualification extends AppModel
{
 public $validate = array(
	
     	'id' => array(
					 'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Education Qualification id is required.',
						'allowEmpty' => false
					),
					'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'Education Qualification id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'Education Qualification must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'Education Qualification id is out of range.'
					)
				),
				'education_qualification' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Education Qualification name is required.',
						'allowEmpty' => false
					),
					'unique' => array(
						'rule'    => 'isUnique',
						'message' => 'This Education Qualification name already exists.',
					),
					'between' => array(
						'rule' => array('between', 3, 100),
						'required' => true,
						'message' => 'Education Qualification Name must be between 3 to 100 characters.'
					),
					'pattern'=>array(
					 'rule'      => '/^[a-zA-Z\s]+$/',
					 'message'   => 'Please enter alphabets only. Space is allowed.'
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
				'modified_on' => array(
					'datetime' => array(
						'rule' => 'datetime',
						 'allowEmpty' => true,
						'message' => 'Enter a valid date and time.'
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
						'message' => 'Modified by organization id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'Modified by organization id must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'Modified by organization id is out of range.'
					)
				),
	);	
}