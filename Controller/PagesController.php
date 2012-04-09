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



    public function poradnik($build_id){
        if(!is_numeric($build_id)) $this->redirect(array('controller'=>'pages', 'action'=>'home'));
        
        //build
        $build = $this->Build->findById($build_id);
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

        $this->set('title_for_layout', $build['Champion']['name'].' - poradnik');
        $this->set('header','Poradnik');
    }

/*
    public function single_news($id){

        $single_news = $this->News->find('first',array('conditions'=>array('News.id'=>$id)));
        $this->set('single_news',$single_news);

        $this->set('title_for_layout', $single_news['News']['title']);
        
    }
*/

}