<h2>Wybierz specjalizację (masteries)</h2>
<p>Bądź dodaj nową: (grafika *.jpg, rozmiar najlepiej większy niż 600x348, z ratio 600x348 )</p>
<?foreach($folders as $folder){
    $types[$folder] = $folder;
}?>
<?=$this->Form->create(array('type'=>'file'))?>
    <?=$this->Form->input('type',array('type'=>'select','options'=>array($types)))?>
    <?=$this->Form->input('name',array('type'=>'text'))?>
    <?=$this->Form->input('img',array('type'=>'file'))?>
<?=$this->Form->end('Dodaj')?>
<div class="clear"></div>

<hr/>

<?foreach($types as $type):?>

    <div class="masteries">
    <h2><?=ucFirst($type)?></h2>
    
    <?foreach($masteries->$type as $name):?>
        <?if($name=='.' || $name=='..' || $name=='.directory') continue;?>
        <a href="<?=$this->Html->url(array('action'=>'save_masteries',$this->params['pass'][0],$type.'/'.$name))?>"<?=(isSet($build['Build']['masteries'])&&$build['Build']['masteries']==($type.'/'.$name))?'class="active"':''?>>
            <img src="<?=$this->base?>/img/lol/masteries/<?=$type?>/<?=$name?>" />
            <p><?=str_replace('.jpg','',$name)?></p>
        </a>
        
    <?endforeach?>
        
    </div><!--/masteries-->


<?endforeach?>