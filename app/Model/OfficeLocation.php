<?php
App::uses('AppModel','Model');

class OfficeLocation extends AppModel
{
	    public $validate = array(
		'id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Office location id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Office location id should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Office location id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Office location id is out of range.'
			)
		),
		'organization_id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Organization is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select valid organization.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Please select valid organization.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Please select valid organization.'
			),
			
		),
        'location_name' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Office location name is required.',
                'allowEmpty' => false
            ),
			'unique' => array(
                'rule'    => array('isUnique',array('organization_id','location_name'),false),
                'message' => 'This location is already registerd with selected Organization.',
            ),
            'between' => array(
                'rule' => array('between', 3, 90),
                'required' => true,
                'message' => 'Office location name must be between 3 to 90 characters.'
            ),
			'pattern'=>array(
             'rule'      => '/^[a-zA-Z\s]+$/',
             'message'   => 'Please enter alphabets only. Space is allowed.'
			),
            
        ),
		 'location_address' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Office address is required.',
                'allowEmpty' => false
            ),
			
            'between' => array(
                'rule' => array('between', 3, 255),
                'required' => true,
                'message' => 'Office address must be between 3 to 255 characters.'
            ),
			'pattern'=>array(
             'rule'      => '/^[a-zA-Z0-9\n\s,-.]+$/',
             'message'   => 'Please enter alphanumeric characters only. Special charters(, and - ), space is allowed.'
			),
            
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
		'city_id' => array(
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
	
 public $belongsTo = array(
					   'Organization'=> array(
									'className' => 'Organization',
									'foreignKey' => 'organization_id',
									'conditions' => '',
									'fields' => '',
									'order' => ''
								      ),
					   'State'=> array(
								'className' => 'State',
								'foreignKey' => 'state_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
									   ),
					    'City'=> array(
						           'className' => 'City',
								   'foreignKey'=> 'city_id',
								   'conditions'=> '' ,
								   'fields' => '',
								   'order' => ''
								        )			   

					); 
	
     public $hasAndBelongsToMany = array(
		'Department' => array(
			'className' => 'Department',
			'joinTable' => 'departments_office_locations',
			'foreignKey' => 'office_location_id',
			'associationForeignKey'=>'department_id',
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