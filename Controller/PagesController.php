<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {
    public $name = 'Pages';
    public $helpers = array('Html','Text','Thumb');
    public $uses = array('News','Champion','Build','Skill','Ss','Rune','Item','Slider','Search','Rotation');


    function beforeFilter(){
      $this->Auth->allow('*');

    //content to 'najnowsze poradniki' for layout 'default.ctp'
      $sidebar_newest_builds = $this->Build->find('all',array('recursive'=>1,'limit'=>3,'order'=>'Build.id desc',
          'fields'=>array('id','champion_id','Champion.name'),
          'conditions'=>array('Build.done'=>1)
          )
      );
      $join = array(
          array(
              'table'=>'builds',
              'alias'=>'Build',
              'type'=>'left',
              'foreignKey' => 'champion_id',
              'conditions'=>array(
                  'Build.champion_id = Rotation.champion_id',
                  'Build.done'=>1,
              )
          )
      );
      $sidebar_rotation = $this->Rotation->find('all',array('recursive'=>0,'joins'=>$join,
          'fields'=>array('Champion.id','Champion.name','Build.id')));
      
      $this->set('sidebar_newest_builds',$sidebar_newest_builds);
      $this->set('sidebar_rotation',$sidebar_rotation);
      parent::beforeFilter();
    }



    public function home() {
        $this->paginate = array(
            'order'=>'News.id DESC',
            'limit'=>10
        );
        $news = $this->paginate('News');
        $this->set('news', $news);
        
     //sliders for homepage
        $sliders = $this->Slider->find('all',array('limit'=>3,'order'=>'Slider.id desc','fields'=>array('image','description','url','type')));
        foreach($sliders as &$slider){
            if($slider['Slider']['type'] == 'poradnik'){
                $slider['Slider']['image'] = $this->base.'/img/lol/backgrounds/'.$this->Dehumanize($slider['Slider']['image']).'_slide.jpg';
                $slider['Slider']['url'] = $this->base.'/poradnik/'.$this->Dehumanize($slider['Slider']['url']);
            }
        }
        $this->set('sliders',$sliders);
        
        $this->set('title_for_layout', 'Witamy');
        $this->set('header','Aktualności');
    }




    public function all_poradnik(){
        $this->paginate = array(
            'order'=>'Build.name ASC',
            'limit'=>10,
            'conditions'=>array('Build.done'=>1)
        );
        $builds = $this->paginate('Build');
        $this->set('builds',$builds);

        $this->set('title_for_layout', 'Lista poradników');
        $this->set('header','Poradniki');
    }





    public function poradnik($champion_name){
        if(!$champion_name) $this->redirect(array('controller'=>'pages', 'action'=>'home'));
        
        //build
        if(is_numeric($champion_name)){
            $build = $this->Build->find('first',array('recursive'=>1,
                'conditions'=>array('Build.id'=>$champion_name)));
        }else{
            if(preg_match("/(_|-)/",$champion_name)){
                $words = explode('-',$champion_name);
                foreach($words as $word){
                    $conditionsName[] = array(
                        'OR'=>array(
                            'Champion.name LIKE'=>"%$word%"
                         )
                    );
                }
                $build = $this->Build->find('first',array('recursive'=>0,'conditions'=>$conditionsName));
            }else{
                $build = $this->Build->find('first',array('recursive'=>0,'conditions'=>array('Champion.name'=>$champion_name)));
            }
        }

        //check if build don't exist
        if(!$build) $this->redirect(array('controller'=>'pages', 'action'=>'home'));

        //Build
        $build['Build']['skill_sequence'] = unserialize($build['Build']['skill_sequence']);
        $this->set('build', $build);

        //Summoner spells
        $ss = $this->Ss->find('all',array('conditions'=>array('id'=>array($build['Build']['ss1_id'],$build['Build']['ss2_id']))) );
        $this->set('ss',  $ss);

        //Runes
        $runes = unserialize($build['Build']['runes']);
        $runes = $this->Rune->find('all',array('conditions'=>array('id'=>$runes)));
            //sort runes
        for($a=1;$a<=4;$a++){
            foreach($runes as $rune){
                if($rune['Rune']['type'] == $a) $sortedRunes[] = $rune;
            }
        }
        $this->set('runes',$sortedRunes);

        //Items
        $items = unserialize($build['Build']['items']);
        $itemsData = $this->Item->find('all',array('fields'=>array('Item.id','Item.name_en'),'conditions'=>array('id'=>$items)));
            //sort items:
        foreach($items as $item){
            foreach($itemsData as $data){
                if($item == $data['Item']['id']) $sortedItems[] = $data;
            }
        }
        $this->set('items',$sortedItems);




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

    //Three another builds at the bottom of page
        if(is_numeric($champion_name)){
            $another_builds = $this->Build->find('all',array('limit'=>3,'recursive'=>0,
                'conditions'=>array('Build.id <>'=>$champion_name,'Build.done'=>1),
                'order'=>'rand()')
            );
        }else{
            $another_builds = $this->Build->find('all',array('limit'=>3,'recursive'=>0,
                'conditions'=>array('Champion.name <>'=>$champion_name,'Build.done'=>1),
                'order'=>'rand()')
            );
        }
        $this->set('another_builds',$another_builds);

        $this->set('title_for_layout', $build['Champion']['name'].' - poradnik');
        $this->set('header','Poradnik');
    }





    public function champion($champion_name){
        if(!$champion_name) $this->redirect(array('controller'=>'pages', 'action'=>'home'));
        $champion_name = $this->Dehumanize($champion_name);

        $champion = $this->Champion->find('first',array('conditions'=>array('Champion.slug'=>$champion_name)));

        //if build don't exist:
        if(!$champion) $this->redirect(array('controller'=>'pages', 'action'=>'home'));

        $this->set('champion',$champion);

        //Another champions suggestion:
        $another_champions = $this->Champion->find('all',array('limit'=>6,'recursive'=>0,
            'conditions'=>array('Champion.slug <>'=>$champion_name),
            'order'=>'rand()')
        );

        $this->set('another_champions',$another_champions);

        $this->set('title_for_layout', 'Champion - '.$champion['Champion']['name']);
        $this->set('header',$champion['Champion']['name']);
    }





    public function all_champions(){
        $this->paginate = array(
            'order'=>'Champion.name ASC',
            'limit'=>30
        );
        $champions = $this->paginate('Champion');
        $this->set('champions',$champions);

        $this->set('title_for_layout', 'Lista championów');
        $this->set('header','Championi');
    }





    public function search(){
        if(!empty($this->request->query['s'])){
            $phrase = $this->request->query['s'];

            $continue = true;
            if(strlen(str_replace(' ','',$phrase)) < 3){
                $continue = false;
                $this->set('empty','short');
            }
            if(strlen(str_replace(' ','',$phrase)) > 40){
                $continue = false;
                $this->set('empty','long');
            }

                if($continue){
                //explode every word to search in DB separately:
                    $phrasesOne = explode(',',$phrase);
                    foreach($phrasesOne as $one){
                        $phrasesTwo = explode(' ',$one);
                        foreach($phrasesTwo as $two){
                            if(!empty($two)) $phrases[] = $two;
                        }
                    }

            //Search in Builds:
                //set conditions:
                    $conditions[] = array('Build.done'=>1);
                    foreach($phrases as $phrase){
                        $conditionsBuild[] = array(
                            'OR'=>array(
                                'Build.description LIKE'=>"%$phrase%"
                             )
                        );
                        $conditionsChampion[] = array(
                            'OR'=>array(
                                'Champion.name LIKE'=>"%$phrase%",
                                'Champion.slug LIKE'=>"%$phrase%"
                             )
                        );
                    }
                //set paginate
                    $this->paginate = array('order'=>'Build.id DESC','limit'=>10,'conditions'=>$conditionsBuild);
                    $results['builds'] = $this->paginate('Build');
                    
                    $this->paginate = array('order'=>'Champion.id DESC','limit'=>10,'conditions'=>$conditionsChampion);
                    $results['champions'] = $this->paginate('Champion');


                //write in DB phrase (for admin check)
                    $this->Search->create();
                    $this->Search->save(array(
                        'phrase'=>$phrase
                    ));


                    $this->set('results',$results);
                    $this->set('phrases',$phrases);
            }


        }else{
            $this->set('empty','empty');
        }
        
        $this->set('title_for_layout', 'Wyszukiwarka');
        $this->set('header','Wyszukiwanie');
    }




    public function contact(){
        $this->set('title_for_layout', 'Kontakt');
        $this->set('header','Skontakuj się z nami');
    }



    
}