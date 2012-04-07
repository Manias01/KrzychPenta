<?php
App::uses('AppController', 'Controller');

class TooltipsController extends AppController {
    public $uses = array('Champion','Skill','Ss','Rune','Item');
//    public $helpers = array('Thumb');


    function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('*');
    }

    

    public function index(){
        $this->layout = 'ajax';
        if(isSet($this->data) && is_numeric($this->data['id'])){
            $type = '';
        //for security:
            $input['id'] = intVal($this->data['id']);
            $input['type'] = strip_tags($this->data['type']);

        //if's for different tables in DB
            if($input['type'] == 'ss'){
                $output = $this->Ss->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<h3>'.$output['Ss']['name_en'].'</h3><br/>';
                echo $output['Ss']['desc_en'].'<br/>';
                echo 'lv: '.$output['Ss']['lv'];
            }

            if($input['type'] == 'item'){
                $output = $this->Item->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<h3>'.$output['Item']['name_en'].'</h3><br/>';
                echo $output['Item']['desc_pl'].'<br/>';
            }

            if($input['type'] == 'champ'){
                $output = $this->Champion->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<h3>'.$output['Champion']['name'].'</h3><br/>';
            }

            if($input['type'] == 'skill'){
                $output = $this->Skill->find('first',array(
                    'recursive'=>-1,
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<h3>'.$output['Skill']['name_en'].'</h3><br/>';
                echo $output['Skill']['desc_pl'];
            }

            if($input['type'] == 'rune'){
                $output = $this->Rune->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<h3>'.$output['Rune']['name_en'].'</h3><br/>';
                echo $output['Rune']['desc_pl'];
            }



        }else{
            echo 'Błąd z wyswietleniem tego dymka. <br/> Proszę skontaktuj się z nami i powiedz gdzie ten komunikat się pojawił.';
        }
    }


}
