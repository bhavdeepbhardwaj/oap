<?php
App::uses('AppModel','Model');

class VacanciesDesirable extends AppModel
{

public $hasAndBelongsToMany	= array(
                     'User'  =>array(
											    'className'=>'User',
											    'joinTable' => 'users_vacancies_desirables',
												'foreignKey' => 'vacancies_desirable_id',
												'associationForeignKey'=>'user_id',
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
								
public $virtualFields = array(
                              'desirable_name' => 'select desirable from desirables where id = VacanciesDesirable.desirable_id'
							 );
public $validate = array( 
		'id' => array(
			 'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Vacancies Essential id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Vacancies Essential id should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Vacancies Essential id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Vacancies Essential id is out of range.'
			)
		),
		'vacancy_id' => array(
							 'nonEmpty' => array(
								                 'rule' => array('notEmpty'),
								                 'message' => 'Vacancy Id is required.',
								                 'allowEmpty' => false
							                    ),
							'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Vacancy Id Must Be Numeric.'
							                  ),
							'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Vacancies Essential id must be greater than 0.'
							                 ),
							'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Vacancies id is out of range.'
							                 ),
							
			
		                   ),
        'desirable_id' => array(
							 'nonEmpty' => array(
								                 'rule' => array('notEmpty'),
								                 'message' => 'Desirable Id is required.',
								                 'allowEmpty' => false
							                    ),
							'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Desirable Id Must Be Numeric.'
							                  ),
							'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Desirable id must be greater than 0.'
							                 ),
							'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Desirable id is out of range.'
							                 ),
							'unique'=>array(
											'rule'    => array('isUnique',array('vacancy_id','desirable_id'),false),
											'message' => 'This Desirable is already registerd with selected Vacancy.',
										   )
			
		                   ),  
    );							 
}
