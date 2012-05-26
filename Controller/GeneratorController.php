<?php
App::uses('AppController', 'Controller');

class GeneratorController extends AppController {
    public $uses = array('Build','Champion','Skill','Ss','Rune','Item','News','Slider');
    public $helpers = array('Thumb','Time');


    function beforeFilter(){
//      $this->Auth->allow('*');
      parent::beforeFilter();
    }



    //check if champion_id is in url, if is't show error
    private function CheckId($id){
        if(($id === false) || !is_numeric($id)){
            echo '<h1 style="color:red;text-align:center;"><br/>WielBlad, nie wybrano nr. ID poradnika!<br/>(powinien byc w adresie strony)</h1>';
            exit;
        }
    }


    

    public function index(){    //Choose an existing build or make a new one
        $this->paginate = array(
            'limit' => 25,
            'recursive' => 0,
            'field' => array('Build.name','Build.champion_id','Build.user_id','Build.created','Build.modified'),
            'order' => 'Build.created desc',
        );
        $builds = $this->paginate('Build');
        $this->set('builds',$builds);
    }



    
    public function new_build(){
        $champions = $this->Champion->find('all',array('recursive'=>-1,'order'=>'Champion.name asc'));
        $this->set('champions',$champions);
    }

    public function save_new_build($champion_id=false){
        $this->CheckId($champion_id);
        
        $this->Build->create();
        $this->Build->save(array(
            'champion_id'=>$champion_id,
            'name'=>'Bez nazwy',
            'user_id'=>$this->Auth->user('id')
        ));
        $last_id = $this->Build->find('first',array('recursive'=>-1,'order'=>'Build.id desc'));
        $this->redirect(array('action'=>'skills',$last_id['Build']['id']));
    }




    public function skills($build_id=false){
        $this->CheckId($build_id);
        
        //save skills:
        if($this->request->is('post')){
            if($this->Skill->saveMany($this->request->data)) {
                $this->Session->setFlash('<span style="color:orange">Udało się zapisać skille</span>');
            }else{
                $this->Session->setFlash('<span style="color:red">NIE wyszło zapisanie skilli!</span>');
            }
        }

        //pass page content:
        $build = $this->Build->find('first',array('recursive'=>0,'conditions'=>array('Build.id'=>$build_id)));
        $skills = $this->Skill->find('all',
                array(
                    'recursive' => -1,
                    'conditions'=>array('Skill.champion_id'=>$build['Build']['champion_id']),
                    'limit'=>20, //just in case, if error in database data
                    'order'=>'Skill.type asc'
                )
        );
        $this->set('build',$build);
        $this->set('skills',$skills);
    }

    public function save_buildName_skills(){
        if($this->request->is('post')){
            if(empty($this->request->data['Build']['id'])){
                echo 'Brak danych do zapisu, cos poszlo nie tak! [GeneratorController -> save_buildName_skills()]';
                echo 'Zatrzymuje działanie';
                exit;
            }else{
            //Edit existence build
                $this->Build->save($this->request->data);
                $this->Session->setFlash('<span style="color:orange">Zmiana nazwy poradnika ustawiona poprawnie</span>');
                $this->redirect(array('action'=>'skills',$this->request->data['Build']['id']));
            }
        }
    }




    public function skill_sequence($build_id=false){
        $this->CheckId($build_id);
        //after click 'next step':
        if($this->request->is('post')){
            $output = serialize($this->request->data);
            if($this->Build->save(array('id'=>$build_id,'skill_sequence'=>$output))){
                $this->redirect(array('action'=>'masteries',$build_id));
            }else{
                echo 'Problem z zapisem sekwencji skilli [GeneratorController -> skill_sequence()]';
                exit;
            }
        }
        
        //normal view:
        $build = $this->Build->find('first',array('conditions'=>array('Build.id'=>$build_id)));
        $skills = $this->Skill->find('all',
                array(
                    'recursive' => -1,
                    'conditions'=>array('Skill.champion_id'=>$build['Build']['champion_id']),
                    'limit'=>6, //just in case, if error in database data
                    'order'=>'Skill.type asc'
                )
        );
        $build['Build']['skill_sequence'] = unserialize($build['Build']['skill_sequence']);
        $this->set('build',$build);
        $this->set('skills',$skills);
    }




