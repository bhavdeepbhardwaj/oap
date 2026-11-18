<?php
App::uses('AppController','Controller');

class UserQualificationsController extends AppController
{
 public function beforeFilter()
                               {
									parent::beforeFilter();  
									$this->Security->unlockedFields = array('UserQualification.edu_pdf');
							
							   }

 public function add()
 {   
   //Writing this code so that user id will be automatically added in the table
   $this->request->data['UserQualification']['user_id']=$this->Session->read('Auth.User.id');	  
   
   $infos = $this->UserQualification->User->InformationUser->find('first',array('conditions'=>array(
																				  'user_id'=>$this->Session->read('Auth.User.id')
																				  ),
															  'fields'=>array('id','current_status')					  
															  )
												);
    $currentStatus = $infos['InformationUser']['current_status'];
	  if($currentStatus=='registered')
	   {
		return $this->redirect(array('controller'=>'users','action'=>'basic_info'));
		echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Kindly fill the Personal Information first....','default',array('class'=>'alert alert-danger alert-dismissable'));   		
	   }
      if($currentStatus=='step1_bi')
	   {
		return $this->redirect(array('controller'=>'users','action'=>'contact_details'));
		echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Kindly fill the Contact Details first....','default',array('class'=>'alert alert-danger alert-dismissable'));   		
	   }	   
	   
   if($this->request->is('post'))
    { 
	$this->request->data['UserQualification']['y_o_p']=$this->request->data['UserQualification']['y_o_p']['year']; 	 	
	
	$this->UserQualification->create();
        if($this->UserQualification->save($this->request->data))
		{
		 //echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Qualification Successfully Added....','default',array('class'=>'alert alert-success alert-dismissable'),'edu_qualification');
		 $this->request->data=null;	
		}
        else
		{
		 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Sorry unable to Add Qualification ,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));	
		}			
    } 
    $educationQualifications=$this->UserQualification->EducationQualification->find('list',array('fields'=>array('id','education_qualification')));
    $qualificationExists = $this->UserQualification->find('count',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))));
	$this->set(compact('educationQualifications','qualificationExists'));
	$this->set('educations',$this->UserQualification->find('all',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')),
	                                                                   'recursive' =>-1,
	                                                                  'order'=>array('UserQualification.id'=>'asc')
																	  )
														   )
														 );
 }
 
 public function dwn_self_quali_doc($id=null)
 {
	 
	 if(!$this->UserQualification->exists($id))
	 {
	  throw new NotFoundException(_('Invalid User Education Qualification'));	  
	 }
	 $educationPDF=$this->UserQualification->find('first',array('conditions'=>array(
																								'id'=>$id,
																								'user_id'=>$this->Session->read('Auth.User.id')
																								
																								),
	                                                                   'recursive' =>-1,
	                                                                  'order'=>array('UserQualification.id'=>'asc')
																	  )
														   );
	if(array_key_exists('UserQualification', $educationPDF))
		{
			$file=$educationPDF['UserQualification']['edu_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download'=>true,'name'=>'qualification_certificate.pdf'));
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}													 
 }

 public function edit($id=null)
 {
	if(!$this->UserQualification->exists($id))
	 {
	  throw new NotFoundException(_('Invalid User Education Qualification Details'));	  
	 }		
	if(!$this->UserQualification->find('count',array(
	                                                'conditions'=>array(
													                    'UserQualification.id'=>$id,
																		'UserQualification.user_id'=>$this->Session->read('Auth.User.id')
																		)
													)
									  ))
      {
	   throw new NotFoundException(_('Invalid User Education Qualification Details'));
	  }									  
	if($this->request->is(array('post','put')))
	{
	  $this->request->data['UserQualification']['y_o_p'] = $this->request->data['UserQualification']['y_o_p']['year'];	
      $this->UserQualification->id=$id; 		
	  if($this->UserQualification->save($this->request->data))	
	  {  
        echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Education Qualification Successfully Edited....','default',array('class'=>'alert alert-success alert-dismissable')); 
	    return $this->redirect(array('action'=>'add'));
      }
	  else
	  {
		echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Unable to edit Education Qualification....','default',array('class'=>'alert alert-danger alert-dismissable'));   
	  }  
	}
    
		$options = array('conditions' => array('UserQualification.' . $this->UserQualification->primaryKey => $id));
		$this->request->data = $this->UserQualification->find('first', $options);
		$this->request->data['UserQualification']['y_o_p'] = array('year'=>$this->request->data['UserQualification']['y_o_p']);
	    $education = $this->request->data['UserQualification']['id'];
	  
    $educationQualifications=$this->UserQualification->EducationQualification->find('list',array('fields'=>array('id','education_qualification')));
    $this->set(compact('educationQualifications','education'));	  
 } 
 
 public function next()
 {
	$info = $this->UserQualification->User->InformationUser->find('first',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')
	                                                                                                ),
																				 'fields'=>array('id','current_status')					
																				));
	$this->UserQualification->User->InformationUser->id = $info['InformationUser']['id'];
	
	$currentStatus = $info['InformationUser']['current_status']; 
    
	if(($currentStatus == 'registered') || ($currentStatus == 'step1_bi') || ($currentStatus == 'step2_cond'))
	  {  
	   $this->UserQualification->User->InformationUser->saveField('current_status','step3_qd');
      }
	return $this->redirect(array('controller'=>'users','action'=>'current_service_details'));	 
 }
 
}