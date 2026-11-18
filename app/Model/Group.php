<?php 
App::uses('AppModel','Model');


class Group extends AppModel
{
	
	public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
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
                'message' => 'User group id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'User group id should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'User group id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'User group id is out of range.'
			)
		),
        'name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Group name is required.',
                'allowEmpty' => false
            ),
			'unique' => array(
                'rule'    => 'isUnique',
                'message' => 'This group name is already in use.',
            ),
            'between' => array(
                'rule' => array('between', 3, 200),
                'required' => true,
                'message' => 'Group Name must be between 3 to 200 characters.'
            ),
			'pattern'=>array(
             'rule'      => '/^[a-zA-Z\s]+$/',
             'message'   => 'Please enter alphabets only. Space is allowed.'
			),
            
        ),
		'level' => array(
			'nonEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Level is required.',
				'allowEmpty' => false
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Level should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Level must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Level is out of range.'
			) 
		),
		'dependency' => array(
								'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Dependency is required.',
														'allowEmpty' => false
													),
			
			
								'allowedChoice' => array(
														 'rule' => array('inList', array('organization', 'none')),
														 'message' => 'Enter a correct dependency value.'
														)
        ),
		
		'created' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Created time is required.'
            ),
			'datetime' => array(
				'rule' => 'datetime',
				'message' => 'Enter a valid date and time.'
			)
		),
		
	);	
	
	
	
}