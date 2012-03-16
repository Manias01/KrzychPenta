<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {
    public $name = 'Pages';
    public $helpers = array('Html','Text');
    public $uses = array('News');


    function beforeFilter(){
      $this->Auth->allow('*');
      parent::beforeFilter();
    }



    public function home($page) {
      $this->set('title_for_layout', 'Witamy');

      if($page == 'home'){
        $this->paginate = array(
            'order'=>'News.id DESC',
            'limit'=>3
        );
        $news = $this->paginate('News');
        $this->set('news', $news);
      }

    }

/*
    public function single_news($id){

        $single_news = $this->News->find('first',array('conditions'=>array('News.id'=>$id)));
        $this->set('single_news',$single_news);

        $this->set('title_for_layout', $single_news['News']['title']);
        
    }
*/

}