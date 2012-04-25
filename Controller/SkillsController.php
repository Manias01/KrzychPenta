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



        public function GetSkillNameAndLore($champion_id,$champion_slug){
            if(!$champion_id || !$champion_slug){
                echo 'Brakuje id championa lub slug championa';
                exit;
            }
echo '<br/>-'.$champion_id.'|'.$champion_slug.'<br/>';
echo 'GetSkillNameAndLore';
            //$sizes = array(20,38,64); //sizes to resize champions images

            //get data for skills from web:
$test = 'http://eune.leagueoflegends.com/champions/'.$champion_id;
            $stronaEN = file_get_contents($test);
echo '<br/>po 1 file_get_content<br/>';
exit;
            $stronaPL = file_get_contents('http://eune.leagueoflegends.com/pl/champions/'.$champion_id);
echo 'po 2 fle_get_content';

            $skill_namePL = $this->Tnij($stronaPL,'<span class="ability_name">', '</span>');
            $skill_nameEN = $this->Tnij($stronaEN,'<span class="ability_name">', '</span>');
            $skill_descPL = $this->Tnij($stronaPL,'<div class="ability_effect">', '</div>');
            $passive_descPL = $this->Tnij($stronaPL,'<span class="ability_description">', '</span>');
            $skill_descPL[5] = $passive_descPL[5];

            //get data for 'lore' in 'champions' table:
            $pattern = '/<td class="champion_description">(.*)<\/td>/';
            preg_match($pattern, $stronaPL, $lore);
echo 'pre-save';

            //save 'description'(lore) to 'champions' table
            $this->Champion->validate = false;  //avoid validation from model, cos we'r just updating data
            $this->Champion->create();   //clear input data, NOT make a new row
            if(!$this->Champion->save(array(
                'id'=>$champion_id,
                'description'=>$lore[1] //write with "<br/>"
                ))
            ){
                echo '<span style="color:red">Blad przy zapisywaniu col "description" w tabeli "champions"</span>';
                exit;
            }

echo 'pre-delete';
            //delete from 'skills' table existing skills to rewrite them later:
            $existing_skills = $this->Skill->find('all',array(
                'limit'=>99,'recursive'=>-1,
                'conditions'=>array('Skill.champion_id'=>$champion_id),
                'fields'=>array('Skill.id')
                )
            );
            foreach($existing_skills as $skill){
                $this->Skill->delete($skill['Skill']['id'],false);
            }
            echo '<br/>Skasowano pomyślnie dotychczasowe ('.count($existing_skills).') skille dla postaci o id:'.$champion_id.'<br/> Zapis nowych... <br/>';

            //save new skills to 'skills' table:
            for($a=1;$a<=5;$a++){
                $this->Skill->create();
                $this->Skill->save(array(
                  'champion_id' => $champion_id,
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
/*
                //download, resize and save skill images (3 sizes foreach)
                $img_url = 'http://edge1.mobafire.com/images/ability/'.$champion_slug.'-'.$this->Dehumanize($skill_nameEN[$a]).'.png';
                for($b=0;$b<3;$b++){
                    $img_source_size = getImageSize($img_url);
                    $img_source = imageCreateFromPng($img_url);

                    $img_resized = imagecreatetruecolor($sizes[$b],$sizes[$b]);
                    $abc = imageCopyResampled($img_resized,$img_source,0,0,0,0,$sizes[$b],$sizes[$b],$img_source_size[0],$img_source_size[1]);


                    $dir_url = "img/lol/champions/".$champion_slug;
                    if(!is_dir($dir_url)){
                      if(!mkdir($dir_url, 0777)) echo "Nie udalo sie utworzyc katalogu: ".$dir_ul;
                    }
                    $ico_img = $dir_url.'/'.$this->Dehumanize($skill_nameEN[$a]).'_'.$sizes[$b].'.png';
                    imagePng($img_resized, $ico_img);		//zapisz nowy obrazek na dysku
                }
            }
            echo '<br/><strong>Pobranie i zapisanie ('.($a-1).') na nowo skilli dla postaci o id:'.$champion_id.' zakonczone sukcesem</strong> <br/>';

           

            
            //portrain image, download, resize and save
            $img_url = "http://edge2.mobafire.com/images/champion/icon/".$champion_slug.".png";
            
            for($a=0;$a<3;$a++){
                $img_source_size = getImageSize($img_url);
                $img_source = imageCreateFromPng($img_url);

                $img_resized = imagecreatetruecolor($sizes[$a],$sizes[$a]);
                $abc = imageCopyResampled($img_resized,$img_source,0,0,0,0,$sizes[$a],$sizes[$a],$img_source_size[0],$img_source_size[1]);


                $dir_url = "img/lol/champions/".$champion_slug;
                if(!is_dir($dir_url)){
                  if(!mkdir($dir_url, 0777)) echo "Nie udalo sie utworzyc katalogu: ".$dir_ul;
                }
                $ico_img = $dir_url.'/'.$champion_slug.'_'.$sizes[$a].'.png';
                imagePng($img_resized, $ico_img);		//zapisz nowy obrazek na dysku
            }
            echo 'Zapisano portret postaci <br/>';
*/


        }





        public function GetSkills($champion_name){
            if(!$champion_name){
                echo 'Wybierz najpierw championa';
                exit;
            }
            //choose champion by name
            if(preg_match("/(_|-)/",$champion_name)){
                $words = explode('-',$champion_name);
                foreach($words as $word){
                    $conditionsName[] = array(
                        'OR'=>array(
                            'Champion.name LIKE'=>"%$word%"
                         )
                    );
                }
                $champion = $this->Champion->find('first',array('conditions'=>$conditionsName));
            }else{
                $champion = $this->Champion->find('first',array('conditions'=>array('Champion.name'=>$champion_name)));
            }

            echo 'Pobieranie skilli dla: '.$champion['Champion']['id'].'<br/>';
            $this->GetSkillNameAndLore($champion['Champion']['id'],$this->Dehumanize($champion['Champion']['slug']));
            
            
            echo '<a href="'.$this->base.'/">Wroc na strone glowna</a>';
            exit;
        }



        
        public function GetAllSkills(){
            $champions = $this->Champion->find('all',array('limit'=>300,'fields'=>array('Champion.id')));
            foreach($champions as $champion){
                $this->GetSkillNameAndLore($champion['Champion']['id']);
            }
        }




}