    public function masteries($build_id=false){
        $this->CheckId($build_id);

        if($this->request->is('post')){ //if add new masteries image
            $tempFile = 'img/upload_temp/'.$this->Dehumanize($this->data['Build']['name']).'.jpg';
            $destinationFile = 'img/lol/masteries/'.$this->data['Build']['type'].'/'.$this->Dehumanize($this->data['Build']['name']).'.jpg';
            
            if($this->request->data['Build']['img']['type']!='image/jpeg'){
                echo 'Zły format pliku. Musi być *.jpg!';
                exit;
            }

            if(move_uploaded_file(
                    $this->request->data['Build']['img']['tmp_name'],
                    $tempFile
            )){
                //resize and save 'masteries' img:
                list($sourceWidth,$sourceHeight) = getimagesize($tempFile);
                $destination = imagecreatetruecolor(600, 348);
                $source = imagecreatefromjpeg($tempFile);
                imagecopyresampled($destination, $source, 0,0,0,0, 600, 348, $sourceWidth, $sourceHeight);//resize img
                imagejpeg($destination, $destinationFile,90); //write completed slider/background image

                chmod($destinationFile,0777);
                unlink($tempFile);  //delete temorary file
                
            }else{
                echo 'Problem z zapisaniem wysłanej grafiki. Spróbuj jeszcze raz';
                exit;
            }

        }

        $build = $this->Build->find('first',array('recursive'=>-1,'conditions'=>array('Build.id'=>$build_id)));

        $types = scandir('img/lol/masteries/');
        foreach($types as $type){
          if($type=='.' || $type=='..' || $type=='.directory') continue;
          $folders[] = $type;
        }
        foreach($folders as $folder){
          $masteries->$folder = scandir('img/lol/masteries/'.$folder.'/');
        }

        $this->set('folders',$folders);
        $this->set('build',$build);
        $this->set('masteries',$masteries);
    }

    public function save_masteries($build_id=false,$name='error'){
        $this->CheckId($build_id);
        if($this->Build->save(array('id'=>$build_id,'masteries'=>str_replace('-','/',$name)))){
            $this->redirect(array('action'=>'ss',$build_id));
        }else{
            echo 'Problem z zapisem masteries [GeneratorController -> save_masteries()]';
            exit;
        }
    }




    public function ss($build_id=false){
        $this->CheckId($build_id);
        //after click 'next step':
        if($this->request->is('post')){
            if($this->Build->save(array(
                'id'=>$build_id,
                'ss1_id'=>intval($this->request->data['Build']['ss1']),
                'ss2_id'=>intval($this->request->data['Build']['ss2'])
                ))
            ){
                $this->redirect(array('action'=>'runes',$build_id));
            }else{
                echo 'Problem z zapisem Summoner Spells [GeneratorController -> ss()]';
                exit;
            }
        }


    //normal view:
        $build = $this->Build->find('first',array('recursive'=>-1,'conditions'=>array('Build.id'=>$build_id)));
        $ss = $this->Ss->find('all');

        $this->set('build',$build);
        $this->set('ss',$ss);
    }




    public function runes($build_id=false){
        $this->CheckId($build_id);
        //after click 'next step':
        if($this->request->is('post')){
            if($this->Build->save(array(
                'id'=>$build_id,
                'runes'=>serialize($this->request->data['Build'])
                ))
            ){
                $this->redirect(array('action'=>'items',$build_id));
            }else{
                echo 'Problem z zapisem run [GeneratorController -> runes()]';
                exit;
            }
        }
        
    //normal view:
        $build = $this->Build->find('first',array('recursive'=>-1,'conditions'=>array('Build.id'=>$build_id)));
        $build['Build']['runes'] = unserialize($build['Build']['runes']);

        for($type=1;$type<=4;$type++){
            //to decrease number of "if" in view, page show faster in this way
            $runes[$type] = $this->Rune->find('all',array('conditions'=>array('Rune.type'=>$type)));
        }

        $this->set('build',$build);
        $this->set('runes',$runes);
    }




