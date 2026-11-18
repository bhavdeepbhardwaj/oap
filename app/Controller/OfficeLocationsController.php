<?php
App::uses('AppController','Controller');

class OfficeLocationsController extends AppController
{
 public function beforeFilter() {
                                        parent::beforeFilter();
										
									   }

 public function index()
  {
    $this->set('officelocations',$this->OfficeLocation->find('all',array('order'=>'OfficeLocation.id'))); 
  }


 public function add()
  {
  if($this->request->is('post'))
    {
		$this->request->data['OfficeLocation']['created_by_user_id'] = $this->Session->Read('Auth.User.id'); 
		$this->OfficeLocation->create();
	  if($this->OfficeLocation->saveAll($this->request->data, array('deep' => true)))
	    {
		 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Office Locations & Departments Successfully assigned to Organizations....','default',array('class'=>'alert alert-success alert-dismissable'));	
         return $this->redirect(array('action'=>'index'));
		}
	  else
        {
			
			
			echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry ,Unable to Assign Office Locations & Departments to Organizations,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));	
        }		
    }
	
	$organizations = $this->OfficeLocation->Organization->find('list',array('fields'=>'organization_name'));
	$departments   = $this->OfficeLocation->Department->find('list',array('fields'=>'department_name'));
	$states        = $this->OfficeLocation->State->find('list',array('fields'=>'state_name'));
	$this->set(compact('organizations','departments','states'));
 }
 
 public function edit($id=null)
 {
  if(!$this->OfficeLocation->exists($id))
   {
	throw new NotFoundException('Invalid Office Location');  
   }
  
  if($this->request->is(array('post','put')))
  {
	$this->request->data['OfficeLocation']['modified_by_user_id'] = $this->Session->Read('Auth.User.id');    
	if($this->OfficeLocation->saveAll($this->request->data, array('deep' => true)))
	    {
		 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Assigned Office Locations and Departments Successfully Edited....','default',array('class'=>'alert alert-success alert-dismissable'));	
         return $this->redirect(array('action'=>'index'));
		}
    else
	{
	 echo $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Sorry ,Unable to Edit Assigned Office Locations & Departments to Organizations,Please try again later....','default',array('class'=>'alert alert-danger alert-dismissable'));		
	}		
  }
  else
  {
    $this->request->data = $this->OfficeLocation->find('first',array(
	                                                                 'conditions'=>array('OfficeLocation.id'=>$id)
																	)
													   );
    $organizations = $this->OfficeLocation->Organization->find('list',array('fields'=>array('id','organization_name')));
	$departments   = $this->OfficeLocation->Department->find('list',array('fields'=>array('id','department_name')));
	$states        = $this->OfficeLocation->State->find('list',array('fields'=>array('id','state_name')));
    $cityId      = $this->request->data['City']['id'];
	$this->set(compact(array('organizations','departments','states','cities','cityId')));
  }	  
 }
 
 public function citiesbystateid()
 {
	 $this->layout=false;
  if($this->request->is('post'))
  {
	$stateId = $this->request->data['id'];
    $cities =  $this->OfficeLocation->City->find('list',array(
	                                          'conditions'=>array('state_id'=>$stateId),
											  'fields'    =>array('id','city_name'),
											  'order'     =>'city_name'
											 )
                                 );		
									
  }
  $this->set('cities',$cities);  
 }
 
 


}