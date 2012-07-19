<h2>Napisz poradnik:</h2>

<?//Full content of event onClick at icons. It add link + image to TinyMCE?>
<script type="text/javascript">
    <?$a=1;foreach($skills as $skill):?>
        var skill<?=$a?> = '<?=$this->Thumb->Skill($build['Champion']['name'],$skill['Skill']['id'],str_replace("'",'',$skill['Skill']['name_en']),20)?> <?=str_replace("'",'&#39;',$skill['Skill']['name_en'])?>';
    <?$a++;endforeach?>
        
    <?$a=1;foreach($champions as $champion):?>
        var champ<?=$a?> = '<a href="<?=$this->Html->url(array('controller'=>'pages', 'action'=>'champion',$this->Thumb->Dehumanize($champion['Champion']['name'])))?>" class="<?=$this->Thumb->Dehumanize($champion['Champion']['name'])?>"><?=$this->Thumb->Champion($champion['Champion']['id'],str_replace("'",'',$champion['Champion']['name']),20)?> <?=str_replace("'",'&#39;',$champion['Champion']['name'])?></a>';
    <?$a++;endforeach?>

    <?$a=1;foreach($ss as $s):?>
        var ss<?=$a?> = '<?=$this->Thumb->Ss($s['Ss']['id'],str_replace("'",'',$s['Ss']['name_en']),20)?><span class="ss-desc"><?=str_replace("'",'&#39;',$s['Ss']['name_en'])?></span>';
    <?$a++;endforeach?>

    <?$a=1;foreach($items as $item):?>
        var item<?=$a?> = '<?=$this->Thumb->Item($item['Item']['id'],str_replace("'",'',$item['Item']['name_en']),20)?><?=str_replace("'",'&#39;',$item['Item']['name_en'])?>';
    <?$a++;endforeach?>
</script>



<?//Small icons to add content in TinyMCE?>
<div id="desc-right-column">
    <h3 style="margin: 0;">Przykładowa rozpiska</h3>
    <p>Pamietaj aby do nagłówków używać format->"<strong>header 3</strong>"<br/>
    1.Wstęp(bez nagłowka).<br/>2.Early game(start items)/jungle.<br/>3.Team Fight.<br/>4. Combo<br/>5.Podsumowanie(opcjonalne)<br/>

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

    <div class="clear"></div>

    <div id="desc-ss">
        <h3 style="margin: 10px 0 0 0;">Summoner spells</h3>

        <?$a=1;foreach($ss as $s):?>
            <a name="<?=strtolower($s['Ss']['name_en'])?>" onClick="tinyMCE.execCommand('mceInsertContent',false,ss<?=$a?>);return false">
                <?=$this->Thumb->Ss($s['Ss']['id'],$s['Ss']['name_en'],32)?>
            </a>
        <?$a++;endforeach?>

    </div><!--/desc-ss-->

</div><!--/desc-right-column-->



<?//TinyMCE form and items below?>
<div id="desc-left-column">
    <div id="tinymce">
        <?=$this->Form->create()?>
            <?=$this->Form->textarea('description',array('value'=>$build['Build']['description']))?>
        <?=$this->Form->end('Zapisz i podejrzyj cały poradnik')?>
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


