<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
<head>
<title><?=$title_for_layout?> | Generator - Pentakill.pl</title>
<?=$this->Html->charset()."\n"?>
<?=$this->Html->css('generator.css')?>
<?=$this->Html->script(array('jquery-1.7.2.min.js','generator.js'))?>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

</head>
<body>
<div id="wrap">


<div id="menu">

<?$linksAdmin = array(
    'Wybór poradnka'=>'index'
  );?>
  <?foreach($linksAdmin as $nazwa=>$link):?>
    <a href="<?=$this->Html->url(array('action'=>$link))?>" <?=($nazwa==$this->name)?'class="active"':''?> ><?=$nazwa?></a>
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