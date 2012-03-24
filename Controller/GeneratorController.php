<?php
App::uses('AppController', 'Controller');

class GeneratorController extends AppController {
    public $uses = array('Build','Champion','Skill');
    public $helpers = array('StrChanger','Thumb','Time');


    function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('*');
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
        if($champion_id === false){
            echo 'Błąd, nie wybrano championa';
        }else{
            //everything is good:
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
        

    }


 
}