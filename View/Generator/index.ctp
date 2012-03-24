<br/>
<?=$this->Html->link('Stwórz nowy poradnik',array('action'=>'new_build'))?>

<h2>Dostępne poradniki:</h2>

<?
foreach($builds as &$build):
    $img_url = $this->StrChanger->Dehumanize($build['Champion']['name']);
    $build['Champion']['image_src'] = $this->base.'/img/lol/champions/'.$img_url.'/'.$img_url.'.png';
?>
<a href="" class="build">
    <p><?=$build['Champion']['name']?> - <?=$build['Build']['name']?></p>
    <?=$this->Thumb->Champion($build['Champion']['name'])?>
    <p>Autor: <?=$build['User']['username']?></p>
    <p>Stworzono:<br/><?=$this->Time->format('H:m:s d/m/Y',$build['Build']['created'])?></p>
    <p>Modyfikowano:<br/><?=$this->Time->format('H:m:s d/m/Y',$build['Build']['modified'])?></p>
</a><!--/build-->

<?endforeach?>



<pre>
<?//print_r($builds)?>
</pre>
