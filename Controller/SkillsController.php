<?php
App::uses('AppController', 'Controller');

class SkillsController extends AppController {
    public $uses = array('Skill','Champion');
    public $helpers = array('Thumb');


    function beforeFilter(){
      $this->Auth->allow('*');
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



      public function GetSkillName($champ_nr) {
            $stronaEN = file_get_contents('http://eune.leagueoflegends.com/champions/'.$champ_nr);
            $stronaPL = file_get_contents('http://eune.leagueoflegends.com/pl/champions/'.$champ_nr);

            $skill_namePL = $this->Tnij($stronaPL,'<span class="ability_name">', '</span>');
            $skill_nameEN = $this->Tnij($stronaEN,'<span class="ability_name">', '</span>');
            $skill_descPL = $this->Tnij($stronaPL,'<div class="ability_effect">', '</div>');
            $passive_descPL = $this->Tnij($stronaPL,'<span class="ability_description">', '</span>');
            $skill_descPL[5] = $passive_descPL[1];

            //zapis do bazy danych:
            for($a=1;$a<=5;$a++){
                $this->Skill->create();
                $this->Skill->save(array(
                  'champion_id' => $champ_nr,
                  'name_pl' => $skill_namePL[$a],
                  'name_en' => $skill_nameEN[$a],
                  'desc_pl' => $skill_descPL[$a],
                  /*'cooldown' => ,
                  'cost' => ,
                  'range' => ,*/
                  'type' => $a
                  )
                );
                $this->Skill->save();
            }
      }

      public function GetSkills(){

            $champ_nr = $this->Champion->find('all',array('fields'=>array('Champion.id'),'order'=>'Champion.id ASC') );
            for($a=0;$a<count($champ_nr);$a++){
                $this->GetSkillName($champ_nr[$a]['Champion']['id']);
            }


      }




}
