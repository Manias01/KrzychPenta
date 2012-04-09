<?php
App::uses('AppController', 'Controller');

class NewsController extends AppController {
        public $name = 'News';
        public $uses = array('News','Build');
        public $helpers = array('Html','Text','Thumb');
        public $paginate = array(
            'limit' => 10,
            'order' => array(
                'News.id' => 'desc'
            )
        );

        function beforeFilter(){
            $this->Auth->allow('*');
            
        //content to 'najnowsze poradniki' for layout 'default.ctp'
            $newest = $this->Build->find('all',array('recursive'=>1,'limit'=>3,'order'=>'Build.id desc',
                'fields'=>array('id','champion_id','Champion.name'))
            );
            $this->set('newest_builds',$newest);
            parent::beforeFilter();
        }


        public function single_news($id){
            $single_news = $this->News->find('first',array('conditions'=>array('News.id'=>$id)));
            $this->set('single_news',$single_news);

            $this->set('header','Aktualność');
            $this->set('title_for_layout', $single_news['News']['title']);
        }


        public function all_news(){
            $news = $this->paginate('News');
            $this->set('news',$news);
            
            $this->set('header','Wszystkie aktualności');
            $this->set('title_for_layout', 'Wszystkie aktualności');
        }



/*--------------Admin functions------------*/

	public function admin_index() {
		$this->News->recursive = 0;
		$this->set('news', $this->paginate());
	}

	public function admin_view($id = null) {
		$this->News->id = $id;
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Invalid news'));
		}
		$this->set('news', $this->News->read(null, $id));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->News->create();
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('The news has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		$this->News->id = $id;
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Invalid news'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('The news has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->News->read(null, $id);
		}
	}


	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->News->id = $id;
		if (!$this->News->exists()) {
			throw new NotFoundException(__('Invalid news'));
		}
		if ($this->News->delete()) {
			$this->Session->setFlash(__('News deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('News was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
