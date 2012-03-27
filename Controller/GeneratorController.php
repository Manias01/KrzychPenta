<?php
App::uses('AppController', 'Controller');

class GeneratorController extends AppController {
    public $uses = array('Build','Champion','Skill','Ss');
    public $helpers = array('StrChanger','Thumb','Time');


    function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('*');
    }



    //check if champion_id is in url, if is't show error
    private function CheckId($id){
        if($id === false){
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
        $champions = $this->Champion->find('all',
                array(
                    'recursive'=>-1,
                    'fields'=>array('Champion.id','Champion.name'),
                    'order'=>'Champion.name asc'
                )
        );
        $this->set('champions',$champions);
    }

    public function save_new_build($champion_id){
//        if($this->request->is('get')){
//            print_r($champion_id);
//            exit;
            $this->Build->create();
            $this->Build->save(array(
                'champion_id'=>$champion_id,
                'name'=>'Bez nazwy'
            ));
            $last_id = $this->Build->find('first',array('recursive'=>-1,'order'=>'Build.id desc'));
            $this->redirect(array('action'=>'skills',$last_id['Build']['id']));
//        }
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
        //after click 'next step':
        if($this->request->is('post')){
            $output = serialize($this->request->data);
            if($this->Build->save(array('id'=>$build_id,'skill_sequence'=>$output))){
                $this->redirect(array('action'=>'masteries',$this->params['pass'][0]));
            }else{
                echo 'Problem z zapisem sekwencji skilli [GeneratorController -> skill_sequence()]';
                exit;
            }
        }
        
        //normal view:
        $this->CheckId($build_id);
        $build = $this->Build->find('first',array('conditions'=>array('Build.id'=>$build_id)));
        $skills = $this->Skill->find('all',
                array(
                    'recursive' => -1,
                    'conditions'=>array('Skill.champion_id'=>$build['Build']['champion_id']),
                    'limit'=>20, //just in case, if error in database data
                    'order'=>'Skill.type asc'
                )
        );
        $build['Build']['skill_sequence'] = unserialize($build['Build']['skill_sequence']);
        $this->set('build',$build);
        $this->set('skills',$skills);
    }




    public function masteries($build_id=false){
        $this->CheckId($build_id);

        $build = $this->Build->find('first',array('recursive'=>-1,'conditions'=>array('Build.id'=>$build_id)));

        $types = scandir('img/lol/masteries/');
        foreach($types as $type){
          if($type=='.' || $type=='..' || $type=='.directory') continue;
          $folders[] = $type;
        }
        foreach($folders as $folder){
          $masteries->$folder = scandir('img/lol/masteries/'.$folder.'/');
        }
        $this->set('build',$build);
        $this->set('masteries',$masteries);
    }

    public function save_masteries($build_id=false,$name='error'){
        $this->CheckId($build_id);
        if($this->Build->save(array('id'=>$build_id,'masteries'=>$name))){
            $this->redirect(array('action'=>'ss',$build_id));
        }else{
            echo 'Problem z zapisem masteries [GeneratorController -> save_masteries()]';
            exit;
        }
    }




    public function ss($build_id=false){
        $this->CheckId($build_id);

        $build = $this->Build->find('first',array('recursive'=>-1,'conditions'=>array('Build.id'=>$build_id)));
        $ss = $this->Ss->find('all');

        $this->set('build',$build);
        $this->set('ss',$ss);
    }

 
}