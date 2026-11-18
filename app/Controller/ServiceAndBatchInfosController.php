<?php
App::uses('AppController','Controller');

class ServiceAndBatchInfosController extends AppController
 {
    public function beforeFilter() {
                                        parent::beforeFilter();
										//$this->Auth->allow();
									    $this->Security->unlockedFields = array('write_up_1','write_up_2');
									}

    public $uses = array('ServiceAndBatchInfo','Vacancy');
	
	
		  //For Chairman/Dy. Chairman Post
    
    public function info($id=null)
	 {
	  if(!$this->Vacancy->exists($id))
	  {
	   throw new NotFoundException('Invalid Vacancy'); 
	  }
      $currentDate = date('Y-m-d');	 
	  $approvedVacancies = $this->Vacancy->find('count',array('conditions'=>array(
	                                                                              'status'=>'Approved',
																				  'Vacancy.id'=>$id,
																				  'Notice.opening_date <=' => $currentDate,
																				  'Notice.closing_date >=' => $currentDate,
																				  )
															 ));	
	  if(!$approvedVacancies)
	  {
	    throw new NotFoundException('Invalid....');	  
	  }  
	  $this->Vacancy->Behaviors->load('Containable');
	  $post = $this->Vacancy->find('first',array('conditions'=>array(
	                                                                 'Vacancy.id'=>$id
																    ),
												  'fields'=>array('Vacancy.id'),					
												 'contain'=>array(
												                  'Post'=>array('post_name')
																 )				  
											    )
										);
										
      if(($post['Post']['post_name']=='Chairman') || ($post['Post']['post_name']=='Dy. Chairman'))
	  {		  
	   $this->request->data['ServiceAndBatchInfo']['user_id'] = $this->Session->read('Auth.User.id');
       $userExists = $this->ServiceAndBatchInfo->find('count',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')
	                                                                                   )
														           ));
																   
	 if($this->request->is(array('post','put')))
	   { 
         $this->request->data['ServiceAndBatchInfo']['batch'] = $this->request->data['ServiceAndBatchInfo']['batch']['year'];   
         if(!$userExists)
	      {
	       $this->ServiceAndBatchInfo->create(); 
	      }
		 else
		  {
			$serviceBatchInfos = $this->ServiceAndBatchInfo->find('first',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')
			                                                                                       ),
																			     'fields'=>'id'
																				 ));
		    $this->ServiceAndBatchInfo->id = $serviceBatchInfos['ServiceAndBatchInfo']['id'];																		  																				 
		  }		
		 $this->ServiceAndBatchInfo->validator()->remove('id'); 
         if($this->ServiceAndBatchInfo->save($this->request->data))
		  {   
			return $this->redirect(array('controller'=>'users','action'=>'other_info',$id)); 
		  }
         else
		  {
			//pr($this->ServiceAndBatchInfo->invalidFields());  
			$this->Session->setFlash('Sorry unable to edit details , Please try again later....','default',array('class'=>'alert alert-danger')); 
		  }			 
	   }	
     
                   //For Fetching Data
        $this->request->data = $this->ServiceAndBatchInfo->find('first',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')
		                                                                                         )
														                     )
															    );
		if(!empty($this->request->data['ServiceAndBatchInfo']['batch']))														
        $this->request->data['ServiceAndBatchInfo']['batch']= array('year'=>$this->request->data['ServiceAndBatchInfo']['batch']);														
	    if(!empty($this->request->data['ServiceAndBatchInfo']['doj_grp_a']))
		$this->request->data['ServiceAndBatchInfo']['doj_grp_a'] =date('d-m-Y',strtotime($this->request->data['ServiceAndBatchInfo']['doj_grp_a']));
	    
		$services = $this->ServiceAndBatchInfo->Service->find('list',array(
		                                                                   'fields'=>array('id','service_name'),
																		   'order' =>'id'
																		  ));
	    
		$cadres = $this->ServiceAndBatchInfo->Cadre->find('list',array(
																	   'fields'=>array('id','cadre_name'),
																	   'order' =>'id'
																	   ));
		$this->set(compact('services','cadres'));
	 }
	   else
	   {
		throw new NotFoundException('Invalid.....');   
	   }  
	 }
	 
	 
	public function dwn_self_write_up_1($id=null)
     {
	 
	 if(!$this->ServiceAndBatchInfo->exists($id))
	 {
	  throw new NotFoundException(_('Invalid Write Up'));	  
	 }
	 $writeUpPDF=$this->ServiceAndBatchInfo->find('first',array('conditions'=>array(
																					'id'=>$id,
																					'user_id'=>$this->Session->read('Auth.User.id')
																					
																					),
														   'recursive' =>-1,
														  'order'=>array('ServiceAndBatchInfo.id'=>'asc')
														  )
														   );
	if(array_key_exists('ServiceAndBatchInfo', $writeUpPDF))
		{
			$file=$writeUpPDF['ServiceAndBatchInfo']['write_up_1'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download'=>true,'name'=>'write_up_1.pdf'));
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}													 
    }


    public function dwn_self_write_up_2($id=null)
     {
	 
	 if(!$this->ServiceAndBatchInfo->exists($id))
	 {
	  throw new NotFoundException(_('Invalid Write Up'));	  
	 }
	 $writeUpPDF=$this->ServiceAndBatchInfo->find('first',array('conditions'=>array(
																					'id'=>$id,
																					'user_id'=>$this->Session->read('Auth.User.id')
																					
																					),
														   'recursive' =>-1,
														  'order'=>array('ServiceAndBatchInfo.id'=>'asc')
														  )
														   );
	if(array_key_exists('ServiceAndBatchInfo', $writeUpPDF))
		{
			$file=$writeUpPDF['ServiceAndBatchInfo']['write_up_2'];
			$this->response->file(WWW_ROOT .'/uploads/write_ups/'.$file,array('download'=>true,'name'=>'write_up_2.pdf'));
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}													 
    }
	
	 
	 
 
 }	
  
	
	
	
	
	
	