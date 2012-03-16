<?
App::uses('AppHelper', 'View/Helper');

class StrChangerHelper extends AppHelper {


//Normuje nazwy
    public function Dehumanize($string){
        $string1 = strtolower($string);
        $string2 = str_replace("'",'',$string1);
        $string3 = str_replace(" ",'-',$string2);
        $string4 = str_replace('\'','',$string3);
        $string5 = str_replace(".",'',$string4);
        $string6 = str_replace(':','',$string5);
        return($string6);
    }
}


?>