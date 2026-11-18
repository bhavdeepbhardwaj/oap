<?php
App::uses('AppController','Controller');

class UserEmploymentDetailsController extends AppController
{
 public function beforeFilter()
                               {
								parent::beforeFilter();  
							    $this->Security->unlockedFields = array('exp_pdf');
							   }

 public function add()
 {
   //Writing this code so that user id will be automatically added in the table	 
   $this->request->data['UserEmploymentDetail']['user_id']=$this->Session->read('Auth.User.id');	
      
   $infos = $this->UserEmploymentDetail->User->InformationUser->find('first',array('conditions'=>array(
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
	  if($currentStatus=='step2_cond')
	   {
		return $this->redirect(array('controller'=>'user_qualifications','action'=>'add'));
		echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Kindly fill your Qualifications first....','default',array('class'=>'alert alert-danger alert-dismissable'));   		
	   } 
	 if($currentStatus=='step3_qd')
	   {
		return $this->redirect(array('controller'=>'users','action'=>'current_service_details'));
		echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Kindly fill your Qualifications first....','default',array('class'=>'alert alert-danger alert-dismissable'));   		
	   }   
   
   if($this->request->is('post'))
    {
	 $this->UserEmploymentDetail->create();
        if($this->UserEmploymentDetail->save($this->request->data))
		{
		 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Qualification Successfully Added....','default',array('class'=>'alert alert-success alert-dismissable'),'edu_qualification');
		 $this->request->data=null;	
		}
        else
		{
		 //pr($this->UserEmploymentDetail->invalidFields());
			
		 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>Sorry unable to Add Employment Details ,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));	
		}			
    } 
	$empDetailExists = $this->UserEmploymentDetail->find('count',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')))); 
	$services        = $this->UserEmploymentDetail->find('all',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')),
	                                                                 'recursive'=>-1
																	));
	$this->set(compact('services','empDetailExists'));
    
 } 
 
 
 
  public function dwn_self_emp_doc($id=null)
 {
	 
	 if(!$this->UserEmploymentDetail->exists($id))
	   {
		   throw new NotFoundException(__('Invalid User Employment Details.'));
	   } 
	 $empPDF=$this->UserEmploymentDetail->find('first',array('conditions'=>array(
																								'id'=>$id,
																								'user_id'=>$this->Session->read('Auth.User.id')
																								
																								),
	                                                                   'recursive' =>-1,
	                                                                  'order'=>array('UserEmploymentDetail.id'=>'asc')
																	  )
														   );
	if(array_key_exists('UserEmploymentDetail', $empPDF))
		{
			$file=$empPDF['UserEmploymentDetail']['exp_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/documents/'.$file,array('download'=>true,'name'=>'experience_certificate.pdf'));
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}													 
 }
 
 public function edit($id=null)
 {
   
   if(!$this->UserEmploymentDetail->exists($id))
   {
	   throw new NotFoundException(__('Invalid User Employment Details.'));
   }  
   if(!$this->UserEmploymentDetail->find('count',array('conditions'=>array('UserEmploymentDetail.id'=>$id,'UserEmploymentDetail.user_id'=>$this->Session->read('Auth.User.id')))))
   {
	   throw new NotFoundException(__('Invalid User Employment Details.'));
   }    
   if($this->request->is(array('post','put')))
    {		
	  $this->UserEmploymentDetail->id=$id;
	  if($this->UserEmploymentDetail->save($this->request->data))
	    {
		 return $this->redirect(array('action'=>'add'));		 
	    } 
	  else
	    {
		 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry,unable to edit Employment Details....','default',array('class'=>'alert alert-danger alert-dismissable'));     
	    }		  
    }	   
	
		$options = array('conditions' => array('UserEmploymentDetail.' . $this->UserEmploymentDetail->primaryKey => $id));
		$this->request->data = $this->UserEmploymentDetail->find('first', $options);
	    $this->request->data['UserEmploymentDetail']['from_date']= date(('d-m-Y'),strtotime($this->request->data['UserEmploymentDetail']['from_date']));
		$this->request->data['UserEmploymentDetail']['to_date']= date(('d-m-Y'),strtotime($this->request->data['UserEmploymentDetail']['to_date']));
	    $expCert = $this->request->data['UserEmploymentDetail']['id'];
	  
	  $this->set(compact('expCert'));
 }
 
 public function next()
 {
	$info = $this->UserEmploymentDetail->User->InformationUser->find('first',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')
	                                                                                                ),
																				 'fields'=>array('id','current_status')					
																				));
	$this->UserEmploymentDetail->User->InformationUser->id = $info['InformationUser']['id'];
	
	$currentStatus = $info['InformationUser']['current_status']; 
	  if(($currentStatus == 'registered') || ($currentStatus == 'step1_bi') || ($currentStatus == 'step2_cond') || ($currentStatus == 'step3_qd') || ($currentStatus == 'step4_csd'))
	   {
	    $this->UserEmploymentDetail->User->InformationUser->saveField('current_status','step5_expd');
	   }
	return $this->redirect(array('controller'=>'users','action'=>'doc_upload_part1'));	 
 }
 
}