<?
App::uses('AppHelper', 'View/Helper');

class ThumbHelper extends AppHelper {


//Normuje nazwy
    private function Dehumanize($string){
        $string1 = strtolower($string);
        $string2 = str_replace("'",'',$string1);
        $string3 = str_replace(" ",'-',$string2);
        $string4 = str_replace('\'','',$string3);
        $string5 = str_replace(".",'',$string4);
        $string6 = str_replace(':','',$string5);
        return($string6);
    }

//return thumbnail image for champion
    public function Champion($champion_name){
        $img_name = $this->Dehumanize($champion_name);
        $img_url = $this->base.'/img/lol/champions/'.$img_name.'/'.$img_name.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$champion_name.'" />';

        return($img_full);
    }


    public function Skill($champion_name,$skill_name){
        $folder_name = $this->Dehumanize($champion_name);
        $img_name = $this->Dehumanize($skill_name);
        $img_url = $this->base.'/img/lol/champions/'.$folder_name.'/'.$img_name.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$skill_name.'" />';

        return($img_full);
    }

    

}
?>