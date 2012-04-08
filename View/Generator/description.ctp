<h2>Napisz poradnik:</h2>

<?//Full content of event onClick at icons. It add link + image to TinyMCE?>
<script type="text/javascript">
    <?$a=1;foreach($skills as $skill):?>
        var skill<?=$a?> = '<a href="<?=$this->Html->url(array('controller'=>'champions', 'action'=>'champion_page',$build['Build']['champion_id']))?>" class="<?=$this->Thumb->Dehumanize($skill['Skill']['name_en'])?>"><?=$this->Thumb->Skill($build['Champion']['name'],$skill['Skill']['id'],str_replace("'",'',$skill['Skill']['name_en']),20)?> <?=str_replace("'",'&#39;',$skill['Skill']['name_en'])?></a>';
    <?$a++;endforeach?>
        
    <?$a=1;foreach($champions as $champion):?>
        var champ<?=$a?> = '<a href="<?=$this->Html->url(array('controller'=>'champions', 'action'=>'champion_page',$champion['Champion']['id']))?>" class="<?=$this->Thumb->Dehumanize($champion['Champion']['name'])?>"><?=$this->Thumb->Champion($champion['Champion']['id'],str_replace("'",'',$champion['Champion']['name']),20)?> <?=str_replace("'",'&#39;',$champion['Champion']['name'])?></a>';
    <?$a++;endforeach?>

    <?$a=1;foreach($items as $item):?>
        var item<?=$a?> = '<?=$this->Thumb->Item($item['Item']['id'],str_replace("'",'',$item['Item']['name_en']),20)?> <?=str_replace("'",'&#39;',$item['Item']['name_en'])?>';
    <?$a++;endforeach?>
</script>



<?//Small icons to add content in TinyMCE?>
<div id="desc-right-column">
    <h3 style="margin: 0;">Przykładowa rozpiska</h3>
    <p>1.walka na linii.<br/>2.team fight.<br/>3.kombinacje skilli o ile są jakieś ciekawe.<br/>
       W pkt.1 można napisać jakie start items. Jeżeli jungler to pkt.1 opis dżungli</p>

    <div id="desc-skills">
        <h3 style="margin: 0;">Skille</h3>
        <?$a=1;foreach($skills as $skill):?>
            <a name="<?=strtolower($skill['Skill']['name_en'])?>" onClick="tinyMCE.execCommand('mceInsertContent',false,skill<?=$a?>);return false">
                <?=$this->Thumb->Skill($build['Champion']['name'],$skill['Skill']['id'],$skill['Skill']['name_en'],38)?>
            </a>
        <?$a++;endforeach?>

    </div><!--/desc-skills-->

    
    
    <div id="desc-champs">
        <h3 style="margin: 10px 0 0 0;">Championi</h3>
        <input type="text" id="new_build-filter" style="width:100%;height:15px;border-radius:3px" />

        <div id="filter-champions">
            <?$a=1;foreach($champions as $champion):?>
                <a name="<?=strtolower($champion['Champion']['name'])?>" onClick="tinyMCE.execCommand('mceInsertContent',false,champ<?=$a?>);return false">
                    <?=$this->Thumb->Champion($champion['Champion']['id'],$champion['Champion']['name'],38)?>
                </a>
            <?$a++;endforeach?>
        </div><!--/filter-champions-->
    </div><!--/desc-champs-->

</div><!--/desc-right-column-->



<?//TinyMCE form?>
<div id="desc-left-column">
    <div id="tinymce">
        <?=$this->Form->create()?>
            <?=$this->Form->textarea('description',array('value'=>$build['Build']['description']))?>
        <?=$this->Form->end('Podejrzyj cały poradnik')?>
    </div><!--/tinymce-->

    <div id="desc-items">
        <h3 style="margin: 0;">Przedmioty</h3>
        <input type="text" id="items-search" />
        <div id="items-all">
            <?$a=1;foreach($items as $item):?>
                <a name="<?=strtolower($item['Item']['name_en'])?>" onClick="tinyMCE.execCommand('mceInsertContent',false,item<?=$a?>);return false">
                    <?=$this->Thumb->item($item['Item']['id'],$item['Item']['name_en'],38)."\n"?>
                </a>
            <?$a++;endforeach?>
        </div<!--/items-all-->
    </div><!--/desc-items-->
    
</div><!--/desc-left-column-->


<?/*Sample of event for TinyMCE:
<a onClick="tinyMCE.execCommand('mceInsertContent',false,champ1);return false">Wklej coś</a>
*/?>


