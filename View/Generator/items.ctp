<h2>Wybierz przedmioty</h2>


<div id="items-destination">


        <?for($a=1;$a<=6;$a++):?>
        <div class="item-box">
            <div class="item-box-img">
                <a class="item-delete">x</a>
                <?if($build['Build']['items'][$a]):?>
                    <?=$this->Thumb->item($build['Build']['items'][$a],$items[($build['Build']['items'][$a]-1)]['Item']['name_en'],'display')."\n"?>
                <?else:?>
                    <img src="" />
                <?endif?>
            </div>
            <p><?=($build['Build']['items'][$a])?$items[($build['Build']['items'][$a]-1)]['Item']['name_en']:''?></p>
        </div>

        <?endfor?>


</div>



<input type="text" id="items-search" />

<div id="items-all">

    <ul id="items-ready" class="connectedSortable">

<?//$a=0;?>
        <?foreach($items as $item):?>
<?//$a++;if($a>=6) break?>
            <?=$this->Thumb->item($item['Item']['id'],$item['Item']['name_en'])."\n"?>
        <?endforeach?>

    </ul>

</div>

<?=$this->Form->create()?>
    <?for($a=1;$a<=6;$a++):?>
        <?=$this->Form->input($a,array('type'=>'hidden'))?>
    <?endfor?>
<?=$this->Form->end('Następny krok')?>

