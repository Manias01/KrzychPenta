<?php
class GetItems {
  public $xml_url = 'gen/xml/items.xml';
  public $source_url = 'items_test_en';
  public $source_url_pl = 'items_test_pl';
  public $items_list;
  public $items_list_pl;
  public $string;
  public $string_pl;
  public $num_items;
  public $image_x = 64;
  public $image_y = 64;

  function __construct(){
    $this->string = file_get_contents($this->source_url);
    $this->string_pl = file_get_contents($this->source_url_pl);
    $this->items_list = $this->BetweenTab($this->string,'<div class=" filter','</table>');
    $this->items_list_pl = $this->BetweenTab($this->string_pl,'<div class=" filter','</table>');
    $this->num_items = count($this->items_list);
  }

/**
* 'BeetweenTab' wyciąga z dużego ciągu znaków, mniejszy ciąg pomiędzy mniejszymi ciągami  - $pre i $post.
* Zwraca tabele z wszystkimi znalezionymi ciągami spełniającymi powyższe warunki
* Uwaga! pierwszy element [0] jest pusty! Zaczynają się od [1]
*/
  public function BetweenTab($string, $pre, $post){
//Wyciąga interesujący nas ciąg znaków
    $string2 = strstr($string, $pre);	//wywala co jest przed interesujaca nas trescia
    $parts = explode($pre, $string2);	//dzieli i wrzuca do tablicy
    $num = count($parts);
    for($a=1;$a<$num;$a++){
      $poz[$a] = stripos($parts[$a], $post);	//zapis do $poz[] ile liter ma dany link
      $output[$a] = substr($parts[$a],0, $poz[$a]);	//ucina wszystko co dalsze co jest po nazwie
    }
    return($output);
  }

  public function BetweenStr($string, $pre, $post){
    $od = stripos($string,$pre)+strlen($pre);
    $output = substr($string,$od, 500);
    $dlugosc = stripos($output,$post);
    $output = substr($output,0,$dlugosc);
    return($output);
  }

  function Tags($temp){
//usuniecie wszystkiego poza tagami

    $temp = $this->BetweenStr($temp,'_tag','" style="display: block; position:relative;">');
//usuniecie ciagu "filter_tag"
    $temp = str_replace('filter','',$temp);
    $temp = str_replace('_tag_','',$temp);
//do tablicy osobno kazdy tag
    $temp = explode(' ',$temp);
    $temp[0] = substr($temp[0],1,strlen($temp[0]));	//wyrzuca '_' z przed pierwszego wyrazu

    return($temp);
  }

  function NormalizeName($string){
//Normuje nazwy
    $string1 = strtolower($string);
    $string2 = str_replace("'",'',$string1);
    $string3 = str_replace(" ",'-',$string2);
    $string4 = str_replace('\'','',$string3);
    $string5 = str_replace(".",'',$string4);
    return($string5);
  }

  function UrlImage($temp){
//pobranie samego linku do $temp
    $od = stripos($temp,'<img src="')+10;
    $temp = substr($temp,$od, 200);
    $dlugosc = stripos($temp,'.png">')+4;
    $temp = substr($temp,0,$dlugosc);
    return($temp);
  }

  function ResizeImage($url,$size){
//Pobiera i zmniejsza obrazek
    $img_source_size = getImageSize($url);		//pobierz jego rozmiary i pobierz go
    $img_source = imageCreateFromPng($url);	//pobierz obrazek

    //Stworz nowy,mniejszy obrazek i przeskaluj na mniejszy
    $img_resized = imagecreatetruecolor($size,$size);
    $abc = imageCopyResampled($img_resized,$img_source,0,0,0,0,$size,$size,$img_source_size[0],$img_source_size[1]);
    return($img_resized);
  }

  function NameEN($input){
//zwraca tablice od [1] do [n] z nazwami skili
    $output = $this->BetweenTab($input, '<span class="highlight">', '</span><br/>');
    return($output[1]);
  }

  function NamePL($input){
//zwraca tablice od [1] do [n] z nazwami skili
    $output = $this->BetweenTab($input, '<span class="highlight">', '</span><br/>');
    return($output[1]);
  }

  function DescriptionPL($input){
    $output = $this->BetweenTab($input, '<p>', '</p>');
    return($output[1]);
  }

  function CostRecipe($input){
    $recipe = $this->BetweenTab($input, '<span class="big">', '<BR><img');
    return($recipe[1]);
  }

  function CostItem($input){
    $item = $this->BetweenTab($input, '"><br>', '</span> <BR />');
    return($item[1]);
  }

