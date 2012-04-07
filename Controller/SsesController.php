<?php
App::uses('AppController', 'Controller');

class SsesController extends AppController {

        public $helpers = array('Thumb');

        function beforeFilter(){
          $this->Auth->allow('*');
          parent::beforeFilter();
        }


        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }

	public function admin_index() {
		$this->Ss->recursive = 0;
		$this->set('sses', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Ss->id = $id;
		if (!$this->Ss->exists()) {
			throw new NotFoundException(__('Invalid ss'));
		}
		$this->set('ss', $this->Ss->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Ss->create();
			if ($this->Ss->save($this->request->data)) {
				$this->Session->setFlash(__('The ss has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ss could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Ss->id = $id;
		if (!$this->Ss->exists()) {
			throw new NotFoundException(__('Invalid ss'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ss->save($this->request->data)) {
				$this->Session->setFlash(__('The ss has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ss could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Ss->read(null, $id);
		}
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
		$this->Ss->id = $id;
		if (!$this->Ss->exists()) {
			throw new NotFoundException(__('Invalid ss'));
		}
		if ($this->Ss->delete()) {
			$this->Session->setFlash(__('Ss deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ss was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
