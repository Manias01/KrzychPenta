<?php
App::uses('AppController', 'Controller');

class ChampionsController extends AppController {
        public $helpers=array('Thumb');

        function beforeFilter(){
//          $this->Auth->allow('*');
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
               //if stop two: resize, save in folder, write name in DB
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
                    /*
			if ($this->Champion->save($this->request->data)) {
				$this->Session->setFlash(__('The champion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The champion could not be saved. Please, try again.'));
			}
                    */
		} else {
			//$this->request->data = $this->Champion->read(null, $id);
		}
        }

        

        public function GetChampionsName() {
        //Pobranie nazw postaci
            $codeWeb = file_get_contents('http://www.mobafire.com/league-of-legends/champions');
            $codeWeb = explode('champ-box',$codeWeb);

            //tutaj trzeba juz pobrac wczesniej dane uzywajac starego generatora poradnikow
            $lol_id = simplexml_load_string(file_get_contents('files/champions.xml'));

            for($a=1;$a<(count($codeWeb)-2);$a++){
              $tab['name'][$a] = $this->Tnij($codeWeb[$a],'<div class="champ-name">','</div>');
              $tab['nr'][$a] = $this->Tnij($codeWeb[$a],",i:'","'");
              $tab['rp'][$a] = $this->Tnij($codeWeb[$a],'<img src="http://edge1.mobafire.com/images/interface/riot-points.png" style="width:20px;" />','<br />');
              $tab['ip'][$a] = $this->Tnij($codeWeb[$a],'<img src="http://edge1.mobafire.com/images/interface/influence-points.png" style="width:20px; margin-left:5px;" />','</div>');

        //usuniecie spacji itp.
              $tab['rp'][$a][1] = intval($tab['rp'][$a][1]);
              $tab['ip'][$a][1] = intval($tab['ip'][$a][1]);
              
       //porownanie nazwy postaci aby zdobyc id z oficjalnej strony:
              for($b=0;$b<=count($lol_id->name);$b++){
//                  echo $tab['name'][$a][1]."-".$lol_id->name[$b]."\n";
                    if($tab['name'][$a][1] == $lol_id->name[$b]){
                        $tab['id'][$a] = $lol_id->name[$b]['nr'];
                        break;
                    }
               }

       //zapis do bazy danych:
              $this->Champion->create();
              $this->Champion->save(array(  //a nie 'set'?
                  'id' => $tab['id'][$a],
                  'name' => $tab['name'][$a][1],
                  'mobafire_id' => $tab['nr'][$a][1],
                  'rp' => $tab['rp'][$a][1],
                  'ip' => $tab['ip'][$a][1]
                  )
              );
              $this->Champion->save();
            }

            $this->render('admin_index');
        }




}
