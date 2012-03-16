<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
<head>
<title><?=$title_for_layout?> | Admin - Pentakill.pl</title>
<?=$this->Html->charset()."\n"?>
<?=$this->Html->css('admin.css')."\n"?>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

</head>
<body>
<div id="wrap">

<div id="header">
    <?=$this->Html->link(
            $this->Html->image('frontend/header_pentakill.jpg',array('alt'=>'Pentakill.pl - Poradniki do League of Legends')),'/admin/news',
            array('escape'=>false)
       );?>
</div><!--/header-->

<div id="menu">
    
<?$linksAdmin = array(
    'News'=>'news',
    'Champions'=>'champions',
    'Skills'=>'skills',
    'Items'=>'items',
    'Runes'=>'runes',
    'Summoner Spells'=>'sses',
    'Users'=>'users'
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