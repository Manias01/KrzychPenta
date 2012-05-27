<?php
App::uses('AppController', 'Controller');

class SkillsController extends AppController {
    public $uses = array('Skill','Champion');
    public $helpers = array('Thumb');


    function beforeFilter(){
//      $this->Auth->allow('*');
      parent::beforeFilter();
    }


        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }
    
	public function admin_index() {
		$this->Skill->recursive = 0;
		$this->set('skills', $this->paginate());
	}


	public function admin_view($id = null) {
		$this->Skill->id = $id;
		if (!$this->Skill->exists()) {
			throw new NotFoundException(__('Invalid skill'));
		}
		$this->set('skill', $this->Skill->read(null, $id));
	}


	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Skill->create();
			if ($this->Skill->save($this->request->data)) {
				$this->Session->setFlash(__('The skill has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The skill could not be saved. Please, try again.'));
			}
		}
		$champions = $this->Skill->Champion->find('list');
		$this->set(compact('champions'));
	}


	public function admin_edit($id = null) {
		$this->Skill->id = $id;
		if (!$this->Skill->exists()) {
			throw new NotFoundException(__('Invalid skill'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Skill->save($this->request->data)) {
				$this->Session->setFlash(__('The skill has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The skill could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Skill->read(null, $id);
		}
		$champions = $this->Skill->Champion->find('list');
		$this->set(compact('champions'));
	}


	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Skill->id = $id;
		if (!$this->Skill->exists()) {
			throw new NotFoundException(__('Invalid skill'));
		}
		if ($this->Skill->delete()) {
			$this->Session->setFlash(__('Skill deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Skill was not deleted'));
		$this->redirect(array('action' => 'index'));
	}



}
