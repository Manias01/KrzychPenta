<h2>Napisz poradnik:</h2>

<script type="text/javascript">
    <?$a=1;foreach($champions as $champion):?>
        var champ<?=$a?> = '<a href="<?=$this->Html->url(array('controller'=>'champions', 'action'=>'champion_page',$champion['Champion']['id']))?>" class="<?=$this->Thumb->Dehumanize($champion['Champion']['name'])?>"><?=$this->Thumb->Champion($champion['Champion']['id'],str_replace("'",'',$champion['Champion']['name']),20)?> <?=str_replace("'",'&#39;',$champion['Champion']['name'])?></a>';
    <?$a++;endforeach?>
</script>



<div id="desc-champs">
    
    <input type="text" id="new_build-filter" style="width:100%;height:15px;border-radius:3px" />

    <div id="filter-champions">
        <?$a=1;foreach($champions as $champion):?>
            <a name="<?=strtolower($champion['Champion']['name'])?>" onClick="tinyMCE.execCommand('mceInsertContent',false,champ<?=$a?>);return false">
                <?=$this->Thumb->Champion($champion['Champion']['id'],$champion['Champion']['name'],38)?>
            </a>
        <?$a++;endforeach?>
    </div><!--/filter-champions-->
    
</div><!--/desc-champs-->



<?=$this->Form->create()?>
    <?=$this->Form->textarea('description',array('value'=>$build['Build']['description']))?>
<?=$this->Form->end('Podejrzyj cały poradnik')?>





<a onClick="tinyMCE.execCommand('mceInsertContent',false,champ1);return false">Wklej coś</a>

<?/*<a href="<?=$this->Html->url(array('action'=>'save_new_build',$champion['Champion']['id']))?>" >
    <img src=\"<?=$this->base?>/img/lol/champions/<?=this->Thumb->Dehumanize($champion['Champion']['name'])?>/<?=this->Thumb->Dehumanize($champion['Champion']['name'])?>_20.png\" alt=\"Ahri\" tip_id=\"<?=$champion['Champion']['id']?>\" class=\"champ\" />
</a>*/?>


