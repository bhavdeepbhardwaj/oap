<?php
App::uses('AppModel','Model');

class City extends AppModel
{

public $belongsTo = array(
					   'State'=> array(
								'className' => 'State',
								'foreignKey' => 'state_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
									   )				

					); 

public $validate = array(
		'id' => array(
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
		'state_id' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'State is required.',
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
        'city_name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'City name is required.',
                'allowEmpty' => false
            ),
			'unique' => array(
                'rule'    => 'isUnique',
                'message' => 'This City name already exists.',
            ),
            'between' => array(
                'rule' => array('between', 3, 20),
                'required' => true,
                'message' => 'City Name must be between 3 to 20 characters.'
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

					
}