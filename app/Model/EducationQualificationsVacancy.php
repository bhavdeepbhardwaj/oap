<?php
App::uses('AppModel','Model');

class EducationQualificationsVacancy extends AppModel
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
                'message' => 'Education Qualifications Vacancy id is required.',
                'allowEmpty' => false
            ),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Education Qualifications Vacancy id should be numeric.'
            ),
			'minValue'=>array(
				'rule'=>array('comparison', '>', 0),
				'message' => 'Education Qualifications Vacancy id must be greater than 0.'
			),
			'maxValue'=>array(
				'rule'=>array('comparison', '<=', 4294967295),
				'message' => 'Education Qualifications Vacancy id is out of range.'
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
        'education_qualification_id' => array(
							 'nonEmpty' => array(
								                 'rule' => array('notEmpty'),
								                 'message' => 'Education Qualification Id is required.',
								                 'allowEmpty' => false
							                    ),
							'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Education Qualification Id Must Be Numeric.'
							                  ),
							'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Education Qualification id must be greater than 0.'
							                 ),
							'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Education Qualification id is out of range.'
							                 ),
							'unique'=>array(
											'rule'    => array('isUnique',array('vacancy_id','education_qualification_id'),false),
											'message' => 'This Education Qualification is already registerd with selected Vacancy.',
										   )
			
		                   ),  
    );								 

}
