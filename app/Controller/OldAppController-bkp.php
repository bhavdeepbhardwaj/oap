<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
public $uses=array('ActionLog');
     //Adding Auth Component
     public $components = array(
	    'Security',
        'Acl',
		'Session',
       'Auth' => array(
            'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller' => '/', 'action' => '#logout'),
			'authError' => 'You do not have permissions to view this page.',
			'loginError' => 'Invalid Username or Password entered, please try again.',
			'authorize' => array(
                'Actions' => array('actionPath' => 'controllers', 'userModel' => 'User')
            ),
			  'unauthorizedRedirect' => false
 
        ),
		'Mpdf','Paginator','RequestHandler'
                                );

	public $helpers = array('Html', 'Form', 'Session','Js' => array('Jquery'), 'JqueryValidation');
				
	public function beforeFilter() 
	{
									
			$this->disableCache();						
									if($this->params['controller']=='users')
									{
                                     $this->Auth->allow('user_registration','login');	

									} 
									if($this->params['controller']=='home')
									{
                                     $this->Auth->allow('index','notices','dwnld_advt','vacancies','download_guidelines','download_instructions','download_faqs');	

									}
									
		//Audit							
			
		if(isset($this->Security) &&  $this->RequestHandler->isAjax()){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
				
		$this->Security->blackHoleCallback = 'blackhole';
		
		if($this->Session->check('Auth.User.id'))
		{		
			   
				$act=$this->request->params['action'];
				
				$actarr=array('change_password','logout','change_pwd_logout','download_self_profile_pic');
				if(!in_array($act,$actarr))
				{		
					if( $this->Session->read('Auth.User.password_status')=='Unchanged')
					 { 
					   $this->Session->setFlash('<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Please change the password first....','default',array('class'=>'alert alert-success alert-dismissable'));
					   return $this->redirect(array('controller'=>'users','action'=>'change_password'));	
					 }	
				}
		}
                
                if($this->Session->check('Auth.User.id'))
                {
                    $trailData=array();
                    $trailData['ActionLog']=array(
                                                    'username'=>$this->Session->read('Auth.User.username'),
                                                    'ip_address'=>$this->request->clientIp(),

                                                //   'session_id'=>$this->Session->id(),
                                                    'action_requested'=>$this->request->params['action'],
                                                    'full_url'=>$this->request->here(true),
                                              //      'process_id'=>posix_getpid(),
                                                     'process_id'=>getmypid(),
                                                     'refferer_url'=>$this->request->referer(),
                                                     //'data_sent_in_request'=>serialize($this->request)
                                                    );
                    $this->ActionLog->create();
                    $this->ActionLog->save($trailData);
                }				
	}	
			public function isAuthorized($user) {
					
					return false;
				}
				
			function _blackhole($type) {
			 $this->Session->setFlash(__('ERROR: %s',$type), 'flash/error');
				}
			
  }

