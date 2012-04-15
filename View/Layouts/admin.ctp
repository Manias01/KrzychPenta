<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
<head>
<title><?=$title_for_layout?> | Admin - Pentakill.pl</title>
<?=$this->Html->charset()."\n"?>
<?=$this->Html->css(array('admin.css','tooltip.css','imgarea-css/imgareaselect-default.css'))."\n"?>
<?=$this->Html->script(array('jquery-1.7.2.min.js','jquery.imgareaselect.min','jquery.tooltip.min.js','tooltip.js'))?>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

</head>
<body>
<div id="base" base_url="<?=$this->base?>" style="display:none"></div>

<div id="wrap">

<div id="header">
    <?=$this->Html->link(
            $this->Html->image('frontend/pentakill-logo.jpg',array('alt'=>'Pentakill.pl - Poradniki do League of Legends')),'/admin/news',
            array('escape'=>false)
       );?>
</div><!--/header-->


<div id="userbox">
    <a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'home','admin'=>false))?>" style="color:black">Strona główna</a> | <?=$username?> - <a href="<?=$this->Html->url(array('controller'=>'users','action'=>'logout'))?>" style="color:black">Wyloguj się</a>
</div><!--/userbox-->


<div id="menu">
    
<?$linksAdmin = array(
    'News'=>'news',
    'Sliders'=>'sliders',
    'Champions'=>'champions',
    'Skills'=>'skills',
    'Items'=>'items',
    'Runes'=>'runes',
    'Summoner Spells'=>'sses',
    'Users'=>'users',
    'Builds'=>'builds'
  );?>
  <?foreach($linksAdmin as $nazwa=>$link):?>
    <a href="<?=$this->Html->url(array('controller'=>$link))?>" <?=($link==strtolower($this->name))?'class="active"':''?> ><?=$nazwa?></a>
  <?endforeach?>
    <a href="<?=$this->base?>/generator/index">Generator</a>
    
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