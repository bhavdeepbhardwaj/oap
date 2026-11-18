<?php
App::uses('AppModel','Model');

class Desirable extends AppModel
{
    public $validate = array(
		'id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Desirable id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Desirable id should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Desirable id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Desirable id is out of range.'
			)
		),
        'desirable' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Desirable is required.',
                'allowEmpty' => false
            ),
			'unique' => array(
                'rule'    => 'isUnique',
                'message' => 'This desirable has already added.',
            ),
            'between' => array(
                'rule' => array('between', 3, 255),
                'required' => true,
                'message' => 'Desirable Name must be between 3 to 255 characters.'
            ),
			'pattern'=>array(
             'rule'      => '/^[a-zA-Z\s\n,.]+$/',
             'message'   => 'Alphabets ,space and special character(. ,) are allowed only.'
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
                'message' => 'Creater organization id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Creater organization id should be numeric.'
			),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Creater organization id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Creater organization id is out of range.'
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
				'message' => 'Updater organization id should be numeric.'
			),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Updater organization id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Updater organization id is out of range.'
			)
		)
	);	
}