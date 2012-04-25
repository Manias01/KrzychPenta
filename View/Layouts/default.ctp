<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
<head>
    <title><?=$title_for_layout?> | Pentakill.pl</title>
    <meta charset="UTF-8" />
    <meta name="description" content="<?=(!empty($build['Build']['introduction'])?$this->Text->Truncate($build['Build']['introduction'],200):'')?>" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <?=$this->Html->charset()."\n"?>
    <?=$this->Html->css(array('style.css','tooltip.css'))."\n"?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
    <?=$this->Html->script(array(/*'jquery-1.7.2.min.js',*/'jquery.nivo.slider.pack.js','jquery.tooltip.min.js','tooltip.js'))?>
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
            //'Nowości'=>'nowosci',
            'Poradniki'=>'poradniki',
            'Championi'=>'championi',
            'Kontakt'=>'kontakt'
        );
        foreach($navigation as $name=>$link):?>
            <a href="<?=$this->base.'/'.$link?>"><?=$name?></a>
        <?endforeach?>
    </div><!--/header-nav-->

    <div class="clear"></div>
    
</div><!--/header-->




<div id="main">

    <?if(isSet($sliders[0])): //show slider, actually it's on homepage?>
        <script type="text/javascript">
            $(window).load(function(){
                $('#slider').nivoSlider({
                    prevText: '',
                    nextText: '',
                    pauseTime: 4000
                });
            });
        </script>
            <div id="slider" class="nivoSlider">
                <?foreach($sliders as $slider):?>
                    <a href="<?=$slider['Slider']['url']?>"><img src="<?=$slider['Slider']['image']?>" alt="" title="<?=$this->Text->truncate($slider['Slider']['description'],180)?>" /></a>
                <?endforeach?>
            </div>
    <?endif?>

    <h1><?=($header)?$header:''?></h1>

    <?=$content_for_layout?>

</div> <!--/main-->


<div id="sidebar">

    
    <div id="search">
        <h4>Wyszukiwarka</h4>
        <?=$this->Form->create('',array('type'=>'get','url'=>array('controller'=>'pages','action'=>'search')))?>
            <?=$this->Form->input('s',array('type'=>'text','label'=>false))?>
        <?=$this->Form->end('Szukaj')?>
    </div><!--/search-->



    <div id="rotation">
        <h4>Aktualna rotacja</h4>
        <ul>
            <?foreach($sidebar_rotation as $rotation):?>
                <a href="
                <?if(!empty($rotation['Build']['id'])){ //poradnik is available
                    echo $this->Html->url(array('controller'=>'pages','action'=>'poradnik',$this->Thumb->Dehumanize($rotation['Champion']['name'])));
                    $class = 'rotation-poradnik-border';
                  }else{    //poradnik don't exist
                    echo $this->Html->url(array('controller'=>'pages','action'=>'champion',$this->Thumb->Dehumanize($rotation['Champion']['name'])));
                    $class = '';
                  }?>
                   " class="<?=$class?>">
                   
                    <?=$this->Thumb->Champion($rotation['Champion']['id'],$rotation['Champion']['name'],38);?>
                    <h5><?=$rotation['Champion']['name']?></h5>
                    <?=(!empty($rotation['Build']['id']))?'<h5 class="rotation-poradnik">Mamy<br/>poradnik!</h5>':'';?>
                </a>
            <?endforeach?>
        </ul>
    </div><!--/rotation-->



    <div id="new-builds">
        <h4>Najnowsze poradniki</h4>
        <?foreach($sidebar_newest_builds as $newest):?>
            <a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'poradnik',$this->Thumb->Dehumanize($newest['Champion']['name'])))?>">
                <?=$this->Thumb->Champion($newest['Build']['champion_id'],$newest['Champion']['name'],64);?>
                <h5><?=$newest['Champion']['name'];?></h5>
            </a>
        <div class="clear"></div>
        <?endforeach?>
    </div><!--/new-builds-->


 <?if($this->base != '/KrzychPenta')://if it is NOT localhost:?>
    
    <div id="facebook">
        <h4>Facebook</h4>
        <div id="fb-root"></div>
        <script src="http://connect.facebook.net/pl_PL/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/pages/Pentakill/230716520284492" width="300" colorscheme="dark" show_faces="true" border_color="#000000" stream="false" header="false"></fb:like-box>
    </div><!--/facebook-->



    <?/*advert*/?>
<cake:nocache>

        <?$type = rand(0,1);
            if($type == 0):?>
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-4638937189329374";
                <?// Pentakill-widget-graficzna?>
                google_ad_slot = "6946897739";
                google_ad_width = 160;
                google_ad_height = 600;
                //-->
                </script>
                <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            <?else:?>
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-4638937189329374";
                <?//Pentakill-graf-MenuR?>
                google_ad_slot = "5335428888";
                google_ad_width = 250;
                google_ad_height = 250;
                //-->
                </script>
                <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            <?endif?>

</cake:nocache>
    <?/*end advert*/?>

<?endif;//end if it is NOT localhost?>


</div><!--/sidebar-->

<div class="clear"></div>



<div id="footer">
  <p>&copy; Copyright 2012 | <a href="http://pentakill.pl" >Pentakill.pl</a></p>

  <div id="footer-menu">
      <?$a=0;foreach($navigation as $name=>$link):?>
        <?=($a==0)?'':' | '?><a href="<?=$this->base.'/'.$link?>"><?=$name?></a>
      <?$a++;endforeach?>
  </div><!--/footer-menu-->
    
</div> <!--/footer-->




</div> <!--/wrap-->

<?php echo $this->element('sql_dump'); ?>

<?if($this->base != '/KrzychPenta')://if it is NOT localhost:?>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-24389295-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

<?endif;//end if it is NOT localhost?>

</body>
</html>