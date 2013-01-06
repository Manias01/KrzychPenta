<?php
App::uses('AppController', 'Controller');

class TooltipsController extends AppController {
    public $uses = array('Champion','Skill','Ss','Rune','Item');
    public $helpers = array('Thumb');


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

        //Summoner Spells
            if($input['type'] == 'ss'){
                $output = $this->Ss->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<div class="ss-lv"><img src="'.$this->base.'/img/lol/ss/'.$this->Dehumanize($output['Ss']['name_en']).'.png" alt="">';
                echo 'Poziom: '.$output['Ss']['lv'].'</div>';
                echo '<div><h3>'.$output['Ss']['name_en'].'</h3>';
                echo '<h4>'.$output['Ss']['name_pl'].'</h4>';
                echo $output['Ss']['desc_pl'].'</div>';
            }


        //Items
            if($input['type'] == 'item'){
                $output = $this->Item->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<img src="'.$this->base.'/img/lol/items/'.$this->Dehumanize($output['Item']['name_en']).'_64.gif" alt="">';
                echo '<div><h3>'.$output['Item']['name_en'].'</h3>';
                echo '<h4>'.$output['Item']['name_pl'].'</h4>';
                echo $output['Item']['desc_pl'].'</div>';
            }

        //Champions
            if($input['type'] == 'champ'){
                $output = $this->Champion->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<img src="'.$this->base.'/img/lol/champions/'.$this->Dehumanize($output['Champion']['name']).'/'.$this->Dehumanize($output['Champion']['name']).'_64.png" alt="">';
                echo '<div><h3>'.$output['Champion']['name'].'</h3><br/>';
                echo '<span>'.$output['Champion']['ip'].'<img src="'.$this->base.'/img/frontend/ip.png" alt=""/></span> <span>albo '.$output['Champion']['rp'].'<img src="'.$this->base.'/img/frontend/rp.png" alt=""/></span>';
                echo '</div>';
            }

        //Skills
            if($input['type'] == 'skill'){
                $output = $this->Skill->find('first',array(
                    'recursive'=>1,
                    'conditions'=>array('Skill.id'=>$input['id']),
                ));
                echo '<img src="'.$this->base.'/img/lol/champions/'.$this->Dehumanize($output['Champion']['name']).'/'.$this->Dehumanize($output['Skill']['name_en']).'_64.png" alt="">';
                echo '<div><h3>'.$output['Skill']['name_en'].'</h3>';
                echo '<h4>'.$output['Skill']['name_pl'].'</h4>';
                echo $output['Skill']['desc_pl'].'</div>';
            }

        //Runes
            if($input['type'] == 'rune'){
                $output = $this->Rune->find('first',array(
                    'conditions'=>array('id'=>$input['id']),
                ));
                echo '<img src="'.$this->base.'/img/lol/runes/'.$this->Dehumanize($output['Rune']['name_en']).'.gif" alt="">';
                echo '<div><h3>'.$output['Rune']['name_en'].'</h3>';
                echo '<h4>'.$output['Rune']['name_pl'].'</h4>';
                echo $output['Rune']['desc_pl'].'</div>';
            }



        }else{
            echo 'Błąd z wyswietleniem tego dymka. <br/> Proszę skontaktuj się z nami i powiedz gdzie ten komunikat się pojawił.';
        }
    }


}
