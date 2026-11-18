<?php
App::uses('AppModel', 'Model');

class Page extends AppModel
{
    /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
                                        'nonEmpty' => array(
                                                            'rule' => array('notEmpty'),
                                                            'message' => 'Page title is required.',
                                                            'allowEmpty' => false
                                                            )

                                    ),
                'slug'=>   array(
                                        'nonEmpty' => array(
                                                            'rule' => array('notEmpty'),
                                                            'message' => 'Page slug is required.',
                                                            'allowEmpty' => false
                                                            )

                                    ),  
                'content'=>array(
                                        'nonEmpty' => array(
                                                            'rule' => array('notEmpty'),
                                                            'message' => 'Page content is required.',
                                                            'allowEmpty' => false
                                                            )

                                    ),                    
            );
	
}