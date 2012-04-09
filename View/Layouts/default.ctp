<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
<head>
<title><?=$title_for_layout?> | Pentakill.pl</title>
<?=$this->Html->charset()."\n"?>
<?=$this->Html->css(array('style.css','tooltip.css'))."\n"?>
<?=$this->Html->script(array('jquery-1.7.2.min.js','jquery.nivo.slider.pack.js','jquery.tooltip.min.js','tooltip.js'))?>
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

</head>
<body>
<div id="base" base_url="<?=$this->base?>" style="display:none"></div>

<div id="wrap">

<div id="header">
    <?=$this->Html->link(
            $this->Html->image('frontend/pentakill-logo.jpg',array('alt'=>'Pentakill.pl - Poradniki do League of Legends')),
            '/',
            array('escape'=>false)
       )
     ?>
    
    <div id="header-nav">
        <?$navigation=array(
            'Home'=>'',
            'Nowości'=>'news',
            'Poradniki'=>'poradnik',
            'Championi'=>'champions',
            'Kontakt'=>'contact'
        );
        foreach($navigation as $name=>$link):?>
            <a href="<?=$this->base.'/'.$link?>"><?=$name?></a>
        <?endforeach?>
    </div><!--/header-nav-->

    <div class="clear"></div>
    
</div><!--/header-->



<?if(isSet($sliders[0])): //show slider, actually it's on homepage?>
    <script type="text/javascript">
        $(window).load(function(){
            $('#slider').nivoSlider({
                prevText: '',
                nextText: ''
            });
        });
    </script>
        <div id="slider" class="nivoSlider">
            <?foreach($sliders as $slider):?>
                <a href="<?=$slider['Slider']['url']?>"><img src="<?=$slider['Slider']['image']?>" alt="" title="<?=$slider['Slider']['description']?>" /></a>
            <?endforeach?>
        </div>
<?endif?>



<h1><?=$header?></h1>

<div id="main">

    <?=$content_for_layout?>

</div> <!--/main-->


<div id="sidebar">
    <div id="search">
        <h4>Wyszukiwarka</h4>
        <input type="text" />
    </div><!--/search-->

    <div id="rotation">
        <h4>Darmowi bohaterowie</h4>
        <ul>
            <li>Caithlyn</li>
            <li>Master YI</li>
            <li>Volibear</li>
            <li>Nunu</li>
            <li>Tristana</li>
            <li>Lulu</li>
            <li>Akali</li>
        </ul>
    </div><!--/rotation-->

    <div id="new-builds">
        <h4>Najnowsze poradniki</h4>
        <?foreach($newest_builds as $newest):?>
            <a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'poradnik',$newest['Build']['id']))?>">
                <?=$this->Thumb->champion($newest['Build']['champion_id'],$newest['Champion']['name'],64);?>
                <h5><?=$newest['Champion']['name'];?></h5>
            </a>
        <div class="clear"></div>
        <?endforeach?>
    </div><!--/new-builds-->

    <div id="facebook">
        <h4>Facebook</h4>
    </div><!--/facebook-->

</div><!--/sidebar-->

<div class="clear"></div>

<div id="footer">
  <hr />
  <p>&copy; Copyright 2012 | <a href="http://pentakill.pl" >Pentakill.pl</a></p>
</div> <!--/footer-->




</div> <!--/wrap-->

<?php echo $this->element('sql_dump'); ?>

</body>
</html>