<?php
App::uses('AppModel','Model');

class VacanciesEssential extends AppModel
{
    
public $hasAndBelongsToMany	= array(
                     'User'  =>array(
											    'className'=>'User',
											    'joinTable' => 'users_vacancies_essentials',
												'foreignKey' => 'vacancies_essential_id',
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
                            'essential_name' => 'select essential from essentials where id = VacanciesEssential.essential_id'
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
        'essential_id' => array(
							 'nonEmpty' => array(
								                 'rule' => array('notEmpty'),
								                 'message' => 'Essential Id is required.',
								                 'allowEmpty' => false
							                    ),
							'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Essential Id Must Be Numeric.'
							                  ),
							'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Essential id must be greater than 0.'
							                 ),
							'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Essential id is out of range.'
							                 ),
							'unique'=>array(
											'rule'    => array('isUnique',array('vacancy_id','essential_id'),false),
											'message' => 'This Essential is already registerd with selected Vacancy.',
										   )
			
		                   ),  
    );								 

}
