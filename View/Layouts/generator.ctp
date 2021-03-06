<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
<head>
    <title><?=$title_for_layout?> | Generator - Pentakill.pl</title>
    <?=$this->Html->charset()."\n"?>
    <?=$this->Html->css(array('generator.css','tooltip.css'))?>
    <?=$this->Html->script(array('jquery-1.7.2.min.js','jquery-ui-1.8.18.custom.min.js','tiny_mce/tiny_mce.js','jquery.tooltip.min.js',  'tooltip.js','generator.js'))?>
</head>
<body>
<div id="base" base_url="<?=$this->base?>" style="display:none"></div>
    
<div id="wrap">
    <br/>

<div id="userbox">

    <a href="<?=$this->base?>/admin" style="color:black">Powrót do panelu admina</a>
    |
    <a href="<?=$this->Html->url(array('controller'=>'users','action'=>'edit_own_account','admin'=>true))?>"><?=$username?></a>
    -
    <a href="<?=$this->Html->url(array('controller'=>'users','action'=>'logout','admin'=>true))?>" style="color:black">Wyloguj się</a>
</div><!--/userbox-->


<div id="menu">

<?$links = array(
    'Wybór poradnika'=>'index',
    'Umiejętności'=>'skills',
    'Kolejność umiejętności'=>'skill_sequence',
    'Masteries'=>'masteries',
    'Summoner spells'=>'ss',
    'Runy'=>'runes',
    'Przedmioty'=>'items',
    'Własna treść'=>'description',
    'Podgląd'=>'preview',
    ''=>'done'
  );?>
  <div class="done">
  <?(isSet($this->params['pass'][0]))?$index = false:$index = true;?>
      
  <?foreach($links as $nazwa=>$link):?>
        <?=($link==$this->params['action'])?'</div><!--/done-->':''?>
        <a href="<?=($index)?'#':$this->Html->url(array('action'=>$link,$this->params['pass'][0]));?>"
            <?=($link==$this->params['action'])?'class="active"':(($index)?'class="inactive"':'')?> >
            <?=$nazwa?>
        </a> ->
  <?endforeach?>
</div><!--/menu-->


<div id="main">

  <?=$content_for_layout?>

</div> <!--/main-->


<div class="clear"></div>


<div id="footer">
  <hr />
  <p>&copy; Copyright 2012 | <a href="http://pentakill.pl" >Pentakill.pl</a></p>
</div> <!--/footer-->




</div> <!--/wrap-->

<?php echo $this->element('sql_dump'); ?>

</body>
</html>