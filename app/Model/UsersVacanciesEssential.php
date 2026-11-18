<?php
App::uses('AppModel','Model');

class UsersVacanciesEssential extends AppModel
{
 	public $validate = array(

							'id' => array(
											 'nonEmpty' => array(
												'rule' => array('notEmpty'),
												'message' => 'Users Vacancy Essential id is required.',
												'allowEmpty' => false
											),
											'numeric' => array(
												'rule' => array('numeric'),
												'message' => 'Users Vacancy Essential id should be numeric.'
											),
											'minValue'=>array(
												'rule'=>array('comparison', '>', 0),
												'message' => 'Users Vacancy Essential id must be greater than 0.'
											),
											'maxValue'=>array(
												'rule'=>array('comparison', '<=', 4294967295),
												'message' => 'Users Vacancy Essential id is out of range.'
											),
											'unique' => array(
															'rule'    => 'isUnique',
															'message' => 'Users Vacancy Essential Id already exists.',
														),
										),
							'user_id' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'User Id is required.',
													'allowEmpty' => false
												),
												'numeric' => array(
													'rule' => array('numeric'),
													'message' => 'User id should be numeric.'
												),
												'minValue'=>array(
													'rule'=>array('comparison', '>', 0),
													'message' => 'User id must be greater than 0.'
												),
												'maxValue'=>array(
													'rule'=>array('comparison', '<=', 4294967295),
													'message' => 'User id is out of range.'
												)
												
											),
							'vacancies_essential_id' => array(
												'nonEmpty' => array(
													'rule' => array('notEmpty'),
													'message' => 'Vacancy Essential Id is required.',
													'allowEmpty' => false
												),
												'numeric' => array(
													'rule' => array('numeric'),
													'message' => 'Vacancy Essential id should be numeric.'
												),
												'unique' => array(
																	'rule'    => array('isUnique',array('user_id','vacancies_essential_id'),false),
																	'message' => 'This vacancy essential id already exists.',
																 ),
												'minValue'=>array(
													'rule'=>array('comparison', '>', 0),
													'message' => 'Vacancy Essential id must be greater than 0.'
												),
												'maxValue'=>array(
													'rule'=>array('comparison', '<=', 4294967295),
													'message' => 'Vacancy Essential id is out of range.'
												)
												
											),				
							'essential_comments' => array(
													'nonEmpty' => array(
														'rule' => array('notEmpty'),
														'message' => 'Essential Comments are required.',
														'allowEmpty' => false
													),
													
													'between' => array(
																	'rule' => array('between', 3, 500),
																	'required' => true,
																	'message' => 'Essential Comments must be between 3 to 500 characters.'
																),
													'pattern'=>array(
													 'rule'      => '/^[a-zA-Z0-9\s,-._()]+$/',
													 'message'   => 'Please enter alphanumeric characters only. Special charters(,._() and - ), space is allowed.'
													),
													
												),			
														
							);						   
}