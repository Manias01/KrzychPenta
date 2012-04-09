<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {
    public $name = 'Pages';
    public $helpers = array('Html','Text','Thumb');
    public $uses = array('News','Build','Skill','Ss','Rune','Item','Slider');


    function beforeFilter(){
      $this->Auth->allow('*');

    //content to 'najnowsze poradniki' for layout 'default.ctp'
      $newest = $this->Build->find('all',array('recursive'=>1,'limit'=>3,'order'=>'Build.id desc',
          'fields'=>array('id','champion_id','Champion.name'))
      );
      $this->set('newest_builds',$newest);
      parent::beforeFilter();
    }



    public function home() {
        $this->paginate = array(
            'order'=>'News.id DESC',
            'limit'=>3
        );
        $news = $this->paginate('News');
        $this->set('news', $news);
        
     //sliders for homepage
        $sliders = $this->Slider->find('all',array('limit'=>3,'order'=>'Slider.id desc','fields'=>array('image','description','url','type')));
        foreach($sliders as $slider){
            if($slider['Slider']['type'] == 'poradnik'){
                $slider['Slider']['image'] = $this->base.'/img/lol/champions/'.$slider['Slider']['image'].'/background.jpg';
                $slider['Slider']['url'] = $this->base.'/poradnik/'.$slider['Slider']['url'];
            }
        }
        $this->set('sliders',$sliders);
        
        $this->set('title_for_layout', 'Witamy');
        $this->set('header','Aktualności');
    }



    public function all_poradnik(){
        $this->paginate = array(
            'order'=>'Build.name ASC',
            'limit'=>10
        );
        $builds = $this->paginate('Build');
        $this->set('builds',$builds);

        $this->set('title_for_layout', 'Poradniki');
        $this->set('header','Poradniki');
    }




    public function poradnik($champion_name){
        //build
        $build = $this->Build->find('first',array('recursive'=>0,'conditions'=>array('Champion.name'=>$champion_name)));
        if(!$build) $this->redirect(array('controller'=>'pages', 'action'=>'home'));
        
        $build['Build']['skill_sequence'] = unserialize($build['Build']['skill_sequence']);
        $this->set('build', $build);

        //Summoner spells
        $ss = $this->Ss->find('all',array('conditions'=>array('id'=>array($build['Build']['ss1_id'],$build['Build']['ss2_id']))) );
        $this->set('ss',  $ss);

        //Runes
        $runes = unserialize($build['Build']['runes']);
        $runes = $this->Rune->find('all',array('conditions'=>array('id'=>$runes)));
        $this->set('runes',$runes);

        //Items
        $items = unserialize($build['Build']['items']);
        $items = $this->Item->find('all',array('conditions'=>array('id'=>$items)));
        $this->set('items',$items);

        //Skill sequence
        $skills = $this->Skill->find('all',
                array(
                    'recursive' => -1,
                    'conditions'=>array('Skill.champion_id'=>$build['Build']['champion_id']),
                    'limit'=>6, //just in case, if error in database data
                    'order'=>'Skill.type asc'
                )
        );
        $this->set('skills',$skills);

        //3 another builds at the bottom page
        $another_builds = $this->Build->find('all',array('limit'=>3,'recursive'=>0,'conditions'=>array('Champion.name <>'=>$champion_name)));
        $this->set('another_builds',$another_builds);

        $this->set('title_for_layout', $build['Champion']['name'].' - poradnik');
        $this->set('header','Poradnik');
    }




    public function contact(){
        $this->set('title_for_layout', 'Kontakt');
        $this->set('header','Skontakuj się z nami');
    }


    
}