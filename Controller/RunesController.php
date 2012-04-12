<?php
App::uses('AppController', 'Controller');

class RunesController extends AppController {
    public $helpers = array('Thumb');

    
        function beforeFilter(){
//          $this->Auth->allow('*');
          parent::beforeFilter();
        }



        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }

	public function admin_index() {
		$this->Rune->recursive = 0;
		$this->set('runes', $this->paginate());
	}


	public function admin_view($id = null) {
		$this->Rune->id = $id;
		if (!$this->Rune->exists()) {
			throw new NotFoundException(__('Invalid rune'));
		}
		$this->set('rune', $this->Rune->read(null, $id));
	}


	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Rune->create();
			if ($this->Rune->save($this->request->data)) {
				$this->Session->setFlash(__('The rune has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rune could not be saved. Please, try again.'));
			}
		}
	}


	public function admin_edit($id = null) {
		$this->Rune->id = $id;
		if (!$this->Rune->exists()) {
			throw new NotFoundException(__('Invalid rune'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rune->save($this->request->data)) {
				$this->Session->setFlash(__('The rune has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rune could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Rune->read(null, $id);
		}
	}


	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Rune->id = $id;
		if (!$this->Rune->exists()) {
			throw new NotFoundException(__('Invalid rune'));
		}
		if ($this->Rune->delete()) {
			$this->Session->setFlash(__('Rune deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rune was not deleted'));
		$this->redirect(array('action' => 'index'));
	}



        public function get_runes(){
            $site_en = file_get_contents('http://eune.leagueoflegends.com/runes/3');
            $site_pl = file_get_contents('http://eune.leagueoflegends.com/pl/runes/3');

            $name_pl = $this->Tnij($site_pl,'<td class="rune_name">','</td>');
            $desc_pl = $this->Tnij($site_pl,'<td class="rune_description">','</td>');
            
            $name_en = $this->Tnij($site_en,'<td class="rune_name">','</td>');
            $desc_en = $this->Tnij($site_en,'<td class="rune_description">','</td>');


            //nie potrzeba pliku XML, tylko wpis do bazy:
            for($a=1;$a<=count($name_en);$a++){
                $type = 0;
                if(stripos($name_en[$a],'Mark')) $type = 1;
                if(stripos($name_en[$a],'Seal')) $type = 2;
                if(stripos($name_en[$a],'Glyph')) $type = 3;
                if(stripos($name_en[$a],'Quintessence')) $type = 4;

                $this->Rune->create();
                $this->Rune->set(array(
                    'name_pl'=>$name_pl[$a],
                    'name_en'=>$name_en[$a],
                    'desc_pl'=>$desc_pl[$a],
                    'desc_en'=>$desc_en[$a],
                    'type'=>$type
                    )
                );
                $this->Rune->save();
            }
            debug($this->Rune->validationErrors);
            exit;

        }



}
