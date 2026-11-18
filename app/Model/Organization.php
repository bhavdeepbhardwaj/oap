<?php
App::uses('AppModel','Model');

class Organization extends AppModel
{
 
// public $displayField='organization_name';



 public $validate = array(
		'id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Organization id is required.',
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
			)
		),
        'organization_name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Organization name is required.',
                'allowEmpty' => false
            ),
			'unique' => array(
							'rule'    => 'isUnique',
							'message' => 'This Organization name already exists.',
						),
            'between' => array(
                'rule' => array('between', 3, 60),
                'required' => true,
                'message' => 'Organization Name must be between 3 to 60 characters.'
            ),
			'pattern'=>array(
             'rule'      => '/^[a-zA-Z\s]+$/',
             'message'   => 'Please enter alphabets only. Space is allowed.'
			),
            
        ),
		
		'organization_type' => array(
			'nonEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Organization type is required.',
				'allowEmpty' => false
			),
			'allowedChoice' => array(
										 'rule' => array('inList', array('MOS', 'Non-MOS')),
										 'message' => 'Enter a correct organization type.'
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
		)
	);
 
 public $hasMany = array(
                  'OfficeLocation' => array(
                                        'className'=>'OfficeLocation',
                                        'foreignKey' => 'organization_id',
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
									
					'User' => array(
                                        'className'=>'User',
                                        'foreignKey' => 'organization_id',
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
									   
	

}