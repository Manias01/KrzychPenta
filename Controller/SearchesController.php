<?php
App::uses('AppController', 'Controller');
/**
 * Searches Controller
 *
 * @property Search $Search
 */
class SearchesController extends AppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Search->recursive = 0;
                $this->Search->order = array('Search.id DESC');
		$this->set('searches', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Search->id = $id;
		if (!$this->Search->exists()) {
			throw new NotFoundException(__('Invalid search'));
		}
		$this->set('search', $this->Search->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Search->create();
			if ($this->Search->save($this->request->data)) {
				$this->Session->setFlash(__('The search has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The search could not be saved. Please, try again.'));
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
		$this->Search->id = $id;
		if (!$this->Search->exists()) {
			throw new NotFoundException(__('Invalid search'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Search->save($this->request->data)) {
				$this->Session->setFlash(__('The search has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The search could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Search->read(null, $id);
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
		$this->Search->id = $id;
		if (!$this->Search->exists()) {
			throw new NotFoundException(__('Invalid search'));
		}
		if ($this->Search->delete()) {
			$this->Session->setFlash(__('Search deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Search was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
