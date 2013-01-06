<?php
App::uses('AppController', 'Controller');

class ItemsController extends AppController {

    public $uses = array('Item','ItemsTag');
    public $helpers = array('Thumb');


    function beforeFilter(){
        $this->Auth->allow();
        parent::beforeFilter();
    }


        public function index(){
                $this->redirect(array('action' => 'index','admin'=>true));
        }

	public function admin_index() {
		$this->Item->recursive = 0;
                $this->paginate = array('limit'=>300,'maxLimit'=>300,'order'=>array('Item.name_pl'=>'ASC'));
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

        


        //download image, resize and save to *.gif
        private function resizeImage($url,$size,$dir,$name){
            $name = $this->Dehumanize($name).'_'.$size.'.gif';
            if(substr($dir, -1) != '/') $dir .= '/';    //for forgetful coder

            $img_source_size = getImageSize($url);
            switch(substr($url, -4)){
                case '.png':
                    $img_source = imageCreateFromPng($url);
                    break;
                case '.gif':
                    $img_source = imageCreateFromGif($url);
                    break;
                case '.jpg':
                    $img_source = imageCreateFromJpeg($url);
                    break;
            }

            //resize img:
            $img_resized = imagecreatetruecolor($size,$size);
            imageCopyResampled($img_resized,$img_source,0,0,0,0,$size,$size,$img_source_size[0],$img_source_size[1]);
            $save = imageGif($img_resized, $dir.$name);
            return($save);
          }




        public function get(){
            $url = 'http://www.mobafire.com/league-of-legends/items';

            $wholePage = file_get_contents($url);
            $itemsHtml = explode('<a href="/league-of-legends/item/',$wholePage);
            unset($itemsHtml[0]);

            $itemsData = array();
            for($i=1;$i<count($itemsHtml);$i++){
                //name:
                preg_match('/<div class="champ-name">(.*)?<\/div>/', $itemsHtml[$i],$itemName);
                //moba_id:
                preg_match("/{t:'Item',i:'([0-9]+)?'}/", $itemsHtml[$i],$itemId);

                //check if this item exists in DB:
                $exists = $this->Item->find('first',array(
                    'conditions'=>array('name_en'=>$itemName[1])
                ));


                //if this item not exists in DB:
                if(!isSet($exists) || empty($exists)){
                    echo '<b>Nie</b> znaleziono itemu: <b>'.$itemName[1].' ('.$i.')</b> pobieram...<br/>';

                    //img_url: (they have 2 servers: 'edge1' and 'edge2'
                    preg_match('/(<img src=")(http:\/\/edge1.mobafire.com\/images\/item\/(.*)?) alt="/', $itemsHtml[$i],$itemImg);
                    if(!isSet($itemImg[2]))
                        preg_match('/(<img src=")(http:\/\/edge2.mobafire.com\/images\/item\/(.*)?) alt="/', $itemsHtml[$i],$itemImg);

                    $itemsData = array(
                        'moba_id'=> $itemId[1],
                        'name_en'=> $itemName[1],
                        'img'=>str_replace('"', '', $itemImg[2])
                    );

                    $this->Item->create();
                    $this->Item->set(array(
                        'moba_id'=>$itemsData['moba_id'],
                        'name_en'=>$itemsData['name_en']
                    ));
                    $this->Item->save();

                    $sizes = array('20','38','64');
                    foreach($sizes as $size){
                        $status = $this->resizeImage($itemsData['img'],$size,'img/lol/items/',$itemsData['name_en']);
                        echo '&nbsp;&nbsp;'.$status.'- zapis itemu='.$itemsData['name_en'].'_'.$size.'<br/>';
                    }
                }else{
                    echo 'Znaleziono <b>'.$itemName[1].'</b> ('.$i.')<br/>';
                    
                    //update moba_id:
                    if($exists['Item']['moba_id'] == 0){
                        $this->Item->set(array(
                            'id'=>$exists['Item']['id'],
                            'moba_id'=>$itemId[1]
                        ));
                        $this->Item->save();
                    }
                }
            }


            echo 'pobieranie itemow poszlo ok';
            exit();
        }





        public function GetItems(){

            include('../Controller/items_test.php');

            //$this->Item->deleteAll('1=1',false);   //clear 'items' table

            $itemsClass = new GetItems();
            $items = $itemsClass->CreateObject();

//
//            foreach($items as $item){
//                $exists = $this->Item->find('first',array('conditions'=>array('Item.name_en'=>$item['name_en'])));
//                if(empty($exists)){
//                    $this->Item->create();
//                    $this->Item->set(array(
//                        'name_pl'=>$item['name_pl'],
//                        'name_en'=>$item['name_en'],
//                        'price1'=>intval($item['cost1']),
//                        'price2'=>intval($item['cost2']),
//                        'desc_pl'=>$item['desc_pl']
//                        )
//                    );
//                    $this->Item->save();
//                    //don't save tags
//                }
//            }
//
//            $itemsClass->GetAllImages(20);
//            $itemsClass->GetAllImages(38);
//            $itemsClass->GetAllImages(64);

            echo 'Ta funkcja jest zbyt stara';
            exit();


/*
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
*/
        }


}
