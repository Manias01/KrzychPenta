<?php
App::uses('AppController', 'Controller');

class ChampionsController extends AppController {
        public $helpers=array('Thumb');
        public $uses=array('Champion','Skill','Rotation');

        function beforeFilter(){
//          $this->Auth->allow();
          parent::beforeFilter();
        }

        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }

	public function admin_index() {
		$this->Champion->recursive = 0;
		$this->set('champions', $this->paginate());
	}


	public function admin_view($id = null) {
		$this->Champion->id = $id;
		if (!$this->Champion->exists()) {
			throw new NotFoundException(__('Invalid champion'));
		}
		$this->set('champion', $this->Champion->read(null, $id));
	}


	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Champion->create();
			if ($this->Champion->save($this->request->data)) {
				$this->Session->setFlash(__('The champion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The champion could not be saved. Please, try again.'));
			}
		}
	}


	public function admin_edit($id = null) {
		$this->Champion->id = $id;
		if (!$this->Champion->exists()) {
			throw new NotFoundException(__('Invalid champion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Champion->save($this->request->data)) {
				$this->Session->setFlash(__('The champion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The champion could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Champion->read(null, $id);
		}
	}


	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Champion->id = $id;
		if (!$this->Champion->exists()) {
			throw new NotFoundException(__('Invalid champion'));
		}
		if ($this->Champion->delete()) {
			$this->Session->setFlash(__('Champion deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Champion was not deleted'));
		$this->redirect(array('action' => 'index'));
	}



        public function admin_background($id=null){
		$this->Champion->id = $id;
		if (!$this->Champion->exists()) {
			throw new NotFoundException(__('Invalid champion'));
		}

		if ($this->request->is('post')) {
//                    print_r($this->request->data['Champion']);
//                    exit;
                    $champ_name = $this->Champion->read('name');
                    $champ_name = $this->Dehumanize($champ_name['Champion']['name']);

                //if step one:
                    if(is_uploaded_file($this->request->data['Champion']['background']['tmp_name'])){

                        if($this->request->data['Champion']['background']['type']!='image/jpeg'){
                            echo 'Zły format pliku. Musi być *.jpg!';
                            exit;
                        }

                        if(!move_uploaded_file(
                                $this->request->data['Champion']['background']['tmp_name'],
                                'img/upload_temp/'.$champ_name.'_background.jpg'
                        )){
                            echo 'Problem z zapisaniem wysłanej grafiki. Spróbuj jeszcze raz';
                            exit;
                        }
                    }else{
               //if step two: resize, save in folder, write name in DB
                        $corner = $this->request->data['Champion'];
                        $imagePath = 'img/upload_temp/'.$champ_name.'_background.jpg';
                        $imageInfo = getimagesize($imagePath);
                        $sourceWidth = $imageInfo[0];
                        $sourceHeight = $imageInfo[1];

               //save background image (crop to ratio 1.7 and resize to 650x380)
                        $widthBg = 650; $heightBg = 380;
                        $destinationBg = imagecreatetruecolor($widthBg, $heightBg);  //create new img in slider size
                        
                        $sourceBg = imagecreatefromjpeg($imagePath);  //source of image to crop and resize
                        imagecopyresampled($destinationBg, $sourceBg, 0,0,0,0, $widthBg, $heightBg, $sourceWidth, $sourceHeight);//resize img
                        imagejpeg($destinationBg, 'img/lol/backgrounds/'.$champ_name.'_background.jpg',90); //write completed slider/background image

                        chmod('img/lol/backgrounds/'.$champ_name.'_background.jpg',0777);
//                        destroy($destinationBg);

               //save slider image (crop from selected area and resize to 600x250):
                        $widthCrop = $corner['width']; $heightCrop = $corner['height'];
                        $widthResize = 600; $heightResize = 250;
                        $destinationCrop = imagecreatetruecolor($widthCrop, $heightCrop);  //create new in crop size
                        $destinationResize = imagecreatetruecolor($widthResize, $heightResize);  //create new img in slider size
                        
                        $source = imagecreatefromjpeg($imagePath);  //source of image to crop and resize
                        imagecopy($destinationCrop,$source,0,0, $corner['x1'],$corner['y1'], $sourceWidth, $sourceHeight);//crop selected area
                        imagecopyresized($destinationResize, $destinationCrop, 0,0,0,0, $widthResize, $heightResize, $widthCrop, $heightCrop);//resize img
                        imagejpeg($destinationResize, 'img/lol/backgrounds/'.$champ_name.'_slide.jpg',85); //write completed slider/background image

                        chmod('img/lol/backgrounds/'.$champ_name.'_slide.jpg',0777);
                        unlink($imagePath); //delete temp file

                  //write to DB that champion have background:
                        $this->Champion->save(array(
                            'id'=>$id,
                            'background'=>true
                        ));


                        $this->Session->setFlash('Zapis slidera zakonczony powodzeniem');
                        $this->redirect(array('controller'=>'champions','action'=>'index','admin'=>true));
                    }

                    $this->redirect(array($id,$champ_name.'_background'));

		}
        }



        public function rotation(){
            $codeWeb = file_get_contents('http://leagueoflegends.wikia.com/wiki/Template:Current_champion_rotation');
            $pattern = '/(<meta name="keywords" content=)("League of Legends Wiki,leagueoflegends,Template:Current champion rotation,)(.*)(" \/>)/';
            preg_match($pattern, $codeWeb, $champs);

            $rotation = explode(',',$champs[3]);

            print_r($rotation);
            echo '<br/>';

            
            $this->Rotation->deleteAll('1=1',false);   //clear 'rotations' table

            foreach($rotation as $name){
                $champ_id = $this->Champion->find('first',array('conditions'=>array('Champion.name'=>$name),'fields'=>array('Champion.id')));
                if(empty($champ_id)){
                    $this->GetChampion($name);
                    //echo "BŁĄD! Nie znaleziono championa o nazwie: '$name' <br/>";
                }
                $this->Rotation->create();  //create new record
                if(!$this->Rotation->save(array(
                    'champion_id'=>$champ_id['Champion']['id']
                ))) echo "BŁĄD! Nie udało się zapisać championa o id='$champ_id' i nazwie='$name' <br/>";

                echo $name.' zapisano <br/>';
            }
            

            exit;
            $this->redirect(array('controller'=>'pages', 'action'=>'home'));
        }





        public function GetSkills($champion_id,$champion_slug){
            if(!$champion_id || !$champion_slug){
                echo 'Brakuje id championa lub slug championa';
                exit;
            }
            $sizes = array(20,38,64); //sizes to resize champions images

            //get data for skills from web:
            $stronaEN = file_get_contents('http://eune.leagueoflegends.com/champions/'.$champion_id);
            $stronaPL = file_get_contents('http://eune.leagueoflegends.com/pl/champions/'.$champion_id);

            $skill_namePL = $this->Tnij($stronaPL,'<span class="ability_name">', '</span>');
            $skill_nameEN = $this->Tnij($stronaEN,'<span class="ability_name">', '</span>');
            $skill_descPL = $this->Tnij($stronaPL,'<div class="ability_effect">', '</div>');
            $passive_descPL = $this->Tnij($stronaPL,'<span class="ability_description">', '</span>');
            $skill_descPL[5] = $passive_descPL[5];

            //delete from 'skills' table existing skills to rewrite them:
            $existing_skills = $this->Skill->find('all',array(
                'limit'=>99,
                'recursive'=>-1,
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
                $skill_id = intval($champion_id.$a);
                $this->Skill->create();
                $this->Skill->save(array(
                    'id'=>$skill_id,
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
            if(empty($skill_namePL[0]) && empty($skill_nameEN[0])){
                echo '<br/><strong>Pobranie i zapisanie ('.($a-1).') na nowo skilli dla postaci o id:'.$champion_id.' zakonczone sukcesem</strong> <br/>';
            }else{
                echo '<br/><p style="color:red">Pobrano puste skille, coś poszło nie tak :-(</p>';
            }


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

            echo 'Pobrano grafiki i skille postaci<br/><a href="/">Strona główna</a>';

        }



/*
        public function GetLore($champion_id){
           if(!$champion_id){
                echo 'Brakuje id championa';
                exit;
            }
            $stronaPL = file_get_contents('http://eune.leagueoflegends.com/pl/champions/'.$champion_id);

           //get data for 'lore' in 'champions' table:
            $pattern = '/<td class="champion_description">(.*)<\/td>/';
            preg_match($pattern, $stronaPL, $lore);

            //save 'description'(lore) to 'champions' table
            $this->Champion->validate = false;  //avoid validation from model, just updating data
            $this->Champion->create();   //clear input data, NOT make a new row
            if(!$this->Champion->save(array(
                'id'=>$champion_id,
                'description'=>$lore[1] //write with "<br/>"
                ))
            ){
                echo '<span style="color:red">Blad przy zapisywaniu col "description" w tabeli "champions"</span>';
                exit;
            }
            echo 'Lore dla postaci '.$champion_slug.' zapisane poprawnie';
            exit;
        }
*/



        
        public function GetChampion($name='all'){  //$name='all' => download all champions, OR $name = $champion_name
        //Get champion name + id from official site, output tab $champions:
            $html = file_get_contents('http://eune.leagueoflegends.com/champions');

            $pattern = '/(<h1 class="champion_name">)(.*)(<\/h1>)/';
            preg_match_all($pattern, $html, $champs_names);

            $pattern = '/(href="\/champions\/)([0-9]+)(\/)/';
            preg_match_all($pattern, $html, $champs_ids);

            for($a=0;$a<count($champs_names[2]);$a++){
                $champions[$a]['id'] = $champs_ids[2][$a];
                $champions[$a]['name'] = $champs_names[2][$a];
            }

        //Get mobafire_id + rp + ip
            $codeWeb = file_get_contents('http://www.mobafire.com/league-of-legends/champions');
            $codeWeb = explode('champ-box',$codeWeb);

            if($name=='all') $this->Champion->deleteAll('1=1',false);    //clear table

            for($a=1;$a<(count($codeWeb)-2);$a++){
                $moba['name'][$a] = $this->Tnij($codeWeb[$a],'<div class="champ-name">','</div>');
                $moba['name'][$a] = $moba['name'][$a][1];
                $moba['nr'][$a] = $this->Tnij($codeWeb[$a],",i:'","'");
                $moba['rp'][$a] = $this->Tnij($codeWeb[$a],'<img src="http://edge1.mobafire.com/images/interface/riot-points.png" style="width:20px;" />','<br />');
                $moba['ip'][$a] = $this->Tnij($codeWeb[$a],'<img src="http://edge1.mobafire.com/images/interface/influence-points.png" style="width:20px; margin-left:5px;" />','</div>');

                //removes spaces etc.
                $moba['nr'][$a] = intval($moba['nr'][$a][1]);
                $moba['rp'][$a] = intval($moba['rp'][$a][1]);
                $moba['ip'][$a] = intval($moba['ip'][$a][1]);

                //get another champion_id from mobafire
                for($b=0;$b<=count($champions);$b++){
                    if($moba['name'][$a] == $champions[$b]['name']){
                        $moba['id_normal'][$a] = $champions[$b]['id'];
                        break;
                    }
                }

                //save to database:
                if($name=='all'){
                    //erase and save a new one list, without lore
                    $this->Champion->validate = false;
                    $this->Champion->create();
                    $this->Champion->save(array(
                      'id' => $moba['id_normal'][$a],
                      'name' => $moba['name'][$a],
                      'slug' => $this->Dehumanize($moba['name'][$a]),
                      'mobafire_id' => $moba['nr'][$a],
                      'rp' => $moba['rp'][$a],
                      'ip' => $moba['ip'][$a]
                      )
                    );
                }elseif(strtolower($name) == strtolower($moba['name'][$a])){
                    // add/update only one champion, with lore
                    //get 'lore':
                    echo 'name: '.$moba['name'][$a].'<br/>id: '.$moba['id_normal'][$a].'<br/>';
                    $stronaPL = file_get_contents('http://eune.leagueoflegends.com/pl/champions/'.$moba['id_normal'][$a]);
                    $pattern = '/<td class="champion_description">(.*)<\/td>/';
                    preg_match($pattern, $stronaPL, $lore);

                    $this->Champion->validate = false;
                    $this->Champion->create();
                    $this->Champion->save(array(
                        'id' => $moba['id_normal'][$a],
                        'name' => $moba['name'][$a],
                        'slug' => $this->Dehumanize($moba['name'][$a]),
                        'mobafire_id' => $moba['nr'][$a],
                        'rp' => $moba['rp'][$a],
                        'ip' => $moba['ip'][$a],
                        'description'=>$lore[1] //write with "<br/>"
                      )
                    );
                    //download images and skills:
                    $this->GetSkills($moba['id_normal'][$a],$this->Dehumanize($moba['name'][$a]));

                    echo '<p style="color:green">Pobranie championa, skilli i grafik dla: '.$moba['name'][$a].' zakonczone pomyslnie</p>';
                }
            }

     /*
            if($name=='all'){
                echo 'Zapis wszystkich Championow do tabeli "champions" zakonczony powodzeniem';
            }
    */
            exit;
        }




}