    public function items($build_id=false){
        $this->CheckId($build_id);
        //after click 'next step':
        if($this->request->is('post')){
            if($this->Build->save(array(
                'id'=>$build_id,
                'items'=>serialize($this->request->data['Build'])
                ))
            ){
                $this->redirect(array('action'=>'description',$build_id));
            }else{
                echo 'Problem z zapisem przedmiotów [GeneratorController -> items()]';
                exit;
            }
        }

    //normal view:
        $build = $this->Build->find('first',array('recursive'=>-1,'conditions'=>array('Build.id'=>$build_id)));
        $items = $this->Item->find('all',array('recursive'=>-1));

        $build['Build']['items'] = unserialize($build['Build']['items']);
        /*
        $categories = array(
          'atak' => array(
            'damage',
            'attack_speed',
            'life_steal',
            'critical_strike'
          ),
          'obrona' => array(
            'armor',
            'health',
            'health_regen',
            'spell_block'
          ),
          'magia' => array(
            'mana',
            'cooldown_reduction',
            'mana_regen',
            'spell_damage'
          ),
          'inne' => array(
            'movement',
            'consumable'
          )
        );
        
        $this->set('categories',$categories);*/
        
        $this->set('build',$build);
        $this->set('items',$items);
    }




    public function description($build_id=false){
        $this->CheckId($build_id);
        $build = $this->Build->find('first',array('recursive'=>0,'conditions'=>array('Build.id'=>$build_id)));
        //after click 'next step':
        if($this->request->is('post')){
            if($this->Build->save(array(
                'id'=>$build_id,
                'description'=>$this->request->data['Build']['description']
                ))
            ){
                $this->redirect(array('action'=>'preview',$build_id));
            }else{
                echo 'Problem z zapisem tekstu do poradnika [GeneratorController -> description()]';
                exit;
            }
        }

    //normal view:
        $champions = $this->Champion->find('all',array('recursive'=>0,'order'=>'Champion.name asc'));
        $skills = $this->Skill->find('all',array('recursive'=>-1,'conditions'=>array('Skill.champion_id'=>$build['Build']['champion_id'])));
        $items = $this->Item->find('all');
        $ss = $this->Ss->find('all');

        $this->set('build',$build);
        $this->set('champions',$champions);
        $this->set('skills',$skills);
        $this->set('items',$items);
        $this->set('ss',$ss);
    }



    public function preview($build_id=false){
        $this->CheckId($build_id);
        $build = $this->Build->find('first',array('recursive'=>1,'conditions'=>array('Build.id'=>$build_id)));
        
     //after click 'next step':
        if($this->request->is('post')){
        //write build
            if($this->Build->save(array(
                'id'=>$build_id,
                'done'=>1
                ))
            ){
            //write new news
                $this->News->create();
                if($this->News->save(array(
                    'title'=>$build['Champion']['name'],
                    'text'=>$build['Build']['introduction'],
                    'image'=>$build['Build']['id'], //when type = 'poradnik', 'image' contain build_id
                    'type'=>'poradnik'
                    ))
                ){
            //write new slider
                    $this->Slider->create();
                    if($this->Slider->save(array(
                        'image'=>$build['Champion']['name'],
                        'description'=>$build['Build']['introduction'],
                        'url'=>$this->Dehumanize($build['Champion']['name']),
                        'type'=>'poradnik'
                        ))
                    ){
                        $this->redirect(array('action'=>'done',$build_id));
                    }else{
                        echo 'Problem z zapisem nowego slidera [GeneratorController ->preview()]';
                        exit;
                    }

                }else{
                    echo 'Problem z zapisem nowego newsa [GeneratorController ->preview()]';
                    exit;
                }
                
            }else{
                echo 'Problem z zapisem poradnika [GeneratorController ->preview()]';
                exit;
            }
            


        }

        $this->set('build_id',$build_id);
    }




    public function done($build_id=false){
        $this->CheckId($build_id);
    }

 
}