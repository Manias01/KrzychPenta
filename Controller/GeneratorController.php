<?php
App::uses('AppController', 'Controller');

class GeneratorController extends AppController {
    public $uses = array('Champion','Skill');


    function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('*');
    }


    public function index(){
        
    }



 
}