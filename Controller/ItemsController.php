<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

    public $uses = array('Item','ItemsTag');
    public $helpers = array('Thumb');


    function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('*');
    }


        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }

	public function admin_index() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}


	public function admin_view($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}


	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
	}


	public function admin_edit($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
		}
	}


	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


//items from *.xml to data base
        public function items_to_db(){
            $items = simplexml_load_string(file_get_contents('files/items.xml'));

            $id=1;
            foreach($items as $item){
              //zapis itemu jednego
                $this->Item->create();
                $this->Item->set(array(
                    'id'=>$id,
                    'name_pl'=>$item->pl,
                    'name_en'=>$item->en,
                    'price1'=>intval($item->c1),
                    'price2'=>intval($item->c2),
                    'desc_pl'=>$item->d
                    )
                );
                $this->Item->save();

                
              //zapis tagow do tego itemu
                foreach($item->t as $tag){
                    $this->ItemsTag->create();
                    $this->ItemsTag->set(array(
                        'item_id'=>$id,
                        'name'=>$tag
                        )
                    );
                    $this->ItemsTag->save();
                }
                $id++;
            }
            exit;

        }


}
