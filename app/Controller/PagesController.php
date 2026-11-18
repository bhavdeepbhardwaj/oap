<?php
App::uses('AppController', 'Controller');


class PagesController extends AppController
{
    
    public $components = array('Paginator');
	public function beforeFilter() {
        $this->Auth->allow('view');
	}
    public function index()
    {
        $this->Paginator->settings =    array(
                                                
                                                'order'=>array('Page.title'=>'desc'),
                                                'limit'=>2
                                            );
        $pages = $this->Paginator->paginate('Page');
        $this->set('pages',$pages);
    }
    
    public function add()
    {
        if($this->request->is('post'))
        {
            $this->Page->create();
            if($this->Page->save($this->request->data))
            {
                $this->Session->setFlash(__('Page has been created.'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action'=>'index'));
            }
            else
            {
                $this->Session->setFlash(__('Page can not be created. Please try again.'),'default',array('class'=>'alert alert-warning'));
            }
        }
    }
    
    public function edit($id=null)
    {
        if(!$this->Page->exists($id))
        {
            throw new NotFoundException(__('Invalid page.'));
        }
        
        if ($this->request->is(array('post', 'put')))
        {
            
            if($this->Page->save($this->request->data))
            {
                $this->Session->setFlash(__('Page has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action'=>'index'));
            }
            else
            {
                $this->Session->setFlash(__('Page can not be updated. Please try again.'),'default',array('class'=>'alert alert-warning'));
            }
        }
        
        $this->request->data=$this->Page->find('first',array('conditions'=>array('Page.id'=>$id)));
    }
    
    public function view($slug=null)
    {
        $this->layout='home';
        if(!$this->Page->find('count',array('conditions'=>array('Page.slug'=>$slug))))
        {
            throw new NotFoundException(__('Page not found'));
        }
        
        $page=$this->Page->find('first',array('conditions'=>array('Page.slug'=>$slug)));
        $this->set(compact('page'));
    }
}