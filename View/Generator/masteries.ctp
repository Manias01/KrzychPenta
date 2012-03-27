<?//list of dirs which use:
$types = array(
    'def',
    'ofe',
    'uti'
    );
?>

<h2>Wybierz specjalizację (masteries)</h2>

<?foreach($types as $type):?>

    <div class="masteries">
    <h2><?=ucFirst($type)?></h2>
    
    <?foreach($masteries->$type as $name):?>
        <?if($name=='.' || $name=='..' || $name=='.directory') continue;?>
        <a href="<?=$this->Html->url(array('action'=>'save_masteries',$this->params['pass'][0],$name))?>"<?=(isSet($build['Build']['masteries'])&&$build['Build']['masteries']==$name)?'class="active"':''?>>
            <img src="<?=$this->base?>/img/lol/masteries/<?=$type?>/<?=$name?>" />
        </a>
    <?endforeach?>
        
    </div><!--/masteries-->


<?endforeach?>