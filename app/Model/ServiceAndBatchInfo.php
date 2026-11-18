<?php
App::uses('AppModel','Model');

class ServiceAndBatchInfo extends AppModel
{
	
 public $virtualFields = array(
							  'service_name' => 'select service_name from services where id=service_id',
							  'cadre_name'   => 'select cadre_name from cadres where id=cadre_id'
							 );	
	
  public $belongsTo = array(
                            'User' => array(
							                'className'=>'User',
											'foreignKey'=>'user_id',
											'conditions' => '',
										    'fields' => '',
										    'order' => ''
											),
							'Service' => array(
							                'className'=>'Service',
											'foreignKey'=>'service_id',
											'conditions' => '',
										    'fields' => '',
										    'order' => ''
											),
							'Cadre' => array(
							                'className'=>'Cadre',
											'foreignKey'=>'cadre_id',
											'conditions' => '',
										    'fields' => '',
										    'order' => ''
											)				
							);

	public $validate = array(
				'id' => array(
					 'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Service And Batch Info id is required.',
						'allowEmpty' => false
					),
					'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'Service And Batch Info id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'Service And Batch Info id must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'Service And Batch Info id is out of range.'
					)
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
				'service_id' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Service Id is required.',
						'allowEmpty' => false
					),
					'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'Service id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'Service id must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'Service id is out of range.'
					)
					
				),
				'batch'=>array(
								'nonEmpty' => array(
									'rule' => array('notEmpty'),
									'message' => 'Please select Year Of Recruitment.',
									'allowEmpty' => false
								),
								'date' => array(
												 'rule' => array('date','y'),
												 'message' => 'Please select valid Batch.'
												)
								
							),
				'cadre_id' => array(
				    
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Cadre Id is required.',
						'allowEmpty' => false
					),
					'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'Cadre id should be numeric.'
					),
					'minValue'=>array(
						'rule'=>array('comparison', '>', 0),
						'message' => 'Cadre id must be greater than 0.'
					),
					'maxValue'=>array(
						'rule'=>array('comparison', '<=', 4294967295),
						'message' => 'Cadre id is out of range.'
					)
					
				),
				'other_cadre_name'=> array(
											'chkifCadreIdisOthers'=>array(
																		  'rule'=>array('chkifCadreIdisOthers'),
																		  'message'=>'Please enter name of other cadre name.'
																		 ),
											'nonEmpty' => array(
																'rule' => array('notEmpty'),
																'allowEmpty' => true
															),
											'between' => array(
															   'rule' => array('between', 3, 60),
															   'required' => true,
															   'message' => 'Cadre Name must be between 3 to 60 characters.'
															  ),
											'pattern'=>array (
															  'rule'      => '/^[a-zA-Z\s]+$/',
															  'message'   => 'Only alphabets and space is allowed'
															 ),
	
									  ),
				'doj_grp_a' => array(
										'notEmpty' => array(
											'rule' => array('notEmpty'),
											'message' => 'Date of Joining Group A Services is required.'
										),
										'date' => array(
											'rule' => array('date','dmy'),
											'message' => 'Enter a valid date.'
										),
										
									),
				'exp_prt_ship' => array(
										'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please enter your Experience in Port & Shipping Sectors',
															'allowEmpty' => false
														   ),

										'between' => array(
														   'rule' => array('between', 3, 500),
														   'required' => true,
														   'message' => 'Experience in Port & Shipping Sectors must be between 3 to 500 characters.'
														  ),
										'pattern'=>array (
														  'rule'      => '/^[a-zA-Z0-9\s\n,-.]+$/',
														  'message'   => 'Please enter alphanumeric characters only. Special characters(,. and - ), space is allowed.'
														 ),

								  ), 					
				'write_up1_data' => array(
										'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please enter your Write Up 1',
															'allowEmpty' => false
														   ),

										'between' => array(
														   'rule' => array('between', 3, 4000),
														   'required' => true,
														   'message' => 'Write Up 1 must be between 3 to 4000 characters.'
														  ),
										'pattern'=>array (
														  'rule'      => '/^[a-zA-Z0-9\s\n,-.]+$/',
														  'message'   => 'Please enter alphanumeric characters only. Special characters(,. and - ), space is allowed.'
														 ),

								  ),
				'write_up2_data' => array(
										'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please enter your Write Up 2',
															'allowEmpty' => false
														   ),

										'between' => array(
														   'rule' => array('between', 3, 4000),
														   'required' => true,
														   'message' => 'Write Up 2 must be between 3 to 4000 characters.'
														  ),
										'pattern'=>array (
														  'rule'      => '/^[a-zA-Z0-9\s\n,-.]+$/',
														  'message'   => 'Please enter alphanumeric characters only. Special characters(,. and - ), space is allowed.'
														 ),

								  ),				  
				
				'write_up_1' => array(
							    'chkifwantToUploadWriteUps1' => array(
																	'rule'    => array('chkifwantToUploadWriteUps1'),
																	'message' => 'Please upload Write Up 1.'
													  			    ),	
								'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please enter your Write Up 1',
															'allowEmpty' => true
														   ),
								'extension'=>array(
												  'rule' => array(
																  'extension',
																			  array('pdf')
																 ),
												  'message' => 'Please upload a valid Write Up 1.'	
								),
								'maxLength' => array(
													 'rule' => array('maxLength', 200),
													 'message' => 'Name of Write Up 1 cannot exceed more than 200 characters.'
													),
								'unique'	=> array(
													 'rule'    => 'isUnique',
													 'message' => 'Write Up 1 name should be Unique.'
													),
																												
							),
				'write_up_2' => array(
							    'chkifwantToUploadWriteUps2' => array(
																	'rule'    => array('chkifwantToUploadWriteUps2'),
																	'message' => 'Please upload Write Up 2.'
																),
																
								'nonEmpty' => array(
															'rule' => array('notEmpty'),
															'message' => 'Please enter your Write Up 2',
															'allowEmpty' => true
														   ),
								'extension'=>array(
												  'rule' => array(
																  'extension',
																			  array('pdf')
																 ),
												  'message' => 'Please upload a valid Write Up 2.'	
								),
								'maxLength' => array(
													 'rule' => array('maxLength', 200),
													 'message' => 'Name of Write Up 2 cannot exceed more than 200 characters.'
													),
								'unique'	=> array(
													 'rule'    => 'isUnique',
													 'message' => 'Write Up 2 name should be Unique.'
													),
																												
							),
				
	);	
 
 public function chkifwantToUploadWriteUps1()
	{
	 $status = $this->data['ServiceAndBatchInfo']['upload_write_ups'];
	 $option=$this->data['ServiceAndBatchInfo']['write_up_1'];
	 
	 if($status=='Yes')
	 {
		  if($option=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }
	   
       return true;	 
	}	
 public function chkifwantToUploadWriteUps2()
	{
	 $status = $this->data['ServiceAndBatchInfo']['upload_write_ups'];
	 $option=$this->data['ServiceAndBatchInfo']['write_up_2'];
	 if($status=='Yes')
	 {
		  if($option=='')
		  {
			return false;  
		  }
		  else
		  {
			return true;  
		  }		  
	 }   
       return true;	 
	}

     //For Checking if Working Under Pvt Orgn
	public function chkifCadreIdisOthers($otherCadreName)
	{ 
     $cadre = $this->Cadre->find('first',array(
											   'fields'=>array('cadre_name'),
											   'conditions'=>array(
																   'id'=>$this->data['ServiceAndBatchInfo']['cadre_id']
																   ),
												'recursive'=>-1				   
											)
							   );

	 if($cadre['Cadre']['cadre_name']=='Others')
	 {
		  if($otherCadreName['other_cadre_name']=='')
		  {
			return false;  
		  }
		  else
		  { 
			return true;  
		  }		  
	 }
	   
       return true;
	}	
	
  public function beforeSave($options = array()) {
    if (!empty($this->data['ServiceAndBatchInfo']['doj_grp_a'])) 
	   {
        $this->data['ServiceAndBatchInfo']['doj_grp_a'] = $this->dateFormatBeforeSave(
           $this->data['ServiceAndBatchInfo']['doj_grp_a']
        );
       }
    return true;
}

public function dateFormatBeforeSave($dateString) {
    return date('Y-m-d', strtotime($dateString));
}	
}
