<?php
App::uses('AppController', 'Controller');
class SlidersController extends AppController {


        function beforeFilter(){
//            $this->Auth->allow('*');
            parent::beforeFilter();
        }


        
        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }



	public function admin_index() {
		$this->Slider->recursive = 0;
                $this->paginate = array('order'=>'Slider.id DESC');
		$this->set('sliders', $this->paginate());
	}

	public function admin_view($id = null) {
		$this->Slider->id = $id;
		if (!$this->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}
		$this->set('slider', $this->Slider->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Slider->create();
			if ($this->Slider->save($this->request->data)) {
				$this->Session->setFlash(__('The slider has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The slider could not be saved. Please, try again.'));
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
		$this->Slider->id = $id;
		if (!$this->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Slider->save($this->request->data)) {
				$this->Session->setFlash(__('The slider has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The slider could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Slider->read(null, $id);
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
		$this->Slider->id = $id;
		if (!$this->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}
		if ($this->Slider->delete()) {
			$this->Session->setFlash(__('Slider deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Slider was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
