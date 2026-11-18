<?php
App::uses('AppModel','Model');

class LogUserQualification extends AppModel
{
	 public $belongsTo = array(
                            'UserAppliedVacancy'=> array(
							                  'className'=>'UserAppliedVacancy',
                             				  'foreignKey'=>'user_applied_vacancy_id',
                                              'conditions'=>'',
                                              'order'=>'',
                                              'fields'=>''											  
											  )			  
							);
}