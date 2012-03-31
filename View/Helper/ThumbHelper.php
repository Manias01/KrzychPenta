<?
App::uses('AppHelper', 'View/Helper');

class ThumbHelper extends AppHelper {


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

//return thumbnail image for champion
    public function Champion($champion_name,$class=false){
        $img_name = $this->Dehumanize($champion_name);
        $img_url = $this->base.'/img/lol/champions/'.$img_name.'/'.$img_name.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$champion_name.'" />';

        return($img_full);
    }


    public function Skill($champion_name,$skill_name,$class=false){
        $folder_name = $this->Dehumanize($champion_name);
        $img_name = $this->Dehumanize($skill_name);
        $img_url = $this->base.'/img/lol/champions/'.$folder_name.'/'.$img_name.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$skill_name.'" />';

        return($img_full);
    }


    public function SS($ss_name,$class=false){
        $ss = $this->Dehumanize($ss_name);
        $img_url = $this->base.'/img/lol/ss/'.$ss.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$ss_name.'" '.(($class)?'class="'.$class.'"':'').'/>';

        return($img_full);
    }


    public function Rune($name,$class=false){
        $rune = $this->Dehumanize($name);
        $img_url = $this->base.'/img/lol/runes/'.$rune.'.gif';
        $img_full = '<img src="'.$img_url.'" alt="'.$name.'" '.(($class)?'class="'.$class.'"':'').'/>';

        return($img_full);
    }

    

}
?>