  function IdItem_en($input){
//$input - string (nie tablica!) z kodem jednego itemu, wyrzuca jego id
    $temp = $this->items_list;
    $id = $this->BetweenStr($input,'<a class="lol_item" href="/items#','">');
    return($id);
  }
  function IdItem_pl($input){
//$input - string (nie tablica!) z kodem jednego itemu, wyrzuca jego id
    $temp = $this->items_list;
    $id = $this->BetweenStr($input,'<a class="lol_item" href="/pl/items#','">');
    return($id);
  }

  function GetAllImages($size){
    $temp = $this->items_list;
//$this->num_items
    for($a=0;$a<=$this->num_items;$a++){
      $b=$a+1;
      $sciezka = 'img/lol/items/'.$this->NormalizeName($this->NameEN($temp[$b])).'_'.$size.'.gif';
      $out[$a] = imageGif($this->ResizeImage($this->UrlImage($temp[$b]), $size), $sciezka);	//zapisz nowy obrazek na dysku
    }

  return($out);
  }

  function CreateObject(){
    $temp = $this->items_list;
    $temp_pl = $this->items_list_pl;
    //$this->num_items
    for($a=1;$a<=$this->num_items;$a++){
      $item_pl[$a]['id'] = $this->IdItem_pl($temp_pl[$a]);
      $item_pl[$a]['name_pl'] = $this->NamePL($temp_pl[$a]);
      $item_pl[$a]['desc_pl'] = $this->DescriptionPL($temp_pl[$a]);
    }
    for($a=1;$a<=$this->num_items;$a++){
      $item[$a]['id'] = $this->IdItem_en($temp[$a]);
      $item[$a]['name_en'] = $this->NameEN($temp[$a]);
      $item[$a]['tags'] = $this->Tags($temp[$a]);
      $item[$a]['cost1'] = $this->CostRecipe($temp[$a]);
      $item[$a]['cost2'] = $this->CostItem($temp[$a]);
    //poprawia bug na stronie ich
      if($item[$a]['name_en'] == 'Candy Corn') $item[$a]['name_en'] = 'Health Potion';

      for($b=1;$b<=$this->num_items;$b++){
	if($item[$a]['id'] == $item_pl[$b]['id']){
	  $item[$a]['name_pl'] = $item_pl[$b]['name_pl'];
	  $item[$a]['desc_pl'] = $item_pl[$b]['desc_pl'];
	  break;
	}
      }
    }
    return($item);
  }

  function CreateXML($item) {
//Stworzenie pliku XML z danymi pobranymi w wcześniejszych funkcjach
    $write = '<?xml version="1.0" encoding="utf-8"?>'."\n";
//zapis markow
    $num = count($item);
    $write .= '<items>'."\n";	//bez tego nie odczyta potem!
    for($a=1;$a<=$num;$a++){
      //if(stripos($tab_name[$a],'Mark') === false) continue;
      $write .= '<item id="'.$item[$a]['id'].'">'."\n";
      $write .= '  <en>'.$item[$a]['name_en'].'</en>'."\n";
      $write .= '  <pl>'.$item[$a]['name_pl'].'</pl>'."\n";
      $write .= '  <d>'.$item[$a]['desc_pl'].'</d>'."\n";
      $write .= '  <c1>'.$item[$a]['cost1'].'</c1>'."\n";
      $write .= '  <c2>'.$item[$a]['cost2'].'</c2>'."\n";
      //$write .= '  <tag>'."\n";
      $b=1;
      foreach($item[$a]['tags'] as $tags){
	$write .= '  <t>'.$tags.'</t>'."\n";
	$b++;
      }
      //$write .= '  </tag>'."\n";
      $write .= '</item>'."\n";
    }
    $write .= '</items>';	//bez tego nie odczyta potem!

  //zapis do pliku:
    if(!$file = fopen($this->xml_url, 'w')){	//tworzy plik, jak juz jest to kasuje zawartosc
      return("Nie udalo sie utworzyc pliku 'runes.xml'");
    }
    if(fwrite($file, $write) == false){
      fclose($file);
      return("Blad przy zapisie danych. Nic nie zostalo zapisane");
    }
  //jak nie wystąpiły żadne błędy:
    fclose($file);
    return("Zapis został wykonany pomyslnie");
}

  function DoItAll($size){
    //$this->GetAllImages($size);	//pobierz, zmniejsz i zapisz obrazki z neta
    //$this->CreateXML($this->CreateObject());		//zapisz do pliku XML wszystko
  }


}

?>