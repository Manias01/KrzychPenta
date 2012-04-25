<?php
class AppController extends Controller {

    //var $helpers = array('Form', 'Html', 'Javascript', 'Time');

    public $components = array(
            'Session',
            'Auth' => array(
                'loginRedirect' => array('controller' => 'users', 'action' => 'index','admin'=>true),
                'logoutRedirect' => array('controller' => 'users', 'action' => 'login','admin'=>false)
            )
    );





    public function beforeFilter() {

        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            $this->layout = 'admin';
            
            $user_data = $this->Session->read();
            $this->set('username',$user_data['Auth']['User']['username']);
        }
        if (isset($this->params['controller']) && $this->params['controller'] == 'generator') {
            $this->layout = 'generator';

            $user_data = $this->Session->read();
            $this->set('username',$user_data['Auth']['User']['username']);
        }
    }




    public function appError($error) {
        $this->redirect('/');
    }



    
//Wyciąga interesujący nas ciąg znaków
    public function Tnij($string, $pre, $post){
            $output = '';
            $string2 = strstr($string, $pre);	//wywala co jest przed interesujaca nas trescia
            $parts = explode($pre, $string2);	//dzieli i wrzuca do tablicy
            $num = count($parts);
            for($a=1;$a<$num;$a++){
              $poz[$a] = stripos($parts[$a], $post);	//zapis do $poz[] ile liter ma dany link
              $output[$a] = substr($parts[$a],0, $poz[$a]);	//ucina wszystko co dalsze co jest po nazwie
            }
            return($output);
    }


//From normal form to computer form
    public function Dehumanize($string){//the same function as helper is in ThumbHelper
        $string = strtolower($string);
        $string = str_replace("'",'',$string);
        $string = str_replace(" ",'-',$string);
        $string = str_replace('\'','',$string);
        $string = str_replace(".",'',$string);
        $string = str_replace(':','',$string);
        $string = str_replace(",",'',$string);
        $string = str_replace("!",'',$string);
        return($string);
    }


}
?>