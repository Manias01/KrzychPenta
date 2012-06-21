<?php
class AppController extends Controller {

    //var $helpers = array('Form', 'Html', 'Javascript', 'Time');

    public $components = array(
            'Session',
            'Auth' => array(
                'loginRedirect' => array('controller' => 'users', 'action' => 'index','admin'=>true),
                'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
            )
    );





    public function beforeFilter() {
        $user_data = $this->Session->read();
        //pass to view some user data
        if(isSet($user_data['Auth']['User'])){  //if any user is login up:
            $this->set('username',$user_data['Auth']['User']['username']);
            $this->set('type',$user_data['Auth']['User']['type']);
            //used to autorization in 'generator' controller:
            $this->params['user_id'] = $user_data['Auth']['User']['id'];
            $this->params['permissions'] =  $user_data['Auth']['User']['type'];
        }


        //change layouts and redirect by permissions:
        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin'){ //if user is login, change layout:

            //user type=2 can only use 'generator' and logout
            if($user_data['Auth']['User']['type'] == 2 && ($this->params['controller']!='users' && $this->params['action']!='admin_logout') ){    //users with 'type'=>2, can use only 'generator'
                $this->redirect(array('controller'=>'generator','action'=>'index','admin'=>false));
            }else{
                $this->layout = 'admin';
            }

        }
        
        if (isset($this->params['controller']) && $this->params['controller'] == 'generator'){ //change layout to 'generator'
            $this->layout = 'generator';
        }

    }




    public function appError($error) {
//        print_r($this->params);
//        print_r($error);
//        exit;
        $this->redirect('/');
    }



    
//old function, cut $string from first occur string->$pre, to first occur string->$post
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


//Change string from normal form to 'computer' form
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