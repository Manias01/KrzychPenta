<h2 style="color:red;text-align:center"><?=$this->Session->flash();?></h2>

<h2>Stwórz nowy poradnik:</h2>
<?=$this->Html->link('-> Stwórz nowy poradnik',array('action'=>'new_build'))?>

<br/><br/>
<h2>lub wybierz z już rozpoczętych:</h2>


<?
foreach($builds as &$build):
    $img_url = $this->Thumb->Dehumanize($build['Champion']['name']);
    $build['Champion']['image_src'] = $this->base.'/img/lol/champions/'.$img_url.'/'.$img_url.'.png';
?>
<a href="<?=$this->Html->url(array('action'=>'skills',$build['Build']['id']))?>" class="build">
    <p><?=$build['Champion']['name']?> - <?=$build['Build']['name']?></p>
    <?=$this->Thumb->Champion($build['Champion']['id'],$build['Champion']['name'],64)?>
    <p>Autor: <?=$build['User']['username']?></p>
    <p>Stworzono:<br/><?=$this->Time->format('H:m:s d/m/Y',$build['Build']['created'])?></p>
    <p>Modyfikowano:<br/><?=$this->Time->format('H:m:s d/m/Y',$build['Build']['modified'])?></p>
    <?=($build['Build']['done']==1)?'<p class="green">Opublikowany</p>':'<p class="red">W przygotowaniu</p>'?>
</a><!--/build-->

<?endforeach?>



<pre>
<?//print_r($builds)?>
</pre>
