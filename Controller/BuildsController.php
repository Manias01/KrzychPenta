<?php
App::uses('AppController', 'Controller');

class BuildsController extends AppController {
        public $helpers=array('StrChanger');

        function beforeFilter(){
          $this->Auth->allow('*');
          parent::beforeFilter();
        }


        public function admin_index() {
		$this->Build->recursive = 0;
                $this->paginate = array('order'=>array('Build.created'=>'desc'));
		$this->set('builds', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Build->id = $id;
		if (!$this->Build->exists()) {
			throw new NotFoundException(__('Invalid build'));
		}
		$this->set('build', $this->Build->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Build->create();
			if ($this->Build->save($this->request->data)) {
				$this->Session->setFlash(__('The build has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The build could not be saved. Please, try again.'));
			}
		}
		$champions = $this->Build->Champion->find('list');
		$users = $this->Build->User->find('list');
		$this->set(compact('champions', 'users'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Build->id = $id;
		if (!$this->Build->exists()) {
			throw new NotFoundException(__('Invalid build'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Build->save($this->request->data)) {
				$this->Session->setFlash(__('The build has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The build could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Build->read(null, $id);
		}
		$champions = $this->Build->Champion->find('list');
		$users = $this->Build->User->find('list');
		$this->set(compact('champions', 'users'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Build->id = $id;
		if (!$this->Build->exists()) {
			throw new NotFoundException(__('Invalid build'));
		}
		if ($this->Build->delete()) {
			$this->Session->setFlash(__('Build deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Build was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
