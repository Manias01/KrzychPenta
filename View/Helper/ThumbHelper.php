<?
App::uses('AppHelper', 'View/Helper');

class ThumbHelper extends AppHelper {


//Normuje nazwy
    public function Dehumanize($string){//the same function forcontrollers is in AppController
        $string1 = strtolower($string);
        $string2 = str_replace("'",'',$string1);
        $string3 = str_replace(" ",'-',$string2);
        $string4 = str_replace('\'','',$string3);
        $string5 = str_replace(".",'',$string4);
        $string6 = str_replace(':','',$string5);
        $string = str_replace(",",'',$string6);
        $string = str_replace("!",'',$string);
        return($string);
    }

//return thumbnail image for champion
    public function Champion($champion_id,$champion_name,$size=64,$class=false){
        $img_name = $this->Dehumanize($champion_name);
        $img_url = $this->base.'/img/lol/champions/'.$img_name.'/'.$img_name.'_'.$size.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$champion_name.'" tip_id="'.$champion_id.'" class="champ'.(($class)?' '.$class:'').'"/>';

        return($img_full);
    }


    public function Skill($champion_name,$skill_id,$skill_name,$size=38,$class=false){
        $folder_name = $this->Dehumanize($champion_name);
        $img_name = $this->Dehumanize($skill_name);
        $img_url = $this->base.'/img/lol/champions/'.$folder_name.'/'.$img_name.'_'.$size.'.png';
        $img_full = '<img src="'.$img_url.'" alt="'.$skill_name.'" tip_id="'.$skill_id.'" class="skill'.(($class)?' '.$class:'').'" />';

        return($img_full);
    }


    public function SS($id,$ss_name,$size=64,$class=false){
        $ss = $this->Dehumanize($ss_name);//.'_'.$size
        $img_url = $this->base.'/img/lol/ss/'.$ss.'.png';
        $img_full = '<img src="'.$img_url.'" width="'.$size.'" height="'.$size.'" alt="'.$ss_name.'" tip_id="'.$id.'" class="ss'.(($class)?' '.$class:'').'" />';

        return($img_full);
    }


    public function Rune($id,$name,$size=34,$class=false){
        $rune = $this->Dehumanize($name);
        $img_url = $this->base.'/img/lol/runes/'.$rune.'.gif';
        $img_full = '<img src="'.$img_url.'" alt="'.$name.'" tip_id="'.$id.'" class="rune'.(($class)?' '.$class:'').'"/>';

        return($img_full);
    }


    public function Item($id,$name,$size=38,$class=false){
        $item = $this->Dehumanize($name);
        $img_url = $this->base.'/img/lol/items/'.$item.'_'.$size.'.gif';
        $img_full = '<img src="'.$img_url.'" alt="'.$item.'" tip_id="'.$id.'" class="item'.(($class)?' '.$class:'').'"/>';

        return($img_full);
    }

    

}
?>