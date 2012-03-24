<?php
App::uses('AppController', 'Controller');

class GeneratorController extends AppController {
    public $uses = array('Build','Champion','Skill');
    public $helpers = array('StrChanger','Thumb','Time');


    function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('*');
    }

    //check if champion_id is in url, if is't show error
    private function CheckId($champion_id){
        if($champion_id === false){
            echo '<h1 style="color:red;text-align:center;"><br/>WielBlad, nie wybrano championa!<br/>(powinien byc w adresie strony)</h1>';
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


    public function skills($champion_id=false){
        $this->CheckId($champion_id);
        //everything is good:
        if($this->request->is('post')){
//               print_r($this->request->data);
            if($this->Skill->saveMany($this->request->data)) {
                $this->Session->setFlash('<span style="color:orange">Udało się zapisać</span>');
            }else{
                $this->Session->setFlash('<span style="color:red">Nie wyszło zapisanie!</span>');
            }
        }

        $champion = $this->Champion->find('first',array('conditions'=>array('Champion.id'=>$champion_id)));
        $skills = $this->Skill->find('all',
                array(
                    'recursive' => -1,
                    'conditions'=>array('Skill.champion_id'=>$champion_id),
                    'limit'=>20, //just in case, if error in database data
                    'order'=>'Skill.type asc'
                )
        );
        $this->set('champion',$champion);
        $this->set('skills',$skills);
    }


    public function masteries($champion_id=false){
        $this->CheckId($champion_id);
            
    }


 
}