<?php
App::uses('AppModel','Model');

class DepartmentsOfficeLocation extends AppModel
{
 public $validate = array(
		'id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Department Office location id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Department Office location id should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Department Office location id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Department Office location id is out of range.'
			)
		),
		'department_id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Department Id is required.',
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
			'unique'=>array(
			                'rule'    => array('isUnique',array('office_location_id','departmet_id'),false),
                            'message' => 'This department is already registerd with selected Organization.',
						   )
			
		),
          
    );	
}