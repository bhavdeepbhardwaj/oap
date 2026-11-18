<?php 
App::uses('AppController','Controller');

class HomeController extends AppController
{
   public $uses = array('Notice','Vacancy');
	
	public function index()
	{
	 $this->layout='home';
	 
	 if($this->Session->check('Auth.User'))
		{
			$this->redirect(array('controller'=>'dashboard','action' => 'index'));		
		}
	 
	 $currentDate = date('Y-m-d');
	 
	 $this->set('notices',$this->Notice->find('all',array(
	                                                       'conditions'=>array('Notice.closing_date >=' => $currentDate) 
														  )
											  ));
	 $this->set('vacancies',$this->Vacancy->find('all',array('conditions'=>array('status'=>'Approved',
	                                                                             'Notice.opening_date <=' => $currentDate,
	                                                                             'Notice.closing_date >=' => $currentDate
																				 )
														    )));
	}
	public function notices()
	{
	 $this->layout='home';	
	 if($this->Session->check('Auth.User'))
		{
			$this->redirect(array('controller'=>'dashboard','action' => 'index'));		
		}
	 $currentDate = date('Y-m-d');	
	 $this->set('notices',$this->Notice->find('all',array(
	                                                       'conditions'=>array('Notice.closing_date >=' => $currentDate) 
														  )));	
	}
	
	public function dwnld_advt($id=null)
	{
		if(!$this->Notice->exists($id))
		{
			throw new NotFoundException(__('Invalid Notice'));
		}
		
		$currentDate = date('Y-m-d');
		$advertisementPDF=$this->Notice->find('first',array(
	                                                       'conditions'=>array(
																				'Notice.id'=>$id,
																				'Notice.closing_date >=' => $currentDate
																				),
															'fields'=>array('advt_pdf')					
														  )
												);
												
		if(array_key_exists('Notice', $advertisementPDF))
		{
			$file=$advertisementPDF['Notice']['advt_pdf'];
			$this->response->file(WWW_ROOT .'/uploads/advertisements/'.$file);
			return $this->response;
		}
		else
		{
			throw new UnauthorizedException(__('You are not authrozed to download this file.'));
		}
	}
	
    public function vacancies()
	{
	 $this->layout='home';
     if($this->Session->check('Auth.User'))
		{
			$this->redirect(array('controller'=>'dashboard','action' => 'index'));		
		}	 
	 $currentDate = date('Y-m-d');
	 $this->set('vacancies',$this->Vacancy->find('all',array('conditions'=>array('status'=>'Approved','Notice.opening_date <=' => $currentDate,'Notice.closing_date >=' => $currentDate))));	
	}
	
	public function download_guidelines()
	{
			$file= 'Guidelines.pdf';
			$this->response->file(WWW_ROOT .'/uploads/guidelines/'.$file);
			return $this->response;
		
	}
	
	public function download_instructions()
	{
			$file= 'Instructions.pdf';
			$this->response->file(WWW_ROOT .'/uploads/instructions_for_applying_online/'.$file);
			return $this->response;
		
	}
	
	public function download_faqs()
	{
			$file= 'FAQs.pdf';
			$this->response->file(WWW_ROOT .'/uploads/faqs/'.$file);
			return $this->response;
		
	}
	
}