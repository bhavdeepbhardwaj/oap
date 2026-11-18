<?php
App::uses('AppController', 'Controller');

class AuditTrailsController extends AppController {
    public $components = array('Paginator');
    public $uses = array('LoginLog');
    
    public function beforeFilter() {
        parent::beforeFilter(); 
    }
    
    public function login_log()
    {
        $this->Paginator->settings = array(
			 
                                                'order' => array('id' => 'desc'),
                                                'recursive'=>0,
                                                'limit'=>50
                                            );
        $logs = $this->Paginator->paginate('LoginLog');
        $this->set(compact('logs'));
    }
    
    
    public function action_log()
    {
       $this->Paginator->settings = array(
			 
                                                'order' => array('id' => 'desc'),
                                                'recursive'=>0,
                                                'limit'=>20
                                            );
        $actionlogs = $this->Paginator->paginate('ActionLog');
        $this->set(compact('actionlogs'));
    }
        
}

